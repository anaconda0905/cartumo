@extends('layouts.app')

@section("title", "API Integration List")

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
                    <h2 class="dashboard-page-title"><i class="fa fa-plug"></i> Manage API Integration</h2>
                    <div class="row">
                        <div class="dashboard-search">
                            <form action="" method="post">
                                <div class="form-group col-sm-12 col-md-9 col-xs-12">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="Search integrations ..."/>
                                </div>

                                <div class="col-sm-12 col-md-2 col-xs-12">

                                    <button type="button" class="btn special-button-primary" data-toggle="modal"
                                            data-target="#newIntegrationModal">
                                        <i class="fa fa-plus" aria-hidden="true"></i> New Integration
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="x_panel">
                        <div class="x_content">

							<?php //print_r($data['integrations']); die; ?>

                            <div class="row">
                                <div class="col-md-12s col-sm-12s col-xs-12s">
                                    <div class="dashboard_graph">

                                        <div class="col-xs-12s bg-white integration-tabs">
                                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                                                    <li role="presentation" class="active"><a href="#tab_showall"
                                                                                              role="tab"
                                                                                              id="marketplace-tabb3"
                                                                                              data-toggle="tab"
                                                                                              aria-controls="marketplace"
                                                                                              aria-expanded="false"><i
                                                                    class="fa fa-bars" aria-hidden="true"></i> Show All</a>
                                                    </li>
                                                    @foreach ( $data['integrations'] as $key=>$integration )
                                                    <li role="presentation">
                                                        <a href="#tab_show{{ $key }}"
                                                           role="tab"
                                                           id="marketplace-tabb3{{ $key }}"
                                                           data-toggle="tab"
                                                           aria-controls="marketplace"
                                                           aria-expanded="false">
                                                            <i class="fa {{ $integration['icon'] }}"
                                                               aria-hidden="true"></i> &nbsp; {{ ucfirst($key) }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>

                                                <div id="myTabContent2" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade active in"
                                                         id="tab_showall"
                                                         aria-labelledby="home-tab">

                                                        <div class="integration-list">
                                                            @if ( $data['userIntegrations']->count() > 0 )
                                                            @foreach ( $data['userIntegrations'] as
                                                            $key=>$userIntegration )

                                                            <table class="table">
                                                                <tr>
                                                                    <td class="integration-details" style="width:30%">
                                                                        <span><img src="{{ asset('frontend/images/integration/' . strtolower($userIntegration->service_type) . '.png') }}"/></span>
                                                                        <span>{{ ucfirst($userIntegration->service_type) }}</span>
                                                                    </td>
                                                                    <td style="width:50%">{{ $userIntegration->name }}
                                                                    </td>
                                                                    <td class="text-right" style="width:20%">
                                                                                <span><button type="button"
                                                                                              class="btn edit-integration"
                                                                                              data-service-type="{{ $userIntegration->service_type }}"
                                                                                              data-integration-id="{{ $userIntegration->id }}"
                                                                                              data-toggle="modal"
                                                                                              data-target="#editIntegrationModal">
                                                                                    <i class="fa fa-pencil"
                                                                                       aria-hidden="true"></i>
                                                                                </button></span>
                                                                        <span><button type="button"
                                                                                      class="btn btn-danger remove-integration"
                                                                                      data-service-type="{{ $userIntegration->service_type }}"
                                                                                      data-integration-id="{{ $userIntegration->id }}">
                                                                                    <i class="fa fa-trash"
                                                                                       aria-hidden="true"></i>
                                                                                </button></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            @endforeach
                                                            @else
                                                            <p>No Integration</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @foreach ( $data['integrations'] as $key=>$integrations )
                                                    <div role="tabpanel" class="tab-pane fade" id="tab_show{{ $key }}">
                                                        <div class="integration-list">
                                                            @if ( $data['userIntegrations']->count() > 0 )
                                                            @foreach ( $data['userIntegrations'] as
                                                            $user_key=>$userIntegration )

                                                            @if ( $userIntegration->type == $key )

                                                            <table class="table">
                                                                <tr>
                                                                    <td class="integration-details" style="width:30%">
                                                                        <span><img src="{{ asset('frontend/images/integration/' . strtolower($userIntegration->service_type) . '.png') }}"/></span>
                                                                        <span>{{ ucfirst($userIntegration->service_type) }}</span>
                                                                    </td>
                                                                    <td style="width:50%">{{ $userIntegration->name }}
                                                                    </td>
                                                                    <td class="text-right" style="width:20%">
                                                                                            <span><button type="button"
                                                                                                          class="btn edit-integration"
                                                                                                          data-service-type="{{ $userIntegration->service_type }}"
                                                                                                          data-integration-id="{{ $userIntegration->id }}"
                                                                                                          data-toggle="modal"
                                                                                                          data-target="#editIntegrationModal">
                                                                                                <i class="fa fa-pencil"
                                                                                                   aria-hidden="true"></i>
                                                                                            </button></span>
                                                                        <span><button type="button"
                                                                                      class="btn btn-danger remove-integration"
                                                                                      data-service-type="{{ $userIntegration->service_type }}"
                                                                                      data-integration-id="{{ $userIntegration->id }}">
                                                                                                <i class="fa fa-trash"
                                                                                                   aria-hidden="true"></i>
                                                                                            </button></span>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            @endif

                                                            @endforeach
                                                            @else
                                                            <p>No Integration</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            @elseif ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') )
                                            (${{ env('YEARLY_PLAN') }} / YEAR)
                                            @elseif ( Auth::user()->secret == env('REGISTER_CODE_LIFETIME_PROMO') )
                                            <b style="color:#45b39c; text-transform: none">7 days free trial</b>
                                            @else
                                            <b style="color:#45b39c; text-transform: none">Lifetime</b>
                                            @endif
                                            @else
                                            @if ( Auth::user()->subscription('main')->onTrial() )
                                            <b style="color:#45b39c; text-transform: none">You are on Trial period</b>
                                            @endif
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
                                        <td>${{ $data['total_sales'] }}</td>
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



    <!-- Modal -->
    <div id="newIntegrationModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="frm_new_integration" action="{{ route('integration.store') }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Integration</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="integration_title">Title</label>
                                    <input type="text" name="integration_title" id="integration_title"
                                           class="form-control"
                                           placeholder="give integration a name" required/>
                                </div>

                                <div class="col-md-6">
                                    <label for="choose_service">Choose Services</label>
                                    <select class="form-control" name="choose_service" id="choose_service">
                                        <option value="">Select Integration type</option>
                                        @if ( !empty($data['availableIntegrations']) )
                                        @foreach ( $data['availableIntegrations'] as $key=>$availableIntegrations )
                                        @foreach ( $availableIntegrations as $sub_key=>$availableIntegration )
                                        <option value="{{ $sub_key }},{{ $key }}">{{ ucfirst($sub_key) }}</option>
                                        @endforeach
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        </div>

                        <div class="form-group dynamic-service-details">
                            <p>No Service Selected</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn special-button-success"><i class="fa fa-floppy-o"
                                                                                    aria-hidden="true"></i>
                            Save Integration
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="editIntegrationModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Integration</h4>
                </div>

                <div class="modal-body">
                </div>

            </div>

        </div>
    </div>

    @endsection
    <!-- js placed at the end of the document so the pages load faster -->

    @section('scripts')
    <script>
        $(document).on("change", "#choose_service", function (e) {

            e.preventDefault();

            var integration = $(this).val();

            //alert($(this).val());

            $.ajax({
                type: 'POST',
                url: "{{ route('integration.get_details') }}",
                data: 'integration=' + integration + '&_token=' + "{{ csrf_token() }}",
                beforeSend: function () {
                    $(".dynamic-service-details").html("<img src='{{ asset('images/ajax-loader.gif') }}' />");
                },
                success: function (response) {
                    console.log(response);
                    $(".dynamic-service-details").html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            })

        });


        $(document).on("click", ".edit-integration", function (e) {

            e.preventDefault();

            var integration_id = $(this).attr('data-integration-id');

            //alert(integration_id);

            $.ajax({
                type: 'POST',
                url: "{{ route('integration.update_details') }}",
                data: 'id=' + integration_id + '&type=' + $(this).attr('data-service-type') + '&_token=' + "{{ csrf_token() }}",
                beforeSend: function () {
                    $(".dynamic-service-details").html("<img src='{{ asset('images/ajax-loader.gif') }}' />");
                },
                success: function (response) {
                    console.log(response);
                    $("#editIntegrationModal .modal-body").html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });

        });


        $(document).on("click", ".remove-integration", function (e) {

            e.preventDefault();

            if (confirm("Are you sure to delete this integration and details?")) {

                var integration_id = $(this).attr('data-integration-id');
                var row = $(this).parent().parent().parent().parent().parent();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('integration.remove') }}",
                    data: 'id=' + integration_id + '&type=' + $(this).attr('data-service-type') + '&_token=' + "{{ csrf_token() }}",
                    beforeSend: function () {
                        $(row).css('opacity', '0.25');
                    },
                    success: function (response) {
                        //alert(response);
                        console.log(response);
                        $(row).css('opacity', '1');

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });

            }
        });
    </script>
    @endsection
