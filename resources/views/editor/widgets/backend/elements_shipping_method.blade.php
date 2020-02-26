<div class="ld-element ld-element-form shipping-method-wrapper inline-element" id="{{ $id }}"
     data-de-type="shipping-method-form">
    <div class="element-shipping-method-form lh4 ld-margin0 element-text-shadow">
        <div class="wrapper" style="margin-bottom: 15px; margin-top: 15px">

            <div class="shipping-method-form-panel">
                <div class="section-title" style="text-align: left">
                    <strong>Shipping Methods</strong>
                </div>

                <div class="panels">
                    <div class="body order-item order-shipping-switch">
                        <div class="form-group">
                            <label for="">
                                <input type="radio" name="shipping_method" class="panel-selection-radio" value="0.00"
                                       checked required/>
                                <span>Standard Shipping Method</span> <span class="amount">$0.00</span>
                            </label>
                        </div>
                    </div>
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
            <li class="ld_controls_edit open-shipping-method-setings-modal" data-toggle="modal"
                data-target="#shippingMethodSettingsModal">
                <i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>

    <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-forms"
            alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
</div>