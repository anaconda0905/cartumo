@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        @if ( $data['product']->quantity > 0 )
            <b data-element-type="product-availability" class="product-availabel">Product available</b>
        @else
            <b data-element-type="product-not-availabel" class="product-availabel">Product not available</b>
        @endif
    @else
        @if ( $data['product']->product->variants[0]->inventory_quantity > 0 )
            <b data-element-type="product-availability" class="product-availabel">Product available</b>
        @else
            <b data-element-type="product-not-availabel" class="product-availabel">Product not available</b>
        @endif
    @endif
@endif