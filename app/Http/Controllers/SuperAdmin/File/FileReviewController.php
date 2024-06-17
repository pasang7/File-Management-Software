<?php
namespace App\Http\Controllers\SuperAdmin\File;

use App\Models\Model\SuperAdmin\User\User;
use App\Models\Service\SuperAdmin\File\FileReviewService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\DbHelper as DbHelper;
use App\Models\Model\SuperAdmin\File\File;
use App\Notifications\File\FileReviewApproveNotification;
use App\Notifications\File\FileReviewNotification;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FileReviewController extends Controller
{
    protected $fileReview;
    function __construct(FileReviewService $fileReview)
    {
        $this->fileReview=$fileReview;
    }

    public function index()
    {
        $data['fileReviews']=$this->fileReview->paginate();
        return view('super-admin.file.review.index',$data);
    }

    public function reviewForm($fileId)
    {
        $data['file'] = File::with('reviews')->where('id', $fileId)->first();
        return view('super-admin.file.review.create',$data);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'staff_id'=>'required',
            'file_id'=>'required',
            'title'=>'required',
            'remark'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $fileReviewInfo=$request->all();
        $fileReviewInfo['remark'] = '<pre>'.$request->get('remark').'</pre>';
        // dd($fileReviewInfo);
        if($this->fileReview->create($fileReviewInfo)){
            $file = File::where('id',$request->file_id)->first(); 
            $file->review = 'ongoing';
            $file->update();
            $sentUser = User::where('id', Auth::user()->id)->first();
            $receivedUsers = User::whereIn('id', ['2',$file->user_id])->where('status', 'active')->get();
                foreach($receivedUsers as $receivedUser){
                    $receivedUser->notify(new FileReviewNotification($receivedUser, $sentUser, $file));
                }
            DB::table('activity_logs')->insert([
                'message' => $sentUser->name. ' reviewed file - ' .$file->title,
                'type' => 'review',
                'created_at' => now(),
                'updated_at' => now()
            ]);
       
            Alert::success('Success !!!', 'File reviewed successfully')->persistent('Close');
            return redirect()->route('file.index');
        }else{
            Alert::error('Oops !!!', 'Problem in reviewing file')->persistent('Close');
            return redirect()->route('file.index');
        }
    }

    public function show($fileId)
    {
        $data['file'] = File::where('id', $fileId)->first();
        return view('super-admin.file.review.details',$data);
    }
}
