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

				<?php $total += floatVal( $product['total'][1] ); ?>

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

					<?php $total += floatVal( $product['bump']['total'][1] ); ?>
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
            @if ( !empty($cart['shipping']) )
                @if ( floatVal(($cart['shipping']['amount'])) > 0 )
                    <li>
                        <span>Shipping</span>
                        @if ( !empty($cart['shipping']) )
							<?php $total = $total + floatVal( $cart['shipping']['amount'] ); ?>
                            <strong id="cart_product_shipping">${{ $cart['shipping']['amount'] }}</strong>
                        @else
                            <strong id="cart_product_shipping">Free</strong>
                        @endif
                    </li>
                @endif
                @if ( !empty($cart['discount']) )
                    <?php $percentage = ( floatVal( $cart['discount'] ) / 100 ) * $total;
		                $total = $total - $percentage; ?>
                    <li>
                        <span>Discount <strong>({{ $cart['discount'] }}%)</strong></span>
                        <strong id="cart_product_discount">-${{ number_format($percentage, 2) }}</strong>
                    </li>
                @endif
            @endif
        </ul>
    </div>

    <div class="rows">
        <ul>
            <li>
                <span>Total: </span>

                <strong class="price"
                        id="cart_product_total">${{ number_format($total, 2) }}</strong>
                <input type="hidden" name="product_price" value=""/>
            </li>
        </ul>
    </div>
</div>