@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <strong data-element-type="product-price" style="font-size:20px; color:#000">${{ $data['product']->price }}</strong>
        <input type="hidden" name="pprice" value="${{ $data['product']->price }}"/>
    @else
        <strong data-element-type="product-price" style="font-size:20px; color:#000">${{ $data['product']->product->variants[0]->price }}</strong>
        <input type="hidden" name="pprice" value="{{ $data['product']->product->variants[0]->price }}"/>
    @endif
@endif