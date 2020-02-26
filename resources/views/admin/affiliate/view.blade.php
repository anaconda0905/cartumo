@extends('layouts.admin')

@section('title', 'Update Topic')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                User Affiliate Details
                <small>Affiliate Details</small>
                <div class="button-right-group" style="float: right">
                    @if ( !$affiliateProfile->status )
                        <button type="button" class="btn btn-success" id="button_approve">Approve</button>
                        <button type="button" class="btn btn-danger" id="button_not_approve">Cancel</button>
                    @elseif ( $affiliateProfile->status == 1 )
                        <button type="button" class="btn btn-danger" id="button_not_approve">Cancel</button>
                    @elseif ( $affiliateProfile->status == 2 )
                        <button type="button" class="btn btn-success" id="button_approve">Approve</button>
                    @endif
                </div>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.affiliate.index') }}">Affiliate</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Details
                </li>
            </ol>
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

    <div class="row">

        <div class="rows clearfix">
            <div class="row clearfix">
                @if ( count($affiliateProfile->tax_forms) > 0 )
                    @foreach ( $affiliateProfile->tax_forms as $tax_form )
                        <div class="col-md-4">
                            <a href="{{ URL::asset('frontend/upload/tax_forms/' . $tax_form[key($tax_form)]) }}"
                               class="btn btn-primary btn-block" target="_blank">{{ key($tax_form) }} Form</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <hr>

        <div class="rows clearfix">
            <div class="col-md-12">
                <h4>Settings</h4>
                <table class="table">
                    <tr>
                        <td>First name:</td>
                        <th>{{ (!empty($affiliateProfile->settings->first_name)) ? $affiliateProfile->settings->first_name : '' }}</th>
                    </tr>
                    <tr>
                        <td>Last name:</td>
                        <th>{{ (!empty($affiliateProfile->settings->last_name)) ? $affiliateProfile->settings->last_name : '' }}</th>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <th>{{ (!empty($affiliateProfile->settings->email)) ? $affiliateProfile->settings->email : '' }}</th>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <th>{{ (!empty($affiliateProfile->settings->phone)) ? $affiliateProfile->settings->phone : '' }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="rows clearfix">
            <div class="col-md-12">
                <h4>Address</h4>
                <table class="table">
                    <tr>
                        <td>Address 1:</td>
                        <th>{{ (!empty($affiliateProfile->address->address1)) ? $affiliateProfile->address->address1 : '' }}</th>
                    </tr>
                    <tr>
                        <td>Address 2:</td>
                        <th>{{ (!empty($affiliateProfile->address->address2)) ? $affiliateProfile->address->address2 : '' }}</th>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <th>{{ (!empty($affiliateProfile->address->country)) ? $affiliateProfile->address->country : '' }}</th>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <th>{{ (!empty($affiliateProfile->address->city)) ? $affiliateProfile->address->city : '' }}</th>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <th>{{ (!empty($affiliateProfile->address->state)) ? $affiliateProfile->address->state : '' }}</th>
                    </tr>
                    <tr>
                        <td>Zip:</td>
                        <th>{{ (!empty($affiliateProfile->address->zip)) ? $affiliateProfile->address->zip : '' }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="rows clearfix">
            <div class="col-md-12">
                <h4>Payments</h4>
                <table class="table">
                    <tr>
                        <td>Payments:</td>
                        <th>{{ (!empty($affiliateProfile->payments->paypal_email)) ? $affiliateProfile->payments->paypal_email : '' }}</th>
                    </tr>
                </table>
            </div>
        </div>

    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $(document).ready(function () {

            $("#button_approve").click(function (e) {

                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.affiliate.approve', $affiliateProfile->id) }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).attr('disabled', true);
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);
                        if (json.status == 'success') {
                            location.href = json.url;
                        }
                    }
                });
            });

            $("#button_not_approve").click(function (e) {

                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.affiliate.cancel', $affiliateProfile->id) }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).attr('disabled', true);
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);
                        if (json.status == 'success') {
                            location.href = json.url;
                        }
                    }
                });
            });
        });
    </script>
@endsection
