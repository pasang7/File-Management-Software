@extends('layouts.super-admin.layouts')
@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                @if($notifications->count()>0)
                                <div class="col-xl-12 col-md-12" style="margin-top:35px;">
                                    <div class="card note-bar">
                                        <div class="card-header">
                                            <h5>File Notifications @if(count($unreadnotifications) > 0) <span class="badge badge-info">{{ count($unreadnotifications) }}</span> @endif </h5>
                                           <div class="text-right">
                                                
                                                <a href="{{ route('mark.read', Auth::user()->id) }}" class="text-primary">Mark all as read</a>
                                             
                                               {{--  <a href="{{ route('mark.unread', Auth::user()->id) }}" class="text-dark">Mark all as unread</a> --}}
                                              
                                            </div>
                                        </div>
                                        <div class="card-block p-0">
                                            @foreach($notifications as $notification)
                                                <a href="{{ url('super-admin/file-notifications/'. $notification->id .'/'. $notification->data['file_id']) }}" class="media friendlist-box">
                                                    <div class="mr-3 photo-table">
                                                        <i class="far fa-bell f-30"></i>
                                                    </div>
                                                    <div class="media-body" @if($notification->read_at) @else style="font-weight: bold;" @endif>
                                                        <h6 @if($notification->read_at) @else style="font-weight: bold;" @endif>{{$notification->data['type']}}</h6>
                                                        <span class="f-12 float-right text-muted">{{date('d M, Y', strtotime($notification->created_at))}}</span>
                                                        <p class="text-muted m-0">{{$notification->data['text']}}</p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-xl-12 col-md-12" style="margin-top:35px;">
                                    <div class="card">
                                        <div class="card-block text-center">
                                            <h4 class="text-info">You don't have any file notification.</h4>

                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
