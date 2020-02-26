<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="width: 10%"></th>
        <th>Product</th>
        <th style="width: 5%">Action</th>
    </tr>
    </thead>

    <tbody>
    @if ( !empty($data['products']->products) )
        @foreach ( $data['products']->products as $product )

            @if ( (!empty($data['stepProduct'])) && (json_decode($data['stepProduct']->details)->product_id == $product->id) )

                <tr>
                    <td><img src="{{ $product->image->src  }}" style="width: 72px;"/></td>
                    <td>
                        <h5><strong>{{ $product->title }}</strong></h5>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success shopify-choose-product" title="Choose product"
                                data-product-id="{{ $product->id }}"
                                data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                        <input type="hidden" id="shopify_product_add_step" name="product_id" value="{{ $product->id }}">
                        <script>var product_id = "{{ $product->id }}";</script>
                    </td>
                </tr>
            @else
                <tr>
                    <td><img src="{{ $product->image->src }}" style="width: 72px;"/></td>
                    <td>
                        <h5><strong>{{ $product->title }}</strong></h5>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary shopify-choose-product" title="Choose product"
                                data-product-id="{{ $product->id }}"
                                data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endif
        @endforeach
    @endif
    </tbody>
</table>
