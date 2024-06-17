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
                                        <li class="breadcrumb-item"><a href="javascript:">Logs</a></li>
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
                                <!-- [ configuration table ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>System Log</h5>
                                        </div>
                                        <div class="card-block">
                                            <ul class="nav nav-tabs" id="FileTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active text-uppercase" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">File Logs</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">File Review</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="staff-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="false">Staff Logs</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="client-tab" data-toggle="tab" href="#client" role="tab" aria-controls="client" aria-selected="false">Client Logs</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Credentials</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="LogTabContent">
                                                <div class="tab-pane fade show active" id="file" role="tabpanel" aria-labelledby="file-tab">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Activity</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($file_logs as $k => $log)
                                                                    <tr id="{{ $log->id }}">
                                                                        <th scope="row">{{ $k + 1 }}</th>
                                                                        <td>{{ $log->message }}</td>
                                                                        <td>{{ date('d M, Y', strtotime($log->created_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Activity</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($review_logs as $k => $log)
                                                                    <tr id="{{ $log->id }}">
                                                                        <th scope="row">{{ $k + 1 }}</th>
                                                                        <td>{{ $log->message }}</td>
                                                                        <td>{{ date('d M, Y', strtotime($log->created_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Activity</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($staff_logs as $k => $log)
                                                                    <tr id="{{ $log->id }}">
                                                                        <th scope="row">{{ $k + 1 }}</th>
                                                                        <td>{{ $log->message }}</td>
                                                                        <td>{{ date('d M, Y', strtotime($log->created_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="client" role="tabpanel" aria-labelledby="client-tab">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Activity</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($client_logs as $k => $log)
                                                                    <tr id="{{ $log->id }}">
                                                                        <th scope="row">{{ $k + 1 }}</th>
                                                                        <td>{{ $log->message }}</td>
                                                                        <td>{{ date('d M, Y', strtotime($log->created_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Activity</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($logs as $k => $log)
                                                                    <tr id="{{ $log->id }}">
                                                                        <th scope="row">{{ $k + 1 }}</th>
                                                                        <td>{{ $log->message }}</td>
                                                                        <td>{{ date('d M, Y', strtotime($log->created_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ configuration table ] end -->
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