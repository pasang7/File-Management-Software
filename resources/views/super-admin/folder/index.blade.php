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
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ configuration table ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Folders List</h5>
                                        </div>
                                        <div class="button-card text-right ">
                                            <a href="{{route('folder.create')}}"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> Add Folder</button></a>
                                        </div>
                                        <div class="card-block">
                                            <div class="table-responsive">
                                                <table id="sortable" class="table table-hover todo-list ui-sortable">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="handle"><i class="fas fa-arrows-alt"></i></span></th>
                                                            <th>Title</th>
                                                            <th>Sub Folder</th>
                                                            <th>Date Modified</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $orders =''; $table='folders'; ?>
                                                    @foreach($folders as $k=>$folder)
                                                        <?php $orders .= $folder->order . ','; ?>
                                                    <tr class="unread" id="{{$folder->id}}">
                                                        <td>{{$k+1}}</td>
                                                        {{-- <td>
                                                            <h6 class="mb-1">{{$folder->client->name}}</h6>
                                                        </td> --}}
                                                        <td>
                                                            <h6 class="mb-1">{{$folder->show_title}}</h6>
                                                        </td>
                                                        <td><a href="{{route('folder.parent.index',$folder->id)}}"><i class="fas fa-folder-open"></i> {{$folder->childs->count()}}</a></td>
                                                        <td>
                                                            <h6 class="text-muted">Updated: {{date('d M Y', strtotime($folder->updated_at))}}</h6>
                                                            <h6 class="text-muted">Created: {{date('d M Y', strtotime($folder->created_at))}}</h6>
                                                        </td>
                                                        <td><a href="{{route('folder.edit',$folder->id)}}" class="btn btn-icon btn-rounded btn-outline-info" ><i class="fas fa-edit"></i></a> 
                                                            <a href="javascript:void(0)" class="btn btn-icon btn-rounded btn-outline-danger"  data-toggle="modal" data-target="#deleteModal-{{$k}}">
                                                            <i class="fas fa-trash"></i>
                                                            </a>
                                                            <!-- delete -->
                                                            <div class="modal fade" id="deleteModal-{{$k}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="defaultModalLabel">Attention !!!</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete <b>{{$folder->title}}</b>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="{{route('folder.destroy',$folder->id)}}" class="btn btn-danger">Delete</a>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                   </tbody>
                                                </table>
                                                <div class="justify-content-center">
                                                    <ul class="pagination">
                                                        {!! $folders->render() !!}
                                                    </ul>
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
        </div>
    </section>
@stop
@section('page-specific-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sortable').tableDnD({
                onDrop: function (table, row) {
                    $.ajax({method:'POST',url:'{{route('ajax.sortable')}}',data:{ids_order: $.tableDnD.serialize(), orders: '<?php echo $orders; ?>', table: '<?php echo $table; ?>', _token: '{!! csrf_token() !!}'}});
                }
            });
        });
    </script>
@endsection