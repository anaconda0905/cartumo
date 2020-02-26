@extends('layouts.app')

@section("title", "Email Settings")

@section('styles')
    <link rel="Stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css"/>
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
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img src="{{ asset('frontend/images/manual-product.png') }}"/></a>
                                    @else
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img src="{{ asset('frontend/images/shopify-product.png') }}"/></a>
                                    @endif
                                </li>
                                <li><a href="{{ route('funnels.show', $funnel->id) }}"><h3>{{ $funnel->name }}</h3></a></li>
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

                                <div class="x_title">
                                    @if ( empty($templates) )
                                        <h2>Email Setting</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li>
                                                <a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
                                                   class="collapse-link"><i class="fa fa-pie-chart"
                                                                            aria-hidden="true"></i> &nbsp;
                                                    Overview</a>
                                            </li>

                                            @if ((strtolower($currentType->name) == 'sales') ||(strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )
                                                <li>
                                                    <a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"
                                                       class="close-link"><i class="fa fa-cubes" aria-hidden="true"></i>
                                                        &nbsp;
                                                        Products</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                       class="collapse-link active"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>
                                            @elseif ( (strtolower($currentType->name) == 'order') )
                                                <li>
                                                    <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                                                       class="collapse-link active"><i class="fa fa-plug"></i> &nbsp;
                                                        Integration</a>
                                                </li>
                                            @elseif ( (strtolower($currentType->name) == 'confirmation') )
                                                <li>
                                                    <a href="{{ route('funnel.step.email.show', array($funnel->id, $currentStep->id)) }}"
                                                       class="collapse-link active"><i class="fa fa-envelope"
                                                                                       aria-hidden="true"></i> &nbsp;
                                                        Email</a>
                                                </li>
                                            @endif
                                        </ul>
                                    @else
                                        <h2>Templates for {{ $currentStep->display_name }}</h2>
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content funnel-templates" style="padding: 15px 30px;">

                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Note!</strong> This email will send when customer reached at
                                        confirmation page
                                    </div>

                                    {!! Form::model($currentStep, array('route' => ['funnel.step.email.update', $currentStep->funnel_id, $currentStep->id], 'method' => 'PUT', 'id' => 'frm_save_step_email')) !!}
                                    {{ csrf_field() }}
                                    <fieldset>
                                        <div class="form-group">
                                            {{ Form::label('subject', 'Subject:') }}
                                            {{ Form::text('subject', (!empty($email->subject)) ? $email->subject : null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Enter the subject here...')) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('message', 'Message:') }}
                                            {{ Form::textarea('message', (!empty($email->message)) ? $email->message : null, array('class' => 'form-control summernote', 'required' => '', 'placeholder' => 'Enter the message here...')) }}
                                        </div>
                                    </fieldset>

                                    <div class="ln_solid"></div>

                                    <div class="col-md-12 text-right">

                                        @if ( !empty($email->message) )
                                            <button id="button_remove_email" type="submit" class="btn btn-danger"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> &nbsp; Remove Email
                                                Setting
                                            </button>
                                        @endif
                                        <button id="button_save_email" type="submit" class="btn btn-success"><i
                                                    class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp; Save Email
                                        </button>
                                    </div>
                                    {!! Form::close() !!}

                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
            <!-- /page content -->


        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.min.js"></script>
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
            $('.summernote').summernote();

            $('#frm_save_step_email').parsley();

            $("#frm_save_step_email").submit(function (e) {

                e.preventDefault();

                button = $(this).find('#button_save_email');

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            //something
                            location.href = json.url;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.ponseText);
                    }
                });
            });


            $("#button_remove_email").click(function (e) {

                e.preventDefault();

                button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('step.email.settings.remove', $currentStep) }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            //something
                            location.href = location.href;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.ponseText);
                    }
                });
            });
        });

    </script>
@endsection