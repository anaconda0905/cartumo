@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element ui-draggable price-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-price">
            <div class="element-product-price lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-price-switch">
                    <strong data-element-type="product-price" style="font-size:20px; color:#000">${{ $data['product']->price }}</strong>
                    <input type="hidden" name="pprice" value="{{ $data['product']->price }}"/>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-price-setings-modal" data-toggle="modal"
                        data-target="#productPriceSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element ui-draggable price-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-price">
            <div class="element-product-price lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-price-switch">
                    <strong data-element-type="product-price" style="font-size:20px; color:#000">${{ $data['product']->product->variants[0]->price }}</strong>
                    <input type="hidden" name="pprice" value="{{ $data['product']->product->variants[0]->price }}"/>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-price-setings-modal" data-toggle="modal"
                        data-target="#productPriceSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element ui-draggable price-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="product-price">
        <div class="element-product-price lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper ld_editable product-item product-price-switch">
                <strong data-element-type="product-price" style="font-size:20px; color:#000">$0.00</strong>
                <input type="hidden" name="pprice" value="0.00"/>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-product-price-setings-modal" data-toggle="modal"
                    data-target="#productPriceSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif