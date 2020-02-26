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

            <form id="frm_button_settings" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="button_action">Button Action:</label>
                    <div class="col-sm-9">
                        <select name="button_action" class="form-control" id="button_action">
                            <option value="">No Action</option>
                            <option value="next_step">Go to next step</option>
                            <option value="open_video">Open video</option>
                            @if ( !empty( $data['products'] ) )
                                @foreach ($data['products'] as $key => $product)
                                    <option value="product_{{ $product->id }}">1 Click {{ $data['type']->name }} - {{ $product->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <input type="hidden" name="step_next_url" value="" />
                    </div>
                </div>

                <div class="form-group" style="display: none" id="video_url_textbox">
                    <label class="control-label col-sm-3" for="button_text">Video URL:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="video_url" name="video_url" placeholder="Enter video URL" value="{{ $settings->video_url }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="button_text">Button Text:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Enter button text" value="{{ $settings->button_text }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="button_text">Button Type:</label>
                    <div class="col-sm-9">
                        <select name="button_type" id="button_type" class="form-control">
                            <option value="">Default</option>
                            <option value="full" {{ ($settings->button_type == 'full') ? 'selected' : '' }}> Full Width</option>
                            <option value="large" {{ ($settings->button_type == 'large') ? 'selected' : '' }}>Large</option>
                            <option value="full_large" {{ ($settings->button_type == 'full_large') ? 'selected' : '' }}>Full width and large</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control color-settings" id="text_color" name="text_color" placeholder="Enter text color" value="{{ empty($settings->text_color) ? '#fff' :  $settings->text_color }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control color-settings" id="bg_color" name="bg_color" placeholder="Enter background color" value="{{ empty($settings->bg_color) ? '#337ab7' : $settings->bg_color }}" />
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
        <button type="button" class="btn btn-primary" id="button_setting_save"> Save </button>
    </div>
</div>
