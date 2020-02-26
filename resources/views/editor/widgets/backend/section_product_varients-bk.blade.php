<div class="ld-element ui-draggable product-varients-wrapper ld-editable inline-element" id="{{ $id }}"
     data-de-type="product-varients">
    <div class="element-product-varients lh4 size3 ld-margin0 element-text-shadow">
        <div class="wrapper">
        @if ( !empty($data['product']->options) )

            <?php
            $styles = array();
            $sizes = array();
            $colors = array();
            ?>

            <!-- style -->
                @foreach ($data['product']->options as $key => $option)
                    <?php $varients = json_decode($option->options); ?>
                    <?php $styles[] = $varients->style; ?>
                    <?php $sizes[] = $varients->size; ?>
                    <?php $colors[] = $varients->color; ?>
                @endforeach


                <ul class="option-item clearfix">
                    <li class="text-left"><label for="">Style:</label></li>
                    <li class="text-left">
                        <select name="product_options[style]" class="form-control">
                            <?php $styles = array_unique($styles); ?>
                            @foreach ($styles as $key => $style)
                                <option value="{{ $style }}">{{ $style }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>


                <ul class="option-item clearfix">
                    <li class="text-left"><label for="">Size:</label></li>
                    <li class="text-left">
                        <select name="product_options[style]" class="form-control">
                            <?php $sizes = array_unique($sizes); ?>
                            @foreach ($sizes as $key => $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>


                <ul class="option-item clearfix">
                    <li class="text-left"><label for="">Color:</label></li>
                    <li class="text-left">
                        <select name="product_options[style]" class="form-control">
                            <?php $colors = array_unique($colors); ?>
                            @foreach ($colors as $key => $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>

                <input type="hidden" name="hid_option_index" value=""/>
            @endif
        </div>
    </div>

    <!-- controls -->
    <div class="ld_inline_controls">
        <ul class="ld_option_menu">
            <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
            <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
            <li class="ld_controls_edit open-product-varient-setings-modal" data-toggle="modal"
                data-target="#productVarientSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>

    <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-product"
            alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
</div>
