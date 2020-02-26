@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element ui-draggable product-cart-wrapper inline-element" id="{{ $id }}"
             data-de-type="product-cart">
            <div class="element-product-cart lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper">
                    <div class="summary">
                        <div class="product-description clearfix rows">
                            <ul>
                                <li class="image">
									<?php $images = json_decode( $data['product']->images ) ?>
                                    @if ( !empty($images->main) )
                                        <img src="{{ $images->main }}"/>
                                    @else
                                        <img src="{{ assets('images/no-images.png') }}"/>
                                    @endif
                                    <span class="cart_badge_counter">1</span>
                                </li>

                                <li class="description">
                                    <strong>{{ $data['product']->name }}</strong>
                                    <div class="product-varients" id="cart_product_varients"></div>
                                </li>

                                <li class="price" id="cart_product_price">
                                    ${{ $data['product']->price }}
                                </li>
                            </ul>
                        </div>

                        <div class="rows">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    <strong id="cart_product_subtotal">${{ $data['product']->price }}</strong>
                                </li>
                                <li>
                                    <span>Shipping</span>
                                    <strong id="cart_product_shipping">Free</strong>
                                </li>
                            </ul>
                        </div>

                        <div class="rows">
                            <ul>
                                <li>
                                    <span>Total: </span>
                                    <strong class="price"
                                            id="cart_product_total">${{ $data['product']->price }}</strong>
                                    <input type="hidden" name="product_price" value=""/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-headline-setings-modal" data-toggle="modal"
                        data-target="#headlineSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element ui-draggable product-cart-wrapper inline-element" id="{{ $id }}"
             data-de-type="product-cart">
            <div class="element-product-cart lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper">
                    <div class="summary">
                        <div class="product-description clearfix rows">
                            <ul>
                                <li class="image">
                                    <img src="{{ $data['product']->product->image->src }}"/>
                                    <span class="cart_badge_counter">1</span>
                                </li>

                                <li class="description">
                                    <span>{{ $data['product']->product->title }}</span>
                                    <div class="product-varients" id="cart_product_varients"></div>
                                </li>

                                <li class="price" id="cart_product_price">
                                    ${{-- $data['product']->price --}}
                                </li>
                            </ul>
                        </div>

                        <div class="rows">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    <strong id="cart_product_subtotal">${{-- $data['product']->price --}}</strong>
                                </li>
                                <li>
                                    <span>Shipping</span>
                                    <strong id="cart_product_shipping">Free</strong>
                                </li>
                            </ul>
                        </div>

                        <div class="rows">
                            <ul>
                                <li>
                                    <span>Total: </span>
                                    <strong class="price"
                                            id="cart_product_total">${{-- $data['product']->price --}}</strong>
                                    <input type="hidden" name="product_price" value=""/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-headline-setings-modal" data-toggle="modal"
                        data-target="#headlineSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element ui-draggable product-cart-wrapper inline-element" id="{{ $id }}"
         data-de-type="product-cart">
        <div class="element-product-cart lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <div class="summary">
                    <div class="product-description clearfix rows">
                        <ul>
                            <li class="image">
                                <img src="{{ asset('frontend/images/empty_product.png') }}"/>
                                <span class="cart_badge_counter">1</span>
                            </li>

                            <li class="description">
                                <span>Product</span>
                                <div class="product-varients" id="cart_product_varients">product variants</div>
                            </li>

                            <li class="price" id="cart_product_price">
                                $0.00
                            </li>
                        </ul>
                    </div>

                    <div class="rows">
                        <ul class="options">
                            <li>
                                <span>Subtotal</span>
                                <strong id="cart_product_subtotal">$0.00</strong>
                            </li>
                            <li>
                                <span>Shipping</span>
                                <strong id="cart_product_shipping">Free</strong>
                            </li>
                        </ul>
                    </div>

                    <div class="rows">
                        <ul class="totals">
                            <li>
                                <span>Total: </span>
                                <strong class="price"
                                        id="cart_product_total">$0.00</strong>
                                <input type="hidden" name="product_price" value=""/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-cart-setings-modal" data-toggle="modal"
                    data-target="#cartSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif