<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab" aria-expanded="true">Settings</a>
        </li>
        <li role="presentation" class="">
            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab" aria-expanded="false">Themes</a>
        </li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_settings" aria-labelledby="home-tab">

            <form id="frm_text_block_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label" for="headline_text">Headline Text:</label>
                    <input type="text" class="form-control" id="headline_text" name="headline_text" placeholder="Enter headline text" value="{{ $settings->headline_text }}" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="sub_headline_text">Sub Headline Text:</label> <br />
                    <textarea class="html-editor" rows="5" name="sub_headline_text" id="sub_headline_text">{{ $settings->sub_headline_text }}</textarea>

                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label" for="headline_text_color">Headline Text Color:</label>
                            <input type="text" class="form-control color-settings jscolor" id="headline_text_color" name="headline_text_color" placeholder="Enter text color" value="{{ $settings->headline_text_color }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="control-label" for="paragraph_text_color">Paragraph Text Color:</label>
                            <input type="text" class="form-control color-settings jscolor" id="paragraph_text_color" name="paragraph_text_color" placeholder="Enter text color" value="{{ $settings->paragraph_text_color }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label" for="headline_bg_color">Headline Bg Color:</label>
                            <input type="text" class="form-control color-settings jscolor" id="headline_bg_color" name="headline_bg_color" placeholder="Enter text color" value="{{ $settings->headline_bg_color }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="control-label" for="paragraph_bg_color">Paragraph Bg Color:</label>
                            <input type="text" class="form-control color-settings jscolor" id="paragraph_bg_color" name="paragraph_bg_color" placeholder="Enter text color" value="{{ $settings->paragraph_bg_color }}" />
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="tab_themes" aria-labelledby="home-tab">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
            synth. Cosby sweater eu banh mi, qui irure terr.</p>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="text_block_setting_save"> Save </button>
    </div>
</div>
