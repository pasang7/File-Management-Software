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
                                                                                <div class="media userlist-box" data-id="{{$k + 1}}" data-status="online" data-username="{{$user->name}}">
                                                                                    <a class="media-left" href="{{route('chatroom.conversation',$user->id)}}">
                                                                                        <img class="media-object img-radius" src="{{asset('uploads/User/thumbnail/'.$user->user_image)}}" alt="{{$user->name}}">
                                                                                        @if($unread_message->count()>0) <div class="live-status">{{ count($unread_message) }}</div> @endif
                                                                                    </a>
                                                                                    <a href="{{route('chatroom.conversation',$user->id)}}">
                                                                                        <div class="media-body" >
                                                                                            <h6 class="chat-header">
                                                                                                {{$user->name}}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-12">
                                                    <div class="col-md-12 startConvo">
                                                        <h5 class="m-10">Get Started</h5>
                                                        <img src="{{asset('resources/front-end/images/message.png')}}" width="100">
                                                        <p class="chat-cont m-20">
                                                           Start your conversation by selecting user.
                                                        </p>
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
            $('#OpenImgUpload').click(function() {
                $('#imgupload').trigger('click');
            });
//            $('.msg-send-chat').on('keyup', function(e) {
//                msg_cfc(e);
//            });
//            $('.btn-msg-send').on('click', function(e) {
//                msg_fc(e);
//            });
//
//            function msg_cfc(e) {
//                if (e.which == 13) {
//                    msg_fc(e);
//                }
//            };
//
//            function msg_fc(e) {
//                $('.msg-block .main-friend-chat').append('' +
//                    '<div class="media chat-messages">' +
//                    '<div class="media-body chat-menu-reply">' +
//                    '<div class="">' +
//                    '<p class="chat-cont">' + $('.msg-send-chat').val() + '</p>' +
//                    '</div>' +
//                    '<p class="chat-time">now</p>' +
//                    '</div>' +
//                    '</div>' +
//                    '');
//                msg_frc($('.msg-send-chat').val());
//                msg_fsc();
//                $('.msg-send-chat').val(null);
//            };

            function msg_frc(wrmsg) {
                setTimeout(function() {
                    $('.msg-block .main-friend-chat').append('' +
                        '<div class="media chat-messages typing">' +
                        '<a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="{{asset('resources/super-admin/images/user/user.jpg')}}" alt="Generic placeholder image"></a>' +
                        '<div class="media-body chat-menu-content">' +
                        '<div class="rem-msg">' +
                        '<p class="chat-cont">Typing . . .</p>' +
                        '</div>' +
                        '<p class="chat-time">now</p>' +
                        '</div>' +
                        '</div>' +
                        '');
                    msg_fsc();
                }, 1500);
                setTimeout(function() {
                    document.getElementsByClassName("rem-msg")[0].innerHTML = "<p class='chat-cont'>hello superior personality you write '" + wrmsg + " '</p>";
                    $('.rem-msg').removeClass("rem-msg");
                    $('.typing').removeClass("typing");
                    msg_fsc();
                }, 3000);
            };

            function msg_fsc() {
                var tmph = $('.header-chat .main-friend-chat');
                $('.msg-user-chat.scroll-div').scrollTop(tmph.outerHeight());
            }
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

@endsection