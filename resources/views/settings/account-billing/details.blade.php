@extends('layouts.app')

@section("title", "Account Billing")

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css"/>
    <style>
        .page-title > .title_left h3, .page-title > .title_left a {
            display: inline-block;
        }

        .page-title > .title_left {
            width: 100%;
        }

        .page-title > .title_left a {
            float: right;
        }

        .payment-types {
            list-style-type: none;
            padding: 0px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .payment-types > li {
            display: inline-block;
            border: 1px solid #ddd;
            border-top-left-radius: 4px !important;
            border-top-right-radius: 4px !important;
            background: #F7F7F7;
            position: relative;
            z-index: 33;
            color: gray;
            font-weight: bold;
            padding: 10px 15px;
            padding-bottom: 10px;
            text-align: center;
            margin-right: 15px;
            cursor: pointer;
        }

        .payment-types > li > i {
            font-size: 18px;
        }

        .tab-container > div {
            display: none;
        }

        .tab_paypal.active {
            color: #00488B;
        }

        .tab_stripe.active {
            color: #6668DE;
        }

        .fa-li {
            position: relative;
            left: 0em;
            top: 0em
        }

        .gateway-box {

        }

        .border-box {
            border: 1px solid #eee;
            padding: 15px;
        }

        .gateway-box table tr {
            line-height: 30px;
        }

        .gateway-box ul {
            list-style-type: none;
            padding: 0px;
        }

        .gateway-box ul > li strong {

        }

        .gateway-box ul > li {
            display: inline-block;
            width: 9%;
        }

        .gateway-box ul > li:first-child {
            width: 80%;
            font-size: 20px;
            font-weight: 700;
        }

        .btn-transparent {
            background: transparent;
            /*border-color: transparent;*/
        }

        .btn-trans-danger {
            color: #ac2925;
            border-color: #ac2925;
        }

        .btn-trans-success {
            color: #398439;
            border-color: #398439;
        }

        .btn-trans-info {
            color: #1593f3;
            border-color: #1593f3;
        }

        .btn-bold {
            font-weight: bold;
        }

        .table-plans {
            width: 100%;
        }

        .renew-plan {

        }

        .renew-plan .table-plans {

        }

        .renew-plan .table-plans {

        }

        .renew-plan .table-plans td.plan-details {
            font-size: 16px;
        }

        .renew-plan .table-plans td.plan-details > strong {

        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="row">

            <div class="clearfix">

                <div class="col-md-8">

                    <div class="page-title">
                        <div class="title_left" style="margin-bottom: 15px;">
                            <h2 class="dashboard-page-title"><i class="fa fa-credit-card"></i> Account Billing</h2>
                        </div>
                    </div>

                    <div class="x_panel">
                        <div class="x_content">

                            <div class="row clearfix">

                                @if ( !empty(Auth::user()->secret) )
                                    <h1>You are Subscribed!</h1>
                                    <p style="font-size: 16px;">
                                        @if ( Auth::user()->secret == env('REGISTER_CODE_MONTHLY') )
                                            <strong>Free for 1 Month</strong>
                                        @elseif ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') )
                                            <strong>Free for 1 Year</strong>
                                        @endif
                                    </p>
                                @else
                                    <h1>You are Subscribed!</h1>
                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <p style="font-size: 16px;">
                                                @if ( Auth::user()->subscribedToPlan('monthly', 'main') )
                                                    Currently subscribed to the <strong>${{ env('MONTHLY_PLAN') }} /
                                                        MONTH Plan</strong>
                                                @else
                                                    Currently subscribed to the <strong>(${{ env('YEARLY_PLAN') }} /
                                                        YEAR)</strong> Plan
                                                @endif
                                            </p>

                                            <p>
                                                @if ( Auth::user()->subscription('main')->onTrial() )
                                                    <b style="color:#45b39c">You are in TRIAL mode.</b>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="col-md-3 text-right">
                                            @if ( Auth::user()->subscription('main')->cancelled() )
                                                <button type="button" id="resume_subscription"
                                                        class="btn btn-bold btn-trans-success btn-transparent"><i
                                                            class="fa fa-undo" aria-hidden="true"></i> RESUME
                                                </button>
                                            @else
                                                <button type="button" id="cancel_subscription"
                                                        class="btn btn-bold btn-trans-danger btn-transparent"><i
                                                            class="fa fa-times" aria-hidden="true"></i> CANCEL
                                                </button>
                                            @endif
                                        </div>
                                    </div>



                                    <hr/>
                                    <!-- ------------------- RENEW PLANS --------------------- -->
                                    <div class="row clearfix">
                                        <div class="col-md-12 renew-plan">
                                            @if ( Auth::user()->subscribedToPlan('monthly', 'main') )
                                                <table class="table-plans">
                                                    <tr>
                                                        <td style="width: 70%" class="plan-details">
                                                            Yearly Plan:
                                                            <strong>${{ env('YEARLY_PLAN') }} / YEAR</strong>
                                                            <p>
                                                                <small>You save
                                                                    (${{ number_format(env('YEARLY_SAVE'), 2) }})
                                                                </small>
                                                            </p>
                                                        </td>
                                                        <td style="width: 30%" class="text-right">
                                                            <button type="button" id="renew_yearly_subscription"
                                                                    class="btn btn-bold btn-trans-info btn-transparent">
                                                                Renew Yearly Plan
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @else
                                                <table class="table-plans">
                                                    <tr>
                                                        <td style="width: 70%" class="plan-details">
                                                            Monthly Plan:
                                                            <strong>${{ env('MONTHLY_PLAN') }} / MONTHLY</strong>
                                                        </td>
                                                        <td style="width: 30%" class="text-right">
                                                            <button type="button" id="renew_monthly_subscription"
                                                                    class="btn btn-bold btn-trans-info btn-transparent">
                                                                Renew Monthly Plan
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-4">
                    <div class="x_panel">
                        <div class="x_content">
                            <ul class="profile-sidebar">
                                <li>
                                    <strong>{{ $data['profile']->user->name }}</strong>
                                    <p style="margin: 0px;">{{ $data['profile']->user->email }}</p>
                                </li>

                                <li class="pull-right">
                                    <img src="{{ asset('global/img/profile-avatar.png') }}"/>
                                </li>
                            </ul>

                            <div class="profile-content">
                                <table>
                                    <tr>
                                        <th>PLAN</th>
                                        <td>
                                            @if ( (!empty(Auth::user()->secret)) )
                                                @if ( Auth::user()->secret == env('REGISTER_CODE_MONTHLY') )
                                                    (${{ env('MONTHLY_PLAN') }} / MONTH)
                                                @elseif ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') )
                                                    (${{ env('YEARLY_PLAN') }} / YEAR)
                                                @elseif ( Auth::user()->secret == env('REGISTER_CODE_LIFETIME_PROMO') )
                                                    <b style="color:#45b39c; text-transform: none">7 days free trial</b>
                                                @else
                                                    <b style="color:#45b39c; text-transform: none">Lifetime</b>
                                                @endif
                                            @else
                                                @if ( Auth::user()->subscription('main')->onTrial() )
                                                    <b style="color:#45b39c; text-transform: none">You are on Trial period</b>
                                                @endif
                                                @if ( Auth::user()->subscribedToPlan('monthly', 'main') )
                                                    (${{ env('MONTHLY_PLAN') }} / MONTH)
                                                @else
                                                    (${{ env('YEARLY_PLAN') }} / YEAR)
                                                @endif
                                            @endif
                                        </td>
                                        </th>
                                    </tr>


                                    <tr>
                                        <th>SALES</th>
                                        <td>${{ number_format($data['total_sales'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>FUNNELS</th>
                                        <td>{{ $data['total_funnels'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script>
        var tmp_content;
        var tmp_tab;
        $(".gateway-list-linline > .payment-types > li").click(function (e) {

            e.preventDefault();

            $(tmp_content).hide();
            $(tmp_tab).removeClass('active');

            $(this).addClass('active');
            $("#" + $(this).attr('data-target-id')).show();

            tmp_tab = $(this);
            tmp_content = $("#" + $(this).attr('data-target-id'));
        });


        // cancel subscription
        $("#cancel_subscription").click(function (e) {

            e.preventDefault();

            var button = $(this);

            if (confirm("Are you sure to cancel the subscription?")) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.subscription.cancel') }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).attr('disabled', 'disabled');
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> canceling');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        //alert(json.message);

                        if (json.status == 'success') {
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }

        });

        // cancel subscription
        $("#resume_subscription").click(function (e) {

            e.preventDefault();

            var button = $(this);

            if (confirm("Are you sure to resume the subscription?")) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.subscription.resume') }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).attr('disabled', 'disabled');
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> resuming');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        //alert(json.message);

                        if (json.status == 'success') {
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }

        });


        // renew yearly subscription
        $("#renew_yearly_subscription").click(function (e) {

            e.preventDefault();

            var button = $(this);

            if (confirm("Are you sure to renew the yearly subscription?")) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.subscription.renew') }}",
                    data: "_token={{ csrf_token() }}&type=yearly",
                    beforeSend: function () {
                        $(button).attr('disabled', 'disabled');
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        //alert(json.message);

                        if (json.status == 'success') {
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }
        });


        // renew monthly subscription
        $("#renew_monthly_subscription").click(function (e) {

            e.preventDefault();

            var button = $(this);

            if (confirm("Are you sure to renew the monthly subscription?")) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.subscription.renew') }}",
                    data: "_token={{ csrf_token() }}&type=monthly",
                    beforeSend: function () {
                        $(button).attr('disabled', 'disabled');
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        //alert(json.message);

                        if (json.status == 'success') {
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }
        });

    </script>
@endsection
