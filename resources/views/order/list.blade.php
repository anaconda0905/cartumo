@extends('layouts.app')

@section("title", "Sales Page")

@section('content')



    <!-- page content -->
            <div class="right_col" role="main">
              <div class="">
                <div class="page-title">
                  <div class="title_left">
                    <h3>Sales Page</h3>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Recent Sales</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li><!-- id="sales_csv_download" -->
                          <li><a href="{{ route('order.download') }}"><i class="fa fa-download" aria-hidden="true" alt="Download CSV" title="Download CSV"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">


                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Date</th> <th>Product</th> <th>Amount</th> <th>Customer</th> <th>Status</th> <th class="text-right"></th>
                                      </tr>
                                  </thead>

                                  <tbody>
                                      @if ( !empty($orders) )
                                          @foreach ($orders as $key => $order)
                                              <?php $json = json_decode($order->orderDetails->order->stripe); ?>
                                              <?php $shopify = json_decode($order->orderDetails->order->shopify); ?>
                                              <tr>
                                                  <td>{{ date('M d, Y', strtotime($order->updated_at)) }}</td>
                                                  <td><strong>{{ $shopify->product->title }}</strong></td>
                                                  <td>{{ $shopify->currency }} {{ $shopify->amount }}</td>
                                                  <td>
                                                      <strong>{{ $json->customer->first_name }} {{ $json->customer->last_name }}</strong>
                                                      <p>{{ $json->customer->email }}</p>
                                                  </td>
                                                  <td>
                                                      @if ( $json->charge->status == 'succeeded' )
                                                          <span class="badge alert-success">{{ $json->charge->status }}</span>
                                                      @endif
                                                  </td>
                                                  <td class="text-right">
                                                      <a href="#" class="btn btn-default"> DETAILS </a>
                                                  </td>
                                              </tr>

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




@endsection
    <!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
