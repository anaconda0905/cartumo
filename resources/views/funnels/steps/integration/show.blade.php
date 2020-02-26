@extends('layouts.app')

@section("title", "Step Integration")

@section('styles')
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            margin-bottom: 0;
            padding: 0em;
            padding-left: 0em;
            font-size: 0em;
            height: auto;
        }

        #sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }
    </style>

@endsection

@section('content')


    <div class="area-container">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="funnel-page-inner-header">

                <div class="rows clearfix">
                    <div class="col-md-5">
                        <div class="title_left">
                            <ul>
                                <li>
                                    @if ( $funnel->type == 'manual' )
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img
                                                    src="{{ asset('frontend/images/manual-product.png') }}"/></a>
                                    @else
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img
                                                    src="{{ asset('frontend/images/shopify-product.png') }}"/></a>
                                    @endif
                                </li>
                                <li><a href="{{ route('funnels.show', $funnel->id) }}"><h3>{{ $funnel->name }}</h3></a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-md-7 text-right">
                        @include('funnels.partials.funnel-menu')
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-4 step-body-left">
                        <div class="x_panel funnel-steps-block step-body-right">
                            <!--<h2><i class="fa fa-bars" aria-hidden="true"></i> Funnel Steps</h2>-->
                            <ul class="funnel-steps-items funnel-steps-items-main">
                                <li><i class="fa fa-bars" aria-hidden="true"></i></li>
                                <li class="funnel-steps-caption">FUNNEL STEPS</li>
                            </ul>

                            <ul id="sortable" class="steps">
                                @foreach ($steps as $key => $step)

                                    @if ( $step->id == $currentStep->id )
                                        <li class="ui-state-default active"
                                            data-sort-position="{{ $step->order_position }}"
                                            data-step-id="{{ $step->id }}">
                                            <a data-funnel-id="{{ $funnel->id }}" data-step-id="{{ $step->id }}"
                                               href="{{ route('steps.show', array($funnel->id, $step->id)) }}">
                                                <ul class="step-details funnel-steps-items">
                                                    <li><?php echo App\Models\FunnelType::getIcon( $step->type ) ?></li>
                                                    <li>{{ $step->display_name }}
                                                        <small class="step-footer">{{ App\Models\FunnelType::getTypeName($step->type) }}</small>
                                                    </li>
                                                    <li><i class="fa fa-times" aria-hidden="true"></i></li>
                                                </ul>
                                            </a>
                                        </li>
                                    @else
                                        <li class="ui-state-default" data-sort-position="{{ $step->order_position }}"
                                            data-step-id="{{ $step->id }}">
                                            <a data-funnel-id="{{ $funnel->id }}" data-step-id="{{ $step->id }}"
                                               href="{{ route('steps.show', array($funnel->id, $step->id)) }}">
                                                <ul class="step-details funnel-steps-items">
                                                    <li><?php echo App\Models\FunnelType::getIcon( $step->type ) ?></li>
                                                    <li>{{ $step->display_name }}
                                                        <small class="step-footer">{{ App\Models\FunnelType::getTypeName($step->type) }}</small>
                                                    </li>
                                                    <li><i class="fa fa-times" aria-hidden="true"></i></li>
                                                </ul>
                                            </a>
                                        </li>
                                    @endif


                                @endforeach

                                <li class="button-area" style="padding-top: 15px;">
                                    <button class="btn special-button-primary btn-block" data-toggle="modal"
                                            data-target="#addFunnelModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Add
                                        New Step
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12 col-xs-12 funnel-step-area">


                        <div class="x_panel">
                            @if ( !empty($currentStep) )

                                {{--<div class="x_title">--}}
                                    {{--<h2>{{ $currentStep->display_name }}</h2>--}}
                                    {{--<ul class="nav navbar-right panel_toolbox">--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"--}}
                                               {{--class="collapse-link"><i class="fa fa-pie-chart"--}}
                                                                        {{--aria-hidden="true"></i> &nbsp;--}}
                                                {{--Overview</a>--}}
                                        {{--</li>--}}

                                        {{--@if ( (strtolower($currentType->name) == 'sales') ||  (strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )--}}
                                            {{--<li>--}}
                                                {{--<a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"--}}
                                                   {{--class="close-link"><i class="fa fa-cubes" aria-hidden="true"></i>--}}
                                                    {{--&nbsp;--}}
                                                    {{--Products</a>--}}
                                            {{--</li>--}}

                                            {{--<li>--}}
                                                {{--<a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"--}}
                                                   {{--class="collapse-link active"><i class="fa fa-plug"></i> &nbsp;--}}
                                                    {{--Integration</a>--}}
                                            {{--</li>--}}
                                        {{--@endif--}}
                                    {{--</ul>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}

                                @include('funnels.partials.funnel-option-menu')


                                <div class="x_content funnel-templates">

                                    @if ( !empty($page->id) )
                                        <div class="row clearfix">
                                            <div class="col-md-12">
                                          <span class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-link"></i>
                                                </div>
                                              <input class="funnelurl-input form-control" id="funnelURL"
                                                     name="funnel[url]"
                                                     readonly="true"
                                                     value="{{ route('page.view', (!empty($currentStep->slug)) ? $currentStep->slug : $currentStep->id) }}{{-- (!empty($page->slug)) ? $page->slug : $page->id --}}">

                                              <div class="input-group-addon">
                                                    <a data-toggle="tooltip"
                                                       href="{{ route('page.view', (!empty($currentStep->slug)) ? $currentStep->slug : $currentStep->id) }}"
                                                       target="_blank"
                                                       title="" data-original-title="Visit Funnel URL">
                                                        <i class="fa fa-external-link"></i>
                                                    </a>
                                                </div>
                                                <div class="input-group-addon">
                                                    <a class="" data-title="What is the Funnel URL?"
                                                       data-toggle="tooltip" href="#" title=""
                                                       data-original-title="What is the Funnel URL?">
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </div>
                                          </span>
                                            </div>
                                        </div>
                                    @endif


                                    @if ( !empty($stepDetails->integration) )

                                        <script>list_id = "{{ $stepDetails->integration->list_id }}";</script>

                                        <div class="list-items clearfix">
                                            <div class="row clearfix">
                                                <div class="col-md-12 integration-list">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <td class="integration-details">
                                                                <span><img src="{{ asset('frontend/images/integration/' . $stepDetails->integration->type . '.png') }}"></span>
                                                                <span>{{ ucfirst($stepDetails->integration->type) }}</span>
                                                            </td>
                                                            <td>{{ ucfirst($stepDetails->integration->name) }}</td>
                                                            <td class="text-right">
                                                                <button type="button"
                                                                        class="btn btn-danger remove-integration"
                                                                        data-service-type="shipstation"
                                                                        data-integration-id="5" data-toggle="modal"
                                                                        data-target="#editIntegrationModal">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <script>list_id = "";</script>
                                        <div class="--blank-data">
                                            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No
                                                Integration</p>
                                        </div>

                                        <div class="row clearfix text-right">
                                                <span>
                                                    <button type="button" id="button_product_manual"
                                                            class="btn special-button-primary btn-lg"
                                                            data-toggle="modal"
                                                            data-target="#newIntegration">
                                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Integration
                                                    </button>
                                                </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
            <!-- /page content -->


        </div>
    </div>





    <!-- ADD INTEGRATION MODAL -->
    <div id="newIntegration" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Integration</h4>
                </div>

                <div class="modal-body" id="integration_body">

                    <form id="frm_save_step_integration" action="" method="post">
                        <div class="form-group">
                            @if ( $integrations->count() > 0 )
                                <label for="integration_method">Integration Type</label>
                                <select name="integration_method" id="integration_method" class="form-control">

                                    <option value="">--CHOOSE--</option>
                                    @foreach ( $integrations as $integration )
                                        <option value="{{ $integration->id }}"
                                                data-integration-type="{{ $integration->service_type }}"
                                                data-integration-id="{{ $integration->id }}">{{ $integration->name }}
                                            ({{ ucfirst($integration->service_type) }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <p>No Integration</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="integration_type">List</label>
                            <select name="integration_list_id" id="integration_list_id" class="form-control"></select>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>

                </div>

                @if ( $integrations->count() > 0 )
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-success" id="save_integration_details"> Save Integration
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <!-- EDIT INTEGRATION MODAL -->
    <div id="editIntegration" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Row</h4>
                </div>

                <div class="modal-body" id="integration_body">

                    <form id="frm_save_step_integration" action="" method="post">
                        <div class="form-group">
                            <label for="integration_method">Integration Type</label>
                            <select name="integration_method" id="integration_method" class="form-control">
                                @if ( $integrations->count() > 0 )
                                    <option value="">--CHOOSE--</option>
                                    @foreach ( $integrations as $integration )
                                        <option value="{{ $integration->id }}"
                                                data-integration-type="{{ $integration->service_type }}"
                                                data-integration-id="{{ $integration->id }}">{{ $integration->name }}
                                            ({{ ucfirst($integration->service_type) }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="integration_type">Integration Type</label>
                            <select name="" id="integration_list_id" class="form-control"></select>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>

                </div>

                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-success"> Save Integration</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div id="addFunnelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="frm_create_funnel_steps" action="{{ route('steps.index', $funnel->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Step in Funnel</h4>
                    </div>

                    <div class="modal-body">
                        <div class="fom-group">
                            <label for="step_name">Change Name Of Funnel Step</label>
                            <!--<input type="text" name="step_name" class="form-control" placeholder="Provide page name" />-->

                            <select name="step_name" class="form-control" required>
                                <option>--SELECT--</option>
                                @foreach ($funnelTypes as $key => $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br/>

                        <div class="fom-group">
                            <label for="display_name">Display Name</label>
                            <input type="text" name="display_name" class="form-control" placeholder="Display page name"
                                   required/>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="create_funnel_steps">Create Funnel Step
                        </button>
                    </div>

                    <input type="hidden" name="funnel_id" value="{{ $funnel->id }}"/>
                    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
                </form>
            </div>

        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#sortable").sortable({
                update: function (event, ui) {
                    //alert($(this).find('li').attr('data-sort-position'));

                    //var elementFrom = $(this).find('li').attr('data-sort-position');
                    //var elementTo = $(this).find('li').prev().attr('data-sort-position');

                    var steps = "";
                    var total = $(this).find('.ui-sortable-handle').length;

                    $(this).find('.ui-sortable-handle').each(function (index, element) {
                        //steps += $(element).attr('data-step-id') + ',';
                        //alert(total);

                        if (index < total - 1) {
                            //alert(index);
                            steps += $(element).attr('data-step-id') + ',';
                        }
                    });

                    steps = steps.substring(0, steps.length - 1);
                    //alert(steps);

                    $.ajax({
                        type: 'POST',
                        url: $("#hid_base_url").val() + '/funnels/{{ $funnel->id }}/change-order',
                        //url: "{{-- route('funnel.step.change', $funnel->id, $funnel->step->id) --}}",
                        data: 'steps=' + steps + '&_token=' + "{{ csrf_token() }}",
                        success: function (response) {
                            console.log(response);

                            /*var json = JSON.parse(response);

                             if ( json.status == 'success' ) {
                             //something
                             alert('success');
                             }*/
                        },
                        error: function (a, b) {
                            console.log(a.ponseText);
                        }
                    });
                }
            });

            $("#sortable").disableSelection();
        });


        $(document).ready(function () {

            $("#integration_method").change(function (e) {

                var integration_type = $('option:selected', this).attr('data-integration-type');
                var integration_id = $('option:selected', this).attr('data-integration-id');
                var integration_list_id = $("#integration_list_id");

                //alert($(this).attr('data-integration-type'));

                if ((integration_type == 'mailchimp') || (integration_type == 'aweber')) {
                    $(integration_list_id).html("");
                    $("#integration_list_id").parent().show();

                    //alert(integration_type + ',' + integration_id  );

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('integration.fetch.list') }}",
                        data: "id=" + integration_id + "&_token=" + $("#csrf_token").val() + "&type=" + integration_type,
                        beforeSend: function () {
                            $(integration_list_id).prev().append('&nbsp; <i class="fa fa-refresh fa-spin"></i>');
                        },
                        success: function (response) {
                            console.log(response);

                            //alert($(integration_list_id).prev().html());
                            $(integration_list_id).prev().find('i').remove(); //('List To Add Lead:');

                            var json = JSON.parse(response);

                            $(integration_list_id).append("<option value=''>--CHOOSE--</option>");
                            $.each(json.lists, function (k, v) {

                                if (list_id.length > 1) {
                                    if (v.id == list_id) {
                                        $(integration_list_id).append("<option value='" + v.id + "' selected>" + v.name + "</option>");
                                    } else {
                                        $(integration_list_id).append("<option value='" + v.id + "'>" + v.name + "</option>");
                                    }
                                } else {
                                    $(integration_list_id).append("<option value='" + v.id + "'>" + v.name + "</option>");
                                }
                            });
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                } else {
                    $("#integration_list_id").parent().hide();
                }
            });


            //save integrration details
            $(document).on('click', '#save_integration_details', function (e) {

                e.preventDefault();

                const button = $(this);
                var button_text = "";

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.step.integration.save', [$funnel->id, $currentStep->id]) }}",
                    data: $("#frm_save_step_integration").serialize(),
                    beforeSend: function () {
                        button_text = $(button).text();
                        $(button).html('&nbsp; <i class="fa fa-refresh fa-spin"></i> loading...');
                    },
                    success: function (response) {
                        //$(button).text(button_text);
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = json.url;
                        } else {
                            alert(json.message);
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });


            //Remove Integration
            $(document).on('click', '.remove-integration', function (e) {

                e.preventDefault();

                var row = $(this).parent().parent().parent().parent();

                if (confirm("Are you sure to remove the integration from the step?")) {

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('funnel.step.integration.remove', [$funnel->id, $currentStep->id]) }}",
                        data: "_token={{ csrf_token() }}",
                        beforeSend: function () {
                            $(row).css('opacity', '0.25');
                        },
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if (json.status == 'success') {
                                $(row).remove();
                                location.href = json.url;
                            } else {
                                alert(json.message);
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });


            $("#integration_method").trigger('change');
        });

    </script>
@endsection