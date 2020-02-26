
    <div class="ld-element embed-video-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="embed-video">
        <div class="element-headline lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper">
                <div class="video-holder">
                    <!--<iframe src="//www.youtube.com/embed/tf88GFLtj18?autoplay=0" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen style="width: 100%; height: 360px"></iframe>-->

                    <img src="{{ asset('global/img/vid-place.jpg') }}" data-video-type="" data-video-url=""
                         data-video-autoplay="" data-video-controls="" data-video-branding="" data-video-width=""
                         data-video-height="" style="width: 100%" />

                </div>

            <!--<img src="{{ asset('global/img/video_place.png') }}" />-->
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-embed-video-setings-modal" data-toggle="modal"
                    data-target="#embedVideoSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-video"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
    </div>