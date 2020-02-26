<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : 'Page Template Builder | Innuban Software' }}</title>@if ( !empty($contents->seo_meta_data_title) )<meta class="metaTagTop" name="description" content="{{ $contents->seo_meta_data_description }}"><meta class="metaTagTop" name="keywords" content="{{ $contents->seo_meta_data_keywords }}"><meta class="metaTagTop" name="author" content="{{ $contents->seo_meta_data_author }}">@endif

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- NProgress -->
    <link href="{{ asset('admin/css/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('admin/css/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('admin/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('admin/css/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/css/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{-- asset('assets/wysiwyg/css/froala_editor.min.css') --}}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>

    <link href="{{ asset('editor/css/editorstyle.css') }}" rel="stylesheet">


    <!-- TRACKING CODE -->
    @if ( !empty($contents->tracking_header) )
        <?php echo html_entity_decode($contents->tracking_header); ?>
    @endif
    <!-- //TRACKING CODE -->

    <!-- CUSTOM CSS CODE -->
    @if ( !empty($contents->pagestyle) )
        <style><?php echo html_entity_decode($contents->pagestyle); ?></style>
    @endif
    <!-- //TRACKING CODE -->

</head>

<body class="nav-sm landing-page-editor">
<input type="hidden" id="hid_base_url" value="{{ url('/') }}" />
<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" id="hid_funnel_id" value="{{ $page->funnel_id }}" />
<input type="hidden" id="hid_funnel_step_id" value="{{ $page->funnel_step_id }}" />
<input type="hidden" id="hid_page_id" value="{{ $page->id }}" />
@if ( !empty($data['stepProduct']) )
    <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct']->id }}" />
@endif
<div class="container body">
    <div class="main_container">




        <!-- page content -->
        <div class="right_col" role="main" style="<?php echo (!empty($contents->pagestyle)) ? $contents->pagestyle : '' ?>">

            <div id="editor_panel">

                <!-- ALL the content place -->
                <div id="htmleditor">
                    <?php echo $contents->htmlbody ?>
                </div>
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
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- FastClick -->
<script src="{{ asset('admin/js/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('admin/js/nprogress.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js"></script>



<!-- Inlude Stripe.js -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('{!! env('STRIPE_KEY') !!}');

    /*jQuery(function($) {
     $('#payment-form').submit(function(event) {
     var $form = $(this);

     // Before passing data to Stripe, trigger Parsley Client side validation
     $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
     formInstance.submitEvent.preventDefault();
     return false;
     });

     // Disable the submit button to prevent repeated clicks
     $form.find('#submitBtn').prop('disabled', true);

     Stripe.card.createToken($form, stripeResponseHandler);

     // Prevent the form from submitting with the default action
     return false;
     });
     });*/


</script>


<script src="{{ asset('js/html2canvas.js') }}"></script>
<script src="{{ asset('js/canvas2image.js') }}"></script>
<script src="{{ asset('editor/js/editor.js') }}"></script>

<script>
    /*html2canvas(document.body, {
     onrendered: function(canvas) {
     var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will get a DOM 18 exception.;
     //$('body').append('<img src="'+img+'"/>');
     //console.log(img);
     //window.location.href=img;
     //Canvas2Image.saveAsPNG(canvas);


     $.ajax({
     type: 'POST',
     url: $("#hid_base_url").val() + '/widget/element/screenshoot',
     data: '&_token=' + $("#csrf_token").val() + '&image_data=' + img,
     success: function(response) {
     console.log(response);
     },
     error:function(a, b) {
     document.write(a.responseText);
     }
     });

     }
     });*/
</script>

<!-- TRACKING CODE -->
@if ( !empty($contents->tracking_footer) )
<?php echo html_entity_decode($contents->tracking_footer); ?>
@endif
        <!-- //TRACKING CODE -->

</body>
</html>