@if ( $data['type'] == 'manual' )
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 10%"></th>
            <th>Product</th>
            <th style="width: 5%">Action</th>
        </tr>
        </thead>

        <tbody>
        @if ( !empty($data['products']) )
            @foreach ( $data['products'] as $product )
                <tr>
                    <td>
                        <?php $images = json_decode($product->images); ?>
                        <img src="{{ (!empty($images->main)) ? $images->main : asset('images/no-images.png') }}" style="width: 72px;"/>
                    </td>
                    <td>
                        <h5><strong>{{ $product->name }}</strong></h5>
                    <!--<div class="product-bump">
                            <input type="radio" name="bump_product_id" id="id_{{ $product->id }}" value="{{ $product->id }}" />
                            <label for="id_{{ $product->id }}">Should This Product Be The Bump On The Order Page?</label>
                        </div>-->
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary bump-choose-product" title="Choose product"
                                data-product-id="{{ $product->id }}"
                                data-product-type="manual"
                                data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@else
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th></th><th>Product</th> <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @if ( !empty($data['products']) )
            @foreach ( $data['products'] as $product )
                <tr>
                    <td><img src="{{ $product->image->src }}" style="width: 80px;" /></td>
                    <td><h5>{{ $product->title }}</h5></td>
                    <td>
                        <button type="button" class="btn btn-primary bump-choose-product" title="Choose product" data-product-type="shopify" data-product-id="{{ $product->id }}" data-action-url="{{ route('product.store',  array($data['funnel_id'], $data['step_id'])) }}">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endif
