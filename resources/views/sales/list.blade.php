@extends('layouts.app')

@section("title", "Sales")

@section('styles')
    <style>
        .sales-report {
            font-family: Arial;
        }
    <</style>
@endsection

@section('content')



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3 class="dashboard-page-title"><i class="fa fa-bar-chart" aria-hidden="true"></i> All Sales</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row sales-report">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right">
                                    @if ( $orders->count() > 0 )
                                        <a href="{{ route('order.download') }}" class="btn special-button-warning"><i
                                                    class="fa fa-download" aria-hidden="true" alt="Download CSV"
                                                    title="Download CSV"></i> Download CSV</a>
                                    @endif
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th style="width: 20%">Product</th>
                                        <th>Amount</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th class="text-right"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if ( !empty($orders) )
                                        <?php $order_page_id = 0 ?>
                                        @foreach ($orders as $key => $order)

                                            @if ( $order->page_id == $order_page_id )
                                                <?php continue; ?>
                                            @endif

                                            <?php $order_page_id = $order->page_id; ?>
											<?php $details = json_decode( $order->orderDetails->details )->order; ?>

                                            @if ( !empty($details->paypal) )

												<?php $paypal = $details->paypal; ?>

                                                @if ( !empty(json_decode($order->orderDetails->details)->order->shopify) )
                                                    @if ( !empty($order->orderProduct) )
                                                        <?php $orderProductDetails = $order->orderProduct; ?>
                                                    @endif
													<?php $shopify = json_decode( $order->orderDetails->details )->order->shopify; ?>
                                                    <tr>
                                                        <td>
                                                            @if ( $order->orderDetails->type == 'shopify' )
                                                                <img src="{{ asset('frontend/images/shopify-product.png') }}"/>
                                                            @else
                                                                <img src="{{ asset('frontend/images/manual-product.png') }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('M d, Y', strtotime($order->updated_at)) }}</td>
                                                        <td style="width: 20%">
                                                            {{ $paypal->product->title }}

                                                            @if ( !empty($orderProductDetails) )
                                                                <?php $order_variant_details = json_decode($orderProductDetails->variant_details); ?>
                                                                @if ( !empty($order_variant_details->name) )
                                                                    - <br><small>{{ $order_variant_details->name }}</small>
                                                                @endif
                                                            @endif

                                                            (<strong>{{ \App\Models\FunnelType::find(\App\Models\FunnelStep::find(\App\Models\Page::find($order->page_id)->funnel_step_id)->type)->name }}</strong>)
                                                        </td>
                                                        <td>
                                                            <b style="color: #1ABB9C">{{ number_format(floatVal($shopify->amount - $shopify->discount),2) }} {{ $shopify->currency }}</b>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($shopify->shipping_method) && floatVal($shopify->shipping_method->amount) > 0.00 )
                                                                    <small>Shipping charge:
                                                                        <b>{{ $shopify->shipping_method->title }}
                                                                            ( {{ $shopify->shipping_method->amount }}
                                                                            )</b></small>
                                                                @endif

                                                                @if ( !empty($shopify->bump) )
                                                                    <small>Bump Product:
                                                                        <b>{{ $shopify->bump->title }}</b></small>
                                                                @endif
                                                            </p>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($shopify->discount) && floatVal($shopify->discount) > 0.00 )
                                                                    <small>Discount: <b>{{ $shopify->discount }}</b>
                                                                    </small>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $paypal->customer->first_name }} {{ $paypal->customer->last_name }}</strong>
                                                            <p style="margin-bottom: 0px">{{ $paypal->customer->email }}</p>
                                                        </td>
                                                        <td>
                                                            @if ( ($paypal->status == 'succeeded') || ($paypal->status == 'success')  || ($paypal->status == 'approved'))
                                                                <span class="badge alert-success">{{ $paypal->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <button href="#" class="btn btn-default btn-open-details"
                                                                    data-order-id="{{ $order->id }}" data-toggle="modal"
                                                                    data-target="#modalOrderDetails"> DETAILS
                                                            </button>
                                                        </td>
                                                    </tr>

                                                @else
                                                    @if ( !empty($order->orderProduct) )
                                                        <?php $orderProductDetails = $order->orderProduct; ?>
                                                    @endif
                                                    <tr>
                                                        <td>
                                                            @if ( $order->orderDetails->type == 'shopify' )
                                                                <img src="{{ asset('frontend/images/shopify-product.png') }}"/>
                                                            @else
                                                                <img src="{{ asset('frontend/images/manual-product.png') }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('M d, Y', strtotime($order->updated_at)) }}</td>
                                                        <td style="width: 20%">
                                                            {{ $paypal->product->title }}

                                                            @if ( !empty($orderProductDetails) )
                                                                <?php $order_variant_details = json_decode($orderProductDetails->variant_details); ?>
                                                                @if ( !empty($order_variant_details->name) )
                                                                    - <br><small>{{ $order_variant_details->name }}</small>
                                                                @endif
                                                            @endif

                                                            (<strong>{{ \App\Models\FunnelType::find(\App\Models\FunnelStep::find(\App\Models\Page::find($order->page_id)->funnel_step_id)->type)->name }}</strong>)

                                                        </td>
                                                        <td>
                                                            <b style="color: #1ABB9C">{{ number_format(floatVal($paypal->total_amount),2) }} {{ $paypal->currency }}</b>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($paypal->shipping_method) && floatVal($paypal->shipping_method->amount) > 0.00 )
                                                                    <small>Shipping charge:
                                                                        <b>{{ $paypal->shipping_method->title }}
                                                                            ( {{ $paypal->shipping_method->amount }}
                                                                            )</b></small>
                                                                @endif

                                                                @if ( !empty($paypal->bump) )
                                                                    <small>Bump Product:
                                                                        <b>{{ $paypal->bump->title }}</b></small>
                                                                @endif
                                                            </p>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($paypal->discount) && floatVal($paypal->discount) > 0.00 )
                                                                    <small>Discount: <b>{{ $paypal->discount }}</b>
                                                                    </small>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $paypal->customer->first_name }} {{ $paypal->customer->last_name }}</strong>
                                                            <p style="margin-bottom: 0px">{{ $paypal->customer->email }}</p>
                                                        </td>
                                                        <td>
                                                            @if ( ($paypal->status == 'succeeded') || ($paypal->status == 'success') || ($paypal->status == 'approved') )
                                                                <span class="badge alert-success">{{ $paypal->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <button href="#" class="btn btn-default btn-open-details"
                                                                    data-order-id="{{ $order->id }}" data-toggle="modal"
                                                                    data-target="#modalOrderDetails"> DETAILS
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif

                                            @elseif ( !empty($details->stripe) )

                                                <?php $stripe = $details->stripe; ?>

                                                @if ( !empty(json_decode($order->orderDetails->details)->order->shopify) )

                                                    <?php $shopify = json_decode( $order->orderDetails->details )->order->shopify; ?>
                                                    @if ( !empty($order->orderProduct) )
                                                        <?php $orderProductDetails = $order->orderProduct; ?>
                                                    @endif
                                                    <tr>
                                                        <td>
                                                            @if ( $order->orderDetails->type == 'shopify' )
                                                                <img src="{{ asset('frontend/images/shopify-product.png') }}"/>
                                                            @else
                                                                <img src="{{ asset('frontend/images/manual-product.png') }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('M d, Y', strtotime($order->updated_at)) }}</td>
                                                        <td style="width: 20%">
                                                            {{ $stripe->product->title }}
                                                            @if ( !empty($orderProductDetails) )
                                                                <?php $order_variant_details = json_decode($orderProductDetails->variant_details); ?>
                                                                @if ( !empty($order_variant_details->name) )
                                                                    - <br><small>{{ $order_variant_details->name }}</small>
                                                                @endif
                                                            @endif
                                                            @if ( !empty(\App\Models\Page::find($order->page_id)) )
                                                                (<strong>{{ \App\Models\FunnelType::find(\App\Models\FunnelStep::find(\App\Models\Page::find($order->page_id)->funnel_step_id)->type)->name }}</strong>)
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <b style="color: #1ABB9C">{{ number_format(floatVal($shopify->amount - $shopify->discount),2) }} {{ $shopify->currency }}</b>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($shopify->shipping_method) && floatVal($shopify->shipping_method->amount) > 0.00 )
                                                                    <small>Shipping charge:
                                                                        <b>{{ $shopify->shipping_method->title }}
                                                                            ( {{ $shopify->shipping_method->amount }}
                                                                            )</b></small>
                                                                @endif

                                                                @if ( !empty($shopify->bump) )
                                                                    <small>Bump Product:
                                                                        <b>{{ $shopify->bump->title }}</b></small>
                                                                @endif
                                                            </p>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($shopify->discount) && floatVal($shopify->discount) > 0.00 )
                                                                    <small>Discount: <b>{{ $shopify->discount }}</b>
                                                                    </small>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $shopify->customer->first_name }} {{ $shopify->customer->last_name }}</strong>
                                                            <p style="margin-bottom: 0px">{{ $shopify->customer->email }}</p>
                                                        </td>
                                                        <td>
                                                            @if ( ($stripe->status == 'succeeded') || ($stripe->status == 'success') )
                                                                <span class="badge alert-success">{{ $stripe->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <button href="#" class="btn btn-default btn-open-details"
                                                                    data-order-id="{{ $order->id }}" data-toggle="modal"
                                                                    data-target="#modalOrderDetails"> DETAILS
                                                            </button>
                                                        </td>
                                                    </tr>

                                                @else
                                                    @if ( !empty($order->orderProduct) )
                                                        <?php $orderProductDetails = $order->orderProduct; ?>
                                                    @endif
                                                    <tr>
                                                        <td>
                                                            @if ( $order->orderDetails->type == 'shopify' )
                                                                <img src="{{ asset('frontend/images/shopify-product.png') }}"/>
                                                            @else
                                                                <img src="{{ asset('frontend/images/manual-product.png') }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('M d, Y', strtotime($order->updated_at)) }}</td>
                                                        <td style="width: 20%">
                                                            {{ $details->info->product->title }}

                                                            @if ( !empty($orderProductDetails) )
                                                                <?php $order_variant_details = json_decode($orderProductDetails->variant_details); ?>
                                                                @if ( !empty($order_variant_details->name) )
                                                                    - <br><small>{{ $order_variant_details->name }}</small>
                                                                @endif
                                                            @endif

                                                            (<strong>{{ \App\Models\FunnelType::find(\App\Models\FunnelStep::find(\App\Models\Page::find($order->page_id)->funnel_step_id)->type)->name }}</strong>)
                                                            @if ( !empty($details->info->product->bump->product->title) )
                                                                <small>with BUMP -
                                                                    <b>{{ $details->info->product->bump->product->title }}</b>
                                                                </small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <b style="color: #1ABB9C">{{ number_format(floatVal($stripe->total_amount),2) }} {{ $stripe->currency }}</b>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($stripe->shipping_method) && floatVal($stripe->shipping_method->amount) > 0.00 )
                                                                    <small>Shipping charge:
                                                                        <b>{{ $stripe->shipping_method->title }}
                                                                            ( {{ $stripe->shipping_method->amount }}
                                                                            )</b></small>
                                                                @endif
                                                            </p>
                                                            <p style="margin: 0px;">
                                                                @if ( !empty($stripe->discount) && floatVal($stripe->discount) > 0.00 )
                                                                    <small>Discount: <b>{{ $stripe->discount }}</b>
                                                                    </small>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $stripe->customer->first_name }} {{ $stripe->customer->last_name }}</strong>
                                                            <p style="margin-bottom: 0px">{{ $stripe->customer->email }}</p>
                                                        </td>
                                                        <td>
                                                            @if ( ($stripe->status == 'succeeded') || ($stripe->status == 'success') )
                                                                <span class="badge alert-success">{{ $stripe->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <button href="#" class="btn btn-default btn-open-details"
                                                                    data-order-id="{{ $order->id }}" data-toggle="modal"
                                                                    data-target="#modalOrderDetails"> DETAILS
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif

                                            @endif

                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row text-center">
                                {!! $orders->links() !!}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->



    <!-- Modal -->
    <div id="modalOrderDetails" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order Details</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>




@endsection
<!-- js placed at the end of the document so the pages load faster -->


@section('scripts')

    <script>
        $(document).on('click', '.btn-open-details', function (e) {

            e.preventDefault();

            $.ajax({
                type: 'GET',
                //url: "{{ url('/') }}" + '/orders/' + $(this).attr('data-order-id'),
                url: "{{ route('sales.show', 0) }}",
                data: "_token={{ csrf_token() }}&order_id=" + $(this).attr('data-order-id'),
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        $("#modalOrderDetails .modal-body").html(json.html);
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });
    </script>
@endsection

