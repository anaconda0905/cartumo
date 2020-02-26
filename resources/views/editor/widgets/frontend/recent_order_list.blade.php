@if ( !empty($products) )
    @foreach ($products as $key => $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>${{ $product->price }}</td>
        </tr>
    @endforeach
@endif
