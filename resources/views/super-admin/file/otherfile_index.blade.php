@extends('layouts.super-admin.layouts')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10"></h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Folders</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Clients</h5>
                                            <div class="text-right">
                                                <a href="{{route('file.create')}}"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> Upload File</button></a>
                                                <a href="{{route('file.multiple.create')}}"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> Upload Multiple Files</button></a>
                                                <a href="{{route('folder.create')}}"><button type="button" class="btn btn-warning"><i class="fas fa-folder"></i> New Folder</button></a>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row">
                                                @foreach ($clients as $client)
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('page-specific-scripts')
@endsection