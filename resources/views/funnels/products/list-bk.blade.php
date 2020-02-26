@extends('layouts.app')

@section("title", "Steller Winds")

@section('content')

    <!-- page content -->
        <div class="right_col" role="main">
          <div class="funnel-page-inner-header">

              <div class="row header-funnel">
                  <div class="col-md-3">
                      <div class="title_left">
                          <h3>{{ $funnel->name }}</h3>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <span class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-link"></i>
                            </div>
                            <input class="funnelurl-input form-control" id="funnelURL" name="funnel[url]" readonly="true" value="{{ asset('funnel/' . $funnel->slug) }}">
                            <!--<div class="input-group-addon">
                            <a class="copyFunnelURL" data-clipboard-text="{{ asset('funnel/' . $funnel->slug) }}" data-toggle="tooltip" href="#" title="" data-original-title="Copy URL to Clipboard">
                            <i class="fa fa-copy"></i>
                            </a>
                            </div>-->
                            <div class="input-group-addon">
                            <a data-toggle="tooltip" href="{{ asset('funnel/' . $funnel->slug) }}" target="_blank" title="" data-original-title="Visit Funnel URL">
                            <i class="fa fa-external-link"></i>
                            </a>
                            </div>
                            <div class="input-group-addon">
                            <a class="" data-title="What is the Funnel URL?" data-toggle="tooltip" href="#" title="" data-original-title="What is the Funnel URL?">
                            <i class="fa fa-question-circle"></i>
                            </a>
                            </div>
                      </span>
                  </div>

                  <div class="col-md-3">
                      <ul class="funnel-inner-header-menu text-right">
                          <li><a href="#"><i class="fa fa-address-card" aria-hidden="true"></i> Contacts</a></li>
                          <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                      </ul>
                  </div>
            </div>

            <div class="clearfix"></div>

            <hr style="margin-top: 0px;" />

            <div class="row">

             <div class="col-md-3">
                 <div class="x_panel funnel-steps-block">
                     <h2><i class="fa fa-bars" aria-hidden="true"></i> Funnel Steps</h2>
                     <hr />

                     <ul class="steps">
                         @foreach ($steps as $key => $step)
                             @if ( $currentStep->id == $step->id )
                                 <li>
                                     <a href="{{ route('steps.show', array($funnel->id, $step->id)) }}" class="active">{{ $step->display_name }}</a>
                                 </li>
                             @else
                                 <li>
                                     <a href="{{ route('steps.show', array($funnel->id, $step->id)) }}">{{ $step->display_name }}</a>
                                 </li>
                             @endif

                         @endforeach

                         <li class="button-area">
                             <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addFunnelModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New Step</button>
                         </li>
                     </ul>
                 </div>
             </div>

              <div class="col-md-9 col-sm-12 col-xs-12 funnel-step-area">
                <div class="x_panel">
                    <div class="x_title">
                      <h2>{{ $currentStep->display_name }}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
                                   class="collapse-links"><i class="fa fa-pie-chart" aria-hidden="true"></i> &nbsp; Overview</a></li>

                            @if ( (strtolower($currentType->name) == 'sales') ||  (strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )
                                <li><a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"
                                       class="close-links active"><i class="fa fa-cubes" aria-hidden="true"></i>  &nbsp; Products</a>
                                </li>
                                @endif
                                        <!--<li><a class="close-link"><i class="fa fa-flash"></i> Publish</a></li>-->
                        </ul>



                      <div class="clearfix"></div>
                    </div>
                  <div class="x_content funnel-templates">
                      {{-- $steps[0]->templates --}}

                      <h2>Add a New Product to Funnel Step</h2>
                      <p>Looks like you haven't added any products for this funnel step yet. Begin by selecting 'Add a Product' below and set the price of your product inside of the settings popup. You can add as many products as you need for this funnel step.</p>
                      <br />
                      <div id="product_list">
                          @if ( !empty($product) )


                                  <div class="row products">
                                      <div class="col-md-7">
                                          <strong class="product-title"><i class="fa fa-cube" aria-hidden="true"></i> {{ $product->product->name }}</strong>
                                      </div>

                                      <div class="col-md-5">
                                          <div class="horizontal">
                                              <span class="procuct-item-member product-price">Price: ${{ $product->product->price }}</span>
                                              <span class="pull-right">
                                                  <button type="button" data-step-product-id="{{ $product->id }}" data-product-funnel-id="{{ $product->funnel_id }}" data-product-step-id="{{ $product->step_id }}" class="btn btn-warning product-edit" data-toggle="modal" data-target="#productEditModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                  <button class="btn btn-danger data-product-remove" data-product-id="{{ $product->id }}" data-product-funnel-id="{{ $product->funnel_id }}" data-product-step-id="{{ $product->step_id }}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i> Remove</button>
                                              </span>
                                          </div>
                                      </div>
                                  </div>

                          @endif
                      </div>

                      <br />
                      <span><button type="button" id="button_product_shopify" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#shopifyModal"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Add Shopify products</button></span>
                      <span><button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add manual products</button></span>

                        <!-- MANUAL Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <form id="frm_save_product" action="{{ route('product.store', array($funnel->id, $currentStep->id)) }}" method="post">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ADD NEW PRODUCT</h4>
                                  </div>
                                  <div class="modal-body">


                                          <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                                                  <li role="presentation" class="active">
                                                      <a href="#tab_general" role="tab" id="email-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">General</a>
                                                  </li>
                                                </ul>
                                                <div id="myTabContent2" class="tab-content">
                                                  <div role="tabpanel" class="tab-pane fade active in" id="tab_general" aria-labelledby="home-tab">
                                                      <div class="form-group">
                                                          <label for="billing_info">Choose product:</label>
                                                            <div class="dropdown full-dropdown">
                                                                <button class="btn dropdown-toggle col-md-12" type="button" data-toggle="dropdown">
                                                                    <span>Products</span>
                                                                    <span class="caret"></span>
                                                                </button>

                                                                <div class="clearfix"></div>

                                                                <ul class="dropdown-menu col-md-12">
                                                                    @foreach ( $manualproducts as $key => $product)
                                                                        <li>
                                                                            <a href="#" data-product-id="{{ $product->id }}">
                                                                                <?php $image = json_decode($product->images); ?>
                                                                                <span><img src="{{ $image->main }}" style="width: 42px; height: 42px;" /></span>
                                                                                <span class="title">{{ $product->name }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                                <input type="hidden" name="product_id" id="modal_hid_product_id" />
                                                            </div>

                                                      </div> <br />

                                                      <div class="form-group">
                                                        <label for="billing_info">Billing Integration:</label>
                                                        <select name="billing_info" id="billing_info" class="form-control" required>
                                                            <option>--SELECT--</option>
                                                            <option value="stripe">Stripe</option>
                                                        </select>
                                                      </div>
                                                  </div>
                                                  <!--<div role="tabpanel" class="tab-pane fade" id="tab_email" aria-labelledby="profile-tab">
                                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                                      booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                                                  </div>-->
                                                </div>
                                             </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success"> Save Product </button>
                                  </div>

                                  <input type="hidden" name="funnel_id" value="{{ $funnel->id }}" />
                                  <input type="hidden" name="step_id" value="{{ $currentStep->id }}" />
                                  <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                              </form>
                            </div>

                          </div>
                        </div>



                        <!-- SHOPIFY Modal -->
                        <div id="shopifyModal" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <form id="frm_save_product" action="{{ route('product.store', array($funnel->id, $currentStep->id)) }}" method="post">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Shopify products</h4>
                                  </div>
                                  <div class="modal-body">
                                      <img src='{{ asset('images/ajax-loader.gif') }}' style='margin:auto; text-align: center; display:block' />
                                  </div>

                                  <input type="hidden" name="funnel_id" value="{{ $funnel->id }}" />
                                  <input type="hidden" name="step_id" value="{{ $currentStep->id }}" />
                                  <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                              </form>
                            </div>

                          </div>
                        </div>


                        <!-- PRODUCT EDIT MODAL -->
                        <div id="productEditModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">EDITING PRODUCT</h4>
                                  </div>

                                  <div class="modal-body">


                                  </div>
                                </div>

                              </div>
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
                </div> <br />

                <div class="fom-group">
                    <label for="display_name">Display Name</label>
                    <input type="text" name="display_name" class="form-control" placeholder="Display page name" required />
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="create_funnel_steps">Create Funnel Step</button>
            </div>

            <input type="hidden" name="funnel_id" value="{{ $funnel->id }}" />
            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
        </form>
    </div>

  </div>
</div>

@endsection


@section('scripts')
    <script>
        $("#button_product_shopify").click(function(e) {

            //$("#shopifyModal .modal-body").append(""); //ajax-loader.gif

            $.ajax({
                type: 'GET',
                url: "{{ route('shopify.product.list', array($currentStep->id)) }}",
                data: "_token={{ csrf_token() }}",
                success: function(response) {
                    console.log(response);

                    $("#shopifyModal .modal-body").html(response);
                },
                error: function(a, b) {
                    console.log(a.responseText);
                }
            });
        });
    </script>
@endsection
