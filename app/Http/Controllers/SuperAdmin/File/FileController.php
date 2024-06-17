<?php
namespace App\Http\Controllers\SuperAdmin\File;

use App\Http\Controllers\ImageController;
use App\Http\Requests\SuperAdmin\File\FileRequest;
use App\Models\Model\SuperAdmin\File\File;
use App\Models\Model\SuperAdmin\User\User;
use App\Models\Service\SuperAdmin\File\FileService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\DbHelper as DbHelper;
use App\Models\Model\SuperAdmin\Folder\Folder;
use App\Models\Service\SuperAdmin\Folder\FolderService;
use App\Notifications\File\FileCreateNotification;
use App\Notifications\File\FileUpdateNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FileController extends Controller
{
   protected $file;
    protected $imageController;
    protected $folder;
    function __construct(FileService $file, ImageController $imageController, FolderService $folder)
    {
        $this->file=$file;
        $this->imageController=$imageController;
        $this->folder=$folder;
    }
    public function parent($id, $clientId)
    {
        $data['client']=$client= User::where('id', $clientId)->firstOrFail();
        $data['folders']=$this->folder->parentPaginate($id);
        $data['parents']=$this->folder->all();
        return view('super-admin.folder.parentwise_folder',$data);
    }
    
    public function myFileIndex()
    {
        $files = File::where('user_id', Auth::user()->id)->orderBy('order','desc')->paginate(50);
        return view('super-admin.file.myfile_index',compact('files'));
    }
    public function otherFileIndex()
    {
        if(Auth::user()->role == "others"){
            $data['client'] = User::where('id', Auth::user()->id)->first();
            $data['other_files'] = File::where('client_id', Auth::user()->id)->whereIn('user_role', ['admin','staff'])->orderBy('order','desc')->paginate(50);
            return view('super-admin.file.otherfile_list',$data);
        }else{
            $data['clients'] = User::where('role', 'others')->where('status', 'active')
            ->orderBy('name')
           ->get();
            return view('super-admin.file.otherfile_index', $data);
        }
    }
    public function otherFileList($client_id)
    {
        $data['client'] = User::where('id', $client_id)->first();
        if(Auth::user()->role == 'others'){
            $data['other_files'] = File::where('client_id', $client_id)->whereIn('user_role', ['admin','staff'])->orderBy('order','desc')->paginate(50);
        }else{
            $data['other_files'] = File::where('client_id', $client_id)->whereIn('user_role', ['others','staff'])->orderBy('order','desc')->paginate(50);
        }
        return view('super-admin.file.otherfile_list',$data);
    }
    public function index()
    {
        $data['files'] = File::where('user_id', Auth::user()->id)->orderBy('order','desc')->paginate(50);
        if(Auth::user()->role == 'others'){
            $data['client'] = User::where('id', Auth::user()->id)->first();
            $data['other_files'] = File::where('client_id', Auth::user()->id)->whereIn('user_role', ['admin','staff'])->orderBy('order','desc')->paginate(50);
        }else{
            $data['other_files'] = File::where('user_id','!=', Auth::user()->id)->whereIn('user_role', ['others','staff'])->orderBy('order','desc')->paginate(50);
        }
        return view('super-admin.file.index',$data);
    }

    public function multipleFileCreate()
    {
        $data['clients'] = User::where('role', 'others')->where('status', 'active')->orderBy('name')->get();
        return view('super-admin.file.multiple', $data);
    }
    public function multipleFilestore(Request $request)
    {
        ini_set('max_execution_time', 3000);
        $files = $request->file('file');
        if(!empty($files)){
            foreach($files as $file){
                $rules = array(
                    'file' => 'required|mimes:jpeg,jpg,png,gif,doc,docx,pdf,csv,xls,xlsx,pptx,zip|max:100000'
                );
                $validator = validator(array('file' => $file), $rules);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
                $fileInfo = $request->all();
                $folder_name='File';
                $ImgName=$this->imageController->saveMultipleFile($file,$folder_name);
                $fileInfo['filename']=$ImgName;                
                $fileInfo['title']=$ImgName;                
                $fileInfo['order']=DbHelper::nextSortOrder('files');
                $this->file->create($fileInfo);
                $latest_file = File::latest('created_at')->first(); 
                $sentUser = User::where('id', Auth::user()->id)->first();
                if(Auth::user()->role == 'admin'){
                    $receivedUsers = User::where('role', 'others')->where('is_verified', '1')
                    ->where('status', 'active')->get();
                    foreach($receivedUsers as $receivedUser){
                        $receivedUser->notify(new FileCreateNotification($receivedUser, $sentUser, $latest_file));
                    }
                }else{
                    $receivedUsers = User::whereIn('role', ['admin','staff'])->where('status', 'active')->get();
                    foreach($receivedUsers as $receivedUser){
                        $receivedUser->notify(new FileCreateNotification($receivedUser, $sentUser, $latest_file));
                    }
                }
                DB::table('activity_logs')->insert([
                    'message' => $sentUser->name. ' uploaded new file with name ' .$latest_file->filename,
                    'type' => 'file'
                ]);
            }
                    Alert::success('Success !!!', 'File created successfully')->persistent('Close');
                    return redirect()->route('myfile.index');
        }
    }
    public function create()
    {
        $data['clients'] = User::where('role', 'others')->where('status', 'active')->orderBy('name')->get();
        return view('super-admin.file.create', $data);
    }
    public function relatedClientFileCreate($clientId)
    {
        $data['client'] = User::where('id', $clientId)->first();
        return view('super-admin.file.create-with-client', $data);
    }
    
    public function store(FileRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'filename'=>'required|mimes:jpeg,jpg,png,gif,doc,docx,pdf,csv,xls,xlsx,pptx,zip|max:100000',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $fileInfo=$request->all();
        // dd($fileInfo);
        $fileInfo['slug'] = Str::slug($request->get('title'));
        $fileInfo['order']=DbHelper::nextSortOrder('files');
        $folder_name='File';
        if($request->file('filename')){
            $ImgName=$this->imageController->uploadAnyFile($request,$folder_name,'filename');
            $fileInfo['filename']=$ImgName;
        }
        if($this->file->create($fileInfo)){
            $latest_file = File::latest('created_at')->first(); 
            $sentUser = User::where('id', Auth::user()->id)->first();
            if(Auth::user()->role == 'admin'){
                $receivedUsers = User::where('role', 'others')->where('is_verified', '1')
                ->where('status', 'active')->get();
                foreach($receivedUsers as $receivedUser){
                    $receivedUser->notify(new FileCreateNotification($receivedUser, $sentUser, $latest_file));
                }
            }else{
                $receivedUsers = User::whereIn('role', ['admin','staff'])->where('status', 'active')->get();
                foreach($receivedUsers as $receivedUser){
                    $receivedUser->notify(new FileCreateNotification($receivedUser, $sentUser, $latest_file));
                }
            }

            DB::table('activity_logs')->insert([
                'message' => $sentUser->name. ' uploaded new file with name ' .$latest_file->title,
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now()
            ]);
       
            Alert::success('Success !!!', 'File created successfully')->persistent('Close');
            return redirect()->route('file.index');
        }else{
            Alert::success('Success !!!', 'Problem in creating file')->persistent('Close');
            return redirect()->route('file.index');
        }
    }

    public function readFile($notificationId, $fileId)
    {
        $file = File::where('id', $fileId)->first();
       
        if(!empty($file)){
        $notification = User::find(Auth::user()->id)->notifications()->find($notificationId);
        if($notification) 
        {
            $notification->markAsRead();
        }
        return view('super-admin.file.file_notification',compact('file')); 
        }
        
        Alert::error('Oops !!!', 'The file has been removed')->persistent('Close');
            return redirect()->back();
         
    }

    public function edit($id)
    {
        $file=$this->file->find($id);
        $data['clients'] = User::where('role', 'others')->where('status', 'active')->get();
        return view('super-admin.file.edit',$data,compact('file'));
    }
    public function update(FileRequest $request, $id)
    {
        $fileInfo=$request->all();
        $fileInfo['slug'] = Str::slug($request->get('title'));
        $file=$this->file->find($id);
        $folder_name='File';
        if($request->file('filename')==''){
            $fileInfo['filename']=$file->filename;
        }
        else{
            \Illuminate\Support\Facades\File::delete(public_path('uploads/File/'.$file->filename));
                $ImgName=$this->imageController->uploadAnyFile($request,$folder_name,'filename');
                $fileInfo['filename']=$ImgName;
        }
        if($this->file->update($id, $fileInfo)){
            $latest_file = File::where('id',$id)->first(); 
            $sentUser = User::where('id', Auth::user()->id)->first();
            if(Auth::user()->role == 'admin'){
                $receivedUsers = User::where('role', 'others')->where('is_verified', '1')
                ->where('status', 'active')->get();
                foreach($receivedUsers as $receivedUser){
                    $receivedUser->notify(new FileUpdateNotification($receivedUser, $sentUser, $latest_file));
                }
            }else{
                $receivedUsers = User::where('role', '!=','others')->where('status', 'active')->get();
                foreach($receivedUsers as $receivedUser){
                    $receivedUser->notify(new FileUpdateNotification($receivedUser, $sentUser, $latest_file));
                }
            }
            DB::table('activity_logs')->insert([
                'message' => $sentUser->name. ' updated a file ' .$latest_file->title,
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Alert::success('Success !!!', 'File updated successfully')->persistent('Close');
            return redirect()->route('file.index');
        }else{
        Alert::error('Oops !!!', 'Problem in updating file')->persistent('Close');
            return redirect()->route('file.index');
        }
    }

    public function destroy($id)
    {
        $file=$this->file->find($id);
        if($this->file->delete($id)){
        //    $this->imageController->deleteFile('File',$file->filename);
            $user = User::where('id', Auth::user()->id)->first();
            DB::table('activity_logs')->insert([
                'message' => $user->name. ' archived a file called ' . $file->title,
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Alert::success('Success !!!', 'File archived successfully')->persistent('Close');
        return redirect()->route('file.index');
        }else{
        Alert::error('Oops !!!', 'Unable to archived file')->persistent('Close');
        return redirect()->route('file.index');
        }
    }
    public function search()
    {
        $files=$this->file->search(str_slug($_GET['key']));
        $show_search='yes';
        return view('super-admin.file.index',compact('files','show_search'));
    }
    public function archive()
    {
        $files = File::onlyTrashed()->where('user_id', Auth::user()->id)->orderBy('deleted_at')->paginate(100);
        return view('super-admin.file.archive-index',compact('files'));
    }
    public function restoreArchive($fileId)
    {
        File::where('id', $fileId)->restore();
        $user = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $user->name. ' restored archived file.',
            'type' => 'file',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Alert::success('Success !!!', 'File restored successfully')->persistent('Close');
        return redirect()->route('file.archive');
    }
    public function deleteArchive($fileId)
    {
        $file=File::withTrashed()->where('id', $fileId)->first();
        \Illuminate\Support\Facades\File::delete(public_path('uploads/File/'.$file->filename));
        if($file->forceDelete()){
            $user = User::where('id', Auth::user()->id)->first();
            DB::table('activity_logs')->insert([
                'message' => $user->name. ' permanently deleted a file called ' .$file->title,
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Alert::success('Success !!!', 'File deleted successfully')->persistent('Close');
            return redirect()->route('file.archive');
        }
    }

    public function filesByFolder($id)
    {
        $data['model']=$folder= Folder::where('id', $id)->firstOrFail();
        $data['files']=DB::table('files')->WhereRaw('FIND_IN_SET('.$folder->id.',folder_id)')->orderBy('order','asc')->get();
        return view('front-end.file.file-list',$data);
    }

}
