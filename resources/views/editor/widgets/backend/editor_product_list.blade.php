<div class="element-holder ui-draggable">
    <div class="modal-product-list table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th class="text-right">Price</th>
                <th class="text-right"></th>
            </tr>
            </thead>

            <tbody>
            @if ( !empty($products) )
                @foreach ($products as $key => $product)
                    <?php $images = json_decode($product->images, $assoc_array = false) ?>
                    <tr>
                        <td>
                            <label for="product_id_{{ $product->id }}">
                                <ul>
                                    <li><img src="{{ $images->main }}" style="width: 48px; height: 48px"/></li>
                                    <li>
                                        <h4>{{ $product->name }}</h4>
                                        <span>{{ $product->sku }}</span>
                                    </li>
                                </ul>
                            </label>
                        </td>

                        <td class="text-right">${{ $product->price }}</td>

                        <td class="text-right">
                        <!--<button data-product-id="{{ $product->id }}" class="btn btn-warning modal-product-add-editor"> Add product </button>-->
                            <button data-product-id="{{ $product->id }}" class="btn btn-warning add-product-to-editor">
                                Add product
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">No products</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>