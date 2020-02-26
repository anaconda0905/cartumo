<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <title>{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : 'Page Template Builder | Innuban Software' }}</title>@if ( !empty($contents->seo_meta_data_title) )
        <meta class="metaTagTop" name="description" content="{{ $contents->seo_meta_data_description }}">
        <meta class="metaTagTop" name="keywords" content="{{ $contents->seo_meta_data_keywords }}">
        <meta class="metaTagTop" name="author" content="{{ $contents->seo_meta_data_author }}">@endif

<!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('frontend/builder/css/green.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/builder/colorpicker/css/colorpicker.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('frontend/builder/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('frontend/builder/css/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('frontend/builder/css/daterangepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/builder/css/jquery.incremental-counter.css') }}" rel="stylesheet">

    <!-- Custom Theme Style
    <link href="{{ asset('frontend/builder/css/custom.min.css') }}" rel="stylesheet"> -->


    <!-- Include Editor style. -->
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
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="{{ asset('frontend/builder/css/bootstrap-iconpicker.min.css') }}"/>

    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


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


@if ( !empty($data['stepProduct']) )
    @if ( $stepProduct->product_type == 'manual' )
        <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct']->id }}"/>
    @else
        <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct'] }}"/>
    @endif
    <input type="hidden" id="hid_funnel_step_id" value="{{ $page->funnel_step_id }}"/>
    <input type="hidden" id="hid_page_id" value="{{ $page->id }}"/>
@endif


<body class="nav-sm landing-page-editor">