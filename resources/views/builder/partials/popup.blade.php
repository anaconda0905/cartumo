<!-- MODAL POPUP -->
<div class="popup" data-popup="popup-1" id="data_page_popup"
     style="background-color:rgba(0,0,0,0.75)">
    <div class="popup-inner" data-modal-width="medium"
         style="background-color:#FFFFFF;color:#000000;padding-top:40px;padding-right:0px;padding-bottom:40px;padding-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;">
        <div class="body">
            <div class="section-groups" id="main-html-container">
                <section
                        class="section element element-section element-section-full ld-element element-type-row clearfix"
                        data-de-type="row" data-row-type="big"
                        id="{{ time() . 'popup_section_group' }}"
                        style="background-color:transparent">
                    <div class="row-groups clearfix">
                        <button class='add-inner-element btn btn-primary add-element add-grid-in-row'
                                data-section-id='grid' id='grid_modal' alt='Add elements'
                                data-toggle='modal' data-target='#gridModal'>ADD ROW
                        </button>
                    </div>
                    <button type="button"
                            class="btn btn-transparent add-element add-row add-row-medium content-add-element"
                            data-section-id="row" id="row_modal" alt="Add Column"
                            data-toggle="modal" data-target="#rowModal">
                        <i class="fa fa-plus"></i>
                    </button>

                    <!-- controls -->
                    <div class="ld_controls row_ld_controls">
                        <ul class="ld_option_menu">
                            <li class="ld_controls_move"><i class="fa fa-arrows"
                                                            aria-hidden="true"></i></li>
                            <li class="ld_controls_clone"><i class="fa fa-files-o"
                                                             aria-hidden="true"></i></li>
                            <li class="ld_controls_edit open-row-setings-modal" data-toggle="modal"
                                data-target="#rowSettingsModal"><i class="fa fa-cog"
                                                                   aria-hidden="true"></i></li>
                            <li class="ld_controls_close"><i class="fa fa-times"
                                                             aria-hidden="true"></i></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>

        <a class="popup-close" data-popup-close="popup-1" href="javascript:void(0)">x</a>
    </div>
</div>