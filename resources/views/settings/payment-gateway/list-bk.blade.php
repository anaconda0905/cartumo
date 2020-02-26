@extends('layouts.app')

@section("title", "SMTP List")

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
                            <h3 class="dashboard-page-title"><i class="fa fa-shopping-cart"></i> Manage Payment Gayeways</h3>
                            <a class="btn special-button-primary btn-lg" href="{{ route('payment-gateway.create') }}" style="padding-top: 10px;"><i
                                        class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                        </div>
                    </div>

                    <div class="x_panel">
                        <div class="x_content">

                            <div class="row clearfix">

                                @if ( !empty($data['paymentGateways']) )
                                    <div class="integration-list">
                                    @foreach ( $data['paymentGateways'] as $gateway )                                       

                                        <?php $details = json_decode($gateway->details); ?>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="integration-details">
                                                        <span><img src="{{ asset('images/' . $gateway->type . '.png') }}" style="width: 72px;"></span>
                                                        <!--<span>Mailchimp</span>-->
                                                    </td>
                                                    <td>{{ $details->title }}</td>
                                                    <td class="text-right">
                                                        <span><a href="{{ route('payment-gateway.edit', $gateway->id) }}"
                                                               class="btn btn-default"><i class="fa fa-pencil"
                                                                                          aria-hidden="true"></i></a>
                                                        </span>
                                                        <span>
                                                            <button class="btn btn-danger btn-remove-payment-details" data-gateway-id="{{ $gateway->id }}"><i class="fa fa-trash"
                                                                                         aria-hidden="true"></i></button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    @endforeach
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
                                                    @else
                                                        (${{ env('YEARLY_PLAN') }} / YEAR)
                                                    @endif
                                                @else
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
                                        <td>{{ $data['total_sales'] }}</td>
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


        $(".btn-remove-payment-details").click(function(e) {

            e.preventDefault();

            var gateway_id = $(this).attr('data-gateway-id');
            var button = $(this);

            if ( confirm("Are you sure to delete the payment gateway?") ) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('payment-gateway.destroy', 0) }}",
                    data: "gateway_id=" + gateway_id + "&_token={{ csrf_token() }}",
                    beforeSend: function() {
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);
                        var json = JSON.parse(response);

                        if ( json.status == "success" ) {
                            location.href = location.href;
                        }
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            }
            
        });

    </script>
@endsection