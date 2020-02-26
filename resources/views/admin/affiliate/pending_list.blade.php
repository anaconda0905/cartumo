@extends('layouts.admin')

@section('title', 'Affiliates Pending')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')

    <section id="main-content">
        <section class="wrapper wrapper-area">

            @include('admin.elements.notifications')

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Affiliates
                        <small>All Affiliates pendings</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="active">
                            <i class="fa fa-file"></i> Affiliates
                        </li>
                    </ol>


                    @if (session('status'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">

                    <form class="form-inline text-right" role="form">
                        <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="search" class="form-control" id="search" name="search"
                                   value="{{ (!empty($data['search'])) ? $data['search'] : '' }}">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>User</th>
                            <th>PayPal Email</th>
                            <th class="text-right">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( count($uerAffiliatePayments) > 0 )
                            @foreach($uerAffiliatePayments as $uerAffiliatePayment)
								<?php $profile = $uerAffiliatePayment->getProfile( $uerAffiliatePayment->user_id ); ?>
                                <tr>
                                    <td>
                                        @if ( !empty( $profile) )
                                            {{ $profile->affiliate_id }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ( !empty($profile) )
                                            {{ $profile->user->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ( !empty($profile) )
                                            {{ json_decode($profile->payments)->paypal_email }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        ${{ $uerAffiliatePayment->amount }}
                                    </td>
                                    <td class="text-center">
                                        @if($uerAffiliatePayment->status == 1)
                                            <span class="label label-success label-mini spn-status"
                                                  help-id="{{ $uerAffiliatePayment->id }}">Paid</span>
                                        @elseif($uerAffiliatePayment->status == 0)
                                            <span class="label label-default label-mini spn-status"
                                                  help-id="{{ $uerAffiliatePayment->id }}">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <button type="button" title="Cancel"
                                                data-action="{{ route('admin.affiliate.payment.done', [$uerAffiliatePayment->id]) }}"
                                                class="btn btn-success affiliate_payment_done"><i class="fa fa-check"
                                                                                                  aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No pages</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="row text-center">
                    {!! $uerAffiliatePayments->links() !!}
                </div>

            </div>
        </section>
    </section>





@endsection


@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {

            $(".affiliate_payment_done").click(function (e) {

                e.preventDefault();
                var button = $(this);

                $.ajax({
                    type: 'post',
                    url: $(this).attr('data-action'),
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).attr('disabled', true);
                    },
                    success: function (response) {
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