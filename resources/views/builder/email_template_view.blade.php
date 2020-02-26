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

    <!-- CUSTOM CSS CODE -->
    @if ( !empty($contents->pagestyle) )
        <style><?php echo html_entity_decode( $contents->pagestyle ); ?></style>
@endif
<!-- //TRACKING CODE -->

</head>

<body class="nav-sm landing-page-editor">
<input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
<div class="body">
    <div class="main_container">
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">
            <div id="editor_panel">
                <div id="htmleditor"><?php echo ( ! empty( $contents->htmlbody ) ) ? $contents->htmlbody : ''; ?></div>
            </div>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js"></script>
<!--<script src="{{-- asset('frontend/js/editor.js') --}}"></script>-->

</body>
</html>
