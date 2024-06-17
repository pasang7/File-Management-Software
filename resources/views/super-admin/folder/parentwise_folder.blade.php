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
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Files & Folders</a></li>
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
                                            <h5>{{ $client->name }}</h5>
                                            {{-- <div class="text-right">
                                                <a href="{{ route('file.create') }}"><button type="button"
                                                        class="btn btn-dark"><i class="fas fa-plus"></i> Upload
                                                        File</button></a>
                                                <a href="{{ route('file.multiple.create') }}"><button type="button"
                                                        class="btn btn-dark"><i class="fas fa-plus"></i> Upload
                                                        Multiple Files</button></a>
                                            </div> --}}
                                        </div>
                                        <div class="card-block">
                                            <div class="row">
                                                @foreach ($folders as $folder)
                                                <div class="col-2 text-center">
                                                    <a
                                                        href="@if (count($folder->childs) > 0) {{ url('super-admin/subfolder/' . $folder->id . '/' . $client->id) }}  @else javascript:void(0); @endif">
                                                        <img src="{{ asset('resources/super-admin/images/folder.png') }}"
                                                            width="70">
                                                            <h6>{{ $folder->show_title }} <span class="badge badge-info">{{count($folder->childs)>0 ? count($folder->childs) : '' }}</span></h6>
                                                        </a>
                                                </div>
                                        @endforeach
                                        
                                        @foreach ($folders as $folder)
                                            @if (count($folder->files) > 0)
                                                <div class="col-12"
                                                    style="margin-top: 50px;padding: 0 30px;">
                                                      <div class="text-center">
    <h5 style="font-weight: 600;">Files in {{$folder->show_title}}</h5>
</div>
                                                    <!-- If this folder contain files -->
                                                    <div class="table-responsive">
                                                        <table 
                                                            class="table table-hover todo-list ui-sortable zero-configurations">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.N.</th>
                                                                    <th>File</th>
                                                                    <th>Description</th>
                                                                    <th>Uploaded By</th>
                                                                    <th>Reivewed By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($folder->files as $k => $file)
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
                                                                    
                                                                    $fileTitle = wordwrap($file->filename, 18, "<br />\n");
                                                                    ?>
                                                                    <tr id="{{ $file->id }}">
                                                                        <td>{{ $k + 1 }}</td>
                                                                        <td>
                                                                            @if (isset($file->filename) && $isImage == 'true')
                                                                                <div class="image-trap">
                                                                                    <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                        target="_blank">
                                                                                        <img src="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                            alt="no image"
                                                                                            width="30">
                                                                                        <span>@php $fileTitle @endphp</span>
                                                                                    </a>
                                                                                </div>
                                                                            @elseif(isset($file->filename) && $isExcel == 'true')
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    class=" img-responsive">
                                                                                    <img src="{{ asset('resources/front-end/images/excel.png') }}"
                                                                                        alt="No Excel File"
                                                                                        width="30">
                                                                                    <span>@php echo $fileTitle @endphp</span>
                                                                                </a>
                                                                            @elseif(isset($file->filename) && $isDoc == 'true')
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    class=" img-responsive">
                                                                                    <img src="{{ asset('resources/front-end/images/doc.png') }}"
                                                                                        alt="No Excel File"
                                                                                        width="30">
                                                                                    <span>@php echo $fileTitle @endphp</span>
                                                                                </a>
                                                                            @else
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    target="_blank">
                                                                                    <span>@php echo $fileTitle @endphp</span>
                                                                                </a>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ $file->remark ? $file->remark : 'No Descriptions' }}
                                                                        </td>
                                                                        <td>
                                                                            <h6 class="text-muted">
                                                                                {{ $file->user->name }}</h6>
                                                                            <h6 class="text-muted">
                                                                                {{ date('d M, Y', strtotime($file->updated_at)) }}
                                                                            </h6>
                                                                        </td>
                                                                        <td>
                                                                            @forelse($file->reviews as $review)
                                                                        @if(Auth::user()->id == 2  || Auth::user()->id == $review->staff_id || Auth::user()->id == $file->user_id)
                                                                        <span class="text-muted">{{$review->user->name}},</span>
                                                                        @else
                                                                        <span class="text-muted">Not Done</span>
                                                                        @endif
                                                                        @empty
                                                                        <span class="text-muted">Not Done</span>
                                                                        @endforelse
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('file-review.create', $file->id) }}"
                                                                                class="btn btn-icon btn-rounded btn-outline-success"
                                                                                title="{{ $file->review == 'off' ? 'Give Review' : 'Review Details' }}"><i
                                                                                    class="fas fa-glasses"></i></a>
                                                                            @if (Auth::user()->id == $file->user_id)

                                                                                <a
                                                                                    href="{{ route('file.edit', $file->id) }}"><button
                                                                                        type="button"
                                                                                        class="btn btn-icon btn-rounded btn-outline-primary"><i
                                                                                            class="fas fa-edit"></i></button></a>
                                                                                <button type="button"
                                                                                    class="btn btn-icon btn-rounded btn-outline-danger"
                                                                                    data-toggle="modal"
                                                                                    data-target="#deleteModal-{{ $k }}"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                                <!-- delete -->
                                                                                <div class="modal fade"
                                                                                    id="deleteModal-{{ $k }}"
                                                                                    tabindex="-1" role="dialog">
                                                                                    <div class="modal-dialog"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div
                                                                                                class="modal-header">
                                                                                                <h4 class="modal-title"
                                                                                                    id="defaultModalLabel">
                                                                                                    Attention !!!
                                                                                                </h4>
                                                                                            </div>
                                                                                            <div
                                                                                                class="modal-body">
                                                                                                Move
                                                                                                <b>{{ $file->title }}</b>
                                                                                                to archive?
                                                                                            </div>
                                                                                            <div
                                                                                                class="modal-footer">
                                                                                                <a href="{{ route('file.destroy', $file->id) }}"
                                                                                                    class="btn btn-danger">Confirm</a>
                                                                                                <button
                                                                                                    type="button"
                                                                                                    class="btn btn-default"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    download="{{ $file->title }}"
                                                                                    title="download">
                                                                                    <button type="button"
                                                                                        class="btn btn-icon btn-rounded btn-outline-info"><i
                                                                                            class="fas fa-download"></i></button>
                                                                                </a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            <hr style="width: 100%;">
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
