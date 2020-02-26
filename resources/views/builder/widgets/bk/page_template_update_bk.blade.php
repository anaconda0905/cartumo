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
    <input type="hidden" name="data_form_update" id="data_form_update" />
    <div class="main_container">
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">
            <div id="editor_panel">
                <form id="frm_htmleditor_container" class="validate-form" action="{{ $action }}"
                      method="post"
                      data-parsley-validate=""
                      data-form-update="true">
                    <div id="htmleditor">@if ( !empty($contents->htmlbody) )<?php echo $contents->htmlbody; ?>@endif</div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="{{-- asset('frontend/js/jquery.min.js') --}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.9.1/js-yaml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('frontend/builder/js/editor.js') }}"></script>

@if ( (!empty($flag)) && ($flag=='autoupdate') )
    @if ( ($funnelType->name == 'Product') || ($funnelType->name == 'Upsell') ||  ($funnelType->name == 'Downsell') )
        <script>
            $(document).ready(function () {

                //guess it's the product page
                //if ($(".product-image-wrapper").length != 0) {
                if (typeof $(".product-image-wrapper") != 'undefined') {

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
                            $(".product-image-switch").html(json.image);

                            //title
                            $(".product-title-switch").html(json.title);

                            //description
                            $(".product-description-switch").html(json.description);

                            //variants
                            $(".product-varients-switch").html(json.variants);

                            //price
                            $(".product-price-switch").html(json.price);

                            //availability
                            $(".product-availability-switch").html(json.availability);

                            //save the changes
                            $("#button_editor_save").trigger('click');
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }

                //guess it's the order page
                if (typeof $(".product-cart-switch") != 'undefined') {

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
                            //$(".product-cart-switch").html(json.cart);

                            //bump
                            //$(".product-bump-switch").html(json.bump);

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
        </script>
    @endif
@endif

</body>
</html>
