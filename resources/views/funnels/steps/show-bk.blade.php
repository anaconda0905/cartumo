@extends('layouts.app')

@section("title", "Funnel Steps")

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

        .blank-template-add {
            min-height: 210px;
            width: %100;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .blank-template-add > .content-middle {
            width: 80%;
            height: auto;
            margin: 10px;
            padding:5px;
            color:#1abb9c;
            text-align: center;
        }
        .blank-template-add > .content-middle > i {
            font-size: 24px;
        }
        .blank-template-add:hover {
            border: 2px solid #1abb9c;
        }
        .blank-template-button {
            background: transparent;
            border: 0px;
            color: #333;
            font-size: 15px;
        }
        .blank-template-add:hover .blank-template-button {
            color: #1abb9c;
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

                            @if ( App\UserUpgrade::isUpgradeAvailable(Auth::id(), 2) )
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

                                    @if ( $step->id == $currentStep->id )
                                        <li class="ui-state-default active" data-sort-position="{{ $step->order_position }}"
                                            data-step-id="{{ $step->id }}">
                                            <a data-funnel-id="{{ $funnel->id }}" data-step-id="{{ $step->id }}"
                                               href="{{ route('steps.show', array($funnel->id, $step->id)) }}">
                                                <ul class="step-details funnel-steps-items">
                                                    <li><?php echo App\FunnelType::getIcon($step->type) ?></li>
                                                    <li>{{ $step->display_name }}
                                                        <small class="step-footer">{{ App\FunnelType::getTypeName($step->type) }}</small>
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
                                                    <li><?php echo App\FunnelType::getIcon($step->type) ?></li>
                                                    <li>{{ $step->display_name }}
                                                        <small class="step-footer">{{ App\FunnelType::getTypeName($step->type) }}</small>
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

                                <div class="x_title">
                                    @if ( empty($templates) )
                                        <h2>{{ $currentStep->display_name }}</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li>
                                                <a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
                                                   class="collapse-link active"><i class="fa fa-pie-chart"
                                                                                   aria-hidden="true"></i> &nbsp;
                                                    Overview</a>
                                            </li>

                                            @if ( (strtolower($currentType->name) == 'sales') || (strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )
                                                <li>
                                                    <a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"
                                                       class="close-link"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                        &nbsp;
                                                        Products</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                    class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>

                                                <!--<li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                    class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>-->
                                            @elseif ( (strtolower($currentType->name) == 'optin') )

                                                <li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                    class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>

                                            @elseif ( (strtolower($currentType->name) == 'order') )
                                                <!--<li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                    class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>-->
                                            @elseif ( (strtolower($currentType->name) == 'confirmation') )
                                                <li>
                                                    <a href="{{ route('funnel.step.email.show', array($funnel->id, $currentStep->id)) }}"
                                                    class="collapse-link"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;
                                                        Email</a>
                                                </li>
                                            @endif
                                        </ul>
                                    @else
                                        <h2>Templates for {{ $currentStep->display_name }}</h2>
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
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

                                    @if ( !empty($templates) )
                                        @foreach ($templates as $key => $template)
                                            <div class="col-lg-3 col-md-3 col-xs-6 template-item">
                                                @if ( $template->type > 0 )
                                                    <a href="#">
                                                    <!--<img class="img-responsive img-dynamic" src="{{ asset('admin/img/no-image-featured-image.png') }}" alt="">-->
                                                        <img class="img-responsive img-dynamic"
                                                            src="{{ $template->image }}"
                                                            alt="">
                                                        <h4 class="text-center">{{ $template->title }}</h4>
                                                    </a>


                                                    <div class="overlay">
                                                        <button class="btn btn-success select-funnel-template"
                                                                data-step-id="{{ $currentStep->id }}"
                                                                data-template-id="{{ $template->id }}"
                                                                data-funnel-id="{{ $funnel->id }}">
                                                            <i class="fa fa-plus" aria-hidden="true"></i> Select Template
                                                        </button>
                                                        <br/>
                                                        <a href="{{ route('pages.show', $template->id) }}"
                                                        class="btn btn-primary" target="_blank"><i class="fa fa-eye"
                                                                                                    aria-hidden="true"></i>
                                                            Preview</a>
                                                    </div>
                                                @else
                                                    <div class="blank-template-add">
                                                        <div class="content-middle">
                                                            <button class="btn btn-success select-funnel-template blank-template-button"
                                                                data-step-id="{{ $currentStep->id }}"
                                                                data-template-id="{{ $template->id }}"
                                                                data-funnel-id="{{ $funnel->id }}">
                                                            <i class="fa fa-plus" aria-hidden="true"></i> New Template
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        @if ( !empty($page) )
                                            <div class="template-item-big clearfix">
                                                <div class="row clearfix">
                                                    <div class="col-md-6">

                                                        <div class="panel panel-default screenshoot-panel">
                                                            <!--<div class="panel-heading">Page Screenshoot</div>-->

                                                            <div class="panel-body text-center">
                                                            <!--<img id="p2i_demo" src="http://api.page2images.com/directlink?p2i_url={{ route('pages.show', $page->id) }}&p2i_device=6&p2i_screen=1024x768&p2i_size=100x0&p2i_fullpage=1&p2i_screenframe=desktop&p2i_key=1b59ddf9fa7951a6" />-->
                                                                <img id="p2i_demo"
                                                                     src="{{ asset('images/ajax-loader.gif') }}"
                                                                     data-page-id="{{ $page->id }}" />
                                                            </div>

                                                            <div class="panel-footer">
                                                                <div class="text-left">
                                                                    <a href="{{ route('pages.edit', $page->id) }}"
                                                                       class="btn special-button-warning"><i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> Edit Page</a>
                                                                    <button type="button" id="btn_reload_editor" class="btn special-button-success" style="color: #374B5F !important;" title="Reload Editor" tooltip="Click this button to reload the editor">
                                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                                    </button>
                                                                    <a href="{{ route('pages.show', $page->id) }}"
                                                                       class="btn special-button-default" target="_blank" style="color: #374B5F !important;"><span
                                                                                class="glyphicon glyphicon-eye-open"></span></a>

                                                                    <!--<button data-page-id="{{ $page->id }}"
                                                                            class="btn btn-danger page-template-remove">
                                                                        <i class="fa fa-trash"
                                                                                aria-hidden="true"></i>
                                                                    </button>-->
                                                                    <button type="button" class="btn special-button-default" style="color: #374B5F !important;"
                                                                            data-action-url="{{ route('funnel.step.clone', [$currentStep->funnel_id, $currentStep->id]) }}"
                                                                            data-toggle="modal"
                                                                            data-target="#editFunnelModal">
                                                                        <i class="fa fa-gear"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>




                                                    </div>

                                                    <div class="col-md-4">
                                                        ...
                                                    </div>

                                                </div>

                                                <div class="row clearfix">

                                                    <div class="col-md-4 text-left">
                                                        <a class="btn special-button-default removeFromFunnelView"
                                                           data-action-url="{{ route('funnel.step.template.remove', [$currentStep->funnel_id, $currentStep->id]) }}"
                                                           id="funnel_step_template_remove">
                                                            <i class="fa fa-times"></i>
                                                            Remove Template
                                                        </a>
                                                    </div>

                                                    <div class="col-md-8 text-right">

                                                        <button type="button" class="btn special-button-primary"
                                                                data-action-url="{{ route('funnel.step.clone', [$currentStep->funnel_id, $currentStep->id]) }}"
                                                                id="funnel_step_clone"
                                                                data-funnel-id="{{ $currentStep->funnel_id }}"
                                                                data-step-id="{{ $currentStep->id }}">
                                                            <i class="fa fa-copy"></i>
                                                            Clone Step
                                                        </button>

                                                        <button type="button" class="btn special-button-danger"
                                                                data-action-url="{{ route('steps.destroy', [$currentStep->funnel_id, $currentStep->id]) }}"
                                                                id="funnel_step_remove">
                                                            <i class="fa fa-trash"></i> Delete Step
                                                        </button>

                                                    </div>

                                                </div>


                                            </div>
                                        @else
                                            <p>No Template</p>
                                        @endif
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


    <div id="editFunnelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <!--<form id="frm_create_funnel_steps" action="{{ route('steps.update', [$currentStep->funnel_id, $currentStep->id]) }}" method="put">-->
                {!! Form::model($currentStep, array('route' => ['steps.update', $currentStep->funnel_id,
                $currentStep->id], 'method' => 'PUT')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Funnel Step</h4>
                </div>

                <div class="modal-body">
                    <div class="fom-group">
                        <label for="step_name">Change Name Of Funnel Step</label>
                        <!--<input type="text" name="step_name" class="form-control" placeholder="Provide page name" />-->

                        <!--<select name="step_name" class="form-control" required>
                            <option>--SELECT--</option>
                            @foreach ($funnelTypes as $key => $type)
                                @if ( $type->id == $currentStep->type )
                                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                @else
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endif
                            @endforeach
                        </select>-->

                        <input type="text" name="display_name" class="form-control" placeholder="Display page name"
                               value="{{ (!empty($currentStep->display_name)) ? $currentStep->display_name : '' }}"
                               required />
                    </div>
                    <!--<br/>

                    <div class="fom-group">
                        <label for="display_name">Slug</label>
                        <input type="text" name="display_name" class="form-control" placeholder="Display page name"
                               value="{{ (!empty($currentStep->slug)) ? $currentStep->slug : '' }}"
                               required/>
                    </div>-->

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="update_funnel_steps"> Submit</button>
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





        //select a templet for funnel
        $(document).on('click', '.select-funnel-template', function (e) {

            e.preventDefault();

            var step_id = $(this).attr('data-step-id');

            //alert($("#hid_base_url").val() + '/pages/add-template/' + step_id);

            $.ajax({
                type: 'GET',
                url: "{{ route('pages.template.add', $currentStep->id) }}", //$("#hid_base_url").val() + '/pages/add-template/' + step_id,
                data: 'page_template_id=' + $(this).attr('data-template-id') + '&funnel_id=' + $(this).attr('data-funnel-id') + '&step_id=' + $(this).attr('data-step-id'),
                beforeSend: function() {
                    //$("body").append("<iframe src='' id='iframe_updater' style='display: none'></iframe>");
                },
                success: function (response) {
                    //alert(response);

                    var json = JSON.parse(response);

                    if (json.status == 200) {

                        //start updating editor

                        //$("#iframe_updater").attr('src', "{{ url('/') }}" + '/template/update-template/' + json.page_id + '/?flag=autoupdate');

                        //after update
                        //$("#iframe_updater").load(function () {
                            location.href = json.url;
                            location.href = location.href;
                        //});

                        //location.href = location.href;
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });




        //////////////////////////////////////
        @if ( !empty($page->id) )
        if ($("#p2i_demo") != null) {

            var page_id = $("#p2i_demo").attr("data-page-id");

            $.ajax({
                type: 'GET',
                //url: $("#hid_base_url").val() + '/page/' + page_id + '/screenshoot',
                url: "{{ route('page.screenshoot', $page->id) }}",
                data: "_token={{ csrf_token() }}",
                beforeSend: function () {
                    //$(button).prop('disable', true);
                    //$(row).css('opacity', '0.50');
                },
                success: function (response) {
                    console.log(response);
                    console.log("{{ route('page.scereenshoot.view', $page->id) }}");
                    $("#p2i_demo").attr('src', response);
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });
        }

        if ($("#p2i_demo") != null) {
            var page_id = $("#p2i_demo").attr("data-page-id");

            //$("body").append("<iframe src='{{ route('pages.show', $page->id) }}' id='iframe_updater' style='display: block; width: 100%;'></iframe>");
            //alert($("#iframe_updater").contents().find('body #hid_page_screen').val());
            //after update
            //$("#iframe_updater").load(function () {

                //$("#iframe_updater").hide();

                //alert($("#iframe_updater").contents().find('body #hid_page_screen').val());
                //alert(self.parent.opener.document.getElementById('image_screenshoot')[0].getAttribute("src"));
                //$("#p2i_demo").attr('src', $("#iframe_updater").contents().find('body #hid_page_screen').val());

                //alert(window.frames[0].window.img);


                /*$.ajax({
                    type: 'GET',
                    //url: $("#hid_base_url").val() + '/page/' + page_id + '/screenshoot',
                    url: "{{ route('page.screenshoot.show', $page->id) }}",
                    data: "_token={{ csrf_token() }}",
                    success: function (response) {
                        console.log(response);
                        //console.log("{{ route('page.scereenshoot.view', $page->id) }}");

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $("#p2i_demo").attr('src', json.url);
                        } else {
                            $.ajax({
                                type: 'GET',
                                //url: $("#hid_base_url").val() + '/page/' + page_id + '/screenshoot',
                                url: "{{ route('page.screenshoot.show', $page->id) }}",
                                data: "_token={{ csrf_token() }}",
                                success: function (response) {
                                    console.log(response);
                                    //console.log("{{ route('page.scereenshoot.view', $page->id) }}");

                                    var json = JSON.parse(response);

                                    if ( json.status == 'success' ) {
                                        $("#p2i_demo").attr('src', json.url);
                                    }
                                },
                                error: function (a, b) {
                                    console.log(a.responseText);
                                }
                            });
                        }
                    },
                    error: function (a, b) {
                        //console.log(a.responseText);

                    }
                });    */

            //});
        }
        @endif


    </script>

    @if ( !empty($page) )
        <script>
                $(document).ready(function(e) {
                    $("body").append("<iframe src='' id='iframe_updater' style='display: none'></iframe>");
                    $("#iframe_updater").attr('src', "{{ route('pages.update.template', $page->id) }}");

                    $("#btn_reload_editor").click(function(e) {

                        e.preventDefault();

                        var button = $(this);

                        $("body #iframe_updater").remove();
                        $("body").append("<iframe src='' style='width: 100%; height: 500px;' id='iframe_updater' style='display: none'></iframe>");
                        $("#iframe_updater").attr('src', "{{ route('pages.update.template', [$page->id, 'flag'=>'autoupdate']) }}");
                        $(this).html('<i class="fa fa-refresh fa-spin"></i>');
                        //window.open("route('pages.update.template', [$page->id, 'flag'=>'autoupdate'])");
                        $("#iframe_updater").load(function () {

                            $(button).html('<i class="fa fa-refresh" aria-hidden="true"></i>');
                            alert("Reload finish");

                            ///////////
                            $.ajax({
                                type: 'GET',
                                //url: $("#hid_base_url").val() + '/page/' + page_id + '/screenshoot',
                                url: "{{ route('page.screenshoot', $page->id) }}",
                                data: "_token={{ csrf_token() }}",
                                beforeSend: function () {
                                    //$(button).prop('disable', true);
                                    //$(row).css('opacity', '0.50');
                                },
                                success: function (response) {
                                    console.log(response);
                                    console.log("{{ route('page.scereenshoot.view', $page->id) }}");
                                    $("#p2i_demo").attr('src', response);
                                },
                                error: function (a, b) {
                                    document.write(a.responseText);
                                }
                            });
                        });
                    });
                });
        </script>
    @endif
@endsection
