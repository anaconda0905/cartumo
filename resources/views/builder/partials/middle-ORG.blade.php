<div id="editor_panel">

        <!-- DEVICE VIEW -->
        <!-- mobile preview side bits -->
        <div class="mobileLeftArea mobilePreviewBackdrop" style="display: none;">
            <div class="mobileLeftSmallNotice">
                <h3>Mobile Preview</h3>
                <p>Here you can design a mobile experience. Hide and show <b>elements / rows / sections</b> for
                    a better mobile experience...</p>
                <!-- <p> <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="tutorialvideo"><i class="fa fa-youtube-play"></i> Watch Tutorial</a></p> -->
            </div>
        </div>

        <div class="mobileRightArea mobilePreviewBackdrop" style="display: none;"></div>
        <!-- END DEVICE VIEW -->

        <!-- ALL the content place -->
        <div id="htmleditor" class="ui-droppable">
            <form id="frm_htmleditor_container" class="validate-form frm_htmleditor_container" action=""
                  method="post"
                  data-parsley-validate="">
                @if ( !empty($contents->htmlbody) )
                    <?php echo $contents->htmlbody ?>
                @else
                    <div class="editor-container element-type-main clearfix text-center">
                        <div class="section-groups" id="main-html-container">
                            <button style="margin-top: 30px; width: 70%"
                                    class='add-inner-element btn btn-primary add-element add-first-element-on-editor'
                                    data-section-id='row'
                                    id='row_modal' alt='Add elements' data-toggle='modal'
                                    data-target='#rowModal'>ADD SECTION
                            </button>
                        </div>
                    </div>
                @endif
            </form>


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
        </div>


    <!--{!! Form::model($page, array('route' => ['pages.update', $page->id], 'id'=>'frm_htmleditor_save')) !!}-->
        <form method="PUT" action="{{ route('pages.update', $page->id) }}" accept-charset="UTF-8"
              id="frm_htmleditor_save">
            <input type="hidden" name="name"
                   value="{{ (!empty($page->funnelStep->display_name)) ? $page->funnelStep->display_name : '' }}"/>
            <textarea name="htmlbody"
                      style="display: none"><?php echo ( ! empty( $contents->htmlbody ) ) ? $contents->htmlbody : '' ?></textarea>
            <textarea name="pagestyle" id="textarea_pagestyle"
                      style="display: none"><?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?></textarea>
            <textarea name="pagebackground" id="pagebackground"
                      style="display: none"><?php echo ( ! empty( $contents->pagebackground ) ) ? $contents->pagebackground : '' ?></textarea>
            <textarea name="tracking_header" class="no-display"
                      value="{{ (!empty($contents->tracking_header)) ? $contents->tracking_header : ''  }}"></textarea>
            <textarea name="tracking_footer" class="no-display"
                      value="{{ (!empty($contents->tracking_footer)) ? $contents->tracking_footer : ''  }}"></textarea>

            <input type="hidden" name="external_fonts" id="external_fonts"
                   value="{{ (!empty($contents->external_fonts)) ? $contents->external_fonts : ''  }}"/>
            <!--<input type="hidden" name="tracking_header" /><input type="hidden" name="tracking_footer" />-->


            @if ( !empty($contents->page_background_image) )
                <input type="hidden" name="page_background_image"
                       value="{{ $contents->page_background_image }}"/>
                <input type="hidden" name="page_background_image_position"
                       value="{{ $contents->page_background_image_position }}"/>
                <input type="hidden" name="page_background_color"
                       value="{{ $contents->page_background_color }}"/>
            @endif

            @if ( !empty($contents->seo_meta_data_title) )
                <input type="hidden" name="seo_meta_data_title" value="{{ $contents->seo_meta_data_title }}"/>
                <input type="hidden" name="seo_meta_data_description"
                       value="{{ $contents->seo_meta_data_description }}"/>
                <input type="hidden" name="seo_meta_data_keywords"
                       value="{{ $contents->seo_meta_data_keywords }}"/>
                <input type="hidden" name="seo_meta_data_author" value="{{ $contents->seo_meta_data_author }}"/>
            @endif
        </form>
    <!--{!! Form::close() !!}-->
    </div>