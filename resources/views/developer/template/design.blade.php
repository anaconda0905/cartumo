<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <title>{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : 'Page Template Builder | Innuban Software' }}</title>@if ( !empty($contents->seo_meta_data_title) )
        <meta class="metaTagTop" name="description" content="{{ $contents->seo_meta_data_description }}">
        <meta class="metaTagTop" name="keywords" content="{{ $contents->seo_meta_data_keywords }}">
        <meta class="metaTagTop" name="author" content="{{ $contents->seo_meta_data_author }}">@endif
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <link href="{{ asset('developers/builder/css/green.css') }}" rel="stylesheet">
    <link href="{{ asset('developers/builder/colorpicker/css/colorpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('developers/builder/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('developers/builder/css/jqvmap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('developers/builder/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('developers/builder/css/jquery.incremental-counter.css') }}" rel="stylesheet">
    <link href="{{ asset('developers/builder/css/custom.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css"
          rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('developers/builder/css/bootstrap-iconpicker.min.css') }}"/>
    <link href="{{ asset('developers/css/editorstyle.css') }}" rel="stylesheet">
    @if ( !empty($contents->external_fonts) )
        <?php $fonts = ""; ?>
        @foreach ( explode(",", $contents->external_fonts) as $key=>$font )
            <?php $fonts .= $font . "|"; ?>
        @endforeach
        <?php echo "<link href='https://fonts.googleapis.com/css?family=" . trim($fonts, '|') . "' rel='stylesheet'>"; ?>
    @endif
    <!-- TRACKING CODE -->
    @if ( !empty($contents->tracking_header) )
        <?php echo html_entity_decode($contents->tracking_header); ?>
    @endif
    <!-- //TRACKING CODE -->
    <!-- CUSTOM CSS CODE -->
    @if ( !empty($contents->pagestyle) )
        <style><?php echo html_entity_decode($contents->pagestyle); ?></style>
    @endif
    <!-- //CUSTOM CSS CODE -->
</head>
<body class="nav-sm landing-page-editor">
    {{ csrf_field() }}
<div class="body">
    <div class="main_container">
        <!-- page content -->
        <div class="right_col" role="main"
             style="<?php echo (!empty($contents->pagestyle)) ? $contents->pagestyle : '' ?>">
            <div id="editor_panel">
                <!-- ALL the content place -->
                <form id="frm_htmleditor_container" action="" method="post" class="validate-form frm-new-builder-container" data-parsley-validate="">
                    <div id="htmleditor">
                        <?php echo (!empty($contents->htmlbody)) ? $contents->htmlbody : ''; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="{{ asset('developers/js/editor.js') }}"></script>
</body>
</html>