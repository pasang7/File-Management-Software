@if (Auth::user()->is_new == '0')
    @extends('layouts.super-admin.layouts')
    @section('content')
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="row">
                                    <!--@if (count($unreadnotifications) > 0)-->
                                    <!--    <div class="col-xl-12 col-md-12" style="margin-top:35px;">-->
                                    <!--        <div class="card note-bar">-->
                                    <!--            <div class="card-header">-->
                                    <!--                <h5>File Notifications @if (count($unreadnotifications) > 0) <span class="badge badge-info">{{ count($unreadnotifications) }}</span> @endif </h5>-->
                                    <!--            </div>-->
                                    <!--            <div class="card-block p-0">-->
                                    <!--                @foreach ($unreadnotifications as $notification)-->
                                    <!--                    <a href="{{ url('super-admin/file-notifications/' . $notification->id . '/' . $notification->data['file_id']) }}"-->
                                    <!--                        class="media friendlist-box">-->
                                    <!--                        <div class="mr-3 photo-table">-->
                                    <!--                            <i class="far fa-bell f-30"></i>-->
                                    <!--                        </div>-->
                                    <!--                        <div class="media-body" @if ($notification->read_at) @else style="font-weight: bold;" @endif>-->
                                    <!--                            <h6 @if ($notification->read_at) @else style="font-weight: bold;" @endif>-->
                                    <!--                                {{ $notification->data['type'] }}</h6>-->
                                    <!--                            <span-->
                                    <!--                                class="f-12 float-right text-muted">{{ date('d M, Y', strtotime($notification->created_at)) }}</span>-->
                                    <!--                            <p class="text-muted m-0">{{ $notification->data['text'] }}-->
                                    <!--                            </p>-->
                                    <!--                        </div>-->
                                    <!--                    </a>-->
                                    <!--                @endforeach-->
                                    <!--                @if ($unreadnotifications->count() > 5)-->
                                    <!--                    <div class="col-md-12 text-right">-->
                                    <!--                        <a href="{{ route('view.all-notification') }}">-->
                                    <!--                            <button class="btn btn-outline-dark"> View All-->
                                    <!--                                Notification</button>-->
                                    <!--                        </a>-->
                                    <!--                    </div>-->
                                    <!--                @endif-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--@endif-->
                                    @if (Auth::user()->role == 'others')
                                        @includeIf('super-admin.dashboard.client_section')
                                    @else
                                        @includeIf('super-admin.dashboard.admin_section')
                                    @endif
                                    <div class="col-md-12 col-xl-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('file.create') }}">
                                                    <div class="card bg-c-purple bitcoin-wallet">
                                                        <div class="card-block">
                                                            <h5 class="text-white mb-2">Files</h5>
                                                            <h2 class="text-white mb-2 f-w-300"></h2>
                                                            <span class="text-white d-block">Upload New File</span>
                                                            <i class="fas fa-file f-70 text-white"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            
                                            <div class="col-6">
                                                <a href="{{ route('file.multiple.create') }}">
                                                    <div class="card bg-c-green bitcoin-wallet">
                                                        <div class="card-block">
                                                            <h5 class="text-white mb-2">Files</h5>
                                                            <h2 class="text-white mb-2 f-w-300"></h2>
                                                            <span class="text-white d-block">Upload Multiple Files</span>
                                                            <i class="fas fa-copy f-70 text-white"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                       
                                        <a href="{{ route('file.index') }}">
                                            <div class="card bg-c-blue bitcoin-wallet">
                                                <div class="card-block">
                                                    <h5 class="text-white mb-2">File History</h5>
                                                    <h2 class="text-white mb-2 f-w-300"></h2>
                                                    <span class="text-white d-block">View All Files</span>
                                                    <i class="fas fa-stream f-70 text-white"></i>
                                                </div>
                                            </div>
                                        </a>
                                        {{-- <div class="card">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col">
                                                        <i class="fas fa-comment f-30 text-c-green"></i>
                                                        <h6 class="m-t-20 m-b-0">Chat With Clients</h6>
                                                    </div>
                                                    <div class="col text-right">
                                                        @if (Auth::user()->role == 'others')
                                                            <h3 class="text-c-green f-w-300">{{ $chatFromAdmin->count() }}
                                                            </h3>
                                                            <a href="{{ route('chatroom.conversation', 2) }}">
                                                                <span class="text-muted d-block">New Message</span>
                                                            </a>
                                                            <span class="badge theme-bg text-white m-t-20"></span>
                                                        @else
                                                            <a href="{{ route('chatroom.index') }}">
                                                                <button class="btn btn-success">Show Chat List</button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    @if (Auth::user()->role != 'others')
                                        <div class="col-xl-12 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Clients</h5>
                                                    <div class="text-right">
                                                        <a href="{{route('folder.create')}}"><button type="button" class="btn btn-warning"><i class="fas fa-folder"></i> New Folder</button></a>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        @foreach ($total_clients as $client)
                                                         <div class="col-2 text-center">
                                                            <a href="{{ route('folder-by-client', $client->id) }}">
                                                                <img src="{{ asset('resources/super-admin/images/folder.png') }}" width="70">
                                                                <h6>{{ $client->name }} <span class="badge badge-info">{{count($client->folders)>0 ? count($client->folders) : '' }}</span></h6> 
                                                            </a>
                                                         </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
@else
    @includeIf('super-admin.login.changepw')
@endif
