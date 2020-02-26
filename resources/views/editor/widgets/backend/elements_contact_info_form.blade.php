
    <div class="ld-element ld-element-form headline-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="contact-form">
        <div class="element-headline lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <div class="step-parts step-section">
                    <div class="step-caption">
                        <span><strong data-step-enabled="true">Step #1</strong></span> <span>Contact Information</span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name"
                               data-parsley-required="true"/>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"
                               data-parsley-required="true"/>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number"
                               data-parsley-required="true"/>
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
