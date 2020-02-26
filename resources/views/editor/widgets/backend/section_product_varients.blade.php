@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element ui-draggable product-varients-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-varients">
            <div class="element-product-varients lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper product-item product-varients-switch">
                    @if ( !empty(json_decode($data['product']->options)) )
						<?php $variant_options = json_decode( $data['product']->options->first()->options ); ?>
						<?php $options = $variant_options->options->option_name; ?>
                        @foreach ( $options as $key=>$option )
                            <ul class="option-item clearfix">
                                <li class="text-left"><label for="">{{ $option }}:</label></li>
                                <li class="text-left">
                                    <select name="product_options[{{ strtolower($option) }}]" class="form-control">
										<?php $variants = explode( ',', $variant_options->options->option_value[ $key ] ); ?>
                                        @foreach ($variants as $k => $variant)
                                            <?php
												$str = preg_replace("[^a-z0-9\040]","",str_replace("_"," ",$variant));
												$str = preg_replace("[\040]","_",trim($variant)); ?>
                                            <option value="{{ strtolower($str) }}">{{ $variant }}</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                        @endforeach
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
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element ui-draggable product-varients-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-varients">
            <div class="element-product-varients lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper product-item product-varients-switch">
                    @if ( !empty($data['product']->product->options) )
                        @foreach ( $data['product']->product->options as $key=>$option )
                            <ul class="option-item clearfix">
                                <li class="text-left"><label for="">{{ $option->name }}:</label></li>
                                <li class="text-left">
                                    <select name="product_options[{{ strtolower($option->name) }}]"
                                            class="form-control">
                                        @foreach ($option->values as $k => $variant)
                                            <option value="{{ $variant }}">{{ $variant }}</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                        @endforeach

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
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element ui-draggable product-varients-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="product-varients">
        <div class="element-product-varients lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper product-item product-varients-switch">
                <select data-element-type="product-varients" class="form-control" id="product_options_{{ $id }}"
                        name="product_varients">
                    <option value="">Choose varients</option>
                </select>
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
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif