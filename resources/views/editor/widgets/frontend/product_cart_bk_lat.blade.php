<div class="ld-element ui-draggable product-cart-wrapper inline-element"
     data-de-type="product-cart">
    <div class="element-product-cart lh4 size3 ld-margin0 element-text-shadow">
        <div class="wrapper">
            <div class="summary">
                <div class="product-description clearfix rows">
                <?php $total = 0.00; ?>
                    @if ( !empty($cart['products']) )
                        @foreach ( $cart['products'] as $product )
                            <ul>
                                <li class="image">
                                    <img src="{{ (!empty($product['variant']['image'])) ? $product['variant']['image'] : $product['image'] }}"/>
                                    <span class="cart_badge_counter">{{ $product['quantity'] }}</span>
                                </li>

                                <li class="description">
                                    <span>{{ $product['title'] }}</span>
                                    <div class="product-varients"
                                         id="cart_product_varients">{{ (!empty($product['variant']['title'])) ? $product['variant']['title'] : '' }}</div>
                                </li>

                                <li class="price" id="cart_product_price">
                                    {{ $product['total'][0] }}
                                </li>
                            </ul>

                            <?php $total += floatVal($product['total'][1]); ?>

                            @if ( !empty($product['bump']) )
                                <ul>
                                    <li class="image">
                                        <img src="{{ (!empty($product['bump']['variant']['image'])) ? $product['bump']['variant']['image'] : $product['bump']['image'] }}"/>
                                        <span class="cart_badge_counter">1</span>
                                    </li>

                                    <li class="description">
                                        <span>{{ $product['bump']['title'] }}</span>
                                        <div class="product-varients"
                                             id="cart_product_varients">{{ (!empty($product['bump']['variant']['title'])) ? $product['bump']['variant']['title'] : '' }}</div>
                                    </li>

                                    <li class="price" id="cart_product_price">
                                        {{ $product['bump']['total'][0] }}
                                    </li>
                                </ul>

                                <?php $total += floatVal($product['bump']['total'][1]); ?>
                            @endif
                        @endforeach
                    @else
                        <p>No product in the cart</p>
                    @endif
                </div>

                <div class="rows">
                    <ul>
                        <li>
                            <span>Subtotal</span>
                            <strong id="cart_product_subtotal">${{ $total }}</strong>
                        </li>
                        @if ( floatVal(($cart['shipping']['amount'])) > 0 )
                            <li>
                                <span>Shipping</span>
                                @if ( !empty($cart['shipping']) )                                      
                                    <?php $total = $total + floatVal($cart['shipping']['amount']); ?>                          
                                    <strong id="cart_product_shipping">${{ $cart['shipping']['amount'] }}</strong>
                                @else
                                    <strong id="cart_product_shipping">Free</strong>
                                @endif                            
                            </li>
                        @endif
                        @if ( !empty($cart['discount']) )
                        <?php $total = $total - floatVal($cart['discount']); ?>   
                        <li>                            
                            <span>Discount</span>
                            <strong id="cart_product_discount">-${{ $cart['discount'] }}</strong>
                        </li>
                        @endif
                    </ul>
                </div>

                <div class="rows">
                    <ul>
                        <li>
                            <span>Total: </span>
                            
                            <strong class="price"
                                    id="cart_product_total">${{ $total }}</strong>
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
</div>