<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | Account Activation</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css"/>
    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css"
          rel="stylesheet">

    <!-- Custom Theme Style -->
<!--<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

    <style>
        body {
            color: #73879C;
            background: #2A3F54;
            font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.471;
            font-family: Arial;
        }

        .subscription-panel {
            padding-top: 75px;
        }

        #registerView .register-box {
            background-color: #2D3343;
            border-radius: 4px;
            /*padding: 15px 30px;*/
            margin-top: 40px;

            -webkit-box-shadow: 0px 2px 21px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 2px 21px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 2px 21px 0px rgba(0, 0, 0, 0.75);
        }

        .left-side {
            padding: 23px 30px;
            background: #fff;
            min-height: 522px;
        }

        .right-side {
            padding: 15px 30px;
        }

        .header-text-info {
            color: #2e7598;
            font-weight: 100;
            font-size: 24px;
            margin-top: 24px;
        }

        #frm_subscription_charge .radio-row {
            padding: 15px;
            font-size: 15px;
        }

        #frm_subscription_charge .image-row {
            text-align: center;
        }

        #frm_subscription_charge .image-row img {
            width: 60%;
            margin: auto;
        }

        #frm_subscription_charge .card-details-row {
            padding: 15px;
        }

        .footer-button {
            margin-top: 30px;
        }

        #frm_subscription_charge input[type="text"], #frm_subscription_charge select {
            height: 40px;
        }

        .footer {
            color: #fff;
            font-weight: 100;
            line-height: 30px;
            padding-top: 30px;
            padding-bottom: 30px;
            font-size: 16px;
        }

        .footer a {
            color: #1ABB9C;
        }

        .list-option {
            list-style-type: none;
            padding-left: 15px;
            margin-bottom: 33px;
        }

        .list-option li {
            font-size: 19px;
            line-height: 40px;
        }

        .list-option li:before {
            font-family: 'FontAwesome';
            content: '\f046';
            margin: 0 15px 0 -15px;
            color: #1ABB9C;
            font-size: 30px;
            vertical-align: middle;
        }

        .right-header {
            color: #fff;
            padding-bottom: 15px;
        }

        .right-footer {
            color: #fff;
            font-size: 23px;
            padding-top: 15px;
        }

        .right-footer > i {
            font-size: 41px;
        }

        form label {
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 600;
            color: #0876b3;
        }

        form input[type="text"]:focus, form select:focus {
            border-color: #2fbc9e;
            box-shadow: none;
            outline: 0 none;
        }

        form input[type="text"], form select {
            height: 44px !important;
            border: 2px solid #a7c3dc;
        }

        form input[type="checkbox"] {
            height: 13px;
            vertical-align: middle;
        }

        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 2px solid #960016 !important;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }

        .right-bottom {
            list-style-type: none;
            padding: 0px;
        }

        .right-bottom > li {
            display: inline-block;
        }

        .right-bottom > li > img {
            width: 100px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="main_container">

        <div class="subscription-panel">

            <div class="row">
                <div class="col-xs-12">
                    <img class="img img-responsive center-block" src="{{ asset('images/logo1.png') }}">
                </div>
            </div>

            @if(!empty($errors))
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> {{ $error }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            <div class="row" id="registerView">
                <div class="col-xs-12">

                    <div class="register-box clearfix">
                        <div class="col-xs-12 col-md-7 left-side">
                            <div class="header-text-info text-center">
                                Your 7 days trial period is over.<br>
                                What you are going to do now?
                            </div>
                            <hr>
                            <div class="form col-md-12">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <button id="button_code_enter" type="button"
                                                class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#codeModal">Enter Code
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('subscription.index') }}"
                                           class="btn btn-success btn-block btn-lg">Go to Subscription</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-5 right-side text-center">
                            <h3 class="right-header">CARTUMO PROMISE</h3> <br/>
                            <ul class="list-option text-left">
                                <li>Unlimited funnels</li>
                                <li>One click upsell</li>
                                <li>One click downsells</li>
                                <li>Shopify integration</li>
                                <li>Sell manual products</li>
                                <li>Connect your mail server</li>
                                <li>PayPal and Stripe for payment gateway</li>
                                <li>Bump feature</li>
                                <li>Coupon feature</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row footer text-center">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="codeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Activate Account</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-md-12" style="padding: 0px;">
                    <form class="form-horizontal" action="{{ route('account.store') }}" method="post">
                        {{ csrf_field() }}
                        <div id="section_button_code_enter">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="activation_code"
                                           placeholder="Enter the code here..." required>
                                </div>
                                <div class="col-md-3"><button class="btn btn-primary btn-block btn-lg" type="submit">Submit</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('frontend/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('frontend/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('frontend/vendors/nprogress/nprogress.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- The required Stripe lib -->
<script src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/custom.min.js') }}"></script>

<script>
    var token = "";

    $(document).ready(function () {

    });

</script>
</body>
</html>
