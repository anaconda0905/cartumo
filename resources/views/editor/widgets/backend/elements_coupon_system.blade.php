
    <div class="ld-element ld-element-form coupon-system-wrapper inline-element" id="{{ $id }}"
         data-de-type="coupon-system-form">
        <div class="element-coupon-system-form lh4 ld-margin0 element-text-shadow">
            <div class="wrapper" style="margin-bottom: 15px; margin-top: 15px">

                <div class="coupon-system-form-panel">
                    <div class="section-title" style="text-align: left">
                        <strong>Discount</strong>
                    </div>

                    <div class="panels">
                        <div class="body">
                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-9">
                                        <input type="text" name="product_discount" class="form-control" placeholder="Enter the coupon code" />
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-block button-apply-coupon">Apply</button>
                                    </div>
                                </div>
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
                <li class="ld_controls_edit open-coupon-system-setings-modal" data-toggle="modal"
                    data-target="#couponSystemSettingsModal">
                    <i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-forms"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>
