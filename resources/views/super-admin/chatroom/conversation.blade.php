@extends('layouts.super-admin.layouts')
@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">ChatRoom</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Chatroom</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ message ] start -->
                                <div class="col-sm-12">
                                    <div class="card msg-card mb-0">
                                        <div class="card-body msg-block">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12">
                                                    <div class="message-mobile">
                                                        <div class="task-right-header-status">
                                                            <span class="f-w-400" data-toggle="collapse">Friend List</span>
                                                            <i class="fas fa-times float-right m-t-10"></i>
                                                        </div>
                                                        <div class="taskboard-right-progress">
                                                            <div class="h-list-header">
                                                                <div class="input-group">
                                                                    <input type="text" id="msg-friends" class="form-control" placeholder="Search Friend . . .">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class='fas fa-search'></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="h-list-body">
                                                                <div class="msg-user-list scroll-div">
                                                                    <div class="main-friend-list">
                                                                        @if($users->count()>0)
                                                                            @foreach($users as $k=>$user)
                                                                            <?php 
                                                                            $unread_message = \App\Models\Model\SuperAdmin\Chatroom\Chatroom::where('sender_id', $user->id)
                                                                            ->where('receiver_id', Auth::user()->id)->where('is_read', 'no')->get();
                                                                            ?>
                                                                              <a href="{{route('chatroom.conversation',$user->id)}}">
                                                                                    <div class="media userlist-box @if($user->id == $friendInfo->id) active @endif" data-id="{{$k + 1}}" data-status="online" data-username="{{$user->name}}">
                                                                                        <a class="media-left" href="{{route('chatroom.conversation',$user->id)}}"><img class="media-object img-radius" src="{{asset('uploads/User/thumbnail/'.$user->user_image)}}" alt="{{$user->name}}">
                                                                                            @if($unread_message->count()>0) <div class="live-status">{{ count($unread_message) }}</div> @endif
                                                                                            
                                                                                        </a>
                                                                                        <a href="{{route('chatroom.conversation',$user->id)}}">
                                                                                            <div class="media-body" >
                                                                                                <h6 class="chat-header">{{$user->name}}
                                                                                                    {{--<small class="d-block text-c-green">Typing . . </small>--}}
                                                                                                </h6>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </a>
                                                                            @endforeach
                                                                        @endif
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-12">

                                                    <div class="ch-block">
                                                            <div class="h-list-body">
                                                                <h5 class="p-t-5 p-b-5 text-bold">{{$friendInfo->name}}</h5>
                                                               <div class="msg-user-chat scroll-div">
                                                                    <div class="main-friend-chat">
                                                                        @foreach($chats as $chat)
                                                                        
                                                                            @if($chat->sender_id == Auth::user()->id && $chat->receiver_id == $friendInfo->id)
                                                                                <div class="media chat-messages ">
                                                                                    <div class="media-body chat-menu-reply">
                                                                                        <div class="">
                                                                                            @if($chat->message)
                                                                                            <p class="chat-cont">{{$chat->message}}</p>
                                                                                            @endif
                                                                                            @if($chat->chatfiles)
                                                                                            @foreach($chat->chatfiles as $chatFile)
                                                                                                <a href = "{{asset('uploads/Chatfiles/'.$chatFile->filename)}}"  download="{{$chatFile->filename}}">
                                                                                                    <p class="chat-cont">{{$chatFile->filename}}</p>
                                                                                                </a>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </div>
                                                                                        <p class="chat-time">{{$chat->my_date}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @elseif($chat->sender_id == $friendInfo->id && $chat->receiver_id == Auth::user()->id)
                                                                                <div class="media chat-messages ">
                                                                                    <div class="media-body chat-menu-content ">
                                                                                        <div class="">
                                                                                            @if($chat->message)
                                                                                            <p class="chat-cont">{{$chat->message}}</p>
                                                                                            @endif
                                                                                            @if($chat->chatfiles)
                                                                                            @foreach($chat->chatfiles as $chatFile)
                                                                                                <a href = "{{asset('uploads/Chatfiles/'.$chatFile->filename)}}"  download="{{$chatFile->filename}}">
                                                                                                    <p class="chat-cont">{{$chatFile->filename}}</p>
                                                                                                </a>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </div>
                                                                                        <p class="chat-time">{{$chat->my_date}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="msg-form">
                                                              <form id="chatForm" action="{{route('chatroom.send')}}" method="post" enctype="multipart/form-data"  autocomplete="off" >
                                                                  @csrf
                                                                  <input type="hidden" id="receiver_id" name="receiver_id" value="{{$friendInfo->id}}">
                                                                  <input type="hidden" id="sender_id" name="sender_id" value="{{Auth::user()->id}}">

                                                                  <div class="form-group">
                                                                    <input type="file" multiple name="filename[]" id="filename" >
                                                                  </div>
                                                                  <div class="input-group">
                                                                      <input type="text" id="message" class="form-control msg-send-chat" placeholder="Type text here..." name="message">
                                                                      <div class="input-group-append">
                                                                          <button class="btn btn-theme btn-icon btn-msg-send" type="submit" title="send"><i class="fas fa-location-arrow"></i></button>
                                                                      </div>
                                                                  </div>
                                                              </form>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ message ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

@stop
@section('page-specific-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#msg-friends").on("keyup", function() {
                var g = $(this).val().toLowerCase();
                $(".msg-user-list .userlist-box .media-body .chat-header").each(function() {
                    var s = $(this).text().toLowerCase();
                    $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
                });
            });

            var ps = new PerfectScrollbar('.msg-user-list.scroll-div', {
                wheelSpeed: .5,
                swipeEasing: 0,
                suppressScrollX: !0,
                wheelPropagation: 1,
                minScrollbarLength: 40,
            });
            var ps = new PerfectScrollbar('.msg-user-chat.scroll-div', {
                wheelSpeed: .5,
                swipeEasing: 0,
                suppressScrollX: !0,
                wheelPropagation: 1,
                minScrollbarLength: 40,
            });

            $(".task-right-header-status").on('click', function() {
                $(".taskboard-right-progress").slideToggle();
            });

            $(".message-mobile .media").on('click', function() {
                var vw = $(window)[0].innerWidth;
                if (vw < 992) {
                    $(".taskboard-right-progress").slideUp();
                    $(".msg-block").addClass('dis-chat');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#chatForm").submit(function (e) {
                $("#btn-submit").attr("disabled", true);
              window.swal({
              title: "Sending...",
              text: "Please wait",
              icon: 'warning',
              showConfirmButton: false,
              allowOutsideClick: false
            });
                return true;
            });
        });
    </script>
@endsection