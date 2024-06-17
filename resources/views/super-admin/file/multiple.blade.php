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
                                        <h5 class="m-b-10">Add File</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('file.index')}}">File</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add File</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="multiplefileForm" method="post" action="{{route('file.multiple.store')}}" enctype="multipart/form-data" autocomplete="off" data-parsley-validate novalidate>
                        {!! csrf_field() !!}
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- [ Main Content ] start -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- [ form-element ] start -->
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>File Information</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type = "hidden" value = "{{Auth::user()->id}}" name = "user_id" readonly>
                                                            <input type = "hidden" value = "{{Auth::user()->role}}" name = "user_role" readonly>
                                                            <div class="form-group">
                                                                <label for="client_id">Client <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="client_id" name="client_id" required>
                                                                <option value="">Choose Client</option>
                                                                @foreach ($clients as $client)
                                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                                @endforeach   
                                                                </select>
                                                            </div>
                                                            <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                                            <div class="form-group">
                                                                <label for="status">Select Folder to upload <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="folder_id" name="folder_id" required>
                                                                    <?php
                                                                    $options = \App\Helpers\TreeHelper::selectOptions('folders', $base_id = 0, $id = null, $terms = null, $order_by = 'title', $order = 'asc');
                                                                    ?>
                                                                        @foreach($options as $k=> $option)
                                                                            <option value="{{$k}}" {{ old('folder_id', isset($file->folder_id) ? $file->folder_id : '')==$k?'selected="selected"':''}}>{{$option}}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <span class="text-danger">{{ $errors->first('folder_id') }}</span>
                                                           
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                     <label>Upload File <span class="text-danger">*</span> <br>
                                                                        <small class="text-info">File size should be less than 50MB.</small></label>
                                                                       <input type="file" class="form-control" name="file[]" multiple>
                                                                    </div>
                                                            <span class="text-danger">{{ $errors->first('file') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- [ form-element ] start -->
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Action</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            $("#multiplefileForm").submit(function (e) {
              window.swal({
                title: 'Wait!!',
                text: "Loading...",
                type: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                allowEscapeKey :false
            });
                return true;
            });
        });
        
    </script>
@endsection
