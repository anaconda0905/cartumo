<div class="ld-element _row_element_holder element row-medium element-type-row container-element product-row clearfix" data-de-type="row" data-product-id="{{ $data['product_id'] }}">
    <div class="lb-content-body"></div>
    <button type="button" class="btn btn-transparent add-element" data-section-id="element" id="element_modal" alt="Add Product Elements" data-toggle="modal" data-target="#elementModal" style="margin-top: 15px;">
        <span class="glyphicon glyphicon-plus-sign"></span> Add Product Elements
    </button>
    <input type="hidden" name="product" value="{{ $data['product_id'] }}" />

    <!-- controls -->
    <div class="ld_controls">
        <ul class="ld_option_menu">
            <li class="ld_controls_move"><i class="fa fa-arrows" aria-hidden="true"></i></li>
            <li class="ld_controls_clone"><i class="fa fa-files-o" aria-hidden="true"></i></li>
            <li class="ld_controls_edit open-row-setings-modal" data-toggle="modal" data-target="#rowSettingsModal"><i class="fa fa-cog" aria-hidden="true"></i></li>
            <li class="ld_controls_close"><i class="fa fa-times" aria-hidden="true"></i></li>
        </ul>
    </div>
</div>
