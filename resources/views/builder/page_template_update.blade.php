<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<body class="nav-sm landing-page-editor">
<input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
<input type="hidden" id="hid_user_id" value="{{ Auth::user()->id }}"/>
<input type="hidden" id="hid_funnel_id" value="{{ $page->funnel_id }}"/>
<input type="hidden" id="hid_funnel_step_id" value="{{ $page->funnel_step_id }}"/>
<input type="hidden" id="hid_page_id" value="{{ $page->id }}"/>
<input type="hidden" id="hid_update_page_url" value="{{ route('page.upgrade.status.check', $page->id) }}"/>

<button class="btn btn-success" id="button_editor_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save
</button>


@if ( !empty($data['stepProduct']) )
    @if ( $stepProduct->product_type == 'manual' )
        <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct']->id }}"/>
    @else
        <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct'] }}"/>
    @endif
@endif

<div class="container body">
    <div class="main_container">
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">
            <div id="editor_panel">
                <div id="htmleditor">
                    @if ( !empty($contents->htmlbody) )
						<?php echo $contents->htmlbody ?>
                    @endif
                </div>
                <form method="PUT" action="{{ route('pages.update', $page->id) }}" accept-charset="UTF-8"
                      id="frm_htmleditor_save">
                    <input type="hidden" name="data_form_update" id="data_form_update" value="true"/>
                    <input type="hidden" name="name"
                           value="{{ (!empty($page->funnelStep->display_name)) ? $page->funnelStep->display_name : '' }}"/>
                    <input type="hidden" name="name"
                           value="{{ (!empty($page->funnelStep->display_name)) ? $page->funnelStep->display_name : '' }}"/>
                    <textarea name="htmlbody"
                              style="display: none"><?php echo ( ! empty( $contents->htmlbody ) ) ? $contents->htmlbody : '' ?></textarea>
                    <textarea name="pagestyle" id="textarea_pagestyle"
                              style="display: none"><?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?></textarea>
                    <textarea name="pagebackground" id="pagebackground"
                              style="display: none"><?php echo ( ! empty( $contents->pagebackground ) ) ? $contents->pagebackground : '' ?></textarea>
                    <textarea name="tracking_header" class="no-display"
                              value="{{ (!empty($contents->tracking_header)) ? $contents->tracking_header : ''  }}"></textarea>
                    <textarea name="tracking_footer" class="no-display"
                              value="{{ (!empty($contents->tracking_footer)) ? $contents->tracking_footer : ''  }}"></textarea>
                    @if ( !empty($contents->page_background_image) )
                        <input type="hidden" name="page_background_image"
                               value="{{ $contents->page_background_image }}"/>
                        <input type="hidden" name="page_background_image_position"
                               value="{{ $contents->page_background_image_position }}"/>
                        <input type="hidden" name="page_background_color"
                               value="{{ $contents->page_background_color }}"/>
                    @endif
                    @if ( !empty($contents->seo_meta_data_title) )
                        <input type="hidden" name="seo_meta_data_title"
                               value="{{ $contents->seo_meta_data_title }}"/>
                        <input type="hidden" name="seo_meta_data_description"
                               value="{{ $contents->seo_meta_data_description }}"/>
                        <input type="hidden" name="seo_meta_data_keywords"
                               value="{{ $contents->seo_meta_data_keywords }}"/>
                        <input type="hidden" name="seo_meta_data_author"
                               value="{{ $contents->seo_meta_data_author }}"/>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.9.1/js-yaml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('frontend/builder/js/editor.js') }}"></script>
@if ( (!empty($flag)) && ($flag=='autoupdate') )
    @if ( ($funnelType->name == 'Product') || ($funnelType->name == 'Order') || ($funnelType->name == 'Upsell') ||  ($funnelType->name == 'Downsell') )
        <script>
            $(document).ready(function () {

                //guess it's the product page
                //if ($(".product-image-wrapper").length != 0) {
                if ($(".product-image-wrapper").length > 0) {

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('editor.replace.product') }}",
                        data: 'step_id=' + $("#hid_funnel_step_id").val() + '&_token=' + $("#csrf_token").val(),
                        success: function (response) {
                            console.log(response);
                            //$(".product-image-wrapper .image > img").attr('src', "");
                            //$("#button_editor_save").trigger('click');

                            var json = JSON.parse(response);

                            //image
                            //replace_styles(json.image, $(".product-image-switch"));
                            html_image = replace_styles((json.image), $(".product-image-switch"));
                            $(".product-image-switch").html(html_image);

                            //title
                            html_title = replace_styles((json.title), $(".product-title-switch"));
                            $(".product-title-switch").html(html_title);

                            //description
                            html_description = replace_styles((json.description), $(".product-description-switch"));
                            $(".product-description-switch").html(html_description);

                            //variants
                            html_variants = replace_styles((json.variants), $(".product-varients-switch"));
                            $(".product-varients-switch").html(html_variants);

                            //price
                            html_price = replace_styles((json.price), $(".product-price-switch"));
                            $(".product-price-switch").html(html_price);

                            //availability
                            html_availability = replace_styles((json.availability), $(".product-availability-switch"));
                            $(".product-availability-switch").html(html_availability);

                            //save the changes
                            $("#button_editor_save").trigger('click');
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }

                //guess it's the order page
                if ($(".product-cart-switch").length > 0) {

                    //alert("update page");

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('editor.replace.product') }}",
                        data: 'step_id=' + $("#hid_funnel_step_id").val() + '&_token=' + $("#csrf_token").val() + '&type=cart',
                        success: function (response) {
                            console.log(response);
                            //$(".product-image-wrapper .image > img").attr('src', "");
                            //$("#button_editor_save").trigger('click');

                            var json = JSON.parse(response);

                            //cart
                            html_cart = replace_styles((json.cart), $(".product-cart-switch"));
                            $(".product-cart-switch").html(html_cart);

                            //bump
                            html_bump = replace_styles((json.bump), $(".product-bump-switch"));
                            $(".product-bump-switch").html(html_bump);

                            //shipping method
                            html_shipping_method = replace_styles((json.shipping_method), $(".order-shipping-switch"));
                            //alert(html_shipping_method);
                            $(".order-shipping-switch").html(html_shipping_method);

                            //alert("element update");

                            //save the changes
                            $("#button_editor_save").trigger('click');
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });


            function replace_styles(replacer, replaceable) {

                var element_styles = new Array();

                $(replaceable).find('*').each(function(index, element) {
                    if ( typeof $(element).attr('style') != 'undefined') {
                        element_styles[index] = $(element).attr('style');
                        console.log(element_styles[index] + ", ");
                    }
                });

                //console.log(alert(element_styles.split()));

                //alert($(replacer).find('*').length);

                var dom_element = document.createElement('div');
                dom_element.innerHTML = replacer;
                $(dom_element).find('*').each(function(index, element) {
                    //alert(this);
                    $(element).attr('style', element_styles[index]);
                });

                replacer = dom_element.innerHTML;

                //alert(replacer);

                return replacer;

                //replace the replaceable with replacer
                /*$(replacer).find('*').each(function(index, element) {
                    //alert(element_styles[index]);
                    $(element).attr('style', element_styles[index]);
                });*/
            }
        </script>
    @endif
@endif

</body>
</html>
