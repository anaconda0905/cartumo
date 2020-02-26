
    <div class="ld-element ld-element-form stepd-shipping-form-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="stepd-shipping-form">
        <div class="element-stepd-shipping-form lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <div class="step-parts step-section">
                    <div class="step-caption">
                        <span><strong data-step-enabled="true">Step #3</strong></span> <span>Billing Information</span>
                    </div>

                    <div class="form-address-selection-panel">

                        <!--<div class="panels">
                            <div class="form-group">
                                <input type="radio" id="selection_same" name="selection" class="panel-selection-radio"
                                    value="same" checked required />
                                <label for="selection_same">Same as shipping address</label>
                            </div>
                        </div>-->

                        <div class="panels">
                            <!--<div class="form-group">
                                <input type="radio" id="selection_different" name="selection" class="panel-selection-radio"
                                    value="diff" checked required />
                                <label for="selection_different">Use a different billing address</label>
                            </div>-->

                            <div class="body">
                                <div class="billing-form">
                                    <div class="form-group">
                                        <div class="row clearfix">
                                            <div class="col-md-6">
                                                <!--<label for="">First Name</label>-->
                                                <input type="text" name="billing_first_name" class="form-control"
                                                    placeholder="First name"/>
                                            </div>

                                            <div class="col-md-6">
                                                <!--<label for="">Last Name</label>-->
                                                <input type="text" name="billing_last_name" class="form-control"
                                                    placeholder="Last name"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row clearfix">
                                            <div class="col-md-8">
                                                <!--<label for="">Address</label>-->
                                                <input type="text" name="billing_full_address" class="form-control"
                                                    placeholder="Address"/>
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" name="billing_apt" class="form-control"
                                                    placeholder="Apt, suit, etc."/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="clearfix">
                                            <input type="text" name="billing_city" class="form-control" placeholder="City"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row clearfix">
                                            <div class="col-md-5">
                                                <select name="billing_country" class="form-control">
                                                    <option>Country</option>
                                                    <option value="">Select Country</option>
                                                    <option value="">------------------------------</option>
                                                    <option value="United States">United States</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="India">India</option>
                                                </select>
                                            </div>

                                            <div class="col-md-5">
                                                <input type="text" name="billing_state" class="form-control"
                                                    placeholder="State"/>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="billing_zip" class="form-control"
                                                    placeholder="ZIP"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="clearfix">
                                            <input type="text" name="billing_phone" class="form-control"
                                                placeholder="Phone"/>
                                        </div>
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
                <li class="ld_controls_edit open-contact-form-setings-modal" data-toggle="modal"
                    data-target="#contactFormSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-forms"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>