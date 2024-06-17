<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>Change Password - {{SITE_TITLE}}</title>

    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="{{SITE_TITLE}}"/>

    <link rel="icon" href="{{asset('resources/super-admin/login/images/fav.png')}}" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('resources/super-admin/fonts/fontawesome/css/fontawesome-all.min.css')}}"/>
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('resources/super-admin/plugins/animation/css/animate.min.css')}}"/>
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('resources/super-admin/css/style.css')}}"/>
    
        <link href="{{asset('resources/super-admin/plugins/parsley/parsley.css')}}" rel="stylesheet">


    <!-- END HEAD -->
<body>
    
<div class="auth-wrapper aut-bg-img">
    <div class="auth-content">
        <div class="card" style="background: #00263D;">
            <div class="card-body text-center">
                <div class="mb-4">
                    <img src="{{asset('resources/super-admin/images/logo-white.png')}}" style="width:140px;">
                </div>
                <h4 class="mb-4 text-white">Change Password</h4>
                @if(isset($message))
                    <div class="col-lg-12 m-t-10">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> {{ $message }}
                        </div>
                    </div>
                @endif
               <form id="sign_in" method="POST" action="{{route('client-change.password')}}" class="login-form" data-parsley-validate novalidate>
                        {!! csrf_field() !!}
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="input-group mb-4">
                         <input type="password" class="form-control" placeholder="New Password" name="password" id="pwfield" value="" autofocus required style="background:whitesmoke !important;" data-toggle="tooltip" data-placement="bottom" title="Password should be more than 6 characters.">
                    </div>
                    @if ($errors->has('password'))
                        <p style="color:red">{{ $errors->first('password') }}</p>
                    @endif
                    
                    <div class="input-group mb-4">
                       <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" value="" required style="background:whitesmoke !important;" >
                    </div>
                    <button type="submit" class="btn btn-primary shadow-2 mb-4">Change Password</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Required Js -->
<script src="{{asset('resources/super-admin/js/vendor-all.min.js')}}"></script>
<script src="{{asset('resources/super-admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/super-admin/js/pcoded.min.js')}}"></script>
<!-- parsley Validation -->
<script src="{{asset('resources/super-admin/plugins/parsleyjs/dist/parsley.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

</body>
</html>
