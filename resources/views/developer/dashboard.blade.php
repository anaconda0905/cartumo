@extends('layouts.developer')

@section("title", "Dashboard")

@section('styles')
    <style>
        .dashboard-search {
            border: 0px;
            box-shadow: none;
        }
    </style>
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">


        <!-- top tiles -->
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#1abb9c"><i class="fa fa-filter" aria-hidden="true"></i></div>
                    <div class="count">{{-- $data['total_funnels'] --}}0</div>
                    <h3>Total Templates</h3>
                    <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#3c9b7d"><i class="fa fa-dollar"></i></div>
                    <div class="count">{{-- $data['total_sales'] --}}0</div>
                    <h3>Total Sales</h3>
                    <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#e4a851"><i class="fa fa-users"></i></div>
                    <div class="count">{{-- count($data['customers']) --}}0</div>
                    <h3>Customers</h3>
                    <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#2574b2"><i class="fa fa-eye"></i></div>
                    <div class="count">{{-- $data['total_visitors'] --}}0</div>
                    <h3>Visitors</h3>
                    <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
            </div>
        </div>
        <!-- /top tiles -->




        <div class="row clearfix" style="margin-top: 20px;">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="float: none">Sales Graph
                            <small style="font-size: 15px;color: #3c9b7d;padding-left: 25%;">Total Sales for the last 6 months</small>
                        </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="lineChartDashboard"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <p style="font-size: 15px;color: #3c9b7d;">Coming Soon.... Cartumo Analytics</p>
                <div id="world-map-gdp" style="height:400px;"></div>
            </div>
        </div>
    </div>
@endsection
<?php //echo implode(',', $data['orders_by_months']); die; ?>
@section('scripts')


@endsection
