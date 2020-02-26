@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element ui-draggable product-quantity-wrapper ld-editable inline-element"
             id="{{ $id }}"
             data-de-type="product-quantity">
            <div class="element-product-quantity lh4 size15 element-text-shadow text-left">
                <div class="wrapper product-item product-quantity-switch">
                    <label for="product_options_{{ $id }}">Quantity:</label>
                    <select data-element-type="product-quantity" class="form-control" id="product_options_{{ $id }}"
                            name="product_quantity">
                        @foreach ( $data['product']->quantity as $item )
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-quantity-setings-modal" data-toggle="modal"
                        data-target="#productQuantitySettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element ui-draggable product-quantity-wrapper ld-editable inline-element"
             id="{{ $id }}"
             data-de-type="product-quantity">
            <div class="element-product-quantity lh4 size15 element-text-shadow text-left">
                <div class="wrapper product-item product-quantity-switch">
                    <label for="product_options_{{ $id }}">Quantity:</label>
                    <select data-element-type="product-quantity" class="form-control" id="product_options_{{ $id }}"
                            name="product_quantity">
                        @foreach ( $data['product']->product->variants[0]->inventory_quantity as $item )
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-quantity-setings-modal" data-toggle="modal"
                        data-target="#productQuantitySettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element ui-draggable product-quantity-wrapper ld-editable inline-element"
         id="{{ $id }}"
         data-de-type="product-quantity">
        <div class="element-product-quantity lh4 size15 element-text-shadow text-left">
            <div class="wrapper product-item product-quantity-switch">
                <label for="product_options_{{ $id }}">Quantity:</label>
                <select data-element-type="product-quantity" class="form-control" id="product_options_{{ $id }}"
                        name="product_quantity">
                    @foreach ( range(1, 10) as $item )
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-product-quantity-setings-modal" data-toggle="modal"
                    data-target="#productQuantitySettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif