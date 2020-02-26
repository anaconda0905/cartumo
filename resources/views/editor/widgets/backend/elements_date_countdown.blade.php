<div class="ld-element date-countdown-wrapper ld-editable inline-element" id="{{ $id }}" data-de-type="date-countdown">
    <div class="element-date-countdown lh4 size3 ld-margin0 element-text-shadow">
        <div class="wrapper">
            <div class="date-countdown">
                <ul data-end-date="{{ date('m/d/Y') }}" data-end-time="12:00">
                    <li class="days"><strong>00</strong>
                        <p>days</p></li>
                    <li class="dc-seperator"><span>:</span></li>
                    <li class="hours"><strong>00</strong>
                        <p>hours</p></li>
                    <li class="dc-seperator"><span>:</span></li>
                    <li class="minutes"><strong>00</strong>
                        <p>minutes</p></li>
                    <li class="dc-seperator"><span>:</span></li>
                    <li class="seconds"><strong>00</strong>
                        <p>seconds</p></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- controls -->
    <div class="ld_inline_controls">
        <ul class="ld_option_menu">
            <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
            <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
            <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
            <li class="ld_controls_edit open_date_countdown_settings" data-toggle="modal"
                data-target="#dateCountdownsSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>

    <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
            alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i></button>
</div>
