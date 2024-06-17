<?php

namespace App\Http\Controllers\SuperAdmin\Dashboard;

use App\Models\Model\SuperAdmin\User\User;
use App\Models\Service\SuperAdmin\User\UserService;
use App\Http\Controllers\Controller;
use App\Models\Model\SuperAdmin\Chatroom\Chatroom;
use App\Models\Model\SuperAdmin\File\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $user;
    function __construct(UserService $user )
    {
        $this->user=$user;
    }

    public function index()
    {
        $data['unreadnotifications'] = User::find(Auth::user()->id)->unreadNotifications()
        ->whereIn('type', ['App\Notifications\File\FileCreateNotification', 'App\Notifications\File\FileReviewNotification'])
        ->limit(5)->get();
        $data['notifications'] = User::find(Auth::user()->id)->notifications()->limit(5)->get();
        $data['total_users']=User::where('role', '!=', 'superadmin')->where('status', 'active')->get()->count();
        $data['total_admin']=User::where('role', 'admin')->where('status', 'active')->get()->count();
        $data['total_staff']=User::where('role', 'staff')->where('status', 'active')->get()->count();
        $data['total_clients']=User::where('role', 'others')->where('status', 'active')->get();
        $data['chatFromAdmin'] = Chatroom::where('receiver_id', Auth::user()->id)->where('is_read', 'no')->get();
        $data['filesByKS'] = File::whereIn('user_role', ['admin','staff'])->where('client_id', Auth::user()->id)->where('status', 'active')->get()->count();
        $data['myFiles'] = File::where('user_id', Auth::user()->id)->where('status', 'active')->get()->count();
        return view('super-admin.dashboard.index',$data);
    }
    public function allNotifications()
    {
        $unreadnotifications = User::find(Auth::user()->id)->unreadNotifications()->whereIn('type', ['App\Notifications\File\FileCreateNotification', 'App\Notifications\File\FileReviewNotification'])->get();
        $notifications = User::find(Auth::user()->id)->notifications()->whereIn('type', ['App\Notifications\File\FileCreateNotification', 'App\Notifications\File\FileReviewNotification'])->get();
        return view('super-admin.notification.index',compact('unreadnotifications', 'notifications'));
    }

    public function markAsReadNotification($id){
        $user = User::find($id);
        $user->unreadNotifications->markAsRead();
        Alert::success('Success !!!', 'All notifications are marked as read.')->persistent('Close');
        return redirect()->back();
    }
     
    public function markAsUnReadNotification($id){
        $user = User::find($id);
        $user->readNotifications->markAsUnread();
        Alert::success('Success !!!', 'All notifications are marked as unread.')->persistent('Close');
        return redirect()->back();
    }

}
