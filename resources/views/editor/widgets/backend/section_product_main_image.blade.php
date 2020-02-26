@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <?php $images = json_decode($data['product']->images); ?>
        <div class="ld-element product-image-wrapper de-image-block elAlign_center ld-margin0 inline-element"
             id="{{ $id }}"
             data-de-type="product-image">
            <div class="image-wrapper wrapper product-item product-image-switch">
                <div class="image" data-element-type="product-image">
                    @if ( !empty($images->main) )
                        <img src="{{ $images->main }}" style="width: 100%;"
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
                    @else
                        <img src="http://via.placeholder.com/640x480"
                             class="ld-img open-single-image-setings-modal" alt="" data-toggle="modal"
                             data-target="#singleImgaeSettingsModal">

                        <div class="additionals">
                            <ul>
                                <li><img src="http://via.placeholder.com/72x72"/></li>
                                <li><img src="http://via.placeholder.com/72x72"/></li>
                                <li><img src="http://via.placeholder.com/72x72"/></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-single-image-setings-modal" data-element-type="headline"
                        data-toggle="modal" data-target="#singleImgaeSettingsModal"><i class="fa fa-cog"
                                                                                       aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element product-image-wrapper de-image-block elAlign_center ld-margin0 inline-element"
             id="{{ $id }}"
             data-de-type="product-image">
            <div class="image-wrapper wrapper product-item product-image-switch">
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
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-single-image-setings-modal" data-element-type="headline"
                        data-toggle="modal" data-target="#singleImgaeSettingsModal"><i class="fa fa-cog"
                                                                                       aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element product-image-wrapper de-image-block elAlign_center ld-margin0 inline-element"
         id="{{ $id }}"
         data-de-type="product-image">
        <div class="image-wrapper wrapper product-item product-image-switch">
            <div class="image" data-element-type="product-image">
                <img src="http://via.placeholder.com/640x480"
                     class="ld-img open-single-image-setings-modal" alt="" data-toggle="modal"
                     data-target="#singleImgaeSettingsModal">

                <div class="additionals">
                    <ul>
                        <li><img src="http://via.placeholder.com/72x72"/></li>
                        <li><img src="http://via.placeholder.com/72x72"/></li>
                        <li><img src="http://via.placeholder.com/72x72"/></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-single-image-setings-modal" data-element-type="headline"
                    data-toggle="modal" data-target="#singleImgaeSettingsModal"><i class="fa fa-cog"
                                                                                   aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif