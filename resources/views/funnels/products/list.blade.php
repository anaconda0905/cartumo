@extends('layouts.app')

@section("title", "Step Product List")

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css"/>
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
                    <div class="col-md-4">
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


                    <div class="col-md-8 text-right">
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
                            @include('funnels.partials.funnel-option-menu')
                            <div class="x_content funnel-templates">
                                {{-- $steps[0]->templates --}}


                                @if ( count($stepProducts) == 0 )
                                    <h2>Add a New Product to Funnel Step</h2>
                                    <p>Looks like you haven't added any products for this funnel step yet. Begin by
                                        selecting
                                        'Add a Product' below and set the price of your product inside of the settings
                                        popup.
                                        You can add as many products as you need for this funnel step.</p>
                                @else
                                    <h2>Products of the Funnel Step</h2>
                                @endif
                                <br/>
                                <div id="product_list">
                                    @if ( !empty($stepProducts) )

                                        @foreach ($stepProducts as $key=>$stepProduct)

                                            @if ( $stepProduct->product_type == 'manual' )

                                                <div class="row products">
                                                    <div class="col-md-7">
                                                        <strong class="product-title">
                                                            <?php $productImages = json_decode( $stepProduct->getProduct()->images ); ?>                                                            
                                                            <img src="{{ (!empty($productImages->main)) ? $productImages->main : asset('images/no-images.png') }}"
                                                                 style="width: 42px;float: left;margin-right: 15px"/>
                                                            {{ $stepProduct->getProduct()->name }}
                                                        </strong>
                                                    </div>

                                                    <div class="col-md-3 price-column">
                                                        <strong>${{ $stepProduct->getProduct()->price }}</strong>
                                                    </div>

                                                    <div class="col-md-25">
                                                        <div class="horizontal">
                                                            <span class="pull-right">
                                                                @if ( (!empty(json_decode($stepProduct->details)->bump)) && (json_decode($stepProduct->details)->bump != false) )
                                                                @else
                                                                    <button class="btn btn-warning data-product-edit"
                                                                            data-step-product-id="{{ $stepProduct->id }}"
                                                                            data-product-id="{{ $stepProduct->getProduct()->id }}"
                                                                            data-product-funnel-id="{{ $stepProduct->getProduct()->funnel_id }}"
                                                                            data-product-step-id="{{ $stepProduct->getProduct()->step_id }}"
                                                                            data-action-url="{{ route('product.destroy', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->getProduct()->id)) }}"
                                                                            data-toggle="modal"
                                                                            data-target="#manualProductEditModal{{ $key }}"
                                                                            data-step-product-type="product">
                                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                    </button>
                                                                @endif
                                                                <button class="btn btn-danger data-product-remove"
                                                                        data-step-product-id="{{ $stepProduct->id }}"
                                                                        data-product-id="{{ $stepProduct->getProduct()->id }}"
                                                                        data-product-funnel-id="{{ $stepProduct->getProduct()->funnel_id }}"
                                                                        data-product-step-id="{{ $stepProduct->getProduct()->step_id }}"
                                                                        data-action-url="{{ route('product.destroy', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->getProduct()->id)) }}">
                                                              <i class="fa fa-fw fa-trash"
                                                                 aria-hidden="true"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>


                                                <!-- PRODUCT EDIT MODAL -->
                                                <div id="manualProductEditModal{{ $key }}" class="modal fade"
                                                     role="dialog">
                                                    <div class="modal-dialog modal-lg">

                                                        <form id="frm_product_settings" class="form-horizontal"
                                                              data-product-type="manual">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal">&times;
                                                                    </button>
                                                                    <h4 class="modal-title">Settings</h4>
                                                                </div>
                                                                <div class="modal-body" id="paragraph_settings_body">
                                                                    <div class="" role="tabpanel"
                                                                         data-example-id="togglable-tabs">
                                                                        <ul id="myTab" class="nav nav-tabs bar_tabs"
                                                                            role="tablist">
                                                                            <li role="presentation" class="active"><a
                                                                                        href="#product_tab_settings{{ $key }}"
                                                                                        id="home-tab{{ $key }}"
                                                                                        role="tab" data-toggle="tab"
                                                                                        aria-expanded="true"><i
                                                                                            class="fa fa-envelope"
                                                                                            aria-hidden="true"></i>
                                                                                    &nbsp; Product </a>
                                                                            </li>
                                                                            <li role="presentation" class=""><a
                                                                                        href="#shipping_tab_settings{{ $key }}"
                                                                                        role="tab"
                                                                                        id="profile-tab{{ $key }}"
                                                                                        data-toggle="tab"
                                                                                        aria-expanded="false"><i
                                                                                            class="fa fa-plug"
                                                                                            aria-hidden="true"></i>
                                                                                    &nbsp; Shipping </a>
                                                                            </li>
                                                                            <li role="presentation"><a
                                                                                        href="#coupon_tab_settings{{ $key }}"
                                                                                        id="coupon-tab{{ $key }}"
                                                                                        role="tab" data-toggle="tab"
                                                                                        aria-expanded="true"><i
                                                                                            class="fa fa-envelope"
                                                                                            aria-hidden="true"></i>
                                                                                    &nbsp; Coupon </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div id="myTabContent" class="tab-content">

                                                                            <div role="tabpanel"
                                                                                 class="tab-pane fade active in"
                                                                                 id="product_tab_settings{{ $key }}"
                                                                                 aria-labelledby="home-tab">

                                                                                <div id="manual_product_list{{ $stepProduct->getProduct()->id }}"></div>
                                                                            </div>

                                                                            <div role="tabpanel" class="tab-pane fade"
                                                                                 id="shipping_tab_settings{{ $key }}"
                                                                                 aria-labelledby="home-tab">

                                                                                @if ( (!empty(json_decode($stepProduct->details)->shipping)) )
																					<?php $shippings = json_decode( $stepProduct->details )->shipping; ?>
                                                                                @else
																					<?php $shippings = array(); ?>
                                                                                @endif

                                                                                <div class="shipping-panel-body"
                                                                                     id="shipping_panel_body">
                                                                                    @if ( !empty($shippings) )
                                                                                        @foreach ( $shippings as $skey=>$shipping )
                                                                                            @if ( !empty($shipping->title)  )
                                                                                                <div class="row clearfix">
                                                                                                    <div class="form-group col-md-7">
                                                                                                        <label for="shipping_title">Title: </label>
                                                                                                        <input type="text"
                                                                                                               class="form-control"
                                                                                                               name="shipping[{{ $skey }}][title]"
                                                                                                               id="shipping_title{{ $skey }}"
                                                                                                               value="{{ $shipping->title }}"
                                                                                                               placeholder="Shipping title"/>
                                                                                                    </div>

                                                                                                    <div class="form-group col-md-4">
                                                                                                        <label for="shipping_amount">Amount: </label>
                                                                                                        <input type="text"
                                                                                                               class="form-control"
                                                                                                               name="shipping[{{ $skey }}][amount]"
                                                                                                               value="{{ $shipping->amount }}"
                                                                                                               id="shipping_amount{{ $skey }}"
                                                                                                               placeholder="USD 0.05"/>
                                                                                                    </div>

                                                                                                    <div class="form-group col-md-1 text-right">
                                                                                                        <button type="button"
                                                                                                                class="btn btn-danger remove-shipping-row"
                                                                                                                style="margin-top: 24px;">
                                                                                                            <i class="fa fa-trash-o"
                                                                                                               aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif

                                                                                    <div class="row clearfix">
                                                                                        <div class="form-group col-md-7">
                                                                                            <label for="shipping_title">Title: </label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="shipping[{{ (!empty($skey)) ? intVal($skey+1) : 0 }}][title]"
                                                                                                   id="shipping_title{{ (!empty($skey)) ? intVal($skey+1) : 0 }}"
                                                                                                   placeholder="Shipping title"/>
                                                                                        </div>

                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="shipping_amount">Amount: </label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="shipping[{{ (!empty($skey)) ? intVal($skey+1) : 0 }}][amount]"
                                                                                                   id="shipping_amount{{ (!empty($skey)) ? intVal($skey+1) : 0 }}"
                                                                                                   placeholder="USD 0.05"/>
                                                                                        </div>

                                                                                        <div class="form-group col-md-1 text-right">
                                                                                            <button type="button"
                                                                                                    class="btn btn-primary new-shipping-row"
                                                                                                    style="margin-top: 24px;">
                                                                                                <i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div role="tabpanel" class="tab-pane fade"
                                                                                 id="coupon_tab_settings{{ $key }}"
                                                                                 aria-labelledby="home-tab">

                                                                                <div class="form-group">
                                                                                    <label for="subject">Choose
                                                                                        Coupon</label>
                                                                                    <select name="coupon_id"
                                                                                            class="form-control">
                                                                                        @if ( $coupons->count() > 0 )
                                                                                            <option value="">-- CHOOSE
                                                                                                --
                                                                                            </option>
                                                                                            @foreach ( $coupons as $coupon )
                                                                                                @if ( !empty(json_decode($stepProduct->details)->coupon_id) )
                                                                                                    @if ( json_decode($stepProduct->details)->coupon_id == $coupon->id )
                                                                                                        <option value="{{ $coupon->id }}"
                                                                                                                selected>{{ $coupon->coupon_name }}</option>
                                                                                                    @else
                                                                                                        <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @else
                                                                                            <p>No coupon</p>
                                                                                        @endif
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group"
                                                                                     id="coupon_details">

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="_token"
                                                                           value="{{ csrf_token() }}"/>
                                                                    <input type="hidden" name="product_type"
                                                                           value="manual"/>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success"
                                                                            data-product-type="manual"
                                                                            id="update_product_settings_frm"> Update
                                                                        Product
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                            @else

                                                <div class="row products">
                                                    <div class="col-md-7">
                                                        <strong class="product-title">
                                                            <!--<i class="fa fa-shopping-bag" aria-hidden="true"></i>-->
                                                            @if ( !empty($stepProduct->getProduct()->product) )
                                                                <img src="{{ $stepProduct->getProduct()->product->image->src }}"
                                                                     style="width: 42px;float: left;margin-right: 15px"/>
                                                                {{ $stepProduct->getProduct()->product->title }}
                                                            @endif

                                                            @if ( !empty(json_decode($stepProduct->details)->bump) )
                                                                <p>Bump Product</p>
                                                            @endif

                                                        </strong>
                                                    </div>

                                                    <div class="col-md-3 price-column">
                                                        @if ( !empty($stepProduct->getProduct()->product) )
                                                            <strong>
                                                                {{ current($stepProduct->getProduct()->product->variants)->price }}
                                                                USD
                                                            </strong>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="horizontal">

                                                            <span class="pull-right">
                                                                @if ( (!empty(json_decode($stepProduct->details)->bump)) && (json_decode($stepProduct->details)->bump != false) )

                                                                @else
                                                                    @if ( !empty($product->id) )
                                                                        <button class="btn btn-warning data-shopify-product-edit"
                                                                                data-step-product-id="{{ $stepProduct->id }}"
                                                                                data-product-id="{{ $product->id }}"
                                                                                data-product-funnel-id="{{ $funnel->id }}"
                                                                                data-product-step-id="{{ $currentStep->id }}"
                                                                                data-action-url="{{ route('product.destroy', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->getProduct()->product->id)) }}"
                                                                                data-toggle="modal"
                                                                                data-target="#shopifyProductEditModal{{ $key }}"
                                                                                data-step-product-type="product">
                                                                            <i class="fa fa-pencil"
                                                                               aria-hidden="true"></i>
                                                                        </button>
                                                                    @endif
                                                                @endif

                                                                @if ( !empty($product->id) )
                                                                    <button class="btn btn-danger data-product-remove"
                                                                            data-step-product-id="{{ $stepProduct->id }}"
                                                                            data-product-id="{{ $product->id }}"
                                                                            data-product-funnel-id="{{ $funnel->id }}"
                                                                            data-product-step-id="{{ $currentStep->id }}"
                                                                            data-action-url="{{ route('product.destroy', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->getProduct()->product->id)) }}"><i
                                                                                class="fa fa-fw fa-trash"
                                                                                aria-hidden="true"></i></button>
                                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                </div>

                                <div id="shopifyProductEditModal{{ $key }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form id="frm_product_settings" class="form-horizontal"
                                              data-product-type="shopify">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Choose product</h4>
                                                </div>
                                                <div class="modal-body" id="paragraph_settings_body">

                                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                            <li role="presentation" class="active"><a
                                                                        href="#product_tab_settings{{ $key }}"
                                                                        id="home-tab{{ $key }}" role="tab"
                                                                        data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Product </a>
                                                            </li>
                                                            <li role="presentation" class=""><a
                                                                        href="#shipping_tab_settings{{ $key }}"
                                                                        role="tab"
                                                                        id="profile-tab{{ $key }}" data-toggle="tab"
                                                                        aria-expanded="false"><i class="fa fa-plug"
                                                                                                 aria-hidden="true"></i>
                                                                    &nbsp; Shipping </a>
                                                            </li>
                                                            <li role="presentation"><a
                                                                        href="#coupon_tab_settings{{ $key }}"
                                                                        id="coupon-tab{{ $key }}" role="tab"
                                                                        data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Coupon </a>
                                                            </li>
                                                        </ul>
                                                        <div id="myTabContent" class="tab-content">

                                                            <div role="tabpanel" class="tab-pane fade active in"
                                                                 id="product_tab_settings{{ $key }}"
                                                                 aria-labelledby="home-tab">

                                                                <div id="shopify_product_list{{ json_decode($stepProduct->details)->product_id }}">
                                                                    <i class="fa fa-circle-o-notch fa-spin"
                                                                       style="font-size:24px;vertical-align: middle"></i>&nbsp;loading
                                                                    products...
                                                                </div>
                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="shipping_tab_settings{{ $key }}"
                                                                 aria-labelledby="home-tab">

                                                                @if ( (!empty(json_decode($stepProduct->details)->shipping)) )
																	<?php $shippings = json_decode( $stepProduct->details )->shipping; ?>
                                                                @else
																	<?php $shippings = array(); ?>
                                                                @endif

                                                                <div class="shipping-panel-body"
                                                                     id="shipping_panel_body">
                                                                    @if ( !empty($shippings) )
                                                                        @foreach ( $shippings as $skey=>$shipping )
                                                                            @if ( !empty($shipping->title)  )
                                                                                <div class="row clearfix">
                                                                                    <div class="form-group col-md-7">
                                                                                        <label for="shipping_title">Title: </label>
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               name="shipping[{{ $skey }}][title]"
                                                                                               id="shipping_title{{ $skey }}"
                                                                                               value="{{ $shipping->title }}"
                                                                                               placeholder="Shipping title"/>
                                                                                    </div>

                                                                                    <div class="form-group col-md-4">
                                                                                        <label for="shipping_amount">Amount: </label>
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               name="shipping[{{ $skey }}][amount]"
                                                                                               value="{{ $shipping->amount }}"
                                                                                               id="shipping_amount{{ $skey }}"
                                                                                               placeholder="USD 0.05"/>
                                                                                    </div>

                                                                                    <div class="form-group col-md-1 text-right">
                                                                                        <button type="button"
                                                                                                class="btn btn-danger remove-shipping-row"
                                                                                                style="margin-top: 24px;">
                                                                                            <i class="fa fa-trash-o"
                                                                                               aria-hidden="true"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif

                                                                    <div class="row clearfix">
                                                                        <div class="form-group col-md-7">
                                                                            <label for="shipping_title">Title: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[{{ (!empty($skey)) ? intVal($skey+1) : 0 }}][title]"
                                                                                   id="shipping_title{{ (!empty($skey)) ? intVal($skey+1) : 0 }}"
                                                                                   placeholder="Shipping title"/>
                                                                        </div>

                                                                        <div class="form-group col-md-4">
                                                                            <label for="shipping_amount">Amount: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[{{ (!empty($skey)) ? intVal($skey+1) : 0 }}][amount]"
                                                                                   id="shipping_amount{{ (!empty($skey)) ? intVal($skey+1) : 0 }}"
                                                                                   placeholder="USD 0.05"/>
                                                                        </div>

                                                                        <div class="form-group col-md-1 text-right">
                                                                            <button type="button"
                                                                                    class="btn btn-primary new-shipping-row"
                                                                                    style="margin-top: 24px;">
                                                                                <i class="fa fa-plus"
                                                                                   aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="coupon_tab_settings{{ $key }}"
                                                                 aria-labelledby="home-tab">

                                                                <div class="form-group">
                                                                    <label for="subject">Choose Coupon</label>
                                                                    <select name="coupon_id" class="form-control">
                                                                        @if ( $coupons->count() > 0 )
                                                                            <option value="">-- CHOOSE --</option>
                                                                            @foreach ( $coupons as $coupon )
                                                                                @if ( !empty(json_decode($stepProduct->details)->coupon_id) )
                                                                                    @if ( json_decode($stepProduct->details)->coupon_id == $coupon->id )
                                                                                        <option value="{{ $coupon->id }}"
                                                                                                selected>{{ $coupon->coupon_name }}</option>
                                                                                    @else
                                                                                        <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                                    @endif
                                                                                @else
                                                                                    <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <p>No coupon</p>
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="form-group" id="coupon_details">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <input type="hidden" name="product_type" value="shopify"/>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"
                                                            data-product-type="shopify"
                                                            id="update_product_settings_frm"> Update Product
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @endif


                                @endforeach

                                @endif
                            </div>

                            <br/>


                            <div class="row clearfix">

                                @if ( empty($stepProduct) )
                                    <div class="col-md-12 text-right">
                                        @if ( empty($funnel->type) )
                                            <span><button type="button" id="button_product_shopify"
                                                          class="btn special-button-success btn-lg"
                                                          data-toggle="modal"
                                                          data-target="#shopifyModal"><i class="fa fa-shopping-bag"
                                                                                         aria-hidden="true"></i> Add Shopify product</button></span>
                                            <span><button type="button" id="button_product_manual"
                                                          class="btn special-button-primary btn-lg"
                                                          data-toggle="modal"
                                                          data-target="#myModal"><i class="fa fa-plus"
                                                                                    aria-hidden="true"></i> Add manual product</button></span>
                                        @elseif ( $funnel->type == 'shopify' )

                                            <span><button type="button" id="button_product_shopify"
                                                          class="btn special-button-success btn-lg"
                                                          data-toggle="modal"
                                                          data-target="#shopifyModal"><i class="fa fa-shopping-bag"
                                                                                         aria-hidden="true"></i> Add Shopify product</button></span>
                                        @elseif ( $funnel->type == 'manual' )
                                            <span><button type="button" id="button_product_manual"
                                                          class="btn special-button-primary btn-lg"
                                                          data-toggle="modal"
                                                          data-target="#myModal">
                                                              <i class="fa fa-plus" aria-hidden="true"></i> Add manual product</button></span>
                                        @endif
                                    </div>
                                @else
                                    @if ( !$hasBump )
                                        {{-- @if ( ($currentType->name == 'Product') || ($currentType->name == 'Sales') )
                                            <div class="col-md-12 text-right">
                                                    <span><button type="button" id="button_bump_product_manual"
                                                                  class="btn special-button-warning btn-lg"
                                                                  data-toggle="modal"
                                                                  data-target="#bumpProductModal">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add Bump Product</button>
                                                    </span>
                                            </div>
                                        @endif --}}
                                    @else
                                        @if ( !$hasProduct )
                                            @if ( $funnel->type == 'manual' )
                                                <span class="pull-right"><button type="button"
                                                                                 id="button_product_manual"
                                                                                 class="btn special-button-primary btn-lg"
                                                                                 data-toggle="modal"
                                                                                 data-target="#myModal">
                                                                  <i class="fa fa-plus" aria-hidden="true"></i> Add manual product</button></span>
                                            @else
                                                <span class="pull-right"><button type="button"
                                                                                 id="button_product_shopify"
                                                                                 class="btn special-button-success btn-lg"
                                                                                 data-toggle="modal"
                                                                                 data-target="#shopifyModal"><i
                                                                class="fa fa-shopping-bag"
                                                                aria-hidden="true"></i> Add Shopify product</button></span>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </div>


                        @if ( $funnel->type == 'manual' )
                            <!-- MANUAL Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form id="frm_product_settings" class="form-horizontal"
                                              data-product-type="manual">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Manual Products</h4>
                                                </div>
                                                <div class="modal-body" id="paragraph_settings_body">

                                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                            <li role="presentation" class="active"><a
                                                                        href="#product_tab_settings"
                                                                        id="home-tab" role="tab" data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Product </a>
                                                            </li>
                                                            <li role="presentation" class=""><a
                                                                        href="#shipping_tab_settings" role="tab"
                                                                        id="profile-tab" data-toggle="tab"
                                                                        aria-expanded="false"><i class="fa fa-plug"
                                                                                                 aria-hidden="true"></i>
                                                                    &nbsp; Shipping </a>
                                                            </li>
                                                            <li role="presentation"><a
                                                                        href="#fullfillment_coupon_settings"
                                                                        id="home-tab" role="tab" data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Coupon </a>
                                                            </li>
                                                        </ul>
                                                        <div id="myTabContent" class="tab-content">

                                                            @if ( !empty($productEmailIntegration) )
																<?php $emailSettings = json_decode( $productEmailIntegration->details, TRUE ); ?>
                                                                <script>var list_id = "{{ $emailSettings['integration']['list_id'] }}";</script>
                                                            @else
                                                                <script>var list_id = "";</script>
                                                            @endif

                                                            <div role="tabpanel" class="tab-pane fade active in"
                                                                 id="product_tab_settings"
                                                                 aria-labelledby="home-tab">
                                                                <!--<button class="btn btn-primary pull-right">Add New</button>-->


                                                                <h3>Choose product for the page</h3>
                                                                <div class="form-group">
                                                                    <input type="search" id="manual_search_product"
                                                                           name="search_product"
                                                                           placeholder="Enter a product name to search"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div id="manual_product_list"></div>

                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="shipping_tab_settings"
                                                                 aria-labelledby="home-tab">

                                                                <div class="shipping-panel-body"
                                                                     id="shipping_panel_body">
                                                                    <div class="row clearfix">
                                                                        <div class="form-group col-md-7">
                                                                            <label for="shipping_title">Title: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[0][title]"
                                                                                   id="shipping_title"
                                                                                   placeholder="Shipping title"/>
                                                                        </div>

                                                                        <div class="form-group col-md-4">
                                                                            <label for="shipping_amount">Amount: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[0][amount]"
                                                                                   id="shipping_amount"
                                                                                   placeholder="USD 0.05"/>
                                                                        </div>

                                                                        <div class="form-group col-md-1 text-right">
                                                                            <button type="button"
                                                                                    class="btn btn-primary new-shipping-row"
                                                                                    style="margin-top: 24px;">
                                                                                <i class="fa fa-plus"
                                                                                   aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="fullfillment_coupon_settings"
                                                                 aria-labelledby="home-tab">

                                                                <div class="form-group">
                                                                    <label for="subject">Choose Coupon</label>
                                                                    <select name="coupon_id" class="form-control">
                                                                        @if ( $coupons->count() > 0 )
                                                                            <option value="">-- CHOOSE --</option>
                                                                            @foreach ( $coupons as $coupon )
                                                                                <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                            @endforeach
                                                                        @else
                                                                            <p>No coupon</p>
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="form-group" id="coupon_details">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <input type="hidden" name="product_type" value="manual"/>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"
                                                            data-product-type="manual"
                                                            id="update_product_settings_frm"> Update Product
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        @else
                            <!-- SHOPIFY Modal -->
                                <div id="shopifyModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form id="frm_product_settings" class="form-horizontal"
                                              data-product-type="shopify">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Shopify products</h4>
                                                </div>
                                                <div class="modal-body" id="paragraph_settings_body">

                                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                            <li role="presentation" class="active"><a
                                                                        href="#product_tab_settings"
                                                                        id="home-tab" role="tab" data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Product </a>
                                                            </li>
                                                            <li role="presentation" class=""><a
                                                                        href="#shipping_tab_settings" role="tab"
                                                                        id="profile-tab" data-toggle="tab"
                                                                        aria-expanded="false"><i class="fa fa-plug"
                                                                                                 aria-hidden="true"></i>
                                                                    &nbsp; Shipping </a>
                                                            </li>
                                                            <li role="presentation"><a
                                                                        href="#fullfillment_coupon_settings"
                                                                        id="home-tab" role="tab" data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Coupon </a>
                                                            </li>
                                                        </ul>

                                                        <div id="myTabContent" class="tab-content">

                                                            @if ( !empty($productEmailIntegration) )
																<?php $emailSettings = json_decode( $productEmailIntegration->details, TRUE ); ?>
                                                                <script>var list_id = "{{ $emailSettings['integration']['list_id'] }}";</script>
                                                            @else
                                                                <script>var list_id = "";</script>
                                                            @endif

                                                            <div role="tabpanel" class="tab-pane fade active in"
                                                                 id="product_tab_settings"
                                                                 aria-labelledby="home-tab">


                                                                <div id="shopify_product_list"></div>

                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="shipping_tab_settings"
                                                                 aria-labelledby="home-tab">

                                                                <div class="shipping-panel-body"
                                                                     id="shipping_panel_body">
                                                                    <div class="row clearfix">
                                                                        <div class="form-group col-md-7">
                                                                            <label for="shipping_title">Title: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[0][title]"
                                                                                   id="shipping_title"
                                                                                   placeholder="Shipping title"/>
                                                                        </div>

                                                                        <div class="form-group col-md-4">
                                                                            <label for="shipping_amount">Amount: </label>
                                                                            <input type="text" class="form-control"
                                                                                   name="shipping[0][amount]"
                                                                                   id="shipping_amount"
                                                                                   placeholder="USD 0.05"/>
                                                                        </div>

                                                                        <div class="form-group col-md-1 text-right">
                                                                            <button type="button"
                                                                                    class="btn btn-primary new-shipping-row"
                                                                                    style="margin-top: 24px;">
                                                                                <i class="fa fa-plus"
                                                                                   aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div role="tabpanel" class="tab-pane fade"
                                                                 id="fullfillment_coupon_settings"
                                                                 aria-labelledby="home-tab">

                                                                <div class="form-group">
                                                                    <label for="subject">Choose Coupon</label>
                                                                    <select name="coupon_id" class="form-control">
                                                                        @if ( $coupons->count() > 0 )
                                                                            <option value="">-- CHOOSE --</option>
                                                                            @foreach ( $coupons as $coupon )
                                                                                <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                                            @endforeach
                                                                        @else
                                                                            <p>No coupon</p>
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="form-group" id="coupon_details">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <input type="hidden" name="product_type" value="shopify"/>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"
                                                            data-product-type="shopify"
                                                            id="update_product_settings_frm"> Update Product
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        @endif




                        <!-- Bump product -->
                            @if ( !$hasBump )
                                <div id="bumpProductModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <form id="frm_bump_product_settings" class="form-horizontal">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Choose Bump Product</h4>
                                                </div>
                                                <div class="modal-body" id="paragraph_settings_body">

                                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                            <li role="presentation" class="active"><a
                                                                        href="#product_tab_settings"
                                                                        id="home-tab" role="tab" data-toggle="tab"
                                                                        aria-expanded="true"><i
                                                                            class="fa fa-envelope"
                                                                            aria-hidden="true"></i>
                                                                    &nbsp; Product </a>
                                                            </li>
                                                        </ul>
                                                        <div id="myTabContent" class="tab-content">

                                                            @if ( !empty($productEmailIntegration) )
																<?php $emailSettings = json_decode( $productEmailIntegration->details, TRUE ); ?>
                                                                <script>var list_id = "{{ $emailSettings['integration']['list_id'] }}";</script>
                                                            @else
                                                                <script>var list_id = "";</script>
                                                            @endif

                                                            <div role="tabpanel" class="tab-pane fade active in"
                                                                 id="product_tab_settings"
                                                                 aria-labelledby="home-tab">

                                                                <div id="bump_product_list"><i
                                                                            class="fa fa-circle-o-notch fa-spin"
                                                                            style="font-size:24px;vertical-align: middle"></i>&nbsp;loading
                                                                    products...
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <input type="hidden" name="product_type"
                                                           value="{{ $funnel->type }}"/>
                                                    <input type="hidden" name="chk_bump_product"
                                                           id="chk_bump_product"
                                                           value="yes"/>

                                                </div>

                                                <div class="modal-footer">
                                                    <!--<button type="submit" class="btn btn-success"
                                                            id="update_bump_product_settings"> Save Product
                                                    </button>-->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ( count($stepProducts) > 0 )
                        <div class="text-right">
                            <button type="button" id="remove_step_products" class="btn btn-danger"
                                    data-step-id="{{ $currentStep->id }}">
                                <i class="fa fa-fw fa-trash" aria-hidden="true"></i> Remove product from step
                            </button>
                        </div>
                    @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.min.js"></script>
    <script>
        $("#button_product_manual").click(function (e) {

            //$("#shopifyModal .modal-body").append(""); //ajax-loader.gif


            $.ajax({
                type: 'GET',
                url: "{{ route('manual.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}",
                success: function (response) {
                    console.log(response);
                    $("#manual_product_list").html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });

        $("#button_bump_product_manual").click(function (e) {

            //$("#shopifyModal .modal-body").append(""); //ajax-loader.gif


            $.ajax({
                type: 'GET',
                url: "{{ route('bump.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}&type={{ $funnel->type }}",
                success: function (response) {
                    console.log(response);
                    $("#bump_product_list").html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });


        //product update
        var tmp_manual_choose_product = null;
        var product_id;
        $(document).on('click', '.manual-choose-product', function (e) {

            e.preventDefault();

            var button = $(this);
            var tmp;

            product_id = $(this).attr('data-product-id');

            if (tmp_manual_choose_product != null) {
                if ($("#manual_product_add_step").length > 0) {
                    $("#manual_product_add_step").remove();
                }

                $(tmp_manual_choose_product).removeClass('btn-success').addClass('btn-primary');

                //$("#bump_product_option #chk_bump_product").prop('checked', '');
            } else {
                if ($("#manual_product_add_step").length > 0) {
                    $("#manual_product_add_step").remove();
                }
            }

            $(this).parent().append('<input type="hidden" id="manual_product_add_step" name="product_id" value="' + $(this).attr('data-product-id') + '" />');
            $(this).removeClass('btn-primary').addClass('btn-success');


            //show bump option
            //$("#bump_product_option").show();

            tmp_manual_choose_product = $(this);

        });

        //add/update product
        //$(document).on("click", "#update_product_settings", function (e) {
        $(document).on("submit", "#frm_product_settings", function (e) {

            e.preventDefault();

            //alert(this);

            const button = $(this).find("#update_product_settings_frm");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf_token').val()
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('product.store', [$funnel->id, $currentStep->id]) }}",
                data: $(this).serialize() + '&product_id=' + product_id + '&product_type=' + $(this).attr('data-product-type'),
                beforeSend: function () {

                    tmp = $(button).html();
                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i><span class="sr-only">Loading...</span>');

                    $("#product_list").append("<iframe src='' id='iframe_updater' style='display: none'></iframe>");

                },
                success: function (response) {
                    //alert(response);
                    console.log(response);
                    // return false;

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        //start updating editor
                        update_page_editor(json.url);

                    } else {
                        alert(json.message);
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });


        //update bump product
        $(document).on("click", ".bump-choose-product", function (e) {

            e.preventDefault();

            const button = $(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('product.store', [$funnel->id, $currentStep->id]) }}",
                data: $("#frm_bump_product_settings").serialize() + '&product_id=' + $(button).attr('data-product-id') + '&type=bump',
                beforeSend: function () {

                    tmp = $(button).html();
                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i><span class="sr-only">Loading...</span>');
                    //$("body").append("<iframe src='' id='iframe_updater' style='display: block'></iframe>");
                },
                success: function (response) {
                    //alert(response);
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        location.href = json.url;

                        //start updating editor
                        /*$("#iframe_updater").attr('src', "{{-- route('pages.update.template', [$page->id, 'flag=autoupdate']) --}}");

                        //after update
                        $("#iframe_updater").load(function () {

                            //$(button).html(tmp);
                            location.href = json.url;
                        });*/

                    } else {
                        alert(json.message);
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });


        //bump
        //$("#update_bump_product_settings").click(function (e) {
        $("#frm_bump_product_settings").submit(function (e) {

            e.preventDefault();

            const button = $(this).find("#update_bump_product_settings");

            $.ajax({
                type: 'POST',
                url: "{{ route('product.store', [$funnel->id, $currentStep->id]) }}",
                data: $(this).serialize(),
                beforeSend: function () {

                    tmp = $(button).html();
                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i><span class="sr-only">Loading...</span>');

                    $("#product_list").append("<iframe src='' id='iframe_updater' style='display: block'></iframe>");

                },
                success: function (response) {
                    //alert(response);
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        //start updating editor
                        $("#iframe_updater").attr('src', "{{ route('pages.update.template', [$page->id, 'flag=autoupdate']) }}");

                        //after update
                        $("#iframe_updater").load(function () {

                            $(button).html(tmp);
                            location.href = json.url;
                        });
                    } else {
                        alert(json.message);
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });

        function update_page_editor(url) {

            //update the page status to indicate page is about to upgrade
            $.ajax({
                type: 'POST',
                url: "{{ route('page.upgrade.status.update', $page->id) }}",
                data: "_token={{ csrf_token() }}&status=1",
                beforeSend: function () {
                    $("#btn_reload_editor").html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                },
                complete: function () {
                    //$("body #iframe_updater").remove();
                    $("body").append("<iframe src='' style='width: 100%; height: 500px;' id='iframe_updater' style='display: none'></iframe>");
                    $("#iframe_updater").attr('src', "{{ route('pages.update.template', [$page->id, 'flag'=>'autoupdate']) }}");

                    change_page_status(url);
                }
            });
        }

        function change_page_status(re_url) {

            setTimeout(function () {
                location.href = re_url;
            }, 5000);

            /*$.ajax({
                type: 'GET',
                url: "{{-- route('page.upgrade.status.check', $page->id) --}}",
                data: "_token={{ csrf_token() }}",
                beforeSend: function () {

                },
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);
                    var init_function;

                    if (json.page_status == 2) {
                        $("#iframe_updater").remove();
                        location.href = re_url;
                    } else {
                        //change_page_status(re_url);
                    }
                },
                error: function (a, b) {
                    document.write(a.responseText);
                }
            });*/
        }


        //shopify
        var tmp_shopify_choose_product = null;
        $(document).on('click', '.shopify-choose-product', function (e) {

            e.preventDefault();

            //alert(this);

            var button = $(this);
            product_id = $(this).attr('data-product-id');


            if (tmp_shopify_choose_product != null) {
                if ($("#shopify_product_add_step").length > 0) {
                    $("#shopify_product_add_step").remove();
                }

                $(tmp_shopify_choose_product).removeClass('btn-success').addClass('btn-primary');

                //$("#bump_product_option #chk_bump_product").prop('checked', '');
            }

            $(this).parent().append('<input type="hidden" id="shopify_product_add_step" name="product_id" value="' + $(this).attr('data-product-id') + '" />');
            $(this).removeClass('btn-primary').addClass('btn-success');


            //show bump option
            //$("#bump_product_option").show();

            tmp_shopify_choose_product = $(this);
        });


        $(document).on("click", "#button_product_shopify", function (e) {

            //$("#shopifyModal .modal-body").append(""); //ajax-loader.gif

            //alert(this);

            $.ajax({
                type: 'GET',
                url: "{{ route('shopify.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}",
                beforeSend: function () {
                    $("#shopify_product_list").html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;vertical-align: middle"></i>&nbsp;loading products...');
                },
                success: function (response) {
                    console.log(response);

                    $("#shopify_product_list").html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });
    </script>

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

        $('.summernote').summernote();


        function popupalteList(element) {

            var option = element.id;

            //alert($('option:selected', $(element)).attr('data-integration-type')  );
            //alert(element.options[element.selectedIndex].data-integration-type);
            //alert(option);

            var integration_type = $('option:selected', $(element)).attr('data-integration-type');
            var integration_id = $('option:selected', $(element)).attr('data-integration-id');
            var list_lead = $(element).parent().next().find('select');

            $(list_lead).html("");

            //alert(integration_type + ',' + integration_id  );

            $.ajax({
                type: 'POST',
                url: "{{ route('integration.fetch.list') }}",
                data: "id=" + integration_id + "&_token=" + $("#csrf_token").val() + "&type=" + integration_type,
                beforeSend: function () {
                    $(list_lead).prev().append('&nbsp; <i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);

                    //alert(list_id);
                    $(list_lead).prev().find('i').remove(); //('List To Add Lead:');

                    var json = JSON.parse(response);

                    $(list_lead).append("<option value=''></option>");
                    var count = 0;
                    $.each(json.lists, function (k, v) {
                        //alert(list_id[count]);
                        if (list_id.length > 1) {
                            if (v.id == list_id[count]) {
                                $(list_lead).append("<option value='" + v.id + "' selected>" + v.name + "</option>");
                            } else {
                                $(list_lead).append("<option value='" + v.id + "'>" + v.name + "</option>");
                            }
                        } else {
                            $(list_lead).append("<option value='" + v.id + "'>" + v.name + "</option>");
                        }

                        count++;
                    });
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        }


        //shipping
        $(document).on('click', '.new-shipping-row', function (e) {

            e.preventDefault();

            var row = $(this).parent().parent();

            //$('#shipping_panel_body > .row:last').clone().appendTo('#shipping_panel_body');

            $('#shipping_panel_body > .row:last').clone()
                .find("input:text").val("").end()
                .appendTo('#shipping_panel_body');

            var last_row = $('#shipping_panel_body > .row:last');
            var index_number = $('#shipping_panel_body > .row').length - 1;

            $(last_row).find(":input[type='text']:first").attr('name', 'shipping[' + index_number + '][title]');
            $(last_row).find(":input[type='text']:last").attr('name', 'shipping[' + index_number + '][amount]');

            $(row).find(".new-shipping-row").replaceWith('<button type="button" class="btn btn-danger remove-shipping-row" style="margin-top: 24px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>');

        });


        $(document).on('click', '.remove-shipping-row', function (e) {

            e.preventDefault();

            $(this).parent().parent().remove();
        });


        /*$(document).ready(function() {

            $("#integration_method").change(function (e) {

                var integration_type = $('option:selected', this).attr('data-integration-type');
                var integration_id = $('option:selected', this).attr('data-integration-id');
                var list_lead = $("#list_lead");

                $(list_lead).html("");

                alert(integration_type + ',' + integration_id  );

                $.ajax({
                    type: 'POST',
                    url: "{{-- route('integration.fetch.list') --}}",
                    data: "id=" + integration_id + "&_token=" + $("#csrf_token").val() + "&type=" + integration_type,
                    beforeSend: function () {
                        $(list_lead).prev().append('&nbsp; <i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        //alert($(list_lead).prev().html());
                        $(list_lead).prev().find('i').remove(); //('List To Add Lead:');

                        var json = JSON.parse(response);

                        $(list_lead).append("<option value=''></option>");
                        $.each(json.lists, function (k, v) {
                            if (list_id.length > 1) {
                                if (v.id == list_id) {
                                    $(list_lead).append("<option value='" + v.id + "' selected>" + v.name + "</option>");
                                } else {
                                    $(list_lead).append("<option value='" + v.id + "'>" + v.name + "</option>");
                                }
                            } else {
                                $(list_lead).append("<option value='" + v.id + "'>" + v.name + "</option>");
                            }
                        });
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        });*/


        $(".data-product-edit").click(function (e) {

            e.preventDefault();

            var button = $(this);
            var modal_id = $(this).attr('data-target').split('#');
            var step_product_type = $(this).attr('data-step-product-type');

            //alert(modal_id[0]);

            $.ajax({
                type: 'GET',
                url: "{{ route('manual.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}&step_product_type=" + step_product_type + '&step_product_id=' + $(this).attr('data-step-product-id'),
                success: function (response) {
                    console.log(response);
                    $("#manual_product_list" + $(button).attr('data-product-id')).html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });

        });


        $(".data-shopify-product-edit").click(function (e) {

            e.preventDefault();

            var button = $(this);
            var modal_id = $(this).attr('data-target').split('#');
            var step_product_type = $(this).attr('data-step-product-type');

            //alert(modal_id[0]);

            $.ajax({
                type: 'GET',
                url: "{{ route('shopify.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}",
                success: function (response) {
                    console.log(response);

                    $("#shopify_product_list" + $(button).attr('data-product-id')).html(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });

        });


        $("#manual_search_product").keyup(function (e) {

            var element = $(this);

            if (e.keyCode != 9) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_token').val()
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.products.search', $funnel->id) }}",
                    data: "keyword=" + $(this).val() + '&step_id=' + "{{ $currentStep->id }}",
                    beforeSend: function () {
                        //$(list_lead).prev().append('&nbsp; <i class="fa fa-refresh fa-spin"></i>');
                        $(element).after().append('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);
                        //alert(response);

                        const json = JSON.parse(response);

                        if (json.status == 'success') {
                            $("#manual_product_list").html(json.html);
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }
        });


        @if ( count($stepProducts) > 0 )
            //remove step products
            $("#remove_step_products").click(function (e) {

            e.preventDefault();

            if ( confirm("Are you sure to remove all the products from this funnel step?") ) {
                var element = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_token').val()
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnel.products.search', $funnel->id) }}",
                    //url: "{{-- route('funnel.step.products.remove', $currentStep->id) --}}",
                    data: "keyword=" + $(this).val() + '&step_id=' + "{{ $currentStep->id }}&action=step_product_remove",
                    beforeSend: function () {
                        $(element).attr('disabled', 'disabled');
                        $(element).html('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);
                        //alert(response);

                        const json = JSON.parse(response);

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
            }
        });
        @endif

        //edit
        /*$(".data-product-edit").click(function (e) {

            const product_id = $(this).attr('data-product-id');
            const funnel_id = $(this).attr('data-product-funnel-id');
            const step_id = $(this).attr('data-product-step-id');

            $.ajax({
                type: 'POST',
                url: "{{-- route('step.product.details') --}}",
                data: "product_id=" + product_id + '&funnel_id=' + funnel_id + '&step_id=' + step_id + "&_token=" + $("#csrf_token").val() + "&type={{ $funnel->type }}",
                beforeSend: function () {
                    //$(list_lead).prev().append('&nbsp; <i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);

                    const json = JSON.parse(response);

                    if (json.status == 'success') {
                        $("#frm_product_update").html(json.html);
                    }
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });*/
    </script>
@endsection
