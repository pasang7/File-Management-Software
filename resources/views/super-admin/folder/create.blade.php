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
                                        <h5 class="m-b-10">Add Folder</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('folder.index')}}">Folder</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add Folder</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{route('folder.store')}}" enctype="multipart/form-data" autocomplete="off" data-parsley-validate novalidate>
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
                                                    <h5>Folder Information</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="status">Folder Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="parent_id" name="parent_id" required>
                                                                    <?php
                                                                    if (isset($folder)) {
                                                                        $options = array(0 => 'None') + \App\Helpers\TreeHelper::selectOptions('folders', $base_id = 0, $id = $folder->id, $terms = null, $order_by = 'title', $order = 'asc');
                                                                    } else {
                                                                        $options = array(0 => 'None') + \App\Helpers\TreeHelper::selectOptions('folders', $base_id = 0, $id = null, $terms = null, $order_by = 'title', $order = 'asc');
                                                                    }
                                                                    ?>
                                                                        @foreach($options as $k=> $option)
                                                                            <option value="{{$k}}" {{ old('parent_id', isset($folder->parent_id) ? $folder->parent_id : '')==$k?'selected="selected"':''}}>{{$option}}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                                            <div class="form-group">
                                                                <label>Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="show_title" id="show_title" value="{{ old('show_title')}}" placeholder="Enter Folder Name" parsley-trigger="change" required>
                                                            </div>
                                                            <span class="text-danger">{{ $errors->first('show_title') }}</span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
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
                                                    <h5>Client </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>
                                                                    Choose Clients
                                                                </label>
                                                                @foreach($clients as $k=>$client)
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="client_id[]" class="custom-control-input" id="client{{ $k }}" value="{{ $client->id }}" {{ old('client_id', isset($folder->client_id) ? $folder->client_id : '') == $client->id? 'checked="checked"': '' }}>
                                                                    <label class="custom-control-label" for="client{{ $k }}">{{ $client->name }}</label>
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
                        </div >
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
@endsection
