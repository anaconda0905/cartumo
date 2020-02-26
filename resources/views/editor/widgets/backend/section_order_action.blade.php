
    <div class="ld-element ui-draggable headline-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="order-info">
        <div class="element-headline lh4 size3 ld-margin0 element-text-shadow padd-15">
            <div class="wrapper ld_editable">
                <a href="#" class="btn btn-primary" data-text-color="#ffffff" data-bg-color="">Continue Shopping</a>

                <button class="btn btn-primary-transparent"><i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print
                    Receipt
                </button>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-order-action-settings-modal" data-toggle="modal"
                    data-target="#orderActionSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-order"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>