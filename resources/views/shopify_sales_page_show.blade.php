@extends('layouts.dashboard')

{{-- page title --}}
@section('title')
	Shopify Sales Product
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

        .menu .sub-menu li a.active{
            color: #000000;
        }

        .prfl-list{
            z-index: 100;
        }

        .setting-main{
        	margin-top: 55px;
        }
        
    </style>
    <!--end of page level css-->
@stop

@section('content')

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

    <div class="col-md-2 col-sm-3 col-xs-12 p-0 m-0 fixed-demo">
        <div class="collapse navbar-collapse p-0" id="bs-example-navbar-collapse-1">
            <div class="optin-side">
                <ul type="none" class="menu p-0 m-0">
                    @foreach($funnel->steps as $funnelStep)
                        <li class="{{ ( $funnelStep->id == $step->id) ? 'active' : '' }}">
                            <a href="{{ route('funnels.steps.show', [$funnelStep->funnel_id, $funnelStep->id]) }}">{{ ucfirst($funnelStep->name) }}</a>
                            @if(!($funnelStep->page))
                            <ul type="none" class="sub-menu p-0 m-0">
                                <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'optin') ? 'active' : '' }}" type-name="optin">Optin</a></li>
                                <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'sales') ? 'active' : '' }}" type-name="sales">Sales</a></li>
                                <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'payment') ? 'active' : '' }}" type-name="payment">Payment</a></li>
                                <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'upsell') ? 'active' : '' }}" type-name="upsell">Upsell</a></li>
                                <li><a href="javascript:void(0);" class="change-step-type {{ ($step->type == 'downsell') ? 'active' : '' }}" type-name="downsell">Downsell</a></li>
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

	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-md-offset-2 col-sm-offset-3 p-0">
        <div class="setting-main">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <ul class="nav nav-tabs navbar-right setting-tab">
                    <li class="col-md-3 col-sm-3 col-xs-12 active"><a data-toggle="tab" href="#settings">Settings</a></li>
                    <li class="col-md-3 col-sm-3 col-xs-12"><a data-toggle="tab" href="#shipping">Shipping</a></li>
                    <li class="col-md-3 col-sm-3 col-xs-12"><a data-toggle="tab" href="#templates">Templates</a></li>
                </ul>

				<div class="tab-content">
                    <div id="settings" class="tab-pane fade in active">
                      	<div class="col-md-12 col-sm-12 col-xs-12">
                        	<div class="data-div dl-horizontal">
                            	<dl>
                              		<dt>Title</dt>
                              		<dd>Iphone 6s</dd>
                            	</dl>
                            	<dl>
                              		<dt>Vendor</dt>
                              		<dd>John mathew</dd>
                            	</dl>
                            	<dl>
                              		<dt>Select Product Variant</dt>
                              		<dd>
                              			<select class="form-control">
                                			<option>Blue</option>
                                			<option>Black</option>
                                			<option>White</option>
                                			<option>Pink</option>
                                			<option>Gold</option>
                              			</select>
                              		</dd>
                            	</dl>
                            	<dl>
                              		<dt>Image</dt>
                              		<dd><img src="img/iPhone_6s.png" class="img-responsive iphone-img" /></dd>
                            	</dl>
                            	<dl>
                              		<dt>Magic Image Gallery</dt>
                              		<dd><a href="#" class="btn btn-default btn-clr">Create magic image gallery</a></dd>
                            	</dl>
                            	<dl>
                              		<dt>Magic variant buy button</dt>
                              		<dd><a href="#" class="btn btn-default btn-clr">Create magic variant button</a></dd>
                            	</dl>
                            	<dl>
                              		<dt>Sells for:</dt>
                              		<dd>
                              			<form class="form-inline" method="post" action="{{ route('edit-sales-product') }}">
                                  			<div class="form-group">
                                    			<div class="input-group">
                                      				<div class="input-group-addon">$</div>
                                      				<input type="text" class="form-control" id="exampleInputAmount" placeholder="10">
                                      				<div class="input-group-addon">USD</div>
                                    			</div>
                                  			</div>
                                		</form>
                                	</dd>
                            	</dl>
                            	<dl class="input-full">
                              		<dt>Quantity of product to be sold:</dt>
                              		<dd><input type="text" name="text" class="form-control" placeholder=""></dd>
                            	</dl>
                            	<div class="save-btn">
                            		<div class="col-md-12 col-sm-12 col-xs-12">
                              			<button class="btn cus-btn">Save price and quantity modifications</button>
                            		</div>
                            	</div>
                        	</div>
                    	</div>
                	</div>

                	<div id="shipping" class="tab-pane fade">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                      		<div class="shipping-sec">
                        		<div class="form-group">
                          			<div class="col-sm-10">
                            			<div class="checkbox">
                              				<label>
                                				<input type="checkbox" class="show"> Flat rate shipping-select this to override your shopify's store
                              				</label>
                            			</div>
                          			</div>
                        		</div>
                        		<div class="flat-rate">
                            		<div class="col-md-12 col-sm-12 col-xs-12">
                              			<label>Flat shipping rate title</label>
                              			<input type="text" name="shippingrate" class="form-control form-group">
                              			<div class="flat-mini">
                              				<div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                				<form class="form-inline form-group">
                                    				<div class="form-group">                                      
                                      					<div class="input-group">
                                        					<div class="input-group-addon">$</div>
                                        					<input type="text" class="form-control" id="exampleInputAmount" placeholder="0">
                                        					<div class="input-group-addon">USD</div>
                                      					</div>
                                    				</div>
                                  				</form>
                                  				<div class="save-btn">
                                    				<div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                      					<button class="btn cus-btn">Save price and quantity modifications</button>
                                    				</div>
                                  				</div>
                                			</div>
                              			</div>
                            		</div>
                          		</div>
                      		</div>
                      	</div>
                	</div>
                	<div id="templates" class="tab-pane fade">
	                    <div class="setting-list">
    		                <div class="col-md-12 col-sm-12 col-xs-12">
                        		<div class="tmplate-sec">
                        			@if($step->page)
                        			@else
	                        		<div class="tmplate-sec">
						                @foreach($step->templates as $template)
						                    <div class="col-md-4 col-sm-4 col-xs-12">
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
                    		</div>
                		</div>
              		</div>
        		</div>
    		</div>
    	</div>
    </div>
@stop


{{-- page level scripts --}}
@section('footer_scripts')
	<!-- page level js starts-->
	<!--  -->
	<!--page level js ends-->
@stop