<!DOCTYPE html>
<!-- saved from url=(0052)http://quomodosoft.com/html/asaas/asaas/index3.html# -->
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths gr__quomodosoft_com"
      lang="zxx" style="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="keywords" content="{{ env('APP_NAME') }},Sales Funnel, Funnel Builder, Funnel">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>{{ env('APP_NAME') }}</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="http://quomodosoft.com/html/asaas/asaas/images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('images/favicon.png') }}">
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/normalize.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/magnific-popup.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/animate.css') }}">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/responsive.css') }}">

    @yield('styles')

    <style>
        nav.navbar {
            position: fixed;
            background-color: #2a3f54 !important;
            padding: 10px 0;
            border-radius: 0;
        }

        .main-content {
            /*padding: 110px 0px 60px !important;*/
            padding-bottom: 60px !important;
        }

        footer {
            background-image: none !important;
            background-color: #2a3f54;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '540958803023713');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=540958803023713&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target=".mainmenu-area" data-gr-c-s-loaded="true">
<div class="slicknav_menu">

    <a href="{{ route('index') }}"><img
                src="{{ asset('images/logo_cartumo_trans.png') }}" alt=""></a>
    <a href="{{ route('login') }}" class="bttn-1s">Sign
        In</a>
    <a href="javascript:void(0)" aria-haspopup="true" role="button" tabindex="0"
       class="slicknav_btn slicknav_collapsed" style=""><span class="slicknav_menutxt"></span><span
                class="slicknav_icon slicknav_no-text"><span class="slicknav_icon-bar"></span><span
                    class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>
    <ul class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
        <li class="active"><a href="{{ route('index') . '#home-page' }}" role="menuitem"
                              tabindex="-1">Home</a></li>
        <li><a href="{{ route('index') . '#service-page' }}" role="menuitem" tabindex="-1">Services</a>
        </li>
        <li><a href="{{ route('index') . '#feature-page' }}" role="menuitem" tabindex="-1">Features</a>
        </li>
        <li><a href="{{ route('index') . '#price-page' }}" role="menuitem" tabindex="-1">Pricing</a>
        </li>
        <li><a href="{{ route('index') . '#team-page' }}" role="menuitem"
               tabindex="-1">Team</a></li>
        <li><a href="{{ route('index') . '#contact-page' }}" role="menuitem" tabindex="-1">Contact</a>
        </li>
    </ul>
</div>
<!-- Prealoader-->
<div class="preloader" style="display: none;">
    <div class="waves-block">
        <div class="icon">
            <i class="fa fa-hourglass-half"></i>
        </div>
        <div class="waves wave-1"></div>
        <div class="waves wave-2"></div>
        <div class="waves wave-3"></div>
    </div>
</div>
<nav class="navbar mainmenu-area affix" data-spy="affix" data-offset-top="200">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}"><img
                        src="{{ asset('images/logo_cartumo_trans.png') }}" alt="" style="width: 64%;margin-top: -6px;"></a>
        </div>
        <div class="collapse navbar-collapse" id="mainmenu">
            <div class="navbar-header navbar-right hidden visible-lg padding-left-50">
                <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#login-signup-modal" class="bttn-1">Sign
                    In</a>-->
                <a href="{{ route('login') }}" class="bttn-1">Sign
                    In</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{ route('index') . '#home-page' }}">Home</a></li>
                <li class=""><a href="{{ route('index') . '#service-page' }}">Services</a>
                </li>
                <li class=""><a href="{{ route('index') . '#feature-page' }}">Features</a>
                </li>
                </li>
                <li class=""><a href="{{ route('index') . '#price-page' }}">Pricing</a></li>
                <li class=""><a href="{{ route('index') . '#team-page' }}">Team</a></li>
                <li class=""><a href="{{ route('index') . '#contact-page' }}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Main-Menu-Area / -->

<!-- Header-Area / -->
<div class="main-content">
    @yield('content')
</div>

<footer class="footer-area v3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center text-white">
                <h3 class="heading-3 text-white" title="Join our community of 250+ users">Join our community of
                    250+ users</h3>
                <form id="frm_subscription" class="subscrie-form v2" action="" method="post" novalidate="true">
                    <label class="mt10" for="mc-email"></label>
                    <input type="email" class="control" id="subscribe_email" name="subscribe_email"
                           placeholder="Enter email address here" required>
                    <button type="submit" class="submit">Subscribe</button>
                    {{ csrf_field() }}
                </form>
                <div class="space-60"></div>
                <div class="copyright">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</div>
            </div>
        </div>
        <div class="row clearfix bottom-footer">
            <div class="col-md-12 text-center">
                <ul>
                    @if ( (!empty($cmsPages)) && ($cmsPages->count() > 0) )
                        @foreach ( $cmsPages as $cmsPage )
                            <li><a href="{{ route('cms.page', $cmsPage->slug) }}" target="_blank">{{ $cmsPage->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>


<!--Vendor-JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!--Plugin-JS-->
<script src="{{ asset('frontend/js/asaas/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/ajaxchimp.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/contact-form.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/slicknav.min.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/js/asaas/wow.min.js') }}"></script>
<!--Main-active-JS-->
<script src="{{ asset('frontend/js/asaas/main.js') }}"></script>

@yield('scripts')

<script>
    $(document).ready(function () {

        $("#frm_login").submit(function (e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function (jqXHR) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $("#frm_subscription").submit(function (e) {

            e.preventDefault();

            var email = $(this).find("input[name='subscribe_email']");
            var button = $("#btn-subcribe");

            if (email.val().length > 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('site.subscription') }}",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {

                            $(button).html('Subscribe');
                            $(email).val('');

                            alert(json.message);
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            } else {
                alert("Please enter email address to continue.");
                $(email).focus();
            }
        });
    });
</script>

<!--<a id="scrollUp" href="#top"
   style="position: fixed; z-index: 2147483647; display: none;"><i class="fa fa-angle-up"></i></a>-->
</body>
</html>