<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CARTUMO | Subscription</title>

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
    <input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
    <input type="hidden" id="hid_user_stripe_key" value="{{ $payment->publishable_key }}"/>
    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
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
                                <h3>Payment Details</h3>
                                <p>for: <b>{{ Auth::user()->email }}</b></p>
                                <p class="chanable-text">{{ env('TRIAL_PERIOD') }}-days free, then <span>${{ env('MONTHLY_PLAN') }}
                                        per month</span>
                                <p>
                            </div>

                            <div class="form col-md-12">
                                <form id="paymentForm" action="{{ route('subscription.store') }}" method="post"
                                      data-parsley-validate>
                                    <div class="row radio-row">
                                        <div class="radio">
                                            <label clas="control-label">
                                                <input type="radio" name="subscription_plan" value="monthly"
                                                       data-change-text="${{ env('MONTHLY_PLAN') }} per month"
												       <?php echo ( ! empty( $_GET['plan'] ) && $_GET['plan'] == 'monthly' ) ? 'checked' : ''; ?> required/>
                                                Monthly plan (${{ env('MONTHLY_PLAN') }}/month) - <span
                                                        style="color:#f00; font-weight:600">${{ env('MONTHLY_SAVE') }}
                                                    Savings</span>
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label clas="control-label">
                                                <input type="radio" name="subscription_plan" value="yearly"
                                                       data-change-text="${{ env('YEARLY_PLAN') }} per year"
												       <?php ( ( ! empty( Auth::user()->subscription( 'main' ) ) ) && ( Auth::user()->subscription( 'main' )->stripe_plan == 'yearly' ) ) ? 'checked' : '';  ?> <?php echo ( ! empty( $_GET['plan'] ) && $_GET['plan'] == 'yearly' ) ? 'checked' : ''; ?> required/>
                                                Annual plan (${{ env('YEARLY_PLAN') }}/year) - <span
                                                        style="color:#f00; font-weight:600">${{ env('YEARLY_SAVE') }}
                                                    Savings</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row image-row text-center" style="margin-top:45px;">
                                        <img src="{{ asset('images/credit-cards.png') }}" style="width: 50%;"/>
                                    </div>

                                    <div class="row card-details-row">
                                        <div class="form-group">
                                            <div class="row clearfix">
                                                <div class="col-md-8 col-sm-8 col-xs-12 div-grid">
                                                    <label for="number">Credit Card Number:</label>
                                                    <input type="text" class="form-control" id="number"
                                                           placeholder="Card Number" data-stripe="number" required/>
                                                </div>

                                                <div class="col-md-4 col-sm-4 col-xs-12 div-grid">
                                                    <label for="ccv">CVC:</label>
                                                    <input type="text" class="form-control" id="cvc" placeholder="CVC"
                                                           data-stripe="cvc"
                                                           required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row clearfix">
                                                <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                                    <label for="exp-month">Expiry Month:</label>
                                                    <select class="form-control" id="exp-month" data-stripe="exp-month"
                                                            required>
                                                        @foreach (range(1, 12) as $key => $month)
                                                            <option value="{{ $month }}">{{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                                    <label for="exp-year">Expiry Year:</label>
                                                    <select class="form-control" id="exp-year" data-stripe="exp-year"
                                                            required>
                                                        @foreach (range(date('Y'), intval(date('Y') + 20)) as $key => $year)
                                                            <option value="{{ $year }}">{{ $year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix footer-button">
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-success btn-block btn-lg"
                                                        id="submit-subscription-details">Start
                                                    My {{ env('TRIAL_PERIOD') }}-Day Free Trial
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ route('logout') }}" class="btn btn-danger btn-block btn-lg">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                                    @if ( !empty($_GET['affiliate_id']) )
                                        <input type="hidden" name="affiliate_id" value="{{ $_GET['affiliate_id'] }}"/>
                                    @endif
                                </form>
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
                            <div class="right-footer">
                                <ul class="right-bottom">
                                    <li><i class="fa fa-lock" aria-hidden="true"></i><br/>100% Risk Free</li>
                                    <li><img src="{{ asset('images/stripe-logo.png') }}"/></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row footer text-center">
                <div class="col-xs-12 text-center under-box"><span translate="" class="ng-scope">By clicking above, you agree to our</span>&nbsp;<a
                            href="https://cartumo.io/#" target="_blank">Terms Of Service</a>&nbsp;<span>and</span>&nbsp;<a
                            href="https://cartumo.io/#" target="_blank">Privacy Policy</a></div>
                <p>&copy; {{ date('Y') }} Cartumo</p>
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

    // Create a Stripe client
    //var stripe = Stripe("{{ $payment->publishable_key }}");
    var token = "";

    $(document).ready(function () {

        $("#paymentForm").parsley();

        $("#paymentForm").submit(function (e) {

            e.preventDefault();

            var button = $("#submit-subscription-details");
            var button_text = $(button).text();

            //alert("submitted");
            $(button).attr('disabled', 'disabled');

            Stripe.setPublishableKey("{{ env('STRIPE_KEY') }}");
            var stripeResponseHandler = function (status, response) {
                // Grab the form:
                var form = document.getElementById('paymentForm');
                //alert("Start");

                if (response.error) { // Problem!
                    // Show the errors on the form:
                    alert("Problem occurred! Please try after sometime.");
                } else { // Token was created!
                    // Get the token ID:
                    token = response.id;
                    //alert(token);


                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('paymentForm');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    //form.submit();

                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> processing...');
                    //return false;

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('subscription.store') }}",
                        data: $(form).serialize(),
                        beforeSubmit: function () {
                            $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        },
                        success: function (response) {
                            //alert(response);
                            console.log(response);
                            $(button).text(button_text);

                            var json = JSON.parse(response);

                            if (json.status == 'success') {
                                location.href = json.url;
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            };

            //alert(token.length);

            if (token.length <= 0) {
                // Create a token when the form is submitted
                var form = document.getElementById('paymentForm');
                Stripe.card.createToken(form, stripeResponseHandler);

                //alert("button");
                return false;
            }


            return false;
        });

        $("#paymentForm input[name='subscription_plan']").change(function (e) {

            var area_place = $(".register-box .header-text-info");
            var element = $(this);

            $(area_place).find(".chanable-text > span").text($(element).attr('data-change-text'));
        });
    });

</script>
</body>
</html>
