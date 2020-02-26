@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="image" data-element-type="product-image">
	        <?php $images = json_decode($data['product']->images); ?>
            <img src="{{ $images->main }}"
                 class="ld-img open-single-image-setings-modal" alt="" data-toggle="modal"
                 data-target="#singleImgaeSettingsModal">

            <div class="additionals">
                <ul>
                    @if( !empty($images->additionals) )
                        @foreach ($images->additionals as $key => $image)
                            <li><img src="{{ $image }}"/></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    @else
        @if( !empty($data['product']->product->images) )
            <div class="image" data-element-type="product-image">
                <img src="{{ $data['product']->product->image->src }}"
                     class="ld-img open-single-image-setings-modal" alt="" data-toggle="modal"
                     data-target="#singleImgaeSettingsModal">

                <div class="additionals">
                    <ul>
                        @if( !empty($data['product']->product->images) )
                            @foreach ($data['product']->product->images as $key => $image)
                                <li data-image-id="{{ $image->id }}" data-product-type="shopify"
                                    data-product-id="{{ $data['product']->product->id }}"><img
                                            src="{{ $image->src }}"/></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        @endif
    @endif
@endif