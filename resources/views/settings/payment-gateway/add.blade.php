@extends('layouts.app')

@section("title", "Payment Gateway")

@section('styles')
    <style>
        .tab-container > form > div {
            display: none;
        }

        .info-defails {

        }

        .info-defails ul {
            padding: 0px 0px;
            list-style-type: none;
        }

        .info-defails ul > li {
            padding: 4px 0px;
            font-size: 15px;
        }

        .info-defails ul > li:before {
            content: "\f105";
            font-family: FontAwesome;
            color: #45b39c; /* or whatever color you prefer */
            margin-right: 15px;
            font-weight: bold;
        }

        .info-defails ul > li a {
            color: #45b39c;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title clearfix">
            <div class="title_left">
                <h3 class="dashboard-page-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Setup New
                    Payment Gateway</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <hr/>

        <div class="row clearfix">

            <div class="col-md-7">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="form-group">
                            @if ( !empty($data['availableGateways']) )
                                <select name="type" class="form-control payment-types">

                                    <option value="">--Select--</option>
                                    @foreach ( $data['availableGateways'] as $key=>$availableGateway )
                                        <option data-target-id="{{ strtolower($key) }}_content"
                                                class="tab_{{ strtolower($key) }}"
                                                value="{{ $key }}"><i
                                                    class="{{ $availableGateway[0]['icon'] }}" aria-hidden="true"></i>
                                            &nbsp; {{ ucfirst($key) }}</option>
                                    @endforeach
                                </select>
                            @else
                                <h5>All payment gateway has been configured.</h5>
                                <a class="btn btn-primary" href="{{ route('payment-gateway.index') }}"> Back </a>
                            @endif
                        </div>

                        <div class="tab-container">
                            @if ( !empty($data['availableGateways']) )
                                @foreach ( $data['availableGateways'] as $key=>$availableGateway )
                                    {!! Form::open(array('id' => 'frm_'.strtolower($key).'_add_gateway', 'route' => 'payment-gateway.store', 'data-parsley-required' => '', 'class' => 'form-horizontal form-label-left input_mask')) !!}
                                    <div id="{{ strtolower($key) }}_content" class="{{ strtolower($key) }}">

                                        @foreach ( $availableGateway[0] as $k=>$field )
                                            @if ( ($k !== 'icon') && ($k !== 'active') )
                                                @if ( !is_array($field) )
                                                    <div class="form-group">
                                                        {{ Form::label(strtolower($k), ucwords(str_replace ('_', ' ', $k)) . ":") }}
                                                        {{ Form::text(strtolower($k), null, array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255, 'placeholder' => ucwords($field))) }}
                                                    </div>
                                                @else
                                                    @if ( $k == 'icon' )
                                                        <div class="form-group">
                                                            {{ Form::label(strtolower($k), ucwords($k) . ":") }}
                                                            {{ Form::select(strtolower($k), $field, null, array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255)) }}
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        <input type="hidden" name="gateway" value="{{ strtolower($key) }}"/>
                                        <button type="submit" id="button_{{ $key }}_add_gateway"
                                                class="btn btn-primary btn-lg"
                                                onclick="add_gateway('{{ $key }}'); return false;"> Save {{ $key }}
                                            Details
                                        </button>

                                    </div>
                                    {!! Form::close() !!}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="x_panel panel-for-paypal" style="display: none">
                    <div class="x_content info-defails info_paypal_content">
                        <h4>Please Review PayPal's User Documentation to retrieve your PayPal API Credentials</h4>
                        <hr/>
                        <ul>
                            <li><a href="https://developer.paypal.com/docs/classic/lifecycle/goingLive/"
                                   target="_blank">PayPal Credentials Documentation</a></li>
                            <!--<li>Go to PayPal <a href="https://developer.paypal.com/" target="_blank">Developer Account</a>
                            <li>Login into Dashboard</li>
                            <li>Create an App</li>
                            <li>Your API Credentials for both Sandbox and live are located under the App Details Tab.</li>-->
                        </ul>
                    </div>
                </div>

                <div class="x_panel panel-for-stripe" style="display: none">
                    <div class="x_content info-defails info_stripe_content">
                        <h4>Please Review Stripes User Documentation to retrieve your Stripe API Credentials</h4>
                        <hr/>
                        <ul>
                            <li><a href="https://stripe.com/docs/dashboard#api-keys" target="_blank"> Stripe Credentials
                                    Documentation </a></li>
                            <!--<li>Login to <a href="https://dashboard.stripe.com" target="_blank">Stripe Developer</a>
                            <li>From the menu located on the left side of the screen, select API</li>
                            <li>In the next page, grab the credentials</li>-->
                        </ul>
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
        var tmp_info_content;
        $(".payment-types").change(function (e) {

            e.preventDefault();

            //alert("#" + $('option:selected', this).attr('data-target-id'));

            $(tmp_content).hide();
            $(tmp_info_content).parent().hide();

            $(this).addClass('active');
            $("#" + $('option:selected', this).attr('data-target-id')).show();

            var info_class = $('option:selected', this).attr('data-target-id');

            //alert(".info_" + info_class);
            $(".info_" + info_class).parent().show();

            tmp_info_content = $(".info_" + info_class);
            tmp_content = $("#" + $('option:selected', this).attr('data-target-id'));
        });

        function add_gateway(gateway_type) {

            var element = $("#button_" + gateway_type.toLowerCase() + "_add_gateway");
            var form = $("#frm_" + gateway_type.toLowerCase() + "_add_gateway");
            //alert($(form).attr('action'));

            $.ajax({
                type: 'post',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                beforeSend: function () {
                    $(element).html('<i class="fa-li fa fa-spinner fa-spin"></i> saving');
                    $(element).prop('disabled', 'disabled');
                },
                success: function (response) {
                    $(element).html('Save');
                    $(element).prop('disabled', '');
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        location.href = json.url;
                    } else {
                        alert(json.message)
                    }

                    //$(element).after('<div class="alert alert-success"><strong>Success!</strong> Indicates a successful or positive action.</div>');
                }
            });
        }
    </script>
@endsection
