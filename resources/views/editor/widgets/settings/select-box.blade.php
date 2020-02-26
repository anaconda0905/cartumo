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

            <form id="frm_select_box_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="bg_color">Video Embed:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="select_options" id="select_options">
                            <option value="" {{ ($settings->select_options == '') ? 'selected' : '' }}>No Set</option>
                            <option value="all_countries" {{ ($settings->select_options == 'all_countries') ? 'selected' : '' }}>All Countries</option>
                            <option value="custom_options" {{ ($settings->select_options == 'n') ? 'selected' : '' }}>Custom Options</option>
                        </select>
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
        <button type="button" class="btn btn-primary" id="select_box_setting_save"> Save </button>
    </div>
</div>
