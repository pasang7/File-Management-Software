<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <!-- [ form-element ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Client Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($user->name) ? $user->name: '')}}" placeholder="Client Full Name" parsley-trigger="change" required>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>

                                    <div class="form-group">
                                        <label>Contact No. </label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', isset($user->phone) ? $user->phone: '')}}" placeholder="Enter Your Number">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Address 
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($user->email) ? $user->email: '')}}"  aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" id="address" value="{{ old('address', isset($user->address) ? $user->address: '')}}" placeholder="Enter Address">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                        <input type="hidden" name="role" value="others" readonly>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="active" {{ old('status', isset($user->status) ? $user->status : '')=='active'?'selected="selected"':''}}>Active</option>
                                                <option value="in_active" {{ old('status', isset($user->status) ? $user->status : '')=='in_active'?'selected="selected"':''}}>Inactive</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                        
                                    <div class="form-group">
                                        <label for="username">Username <span class="text-danger">*</span><small class="text-danger">(Space Not Allowed)</small>
                                            <br>
                                            <small class="text-primary">Username should be unique. Once username created, it can not be changed.</small>
                                        </label>
                                        <input type="username" class="form-control" id="username" name="username" value="{{ old('username', isset($user->username) ? $user->username: '')}}" {{isset($user->username) ? 'readonly="readonly"': ''}} placeholder="Enter Username" required>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                    <div class="text-right">
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
</div>