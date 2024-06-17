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
                                        <h5 class="m-b-10">Site Setting</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Site Setting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{route('site-settings.update',$siteSetting->id)}}" enctype="multipart/form-data" autocomplete="off" data-parsley-validate novalidate>
                        {!! csrf_field() !!}
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- [ Main Content ] start -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- [ form-element ] start -->
                                        <div class="form-group">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active text-uppercase" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="home-banner-tab" data-toggle="tab" href="#home-banner" role="tab" aria-controls="home-service" aria-selected="false">Homepage Banner Section</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="home-service-tab" data-toggle="tab" href="#home-service" role="tab" aria-controls="home-service" aria-selected="false">Homepage Service & Contact Section</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="homepage-tab" data-toggle="tab" href="#homepage" role="tab" aria-controls="home-service" aria-selected="false">Get a quote / Counter</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="home-service" aria-selected="false">Social Links and SEO</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', isset($siteSetting->title) ? $siteSetting->title: '')}}" placeholder="Enter Site Title" required>
                                                            </div>
                                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label>E-mail <span class="text-danger">*</span></label>
                                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', isset($siteSetting->email) ? $siteSetting->email: '')}}" placeholder="Enter Email" required>
                                                                </div>
                                                                <span class="text-danger">{{ $errors->first('email') }}</span>

                                                                <div class="form-group col-md-6">
                                                                    <label>Second E-mail [If Any]</label>
                                                                    <input type="email" class="form-control" name="email_2" id="email_2" value="{{ old('email_2', isset($siteSetting->email_2) ? $siteSetting->email_2: '')}}" placeholder="Enter Email">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Telephone No</label>
                                                                    <input type="text" class="form-control" name="tel_no" id="tel_no" value="{{ old('tel_no', isset($siteSetting->tel_no) ? $siteSetting->tel_no: '')}}" placeholder="Enter Telephone Number">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Mobile No</label>
                                                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', isset($siteSetting->mobile_no) ? $siteSetting->mobile_no: '')}}" placeholder="Enter Mobile No." >
                                                                </div>
                                                                {{--<div class="form-group col-md-6">--}}
                                                                {{--<label>Second Mobile No </label>--}}
                                                                {{--<input type="text" class="form-control" name="mobile_no_2" id="mobile_no_2" value="{{ old('mobile_no_2', isset($siteSetting->mobile_no_2) ? $siteSetting->mobile_no_2: '')}}" placeholder="Enter Second Mobile No." >--}}
                                                                {{--</div>--}}
                                                                <div class="form-group col-md-6">
                                                                    <label>Address <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', isset($siteSetting->address) ? $siteSetting->address: '')}}" placeholder="Enter Address" required>
                                                                </div>
                                                                <span class="text-danger">{{ $errors->first('address') }}</span>

                                                                <div class="form-group col-md-6">
                                                                    <label>Office Open Time</label>
                                                                    <input type="text" class="form-control" name="open_time" id="open_time" value="{{ old('open_time', isset($siteSetting->open_time) ? $siteSetting->open_time: '')}}" placeholder="Enter Office Open Time">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Google Map Link</label>
                                                                <input type="text" class="form-control" name="map" value="{{ old('map', isset($siteSetting->map) ? $siteSetting->map: '')}}" placeholder="Enter Google Map Link ">
                                                            </div>

                                                            <div class="row">
                                                                <div class="@if(isset($siteSetting->logo_image))col-md-9 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Logo <label class="img-size">(Size:-755x146)</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="logo_image" name="logo_image" value="{{ old('logo_image', isset($siteSetting->logo_image) ? $siteSetting->logo_image: '')}}">
                                                                            <label class="custom-file-label" for="logo_image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('logo_image') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->logo_image))
                                                                    <div class="col-md-3">
                                                                        <div class="image-trap">
                                                                            <div class="custom-control custom-checkbox select-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck_logo_image"  name="delete_logo_image" value="delete_logo_image">
                                                                                <label class="custom-control-label" for="customCheck_logo_image" title="Check for delete this image"></label>
                                                                            </div>
                                                                            <a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->logo_image)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->logo_image)}}" alt="No Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="row">
                                                                <div class="@if(isset($siteSetting->footer_logo_image))col-md-9 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Footer Logo <label class="img-size">(Size:-755x146)</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="footer_logo_image" name="footer_logo_image" value="{{ old('footer_logo_image', isset($siteSetting->footer_logo_image) ? $siteSetting->footer_logo_image: '')}}">
                                                                            <label class="custom-file-label" for="footer_logo_image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('footer_logo_image') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->footer_logo_image))
                                                                    <div class="col-md-3">
                                                                        <div class="image-trap">
                                                                            <div class="custom-control custom-checkbox select-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck_footer_logo_image"  name="delete_footer_logo_image" value="delete_footer_logo_image">
                                                                                <label class="custom-control-label" for="customCheck_footer_logo_image" title="Check for delete this image"></label>
                                                                            </div>
                                                                            <a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->footer_logo_image)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->footer_logo_image)}}" alt="No Image" style="background:#000;">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="home-banner" role="tabpanel" aria-labelledby="home-banner-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="banner_title" id="banner_title" value="{{ old('banner_title', isset($siteSetting->banner_title) ? $siteSetting->banner_title: '')}}" placeholder="Enter Title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Short Description <small class="text-info">[Word maximum limit with space is 200]</small></label>
                                                                <textarea name="banner_content" rows="5" class="form-control" placeholder="Enter Welcome Content here."  maxlength="200">{{ old('banner_content', isset($siteSetting->banner_content) ? $siteSetting->banner_content: '')}}</textarea>
                                                            </div>

                                                            <div class="row">
                                                                <div class="@if(isset($siteSetting->home_banner))col-md-8 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Homepage Banner <label class="img-size">(Size:-1920x800)</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="home_banner" name="home_banner" value="{{ old('home_banner', isset($siteSetting->home_banner) ? $siteSetting->home_banner: '')}}">
                                                                            <label class="custom-file-label" for="image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('home_banner') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->home_banner))
                                                                    <div class="col-md-4">
                                                                        <div class="image-trap">
                                                                            <div class="custom-control custom-checkbox select-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck_banner"  name="delete_home_banner" value="delete_home_banner">
                                                                                <label class="custom-control-label" for="customCheck_banner" title="Check for delete this image"></label>
                                                                            </div>
                                                                            <a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_banner)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_banner)}}" alt="No Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="home-service" role="tabpanel" aria-labelledby="home-service-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>Service Section</h4>
                                                        </div>
                                                        <div class="col-md-12">
                                                            {{--<div class="form-group">--}}
                                                            {{--<label>Small Title</label>--}}
                                                            {{--<input type="text" class="form-control" name="home_service_small_title" id="home_service_small_title" value="{{ old('home_service_small_title', isset($siteSetting->home_service_small_title) ? $siteSetting->home_service_small_title: '')}}" placeholder="Enter Small Title">--}}
                                                            {{--</div>--}}
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="home_service_title" id="home_service_title" value="{{ old('home_service_title', isset($siteSetting->home_service_title) ? $siteSetting->home_service_title: '')}}" placeholder="Enter Title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Short Description <small class="text-info">[Word maximum limit with space is 300]</small></label>
                                                                <textarea name="home_service_content" rows="5" class="form-control" placeholder="Enter Content here."  maxlength="300">{{ old('home_service_content', isset($siteSetting->home_service_content) ? $siteSetting->home_service_content: '')}}</textarea>
                                                            </div>

                                                        <!-- <div class="row">
                                                                <div class="@if(isset($siteSetting->brochure))col-md-8 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Service Brochure <label class="img-size">[pdf / jpg]</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="brochure" name="brochure" value="{{ old('brochure', isset($siteSetting->brochure) ? $siteSetting->brochure: '')}}">
                                                                            <label class="custom-file-label" for="image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('brochure') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->brochure))
                                                            <?php
                                                            $extension = pathinfo($siteSetting->brochure, PATHINFO_EXTENSION);
                                                            ?>
                                                                    <div class="col-md-4">
                                                                        @if($extension == 'jpg')
                                                                <div class="image-trap">
                                                                    <div class="custom-control custom-checkbox select-1">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck_brochure"  name="delete_brochure" value="delete_brochure">
                                                                        <label class="custom-control-label" for="customCheck_brochure" title="Check for delete this image"></label>
                                                                    </div>
                                                                    <a href="{{asset('uploads/Amenity/Brochure/'.$siteSetting->brochure)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Amenity/Brochure/'.$siteSetting->brochure)}}" alt="No Image">
                                                                            </a>
                                                                        </div>
                                                                            @else
                                                                <div class="custom-control custom-checkbox select-1">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck_brochure1"  name="delete_brochure" value="delete_brochure">
                                                                    <label class="custom-control-label" for="customCheck_brochure1" title="Check for delete this image"></label>
                                                                </div>
                                                                <a href="{{asset('uploads/Amenity/Brochure/'.$siteSetting->brochure)}}" target="_blank">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('resources/front-end/assets/images/pdf.png')}}" alt="No Image" width="90">
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                                </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>Contact Section</h4>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="home_product_title" id="home_product_title" value="{{ old('home_product_title', isset($siteSetting->home_product_title) ? $siteSetting->home_product_title: '')}}" placeholder="Enter Title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Short Description <small class="text-info">[Word maximum limit with space is 300]</small></label>
                                                                <textarea name="home_product_small_title" rows="5" class="form-control" placeholder="Enter Content here."  maxlength="300">{{ old('home_product_small_title', isset($siteSetting->home_product_small_title) ? $siteSetting->home_product_small_title: '')}}</textarea>
                                                            </div>

                                                            <div class="row">
                                                                <div class="@if(isset($siteSetting->home_image1))col-md-9 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Image <label class="img-size">(Size:-1920x651)</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="home_image1" name="home_image1" value="{{ old('home_image1', isset($siteSetting->home_image1) ? $siteSetting->home_image1: '')}}">
                                                                            <label class="custom-file-label" for="image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('home_image1') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->home_image1))
                                                                    <div class="col-md-3">
                                                                        <div class="image-trap">
                                                                            <div class="custom-control custom-checkbox select-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck_image1"  name="delete_home_image1" value="delete_home_image1">
                                                                                <label class="custom-control-label" for="customCheck_image1" title="Check for delete this image"></label>
                                                                            </div>
                                                                            <a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image1)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image1)}}" alt="No Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            {{--<div class="row">--}}
                                                            {{--<div class="@if(isset($siteSetting->home_image2))col-md-8 @else col-md-12 @endif"><div class="form-group">--}}
                                                            {{--<label>Upload Image for Website <label class="img-size">(Size:-1024x682)</label></label>--}}
                                                            {{--<div class="custom-file">--}}
                                                            {{--<input type="file" class="custom-file-input" id="home_image2" name="home_image2" value="{{ old('home_image2', isset($siteSetting->home_image2) ? $siteSetting->home_image2: '')}}">--}}
                                                            {{--<label class="custom-file-label" for="image">Choose file...</label>--}}
                                                            {{--<div class="invalid-feedback">Example invalid custom file feedback</div>--}}
                                                            {{--</div>--}}
                                                            {{--<span class="text-danger">{{ $errors->first('home_image2') }}</span>--}}
                                                            {{--</div></div>--}}
                                                            {{--@if(isset($siteSetting->home_image2))--}}
                                                            {{--<div class="col-md-4">--}}
                                                            {{--<div class="image-trap">--}}
                                                            {{--<div class="custom-control custom-checkbox select-1">--}}
                                                            {{--<input type="checkbox" class="custom-control-input" id="customCheck_image2"  name="delete_home_image2" value="delete_home_image2">--}}
                                                            {{--<label class="custom-control-label" for="customCheck_image2" title="Check for delete this image"></label>--}}
                                                            {{--</div>--}}
                                                            {{--<a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image2)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">--}}
                                                            {{--<img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image2)}}" alt="No Image">--}}
                                                            {{--</a>--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--@endif--}}
                                                            {{--</div>--}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="homepage" role="tabpanel" aria-labelledby="homepage-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5>Get A Quote Section</h5>
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="home_quote_title" id="home_quote_title" value="{{ old('home_quote_title', isset($siteSetting->home_quote_title) ? $siteSetting->home_quote_title: '')}}" placeholder="Enter Title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Short Description <small class="text-info">[Word maximum limit with space is 300]</small></label>
                                                                <textarea name="home_quote_content" rows="5" class="form-control" placeholder="Enter Content here."  maxlength="300">{{ old('home_quote_content', isset($siteSetting->home_quote_content) ? $siteSetting->home_quote_content: '')}}</textarea>
                                                            </div>
                                                            <div class="row">
                                                                <div class="@if(isset($siteSetting->home_image2))col-md-9 @else col-md-12 @endif"><div class="form-group">
                                                                        <label>Upload Image <label class="img-size">(Size:-1920x651)</label></label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="home_image2" name="home_image2" value="{{ old('home_image2', isset($siteSetting->home_image2) ? $siteSetting->home_image2: '')}}">
                                                                            <label class="custom-file-label" for="image">Choose file...</label>
                                                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                                        </div>
                                                                        <span class="text-danger">{{ $errors->first('home_image2') }}</span>
                                                                    </div></div>
                                                                @if(isset($siteSetting->home_image2))
                                                                    <div class="col-md-3">
                                                                        <div class="image-trap">
                                                                            <div class="custom-control custom-checkbox select-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck_image1"  name="delete_home_image2" value="delete_home_image2">
                                                                                <label class="custom-control-label" for="customCheck_image1" title="Check for delete this image"></label>
                                                                            </div>
                                                                            <a href="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image2)}}" data-toggle="lightbox" data-gallery="multiimages" data-title="" class=" img-responsive">
                                                                                <img class="img-thumbnail image_list"  src="{{asset('uploads/Nav/thumbnail/'.$siteSetting->home_image2)}}" alt="No Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Button Value</label>
                                                                <input type="text" class="form-control" name="home_quote_button" id="home_quote_button" value="{{ old('home_quote_button', isset($siteSetting->home_quote_button) ? $siteSetting->home_quote_button: '')}}" placeholder="Enter Title">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                            <label>Select Button URL</label>
                                                            <select class="form-control" id="home_quote_button_link" name="home_quote_button_link">
            <option value="/" {{ old('home_quote_button_link', isset($siteSetting->home_quote_button_link) ? $siteSetting->home_quote_button_link : '')=="/"?'selected="selected"':''}}>Homepage</option>
            <option value="system/login" {{ old('home_quote_button_link', isset($siteSetting->home_quote_button_link) ? $siteSetting->home_quote_button_link : '')=="system/login"?'selected="selected"':''}}>Client Login</option>
            <!-- <option value="news-notices" {{ old('home_quote_button_link', isset($siteSetting->home_quote_button_link) ? $siteSetting->home_quote_button_link : '')=="news-notices"?'selected="selected"':''}}>News & Notices</option> -->
            <!-- <option value="services" {{ old('home_quote_button_link', isset($siteSetting->home_quote_button_link) ? $siteSetting->home_quote_button_link : '')=="services"?'selected="selected"':''}}>Services</option> -->
            <option value="contact-us" {{ old('home_quote_button_link', isset($siteSetting->home_quote_button_link) ? $siteSetting->home_quote_button_link : '')=="contact-us"?'selected="selected"':''}}>Contact Us</option>
        </select>
    </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5>Counter Section</h5>
                                                            <div class="row">

                                                                <div class="form-group col-6">
                                                                    <label>Title 1</label>
                                                                    <input type="text" class="form-control" name="title1" id="title1" value="{{ old('title1', isset($siteSetting->title1) ? $siteSetting->title1: '')}}" placeholder="Enter Title">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label>Value 1</label>
                                                                    <input type="text" class="form-control" name="value1" id="value1" value="{{ old('value1', isset($siteSetting->value1) ? $siteSetting->value1: '')}}" placeholder="Enter Title">
                                                                </div>

                                                                <div class="form-group col-6">
                                                                    <label>Title 2</label>
                                                                    <input type="text" class="form-control" name="title2" id="title2" value="{{ old('title2', isset($siteSetting->title2) ? $siteSetting->title2: '')}}" placeholder="Enter Title">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label>Value 2</label>
                                                                    <input type="text" class="form-control" name="value2" id="value2" value="{{ old('value2', isset($siteSetting->value2) ? $siteSetting->value2: '')}}" placeholder="Enter Title">
                                                                </div>

                                                                <div class="form-group col-6">
                                                                    <label>Title 3</label>
                                                                    <input type="text" class="form-control" name="title3" id="title3" value="{{ old('title3', isset($siteSetting->title3) ? $siteSetting->title3: '')}}" placeholder="Enter Title">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label>Value 3</label>
                                                                    <input type="text" class="form-control" name="value3" id="value3" value="{{ old('value3', isset($siteSetting->value3) ? $siteSetting->value3: '')}}" placeholder="Enter Title">
                                                                </div>

                                                                <div class="form-group col-6">
                                                                    <label>Title 4</label>
                                                                    <input type="text" class="form-control" name="title4" id="title4" value="{{ old('title4', isset($siteSetting->title4) ? $siteSetting->title4: '')}}" placeholder="Enter Title">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label>Value 4</label>
                                                                    <input type="text" class="form-control" name="value4" id="value4" value="{{ old('value4', isset($siteSetting->value4) ? $siteSetting->value4: '')}}" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>Social Media Links</h5>
                                                                    <div class="form-group">
                                                                        <label>Facebook</label>
                                                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook', isset($siteSetting->facebook) ? $siteSetting->facebook: '')}}" placeholder="Enter Facebook Link">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Instagram</label>
                                                                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old('instagram', isset($siteSetting->instagram) ? $siteSetting->instagram: '')}}" placeholder="Enter Instagram Link">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Twitter</label>
                                                                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old('twitter', isset($siteSetting->twitter) ? $siteSetting->twitter: '')}}" placeholder="Enter Twitter Link">
                                                                    </div>
                                                                    {{--<div class="form-group">--}}
                                                                    {{--<label>Skype</label>--}}
                                                                    {{--<input type="text" class="form-control" name="skype" id="skype" value="{{ old('skype', isset($siteSetting->skype) ? $siteSetting->skype: '')}}" placeholder="Enter Facebook Link">--}}
                                                                    {{--</div>--}}
                                                                    <div class="form-group">
                                                                        <label>Linkedin</label>
                                                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ old('linkedin', isset($siteSetting->linkedin) ? $siteSetting->linkedin: '')}}" placeholder="Enter Linkedin Link">
                                                                    </div>
                                                                    {{--<div class="form-group">--}}
                                                                    {{--<label>Youtube</label>--}}
                                                                    {{--<input type="text" class="form-control" name="youtube" id="youtube" value="{{ old('youtube', isset($siteSetting->youtube) ? $siteSetting->youtube: '')}}" placeholder="Enter Youtube Link">--}}
                                                                    {{--</div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>SEO</h5>
                                                                    <div class="form-group">
                                                                        <label>Seo Title</label>
                                                                        <input type="text" class="form-control" name="seo_title" id="seo_title" value="{{ old('seo_title', isset($siteSetting->seo_title) ? $siteSetting->seo_title: '')}}" placeholder="Enter SEO Title">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Seo Keywords</label>
                                                                        <input type="text" id="tags" class="tagsinput form-control" name="seo_keywords" value="{{ old('seo_keywords', isset($siteSetting->seo_keywords) ? $siteSetting->seo_keywords: '')}}" placeholder="Enter SEO Keywords">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="content">Description</label>
                                                                        <textarea name="seo_description" id="seo_description" rows="6" class="form-control" placeholder="Enter SEO Description.">{{ old('seo_description', isset($siteSetting->seo_description) ? $siteSetting->seo_description: '')}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
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
