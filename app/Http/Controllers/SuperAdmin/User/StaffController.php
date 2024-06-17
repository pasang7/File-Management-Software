<?php

namespace App\Http\Controllers\SuperAdmin\User;

use App\Http\Controllers\ImageController;
use App\Http\Requests\SuperAdmin\User\ChangePasswordRequest;
use App\Http\Requests\SuperAdmin\User\StaffRequest;
use App\Http\Requests\SuperAdmin\User\StaffUpdateRequest;
use App\Models\Model\SuperAdmin\User\User;
use App\Models\Service\SuperAdmin\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    protected $imageController;
    function __construct(UserService $user, ImageController $imageController)
    {
        $this->user=$user;
        $this->imageController=$imageController;
    }

    public function index()
    {
        if(Auth::user()->role=='superadmin'){
            $users=$this->user->paginate();
        }else{
            $users= User::where('role', 'staff')->paginate(100);
        }
        $users->append('user_role');
        return view('super-admin.user.staff.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.user.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $userInfo=$request->all();
        $password = 'klientscape';
        $userInfo['email']= $staffEmail = strtolower($request['email']);
        $userInfo['password']=bcrypt($password);
        $userInfo['decrypt_pw']=$password;
        $code=sha1(time());
        $userInfo['verification_code']=$code;

        if($request->file('image')){
            $folder_name='User';
            $ImgName=$this->imageController->saveAnyImg($request,$folder_name,'image',100,100);
            $userInfo['image']=$ImgName;
        }
        $em = base64_encode($staffEmail);
        if($this->user->create($userInfo)){
            $data=array(
                'from'=>$staffEmail,
                'password'=>$password,
                'name'=>$request->name,
                'verification_code'=>$code,
                'em'=> $em,
            );
            // Mail::send('emails.user-registration-mail',$data,function ($message) use ($data){
            //     $message->from(SITE_MAIL_EMAIL);
            //     $message->to($data['from']);
            //     $message->subject('Email Verification');
            // });
            
            $user = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $user->name. ' created new staff.',
            'type' => 'staff'
        ]);
            alert()->success('Staff created successfully', 'Success !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }else{
            alert()->error('Problem in creating staff', 'Oops !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }
    }

    public function verifyCustomer($email, $verification_code, $pw){
        $decodedEmail = base64_decode($email);
        $customer= User::where('email',$decodedEmail)->first();
        if($customer){
            if($customer->verification_code ==$verification_code){
                $customer->verification_code = Str::random(100);
                $customer->save();
                $email = $customer->email;
                $password = $pw;
                $username = $customer->username;
               
            alert()->success('Your account is activated.','Verified !!!')->persistent(true,true);

            return view('super-admin.login.login', compact('username', 'password'));        

            }
            else{
                alert()->error('The link is expired', 'Access Denied !!!')->persistent('Close');
                return redirect()->route('superadmin.dashboard');
            }
        }else{
            alert()->error('User Not Found', 'Oops !!!')->persistent('Close');
            return redirect()->route('superadmin.dashboard');
        }
    }
    public function updatePassword(ChangePasswordRequest $request)
    {
        $user=User::find($request->user_id);

        if(! Hash::check($request['oldpassword'],$user->password))
        {
            Toastr::error('Your old Password does not match.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->back();
        }
        $adminpassword['password']=bcrypt($request['password']);
        $adminpassword['decrypt_pw']=$request['password'];
        if($this->user->update($request->user_id,$adminpassword)){
            DB::table('users')->update(['is_new' => 'no']);
            Toastr::success('Password update successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('superadmin.dashboard');
        }else{
            Toastr::error('Problem in changing password', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->back();
        }
    }

    public function changePassword(Request $request)
    {
        $adminpassword['password']=bcrypt($request['password']);
        $adminpassword['decrypt_pw']=$request['password'];
        if($this->user->update($request->user_id,$adminpassword)){
            DB::table('users')->update(['is_new' => '0']);
            Toastr::success('Password update successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('superadmin.dashboard');
        }else{
            Toastr::error('Problem in changing password', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=$this->user->find($id);
        return view('super-admin.user.staff.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffUpdateRequest $request, $id)
    {
        $userInfo=$request->all();
        $folder_name='User';
        $user=$this->user->find($id);
        $userInfo['password']=$user->password;
        $userInfo['decrypt_pw']=$user->decrypt_pw;
//        if($request->file('image')==''){
//            $userInfo['image']=$user->image;
//        }
//        else{
//            $this->imageController->deleteImg($folder_name,$user->image);
//            $ImgName=$this->imageController->saveAnyImg($request,$folder_name,'image',100,100);
//            $userInfo['image']=$ImgName;
//        }
        if($this->user->update($id, $userInfo)){
             $a = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $a->name. ' updated staff- ' .$user->name,
            'type' => 'staff'
        ]);
            alert()->success('Staff updated successfully', 'Success !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }else{
            alert()->error('Problem in updating staff', 'Oops !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=$this->user->find($id);
        if($this->user->delete($id)){
            $this->imageController->deleteImg('User',$user->image);
            $a = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $a->name. ' deleted staff- ' .$user->name,
            'type' => 'staff'
        ]);
            alert()->success('Staff deleted successfully', 'Success !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }else{
         alert()->error('Problem in deleting staff', 'Oops !!!')->persistent('Close');
            return redirect()->route('staff.index');
        }
    }
    
    public function resetStaffPassword($staffId)
    {
        $password = 'klientscape';
        $pw = bcrypt($password);
        DB::table('users')->where('id', $staffId)
            ->update(['password' => $pw]);

        $selectedUser = DB::table('users')->where('id', $staffId)->first();
        $data=array(
            'from'=>$selectedUser->email,
            'password'=>$password,
            'user_name'=>$selectedUser->name,
        );
        Mail::send('emails.user-password-reset-mail',$data,function ($message) use ($data){
            $message->from(SITE_MAIL_EMAIL);
            $message->to($data['from']);
            $message->subject('Password Reset');
        });
        $a = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $a->name. ' reset password of staff- ' .$selectedUser->name,
            'type' => 'resetpw'
        ]);
       alert()->success('Password reset & sent successfully', 'Success !!!')->persistent('Close');
            return redirect()->route('staff.index');
    }
}
