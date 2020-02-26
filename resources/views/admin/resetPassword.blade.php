<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ asset('public/admin/img/favicon.png') }}">

    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('public/admin/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .red,.errEmail{
            color:#FF0000;
        }
    </style>
</head>
<body class="login-body">
    <div class="container">
        <form class="form-signin" action="{{ route('admin.reset-password') }}?email={{ $email }}&code={{ $code }}" method="post">
        <!-- Notifications -->
        @include('notifications')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2 class="form-signin-heading">Reset Password Now</h2>
            <div class="login-wrap">
                <input type="password" class="form-control" name="password" placeholder="Password" autofocus>
                {!! $errors->first('password', '<span class="help-block red">:message</span>') !!}
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                {!! $errors->first('confirm_password', '<span class="help-block red">:message</span>') !!}
                <button class="btn btn-lg btn-login btn-block" type="submit">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
