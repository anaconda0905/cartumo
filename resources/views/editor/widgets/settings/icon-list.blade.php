<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="buttonTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab" aria-expanded="true">Settings</a>
        </li>
        <li role="presentation" class="">
            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab" aria-expanded="false">Themes</a>
        </li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_settings" aria-labelledby="home-tab">

            <form id="frm_icon_list_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="button_text">text Align:</label>
                    <div class="col-sm-9">
                        <select name="alignment_type" id="alignment_type" class="form-control">
                            <option value="left">Default</option>
                            <option value="center" {{ ($settings->alignment_type == 'center') ? 'selected' : '' }}> Center</option>
                            <option value="right" {{ ($settings->alignment_type == 'right') ? 'selected' : '' }}> Right</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="text_color">Icon:</label>
                    <div class="col-sm-9">
                        <div class="icon-package-list">
                            <ul class="icons"></ul>
                            <input type="hidden" name="hid_icon_class" id="hid_icon_class" />
                            <input type="hidden" name="hid_icon_code" id="hid_icon_code" />
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
        <button type="button" class="btn btn-primary" id="icon_list_setting_save"> Save </button>
    </div>
</div>
