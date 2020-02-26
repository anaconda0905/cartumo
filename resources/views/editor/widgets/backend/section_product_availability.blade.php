@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element ui-draggable product-availability-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-availability">
            <div class="element-headline lh4 size1 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-availability-switch">
                    @if ( $data['product']->quantity > 0 )
                        <b data-element-type="product-availability" class="product-availabel">Product available</b>
                    @else
                        <b data-element-type="product-not-availabel" class="product-availabel">Product not available</b>
                    @endif
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-available-modal" data-toggle="modal"
                        data-target="#productAvailableSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i>
                    </li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element ui-draggable product-availability-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-availability">
            <div class="element-headline lh4 size1 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-availability-switch">
                    @if ( $data['product']->product->variants[0]->inventory_quantity > 0 )
                        <b data-element-type="product-availability" class="product-availabel">Product available</b>
                    @else
                        <b data-element-type="product-not-availabel" class="product-availabel">Product not available</b>
                    @endif
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-product-available-modal" data-toggle="modal"
                        data-target="#productAvailableSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i>
                    </li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element ui-draggable product-availability-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="product-availability">
        <div class="element-headline lh4 size1 ld-margin0 element-text-shadow">
            <div class="wrapper ld_editable product-item product-availability-switch">
                <b data-element-type="product-title" class="product-availabel">Product available</b>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-product-available-modal" data-toggle="modal"
                    data-target="#productAvailableSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i>
                </li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif