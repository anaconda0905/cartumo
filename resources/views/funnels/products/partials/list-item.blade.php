

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

                                                                    @if ( !empty($product->id) )
                                                                        <button class="btn btn-danger data-product-remove"
                                                                                data-step-product-id="{{ $stepProduct->id }}"
                                                                                data-product-id="{{ $product->id }}"
                                                                                data-product-funnel-id="{{ $funnel->id }}"
                                                                                data-product-step-id="{{ $currentStep->id }}"
                                                                                data-action-url="{{ route('product.destroy', array($stepProduct->funnel_id, $stepProduct->step_id, $stepProduct->getProduct()->product->id)) }}"><i
                                                                                    class="fa fa-fw fa-trash"
                                                                                    aria-hidden="true"></i></button>                                                                    
                                                                    @endif
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                