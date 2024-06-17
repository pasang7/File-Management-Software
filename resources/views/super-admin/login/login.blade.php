<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>{{SITE_TITLE}}</title>

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

    <!-- END HEAD -->
<body>
<div class="auth-wrapper aut-bg-img" >
    <div class="auth-content">
        <div class="card" style="background: #00263D;">
            <div class="card-body text-center">
                <div class="mb-4">
                    <img src="{{asset('resources/super-admin/images/logo-white.png')}}" style="width:140px;">

                </div>
                <h4 class="mb-4 text-white"></h4>
                @if(isset($message))
                    <div class="col-lg-12 m-t-10">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> {{ $message }}
                        </div>
                    </div>
                @endif
                <form id="sign_in" method="POST" action="{{route('superadmin.login')}}" autocomplete="off">
                    {!! csrf_field() !!}
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="{{ old('username', isset($username) ? $username: '')}}" autofocus required style="background:whitesmoke !important;">
                </div>
                    @if($errors->has('username'))
                        <p style="color:red">{{ $errors->first('username') }}</p>
                    @endif

                <div class="input-group mb-4">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required value="{{ old('password', isset($password) ? $password: '')}}" style="background:whitesmoke !important;">
                </div>
                    @if ($errors->has('password'))
                        <p style="color:red">{{ $errors->first('password') }}</p>
                    @endif
                    <button type="submit" class="btn shadow-2 mb-4 mylogin">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Required Js -->
<script src="{{asset('resources/super-admin/js/vendor-all.min.js')}}"></script>
<script src="{{asset('resources/super-admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/super-admin/js/pcoded.min.js')}}"></script>
</body>
</html>