
    <div class="ld-element image-list-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="image-list">
        <div class="element-image-list lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <ul class="image-list" data-icon-type="">
                    <li data-img-url="{{ asset('images/orange-1.jpg') }}" style="background-image:url({{ asset('images/orange-1.jpg') }});background-repeat: no-repeat;background-position: 0px 0px;background-size:auto;padding-left: 72px;text-align:left;line-height: 26px;font-size: 16px;font-weight:200">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                </ul>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-image-list-setings-modal" data-toggle="modal"
                    data-target="#imageListSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>