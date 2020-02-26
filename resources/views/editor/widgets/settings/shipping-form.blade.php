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

            <form id="frm_shipping_form_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="headline_text">Caption Text:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="caption_text" name="caption_text" placeholder="Enter caption text" value="{{ $settings->caption_text }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="enable_step_number">Enable step number:</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="checkbox" name="enable_step_number" id="enable_step_number" value="true" {{ (!empty($settings->step_number)) ? 'checked' : '' }} />
                        <input type="text" name="step_number" placeholder="Step #1" value="{{ $settings->step_number }}" />
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
        <button type="button" class="btn btn-primary" id="shipping_form_setting_save"> Save </button>
    </div>
</div>
