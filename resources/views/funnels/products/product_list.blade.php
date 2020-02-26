@if ( $data['type'] == 'manual' )

    @foreach ( $data['products'] as $product )
        <option value="{{ $product->id }}" data-product-type="manual">{{ $product->name }}</option>
    @endforeach

@else
    @foreach ( $data['products'] as $product )
        <option value="{{ $product->id }}" data-product-type="shopify">{{ $product->title }}</option>
    @endforeach
@endif