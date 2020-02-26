@extends('layouts.app')

@section("title", "New Upload")

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
                            <li><a href="{{ route('funnels.show', $funnel->id) }}"><span
                                            class="fa fa-dashboard"></span> Dashboard</a></li>
                            <li><a href="{{ route('steps.index', $funnel->id) }}"><span
                                            class="fa fa-bars"></span> Steps</a></li>
                        <!--<li><a href="#" class="{{ (!empty($currentStats)) ? 'active' : '' }}"><span
                                            class="fa fa-bar-chart"></span> Stats</a></li>-->
                            <li><a href="{{ route('contacts.index', $funnel->id) }}"><span
                                            class="fa fa-users"></span> Contacts</a></li>
                            <li><a href="{{ route('funnel.sales.index', $funnel->id) }}"><span
                                            class="fa fa-money"></span> Sales</a></li>
                            <li><a href="{{ route('funnels.edit', [$funnel->id]) }}"><span class="fa fa-cog"
                                                                                           aria-hidden="true"></span>Settings</a>
                            </li>
                            <li><a href="{{ route('funnels.upload.store', [$funnel->id]) }}" class="active"><span
                                            class="fa fa-cloud-upload"></span> Upload</a></li>
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
                                <div class="upload-area">
                                    <button class="btn btn-lg btn-primary" id="button_upload_zip">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp; Choose File</button>
                                    <form type="post" action="{{ route('funnels.upload.store', $funnel->id) }}" method="post" enctype="multipart/form-data">
                                        <input type="file" name="software_file" id="file_software" style="display:none" />
                                        {{ csrf_field() }}
                                    </form>
                                    <p>Choose zip file one at a time to attach with the funnel.</p>
                                </div>

                                <div class="loader" style="display:none"><a class="btn btn-danger loading">Success</a></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
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


        $("#button_upload_zip").click(function() {

            $("#file_software").trigger("click");
        });

        $("#file_software").change(function() {

            ////////////////////////
            if ( validateFileExtension(this) ) {

                var bar = $('.loader > .btn');
                var percent = $('.loader a');
                //var status = $('#status');

                $(this).ajaxForm({
                    /*data: {
                        media_tab: current_media_tab
                    },*/
                    beforeSend: function() {
                        //status.empty();
                         $(".loader").show();
                        var percentVal = '0%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                    },
                    complete: function(response)
                    {
                        console.log(response);                          

                        //location.href = "{{ route('funnels.upload.index', $funnel->id) }}";
                    
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                }).submit();
            } else {
                alert("Not");
            }
            ////////////////////////
        });


    </script>


    <script type="text/javascript">
        function validateFileExtension(fld) {
            if(!/(\.zip)$/i.test(fld.value)) {
                alert("Invalid image file type. Please upload only ZIP file.");      
                fld.form.reset();
                fld.focus();        
                return false;   
            } else {

            }
            return true; 
        } 
    </script>
@endsection