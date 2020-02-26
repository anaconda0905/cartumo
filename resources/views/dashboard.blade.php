@extends('layouts.app')

@section("title", "Dashboard")

@section('styles')
    <style>
        .dashboard-search {
            border: 0px;
            box-shadow: none;
        }

        .media-body, .media-left, .media-right {
            vertical-align: middle;
            padding-top: 3px;
        }

        .media .date i {
            font-size: 24px;
        }

        .media .date {
            background: transparent;
            width: auto;
            margin-right: 10px;
            border-radius: 10px;
            padding: 0px;
        }

        .event .media-body a.title {
            font-size: 15px;
        }

        .user-icon {
            background: #ccc;
            width: 52px;
            margin-right: 10px;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            width: 54px;
            height: 54px;
            line-height: 40px;
            border-radius: 100px;
        }

        .user-icon > i {
            font-size: 24px;
        }

        ul.top_profiles {
            height: auto;
        }

        #recent_customers {
            height: auto;
        }

        #recent_customers .x_content {
            max-height: 120px;
            overflow-y: auto;
        }

        #recent_customers ul.scroll-view > li {
            display: inline-flex;
            width: 100%;
        }

        #recent_customers ul.scroll-view > li .media-body {
            padding-top: 11px;
        }

        #recent_customers .media .profile_thumb {
            width: 42px;
            height: 42px;
        }

        #recent_customers .media .profile_thumb i {
            font-size: 22px;
        }

        #product_sell {
            height: auto;
        }
        #product_sell table.tile_info td:first-child {
            width: 80%;
        }
        #product_sell table.tile_info td:last-child {
            width: 20%;
        }
    </style>
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">

        <!--<div class="row clearfix">
            <div class="col-md-12">
                <div class="x_panel" style="padding: 0px;">
                    <div class="dashboard-search">
                        <form action="" method="post">
                            <div class="form-group col-sm-12 col-md-10 col-xs-12">
                                <input type="text" name="search" class="form-control" placeholder="Search funnels ..."/>
                            </div>

                            <div class="col-sm-12 col-md-2 col-xs-12">

                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#newFunnelModal">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->


        <!-- top tiles -->
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#1abb9c"><i class="fa fa-filter" aria-hidden="true"></i></div>
                    <div class="count">{{ $data['total_funnels'] }}</div>
                    <h3>Total Funnels</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#3c9b7d"><i class="fa fa-dollar"></i></div>
                    <div class="count">{{ $data['total_sales'] }}</div>
                    <h3>Total Sales</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#e4a851"><i class="fa fa-users"></i></div>
                    <div class="count">{{ count($data['customers']) }}</div>
                    <h3>Customers</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon" style="color:#2574b2"><i class="fa fa-eye"></i></div>
                    <div class="count">{{ $data['total_visitors'] }}</div>
                    <h3>Visitors</h3>
                </div>
            </div>
        </div>
    <!--<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-filter"></i> Total Funnels</span>
                <div class="count">{{ $data['total_funnels'] }}</div>
                <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
                <div class="count">{{ count($data['customers']) }}</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-dollar"></i> Total Sales</span>
                <div class="count green">{{ $data['total_sales'] }}</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-cubes"></i> Manual Products</span>
                <div class="count">{{ $data['total_visitors'] }}</div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-cubes"></i> Shopify Products</span>
                <div class="count">{{ $data['total_visitors'] }}</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Returning Customers</span>
                <div class="count">{{ $data['total_visitors'] }}</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
        </div>-->
        <!-- /top tiles -->


        <div class="row clearfix">
            <div class="rows clearfix">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="dashboard_graph x_panel">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Sales Chart
                                    <small>Sales report of this month</small>
                                </h3>
                            </div>
                        <!--<div class="col-md-6">
                                <?php
						$period = 180;//90 for 3 months, 180 for 6 months

						$until = strtotime( 'now' );
						$from = strtotime( "-$period days" );
						?>
                                <div id="reportrange" class="pull-right"
                                     style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span><?php echo date( 'M d, Y', $from ) ?> - January 28, 2015</span> <b class="caret"></b>
                                </div>
                            </div>-->
                        </div>
                        <div class="x_content">
                            <canvas id="lineChartDashboard"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="product-type-stats">
                        <div class="x_panel tile fixed_height_320 overflow_hidden" id="product_sell">
                            <div class="x_title">
                                <h2>Product Sale</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="" style="width:100%">
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <canvas class="canvasDoughnut" height="140" width="140"
                                                    style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>Shopify Products </p>
                                                    </td>
                                                    <td>{{ (!empty($data['top_products_sell_rank']['shopify'])) ? $data['top_products_sell_rank']['shopify'] : 0 }}%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>Manual Products </p>
                                                    </td>
                                                    <td>{{ (!empty($data['top_products_sell_rank']['manual'])) ? $data['top_products_sell_rank']['manual'] : 0 }}%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <th>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <p class="">Manual Products</p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <p class="">Shopify Products</p>
                                            </div>
                                        </th>
                                    </tr>-->
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel tile fixed_height_320 overflow_hidden" id="recent_customers">
                        <div class="x_title">
                            <h2>Recent Customers</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <ul class="list-unstyled top_profiles scroll-view">
                                @if ( !empty($data['recent_customers']) )
                                    @foreach( $data['recent_customers'] as $recent_customer )
                                        <li class="media event">
                                            <a class="pull-left border-aero profile_thumb">
                                                <i class="fa fa-user aero"></i>
                                            </a>
                                            <div class="media-body">
                                                <strong class="title">{{ $recent_customer['name'] }}</strong>
                                                <p>
                                                    <small>{{ $recent_customer['email'] }}</small>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <p>No customers</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Funnels</h2>
                        <!--<ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ( !empty($data['top_funnels']) )
                            @foreach ( $data['top_funnels'] as $top_funnel )
                                @if ( $top_funnel['total_amount'] > 0 )
                                    <article class="media event">
                                        <a class="pull-left date">
                                            @if ( $top_funnel['type'] == 'manual' )
                                                <div class="funnel-demo-icon">
                                                    <span class="glyphicon glyphicon-filter"></span>
                                                </div>
                                            @else
                                                <img src="{{ asset('global/img/shopify.png') }}" style="width: 52px">
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">{{ $top_funnel['name'] }}</a>
                                            <p>Total Sales: <strong>${{ $top_funnel['total_amount'] }}</strong></p>
                                        </div>
                                    </article>
                                @endif
                            @endforeach
                        @else
                            <p>No sales has been made yet</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Products</h2>
                        <!--<ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ( !empty($data['top_products']) && (count($data['top_products']) > 0) )
                            @foreach( $data['top_products'] as $product )
                                <article class="media event">
                                    <a class="pull-left date">
                                        @if ( $product->product_type == 'manual' )
                                            <div class="funnel-demo-icon">
                                                <span class="glyphicon glyphicon-filter"></span>
                                            </div>
                                        @else
                                            <img src="{{ asset('global/img/shopify.png') }}" style="width: 52px">
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <a class="title" style="font-size: 13px">{{ $product->product_name }}</a>
                                        <p>{{ ucfirst($product->product_type) }} product</p>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p>No product has been sold yet</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Customers</h2>
                        <!--<ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ( !empty($data['top_customers']) && (count($data['top_customers']) > 0) )
                            @foreach( $data['top_customers'] as $customer )
                                <article class="media event">
                                    <a class="pull-left user-icon">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <div class="media-body">
                                        <strong class="title">{{ $customer->customer_name }}</strong>
                                        <p>{{ $customer->customer_email }}</p>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p>No customers</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php //echo implode(',', $data['orders_by_months']); die; ?>
@section('scripts')

<script>
    /*function init_flot_chart(){

        if( typeof ($.plot) === 'undefined'){ return; }

        console.log('init_flot_chart');

        var chart_plot_03_data = [
            [0, 10],
            [1, 9],
            [2, 6],
            [3, 10],
            [4, 0],
            [5, 0],
            [6, 5],
            [7, 0],
            [8, 5],
            [9, 5],
            [10, 5],
            [11, 10],
            [12, 9],
            [13, 6],
            [14, 10],
            [15, 5],
            [16, 0],
            [17, 5],
            [18, 0],
            [19, 0],
            [20, 5]
            [21, 5]
        ];

        var chart_plot_03_settings = {
            series: {
                curvedLines: {
                    apply: true,
                    active: true,
                    monotonicFit: true
                }
            },
            colors: ["#26B99A"],
            grid: {
                borderWidth: {
                    top: 0,
                    right: 0,
                    bottom: 1,
                    left: 1
                },
                borderColor: {
                    bottom: "#7F8790",
                    left: "#7F8790"
                }
            }
        };

        if ($("#sales_chart").length){
            console.log('Plot3');


            $.plot($("#sales_chart"), [{
                label: "Registrations",
                data: chart_plot_03_data,
                lines: {
                    fillColor: "rgba(150, 202, 89, 0.12)"
                },
                points: {
                    fillColor: "#fff"
                }
            }], chart_plot_03_settings);

        };
    }*/


    if ($("#lineChartDashboard").length) {
        //var monthes = [<?php echo '"' . implode( '","', $data['monthes'] ) . '"' ?>];
        //var counts = [<?php echo implode( ',', $data['orders_by_months'] ) ?>];
        //alert(monthes);
        var f = document.getElementById("lineChartDashboard");
        new Chart(f, {
            type: "line",
            data: {
                //labels: [<?php echo '"' . implode( '","', $data['monthes'] ) . '"' ?>],
                labels: [<?php echo '"' . implode( '","', range(1, 31) ) . '"' ?>],
                datasets: [{
                    label: "Monthly Sales",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    //data: ['100', '200']
                    data: [<?php echo implode( ',', $data['orders_by_months'] ) ?>]
                }]
            }
        });
    }


    function init_chart_doughnut() {
        if ("undefined" != typeof Chart && (console.log("init_chart_doughnut"), $(".canvasDoughnut").length)) {
            var a = {
                type: "doughnut",
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: ["Shopify", "Manual"],
                    datasets: [{
                        data: [<?php echo (!empty($data['top_products_sell_rank'])) ? implode(',', array_reverse($data['top_products_sell_rank'])) : 100 ?>],
						<?php if ((!empty($data['top_products_sell_rank']))) { ?>
                        backgroundColor: ["#26B99A", "#3498DB"],
                        hoverBackgroundColor: ["#36CAAB", "#49A9EA"],
						<?php } else { ?>
                        backgroundColor: ["#EEEEEE", "#EEEEEE"],
                        hoverBackgroundColor: ["#EEEEEE", "#EEEEEE"]
						<?php } ?>
                    }]
                },
                options: {legend: !1, responsive: !1}
            };
            $(".canvasDoughnut").each(function () {
                var b = $(this);
                new Chart(b, a)
            })
        }
    }
</script>

@endsection
