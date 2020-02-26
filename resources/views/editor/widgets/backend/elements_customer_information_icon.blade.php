
    <div class="ld-element ui-draggable customer-information-wrapper inline-element" id="{{ $id }}"
         data-de-type="headline">
        <div class="element-customer-information lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <div class="section-title">Customer information</div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" data-parsley-required />
                </div>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-customer-info-setings-modal" data-toggle="modal"
                    data-target="#customerInfoSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-forms"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>
