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
                                        <h5 class="m-b-10">Add Review</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('otherfile.list', $file->client_id) }}">Files</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add Review</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('review.store') }}" enctype="multipart/form-data"
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (count($file->reviews) > 0)
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Review Summary</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="accordion" id="reviewList">
                                                                    @foreach ($file->reviews as $k => $review)
                                                                    @if(Auth::user()->id == 2  || Auth::user()->id == $review->staff_id || Auth::user()->id == $file->user_id)  
                                                                    <div class="card"
                                                                            style="background: transparent !important; box-shadow:none;">
                                                                            <a href="#!" data-toggle="collapse"
                                                                                data-target="#collapse{{ $k }}"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapse{{ $k }}">
                                                                                <div class="card-header"
                                                                                    id="heading{{ $k }}">
                                                                                    <h4 class="mb-0"
                                                                                        style="font-size:16px;">
                                                                                        <i
                                                                                            class="fas fa-check-circle text-success"></i>
                                                                                        {{ $review->title }}
                                                                                    </h4>
                                                                                    <div class="text-right">
                                                                                        By: {{ $review->user->name }}<br>
                                                                                        Date:
                                                                                        {{ date('d M, Y', strtotime($review->updated_at)) }}
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <div id="collapse{{ $k }}"
                                                                                class="card-body collapse @if ($k == 0) show @endif"
                                                                                aria-labelledby="heading{{ $k }}"
                                                                                data-parent="#reviewList" style="">
                                                                                {!! $review->remark !!}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Review Form</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-8 form-group">
                                                            <label>Reviewing On</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $file->title }}" readonly>
                                                        </div>
                                                        @if (isset($file->filename))
                                                            <div class="col-md-4">
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
                                                        <div class="col-12">
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="staff_id" readonly>
                                                            <input type="hidden" value="{{ $file->id }}" name="file_id"
                                                                readonly>
                                                            <div class="form-group">
                                                                <label>Subject <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title" value="{{ old('title') }}"
                                                                    placeholder="Enter Review Title"
                                                                    parsley-trigger="change" required>
                                                            </div>
                                                            <span
                                                                class="text-danger">{{ $errors->first('title') }}</span>
                                                            <div class="form-group">
                                                                <label for="remark">Remarks</label>
                                                                <textarea name="remark" rows="5" class="form-control"
                                                                    placeholder="Enter remarks.">{{ old('remark') }}</textarea>
                                                            </div>
                                                            <div class="col-md-12 text-right m-t-20">
                                                                <button type="submit" class="btn btn-success"><i
                                                                        class="fas fa-paper-plane"></i> Submit</button>
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
