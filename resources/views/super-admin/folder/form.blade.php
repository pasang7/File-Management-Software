<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
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
                                        <input type="hidden" class="form-control" name="client_id" id="title" value="{{ $folder->client->id }}" readonly>

                                        <label>Client Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" value="{{ $folder->client->name }}" readonly>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
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
                                                    <option value="{{$k}}" {{ old('parent_id', isset($folder->parent_id) ? $folder->parent_id : '')==$k?'selected="selected"':''}}>{{$option}} </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="show_title" id="show_title" value="{{ old('show_title', isset($folder->show_title) ? $folder->show_title: '')}}" placeholder="Enter Folder Name" parsley-trigger="change" required>
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
        </div>
    </div>
</div >