@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element product-description-wrapper inline-element" id="{{ $id }}"
             data-de-type="product-description">
            <div class="element-headline lh5 size1 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-description-switch">
                    <div data-element-type="product-description"><?php echo $data['product']->description ?></div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit product-description-modal" data-toggle="modal"
                        data-target="#productDescriptionModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element product-description-wrapper inline-element" id="{{ $id }}"
             data-de-type="product-description">
            <div class="element-headline lh5 size1 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-description-switch">
                    <div data-element-type="product-description"><?php echo $data['product']->product->body_html ?></div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit product-description-modal" data-toggle="modal"
                        data-target="#productDescriptionModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element product-description-wrapper inline-element" id="{{ $id }}"
         data-de-type="product-description">
        <div class="element-headline lh5 size1 ld-margin0 element-text-shadow">
            <div class="wrapper ld_editable product-item product-description-switch">
                <div data-element-type="product-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolore, alias, numquam enim ab
                    voluptate id quam harum ducimus cupiditate similique quisquam et deserunt, recusandae.
                </div>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit product-description-modal" data-toggle="modal"
                    data-target="#productDescriptionModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif