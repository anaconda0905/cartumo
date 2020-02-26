<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="width: 10%"></th>
        <th>Product</th>
        <th>Price</th>
        <th style="width: 5%">Action</th>
    </tr>
    </thead>

    <tbody>
    @if ( !empty($data['products']) && $data['products']->count() > 0 )
        @foreach ( $data['products'] as $product )
            @if ( (!empty($data['stepProduct'])) && (json_decode($data['stepProduct']->details)->product_id == $product->id) )

                <tr>
                    <td>
                        @if ( !empty(json_decode($product->images)->main) )
                            <img src="{{ asset('asset/Timthumb.php?src=') . json_decode($product->images)->main . '&w=640&h=480' }}"
                                 style="width: 72px;"/>
                        @else
                            <img src="{{ asset('images/no-images.png') }}" style="width: 72px;"/>
                        @endif
                    </td>
                    <td>
                        <h5><strong>{{ $product->name }}</strong></h5>
                    </td>
                    <td>
                        <h5><strong>${{ $product->price }}</strong></h5>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success manual-choose-product" title="Choose product"
                                data-product-id="{{ $product->id }}"
                                data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                        <input type="hidden" id="manual_product_add_step" name="product_id" value="{{ $product->id }}">
                        <script>var product_id = "{{ $product->id }}";</script>
                    </td>
                </tr>
            @else
                <tr>
                @if ( !empty(json_decode($product->images)->main) )
                    <!--<td><img src="{{-- json_decode($product->images)->main --}}" style="width: 72px;"/></td>-->
                        <td>
                            <img src="{{ asset('asset/Timthumb.php?src=') . json_decode($product->images)->main . '&w=640&h=480' }}"
                                 style="width: 72px;"/></td>
                    @else
                        <td><img src="{{ asset('images/no-images.png') }}" style="width: 72px;"/></td>
                    @endif
                    <td>
                        <h5><strong>{{ $product->name }}</strong></h5>
                    </td>
                    <td>
                        <h5><strong>${{ $product->price }}</strong></h5>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary manual-choose-product" title="Choose product"
                                data-product-id="{{ $product->id }}"
                                data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endif
        @endforeach
    @else
        <tr>
            <td colspan="4">No products</td>
        </tr>
    @endif
    </tbody>
</table>
