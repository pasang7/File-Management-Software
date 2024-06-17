<?php

namespace App\Http\Controllers\SuperAdmin\Chatroom;

use App\Http\Controllers\ImageController;
use App\Http\Requests\SuperAdmin\Chatroom\ChatroomRequest;
use App\Models\Model\SuperAdmin\Chatroom\Chatroom;
use App\Models\Model\SuperAdmin\User\User;
use App\Models\Service\SuperAdmin\Chatroom\ChatroomService;
use App\Notifications\ChatNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Helpers\DbHelper as DbHelper;
use App\Models\Model\SuperAdmin\ChatFile\ChatFile;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ChatroomController extends Controller
{
   protected $chatroom;
    protected $imageController;
    function __construct(ChatroomService $chatroom, ImageController $imageController)
    {
        $this->chatroom=$chatroom;
        $this->imageController=$imageController;
    }

    public function index()
    {
        if(Auth::user()->role == 'others'){
            $users = User::where('id', '!=', Auth::user()->id)
                ->where('role', 'admin')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $users = User::where('id', '!=', Auth::user()->id)
                ->where('role', 'others')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $users->append('user_image');
        $chatNotifications =User::find(Auth::user()->id)->unreadNotifications()
        ->where('type', 'App\Notifications\ChatNotification')
        ->get();

        return view('super-admin.chatroom.index', compact('users','chatNotifications'));
    }

    public function conversation($userId){
       
        DB::table('chatrooms')->where('sender_id',$userId )
        ->where('receiver_id', Auth::user()->id)->where('is_read', 'no')->update(['is_read' => 'yes']);
        
        if(Auth::user()->role == 'others'){

            $data['users'] =$users = User::where('id', '!=', Auth::user()->id)
                ->where('role', 'admin')
                ->orderBy('created_at', 'desc')->get();

            $users->append('user_image');

        }else{

            $data['users'] = $users = User::where('id', '!=', Auth::user()->id)
                ->where('role', 'others')
                ->orderBy('created_at', 'desc')->get();

            $users->append('user_image');

        }

        $data['friendInfo'] = $receiver = User::findOrFail($userId);

        $data['myInfo'] = $sender = User::find(Auth::user()->id);


        $data['chats'] = $chats = Chatroom::with(array('chatfiles' => function($query) {
            $query->orderBy('order', 'asc')->get();
        }))->orderBy('order','asc')->get();

        $data['my_date'] = $chats->append('my_date');

        $user = User::where('id', Auth::user()->id)->first();
        DB::table('activity_logs')->insert([
            'message' => $user->name. ' sent a chat.'
        ]);
    
        return view('super-admin.chatroom.conversation', $data);
    }

    public function sendChat(Request $request)
    {
        $chatroomInfo=$request->all();
        $chatroomInfo['order']=DbHelper::nextSortOrder('chatrooms');
        if($this->chatroom->create($chatroomInfo)){
            $recentChat = Chatroom::latest('created_at')->first(); 
            if($request->file('filename')){
                foreach ($request->file('filename') as $file) {
                    $rules = array(
                        'filename' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf,csv,xls,xlsx|max:50000'
                    );
                    $validator = validator(array('filename' => $file), $rules);
                    if ($validator->fails()) {
                        return back()->withInput()->withErrors($validator);
                    }
                    $chatFileInfo = new ChatFile();
                    $chatFileInfo->chat_id = $recentChat->id;
                    $chatFileInfo->order = DbHelper::nextSortOrder('chat_files');
                    $folder_name = 'Chatfiles';
                    $ImgName = $this->imageController->saveChatFiles($file,$folder_name);
                    $chatFileInfo->filename = $ImgName;
                    $chatFileInfo->save();
                }
            }

            $receivedUser = User::where('id', $request->receiver_id)->first();
            $sentUser = User::where('id', Auth::user()->id)->first();
            $receivedUser->notify(new ChatNotification($receivedUser, $sentUser));
            // dd($user);
            // Alert::success('Success !!!', 'Message Sent')->persistent('Close');
            return redirect()->back();
        }else{
            Alert::error('Oops !!!', 'Unable to sent message')->persistent('Close');
            return redirect()->route('chatroom.conversation', $request->receiver_id);
        }
    }

}
