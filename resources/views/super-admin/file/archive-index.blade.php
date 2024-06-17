@extends('layouts.super-admin.layouts')
@section('content')
    @if ($files->count() > 0)
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
                                            <li class="breadcrumb-item"><a href="javascript:">Archives</a></li>
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
                                                <h5>Archives</h5>
                                                <br>
                                                <small>
                                                    The archive files will be automatically deleted after 6 months.
                                                </small>
                                            </div>
                                            <div class="col-lg-12 col-12 m-t-10">
                                                <input type="text" class="form-control" id="myInput"
                                                    onkeyup="myFunction()" placeholder="Search By Title..">
                                            </div>

                                            <div class="card-block">
                                                <div class="table-responsive">
                                                    <table id="sortable" class="table table-hover todo-list ui-sortable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.N.</th>
                                                                <th>File Title</th>
                                                                <th>File</th>
                                                                <th>Archived On</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($files as $k => $file)
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
                                                                <tr id="{{ $file->id }}">
                                                                    <td>{{ $k + 1 }}</td>
                                                                    <td>
                                                                        <h6 class="mb-1">{{ $file->title }}</h6>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($file->filename) && $isImage == 'true')
                                                                            <div class="image-trap">
                                                                                <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                    download="{{ $file->filename }}">
                                                                                    <img src="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                        alt="no image" width="30">
                                                                                    <span>{{ $file->filename }}</span>
                                                                                </a>
                                                                            </div>
                                                                        @elseif(isset($file->filename) && $isExcel == 'true')
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                class=" img-responsive">
                                                                                <img src="{{ asset('resources/front-end/images/excel.png') }}"
                                                                                    alt="No Excel File" width="30">
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @elseif(isset($file->filename) && $isDoc == 'true')
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                class=" img-responsive">
                                                                                <img src="{{ asset('resources/front-end/images/doc.png') }}"
                                                                                    alt="No Excel File" width="30">
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset('uploads/File/' . $file->filename) }}"
                                                                                download="{{ $file->filename }}">
                                                                                <span>{{ $file->filename }}</span>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="text-muted">
                                                                            {{ date('d M, Y', strtotime($file->deleted_at)) }}
                                                                        </h6>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('file.restore', $file->id) }}">
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-outline-warning">Restore</button>
                                                                        </a>
                                                                        <a
                                                                            href="{{ route('file.permanent.delete', $file->id) }}">
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-outline-danger">Delete
                                                                                Forever</button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="justify-content-center">
                                                        <ul class="pagination">
                                                            {!! $files->render() !!}
                                                        </ul>
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
    @else
        <section class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- [ Main Content ] start -->
                                <div class="row">
                                    <!-- [ configuration table ] start -->
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-block text-center">
                                                <h4 class="text-info">No files are archived.</h4>

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
    @endif

@stop
@section('page-specific-scripts')
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("sortable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection
