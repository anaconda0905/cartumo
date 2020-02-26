
    <div class="ld-element image-inside-tab-wrapper de-image-inside-tab-block elAlign_center ld-margin0 inline-element" id="{{ $id }}"
         data-de-type="image-indise-tab">
        <div class="image-inside-tab-wrapper wrapper">
            <div class="tab-image" style="background:url({{ asset('frontend/builder/images/ipad_blank2.png') }}) 0px 0px no-repeat;background-position:center;padding-top:15px;padding-right:0px;padding-bottom:15px;padding-left:0px;" data-tab-src="{{ asset('frontend/builder/images/ipad_blank1.png') }}">
                <img src="{{ asset('frontend/builder/images/tabscreen.png') }}" style="width:75%;max-width:378px;" />
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-image-inside-tab-setings-modal" data-element-type="headline"
                    data-toggle="modal" data-target="#imgaeInsideTabModal"><i class="fa fa-cog"
                                                                                   aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-image"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>