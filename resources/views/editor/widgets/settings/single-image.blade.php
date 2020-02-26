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

            <form id="frm_single_image_settings" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="headline_text">Image:</label>
                    <div class="col-sm-9">
                        <div class="input-group gallery-open" data-toggle="modal" data-target="#imageGalleryModal">
                            <input type="text" class="form-control" placeholder="Image path" name="path" aria-describedby="basic-addon2" value="{{ $settings->path }}" />
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="alt_text">ALT Text:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alt_text" name="alt_text" placeholder="Enter ALT text" value="{{ $settings->alt_text }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="width">Width:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="width" name="width" placeholder="Enter width" value="{{ $settings->width }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="height">Height:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="height" name="height" placeholder="Enter height" value="{{ $settings->height }}">
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
        <button type="button" class="btn btn-primary" id="single_image_save"> Save </button>
    </div>
</div>
