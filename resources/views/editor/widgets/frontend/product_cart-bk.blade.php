<div class="summary">
    <div class="product-description clearfix rows">
        <ul>
            <li class="image">
                <?php $images = json_decode($data['product']->images) ?>
                <img src="{{ $images->main }}"/>
                    <span class="cart_badge_counter">{{ $data['product_quantity'] }}</span>
            </li>

            <li class="description">
                <span>{{ $data['product']->name }}</span>
                <div class="product-varients" id="cart_product_varients">{{ $data['product_options'] }}</div>
            </li>

            <li class="price">
                ${{ $data['product_price']  }}
            </li>
        </ul>
    </div>

    <div class="rows">
        <ul>
            <li>
                <span>Subtotal</span>
                <strong>${{ $data['product_price'] }}</strong>
            </li>
            <li>
                <span>Shipping</span>
                <strong>Free</strong>
            </li>
        </ul>
    </div>

    <div class="rows">
        <ul>
            <li>
                <span>Total: </span>
                <strong class="price">${{ $data['product_price'] }}</strong>
                <input type="hidden" name="product_price" value="{{ $data['product_price'] }}" />
            </li>
        </ul>
    </div>
</div>