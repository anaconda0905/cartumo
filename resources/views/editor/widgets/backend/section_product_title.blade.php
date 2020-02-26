@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <div class="ld-element element-layout headline-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-title">
            <div class="element-headline lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-title-switch"
                     style="margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px">
                    <b class='' data-element-type="product-title"
                       style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:32px;display:block;font-family:Nunito">{{ $data['product']->name }}</b>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-headline-setings-modal" data-toggle="modal"
                        data-target="#headlineSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @else
        <div class="ld-element element-layout headline-wrapper ld-editable inline-element" id="{{ $id }}"
             data-de-type="product-title">
            <div class="element-headline lh4 size3 ld-margin0 element-text-shadow">
                <div class="wrapper ld_editable product-item product-title-switch"
                     style="margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px">
                    <b class='' data-element-type="product-title"
                       style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:32px;display:block;font-family:Ubuntu">{{ $data['product']->product->title }}</b>
                </div>
            </div>

            <!-- controls -->
            <div class="ld_inline_controls">
                <ul class="ld_option_menu">
                    <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                    <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                    <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                    <li class="ld_controls_edit open-headline-setings-modal" data-toggle="modal"
                        data-target="#headlineSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                    <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                </ul>
            </div>

            <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                    alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
            </button>
        </div>
    @endif
@else
    <div class="ld-element element-layout headline-wrapper ld-editable inline-element" id="{{ $id }}"
         data-de-type="product-title">
        <div class="element-headline lh4 size3 ld-margin0 element-text-shadow">
            <div class="wrapper ld_editable product-item product-title-switch"
                 style="margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px">
                <b class='' data-element-type="product-title"
                   style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:32px;display:block;font-family:Ubuntu">Large
                    Call to Action Headline</b>
            </div>
        </div>

        <!-- controls -->
        <div class="ld_inline_controls">
            <ul class="ld_option_menu">
                <!--<li class="ld_controls_editor"><i class="fa fa-code" aria-hidden="true"></i></li>-->
                <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
                <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
                <li class="ld_controls_edit open-headline-setings-modal" data-toggle="modal"
                    data-target="#headlineSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
            </ul>
        </div>

        <button type="button" class="addElementFlyoutDOM replace-element" data-section-id="element-all"
                alt="Add elements" data-toggle="modal" data-target="#elementModal"><i class="fa fa-plus"></i>
        </button>
    </div>
@endif