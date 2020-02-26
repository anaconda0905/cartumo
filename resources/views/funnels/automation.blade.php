@extends('layouts.app')

@section("title", "Steller Winds")

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" />
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
        #frm_create_funnel_automation .fom-group {
            padding-bottom: 15px;
        }

        .automation-body {
            width: 100%;
        }
        .automation-body tr {
            border: 1px solid #eee;
            margin-bottom: 15px;
        }
        .automation-body tr td {
            padding: 7px;
        }
        .automation-body tr td:first-child {
            width: 10%;
        }
        .automation-body tr td:first-child > img {
            width: 48px;
        }
        .automation-body tr td:nth-child(2) {
            color: #525151;
            font-weight: 700;
            font-size: 16px;
        }
        .empty-message {
            font-size: 15px;
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
                                        <img src="{{ asset('frontend/images/manual-product.png') }}" />
                                    @else
                                        <img src="{{ asset('frontend/images/shopify-product.png') }}" />
                                    @endif
                                </li>
                                <li><h3>{{ $funnel->name }}</h3></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-md-7 text-right">
                        <ul class="funnel-inner-header-menu text-right">
                            <li><a href="{{ route('funnels.show', $funnel->id) }}"><span
                                            class="fa fa-dashboard"></span> Dashboard</a></li>
                            <li><a href="{{ route('steps.index', $funnel->id) }}" class="{{ (!empty($currentStep)) ? 'active' : '' }}"><span
                                            class="fa fa-bars"></span> Steps</a></li>
                        <!--<li><a href="#" class="{{ (!empty($currentStats)) ? 'active' : '' }}"><span
                                            class="fa fa-bar-chart"></span> Stats</a></li>-->
                            <li><a href="{{ route('contacts.index', $funnel->id) }}" class="{{ (!empty($currentContacts)) ? 'active' : '' }}"><span
                                            class="fa fa-users"></span> Contacts</a></li>
                            <li><a href="{{ route('funnel.sales.index', $funnel->id) }}" class="{{ (!empty($currentSales)) ? 'active' : '' }}"><span
                                            class="fa fa-money"></span> Sales</a></li>
                            <li><a href="{{ route('funnels.edit', [$funnel->id]) }}"><span class="fa fa-cog"
                                                                                           aria-hidden="true"></span>Settings</a>
                            </li>
                            @if ( App\Models\UserUpgrade::isUpgradeAvailable(Auth::id(), 2) )
                                <li><a href="{{ route('funnels.upload.store', [$funnel->id]) }}" class="{{ (!empty($uploads)) ? 'active' : '' }}"><span
                                            class="fa fa-cloud-upload"></span> Upload</a></li>
                            @endif
                        </ul>
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

                                    <li class="ui-state-default" data-sort-position="{{ $step->order_position }}"
                                        data-step-id="{{ $step->id }}">
                                        <a data-funnel-id="{{ $funnel->id }}" data-step-id="{{ $step->id }}"
                                           href="{{ route('steps.show', array($funnel->id, $step->id)) }}">
                                            <ul class="step-details funnel-steps-items">
                                                <li><?php echo App\Models\FunnelType::getIcon($step->type) ?></li>
                                                <li>{{ $step->display_name }}
                                                    <small class="step-footer">{{ App\Models\FunnelType::getTypeName($step->type) }}</small>
                                                </li>
                                                <li><i class="fa fa-times" aria-hidden="true"></i></li>
                                            </ul>
                                        </a>
                                    </li>
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

                            <div class="x_title">
                                <h2><i class="fa fa-flash"></i> &nbsp; Funnel Automation</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
                                           class="collapse-link"><i class="fa fa-pie-chart"
                                                                           aria-hidden="true"></i> &nbsp;
                                            Overview</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('funnel.automation', array($funnel->id, $currentStep->id)) }}"
                                           class="collapse-link active"><i class="fa fa-flash"></i> &nbsp;
                                            Automation</a>
                                    </li>

                                    @if ( (strtolower($currentType->name) == 'sales') ||  (strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )
                                        <li>
                                            <a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"
                                               class="close-link"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                &nbsp;
                                                Products</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row clearfix" style="margin-bottom: 15px;">
                                    <div class="col-md-12">
                                        <div class="automation-list">
                                            @if ( $funnelStepAutomations->count() > 0 )
                                                <table class="automation-body">
                                                    @foreach ( $funnelStepAutomations as $funnelStepAutomation )
                                                        <tr>
                                                            <td><img src="{{ asset('frontend/images/email-automation.png') }}" /></td>
                                                            <td>{{ $funnelStepAutomation->subject }}</td>
                                                            <td class="text-right">
                                                                <button class="btn btn-danger remove-automation" data-automation-id="{{ $funnelStepAutomation->id }}">
                                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @else
                                                <p class="empty-message">No automation set yet</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row clearfix" style="margin-bottom: 15px;">
                                    <div class="col-md-12 text-right">
                                        <button class="btn special-button-primary" data-toggle="modal" data-target="#modalAddNewEmail"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Add new Email</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /page content -->


            <!-- Modal -->
            <div id="addFunnelModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form id="frm_create_funnel_steps" action="{{ route('steps.index', $funnel->id) }}"
                              method="post">
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
                                    <input type="text" name="display_name" class="form-control"
                                           placeholder="Display page name"
                                           required/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="create_funnel_steps">Create Funnel
                                    Step
                                </button>
                            </div>

                            <input type="hidden" name="funnel_id" value="{{ $funnel->id }}"/>
                            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Modal -->
            <div id="modalAddNewEmail" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form id="frm_create_funnel_automation" action="{{ route('funnel.automation.save', [$funnel->id, $currentStep->id]) }}"
                              method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">New Step in Funnel</h4>
                            </div>

                            <div class="modal-body">
                                <div class="fom-group">
                                    <label for="from_name">From Name</label>
                                    <input type="text" name="from_name" id="from_name" class="form-control" placeholder="Your name..." />
                                </div>
                                <div class="fom-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Your subject..." />
                                </div>
                                <div class="fom-group">
                                    <label for="condition">Condition</label>
                                    <select class="form-control" name="condition" id="condition">
                                        <option value="">--Choose--</option>
                                        <option value="not_purchased">saw page but did not purchased</option>
                                        <option value="purchased">purchased</option>
                                    </select>
                                </div>
                                <div class="fom-group">
                                    <label for="html_body">HTML Body</label>
                                    <textarea name="html_body" class="form-control summernote" id="html_body"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="create_funnel_steps">Create Email</button>
                            </div>

                            <input type="hidden" name="funnel_id" value="{{ $funnel->id }}"/>
                            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection


@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.min.js"></script>
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


        $('.summernote').summernote();


        //remove automation
        $(document).on("click", ".remove-automation", function(e) {

            e.preventDefault();

            var automation_id = $(this).attr('data-automation-id');

            //alert(automation_id);

            if ( confirm("Are you sure to delete this details?") ) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.automation.remove', [$funnel->id, $step->id]) }}",
                    data: "id=" + automation_id + "&_token=" + $("#csrf_token").val(),
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == "success") {
                            alert(json.message);
                            location.href = json.url;
                        } else {
                            alert(json.message);
                        }
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            }
        });



    </script>
@endsection
