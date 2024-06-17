@extends('layouts.super-admin.layouts')
@section('page-specific-css')
    <!-- Bootstrap Select Css -->
@stop
@section('content')
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
                                        <h5 class="m-b-10">Add Client</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('client.index')}}">Client</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add Client</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="clientForm" method="post" action="{{route('client.store')}}" enctype="multipart/form-data" autocomplete="off" data-parsley-validate novalidate>
                        {!! csrf_field() !!}
                        @include('super-admin.user.client.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-specific-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
     <script type="text/javascript">
        $(document).ready(function () {
            $("#clientForm").submit(function (e) {
              window.swal({
              title: "Loading...",
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
