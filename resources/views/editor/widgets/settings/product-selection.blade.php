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

            <form id="frm_product_selection_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="left_caption">Left Side Caption:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="left_caption" name="left_caption" placeholder="Enter caption for left side" value="{{ $settings->left_caption }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="right_caption">Right side Caption:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="right_caption" name="right_caption" placeholder="Enter caption for right side" value="{{ $settings->right_caption }}" />
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
        <button type="button" class="btn btn-primary" id="product_selection_setting_save"> Save </button>
    </div>
</div>
