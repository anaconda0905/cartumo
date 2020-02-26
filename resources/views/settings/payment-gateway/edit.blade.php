@extends('layouts.app')

@section("title", "Update Payment Gateway")

@section('styles')
    <style>
        .tab-container > form > div {
            /*display: none;*/
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

    <!--<pre><?php print_r($data['availableGateways']) ?></pre>-->


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title clearfix">
            <div class="title_left">
                <h3 class="dashboard-page-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Update payment Gateway</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row clearfix">

            <div class="col-md-7">
                <div class="x_panel">
                    <div class="x_content">


                        <div class="tab-container">

                            <?php $details = json_decode($data['gateway']->details, TRUE); ?>

                            @if ( !empty($data['availableGateways']) )
                                @foreach ( $data['availableGateways'] as $key=>$availableGateway )

                                    @if ( strtolower($key) == strtolower($data['gateway']->type) )
                                        {!! Form::open(array('id' => 'frm_update_gateway', 'route' => ['payment-gateway.update', $data['gateway']], 'data-parsley-required' => '', 'class' => 'form-horizontal form-label-left input_mask')) !!}
                                        <div id="{{ strtolower($key) }}_content" class="{{ strtolower($key) }}">

                                            @foreach ( $availableGateway[0] as $k=>$field )
                                                @if ( ($k !== 'icon') && ($k !== 'active') )
                                                    @if ( !is_array($field) )
                                                        <div class="form-group">
                                                            {{ Form::label(strtolower($k), ucfirst(str_replace ('_', ' ', $k)) . ":") }}
                                                            {{ Form::text(strtolower($k), $details[strtolower($k)], array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255, 'placeholder' => strtolower($field))) }}
                                                        </div>
                                                    @else
                                                        @if ( $k == 'icon' )
                                                            <div class="form-group">
                                                                {{ Form::label(strtolower($k), ucfirst($k) . ":") }}
                                                                {{ Form::select(strtolower($k), $field, null, array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255)) }}
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach

                                            <input type="hidden" name="gateway" value="{{ strtolower($key) }}"/>
                                            <button type="submit" id="button_update_gateway"
                                                    class="btn btn-primary btn-lg"> Save {{ $key }}
                                                Details
                                            </button>

                                        </div>
                                        {!! Form::close() !!}
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">


                @if ( strtolower($data['gateway']->type) == "stripe" )
                    <div class="x_panel panel-for-stripe">
                        <div class="x_content info-defails info_stripe_content">
                            <h4>Please Review Stripes User Documentation to retrieve your Stripe API Credentials</h4>
                            <hr />
                            <ul>
                                <li> <a href="https://stripe.com/docs/dashboard#api-keys" target="_blank"> Stripe Credentials Documentation </a></li>
                                    <!--<li>Login to <a href="https://dashboard.stripe.com" target="_blank">Stripe Developer</a>
                                    <li>From the menu located on the left side of the screen, select API</li>
                                    <li>In the next page, grab the credentials</li>-->
                            </ul>
                        </div>
                    </div>
                @elseif ( strtolower($data['gateway']->type) == "paypal" )
                    <div class="x_panel panel-for-paypal">
                        <div class="x_content info-defails info_paypal_content">
                            <h4>Please Review PayPal's User Documentation to retrieve your PayPal API Credentials</h4>
                            <hr />
                            <ul>
                                  <li><a href="https://developer.paypal.com/docs/classic/lifecycle/goingLive/" target="_blank">PayPal Credentials Documentation</a></li>
                                    <!--<li>Go to PayPal <a href="https://developer.paypal.com/" target="_blank">Developer Account</a>
                                    <li>Login into Dashboard</li>
                                    <li>Create an App</li>
                                    <li>Your API Credentials for both Sandbox and live are located under the App Details Tab.</li>-->
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script>
        var tmp_info_content;
        $("#frm_update_gateway").submit(function(e) {

            e.preventDefault();

            var element = $("#button_update_gateway");
            var form = $(this);
            //alert($(form).attr('action'));

            //alert($(form).serialize());

            $.ajax({
                type: 'PUT',
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
        });

    </script>
@endsection
