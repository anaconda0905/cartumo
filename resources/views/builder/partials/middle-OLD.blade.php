<div id="editor_panel">

    <!-- DEVICE VIEW -->
    <!-- mobile preview side bits -->
    <div class="mobileLeftArea mobilePreviewBackdrop" style="display: none;">
        <div class="mobileLeftSmallNotice">
            <h3>Mobile Preview</h3>
            <p>Here you can design a mobile experience. Hide and show <b>elements / rows / sections</b> for
                a better mobile experience...</p>
        </div>
    </div>

    <div class="mobileRightArea mobilePreviewBackdrop" style="display: none;"></div>
    <!-- END DEVICE VIEW -->

    <!-- ALL the content place -->
    <div id="htmleditor" class="ui-droppable">
        @if ( !empty($contents->htmlbody) )
            <?php echo $contents->htmlbody ?>
        @else
            <div id="cm-builder">
                <div class="cm-builder-inner">
                    <div class="cm-section-wrapper ui-sortable">

                    </div>
                </div>

                <div class="cm-add-new-section">
                    <div class="cm-add-new-section-inner">
                        <div class="cm-add-new-section">
                            <button type="button" class="btn btn-add-new-section add-new">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Section
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @include('builder.partials.modals')
    </div>


    <!--<form method="PUT" action="{{ route('pages.update', $page->id) }}" accept-charset="UTF-8"
          id="frm_htmleditor_save">
        <input type="hidden" name="name"
               value="{{ (!empty($page->funnelStep->display_name)) ? $page->funnelStep->display_name : '' }}"/>
        <textarea name="htmlbody"
                  style="display: none"><?php echo (!empty($contents->htmlbody)) ? $contents->htmlbody : '' ?></textarea>
        <textarea name="pagestyle" id="textarea_pagestyle"
                  style="display: none"><?php echo (!empty($contents->pagestyle)) ? $contents->pagestyle : '' ?></textarea>
        <textarea name="pagebackground" id="pagebackground"
                  style="display: none"><?php echo (!empty($contents->pagebackground)) ? $contents->pagebackground : '' ?></textarea>
        <textarea name="tracking_header" class="no-display"
                  value="{{ (!empty($contents->tracking_header)) ? $contents->tracking_header : ''  }}"></textarea>
        <textarea name="tracking_footer" class="no-display"
                  value="{{ (!empty($contents->tracking_footer)) ? $contents->tracking_footer : ''  }}"></textarea>

        <input type="hidden" name="external_fonts" id="external_fonts"
               value="{{ (!empty($contents->external_fonts)) ? $contents->external_fonts : ''  }}"/>


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
    </form>-->
</div>