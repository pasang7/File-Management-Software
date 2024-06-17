@if(Auth::user()->is_new == '0')

<?php
function current_page($url = "/"){
    return strstr(request()->path(), $url);
}
?>
<body class="box-layout">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar navbar-collapsed">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{route('superadmin.dashboard')}}" class="b-brand">
                <img src="{{asset('resources/super-admin/images/logo-white.png')}}" style="width: 150px;">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{Auth::user()->name}}</label>
                </li>
                <li data-username="dashboard " class="{{ (current_page('super-admin/dashboard')) ? 'nav-item active pcoded-trigger' : '' }}">
                    <a href="{{route('superadmin.dashboard')}}" class="nav-link"><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                @if(Auth::user()->role=='superadmin' || Auth::user()->role=='admin')
                <li data-username="profile " class="{{ (current_page('chatroom')) ? 'nav-item active pcoded-trigger' : '' }}">
                    <a href="{{route('chatroom.index')}}" class="nav-link"><span class="pcoded-micon"><i class="fas fa-comment"></i></span><span class="pcoded-mtext">ChatRoom</span></a>
                </li>
                <li data-username="Gallery Grid Masonry Advance" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fa fa-users-cog"></i></span><span class="pcoded-mtext">Users</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{route('user.index')}}" class="">Admin</a></li>
                        <li class=""><a href="{{route('staff.index')}}" class="">Staff</a></li>
                    <li class=""><a href="{{route('client.index')}}" class="">Client</a></li>
                    </ul>
                </li> 
                @else
                <li data-username="Gallery Grid Masonry Advance" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fa fa-users-cog"></i></span><span class="pcoded-mtext">Users</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{route('staff.index')}}" class="">Staff</a></li>
                        <li class=""><a href="{{route('client.index')}}" class="">Client</a></li>
                    </ul>
                </li> 
                @endif
                @if(Auth::user()->role=='superadmin' || Auth::user()->role=='admin' || Auth::user()->role=='staff')
                <li data-username="icons Feather Fontawsome flag material simple line themify" class="{{ (current_page('folder')) ? 'nav-item active pcoded-trigger' : '' }}">
                    <a href="{{route('folder.index')}}" class="nav-link"><span class="pcoded-micon"><i class="fas fa-folder-open"></i></span><span class="pcoded-mtext">Folder</span></a>
                </li>
                @endif
                <li data-username="Gallery Grid Masonry Advance" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fas fa-file-archive"></i></span><span class="pcoded-mtext">File Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('file.create')}}">Upload Files</a></li>
                        <li><a href="{{route('file.multiple.create')}}">Upload Multiple Files</a></li>
                        <li><a href="{{route('file.index')}}">File List</a></li>
                        <li><a href="{{route('otherfile.index')}}">{{ Auth::user()->role=='others' ? 'Others' : 'Client Files' }}</a></li>
                        <li><a href="{{route('file.archive')}}">Archives</a></li>
                    </ul>
                </li>
                @if(Auth::user()->role=='admin')
                <li data-username="system-log " class="{{ (current_page('system-logs')) ? 'nav-item active pcoded-trigger' : '' }}">
                    <a href="{{route('system.logs')}}" class="nav-link"><span class="pcoded-micon"><i class="fas fa-exclamation-triangle"></i></span><span class="pcoded-mtext">System Logs</span></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
@endif