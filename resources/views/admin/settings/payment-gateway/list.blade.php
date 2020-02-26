@extends('layouts.admin')

@section("title", "Payment gateway List")

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

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Payment Gateways
                <small>All payment gateways</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.user.index') }}">User</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add User
                </li>
            </ol>
        </div>
    </div>


        <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-left">
                                <a href="{{ route('admin.payment-gateway.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Gateway</a>
                            </div>

                            <form class="form-inline text-right" role="form">
                                <div class="form-group">
                                    <label for="search">Search:</label>
                                    <input type="search" class="form-control" id="search" name="search" value="{{ (!empty($data['search'])) ? $data['search'] : '' }}">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <br />

    

        <div class="row">

            <div class="col-md-12 form-payment-gateway">

                @if ( $data['paymentGateways']->count() > 0 )
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
                                            <span><a href="{{ route('admin.payment-gateway.edit', $gateway->id) }}"
                                                               class="btn btn-default"><i class="fa fa-pencil"
                                                                                          aria-hidden="true"></i></a>
                                            </span>
                                            <span>
                                                    <a href="{{ route('admin.payment-gateway.destroy', $gateway->id) }}"
                                                               class="btn btn-danger"><i class="fa fa-trash"
                                                                                         aria-hidden="true"></i></a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        @endforeach
                    </div>
                @else
                    <p>No Gateway setup yet</p>
                @endif

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


    </script>
@endsection