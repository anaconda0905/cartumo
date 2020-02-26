@extends('layouts.app')

@section("title", "Funnel Settings")

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
                                        <img src="{{ asset('frontend/images/manual-product.png') }}"/>
                                    @else
                                        <img src="{{ asset('frontend/images/shopify-product.png') }}"/>
                                    @endif
                                </li>
                                <li><h3>{{ $funnel->name }}</h3></li>
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
                                @if ( !empty($currentStep) )
                                    <h2>Edit Settings For This Funnel</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
                                               class="collapse-link" id="clone_funnel"><i class="fa fa-copy"
                                                                                          aria-hidden="true"></i> &nbsp;
                                                Clone Funnel</a>
                                        </li>
                                    </ul>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            {{-- $funnel --}}

                            <!--<form id="frm_update_funnel" action="{{ route('funnels.update', $funnel->id) }}"
                                  method="PUT">-->
                                {!! Form::model($funnel, array('route' => ['funnels.update', $funnel->id], 'method' => 'PUT', 'data-parsley-required' => '')) !!}
                                <div class="form-group row clearfix">
                                    <div class="col-md-6">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="funnel_name" name="funnel_name"
                                               value="{{ $funnel->name }}" required/>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="path">Path: <span id="slug_availability"></span></label>
                                        <input type="text" class="form-control" name="path" id="path"
                                               value="{{ $funnel->slug }}" disabled="disabled"/>
                                        <input type="hidden" id="hid_slug_availability" name="hid_slug_availability" value="{{ $funnel->slug }}">
                                    </div>
                                </div>
                                <input type="hidden" name="product_type" id="product_type"
                                       value="{{ $funnel->type }}"/>
                                <input type="hidden" name="payment_gateway_id" value="{{ $funnel->payment_gateway }}">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <button type="submit" class="btn btn-success pull-right" id="update_funnel_details">Save
                                    Settings
                                </button>
                                </form>
                                <hr/>
                                <div class="footer-buttons">
                                    <button type="button" id="archive_funnel" class="btn special-button-default"><i
                                                class="fa fa-archive"></i> Archive Funnel
                                    </button>
                                </div>
                            </div>
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

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>

        $(document).ready(function (e) {

            $("#funnel_name").keyup(function (e) {

                e.preventDefault();

                //alert(e.keyCode);

                if ( (e.keyCode!=9) && (e.keyCode!=13) ) {
                    if ($(this).val().length > 0) {

                        var slug = $(this).val().replace(/[^A-Z0-9]+/ig, "_");
                        slug = slug.toLowerCase();
                        $("#path").val(slug);
                        $("#hid_slug_availability").val(slug);

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('funnels.slug.exists', $funnel->id) }}",
                            data: '_token=' + "{{ csrf_token() }}&slug=" + slug,
                            success: function (response) {
                                console.log(response);
                                var json = JSON.parse(response);
                                //alert(json.message);
                                if ( json.availability ) {
                                    $("#update_funnel_details").attr('disabled', false);
                                    $("#slug_availability").html(json.message).css('color', 'green');
                                } else {
                                    $("#slug_availability").html(json.message).css('color', 'red');
                                    $("#update_funnel_details").attr('disabled', 'disabled');
                                }
                            },
                            error: function (a, b) {
                                console.log(a.responseText);
                            }
                        });
                    }
                }

            });

            $("#archive_funnel").click(function (e) {

                e.preventDefault();

                if (confirm("Are you sure to archive this funnel?")) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('archive.store', $funnel->id) }}",
                        data: '_token=' + "{{ csrf_token() }}",
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if (json.status == 'success') {
                                location.href = json.url;
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });


            //clone funnel
            $("#clone_funnel").click(function (e) {

                e.preventDefault();

                var menu = $(this);

                //alert(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.clone', $funnel->id) }}",
                    data: '_token=' + "{{ csrf_token() }}",
                    beforeSend: function () {
                        $(menu).html('<i class="fa fa-circle-o-notch fa-spin"></i> &nbsp; Loading...');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = json.url;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        });

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
    </script>
@endsection
