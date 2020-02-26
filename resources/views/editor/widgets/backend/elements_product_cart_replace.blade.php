@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
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
    @else
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
                        <strong id="cart_product_subtotal">${{ $data['product']->product->variants[0]->price }}</strong>
                    </li>
                </ul>
            </div>

            <div class="rows">
                <ul>
                    <li>
                        <span>Subtotal</span>
                        <strong id="cart_product_subtotal">${{ $data['product']->product->variants[0]->price }}</strong>
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
                                id="cart_product_total">${{ $data['product']->product->variants[0]->price }}</strong>
                        <input type="hidden" name="product_price" value=""/>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@else
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
@endif