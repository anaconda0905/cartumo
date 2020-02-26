@extends('layouts.dashboard')


{{-- page title --}}
@section('title')
	Funnels
	@parent
@stop


{{-- page level styles --}}
@section('header_styles')
	<!--page level css starts-->
    <style type="text/css">
        .sec-head {
          background-color: #1499ba;
          float: left;
          padding: 0 15px 10px 10px;
          position: fixed;
          top: 52px;
          width: 100%;
          z-index: 99;
        }
        .fixed-demo
        {
            top: 126px;
        }

        .btn-sec .edit-link {
            color:#FFFFFF;
            padding: 6px 8px;
        }

        .btn-sec button{
            padding:8px;
        }

        .sec-set{
            margin:0;
            padding:0;
        }

        .img-box img{
            height:230px;
            width: 100%;
        }

        .three-set .pd{
            height:65px;
            padding:8px 12px;
            font-size:12px;
        }

        .img-box{
            width: 265px;
        }

        .img-box img{
            height: 200px;
        }

        .menu .sub-menu li a.active{
            color: #000000;
        }

        .prfl-list{
            z-index: 100;
        }

        .option-span a{
            padding-right: 110px;
        }

    </style>
    <!--end of page level css-->
@stop


@section('content')

    @include( 'elements.modal-confirm' )

    <!-- Modal -->
    <div id="modalAddStep" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Step</h4>
            </div>
            <form method="post" id="frmAddStep" action="{{ route('funnels.steps.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="funnel_id" value="{{ $funnel->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Step Name</label>
                        <input type="text" name="step_name" class="form-control" id="inputAddStep">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>

      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 p-0">
        <div class="sec-head">
            <div class="sec-list">
                <div class="big">
                    <div class="big-icn">
                        <a href="#" class="btn btn-default"> <i class="fa fa-gear"></i> </a>
                    </div>
                    <span class="name-demo">{{ ucfirst($funnel->name) }}</span>
                </div>
                <div class="url-li">
                    <div class="url-main">
                        <div class="input-group url-sec">
                            <input type="url" class="form-control" placeholder="http://" aria-describedby="sizing-addon2">
                            <span class="input-group-addon" id="sizing-addon2"><a href="#"><i class="fa fa-external-link"></i></a></span>
                            <span class="input-group-addon" id="sizing-addon3"><a href=""><i class="fa fa-question"></i></a></span>
                        </div>
                    </div>
                </div>
                <div class="lst text-right">
                    <a href="#" class="btn btn-default">Contact us </a>
                    <a href="#" class="btn btn-default">Sales </a>
                    <a href="#" class="btn btn-default">Setting </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
        <!-- <div class="dashboard-contnt">
            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                <div class="filtr">
                    <div class="filtr-btn">
                            <span><a href="#" class="btn btn-default active" type="button"><i class="fa fa-compress icn-clr"></i> Squeeze </a> <i class="fa fa-long-arrow-right"></i></span>
                            <span> <a href="#" class="btn btn-default" type="button"><i class="fa fa-shopping-cart icn-clr"></i> Sales </a> <i class="fa fa-long-arrow-right"></i></span>
                            <span><a href="#" class="btn btn-default" type="button"><i class="fa fa-money icn-clr"></i> Payment </a> <i class="fa fa-long-arrow-right"></i></span>
                            <span><a href="#" class="btn btn-default" type="button"><i class="fa fa-level-up icn-clr"></i> Upsell </a> <i class="fa fa-long-arrow-right"></i></span>
                            <span><a href="#" class="btn btn-default" type="button"><i class="fa fa-level-down icn-clr"></i>Down Sell</a></span>
                     </div>
                </div>
            </div>
        </div> -->
        <div class="col-md-2 col-sm-3 col-xs-12 p-0 m-0 fixed-demo">
            <div class="collapse navbar-collapse p-0" id="bs-example-navbar-collapse-1">
                <div class="optin-side">
                    <ul type="none" class="menu p-0 m-0">
                        @foreach($funnel->steps as $funnelStep)
                            <li class="{{ ( $funnelStep->id == $step->id) ? 'active' : '' }}">
                                <span class="option-span">
                                    <a href="{{ route('funnels.steps.show', [$funnelStep->funnel_id, $funnelStep->id]) }}">{{ ucfirst($funnelStep->name) }}</a>
                                </span>
                                <span class="cross-icn" data-step-id="{{ $funnelStep->id }}" title="Remove Step" data-toggle="modal" data-target="#modalConfirm">
                                    <i class="fa fa-times"></i>
                                </span>
                                @if(!($funnelStep->page))
                                <ul type="none" class="sub-menu p-0 m-0">
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'squeeze') ? 'active' : '' }}" type-name="squeeze">Squeeze</a></li>
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'sales') ? 'active' : '' }}" type-name="sales">Sales</a></li>
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'payment') ? 'active' : '' }}" type-name="payment">Payment</a></li>
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'upsell') ? 'active' : '' }}" type-name="upsell">Upsell</a></li>
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'downsell') ? 'active' : '' }}" type-name="downsell">Downsell</a></li>
                                    <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'confirmation') ? 'active' : '' }}" type-name="confirmation">Confirmation</a></li>
                                </ul>
                                @endif
                            </li>
                        @endforeach
                        <div class="add-one-btn m-t-30">
                            <button class="btn cus-btn" data-toggle="modal" data-target="#modalAddStep"><i class="fa fa-plus"></i>Add New Step</button>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md offset-2 col-md-10 col-sm-offset-2 col-sm-10 col-xs-12 m-t-50">

        @if($step->page)

            <div class="squeeze-sec">
                <div class="squeeze-top">
                    <ul class="nav nav-tabs navbar-right">
                        <li class="active"><a data-toggle="tab" href="#overview"><i class="fa fa-bar-chart"></i>Overview</a></li>
                        <li><a data-toggle="tab" href="#automation"><i class="fa fa-bolt"></i>Automation</a></li>
                        <li><a data-toggle="tab" href="#publishing"><i class="fa fa-wrench"></i>Publishing</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade in active">
                            <h3>{{ ucfirst($step->type) }} Page</h3>
                            <div class="col-md-12 col-sm-12 col-xs-12 p-t-30">
                                <div class="col-md-4 col-sm-4 col-xs-4 p-0">
                                    <div class="visit-sec">
                                        <img src="{{ asset('frontend/img/sm-pic.jpg') }}" class="img-responsive" />
                                        <div class="visit-min">
                                            <span>visitor <i class="fa fa-question" title="The number of unique visitors to this step in the funnel between January 22, 2017 and February 21, 2017."></i>  </span>
                                            <h3>20</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 p-0">
                                    <div class="visit-sec">
                                        <img src="{{ asset('frontend/img/sm-pic.jpg') }}" class="img-responsive" />
                                        <div class="visit-min">
                                            <span>Contacts <i class="fa fa-question" title="The number of unique visitors to this step in the funnel between January 22, 2017 and February 21, 2017."></i>  </span>
                                            <h3>10</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 p-0">
                                    <div class="visit-sec">
                                        <img src="{{ asset('frontend/img/sm-pic.jpg') }}" class="img-responsive" />
                                        <div class="visit-min">
                                            <span>Contacts Conv rate <i class="fa fa-question" title="The number of unique visitors to this step in the funnel between January 22, 2017 and February 21, 2017."></i>  </span>
                                            <h3>0%</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="txt-lne">
                                        <p><i class="fa fa-clock-o"></i>Stats current as of 07:20 am EST. Refresh again at 07:40 am EST </p>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 p-0">

                                    <form class="form-inline">
                                        <div class="col-md-8 col-sm-8 col-xs-12 p-l-0">
                                            <div class="form-cus">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="fa fa-cog"></i></div>
                                                        <input type="text" class="form-control" id="exampleInputAmount" value="{{ route('pages.show', [$step->page->id]) }}">
                                                        <a href="{{ route('pages.show', [$step->page->id]) }}" target="_blank" class="input-group-addon"><i class="fa fa-external-link"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                            <div class="slct-box">
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 p-t-30">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="img-box">
                                                <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                    <?php
                                                        $img_src = base_path() . "/" . App\BaseUrl::getPageThumbnailUrl() . "/" . $step->page->id . ".png";
                                                    ?>
                                                    @if(file_exists($img_src))
                                                        <img src="{{ asset(App\BaseUrl::getPageThumbnailUrl() . "/" . $step->page->id . ".png") }}" class="img-responsive">
                                                    @else
                                                        <img src="{{ asset('frontend/img/no-image-icon-2.png') }}" class="img-responsive">
                                                    @endif
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                    <div class="three-set">
                                                        <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                                            <div class="pd">
                                                                25 visitors
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                                            <div class="pd">
                                                                0 contact conv
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                                            <div class="pd">
                                                                0 Contacts
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-main">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                        <div class="btn-sec" style="text-align: center;">
                                                            <a href="{{ route('pages.edit', [$step->page->id]) }}" class="btn btn-success edit-link"><i class="fa fa-pencil-square-o"></i>Edit Page</a>
                                                            <!-- <button><i class="fa fa-external-link"></i></button>
                                                            <button><i class="fa fa-cog"></i></button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                    <div class="lnk-edit text-center">
                                                        <a href="#">Edit link in Classic editor</a>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="sec-set">
                                                <div class="sec-set-min">
                                                    <i class="fa fa-flask"></i>
                                                    <div class="st-font-head">Start split test</div>
                                                    <div class="st-font-para">
                                                        Optimize your lead and sales generation with split tests.
                                                    </div>
                                                    <div class="smple-btn">
                                                        <a href="#" class="btn btn-default"><i class="fa fa-plus"></i>Variation</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                                <!-- <div class="bttm-btn-main">
                                    <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                        <div class="bttm-btn">
                                            <a href="#" class="btn btn-default pull-left"><i class="fa fa-times"></i>Remove from funnel</a>
                                            <a href="#" class="btn btn-default pull-right"><i class="fa fa-trash"></i>Remove from funnel</a>
                                            <a href="#" class="btn btn-default pull-right"><i class="fa fa-copy"></i>Remove from funnel</a>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                        <div id="automation" class="tab-pane fade">
                            <h3>Squeeze Page</h3>
                        </div>
                        <div id="Publishing" class="tab-pane fade">
                            <h3>Squeeze Page</h3>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="tmplate-sec">
                @foreach($step->templates as $template)
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="tmp-mini">
                            <img src="{{ asset(App\BaseUrl::getPageTemplateThumbnailUrl() . '/' . $template->image) }}" class="img-responsive" />
                            <div class="hvr-cont">
                                <a href="javascript:void(0);" class="btn-hover btn-select-template" template-id="{{ $template->id }}">Select template</a>
                                <a href="{{ route('page_templates.show', [$template->id]) }}" target="_blank" class="btn-prw">Preview</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@stop


{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->

	<script type="text/javascript">
		$(".change-step-type").on("click", function(){
			typeName = $(this).attr("type-name");
			$.ajax({
				type : "post",
				url : "{{ route('change-funnel-step-type') }}",
				data : {
                    funnel_id : {{ $funnel->id }},
                    step_id : {{ $step->id }},
                    step_type : typeName,
                    _token : "{{ csrf_token() }}"
                },
                dataType : 'json',
				success : function(response){
					if( ('success' in response) && response.success)
                    {
                        location.reload();
                    }
                    else
                    {
                        alert('Something went wrong. Please reload the page and try again.');
                    }
				},
                error : function(){
                    alert('Something went wrong. Please reload the page and try again.');
                }
			});
		});

        $(".btn-select-template").on('click', function(){

            $.ajax({
                url : "{{ route('funnels.steps.select-template') }}",
                type : 'post',
                dataType : 'json',
                data : {
                    '_token' : "{{ csrf_token() }}",
                    'funnel_id' : "{{ $funnel->id }}",
                    'step_id' : "{{ $step->id }}",
                    'template_id' : $(this).attr('template-id')
                },
                success : function(response){
                    if('success' in response && response.success)
                    {
                        location.reload();
                    }
                    else
                    {
                        alert("An error occurred. Please reload the page and try again later.");
                    }
                },
                error : function(){
                    alert("An error occurred.");
                }
            });

        });


        $("#frmAddStep").on('submit', function(e){

            stepName = $("#inputAddStep").val();
            stepName = $.trim(stepName);
            if(stepName == "")
            {
                e.preventDefault();
            }

        });

        $( ".cross-icn" ).on( "click", function(){

            $( ".modal-resource-name" ).html( "Step" );
            var stepID = $( this ).attr( "data-step-id" );
            $( "#frmDeleteResource" ).attr( "action", "{{ route('funnels.steps.destroy') }}/" + stepID );

        });

	</script>

    <!--page level js ends-->
@stop
