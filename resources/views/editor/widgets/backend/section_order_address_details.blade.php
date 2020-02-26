
    <div class="ld-element ui-draggable headline-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="order-info">
        <div class="element-headline lh4 size3 ld-margin0 element-text-shadow padd-15">
            <div class="wrapper ld_editable">
                <div class="clearfix">
                    <div class="col-md-6">
                        <h4>SHIPPING ADDRESS</h4>
                        <p id="order_shipping_address"></p>
                    </div>
                    <div class="col-md-6">
                        <h4>BILLING ADDRESS</h4>
                        <p id="order_billing_address"></p>
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
                <li class="ld_controls_edit open-order-address_details-settings-modal" data-toggle="modal"
                    data-target="#orderAddressDetailsSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>