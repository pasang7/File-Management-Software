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
                                        <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i
                                                    class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('otherfile.index') }}">File</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add File</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="fileForm" method="post" action="{{ route('file.store') }}" enctype="multipart/form-data"
                        autocomplete="off" data-parsley-validate novalidate>
                        {!! csrf_field() !!}
                        <?php
                        $imgExtensionArray = ['jpeg', 'jpg', 'png', 'gif'];
                        $excelExtensionArray = ['xls', 'xlsx', 'csv'];
                        $wordExtensionArray = ['doc', 'docx'];
                        if (isset($file['filename']) && $file['filename'] !== '') {
                            $isImage = 'false';
                            $isExcel = 'false';
                            $isDoc = 'false';
                            $extension = pathinfo($file['filename'], PATHINFO_EXTENSION);
                            if (in_array($extension, $imgExtensionArray)) {
                                $isImage = 'true';
                            }
                            if (in_array($extension, $excelExtensionArray)) {
                                $isExcel = 'true';
                            }
                            if (in_array($extension, $wordExtensionArray)) {
                                $isDoc = 'true';
                            }
                        }
                        ?>
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
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="user_id" readonly>
                                                            <input type="hidden" value="{{ Auth::user()->role }}"
                                                                name="user_role" readonly>
                                                            @if (Auth::user()->role != 'others')
                                                                <input type="hidden" value="{{ $client->id }}"
                                                                    name="client_id" readonly>
                                                            @else
                                                                <input type="hidden" value="{{ Auth::user()->id }}"
                                                                    name="client_id" readonly>
                                                            @endif
                                                            <div class="form-group">
                                                                <label>Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title"
                                                                    value="{{ old('title', isset($file->title) ? $file->title : '') }}"
                                                                    placeholder="Enter File Title" parsley-trigger="change"
                                                                    required>
                                                            </div>
                                                            <span
                                                                class="text-danger">{{ $errors->first('title') }}</span>
                                                            <div class="row">
                                                                <div class="@if (isset($file->filename))col-md-9 @else col-md-12 @endif">
                                                                    <div class="form-group">
                                                                        <label>Upload File <span
                                                                                class="text-danger">*</span> <br>
                                                                            <small class="text-info">File size should
                                                                                be less than
                                                                                50MB.</small></label>
                                                                        <input type="file" class="form-control"
                                                                            id="filename" name="filename"
                                                                            value="{{ old('filename', isset($file->filename) ? $file->filename : '') }}"
                                                                            @if (!isset($file->filename))required @endif>

                                                                        <span
                                                                            class="text-danger">{{ $errors->first('filename') }}</span>
                                                                    </div>
                                                                </div>
                                                                @if (isset($file->filename))
                                                                    <div class="col-md-3">
                                                                        @if (isset($file->filename) && $isImage == 'true')
                                                                            <div class="image-trap">
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    target="_blank">
                                                                                    <img class="img-thumbnail image_list"
                                                                                        src="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                        alt="no image">
                                                                                    <br>
                                                                                    <span>{{ $file->filename }}</span>
                                                                                </a>
                                                                            </div>
                                                                        @elseif(isset($file->filename) && $isExcel == 'true')
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                class=" img-responsive">
                                                                                <img src="{{ asset('resources/front-end/images/excel.png') }}"
                                                                                    alt="No Excel File" width="40"><br>
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @elseif(isset($file->filename) && $isDoc == 'true')
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                class=" img-responsive">
                                                                                <img src="{{ asset('resources/front-end/images/doc.png') }}"
                                                                                    alt="No Excel File" width="40"><br>
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                target="_blank">
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="remark">Description [If Any]</label>
                                                                <textarea name="remark" rows="5" class="form-control"
                                                                    placeholder="Enter remarks here.">{{ old('remark', isset($file->remark) ? $file->remark : '') }}</textarea>
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
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select class="form-control" id="status" name="status"
                                                                    required>
                                                                    <option value="active"
                                                                        {{ old('status', isset($file->status) ? $file->status : '') == 'active' ? 'selected="selected"' : '' }}>
                                                                        Active</option>
                                                                    <option value="in_active"
                                                                        {{ old('status', isset($file->status) ? $file->status : '') == 'in_active' ? 'selected="selected"' : '' }}>
                                                                        Inactive</option>
                                                                </select>
                                                            </div>
                                                            <span
                                                                class="text-danger">{{ $errors->first('status') }}</span>
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="fas fa-paper-plane"></i>
                                                                Submit</button>
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
        $(document).ready(function() {
            $("#fileForm").submit(function(e) {
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
