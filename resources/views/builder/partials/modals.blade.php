<!-- ===================================================== MODALS ========================================================== -->


<!-- HTML BLOCK SETTINGS MODAL -->
<div id="htmlBlockSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HTML Block Settings</h4>
            </div>

            <div class="modal-body" id="html_block_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="htmlBlockSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#html_block_general_tab_code" id="html-block-code-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">HTML Code</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#html_block_general_tab_settings" id="html-block-general-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">General</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#html_block_general_tab_advance" role="tab" id="html-block-advance-settings-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_html_block_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="html_block_general_tab_code"
                                 aria-labelledby="home-tab">

                                <div class="form-group row clearfix">
                                    <textarea class="form-control html" rows="10" id="html_block_custom_html" name="html_block_custom_html"
                                              style="min-height:300px;"
                                              placeholder="Add custom HTML here..."></textarea>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="html_block_general_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group row clearfix">
                                    <label class="control-label col-sm-3" for="html_block_bg_color">BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="html_block_bg_color"
                                               name="html_block_bg_color"
                                               placeholder="Enter background color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="html_block_general_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="html_block_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="html_block_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="html_block_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="html_block_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="html_block_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="html_block_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="html_block_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="html_block_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="html_block_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="html_block_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="html_block_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- ADVANCE SOCIAL SHARE SETTINGS MODAL -->
<div id="socialShareButtonsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Social Button Settings</h4>
            </div>

            <div class="modal-body" id="social_share_settings_body">
                <form id="frm_social_share_buttons" class="form-horizontal">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">Settings</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#tab_buttons" role="tab" id="buttons-tab" data-toggle="tab"
                                   aria-expanded="false">Buttons</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#tab_advance" role="tab" id="themes-tab" data-toggle="tab"
                                   aria-expanded="false">Advance</a>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="social_share_button_url">Share
                                        URL:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_share_button_url"
                                               name="social_share_button_url"
                                               placeholder="Enter social URL" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="social_share_title">Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_share_title"
                                               name="social_share_title" placeholder="Enter title" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_buttons" aria-labelledby="home-tab">
                                <div class="add-button-section text-right">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="social_share_buttons_width">Button
                                                        Width:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="social_share_buttons_width"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="social_share_buttons_line_height">Line
                                                        Height:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="social_share_buttons_line_height"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" id="add_social_button">Add
                                                Social Button
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="social-buttons-container" id="all_social_buttons">

                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_advance" aria-labelledby="home-tab">
                                <div class="clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="number" name="social_share_buttons_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="number" name="social_share_buttons_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="number" name="social_share_buttons_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="number" name="social_share_buttons_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="number" name="social_share_buttons_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="number" name="social_share_buttons_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_margin_left">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="number" name="social_share_buttons_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="payment_method_margin_right">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="number" name="social_share_buttons_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SHADOW -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="social_share_buttons_shadow_size">Shadow
                                                    Size:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="payment_method_shadow_size"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="social_share_buttons_save"> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- PAYMENT METHOD SETTINGS MODAL -->
<div id="paymentSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment Method Settings</h4>
            </div>

            <div class="modal-body" id="shipping_address_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="paymentMethodSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#payment_method_tab_settings" id="payment-method-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#payment_method_tab_advance" role="tab" id="payment-method-adnance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_payment_method_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="payment_method_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="customer_info_caption_text">Caption
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="payment_method_caption_text"
                                               name="payment_method_caption_text"
                                               placeholder="Enter Caption text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="customer_info_caption_text">Info
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="payment_method_info_text"
                                               name="payment_method_info_text"
                                               placeholder="Enter Info text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="payment_method_caption_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="payment_method_caption_text_color"
                                               name="payment_method_caption_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="payment_method_info_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="payment_method_info_text_color"
                                               name="payment_method_info_text_color" placeholder="Enter info text color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="payment_method_caption_text_font_size">Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="payment_method_caption_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="payment_method_info_text_font_size">Info Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="payment_method_info_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="payment_method_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="payment_method_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="payment_method_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="payment_method_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="payment_method_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="payment_method_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="payment_method_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="payment_method_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="payment_method_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="payment_method_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="payment_method_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="payment_method_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CUSTOMER INFORMATION SETTINGS MODAL -->
<div id="customerInfoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Customer Information Settings</h4>
            </div>

            <div class="modal-body" id="shipping_address_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="customerInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#customer_info_tab_settings" id="customer-info-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#customer_info_tab_advance" role="tab" id="customer-info-adnance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_customer_info_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="customer_info_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="customer_info_caption_text">Caption
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="customer_info_caption_text"
                                               name="customer_info_caption_text"
                                               placeholder="Enter Caption text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="customer_info_caption_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="customer_info_caption_text_color"
                                               name="customer_info_caption_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group row clearfix">
                                    <label class="control-label col-sm-3" for="customer_info_caption_text_bg_color">BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="customer_info_caption_text_bg_color"
                                               name="customer_info_caption_text_bg_color"
                                               placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="customer_info_caption_text_font_size">Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="customer_info_caption_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="customer_info_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="customer_info_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="customer_info_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="customer_info_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="customer_info_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="customer_info_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="customer_info_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="customer_info_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="customer_info_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="customer_info_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="customer_info_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="customer_info_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CART SETTINGS MODAL -->
<div id="cartSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="cart_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="cartSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#cart_tab_settings" id="cart-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#cart_tab_advance" role="tab" id="cart-adnance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_cart_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="cart_tab_settings"
                                 aria-labelledby="home-tab">


                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="cart_setting_show_shipping">Show Shipping:</label>
                                    <div class="col-sm-9">
                                    <select name="cart_setting_show_shipping" id="cart_setting_show_shipping"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="cart_setting_product_text_color">Product
                                        Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="cart_setting_product_text_color"
                                               name="cart_setting_product_text_color"
                                               placeholder="Enter product text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="cart_setting_label_text_color">Label Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="cart_setting_label_text_color"
                                               name="cart_setting_label_text_color" placeholder="Enter label text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="cart_setting_price_text_color">Price Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="cart_setting_price_text_color"
                                               name="cart_setting_price_text_color" placeholder="Enter label text color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="cart_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="cart_setting_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="cart_setting_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="cart_setting_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="cart_setting_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="cart_setting_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="cart_setting_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="cart_setting_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="cart_setting_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="cart_setting_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="cart_setting_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="cart_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- BILLING ADDRESS SETTINGS MODAL -->
<div id="billingAddressSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="billing_address_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="billingSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#billing_address_tab_settings" id="billing-address-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#billing_address_tab_advance" role="tab" id="billing-address-adnance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_billing_address_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="billing_address_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="billing_address_caption_text">Caption
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="billing_address_caption_text"
                                               name="billing_address_caption_text"
                                               placeholder="Enter Caption text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="billing_address_caption_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="billing_address_caption_text_color"
                                               name="billing_address_caption_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group row clearfix">
                                    <label class="control-label col-sm-3" for="billing_address_caption_text_bg_color">BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="billing_address_caption_text_bg_color"
                                               name="billing_address_caption_text_bg_color"
                                               placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="billing_address_caption_text_font_size">Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="billing_address_caption_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="billing_address_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="billing_address_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="billing_address_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="billing_address_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="billing_address_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="billing_address_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="billing_address_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="billing_address_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="billing_address_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="billing_address_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="billing_address_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="billing_address_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- SHIPPING ADDRESS SETTINGS MODAL -->
<div id="shippingAddressSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="shipping_address_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#shipping_address_tab_settings" id="shipping-address-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#shipping_address_tab_advance" role="tab" id="shipping-address-adnance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_shipping_address_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="shipping_address_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_address_caption_text">Caption
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shipping_address_caption_text"
                                               name="shipping_address_caption_text"
                                               placeholder="Enter Caption text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_address_caption_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="shipping_address_caption_text_color"
                                               name="shipping_address_caption_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group row clearfix">
                                    <label class="control-label col-sm-3" for="shipping_address_caption_text_bg_color">BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="shipping_address_caption_text_bg_color"
                                               name="shipping_address_caption_text_bg_color"
                                               placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="shipping_address_caption_text_font_size">Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="shipping_address_caption_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="shipping_address_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="shipping_address_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="shipping_address_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="shipping_address_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="number" name="shipping_address_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="shipping_address_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="shipping_address_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="shipping_address_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="number" name="shipping_address_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_address_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="shipping_address_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="shipping_address_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- MAIN MODAL -->
<div id="mainModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>

                <div class="modal-header-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        @foreach ($widgets as $key => $widget)
                            <li role="presentation" class="<?php echo ( $key == 0 ) ? 'active' : ''; ?>">
                                <a href="#tab_{{ $widget }}" id="{{ $widget }}-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">{{ ucfirst($widget) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- ROW MODAL
<div id="sectionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Section</h4>
            </div>

            <div class="modal-body" id="row_body">
            </div>
        </div>
    </div>
</div> -->

<!-- ROW MODAL -->
<div id="rowModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Section</h4>
            </div>

            <div class="modal-body" id="row_body">
            </div>
        </div>
    </div>
</div>

<!-- GRID MODAL -->
<div id="gridModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Grids</h4>
            </div>

            <div class="modal-body" id="grid_body">
            </div>
        </div>
    </div>
</div>

<!-- ELEMENT MODAL -->
<div id="elementModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elements</h4>

                <div class="modal-header-tab">
                    <ul>
                        <li data-filter-type="all" class="active">All</li>
                        <li data-filter-type="general">General</li>
                        <li data-filter-type="grid">Grid</li>
                        <li data-filter-type="image">Image</li>
                        <li data-filter-type="video">Video</li>
                        <li data-filter-type="forms">Forms</li>
                        <li data-filter-type="order">Order</li>
                        <li data-filter-type="product">Product</li>
                    </ul>
                </div>
            </div>

            <div class="modal-body" id="element_body">
            </div>
        </div>
    </div>
</div>

<!-- ELEMENT SETTINGS MODAL -->
<div id="elementSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="settings_body">
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT SETTINGS MODAL -->
<div id="productModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="product_body">
            </div>
        </div>
    </div>
</div>


<!-- INTEGRATIONS MODAL
<div id="integrationsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="integration_modal_body">

            </div>
        </div>
    </div>
</div> -->


<!-- ICON TEXT -->
<div id="iconTextSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Icon Text Settings</h4>
            </div>

            <div class="modal-body" id="icon_text_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_text_tab_icon_text" id="icon-text-icon-text-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Icon and Text</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_text_tab_settings" role="tab" id="icon-text-settings-tab" data-toggle="tab"
                               aria-expanded="false">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_text_tab_themes" role="tab" id="icon-text-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_icon_text_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_text_tab_icon_text"
                                 aria-labelledby="home-tab">

                                <div class="form-group clearfix">
                                    <label class="control-label col-sm-3" for="icon_text_icon">Icon:</label>
                                    <div class="col-sm-9 text-right">
                                        <button id="icon-picker-button" type="button" class="btn btn-default btn-lg"
                                                data-icon="fa-check" data-iconset="fontawesome" role="iconpicker">
                                            ss
                                        </button>
                                        <input type="hidden" name="hid_selected_icon" value="fa-check">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="icon_text_paragraph_text">Text:</label>
                                    <textarea class="html-editor" id="icon_text_paragraph_text" rows="5"
                                              name="icon_text_paragraph_text"></textarea>
                                </div>


                                </button>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_text_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_text_font_weight">Font
                                        Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="icon_text_font_weight" id="icon_text_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_icon_size">Icon Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_icon_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_text_text_align">Text Align:</label>
                                    <div class="col-sm-9">
                                        <select name="icon_text_text_align" id="icon_text_text_align"
                                                class="form-control">
                                            <option value="">None</option>
                                            <option value="left">Left</option>
                                            <option value="center">Center</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_text_size">Text Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_text_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_icon_position">Icon
                                                Position:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <select name="icon_text_icon_position"
                                                        id="icon_text_icon_position" class="form-control">
                                                    <option value="top">Top</option>
                                                    <option value="middle">Middle</option>
                                                    <option value="bottom">Bottom</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_text_icon_color">Icon Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_text_icon_color"
                                               name="icon_text_icon_color" placeholder="Enter border color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_text_text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_text_text_color"
                                               name="icon_text_text_color" placeholder="Enter border color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_text_bg_color">BG Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_text_bg_color"
                                               name="icon_text_bg_color" placeholder="Enter BG color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_text_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="list-icon-items">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_text_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_text_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_text_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_text_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_text_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_text_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_text_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- POPUP SETTINGS MODAL -->
<div id="openPagePopupSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Popup Settings</h4>
            </div>

            <div class="modal-body" id="page_popup_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_page_popup_settings" id="page-popup-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_page_popup_advance" role="tab" id="page-popup-advance" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_page_popup_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_page_popup_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_popup_bg_image">BG Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="page_popup_bg_image" name="page_popup_bg_image"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_popup_image_position">Background
                                        Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">

                                        <select name="page_popup_image_position"
                                                id="page_popup_image_position" class="form-control">
                                            <option value="bgCover">Full Center (Parallax)</option>
                                            <option value="bgCover100">Fill 100% Width</option>
                                            <option value="bgCover101">Fill 100% Width &amp; Height</option>
                                            <option value="bgNoRepeat">No Repeat</option>
                                            <option value="bgRepeat">Repeat</option>
                                            <option value="bgRepeatX">Repeat Hortizontally</option>
                                            <option value="bgRepeatY">Repeat Vertically</option>
                                            <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                            <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_popup_modal_width">Modal
                                        Width:</label>
                                    <div class="col-sm-9">

                                        <select class="form-control" id="page_popup_modal_width"
                                                name="page_popup_modal_width">
                                            <option value="large">Large</option>
                                            <option value="medium">Medium</option>
                                            <option value="small">Small</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_popup_modal_open_after">Modal Open
                                        After:</label>
                                    <div class="col-sm-9">

                                        <input type="number" class="form-control" placeholder="i.e 5 seconds"
                                               id="page_popup_modal_open_after" name="page_popup_modal_open_after"/>
                                    </div>
                                </div>


                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Colors</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="page_popup_backdrop">Backdrop:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="page_popup_backdrop"
                                                       name="page_popup_backdrop" placeholder="Enter background color"
                                                       value=""/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="page_popup_bg_color">BG
                                                Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="page_popup_bg_color"
                                                       name="page_popup_bg_color" placeholder="Enter background color"
                                                       value=""/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="page_popup_text_color">Text
                                                Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="page_popup_text_color"
                                                       name="page_popup_text_color" placeholder="Enter background color"
                                                       value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Border</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="page_popup_border_style">Style:</label>
                                            <div class="col-sm-9">
                                                <select name="page_popup_border_style" id="page_popup_border_style"
                                                        class="form-control">
                                                    <option value="">None</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="dotted">Dotted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="page_popup_border_size">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="page_popup_border_size" id="page_popup_border_size"
                                                        class="form-control">
                                                    <option value="1px">1px</option>
                                                    <option value="2px">2px</option>
                                                    <option value="3px">3px</option>
                                                    <option value="5px">5px</option>
                                                    <option value="10px">10px</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="page_popup_border_color">Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="page_popup_border_color"
                                                       name="page_popup_border_color" placeholder="Enter border color"
                                                       value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_page_popup_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="page_popup_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="page_popup_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="page_popup_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="page_popup_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="page_popup_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="page_popup_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="page_popup_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="page_popup_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="page_popup_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="text_page_popup_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SELECT BOX SETTINGS MODAL -->
<div id="openselectBoxSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Box Settings</h4>
            </div>

            <div class="modal-body" id="select_box_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_select_box_settings" id="select_box-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_select_box_advance" role="tab" id="select_box-advance" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_select_box_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_select_box_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="select_box_type">Input Type:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="select_box_type"
                                                name="select_box_type">
                                            <option value="not_set">Not Set</option>
                                            <option value="custom">Custom Option</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix element-option-table-setting-control" id="custom_option_select"
                                     style="display:none">

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="select_box_custom_type_name">Custom
                                            Type Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="select_box_custom_type_name"
                                                   name="select_box_custom_type_name" placeholder="Custom Type Name"
                                                   value="" style="width:100%"/>
                                        </div>
                                    </div>

                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Value</th>
                                            <th>Text</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" placeholder="i.e: Rex"/></td>
                                            <td><input type="text" class="form-control" placeholder="i.e: Rex"/></td>
                                        </tr>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn button_add_modal_setting_options">Add
                                                    New Option
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_select_box_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="select_box_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="select_box_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="select_box_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="select_box_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="select_box_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="select_box_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="select_box_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="select_box_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="select_box_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="select_box_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- TEXT FIELD SETTINGS MODAL -->
<div id="openTextFieldSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Text Field Settings</h4>
            </div>

            <div class="modal-body" id="text_field_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_text_field_settings" id="text-field-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_text_field_advance" role="tab" id="text-field-advance" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_text_field_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_text_field_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_field_input_type">Input
                                        Type:</label>
                                    <div class="col-sm-9">
                                        <!--<select class="form-control" id="text_field_input_type"
                                               name="text_field_input_type">
                                               <option value="text">Not Set</option>
                                               <option value="text">Text</option>
                                               <option value="email">Email</option>
                                        </select>-->

                                        <select id="text_field_input_type" id="text_field_input_type"
                                                class="form-control" name="text_field_input_type">
                                            <option value="not-set">Not Set</option>
                                            <option value="name">Full Name</option>
                                            <option value="first_name">First Name</option>
                                            <option value="last_name">Last Name</option>
                                            <option value="email">Email</option>
                                            <option value="email_address">Email Address</option>
                                            <option value="phone">Phone Number</option>
                                            <option value="address">Address</option>
                                            <option value="city">City</option>
                                            <option value="state">State</option>
                                            <option value="country">Country</option>
                                            <option value="zip">Zip</option>
                                            <option value="shipping_address">Shipping Address</option>
                                            <option value="shipping_city">Shipping City</option>
                                            <option value="shipping_state">Shipping State</option>
                                            <option value="shipping_country">Shipping Country</option>
                                            <option value="shipping_zip">Shipping Zip</option>
                                            <option value="vat_number">VAT Number</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_field_placeholder_text">Placeholder
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="text_field_placeholder_text"
                                               name="text_field_placeholder_text" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_field_required">Required:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="text_field_required"
                                                name="text_field_required">
                                            <option value="">Not Required</option>
                                            <option value="required">Required</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="text_field_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="text_field_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_text_field_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_field_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_field_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_field_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_field_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_field_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_field_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_field_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_field_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_field_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="text_field_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ORDER TWO STEP SETTINGS MODAL -->
<div id="orderTwoStepSettings" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Two Step Settings</h4>
            </div>

            <div class="modal-body" id="order_two_step_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_order_two_step_settings" id="order_two_step-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>

                        <li role="presentation">
                            <a href="#tab_order_two_step_advance" id="order_two_step-advance-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Adnace</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_two_step_setting" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_order_two_step_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_two_step_headline">Headiline:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_two_step_headline"
                                               name="order_two_step_headline" placeholder="Enter text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_left_title">Left Tab
                                        Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_two_step_left_title"
                                               name="order_two_step_left_title" placeholder="Enter text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_right_title">Right Tab
                                        Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_two_step_right_title"
                                               name="order_two_step_right_title" placeholder="Enter text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_left_info">Left Tab
                                        Info:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_two_step_left_info"
                                               name="order_two_step_left_info" placeholder="Enter text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_right_info">Right Tab
                                        Info:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_two_step_right_info"
                                               name="order_two_step_right_info" placeholder="Enter text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_button_color">Button
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_two_step_button_color"
                                               name="order_two_step_button_color" placeholder="Enter Button color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_button_bg_color">Button BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_two_step_button_bg_color"
                                               name="order_two_step_button_bg_color" placeholder="Enter Button BG color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_headline_color">Headline
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_two_step_headline_color"
                                               name="order_two_step_headline_color" placeholder="Enter Line color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_headline_bg_color">Headline
                                        BG Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_two_step_headline_bg_color"
                                               name="order_two_step_headline_bg_color" placeholder="Enter BG color"
                                               value=""/>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_normal_color">Tab Normal Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="order_two_step_normal_color"
                                            name="order_two_step_normal_color" placeholder="Enter Line color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_active_color">Tab Active Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="order_two_step_active_color"
                                            name="order_two_step_active_color" placeholder="Enter Line color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_two_step_normal_bg_color">Active Border Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="order_two_step_active_border_color"
                                            name="order_two_step_active_border_color" placeholder="Enter Line color" value=""/>
                                    </div>
                                </div>-->

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="order_two_step_headline_font_size">Headline
                                            Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="order_two_step_headline_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="order_two_step_header_font_size">Header Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="order_two_step_header_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="order_two_step_info_font_size">Info Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="order_two_step_info_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_order_two_step_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="order_two_step_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="order_two_step_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="order_two_step_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="order_two_step_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="order_two_step_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="order_two_step_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="order_two_step_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="order_two_step_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="order_two_step_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="order_two_step_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SPACE BAR SETTINGS MODAL -->
<div id="spaceBarSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Space Bar Settings</h4>
            </div>

            <div class="modal-body" id="single_image_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_specebar_settings" id="image-specebar-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_specebar_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_specebar_settings"
                                 aria-labelledby="home-tab">

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="specebar_settings_height">Height:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="specebar_settings_height" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="specebar_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SEPERATOR WITH TEXT SETTINGS MODAL -->
<div id="horizontalSeperatorSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Horizontal Seperator Settings</h4>
            </div>

            <div class="modal-body" id="single_image_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_seperator_text_settings" id="image-seperator-text-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_seperator_text_advance" role="tab" id="image-seperator-text-advance"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_seperator_text_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_seperator_text_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="seperator_text_settings_text">Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="seperator_text_settings"
                                               name="seperator_text_settings" placeholder="Enter text" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_text_settings_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="seperator_text_settings_text_color"
                                               name="seperator_text_settings_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_text_settings_line_color">Line
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="seperator_text_settings_line_color"
                                               name="seperator_text_settings_line_color" placeholder="Enter Line color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_text_settings_bg_color">Text Bg
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="seperator_text_settings_bg_color"
                                               name="seperator_text_settings_bg_color"
                                               placeholder="Enter background color" value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="seperator_text_settings_font_size">Items Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="seperator_text_settings_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_text_settings_font_weight">Font
                                        Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="seperator_text_settings_font_weight"
                                                id="seperator_text_settings_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_seperator_text_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_text_settings_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_text_settings_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_text_settings_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_text_settings_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_text_settings_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_text_settings_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_text_settings_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_text_settings_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_text_settings_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label"
                                                       for="seperator_text_settings_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_text_settings_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="seperator_text_settings_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- IMAGE INSIDE TAB SETTINGS MODAL -->
<div id="imgaeInsideTabModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Image Inside Tab Settings</h4>
            </div>

            <div class="modal-body" id="single_image_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_image_inside_tab_settings" id="image-inside-tab-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_image_inside_tab_advance" role="tab" id="image-inside-tab-advance"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_image_inside_tab_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_image_inside_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_inside_tab_image_path">TAB
                                        Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_inside_tab_image_path" name="image_inside_tab_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Inner Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_inside_inner_image_path"
                                                   name="image_inside_inner_image_path" aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="image_inside_width">Width (%):</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider width-percent-slider"></div>
                                            <input type="text" name="image_inside_width" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_inside_height">Height:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control" id="image_inside_height"
                                               name="image_inside_height" placeholder="Enter Height" value="">

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_image_inside_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_inside_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_inside_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_inside_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_inside_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_inside_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_inside_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_inside_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_inside_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_inside_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="image_inside_tab_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- EMPTY CONTAINER SETTINGS MODAL -->
<div id="emptyContainerSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Empty Container Settings</h4>
            </div>

            <div class="modal-body" id="empty_container_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="gOneTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#empty_container_tab_settings" id="empty_container-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#empty_container_tab_advance" role="tab" id="empty_container-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_empty_container_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="empty_container_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="empty_container_section_id">Section
                                        ID:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="empty_container_section_id"
                                               name="empty_container_section_id" placeholder="Enter section ID"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="empty_container_width">Width:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="empty_container_width" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="empty_container_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="empty_container_text_color"
                                               name="empty_container_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="empty_container_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="empty_container_bg_color"
                                               name="empty_container_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="empty_container_text_align">Text
                                        Align:</label>
                                    <div class="col-sm-9">
                                        <select name="empty_container_text_align" id="empty_container_text_align"
                                                class="form-control">
                                            <option value="">None</option>
                                            <option value="left">Left</option>
                                            <option value="center">Center</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Border</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="empty_container_border_style">Style:</label>
                                            <div class="col-sm-9">
                                                <select name="empty_container_border_style"
                                                        id="empty_container_border_style" class="form-control">
                                                    <option value="">None</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="dotted">Dotted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="empty_container_border_size">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="empty_container_border_size"
                                                        id="empty_container_border_size" class="form-control">
                                                    <option value="1px">1px</option>
                                                    <option value="2px">2px</option>
                                                    <option value="3px">3px</option>
                                                    <option value="5px">5px</option>
                                                    <option value="10px">10px</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="empty_container_border_color">Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="empty_container_border_color"
                                                       name="empty_container_border_color"
                                                       placeholder="Enter border color" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="empty_container_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_padding_top">Padding
                                            Top:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="empty_container_padding_top" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_padding_bottom">Padding
                                            Bottom:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="empty_container_padding_bottom"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_padding_right">Padding
                                            Right:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="empty_container_padding_right"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_padding_left">Padding
                                            Left:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="empty_container_padding_left"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_margin_top">Margin
                                            Top:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="empty_container_margin_top" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="empty_container_margin_bottom">Margin
                                            Bottom:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="empty_container_margin_bottom"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="empty_container_setting_save"> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- FAQ SETTINGS MODAL -->
<div id="faqBlockSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">FAQ Settings</h4>
            </div>

            <div class="modal-body" id="faq_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="faqTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#faq_tab_settings" id="faq-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#faq_tab_advance" role="tab" id="faq-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_faq_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="faq_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="faq_question_text">Question Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="faq_question_text"
                                               name="faq_question_text" placeholder="Enter question text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="faq_answar_text">Answar Text:</label>
                                    <br/>
                                    <textarea class="html-editor" id="faq_answar_text" rows="5"
                                              name="faq_answar_text"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="faq_question_color">Question
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="faq_question_color"
                                               name="faq_question_color" placeholder="Enter question color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="faq_answar_color">Answar Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="faq_answar_color"
                                               name="faq_answar_color" placeholder="Enter answar color" value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="faq_question_size">Question Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="faq_question_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="faq_answar_size">Answar Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="faq_answar_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="faq_answar_line_height">Line Height:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="faq_answar_line_height" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="faq_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="faq_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="faq_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="faq_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="faq_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="faq_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="faq_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="faq_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="faq_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="faq_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="faq_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PRODUCT ADD SETTINGS MODAL -->
<div id="productAddSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Add Settings</h4>
            </div>

            <div class="modal-body" id="testimonial_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="productAddTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#product_add_tab_product" id="product_add-items-product" role="tab"
                               data-toggle="tab" aria-expanded="true">Product</a>
                        </li>
                        <li role="presentation">
                            <a href="#product_add_tab_settings" id="product_add-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#product_add_tab_advance" role="tab" id="product_add-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_add_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="product_add_tab_product"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_product">Choose
                                        product:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="product_add_product"
                                                name="product_add_product">
                                        </select>
                                    </div>
                                </div>

                                <div class="" id="product_add_variant_container">
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_add_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_header_text">Header
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_header_text"
                                               name="product_add_header_text" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_bg_color">Header Bg
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="product_add_bg_color"
                                               name="product_add_bg_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_text_color">Header
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="product_add_text_color"
                                               name="product_add_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_recomonded_text">Recomomded
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_recomonded_text"
                                               name="product_add_recomonded_text" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_regular_price">Regular
                                        Price:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_regular_price"
                                               name="product_add_regular_price" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_instant_saving">Instant
                                        Saving:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_instant_saving"
                                               name="product_add_instant_saving" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_saving_color">Saving
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="product_add_saving_color"
                                               name="product_add_saving_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_price">Price:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_price"
                                               name="product_add_price" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_short_info">Short
                                        Info:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_short_info"
                                               name="product_add_short_info" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_info_with_price">Info with
                                        price:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_info_with_price"
                                               name="product_add_info_with_price" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_button_text">Button
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_add_button_text"
                                               name="product_add_button_text" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_button_bg_color">Button Bg
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="product_add_button_bg_color"
                                               name="product_add_button_bg_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_add_button_text_color">Button
                                        Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="product_add_button_text_color"
                                               name="product_add_button_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_add_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_add_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_add_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_add_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_add_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_add_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_add_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_add_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_add_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_add_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="product_add_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MENU SETTINGS MODAL -->
<div id="menuSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Menu Settings</h4>
            </div>

            <div class="modal-body" id="testimonial_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="menuTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#menu_tab_items" id="menu-items-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Items</a>
                        </li>
                        <li role="presentation">
                            <a href="#menu_settings_items" id="menu-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#menu_tab_advance" role="tab" id="menu-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_menu_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="menu_tab_items"
                                 aria-labelledby="home-tab">

                                <div class="row">
                                    <button class="btn btn-default pull-right add-menu-item">Add New Item</button>
                                </div>

                                <div class="menu_add_container">

                                    <div class="panels">

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="menu_settings_title">Menu
                                                Title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                       name="menu_title[]" placeholder="Enter menu title" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="menu_settings_link">Menu
                                                Link:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                       name="menu_links[]" placeholder="Enter menu link" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="image_text_setting_align">Menu
                                                Target:</label>
                                            <div class="col-sm-9">
                                                <select name="image_text_setting_align" id="image_text_setting_align"
                                                        class="form-control">
                                                    <option value="">Same Tab</option>
                                                    <option value="_blank"> Next tab</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="menu_settings_items"
                                 aria-labelledby="home-tab">

                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="menu_settings_behaviour">Behaviour:</label>
                                    <div class="col-sm-9">
                                        <select name="menu_settings_behaviour" class="form-control" id="menu_settings_behaviour">
                                            <option value="">No Action</option>
                                            <option value="goto_section">Scroll To Section</option>
                                            <option value="goto_link">Go To Link</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="display:none;" id="menu_settings_scroll_to_section">
                                    <input type="text" name="menu_settings_section_id" id="menu_settings_section_id" placeholder="Give a section ID" />
                                </div>-->


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="menu_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="menu_setting_align" id="menu_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="menu_item_color">Items Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="menu_item_color"
                                               name="menu_item_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="menu_item_bg_color">Menu BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="menu_item_bg_color"
                                               name="menu_item_bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="menu_items_font_size">Items Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="menu_items_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="menu_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="menu_setting_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="menu_setting_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="menu_setting_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="menu_setting_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="menu_setting_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="menu_setting_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="menu_setting_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="menu_setting_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="menu_setting_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="menu_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- IMAGE TEXT SETTINGS MODAL -->
<div id="imageTextBlockSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sub Headline Settings</h4>
            </div>

            <div class="modal-body" id="testimonial_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="imageTextTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#image_text_settings" id="image-text-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#image_text_tab_advance" role="tab" id="image-text-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_image_text_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="image_text_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_headline_text">Headline
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="image_text_headline_text"
                                               name="image_text_headline_text" placeholder="Enter headline text"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_sub_headline_text">Sub
                                        Headline Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="image_text_sub_headline_text"
                                               name="image_text_sub_headline_text" placeholder="Enter Sub headline Text"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="image_text_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="image_text_setting_align" id="image_text_setting_align"
                                                class="form-control">
                                            <option value="">Left</option>
                                            <option value="center"> Center</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_text_image_path" name="image_text_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_headline_text_color">Headline
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="image_text_headline_text_color"
                                               name="image_text_headline_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_sub_headline_text_color">Sub
                                        Headline Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="image_text_sub_headline_text_color"
                                               name="image_text_sub_headline_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_text_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="image_text_bg_color"
                                               name="image_text_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="image_text_headline_font_size">Headline Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="image_text_headline_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="image_text_sub_headline_font_size">Sub
                                            headline Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="image_text_sub_headline_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="image_text_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="image_text_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="image_text_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="image_text_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="image_text_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="image_text_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="image_text_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="image_text_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="image_text_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="image_text_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="image_text_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- TESTIMONIAL SETTINGS MODAL -->
<div id="testimonialSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sub Headline Settings</h4>
            </div>

            <div class="modal-body" id="testimonial_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="testimonialTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#sub_testimonial_tab_settings" id="testimonial-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#sub_testimonial_tab_advance" role="tab" id="testimonial-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_testimonial_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="sub_testimonial_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_text">Testimonial
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="testimonial_text"
                                               name="testimonial_text" placeholder="Enter testimonial text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_customer_name_text">Customer
                                        Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="testimonial_customer_name_text"
                                               name="testimonial_customer_name_text"
                                               placeholder="Enter testimonial text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_customer_place_text">Customer
                                        Place:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="testimonial_customer_place_text"
                                               name="testimonial_customer_place_text"
                                               placeholder="Enter testimonial text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_customer_rating">Customer
                                        Rating:</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="testimonial_customer_rating"
                                               name="testimonial_customer_rating" placeholder="Enter testimonial text"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_text_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="testimonial_text_setting_align"
                                                id="testimonial_text_setting_align"
                                                class="form-control">
                                            <option value="">Left</option>
                                            <option value="center"> Center</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="testimonial_image_path" name="testimonial_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                            <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_font_weight">Font Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="sub_headline_font_weight" id="sub_headline_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                    <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>-->

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="testimonial_text_color"
                                               name="testimonial_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_customer_name_color">Customer
                                        Name Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="testimonial_customer_name_color"
                                               name="testimonial_customer_name_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_rating_color">Rating
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="testimonial_rating_color"
                                               name="testimonial_rating_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="testimonial_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="testimonial_bg_color"
                                               name="testimonial_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="testimonial_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="testimonial_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="sub_testimonial_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="testimonial_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="testimonial_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="testimonial_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="testimonial_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="testimonial_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="testimonial_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="testimonial_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="testimonial_padding_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="testimonial_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="testimonial_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT SETTINGS MODAL -->
<div id="editorSettingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Page settings</h4>
            </div>

            <form id="frm_page_settings" class="form-horizontal">
                <div class="modal-body" id="page_settings_body">
                    <div class="form-group clearfix">
                        <label class="control-label col-sm-3" for="alt_text">Background color:</label>
                        <div class="col-sm-9">
                            <input type="text" name="page_bg_color" value="" class="form-control color-settings"/>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label class="control-label col-sm-3" for="text_color">Padding:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="page_setting_padding" type="range" value="0"
                                   min="0" max="50">
                            <span class="range-slider__value description-padding-setting">0px</span>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_page_settings" class="btn btn-primary"> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- SHIPPING METHODS SETTINGS MODAL -->
<div id="couponSystemSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shipping Method Settings</h4>
            </div>

            <div class="modal-body" id="coupon_system_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="couponSystemSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#coupon_system_tab_settings" id="coupon-system-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#coupon_system_tab_advance" role="tab" id="coupon-system-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_coupon_system_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="coupon_system_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_headline_text">Headline
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="coupon_system_headline_text"
                                               name="coupon_system_headline_text"
                                               placeholder="Enter headline text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_headline_alignment">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="coupon_system_headline_alignment"
                                                id="coupon_system_headline_alignment"
                                                class="form-control">
                                            <option value="left"> Left</option>
                                            <option value="center">Center</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_button_text">Button
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="coupon_system_button_text"
                                               name="coupon_system_button_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="coupon_system_text_color"
                                               name="coupon_system_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_bg_color">Text BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="coupon_system_bg_color"
                                               name="coupon_system_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_button_text_color">Button
                                        Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="coupon_system_button_text_color"
                                               name="coupon_system_button_text_color" placeholder="Button text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="coupon_system_button_bg">Button BG
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="coupon_system_button_bg"
                                               name="coupon_system_button_bg" placeholder="Button text color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="coupon_system_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="coupon_system_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="coupon_system_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_padding_lef">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="coupon_system_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_padding_right">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="coupon_system_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="coupon_system_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="coupon_system_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="coupon_system_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="coupon_system_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="coupon_system_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="coupon_system_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- SHIPPING METHODS SETTINGS MODAL -->
<div id="shippingMethodSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shipping Method Settings</h4>
            </div>

            <div class="modal-body" id="headline_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="shippingMethodSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#shipping_method_tab_settings" id="shipping-method-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#shipping_method_tab_advance" role="tab" id="shipping-method-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_shipping_method_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="shipping_method_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_method_headline_text">Headline
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shipping_method_headline_text"
                                               name="shipping_method_headline_text"
                                               placeholder="Enter headline text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_method_headline_alignment">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="shipping_method_headline_alignment"
                                                id="shipping_method_headline_alignment"
                                                class="form-control">
                                            <option value="left"> Left</option>
                                            <option value="center">Center</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_method_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="shipping_method_text_color"
                                               name="shipping_method_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="shipping_method_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="shipping_method_bg_color"
                                               name="shipping_method_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="shipping_method_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="shipping_method_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="shipping_method_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_padding_lef">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="shipping_method_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_padding_right">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="shipping_method_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="shipping_method_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="shipping_method_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_margin_left">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="shipping_method_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="shipping_method_margin_right">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="shipping_method_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="shipping_method_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Contact form setting -->
<!-- ELEMENT SETTINGS MODAL -->
<div id="contactFormSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="conatct_form_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#contact_form_settings" id="settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#contact_form_advance" role="tab" id="themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_contact_form_settings" class="form-horizontal">
                        <div id="myTabContents" class="tab-content">

                            <div role="tabpanel" class="tab-pane fade active in" id="contact_form_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Caption Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="caption_text" name="caption_text"
                                               placeholder="Enter caption text"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="enable_step_number">Enable step
                                        number:</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" class="checkbox" name="enable_step_number"
                                               id="enable_step_number" value="true" checked/>
                                        <input class="form-control" type="text" id="step_number" name="step_number"
                                               placeholder="Step #1"
                                               value=""/>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="contact_form_advance"
                                 aria-labelledby="home-tab">
                                <div class="col-md-12">

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="contact_form_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="contact_form_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="contact_form_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="contact_form_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="contact_form_margin_top" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="contact_form_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="contact_form_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="contact_form_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="contact_form_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="contact_form_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="orderAddressDetailsSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Address Details Settings</h4>
            </div>

            <div class="modal-body" id="order_address_details_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderAddressDetailsSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_address_details_tab_settings" id="order-address-details-settings-tab"
                               role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_address_details_tab_advance" role="tab"
                               id="order-address-details-advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_address_details_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_address_details_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_address_details_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_address_details_setting_align"
                                                id="order_address_details_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_address_details_header_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_address_details_header_color"
                                               name="order_address_details_header_color" placeholder="Successful color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_address_details_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_address_details_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_address_details_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_address_details_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_address_details_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_address_details_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_address_details_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_address_details_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_address_details_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label"
                                                           for="order_address_details_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_address_details_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_address_details_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="orderActionSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Action Settings</h4>
            </div>

            <div class="modal-body" id="order_action_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_action_tab_settings" id="order-action-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_action_tab_advance" role="tab" id="order-action-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_action_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_action_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_action_button_text">Button
                                        text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_action_button_text"
                                               name="order_action_button_text"
                                               placeholder="Button Text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_print_button_text">Print Button
                                        text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_print_button_text"
                                               name="order_print_button_text"
                                               placeholder="Print Button Text" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_action_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_action_setting_align" id="order_action_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_button_bg_color">Button BG
                                            Color:</label>
                                        <input type="text" class="form-control" id="order_button_bg_color"
                                               name="order_button_bg_color"
                                               placeholder="Button BG Color" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_button_color">Button Text Color:</label>
                                        <input type="text" class="form-control" id="order_button_color"
                                               name="order_button_color"
                                               placeholder="Button Text Color" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_print_button_bg_color">Print Button BG
                                            Color:</label>
                                        <input type="text" class="form-control" id="order_print_button_bg_color"
                                               name="order_print_button_bg_color"
                                               placeholder="Button BG Color" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_print_button_text_color">Print Button
                                            Text Color:</label>
                                        <input type="text" class="form-control" id="order_print_button_text_color"
                                               name="order_print_button_text_color"
                                               placeholder="Button Text Color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_action_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_action_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_action_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_action_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_action_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_action_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_action_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_action_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_action_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_action_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_action_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="orderInfoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Info</h4>
            </div>

            <div class="modal-body" id="order_info_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_info_tab_settings" id="order-info-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_info_tab_advance" role="tab" id="order-info--advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_info_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_info_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_successful_message">Order
                                        Successful Message:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_successful_message"
                                               name="order_successful_message"
                                               placeholder="Order Successful Message" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_info_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_info_setting_align" id="order_info_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_successful_message_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_successful_message_color"
                                               name="order_successful_message_color" placeholder="Successful color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_info_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_info_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_info_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_info_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_info_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_info_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_info_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_info_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_info_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_info_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_info_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="orderBumpSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Bump Settings</h4>
            </div>

            <div class="modal-body" id="order_info_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderBumpSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_bump_tab_settings" id="order-info-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_bump_tab_advance" role="tab" id="order-info--advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_bump_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_bump_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_headline">Bump
                                        Headline:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_bump_headline"
                                               name="order_bump_headline"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_oto_headline">OTO
                                        Headline:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_bump_oto_headline"
                                               name="order_bump_oto_headline"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_oto_text">OTO Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_bump_oto_text"
                                               name="order_bump_oto_text"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="order_bump_headline_font_size">Headline Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="order_bump_headline_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="order_bump_text_font_size">Text Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="order_bump_text_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_headline_color">Headline
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_bump_headline_color"
                                               name="order_bump_headline_color"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_bump_text_color"
                                               name="order_bump_text_color"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3" for="order_bump_headline_bg">Headline
                                        BG:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_bump_headline_bg"
                                               name="order_bump_headline_bg"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_bump_background">Background:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_bump_background"
                                               name="order_bump_background"
                                               placeholder="Bump Headline" value=""/>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_bump_headline_align">Header Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_bump_headline_align" id="order_bump_headline_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_bump_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_bump_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_bump_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_bump_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="order_bump_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_bump_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_bump_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_bump_margin_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="order_bump_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="order_bump_margin_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_bump_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="productDescriptionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Description</h4>
            </div>

            <div class="modal-body" id="product_price_body">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#product_description_tab_settings" id="order-info-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#product_description_tab_advance" role="tab" id="order-info--advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_description_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="product_description_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">Align:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_product_description_align_option"
                                                id="select_product_description_align_option">
                                            <option value="">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">Text color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="description_color" value=""
                                               class="form-control color-settings"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="product_description_text">Description
                                        Text:</label>
                                    <br/>
                                    <textarea class="html-editor" id="product_description_text" rows="5"
                                              name="product_description_text"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_font_size">Font
                                                Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_font_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_description_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="col-md-12">

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="description_font_size">Font Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="description_font_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="product_description_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="product_description_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="product_description_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="product_description_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_description_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="product_description_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr/>

                            <div class="form-group text-right">
                                <button id="btn_save_product_description_setting" class="btn btn-primary"> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PRODUCT PRICE SETTINGS MODAL -->
<div id="productPriceSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="product_price_body">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#price_tab_settings" id="order-info-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#price_tab_advance" role="tab" id="order-info--advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_price_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="price_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">Align:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_product_price_align_option"
                                                id="select_product_price_align_option">
                                            <option value="">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="alt_text">Display price as:</label>
                                    <div class="editor-container">
                                        <!--<input type="text" name="price_as" value="" class="form-control"/>-->
                                        <textarea class="html-editor" id="price_as" rows="5"
                                                  name="price_as"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">Price text color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="price_color" value=""
                                               class="form-control color-settings"/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="product_price_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider font-slider"></div>
                                            <input type="text" name="product_price_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="price_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="price_setting_padding">Padding Top</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="price_setting_padding"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="order_info_margin_top">Font Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="price_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button id="btn_save_product_price_setting" class="btn btn-primary"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT PRODUCT QUANTITY SETTINGS MODAL -->
<div id="productQuantitySettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Quantity Settings</h4>
            </div>

            <div class="modal-body" id="product_varients_body">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="subHeadlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#product_quantity_tab_settings" id="sub-headline-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#product_quantity_tab_themes" role="tab" id="sub-headline-themes-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_quantity_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="product_quantity_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="select_product_quantity_align_option">Align:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_product_quantity_align_option"
                                                id="select_product_quantity_align_option">
                                            <option value="">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_quantity_align_option">Width
                                        (%):</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="product_quantity_width" id="product_quantity_width"
                                               class="form-control" placeholder="i.e. 50"/>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_quantity_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_quantity_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_quantity_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_quantity_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_quantity_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_quantity_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_quantity_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_quantity_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_quantity_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_quantity_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="product_quantity_save"> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT PRODUCT VARIENTS SETTINGS MODAL -->
<div id="productVarientSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Varients</h4>
            </div>

            <div class="modal-body" id="product_varients_body">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="subHeadlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#product_varient_tab_settings" id="sub-headline-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#product_varient_tab_themes" role="tab" id="sub-headline-themes-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_varient_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="product_varient_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="select_product_varient_align_option">Align:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_product_varient_align_option"
                                                id="select_product_varient_align_option">
                                            <option value="">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="select_product_varient_align_option">Width(%):</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="product_varient_width" id="product_varient_width"
                                               class="form-control" placeholder="Enter width in %"/>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_varient_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_varient_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_varient_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_varient_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="product_varient_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_varient_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_varient_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_varient_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="product_varient_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="product_varient_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="product_varient_save"> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MANUAL PRODUCTS FOR SETTINGS MODAL -->
<div id="manualProductsSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product</h4>
            </div>

            <div class="modal-body" id="manual_product_settings_body" style="max-height: 500px; overflow: auto">
            </div>
        </div>
    </div>
</div>

<!-- MANUAL PRODUCTS MODAL -->
<div id="manualProductsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product</h4>
            </div>

            <div class="modal-body" id="manual_product_body" style="max-height: 500px; overflow: auto">
            </div>
        </div>
    </div>
</div>


<!-- MANUAL PRODUCTS SETTINGS MODAL -->
<div id="manualProductSettingsModal" class="modal fade" role="dialog" style="z-index: 99999">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product Settings</h4>
            </div>

            <div class="modal-body" id="manual_product_settings_body" data-product-id="">

                <form id="frm_manual_product_settings" class="form-horizontal">


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Display price as:</label>
                                <input type="text" name="price_as" value="" class="form-control"/>
                            </div>

                            <div class="col-md-6">
                                <label for="">Price text color:</label>
                                <input type="text" name="price_color" value="" class="form-control color-settings"/>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_save_manual_product_choose_setting" class="btn btn-primary"> Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- SINGLE IMAGE SETTINGS MODAL -->
<div id="singleImgaeSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Image Settings</h4>
            </div>

            <div class="modal-body" id="single_image_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="ImageSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_single_image_settings" id="settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <form id="frm_single_image_settings" class="form-horizontal">
                        <div id="myImageSettingContent" class="tab-content">

                            <div role="tabpanel" class="tab-pane fade active in" id="tab_single_image_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_path" name="path" aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">ALT Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alt_text" name="alt_text"
                                               placeholder="Enter ALT text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="rows clearfix element-setting-control">
                                        <div class="col-md-3">
                                            <label class="control-label" for="image_gallery_width">Width (%):</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="control-container">
                                                <div class="slider width-percent-slider"></div>
                                                <input type="text" name="image_gallery_width" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="height">Height:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control" id="image_gallery_height"
                                               name="image_gallery_height" placeholder="Enter width" value="">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="image_setting_align"
                                                id="image_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_show_additionals">Show
                                        Additional
                                        Images:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="checkbox" class="form-control" id="image_show_additionals"
                                               name="image_show_additionals">

                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_themes" aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_padding_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_padding_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="image_padding_right" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_margin_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_margin_bottom" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_margin_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_margin_right" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_border_style">Border
                                                    Style:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <select class="form-control text-normal" name="image_border_style"
                                                            id="image_border_style">
                                                        <option value="none">None</option>
                                                        <option value="dotted">Dotted</option>
                                                        <option value="dashed">Dashed</option>
                                                        <option value="solid">Solid</option>
                                                        <option value="double">Double</option>
                                                        <option value="groove">Groove</option>
                                                        <option value="ridge">Ridge</option>
                                                        <option value="inset">Inset</option>
                                                        <option value="outset">Outset</option>
                                                        <option value="hidden">Hidden</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_border_color">Border
                                                    Color:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <input type="text" class="form-control text-normal"
                                                           id="image_border_color"
                                                           name="image_border_color"
                                                           placeholder="Border color" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_border_size">Border
                                                    Size:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_border_size" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_border_radius">Border
                                                    Radius:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_border_radius" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_shadow_type">Shadow
                                                    type:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <select class="form-control text-normal" name="image_shadow_type"
                                                            id="image_shadow_type">
                                                        <option value="outset">Outset</option>
                                                        <option value="inset">Inset</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_shadow_x_offset">Shadow X
                                                    Offset:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_shadow_x_offset"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_shadow_y_offset">Shadow Y
                                                    Offset:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_shadow_y_offset"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_shadow_blur">Shadow
                                                    Blur:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="image_shadow_blur" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="image_shadow_color">Shadow
                                                    Color</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <input type="text" class="form-control text-normal"
                                                           id="image_shadow_color"
                                                           name="image_shadow_color"
                                                           placeholder="Border radius" value="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="single_image_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SOCIAL SHARE SETTINGS MODAL -->
<div id="socialShareSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="social_share_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_social_share_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="social_url">Share URL:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_url" name="social_url"
                                               placeholder="Enter social URL" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="twitter_title">Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_share_title"
                                               name="social_share_title" placeholder="Enter title" value=""/>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_themes" aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles
                                vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="social_share_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PRICE TABLE SETTINGS MODAL -->
<div id="pricingSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pricing Table</h4>
            </div>

            <div class="modal-body" id="pricing_table_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="pricingTableTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#pricing_settings_tab_settings" id="pricing-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#pricing_tab_themes" role="tab" id="pricing-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <form id="frm_pricing_table_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="pricing_settings_tab_settings"
                                 aria-labelledby="settings-tab">

                                <div class="form-group">
                                    <!--<label class="control-label col-sm-3" for="bg_color">Video Embed:</label>-->
                                    <textarea name="pricing_table_html" id="pricing_table_html"
                                              class="form-control html-editor"></textarea>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="pricing_tab_themes"
                                 aria-labelledby="home-tab">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                    stumptown aliqua, retro synth master cleanse. Mustache cliche tempor,
                                    williamsburg
                                    carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                    synth. Cosby sweater eu banh mi, qui irure terr.</p>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="pricing_table_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SELECTBOX SETTINGS MODAL -->
<div id="selectSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="select_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="selectBoxTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#selectbox_tab_settings" id="selectbox-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#selectbox_tab_themes" role="tab" id="selectbox-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="selectbox_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_select_box_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Embed:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_options" id="select_options">
                                            <option value="">No Set</option>
                                            <option value="all_countries">All Countries</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="selectbox_tab_themes"
                             aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles
                                vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="select_box_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ICON LIST SETTINGS MODAL
    <div id="iconListSettingsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Settings</h4>
                </div>

                <div class="modal-body" id="icon_list_settings_body">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#icon_list_tab_settings" id="icon-list-settings-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">Settings</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#icon_list_tab_themes" role="tab" id="icon-list-themes-tab" data-toggle="tab"
                                   aria-expanded="false">Themes</a>
                            </li>
                        </ul>

                        <form id="frm_icon_list_settings" class="form-horizontal">
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="icon_list_tab_settings"
                                     aria-labelledby="home-tab">


                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="button_text">text Align:</label>
                                        <div class="col-sm-9">
                                            <select name="alignment_type" id="alignment_type" class="form-control">
                                                <option value="center">Center</option>
                                                <option value="left"> Left</option>
                                                <option value="right"> Right</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="text_color">Icon:</label>
                                        <div class="col-sm-9">
                                            <div class="icon-package-list">
                                                <ul class="icons"></ul>
                                                <input type="hidden" name="hid_icon_list_class" id="hid_icon_class"/>
                                                <input type="hidden" name="hid_icon_list_code" id="hid_icon_code"/>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="icon_list_tab_themes"
                                     aria-labelledby="home-tab">
                                    <div class="list-icon-items">
                                        <div class="row">
                                            <textarea class="html-editor" rows="5" name="icon_list_text"
                                                      id="icon_list_text"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="icon_list_setting_save"> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->


<!-- IMAGE LIST -->
<div id="imageListSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Image List Settings</h4>
            </div>

            <div class="modal-body" id="icon_list_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#image_list_tab_image_text" id="image-list-icon-text-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Image and Text</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#image_list_tab_settings" role="tab" id="image-list-settings-tab" data-toggle="tab"
                               aria-expanded="false">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#image_list_tab_themes" role="tab" id="image-list-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_image_list_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="image_list_tab_image_text"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_list_image">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_list_image_path" name="path"
                                                   aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group">
                                    <label class="control-label" for="image_text_paragraph_text">Text:</label>
                                    <textarea class="html-editor" id="image_text_paragraph_text" rows="5"
                                              name="image_text_paragraph_text"></textarea>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="image_list_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_list_font_weight">Font
                                        Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="image_list_font_weight" id="image_list_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_list_image_size">Image
                                        Size:</label>
                                    <div class="col-sm-9">
                                        <select name="image_list_image_size" id="image_list_image_size"
                                                class="form-control">
                                            <option value="auto">Auto</option>
                                            <option value="contain">Contain</option>
                                            <option value="cover">Cover</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_text_size">Text Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_text_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_image_text_gap">Image Text
                                                Gap:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_image_text_gap"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="image_list_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="image_list_text_color"
                                               name="image_list_text_color" placeholder="Enter border color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="image_list_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="list-image-items">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="image_list_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="image_list_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_list_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="image_list_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="image_list_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="image_list_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="image_list_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="iconListSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Icon List Settings</h4>
            </div>

            <div class="modal-body" id="icon_list_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_list_tab_icon_text" id="icon-list-icon-text-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Icon and Text</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_list_tab_settings" role="tab" id="icon-list-settings-tab" data-toggle="tab"
                               aria-expanded="false">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_list_tab_themes" role="tab" id="icon-list-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_icon_list_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_list_tab_icon_text"
                                 aria-labelledby="home-tab">

                                <div class="form-group clearfix">
                                    <label class="control-label col-sm-3" for="icon_list_icon">Icon:</label>
                                    <div class="col-sm-9 text-right">
                                        <button id="icon-picker-button" type="button" class="btn btn-default btn-lg"
                                                data-icon="fa-check" data-iconset="fontawesome" role="iconpicker">
                                            ss
                                        </button>
                                        <input type="hidden" name="hid_selected_icon" value="fa-check">
                                    </div>
                                </div>

                                <hr/>

                                <h4>Texts</h4>
                                <div class="repeat-icon-list">
                                    <div class="form-group">
                                        <input type="text" name="list_text" class="form-control"/>
                                    </div>
                                </div>

                                <button type="button" id="icon_list_add_item"
                                        class="btn btn-normal-success btn-success pull-right"><i class="fa fa-plus"
                                                                                                 aria-hidden="true"></i>
                                    Add more
                                </button>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_list_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_list_font_weight">Font
                                        Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="icon_list_font_weight" id="icon_list_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_icon_text_gap">Icon Text
                                                Gap:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_icon_text_gap"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_icon_size">Icon Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_icon_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_text_size">Text Size:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_text_size"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_list_icon_color">Icon Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_list_icon_color"
                                               name="icon_list_icon_color" placeholder="Enter border color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_list_text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_list_text_color"
                                               name="icon_list_text_color" placeholder="Enter border color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_list_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="list-icon-items">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="icon_list_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_list_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_list_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_list_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="icon_list_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="icon_list_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_list_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- VIDEO SETTINGS MODAL -->
<div id="embedVideoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="embed_video_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="videoSettingsTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#video_tab_settings" id="video-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#video_tab_themes" role="tab" id="video-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_embaded_video_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="video_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Type:</label>
                                    <div class="col-sm-9">
                                        <select name="video_type" id="video_type" class="form-control">
                                            <option value="youtube">Youtube</option>
                                            <option value="vimo">Vimo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Embed:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_embed" name="video_embed"
                                               placeholder="Enter video html" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Autoplay:</label>
                                    <div class="col-sm-9">
                                        <select name="video_autoplay" id="video_autoplay" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Controls:</label>
                                    <div class="col-sm-9">
                                        <select name="video_controls" id="video_controls" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Branding:</label>
                                    <div class="col-sm-9">
                                        <select name="video_branding" id="video_branding" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Width:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_width" name="video_width"
                                               placeholder="PX" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="video_height">Height:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_height"
                                               name="video_height"
                                               placeholder="Enter video html" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="embaded_video_image">Background
                                        Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="embaded_video_image" name="embaded_video_image"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Border</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="embaded_video_border_style">Style:</label>
                                            <div class="col-sm-9">
                                                <select name="embaded_video_border_style"
                                                        id="embaded_video_border_style" class="form-control">
                                                    <option value="">None</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="dotted">Dotted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="embaded_video_border_size">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="embaded_video_border_size" id="embaded_video_border_size"
                                                        class="form-control">
                                                    <option value="1px">1px</option>
                                                    <option value="2px">2px</option>
                                                    <option value="3px">3px</option>
                                                    <option value="5px">5px</option>
                                                    <option value="10px">10px</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="embaded_video_border_color">Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="embaded_video_border_color"
                                                       name="embaded_video_border_color"
                                                       placeholder="Enter border color" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="video_tab_themes" aria-labelledby="home-tab">
                                <div class="col-md-12">

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="embaded_video_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="embaded_video_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_padding_bottom">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="embaded_video_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="embaded_video_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="embaded_video_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="embaded_video_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_margin_bottom">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="embaded_video_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="embaded_video_margin_bottom">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="embaded_video_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="embed_videos_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ICON SETTINGS MODAL -->
<div id="iconSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="icon_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_tab_settings" id="icon-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_tab_themes" role="tab" id="icon-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_icon_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">text Align:</label>
                                    <div class="col-sm-9">
                                        <select name="alignment_type" id="alignment_type" class="form-control">
                                            <option value="center">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_color">Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_color"
                                               name="icon_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Icon:</label>
                                    <div class="col-sm-9">
                                        <div class="icon-package-list">
                                            <ul class="icons"></ul>
                                            <input type="hidden" name="hid_icon_class" id="hid_icon_class"/>
                                            <input type="hidden" name="hid_icon_code" id="hid_icon_code"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="icon_padding_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="icon_padding_bottom" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="icon_padding_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="icon_padding_right" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_margin_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_margin_bottom" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_margin_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_margin_right" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_border_style">Border
                                                    Style:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <select class="form-control select-normal" name="icon_border_style"
                                                            id="icon_border_style">
                                                        <option value="none">None</option>
                                                        <option value="dotted">Dotted</option>
                                                        <option value="dashed">Dashed</option>
                                                        <option value="solid">Solid</option>
                                                        <option value="double">Double</option>
                                                        <option value="groove">Groove</option>
                                                        <option value="ridge">Ridge</option>
                                                        <option value="inset">Inset</option>
                                                        <option value="outset">Outset</option>
                                                        <option value="hidden">Hidden</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_border_color">Border
                                                    Color:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <input type="text" class="form-control text-normal"
                                                           id="icon_border_color"
                                                           name="icon_border_color"
                                                           placeholder="PX" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_border_size">Border
                                                    Size:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_border_size" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="icon_border_radius">Border
                                                    Radius:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="icon_border_radius" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SEPERATOR SETTINGS MODAL -->
<div id="seperatorSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="seperator_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="seperatorSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#seperator_tab_settings" id="seperator-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#seperator_tab_themes" role="tab" id="seperator-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_seperator_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="seperator_tab_settings"
                                 aria-labelledby="home-tab">


                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_color">Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="seperator_color"
                                               name="seperator_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>-->


                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Border</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="seperator_border_style">Style:</label>
                                            <div class="col-sm-9">
                                                <select name="seperator_border_style" id="seperator_border_style"
                                                        class="form-control">
                                                    <option value="">None</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="dotted">Dotted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="seperator_border_size">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="seperator_border_size" id="seperator_border_size"
                                                        class="form-control">
                                                    <option value="1px">1px</option>
                                                    <option value="2px">2px</option>
                                                    <option value="3px">3px</option>
                                                    <option value="5px">5px</option>
                                                    <option value="10px">10px</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="seperator_border_color">Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="seperator_border_color"
                                                       name="seperator_border_color" placeholder="Enter border color"
                                                       value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="seperator_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="seperator_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="seperator_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="seperator_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="seperator_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PARAGRAPH SETTINGS MODAL -->
<div id="paragraphSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="paragraph_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="paragraphSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#paragraph_tab_settings" id="paragraph-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#paragraph_tab_themes" role="tab" id="paragraph-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_paragraph_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="paragraph_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label" for="paragraph_text">Paragraph Text:</label>
                                    <textarea class="html-editor" id="paragraph_text" rows="5"
                                              name="paragraph_text"></textarea>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="paragraph_text_font_family">Font
                                        Family:</label>
                                    <div class="col-sm-9">
                                        <select name="paragraph_text_font_family" id="paragraph_text_font_family"
                                                class="form-control font-family-chooser">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-6">
                                        <label class="control-label" for="paragraph_text_color">Text Color:</label>
                                        <input type="text" class="form-control color-settings" id="paragraph_text_color"
                                               name="paragraph_text_color" placeholder="Enter text color" value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label" for="paragraph_bg_color">Background Color:</label>
                                        <input type="text" class="form-control color-settings" id="paragraph_bg_color"
                                               name="paragraph_bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="paragraph_line_height">Line Height:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="paragraph_line_height"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="paragraph_alignment">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="paragraph_alignment" id="paragraph_alignment"
                                                class="form-control">
                                            <option value="center">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="paragraph_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="paragraph_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="paragraph_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="paragraph_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="paragraph_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="paragraph_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="paragraph_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="paragraph_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="paragraph_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="paragraph_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="paragraph_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paragraph_shadow_size">Shadow
                                                    Size:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="paragraph_shadow_size"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="paragraph_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SUB HEADLINE SETTINGS MODAL -->
<div id="subHeadlineSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sub Headline Settings</h4>
            </div>

            <div class="modal-body" id="sub-headlinesettings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="subHeadlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#sub_headline_tab_settings" id="sub-headline-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#sub_headline_tab_themes" role="tab" id="sub-headline-themes-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_sub_headline_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="sub_headline_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label" for="sub_headline_text">Sub Headline
                                        Text:</label>
                                    <div class="editor-container">
                                        <!--<input type="text" class="form-control" id="sub_headline_text"
                                               name="sub_headline_text" placeholder="Enter headline text" value=""/>-->
                                        <textarea class="html-editor" id="sub_headline_text" rows="5"
                                                  name="sub_headline_text"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_text_font_family">Font
                                        Family:</label>
                                    <div class="col-sm-9">
                                        <select name="sub_headline_text_font_family" id="sub_headline_text_font_family"
                                                class="form-control font-family-chooser">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="sub_headline_setting_align" id="sub_headline_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_font_weight">Font
                                        Weight:</label>
                                    <div class="col-sm-9">
                                        <select name="sub_headline_font_weight" id="sub_headline_font_weight"
                                                class="form-control">
                                            <option value="">Choose</option>
                                            <?php for ( $i = 100; $i <= 900; $i += 100 ) { ?>
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="sub_headline_text_color"
                                               name="sub_headline_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="sub_headline_bg_color"
                                               name="sub_headline_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="sub_headline_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="sub_headline_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="sub_headline_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="sub_headline_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="sub_headline_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="sub_headline_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="sub_headline_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="sub_headline_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="sub_headline_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="sub_headline_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="sub_headline_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="sub_headline_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_padding_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="sub_headline_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="sub_headline_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="sub_headline_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="sub_headline_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HEADLINE SETTINGS MODAL -->
<div id="headlineSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="headline_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#headline_tab_settings" id="headline-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#headline_tab_themes" role="tab" id="headline-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_headline_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="headline_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label" for="headline_text">Headline Text:</label>
                                    <div class="editor-content">
                                        <!--<input type="text" class="form-control" id="headline_text"
                                               name="headline_text"
                                               placeholder="Enter headline text" value=""/>-->
                                        <textarea class="html-editor" id="headline_text" rows="5"
                                                  name="headline_text"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="headline_setting_align" id="headline_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text_font-family">Font
                                        Family:</label>
                                    <div class="col-sm-9">
                                        <select name="headline_text_font" id="headline_text_font"
                                                class="form-control font-family-chooser">

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="headline_text_color"
                                               name="headline_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group row clearfix">
                                    <label class="control-label col-sm-3" for="main_headline_bg_color">BG Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="main_headline_bg_color"
                                               name="main_headline_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="headline_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="headline_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="headline_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="headline_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="headline_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="headline_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="headline_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="headline_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="headline_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="headline_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_margin_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="headline_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SHADOW -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="headline_shadow_size">Shadow
                                                        Size:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="headline_shadow_size"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="headline_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- PRODUCT AVAILABLE SETTINGS MODAL -->
<div id="productAvailableSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Avaibility Settings</h4>
            </div>

            <div class="modal-body" id="headline_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="productAvailabelSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#product_aval_tab_settings" id="product-availability-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#product_aval_tab_advance" role="tab" id="product-availability-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_product_availabel_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="product_aval_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="product_availabel_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="product_availabel_align" id="product_availabel_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="product_availabel_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="product_availabel_text_color"
                                               name="product_availabel_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="product_aval_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_padding_top">Padding
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_availabel_padding_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_padding_bottom">Padding
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_availabel_padding_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_padding_bottom">Padding
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_availabel_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_padding_bottom">Padding
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="product_availabel_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MARGIN -->
                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_margin_top">Margin
                                                        Top:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_availabel_margin_top"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_margin_bottom">Margin
                                                        Bottom:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_availabel_margin_bottom"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_margin_bottom">Margin
                                                        Left:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_availabel_padding_left"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="product_availabel_padding_bottom">Margin
                                                        Right:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider margin-slider"></div>
                                                        <input type="text" name="product_availabel_padding_right"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="product_availabel_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- GRID 1 SETTINGS MODAL -->
<div id="gridOneSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Grid Settings</h4>
            </div>

            <div class="modal-body" id="grid_one_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="gOneTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#gone_tab_settings" id="gone-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#gone_tab_advance" role="tab" id="gone-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="grid_one_row_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="gone_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_setting_section_id">Section
                                        ID:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="grid_one_setting_section_id"
                                               name="grid_one_setting_section_id" placeholder="Enter section ID"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="grid_one_text_color"
                                               name="grid_one_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="grid_one_bg_color"
                                               name="grid_one_bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_container_bg_color">Containers
                                        BG Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="grid_one_container_bg_color"
                                               name="grid_one_container_bg_color"
                                               placeholder="Enter Inner item background color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_container_bg_opacity">Containers
                                        BG Opacity:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="grid_one_container_bg_opacity"
                                               name="grid_one_container_bg_opacity"
                                               placeholder="Enter Inner item background opacity" value=""/>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_border_type">Border:</label>
                                    <div class="col-sm-9">
                                        <select name="grid_one_border_type" id="grid_one_border_type" class="form-control">
                                            <option value="none">None</option>
                                            <option value="full">Full Border</option>
                                            <option value="bottom">Bottom Only</option>
                                            <option value="top">Top Only</option>
                                            <option value="top_bottom">Top and Bottom</option>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_bg_image">Background
                                        Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="grid_one_bg_image" name="grid_one_bg_image"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="grid_one_image_position">Background
                                        Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">


                                        <select name="grid_one_image_position"
                                                id="grid_one_image_position" class="form-control">
                                            <option value="bgCover">Full Center Fit</option>
                                            <option value="bgCover100">Fill 100% Width</option>
                                            <option value="bgNoRepeat">No Repeat</option>
                                            <option value="bgRepeat">Repeat</option>
                                            <option value="bgRepeatX">Repeat Hortizontally</option>
                                            <option value="bgRepeatY">Repeat Vertically</option>
                                            <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                            <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="modal-setting-section-header modal-setting-section-box">
                                    <div class="header">Border</div>
                                    <div class="border-realted_properties">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="grid_one_border_style">Style:</label>
                                            <div class="col-sm-9">
                                                <select name="grid_one_border_style" id="grid_one_border_style"
                                                        class="form-control">
                                                    <option value="">None</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="dotted">Dotted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="grid_one_border_size">Size:</label>
                                            <div class="col-sm-9">
                                                <select name="grid_one_border_size" id="grid_one_border_size"
                                                        class="form-control">
                                                    <option value="1px">1px</option>
                                                    <option value="2px">2px</option>
                                                    <option value="3px">3px</option>
                                                    <option value="5px">5px</option>
                                                    <option value="10px">10px</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3"
                                                   for="grid_one_border_color">Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control color-settings"
                                                       id="grid_one_border_color"
                                                       name="grid_one_border_color" placeholder="Enter border color"
                                                       value=""/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="rows clearfix element-setting-control">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="grid_one_border_radius">Border Radius:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="control-container">
                                                        <div class="slider padding-slider"></div>
                                                        <input type="text" name="grid_one_border_radius" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="grid_one_border_apply_for">Apply
                                                For:</label>
                                            <div class="col-sm-9">
                                                <select name="grid_one_border_apply_for" id="grid_one_border_apply_for"
                                                        class="form-control">
                                                    <option value="main">Main Container</option>
                                                    <option value="inner">Inner Containers</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="gone_tab_advance" aria-labelledby="home-tab">
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_padding_top">Padding
                                            Top:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="grid_setting_padding_top" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_padding_bottom">Padding
                                            Bottom:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="grid_setting_padding_bottom" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_padding_right">Padding
                                            Right:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="grid_setting_padding_right" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_padding_left">Padding
                                            Left:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="grid_setting_padding_left" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_margin_top">Margin
                                            Top:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="grid_setting_margin_top" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_margin_bottom">Margin
                                            Bottom:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="grid_setting_margin_bottom" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="grid_setting_shadow">Shadow:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider margin-slider"></div>
                                            <input type="text" name="grid_setting_shadow" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="grid_one_setting_save"> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- GRID 2 SETTINGS MODAL -->
<div id="gridTwoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Grid</h4>
            </div>

            <div class="modal-body" id="grid_one_settings_body">
                <form id="grid_two_row_settings" class="form-horizontal">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="hgTwoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#gtwo_tab_settings" id="gtwo-settings-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">Settings</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#gtwo_tab_themes" role="tab" id="gtwo-themes-tab" data-toggle="tab"
                                   aria-expanded="false">Themes</a>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="gtwo_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="gtwo_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Padding :</label>
                                    <div class="col-sm-9 range-slider">
                                        <input class="range-slider__range" name="grid2_setting_padding" type="range"
                                               value="15px" min="0" max="50">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="grid_two_setting_save"> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- HEADER ROW SETTINGS MODAL -->
<div id="headerRowSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Header Row Settings</h4>
            </div>

            <div class="modal-body" id="row_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="rowSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#header_row_tab_settings" id="row-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#header_row_tab_advance" role="tab" id="row-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_header_row_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="header_row_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_type">Row Type:</label>
                                    <div class="col-sm-9">
                                        <select name="header_row_type" id="header_row_type" class="form-control">
                                            <option value="">Medium</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="header_row_text_color"
                                               name="header_row_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="header_row_bg_color"
                                               name="header_row_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_background">Background
                                        Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="header_row_setting_image_path"
                                                   name="header_row_setting_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_background_image_position">Background
                                        Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">


                                        <select name="header_row_background_image_position"
                                                id="header_row_background_image_position" class="form-control">
                                            <option value="bgCover">Full Center Fit</option>
                                            <option value="bgCover100">Fill 100% Width</option>
                                            <option value="bgNoRepeat">No Repeat</option>
                                            <option value="bgRepeat">Repeat</option>
                                            <option value="bgRepeatX">Repeat Hortizontally</option>
                                            <option value="bgRepeatY">Repeat Vertically</option>
                                            <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                            <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="header_row_tab_advance"
                                 aria-labelledby="home-tab">
                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3" for="header_row_setting_padding">Padding:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="header_row_setting_padding"
                                               name="row_setting_padding" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>-->


                                <div class="clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="header_row_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="header_row_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_padding_left">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="header_row_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_padding_right">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="header_row_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="header_row_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="header_row_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_margin_left">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="header_row_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="header_row_margin_right">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="header_row_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="header_row_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ROW SETTINGS MODAL -->
<div id="rowSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Row Settings</h4>
            </div>

            <div class="modal-body" id="row_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="rowSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#row_tab_settings" id="row-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#row_settings_tab_advance" role="tab" id="row-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_row_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="row_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Row Type:</label>
                                    <div class="col-sm-9">
                                        <select name="row_type" id="row_type" class="form-control">
                                            <option value="">Medium</option>
                                            <option value="small">Small</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_setting_content_width">Content
                                        Width:</label>
                                    <div class="col-sm-9">
                                        <select name="row_setting_content_width" id="row_setting_content_width"
                                                class="form-control">
                                            <option value="full">Full Width</option>
                                            <option value="fixed">Fixed Width</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_setting_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="row_setting_text_color"
                                               name="row_setting_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_setting_bg_opacity">BG
                                        Opacity:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="row_setting_bg_opacity"
                                               name="row_setting_bg_opacity"
                                               placeholder="Enter background opacity" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_setting_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="row_setting_bg_color"
                                               name="row_setting_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Background
                                        Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="row_setting_image_path" name="row_setting_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_background_image_position">Background
                                        Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">


                                        <select name="row_background_image_position"
                                                id="row_background_image_position" class="form-control">
                                            <option value="bgCover">Full Center Fit</option>
                                            <option value="bgCover100">Fill 100% Width</option>
                                            <option value="bgNoRepeat">No Repeat</option>
                                            <option value="bgRepeat">Repeat</option>
                                            <option value="bgRepeatX">Repeat Hortizontally</option>
                                            <option value="bgRepeatY">Repeat Vertically</option>
                                            <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                            <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="row_settings_tab_advance"
                                 aria-labelledby="home-tab">

                                <div class="clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="row_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="row_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_padding_left">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="row_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_padding_right">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="row_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- BORDER -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_setting_border_style">Border
                                                    Style:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <select class="form-control text-normal"
                                                            name="row_setting_border_style"
                                                            id="row_setting_border_style">
                                                        <option value="none">None</option>
                                                        <option value="dotted">Dotted</option>
                                                        <option value="dashed">Dashed</option>
                                                        <option value="solid">Solid</option>
                                                        <option value="double">Double</option>
                                                        <option value="groove">Groove</option>
                                                        <option value="ridge">Ridge</option>
                                                        <option value="inset">Inset</option>
                                                        <option value="outset">Outset</option>
                                                        <option value="hidden">Hidden</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_setting_border_color">Border
                                                    Color:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <input type="text" class="form-control text-normal"
                                                           id="row_setting_border_color"
                                                           name="row_setting_border_color"
                                                           placeholder="Border color" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_setting_border_size">Border
                                                    Size:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="row_setting_border_size"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="row_setting_border_radius">Border
                                                    Radius:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="row_setting_border_radius"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /BORDER -->


                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="row_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ADVANCE BUTTON SETTINGS MODAL -->
<div id="advanceButtonSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Button Settings</h4>
            </div>

            <div class="modal-body" id="button_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="buttonSettingsTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#advance_button_tab_product" id="advance-button-items-product" role="tab"
                               data-toggle="tab" aria-expanded="true">Product</a>
                        </li>
                        <li role="presentation">
                            <a href="#advance_button_tab_settings" id="button-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#advance_button_tab_advance" role="tab" id="button-advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_advance_button_settings" class="form-horizontal" data-load-poduct-action="#">

                            <div role="tabpanel" class="tab-pane fade active in" id="advance_button_tab_product"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_add_product">Choose
                                        product:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="advance_button_add_product"
                                                name="advance_button_add_product">
                                        </select>
                                    </div>
                                </div>
                                <div class="" id="advance_button_variant_container">
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="advance_button_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_text">Main Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="advance_button_text"
                                               name="advance_button_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_secondary_text">Secondery
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="advance_button_secondary_text"
                                               name="advance_button_secondary_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_type">Button Type:</label>
                                    <div class="col-sm-9">
                                        <select name="advance_button_type" id="advance_button_type"
                                                class="form-control">
                                            <option value="">Default</option>
                                            <option value="full"> Full Width</option>
                                            <option value="large">Large</option>
                                            <option value="full_large">Full width and larges</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_style">Button
                                        Style:</label>
                                    <div class="col-sm-9">
                                        <select name="advance_button_style" id="advance_button_style"
                                                class="form-control">
                                            <option value="">Default</option>
                                            <option value="transparent"> Transparent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="advance_button_alignment">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="advance_button_alignment" id="advance_button_alignment"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="center"> Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_text_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="advance_button_text_color"
                                               name="advance_button_text_color" placeholder="Enter text color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="advance_button_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="advance_button_bg_color"
                                               name="advance_button_bg_color" placeholder="Enter background color"
                                               value=""/>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="advance_button_font_size">Font Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="advance_button_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="advance_button_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="advance_buttonbutton_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_buttonbutton_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="advance_buttonbutton_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_padding_left">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="advance_button_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="advance_button_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="advance_button_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="advance_button_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="advance_button_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="advance_button_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="advance_button_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="advance_button_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- BUTTON SETTINGS MODAL -->
<div id="buttonSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Button Settings</h4>
            </div>

            <div class="modal-body" id="button_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="buttonSettingsTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#button_tab_settings" id="button-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#button_tab_advance" role="tab" id="button-advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_button_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="button_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_action">Button Action:</label>
                                    <div class="col-sm-9">
                                        <select name="button_action" class="form-control" id="button_action">
                                            <option value="">No Action</option>
                                            <option value="next_step">Go To Next Step In Funnel</option>
                                            <option value="skip_step">Skip Steps(Upsell/Downsell)</option>
                                            <option value="open_modal">Open The Pop Up</option>
                                            <option value="goto_section">Scroll To Row</option>
                                            <option value="goto_link">Go To Link</option>
                                            <option value="integration_data">Submit To Mail Server</option>
                                            <option value="submit"> Submit Payment / Upsell / Downsell</option>
                                        </select>
                                        <input type="hidden" name="step_next_url" value=""/>
                                        <input type="hidden" name="step_skip_url" value=""/>
                                    </div>
                                </div>

                                <div class="" id="button_settings_goto_link" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"
                                               for="button_setting_goto_link_url">URL:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="button_setting_goto_link_url"
                                                   name="button_setting_goto_link_url"
                                                   placeholder="Enter URL"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="button_setting_goto_link_behaviour">URL
                                            Open In:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="button_setting_goto_link_behaviour"
                                                    name="button_setting_goto_link_behaviour">
                                                <option value="same_tab">Same Tab</option>
                                                <option value="other_tab">Other Tab</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="integration_data_section">
                                    <label class="control-label col-sm-3" for="integration_data_behaviour">After
                                        Process:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="integration_data_behaviour"
                                                name="integration_data_behaviour">
                                            <option value="redirect_next">Redirect To Next Page</option>
                                            <option value="same_page">Stay on Same Page</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="video_url_textbox">
                                    <label class="control-label col-sm-3" for="button_text">Video URL:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_url" name="video_url"
                                               placeholder="Enter video URL" value=""/>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="button_open_section_id">
                                    <label class="control-label col-sm-3" for="button_section_id">Section ID:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="button_section_id"
                                               name="button_section_id"
                                               placeholder="Enter section ID" value=""/>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="button_open_section_toggle_id">
                                    <label class="control-label col-sm-3" for="button_section_toggle_id">Section Toggle
                                        ID:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="button_section_toggle_id"
                                               name="button_section_toggle_id"
                                               placeholder="Enter section ID" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">Button Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="button_text" name="button_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="simple_button_secondary_text">Secondery
                                        Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="simple_button_secondary_text"
                                               name="simple_button_secondary_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">Button Type:</label>
                                    <div class="col-sm-9">
                                        <select name="button_type" id="button_type" class="form-control">
                                            <option value="">Default</option>
                                            <option value="full"> Full Width</option>
                                            <option value="large">Large</option>
                                            <option value="full_large">Full width and larges</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_style">Button Style:</label>
                                    <div class="col-sm-9">
                                        <select name="button_style" id="button_style" class="form-control">
                                            <option value="">Default</option>
                                            <option value="transparent"> Transparent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_alignment">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="button_alignment" id="button_alignment"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="center"> Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="button_text_color"
                                               name="button_text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="button_bg_color"
                                               name="button_bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-3">
                                            <label class="control-label" for="button_font_size">Font Size:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="button_font_size" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-3">
                                        <label class="control-label" for="button_secondary_font_size">Secondary Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="button_secondary_font_size" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="button_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Icon Pack:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="button_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="modal-setting-section-header modal-setting-section-box">
                                            <div class="header">Icon Setting</div>
                                            <div class="border-realted_properties">



                                                <div class="form-group">
                                                    <label class="control-label col-sm-12"
                                                           for="button_icon_position">
                                                        <input type="checkbox" name="button_enable_icon" id="button_enable_icon">
                                                        &nbsp;&nbsp;Show Icon:
                                                    </label>
                                                </div>

                                                <div class="form-group clearfix">
                                                    <label class="control-label col-sm-3" for="button_icon">Icon:</label>
                                                    <div class="col-sm-9 text-right">
                                                        <button class="icon-picker-button" type="button" class="btn btn-default btn-lg"
                                                                data-icon="fa-check" data-iconset="fontawesome" role="iconpicker">
                                                            ss
                                                        </button>
                                                        <input type="hidden" name="hid_selected_icon" value="fa-check">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-3"
                                                           for="button_icon_position">Icon Position:</label>
                                                    <div class="col-sm-9">
                                                        <select name="button_icon_position" id="button_icon_position"
                                                                class="form-control">
                                                            <option value="">Left</option>
                                                            <option value="left" selected="selected">Left</option>
                                                            <option value="right">Right</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group">
                                                    <label class="control-label col-sm-3"
                                                           for="button_icon_color">Icon Color:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control color-settings"
                                                               id="button_icon_color"
                                                               name="button_icon_color" placeholder="Icon color"
                                                               value=""/>
                                                    </div>
                                                </div>-->

                                                <div class="form-group element-setting-control">
                                                    <div class="col-md-4">
                                                        <label class="control-label" for="button_icon_size">Icon Size:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="control-container">
                                                            <div class="slider padding-slider"></div>
                                                            <input type="text" name="button_icon_size" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="button_padding_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="button_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="headline_padding_bottom">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="button_padding_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="button_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="button_margin_top" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="button_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_margin_bottom">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="button_margin_left" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_margin_bottom">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="button_margin_right" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="button_border_radius">Border Radius:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="button_border_radius" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="button_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- TEXT BLOCK SETTINGS -->
<div id="textBlockSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Text Block Settings</h4>
            </div>

            <div class="modal-body" id="text_block_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="textblocSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#text_block_tab_settings" id="text-block-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#text_block_tab_themes" role="tab" id="text-block-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_text_block_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="text_block_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label" for="textblock_headline_text">Headline
                                        Text:</label>
                                    <input type="text" class="form-control" id="textblock_headline_text"
                                           name="textblock_headline_text" placeholder="Enter headline text"
                                           value=""/>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="textblock_headline_text_color">Headline
                                                Text
                                                Color:</label>
                                            <input type="text" class="form-control color-settings jscolor"
                                                   id="textblock_headline_text_color"
                                                   name="textblock_headline_text_color"
                                                   placeholder="Enter text color" value=""/>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label" for="textblock_paragraph_color">Paragraph
                                                Color:</label>
                                            <input type="text" class="form-control color-settings jscolor"
                                                   id="textblock_paragraph_color" name="textblock_paragraph_color"
                                                   placeholder="headline BG color" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="sub_headline_text">Sub Headline Text:</label>
                                    <br/>
                                    <textarea class="html-editor" id="text_clock_html_editor" rows="5"
                                              name="sub_headline_text"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_block_headline_font_family">Headline Font:</label>
                                    <div class="col-sm-9">
                                        <select name="text_block_headline_font_family" id="text_block_headline_font_family"
                                                class="form-control font-family-chooser">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_block_paragraph_font_family">Paragraph Font:</label>
                                    <div class="col-sm-9">
                                        <select name="text_block_paragraph_font_family" id="text_block_paragraph_font_family"
                                                class="form-control font-family-chooser">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix">
                                        <label class="control-label col-sm-4" for="text_block_setting_align">Headline
                                            Align:</label>
                                        <div class="col-sm-8">
                                            <select name="text_block_setting_align" id="text_block_setting_align"
                                                    class="form-control">
                                                <option value="center">Center</option>
                                                <option value="left">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix">
                                        <label class="control-label col-sm-4" for="text_block_setting_paragraph_align">Paragraph
                                            Align:</label>
                                        <div class="col-sm-8">
                                            <select name="text_block_setting_paragraph_align" id="text_block_setting_paragraph_align"
                                                    class="form-control">
                                                <option value="center">Center</option>
                                                <option value="left">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="text_block_heading_font_size">Heading Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="text_block_heading_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="text_block_paragraph_font_size">Paragraph Font
                                            Size:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="text_block_paragraph_font_size"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix element-setting-control">
                                    <div class="col-md-4">
                                        <label class="control-label" for="text_block_headline_gap">Headline Gap:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-container">
                                            <div class="slider padding-slider"></div>
                                            <input type="text" name="text_block_headline_gap"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="text_block_line_height">Line
                                                Height:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="text_block_line_height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="text_block_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_padding_top">Padding
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_block_padding_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_padding_bottom">Padding
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_block_padding_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_padding_left">Padding
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_block_padding_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_padding_bottom">Padding
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider padding-slider"></div>
                                                    <input type="text" name="text_block_padding_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MARGIN -->
                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_margin_top">Margin
                                                    Top:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_block_margin_top"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_margin_bottom">Margin
                                                    Bottom:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_block_margin_bottom"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_margin_left">Margin
                                                    Left:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_block_margin_left"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix element-setting-control">
                                            <div class="col-md-4">
                                                <label class="control-label" for="text_block_margin_right">Margin
                                                    Right:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="control-container">
                                                    <div class="slider margin-slider"></div>
                                                    <input type="text" name="text_block_margin_right"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="text_block_setting_save"> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- DATE COUNTDOWN SETTINGS MODAL -->
<div id="dateCountdownsSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Date Countdown</h4>
            </div>

            <div class="modal-body" id="date_countdown_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="dateCountdownTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#date_countdown_tab_settings" id="date-countdown-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#date_countdown_tab_advance" role="tab" id="date-countdown-themes-tab"
                               data-toggle="tab" aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_date_countdown_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">

                            <div role="tabpanel" class="tab-pane fade active in" id="date_countdown_tab_settings"
                                 aria-labelledby="home-tab">

                                <form id="frm_date_countdown_settings" class="form-horizontal">

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="end_date">End Date:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datetimepicker date" id="end_date"
                                                   name="end_date" placeholder="Enter date" value=""/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="control-label col-sm-3" for="text_color">End Time:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datetimepicker time" id="end_time"
                                                   name="end_time" placeholder="Enter time" value=""/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3"
                                               for="countdown_settings_after_timer_over_action">After Timer
                                            Over:</label>
                                        <div class="col-sm-9">
                                            <select name="countdown_settings_after_timer_over_action"
                                                    id="countdown_settings_after_timer_over_action"
                                                    class="form-control">
                                                <option value="">None</option>
                                                <option value="go_to_page">Go to Page</option>
                                            </select>

                                            <div class="action_options">
                                                <input type="text" class="form-control"
                                                       id="countdown_settings_action_url"
                                                       name="countdown_settings_action_url"
                                                       placeholder="Enter the page URL" style="display:none"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="date_countdown_timer_color">Timer
                                            Color:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control color-settings"
                                                   id="date_countdown_timer_color"
                                                   name="date_countdown_timer_color" placeholder="Enter Timer color"
                                                   value=""/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="date_countdown_text_color">Text
                                            Color:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control color-settings"
                                                   id="date_countdown_text_color"
                                                   name="date_countdown_text_color" placeholder="Enter text color"
                                                   value=""/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="date_countdown_seperator_color">Seperator
                                            Color:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control color-settings"
                                                   id="date_countdown_seperator_color"
                                                   name="date_countdown_seperator_color"
                                                   placeholder="Enter seperator color" value=""/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="date_countdown_bg_color">BG
                                            Color:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control color-settings"
                                                   id="date_countdown_bg_color"
                                                   name="date_countdown_bg_color" placeholder="Enter background color"
                                                   value=""/>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="date_countdown_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="col-md-12">

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_padding_top">Padding
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="date_countdown_padding_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_padding_bottom">Padding
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="date_countdown_padding_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_padding_left">Padding
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="date_countdown_padding_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_padding_bottom">Padding
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider padding-slider"></div>
                                                <input type="text" name="date_countdown_padding_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MARGIN -->
                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_margin_top">Margin
                                                Top:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="date_countdown_margin_top"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_margin_bottom">Margin
                                                Bottom:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="date_countdown_margin_bottom"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_margin_left">Margin
                                                Left:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="date_countdown_margin_left"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix element-setting-control">
                                        <div class="col-md-4">
                                            <label class="control-label" for="date_countdown_margin_right">Margin
                                                Right:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="control-container">
                                                <div class="slider margin-slider"></div>
                                                <input type="text" name="date_countdown_margin_right"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="date_countdown_setting_save"> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Image Gallery -->
<div id="imageGalleryModal" class="modal modal-wide fade" role="dialog" style="z-index: 999999 !important">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 0px">

                <h4 class="modal-title">
                    Image Gallery

                    <div class="pull-right">
                        <form id="frm_gallery_image_upload" action="{{ route('ajaxImageUpload') }}"
                              enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="image" class="form-control" id="gallery_image_upload_file"
                                   style="display: none;">

                            <ul class="image-gallery-option-buttons">

                                <li style="margin-right: 15px;" id="gallery_image_counter">
                                    <span><small style="color: #ddd;">TOTAL:</small></span>
                                    @if ( $userImages->count() > 196 )
                                        <span style="font-size: 16px"><b
                                                    style="color: #d9534f;">{{ $userImages->count() }}</b> / <b
                                                    style="color: #d9534f;">{{ env('MAX_IMAGE_UPLOAD_LIMIT') }}</b></span>
                                    @elseif ( $userImages->count() > 100 )
                                        <span style="font-size: 16px"><b
                                                    style="color: #eea236;">{{ $userImages->count() }}</b> / <b
                                                    style="color: #d9534f;">{{ env('MAX_IMAGE_UPLOAD_LIMIT') }}</b></span>
                                    @else
                                        <span style="font-size: 16px"><b
                                                    style="color: #eeeeee;">{{ $userImages->count() }}</b> / <b
                                                    style="color: #d9534f;">{{ env('MAX_IMAGE_UPLOAD_LIMIT') }}</b></span>
                                    @endif
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary" id="upload_image_to_gallery"><i
                                                class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image
                                    </button>
                                </li>
                            </ul>

                        </form>
                    </div>
                </h4>

                <?php //print_r($directories); ?>

                <div class="modalFooter clearfix">
                    <a href="javascript:void(0)" data-filter="library" class="btn-imgs btn-imgs-active"
                       style="float:left;"
                       id="showMyImages"><i class="fa fa-photo"></i> <span>Library</span></a>
                    @foreach ( $directories as $key=>$directory )
                    <?php $dir = explode('/', $directory); ?>
                    @if ( strtolower($dir[count($dir) - 1]) != 'library' )
                        <a href="javascript:void(0)" data-filter="{{ $dir[count($dir) - 1] }}" class="btn-imgs"
                           style="float:left;"
                           id="showMyImages"><i class="fa fa-photo"></i>
                            <span>{{ $dir[count($dir) - 1] }}</span></a>
                    @endif


                <!--<a href="#" class="btn-imgs" style="float:left;" id="showBGImages"><i class="fa fa-paint-brush"></i> <span>Background</span></a>
                        <a href="#" class="btn-imgs" style="float:left;" id="showNodoImages"><i class="fa fa-star"></i> <span>Stock</span></a>-->
                    @endforeach

                    <button class="btn btn-normal-warning" id="remove_image_from_gallery" style="margin-top: 10px"><i
                                class="fa fa-trash"></i> Remove Image
                    </button>
                    <button class="btn btn-normal-success" id="add_image_from_gallery" style="margin-top: 10px"><i
                                class="fa fa-plus"></i> Add Image
                    </button>
                    <button type="button" class="btn btn-danger" style="margin-top: 10px" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> Close
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <img src="{{ asset('images/ajax-loader.gif') }}" style="margin: auto"/>
            </div>
        </div>

    </div>
</div>


<!-- MODAL FOR TRACKING CODE -->
<!-- Modal -->
<div id="funnelTrackingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i
                            class="fa fa-bar-chart"></i> &nbsp; Tracking Code</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="dateCountdownTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tracking_header_code" id="tab_tracking_header_code" role="tab"
                               data-toggle="tab" aria-expanded="true">HEADER CODE</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tracking_footer_code" role="tab" id="tab_tracking_footer_code"
                               data-toggle="tab" aria-expanded="false">FOOTER CODE</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_tracking_code" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tracking_header_code"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <textarea class="form-control" rows="10" name="tracking_header_code"
                                              placeholder="Add HTML/JavaScript here...">@if ( !empty($contents->tracking_header) )<?php print_r($contents->tracking_header) ?>@endif</textarea>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tracking_footer_code"
                                 aria-labelledby="home-tab">
                                <textarea class="form-control" rows="10" name="tracking_footer_code"
                                          placeholder="Add HTML/JavaScript here...">@if ( !empty($contents->tracking_footer) )<?php print_r($contents->tracking_footer) ?>@endif</textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_tracking_code"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL FOR TRACKING CODE -->


<!-- MODAL FOR CUSTOM CSS -->
<div id="customCssModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-code"></i> &nbsp; Custom CSS</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_add_page_custom_css_code" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="page_custom_css_code"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <textarea class="form-control css" rows="10" name="page_custom_css_code"
                                              style="min-height:300px;"
                                              placeholder="Add custom CSS here...">@if ( !empty($contents->pagestyle) )<?php print_r($contents->pagestyle) ?>@endif</textarea>

                                    <!--<pre><code class="css"></code></pre>-->
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_page_custom_css_code"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL FOR CUSTOM CSS -->


<!-- MODAL PAGE BACKGROUND -->
<div id="pageBackgroundModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-paint-brush"></i> &nbsp; Background</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_page_background" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_path" name="path" aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i
                                                        class="fa fa-picture-o"
                                                        aria-hidden="true"></i></span>
                                            <span class="input-group-addon remove-image-path"
                                                  id="image_setting_remove_image_path"><i
                                                        class="fa fa-trash-o"
                                                        alt="Remove Image"
                                                        title="Remove Image"
                                                        aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_background_image_position">Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">

                                        @if ( !empty($contents->page_background_image_position) )
                                            <select name="page_background_image_position"
                                                    id="page_background_image_position" class="form-control">
                                                <option value="bgCover" {{ ($contents->page_background_image_position == 'bgCover') ? 'selected' : '' }}>
                                                    Full Center Fit
                                                </option>
                                                <option value="bgCover100" {{ ($contents->page_background_image_position == 'bgCover100') ? 'selected' : '' }}>
                                                    Fill 100% Width
                                                </option>
                                                <option value="bgNoRepeat" {{ ($contents->page_background_image_position == 'bgNoRepeat') ? 'selected' : '' }}>
                                                    No Repeat
                                                </option>
                                                <option value="bgRepeat" {{ ($contents->page_background_image_position == 'bgRepeat') ? 'selected' : '' }}>
                                                    Repeat
                                                </option>
                                                <option value="bgRepeatX" {{ ($contents->page_background_image_position == 'bgRepeatX') ? 'selected' : '' }}>
                                                    Repeat Hortizontally
                                                </option>
                                                <option value="bgRepeatY" {{ ($contents->page_background_image_position == 'bgRepeatY') ? 'selected' : '' }}>
                                                    Repeat Vertically
                                                </option>
                                                <option value="bgRepeatXTop" {{ ($contents->page_background_image_position == 'bgRepeatXTop') ? 'selected' : '' }}>
                                                    Repeat Hortizontally - Top
                                                </option>
                                                <option value="bgRepeatXBottom" {{ ($contents->page_background_image_position == 'bgRepeatXBottom') ? 'selected' : '' }}>
                                                    Repeat Hortizontally - Bottom
                                                </option>
                                            </select>
                                        @else
                                            <select name="page_background_image_position"
                                                    id="page_background_image_position" class="form-control">
                                                <option value="bgCover">Full Center Fit</option>
                                                <option value="bgCover100">Fill 100% Width</option>
                                                <option value="bgNoRepeat">No Repeat</option>
                                                <option value="bgRepeat">Repeat</option>
                                                <option value="bgRepeatX">Repeat Hortizontally</option>
                                                <option value="bgRepeatY">Repeat Vertically</option>
                                                <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                                <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom
                                                </option>
                                            </select>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_background_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control color-settings"
                                               id="page_background_bg_color"
                                               name="page_background_bg_color" placeholder="BG Color"
                                               value="{{ (!empty($contents->page_background_color)) ? $contents->page_background_color : '' }}">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_page_background"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL PAGE BACKGROUND -->


<!-- MODAL SEO META DATA -->
<div id="pageSeoMetaData" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-globe"></i> &nbsp; SEO Meta Data</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_seo_meta_data" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seo_meta_data_title">Title:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_title"
                                               name="seo_meta_data_title" placeholder="Web Browser Title"
                                               value="{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="seo_meta_data_description">Description:</label>
                                    <div class="col-sm-9 clearfix">
                                        <textarea class="form-control" name="seo_meta_data_description" rows="5"
                                                  placeholder="Page description...">{{ (!empty($contents->seo_meta_data_description)) ? $contents->seo_meta_data_description : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="seo_meta_data_keywords">Keywords:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_keywords"
                                               name="seo_meta_data_keywords" placeholder="Keyword, Keyword2"
                                               value="{{ (!empty($contents->seo_meta_data_keywords)) ? $contents->seo_meta_data_keywords : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seo_meta_data_author">Author:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_author"
                                               name="seo_meta_data_author" placeholder="Your Name..."
                                               value="{{ (!empty($contents->seo_meta_data_author)) ? $contents->seo_meta_data_author : '' }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_seo_meta_data"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL SEO META DATA -->


<!-- MODAL POPUP
<div class="popup" data-popup="popup-1" id="data_page_popup" style="background-color:rgba(0,0,0,0.75)">
    <div class="popup-inner" data-modal-width="medium" style="background-color:#FFFFFF;color:#000000;padding-top:40px;padding-right:0px;padding-bottom:40px;padding-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;">
        <div class="body">
            <div class="editor-container element-type-main clearfix text-center">
                <div class="lb-content-body" id="main-html-container">
                    <button style="width: 95%;margin-left:15px;margin-right:15px"
                            class='add-inner-element btn btn-primary add-element' data-section-id='row'
                            id='row_modal' alt='Add elements' data-toggle='modal'
                            data-target='#rowModal'>ADD SECTION
                    </button>
                </div>
            </div>
        </div>

        <a class="popup-close" data-popup-close="popup-1" href="javascript:void(0)">x</a>
    </div>
</div>-->
