<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : 'Page Template Builder | Innuban Software' }}</title>@if ( !empty($contents->seo_meta_data_title) )
        <meta class="metaTagTop" name="description" content="{{ $contents->seo_meta_data_description }}">
        <meta class="metaTagTop" name="keywords" content="{{ $contents->seo_meta_data_keywords }}">
        <meta class="metaTagTop" name="author" content="{{ $contents->seo_meta_data_author }}">@endif

<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- NProgress -->
    <link href="{{ asset('frontend/builder/css/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('frontend/builder/css/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('frontend/builder/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('frontend/builder/css/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('frontend/builder/css/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('frontend/css/custom.min.editor.css') }}" rel="stylesheet">
    <link href="{{-- asset('assets/wysiwyg/css/froala_editor.min.css') --}}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>

    <link href="{{ asset('frontend/css/editorstyle.css') }}" rel="stylesheet">


    @if ( !empty($contents->external_fonts) )
		<?php $fonts = ""; ?>
        @foreach ( explode(",", $contents->external_fonts) as $key=>$font )
			<?php $fonts .= $font . "|"; ?>
        @endforeach

		<?php echo "<link href='https://fonts.googleapis.com/css?family=" . trim( $fonts, '|' ) . "' rel='stylesheet'>"; ?>
    @endif

<!-- TRACKING CODE -->
    @if ( !empty($contents->tracking_header) )
		<?php echo html_entity_decode( $contents->tracking_header ); ?>
    @endif
<!-- //TRACKING CODE -->

    <!-- CUSTOM CSS CODE -->
    @if ( !empty($contents->pagestyle) )
        <style><?php echo html_entity_decode( $contents->pagestyle ); ?></style>
@endif
<!-- //TRACKING CODE -->

</head>

<body class="nav-sm landing-page-editor">
<input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
<input type="hidden" id="hid_funnel_id" value="{{ $page->funnel_id }}"/>
<input type="hidden" id="hid_funnel_step_id" value="{{ $page->funnel_step_id }}"/>
<input type="hidden" id="hid_page_id" value="{{ $page->id }}"/>
<input type="hidden" id="hid_page_submit_type" value="<?php echo strtolower( $data['$funnelType']->name) ?>"/>
<?php //$data['stepProduct']; ?>
@if ( !empty($data['userPaymentGateway']) )
    <input type="hidden" id="hid_stripe_key"
           value="{{ json_decode($data['userPaymentGateway']->details)->publishable_key }}"/>
@endif


@if ( !empty($data['stepProduct']) )
    @if ( $data['stepProduct']->product_type == 'manual' )
        <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct']->id }}"/>
    @else
        <input type="hidden" id="hid_product_id" value="{{ json_decode($data['stepProduct']->details)->product_id }}"/>
    @endif
@endif
<div class="body">
    <div class="main_container">

        <!-- page content -->
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">

            <div id="editor_panel">

                <!-- ALL the content place -->
                <form id="frm_htmleditor_container" action="{{ $data['action'] }}" method="post"
                      class="validate-form frm-new-builder-container" data-parsley-validate="">
                    <div id="htmleditor"><?php echo ( ! empty( $contents->htmlbody ) ) ? $contents->htmlbody : ''; ?>{{ csrf_field() }}</div>
                </form>
            </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <!--<footer>
            <small>Innuban Software</small>
          <div class="clearfix"></div>
      </footer>-->
        <!-- /footer content -->
    </div>
</div>


<!-- jQuery -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!-- FastClick -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<!-- NProgress -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<!-- The required Stripe lib -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script src="{{ asset('frontend/js/editor.js') }}"></script>
<script>
    // Product varients change option
    if ($(".element-product-varients").find('.option-item') != null) {

        $(".element-product-varients .option-item:nth-child(1) select").trigger('change');


        $(document).on("change", ".element-product-varients .option-item select, .element-product-quantity select", function (e) {

            e.preventDefault();

            /*var style = $(".element-product-varients .option-item:nth-child(1) select").val();
             var size = $(".element-product-varients .option-item:nth-child(2) select").val();
             var color = $(".element-product-varients .option-item:nth-child(3) select").val();*/

            var data = "";
            var title = "";
            var data_element = $(this);
            var element = $(this);

            $(".element-product-varients .option-item").each(function (index, element) {

                var data_name = $(element).find("li:last-child > select").attr('name');
                var data_value = $(element).find("li:last-child > select").val();

                data += "&" + data_name + "=" + data_value;
                title += data_value + ',';
            });

            //alert(data);

            title = title.substr(0, title.length - 1);

            var quantity = $(".element-product-quantity select").val();

            //alert($("#hid_base_url").val() + '/product/varient-image/' + $("#product").val());
            //console.log($("#hid_base_url").val() + '/product/varient-image/' + $("#product").val());

            //alert(title);

            var element_href = $(".element-button").attr("data-url");
            var element_color = $(".element-button").css("background-color");
            $(".element-button").removeAttr('data-url');
            $(".element-button").css("background-color", "#F7F7F7");


            $.ajax({
                type: 'POST',
                url: "{{ route('product.varient.image') }}",
                //data: '_token=' + $("#csrf_token").val() + '&style=' + style + '&size=' + size + '&color=' + color + '&quantity=' + quantity + '&step_id=' + $("#hid_funnel_step_id").val(),
                data: '_token=' + $("#csrf_token").val() + '&data=' + data + '&title=' + title + '&quantity=' + quantity + '&step_id=' + $("#hid_funnel_step_id").val(),
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        if (json.image) {
                            $(".product-image-wrapper .image > img").attr('src', json.image);
                        }

                        //alert(json.available);

                        if (json.available) {
                            $(".product-availability-wrapper .wrapper b > span").removeClass('product-not-availabel');
                            $(".product-availability-wrapper .wrapper b > span").addClass('product-availabel');
                        } else {
                            $(".product-availability-wrapper .wrapper b > span").removeClass('product-availabel');
                            $(".product-availability-wrapper .wrapper b > span").addClass('product-not-availabel');
                        }

                        if (json.variant_id) {
                            $(".element-product-varients > #hid_product_variant_id").remove();
                            $(".element-product-varients").append("<input type='hidden' name='hid_product_variant_id' id='hid_product_variant_id' value='" + json.variant_id + "' />");

                            $(".element-product-varients > #hid_product_price").remove();
                            $(".element-product-varients").append("<input type='hidden' name='hid_product_price' id='hid_product_price' value='" + json.price[0] + "' />");

                            if ($(".product-price-switch")) {
                                $(".product-price-switch strong").html(json.price[1]);
                                $(".product-price-switch :input[name='pprice']").val(json.price[0]);
                            }
                        }
                    }
                },
                complete: function() {
                    $(".element-button").attr('data-url', element_href);
                    $(".element-button").css("background-color", element_color);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });
    }


    //BUMP OFFER
    if ($("#bump_product_offer").length > 0) {
        $(document).on("change", "#bump_product_offer", function (e) {

            e.preventDefault();

            if ($(this).is(":checked")) {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.add') }}",
                    data: '_token=' + $("#csrf_token").val() + '&funnel_id=' + $("#hid_funnel_id").val() + '&product_id=' + $(this).val() + '&product_type=' + $(this).attr('data-product-type') + '&action=add_bump&step_id=' + $("#hid_funnel_step_id").val(),
                    beforeSend: function () {
                        if ($(".product-cart-wrapper").length > 0) {
                            $(".product-cart-wrapper").css('opacity', '0.40');
                        }
                    },
                    success: function (response) {
                        $(".product-cart-wrapper").css('opacity', '1');
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success')
                            $(".product-cart-wrapper .wrapper").html(json.html);
                        else {

                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.add') }}",
                    data: '_token=' + $("#csrf_token").val() + '&product_id=' + $(this).val() + '&product_type=' + $(this).attr('data-product-type') + '&frm_hid_user_id=' + $("#frm_hid_user_id").val() + '&action=remove_bump',
                    beforeSend: function () {
                        if ($(".product-cart-wrapper").length > 0) {
                            $(".product-cart-wrapper").css('opacity', '0.40');
                        }
                    },
                    success: function (response) {
                        $(".product-cart-wrapper").css('opacity', '1');
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success')
                            $(".product-cart-wrapper .wrapper").html(json.html);
                        else {

                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            }
        });
    }

    $(document).ready(function (e) {

        $.ajax({
            type: 'POST',
            url: "{{ route('page.visitor') }}",
            data: '_token=' + $("#csrf_token").val() + '&page_id=' + $("#hid_page_id").val() + '&user_id=' + $("#frm_hid_user_id").val(),
            success: function (response) {
                console.log(response);
            },
            error: function (a, b) {
                console.log(a.responseText);
            }
        });
    });


    if ($(".element-button").attr('data-url') != null) {

        $(".element-button").click(function (e) {

            if ($(this).attr('data-url') == 'integration_data') {

                $("#frm_htmleditor_container").parsley().validate();

                //alert($(this).attr('data-url'));

                //$("form").trigger('submit');
                if ( $("#frm_htmleditor_container").parsley().isValid() ) {

                    var button = $(this);
                    var button_text = $(button).html();

                    $.ajax({
                        type: 'post',
                        url: "{{ route('integration.process') }}",
                        data: $("#frm_htmleditor_container").serialize() + '&_token=' + $("#csrf_token").val() + '&step_id=' + $("#hid_funnel_step_id").val(),
                        beforeSend: function () {
                            $(button).attr('disabled', 'disabled');
                            $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> Processing...');
                        },
                        success: function (response) {
                            console.log(response);
                            var json;

                            try {
                                json = JSON.parse(response);
                                //alert(json.result);

                            } catch (err) {
                                console.log(err);
                                $(button).html(button_text);
                                $(button).attr('disabled', false);
                                alert("Sorry! something is wrong.");
                            } finally {     
                                if ( json.status == 'success' )   {
                                    
                                    //API validation messages

                                    //mailchimp
                                    if ( typeof json.result != 'undefined' ) {
                                        if ( json.result.status == 400 ) {
                                            alert(json.result.detail);
                                            //get_funnel_next_step();
                                        }
                                    }

                                    if ($(button).attr('data-integration-process-after').length > 0) {

                                        if ($(button).attr('data-integration-process-after') == 'redirect_next') {
                                            $("#data_page_popup").remove();
                                            //location.href = $(button).attr('after-process-url');

                                            //redirect to next page
                                            get_funnel_next_step();
                                        }
                                    }
                                } else {
                                    $(button).html(button_text);
                                    $(button).attr('disabled', false);
                                    alert("Sorry! Somrthing is wrong.");
                                }
                            }
                        },
                        error: function (a, b) {
                            $(button).html(button_text);
                            $(button).attr('disabled', false);
                            console.log(a.responseText);
                        }
                    });
                }
                
            }
        });

    }
</script>

<!-- TRACKING CODE -->
@if ( !empty($contents->tracking_footer) )
	<?php echo html_entity_decode( $contents->tracking_footer ); ?>
@endif
<!-- //TRACKING CODE -->

</body>
</html>
