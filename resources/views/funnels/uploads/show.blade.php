@extends('layouts.app')

@section("title", "Funnel Uploads")

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
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img src="{{ asset('frontend/images/manual-product.png') }}"/></a>
                                    @else
                                        <a href="{{ route('funnels.show', $funnel->id) }}"><img src="{{ asset('frontend/images/shopify-product.png') }}"/></a>
                                    @endif
                                </li>
                                <li><a href="{{ route('funnels.show', $funnel->id) }}"><h3>{{ $funnel->name }}</h3></a></li>
                            </ul>
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
                                <h2 style="margin-bottom: 17px;">Upload Files</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a href="{{ route('funnels.upload.create', $funnel->id) }}"
                                                   class="collapse-link active"><i class="fa fa-plus"
                                                                                   aria-hidden="true"></i> &nbsp;
                                            Upload New</a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th> <th style="width: 20%">File</th> <th>Status</th> <th class="text-right">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ( $funnelUploads->count() > 0 )
                                                @foreach ( $funnelUploads as $upload )
                                                    <tr>
                                                        <td>{{ date('d M, Y', strtotime($upload->created_at)) }}</td>
                                                        <td>
                                                            <strong style="color: #1abb9c;">{{ $upload->actual_file_name }}</strong>
                                                            {{ route('shopping.download.bonus', $upload->download_token) }}
                                                        </td>
                                                        <td><span class="label label-{{ ($upload->status) ? 'success' : 'default' }}">{{ ($upload->status) ? 'Enabled' : 'Disabled' }}</span></td>

                                                        <td class="text-right">
                                                            <button class="btn btn-danger remove-upload" data-upload-id="{{ $upload->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4">No uploads</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
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


        $(".remove-upload").click(function(e) {

            if ( confirm("Are you sure to delete this upload") ) {

                var row = $(this).parent().parent();
                var upload_id = $(this).attr('data-upload-id');

                $.ajax({
                        type: 'POST',
                        url: "{{ route('funnels.upload.remove', $funnel->id) }}",
                        data: 'upload_id=' + upload_id + '&_token=' + "{{ csrf_token() }}",
                        beforeSend: function() {
                            $(row).css("opacity", "0.50");
                        },
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if ( json.status == 'success' ) {
                                //something
                                $(row).remove();
                            }
                        },
                        error: function (a, b) {
                            console.log(a.ponseText);
                        }
                    });
            }
        });


    </script>
@endsection
