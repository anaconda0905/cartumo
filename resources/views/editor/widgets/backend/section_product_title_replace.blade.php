@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <b data-element-type="product-title">{{ $data['product']->name }}</b>
    @else
        <b data-element-type="product-title">{{ $data['product']->product->title }}</b>
    @endif
@endif
