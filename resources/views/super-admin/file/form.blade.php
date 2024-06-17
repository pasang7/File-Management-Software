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
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" readonly>
                                    <input type="hidden" value="{{ Auth::user()->role }}" name="user_role" readonly>
                                    @if (Auth::user()->role != 'others')
                                        <div class="form-group">
                                            <label for="client_id">Client <span class="text-danger">*</span></label>
                                            <select class="form-control" id="client_id" name="client_id" required>
                                                <option value="">Choose Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}"
                                                        {{ old('client_id', isset($file->client_id) ? $file->client_id : '') == $client->id? 'selected="selected"': '' }}>
                                                        {{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                    @else
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="client_id" readonly>
                                    @endif
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
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ old('title', isset($file->title) ? $file->title : '') }}"
                                            placeholder="Enter File Title" parsley-trigger="change" required>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                    <div class="row">
                                        <div class="@if (isset($file->filename))col-md-9 @else col-md-12 @endif">
                                            <div class="form-group">
                                                <label>Upload File <span class="text-danger">*</span> <br>
                                                    <small class="text-info">File size should be less than
                                                        50MB.</small></label>
                                                <input type="file" class="form-control" id="filename" name="filename"
                                                    value="{{ old('filename', isset($file->filename) ? $file->filename : '') }}"
                                                    @if (!isset($file->filename))required @endif>

                                                <span class="text-danger">{{ $errors->first('filename') }}</span>
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
                                            placeholder="Enter description here.">{{ old('remark', isset($file->remark) ? $file->remark : '') }}</textarea>
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
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="active"
                                                {{ old('status', isset($file->status) ? $file->status : '') == 'active' ? 'selected="selected"' : '' }}>
                                                Active</option>
                                            <option value="in_active"
                                                {{ old('status', isset($file->status) ? $file->status : '') == 'in_active' ? 'selected="selected"' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i>
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
