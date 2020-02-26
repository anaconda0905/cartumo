{{-- $stepProducts --}}
@foreach ($stepProducts as $key => $stepProduct)
    <tr>
        <td><input type="radio" name="product" value="{{ $stepProduct->product->id }}" {{ ($key == 0) ? 'checked' : '' }} /> {{ $stepProduct->product->name }}</td>
        <td>${{ $stepProduct->product->price }}</td>
        <input type="hidden" name="step_product_id" value="{{ $stepProduct->id }}" />
    </tr>
@endforeach
