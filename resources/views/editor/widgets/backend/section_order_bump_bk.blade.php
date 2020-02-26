@if ( !empty($data['product_id']) )
        <div class="ld-element ui-draggable order-bump-wrapper ld-editable inline-element" id="{{ $id }}"
            data-de-type="order-bump">
            <div class="element-bump-info lh4 size3 ld-margin0 element-text-shadow padd-15" style="border-color:#000000;background-color:#fcf8e3">
                <div class="wrapper ld_editable">
                    <div class="order-for-bump border-dashed-black">
                        <ul style="background-color:#ffff99">
                            <li><img src="{{ asset('images/arrow-flash-small.gif') }}" /></li>
                            <li><input type="checkbox" class="checkbox" name="bump[product_id]" value="{{ $data['product_id'] }}" id="bump_product_offer" data-product-type="{{ $data['product_type'] = $data['product_type'] }}" /></li>
                            <li style="font-size: 21px;color:#009900"><b>Yes, I will Take It!</b></li>
                        </ul>

                        <div class="bump-details">
                            <span style="font-size: 15px;">One time offer</span>:
                            <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-order-bump-settings-modal" data-toggle="modal"
                        data-target="#orderBumpSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
                    alt="Add elements"
                    data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
        </div>
@else
        <div class="ld-element ui-draggable order-bump-wrapper ld-editable inline-element" id="{{ $id }}"
            data-de-type="order-bump">
            <div class="element-bump-info lh4 size3 ld-margin0 element-text-shadow padd-15" style="border-color:#000000;background-color:#fcf8e3">
                <div class="wrapper ld_editable">
                    <div class="order-for-bump border-dashed-black">
                        <ul style="background-color:#ffff99">
                            <li><img src="{{ asset('images/arrow-flash-small.gif') }}" /></li>
                            <li><input type="checkbox" class="checkbox" name="bump[product_id]" value="" id="bump_product_offer" data-product-type="{{ $data['product_type'] = $data['product_type'] }}" /></li>
                            <li style="font-size: 21px;color:#009900"><b>Yes, I will Take It!</b></li>
                        </ul>

                        <div class="bump-details">
                            <span style="font-size: 15px;">One time offer</span>:
                            <span style="color:#2f2f2f;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, quod hic expedita consectetur vitae nulla sint adipisci cupiditate at. Commodi, dolore hic eaque tempora a repudiandae obcaecati deleniti mollitia possimus.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-order-bump-settings-modal" data-toggle="modal"
                        data-target="#orderBumpSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
                    alt="Add elements"
                    data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
        </div>
@endif
