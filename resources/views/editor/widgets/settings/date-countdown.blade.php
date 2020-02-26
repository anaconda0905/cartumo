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

            <form id="frm_date_countdown_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="headline_text">End Date:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter date" value="{{ $settings->end_date }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="text_color">End Time:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="end_time" name="end_time" placeholder="Enter time" value="{{ $settings->end_time }}" />
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
        <button type="button" class="btn btn-primary" id="date_countdown_setting_save"> Save </button>
    </div>
</div>
