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
    <link rel="shortcut icon" type="image/ico" href="http://quomodosoft.com/html/asaas/asaas/images/favicon.ico">
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/normalize.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/magnific-popup.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/animate.css') }}">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/asaas/responsive.css') }}">

    <style>

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target=".mainmenu-area" data-gr-c-s-loaded="true">
<div class="slicknav_menu"><a href="http://quomodosoft.com/html/asaas/asaas/index.html"><img
                src="{{ asset('images/logo_cartumo_trans.png') }}" alt=""></a><a
            href="http://quomodosoft.com/html/asaas/asaas/index3.html#" aria-haspopup="true" role="button" tabindex="0"
            class="slicknav_btn slicknav_collapsed" style=""><span class="slicknav_menutxt"></span><span
                class="slicknav_icon slicknav_no-text"><span class="slicknav_icon-bar"></span><span
                    class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>
    <ul class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
        <li class="active"><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#home-page" role="menuitem"
                              tabindex="-1">Home</a></li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#service-page" role="menuitem" tabindex="-1">Services</a>
        </li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#feature-page" role="menuitem" tabindex="-1">Features</a>
        </li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#testimonial-page" role="menuitem"
               tabindex="-1">Testimonials</a></li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#price-page" role="menuitem" tabindex="-1">Pricing</a>
        </li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#team-page" role="menuitem"
               tabindex="-1">Team</a></li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#contact-page" role="menuitem" tabindex="-1">Contact</a>
        </li>
        <li><a href="http://quomodosoft.com/html/asaas/asaas/index3.html#faq-page" role="menuitem" tabindex="-1">FAQ</a>
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
<nav class="navbar mainmenu-area affix-top" data-spy="affix" data-offset-top="200">
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
<!-- Header-Area -->
<header id="home-page" class="header-area text-white xs-center"
        style="background-image: url(&#39;images/shapre-3.png&#39;); " tabindex="-1">
    <div class="overlay dark-blue"></div>
    <div class="table-cell">
        <div class="container">
            <div class="row middle-row">
                <div class="col-xs-12 col-md-5">
                    <h3 class="heading-3 text-white" title="Shopping, Selling buying in one Software.">Shopping, Selling
                        buying in one Software.</h3>
                    <p>As companies move their business operations to the Internet, new data trails are created.</p>
                    <div class="space-30"></div>
                    <a href="javascript:void(0)" class="bttn-5">Get Started for 14 days TRIAL</a>
                    <div class="space-60 hidden visible-xs visible-sm"></div>
                </div>
                <div class="hidden-xs col-md-7">

                    <div class="video-box text-center"
                         style="background-image: url(http://127.0.0.1:8000/images/dashboard.png);background-size: cover;">
                        <img src="{{ asset('images/dashboard.png') }}" alt="" style="visibility: hidden">
                        <div class="waves-block">
                            <div class="waves wave-1"></div>
                            <div class="waves wave-2"></div>
                            <div class="waves wave-3"></div>
                        </div>
                        <a href="https://www.youtube.com/watch?v=uU4Jv1ky8ds" class="v-bttn popup"><i
                                    class="fa fa-play"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header-Area / -->
<section class="section-padding-top" id="service-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title" title="Why Choose Us">Why Choose Us</h4>
                    <p>Turn emails, support tickets, chats, social media, surveys and documents into actionable
                        data. </p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="single-service">
                    <div class="service-icon">
                        <img src="{{ asset('frontend/images/conversion-optimization-64.png') }}" alt="Service Icon">
                    </div>
                    <h4 class="title" title="Funnel Builder">Funnel Builder</h4>
                    <p>Unlike team chat apps, Flow is designed to help your team stay focused by keeping relevant and
                        actionable.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="single-service">
                    <div class="service-icon">
                        <img src="{{ asset('frontend/images/icons-03-64.png') }}" alt="Service Icon">
                    </div>
                    <h4 class="title" title="Checkout Page Templates">Checkout Page Templates</h4>
                    <p>Unlike team chat apps, Flow is designed to help your team stay focused by keeping relevant and
                        actionable.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="single-service">
                    <div class="service-icon">
                        <img src="{{ asset('frontend/images/integration-64.png') }}" alt="Service Icon">
                    </div>
                    <h4 class="title" title="Affordable  Pricing Plans`">Affordable Pricing Plans</h4>
                    <p>Unlike team chat apps, Flow is designed to help your team stay focused by keeping relevant and
                        actionable.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding-top"
         style="background-image: url({{ asset('images/section-bg-4.png') }});background-position: right center; background-size: 60% auto;">
    <div class="container">
        <div class="row middle-row">
            <div class="col-xs-12 col-md-5">
                <h4 class="heading-4" title="Unlimited Pages">Unlimited Pages</h4>
                <p>With Cartumo, you can create an unlimited number of standalone pages right on your own Shopify domain
                    such as "Free + Shipping" offers, landing pages, lead magnets, long-form sales pages, custom review
                    collection pages, "Teespring-style" individual product pages, custom checkout pages, upsell pages,
                    downsell pages, or just about any other kind of marketing page you can think of.</p>
                <div class="space-15"></div>
                <div class="space-60 hidden visible-xs visible-sm"></div>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-1">
                <figure class="wow animated" style="visibility: visible;">
                    <img src="{{ asset('images/1534127614.jpg') }}" alt="deshbord">
                </figure>
            </div>
        </div>
    </div>
</section>
<section class="section-padding section-even-bg-color"
         style="background-image: url({{ asset('images/section-bg-5.png') }}); background-size: 60% auto; background-position: bottom left;">
    <div class="container">
        <div class="row middle-row">
            <div class="col-xs-12 col-md-6">
                <figure class="wow animated" style="visibility: visible;">
                    <img src="{{ asset('images/1534127741.jpg') }}" alt="deshbord">
                </figure>
                <div class="space-60 hidden visible-xs visible-sm"></div>
            </div>
            <div class="col-xs-12 col-md-5 col-md-offset-1">
                <h4 class="heading-4" title="Awesome Integrations">Awesome Integrations</h4>
                <p>Cartumo integrates with Google Analytics and the Facebook Pixel for easy third-party tracking, as
                    well as with Aweber, MailChimp, and Zoho for automated behind-the-scenes email marketing sequences,
                    such as abandoned cart emails, purchase confirmation emails, shipping and tracking notifications,
                    and even one-time broadcast emails.</p>
                <div class="space-15"></div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding-top"
         style="background-image: url({{ asset('images/section-bg-4.png') }});background-position: right center; background-size: 60% auto;">
    <div class="container">
        <div class="row middle-row">
            <div class="col-xs-12 col-md-5">
                <h4 class="heading-4" title="Unlimited Pages">Choice of Cart</h4>
                <p>With Cartumo, you can choose to use our own built-in, fully customizable checkout to improve
                    conversions and decrease abandoned carts. Our built-in cart also integrates with Stripe and PayPal
                    to allow you to add true "one-click" post-purchase upsells in your funnels.</p>
                <div class="space-15"></div>
                <div class="space-60 hidden visible-xs visible-sm"></div>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-1">
                <figure class="wow animated" style="visibility: visible;">
                    <img src="{{ asset('images/1534128124.jpg') }}" alt="deshbord">
                </figure>
            </div>
        </div>
    </div>
</section>
<section class="section-padding section-even-bg-color"
         style="background-image: url({{ asset('images/section-bg-5.png') }}); background-size: 60% auto; background-position: bottom left;">
    <div class="container">
        <div class="row middle-row">
            <div class="col-xs-12 col-md-6">
                <figure class="wow animated" style="visibility: visible;">
                    <img src="{{ asset('images/1534128006.jpg') }}" alt="deshbord">
                </figure>
                <div class="space-60 hidden visible-xs visible-sm"></div>
            </div>
            <div class="col-xs-12 col-md-5 col-md-offset-1">
                <h4 class="heading-4" title="Full Marketing Funnels">Full Marketing Funnels</h4>
                <p>Not only can you create an unlimited number of standalone marketing pages right on your very own
                    Shopify domain, but you can now create full product funnels complete with landing pages > upsells >
                    downsells > checkout pages > and a thank you page. The best part? Because everything is actually on
                    YOUR Shopify store, all your existing integrations, shipping settings, and fulfillment providers
                    still work as they normally would!</p>
                <div class="space-15"></div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding-top"
         style="background-image: url({{ asset('images/section-bg-4.png') }});background-position: right center; background-size: 60% auto;">
    <div class="container">
        <div class="row middle-row">
            <div class="col-xs-12 col-md-5">
                <h4 class="heading-4" title="Unlimited Pages">Tracking & Analytics</h4>
                <p>All of the pages and funnels you create inside our all-new drag-and-drop Cartumo is fully tracked
                    showing you detailed information about user's device, browser, and geographical information, as well
                    as giving you stats on total and unique page views, total checkouts, and abandoned carts. You'll
                    quickly be able to see how your pages and funnels are doing right inside the app dash.</p>
                <div class="space-15"></div>
                <div class="space-60 hidden visible-xs visible-sm"></div>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-1">
                <figure class="wow animated" style="visibility: visible;">
                    <img src="{{ asset('images/1534127967.jpg') }}" alt="deshbord">
                </figure>
            </div>
        </div>
    </div>
</section>

<section id="feature-page" class="section-padding"
         style="background-image: url(&#39;images/section-bg-2.png&#39;); background-position: center center; background-size: 100% 100%;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title" title="Benefits of {{ env('APP_NAME') }}">Benefits
                        of {{ env('APP_NAME') }}</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-1.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Easy Intregration">Easy Intregration</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-2.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Latest Technology">Latest Technology</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-3.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Unlimited Funnels">Unlimited Funnels</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-4.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Team Collaboration">Shopify Products</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-5.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Free Page Templates">Free Page Templates</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-6.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="User Permissions">Instant Template Preview</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-7.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Automatic Report">Automatic Report</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-feature v2">
                    <div class="feature-icon">
                        <img src="{{ asset('images/feature-icon-2-8.png') }}" alt="Easy Intregration">
                    </div>
                    <h5 class="title" title="Customer Support">Customer Support</h5>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many,</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding-top section-even-bg-color" id="testimonial-page" tabindex="-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title" title="What Our Customer Say">What Our Customer Say</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <div class="testimonials v3 dots-none side-arrow owl-carousel owl-theme owl-responsive-1000 owl-loaded">


                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                             style="transform: translate3d(-2925px, 0px, 0px); transition: all 1s ease 0s; width: 6825px;">
                            <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item active" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                <div class="single-testimonial">
                                    <div class="desc">Given the enormous wealth creation from cryptocurrency, and the
                                        future potential upside, I believe there is a rare opportunity to create a large
                                        non-profit fund.
                                    </div>
                                    <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                    <span class="position">Project Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-controls">
                        <div class="owl-nav">
                            <div class="owl-prev" style=""><i class="fa fa-angle-left"></i></div>
                            <div class="owl-next" style=""><i class="fa fa-angle-right"></i></div>
                        </div>
                        <div class="owl-dots" style="display: block;">
                            <div class="owl-dot"><span></span></div>
                            <div class="owl-dot active"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding-top" id="price-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title purple" title="Simple and Transparent Pricing">Simple and Transparent
                        Pricing</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="price-box blue wow animated" style="visibility: visible;">
                    <h5 class="title" title="Pro">Monthly</h5>
                    <div class="price-rate">${{ env('MONTHLY_PLAN') }}</div>
                    <div class="price-time">Per Month</div>
                    <div class="price-content">
                        <ul>
                            <li>Unlimited funnels</li>
                            <li>One click upsell</li>
                            <li>One click downsells</li>
                            <li>Shopify integration</li>
                            <li>Sell manual products</li>
                            <li>Connect your mail server</li>
                            <li>PayPal and Stripe for payment gateway</li>
                            <li>Bump feature</li>
                            <li>Coupon feature</li>
                        </ul>
                    </div>
                    <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#" class="bttn-3">Start My 14 days
                        Trial</a>
                </div>
                <div class="space-60 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="price-box blue wow animated" style="visibility: visible;">
                    <h5 class="title" title="Unlimited">Yearly</h5>
                    <div class="price-rate">${{ env('YEARLY_PLAN') }}</div>
                    <div class="price-time">Per Year</div>
                    <div class="price-content">
                        <ul>
                            <li>Unlimited funnels</li>
                            <li>One click upsell</li>
                            <li>One click downsells</li>
                            <li>Shopify integration</li>
                            <li>Sell manual products</li>
                            <li>Connect your mail server</li>
                            <li>PayPal and Stripe for payment gateway</li>
                            <li>Bump feature</li>
                            <li>Coupon feature</li>
                        </ul>
                    </div>
                    <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#" class="bttn-3">Start My 14 days
                        Trial</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="team-area section-padding" id="team-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title purple" title="Our expert team leader">Our expert team leader</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3" style="visibility: hidden">
                <div class="single-team box_2 purple">
                    <figure class="team-photo">
                        <img src="./aSaas _ HTML OnePage Template_files/team-1.png" alt="">
                    </figure>
                    <div class="team-content">
                        <h4 class="team-name" title="Michael Alber">Michael Alber</h4>
                        <div class="team-position">Head of Idea</div>
                        <div class="social">
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-facebook"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i class="fa fa-twitter"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-google-plus"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-team box_2 purple">
                    <figure class="team-photo">
                        <img src="{{ asset('images/jafar.jpg') }}" alt="">
                    </figure>
                    <div class="team-content">
                        <h4 class="team-name" title="Lana Stevens">Jafar Rizvi</h4>
                        <div class="team-position">Founder/Project Manager/Creator</div>
                        <!--<div class="social">
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-facebook"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i class="fa fa-twitter"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-google-plus"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-linkedin"></i></a>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="single-team box_2 purple">
                    <figure class="team-photo">
                        <img src="{{ asset('images/sourav1.jpg') }}" alt="">
                    </figure>
                    <div class="team-content">
                        <h4 class="team-name" title="Anya Siennadia">Sourav Chakraborty</h4>
                        <div class="team-position">Lead Developing Manager/Senior Developer</div>
                        <!--<div class="social">
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-facebook"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i class="fa fa-twitter"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-google-plus"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-linkedin"></i></a>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3" style="visibility: hidden">
                <div class="single-team box_2 purple">
                    <figure class="team-photo">
                        <img src="./aSaas _ HTML OnePage Template_files/team-4.png" alt="">
                    </figure>
                    <div class="team-content">
                        <h4 class="team-name" title="Jhon Doe">Jhon Doe</h4>
                        <div class="team-position">Head of Idea</div>
                        <div class="social">
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-facebook"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i class="fa fa-twitter"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-google-plus"></i></a>
                            <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                        class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact-page" class="section-padding contact-area section-even-bg-color-other"
         tabindex="-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title" title="Contact our support forum">Contact our support forum</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form id="contact-form" class="contactform">
                    <div class="col-xs-12 col-md-4">
                        <div class="input-box">
                            <label for="form-name">Your Name *</label>
                            <input type="text" name="form-name" id="form-name" class="form-input"
                                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="input-box">
                            <label for="form-email">Your Email *</label>
                            <input type="text" name="form-email" id="form-email" class="form-input">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="input-box">
                            <label for="form-phone">Phone</label>
                            <input type="text" name="form-phone" id="form-phone" class="form-input">
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="input-box">
                            <label for="form-message">Message *</label>
                            <textarea name="form-message" id="form-message" cols="30" rows="5"
                                      class="form-input"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button class="bttn-3" type="submit">Submit &nbsp;&nbsp;<i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="section-padding-top" id="faq-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title purple" title="Frequently asked questions">Frequently asked
                        questions</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="faq-box">
                    <h4 class="title" title="If you could time travel, what would you do?">If you could time travel,
                        what would you do?</h4>
                    <p>As of the moment, we only have PayPal as our payment method. But don’t worry, we are working on
                        adding more payment methods for your convenience for any problem.</p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="What is your favorite fruit?">What is your favorite fruit?</h4>
                    <p>No, we do not need your password. We only need your username to be able to deliver your desired
                        likes.</p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="Which do you like better, cardio or weightlifting?">Which do you like
                        better, cardio or weightlifting?</h4>
                    <p>We give discounts for multiple accounts, namely: 2 accounts - 10% , 5 accounts - 25% ,10 accounts
                        - 30%. For 50 more accounts, please contact us.</p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="If you could have any kind of pet, what would you choose?">If you could
                        have any kind of pet, what would you choose?</h4>
                    <p>No, your account will remain safe because we offer real likes from real people. Our likes do not
                        come from bots and ghost accounts.</p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="Where did you get your name?">Where did you get your name?</h4>
                    <p>We only provide likes as of the moment. If in the future, we would be able to offer other
                        services, we would definitely let you know.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="faq-box">
                    <h4 class="title" title="Which do you like better, city or country?">Which do you like better, city
                        or country?</h4>
                    <p>Yes, we offer automatic likes with various features that you can utilize such as Delay on Likes,
                        Country and Gender Targeting, and Likes Randomness. </p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="What is your favorite comedy?">What is your favorite comedy?</h4>
                    <p>Absolutely. We offer 50 free likes for you to be able to ascertain whether our service is for
                        you.</p>
                </div>
                <div class="faq-box">
                    <h4 class="title" title="If you could have any kind of pet, what would you choose?">If you could
                        have any kind of pet, what would you choose?</h4>
                    <p>We actually have an exchange nev2rk, and they have allowed us to like the posts of others.</p>
                </div>
                <div class="qustion-box-2">
                    <div class="qustion-icon">
                        <img src="./aSaas _ HTML OnePage Template_files/q-icon.png" alt="">
                    </div>
                    <h4 class="title" title="Do you have any questions?">Do you have any questions?</h4>
                    <p>Would be happy to hear how I can help you out.</p>
                    <a href="mailto:support@sasspro.com"><i class="fa fa-envelope-o"></i> support@sasspro.com</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<div class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                <div class="page-title">
                    <h4 class="heading-4 title" title="Trusted By">Trusted By</h4>
                    <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as
                        you want.</p>
                </div>
                <div class="space-80"></div>
            </div>
        </div>
        <div class="row">
            <div class="sponsors owl-carousel owl-theme owl-responsive-1000 owl-center owl-loaded">


                <div class="owl-stage-outer">
                    <div class="owl-stage"
                         style="transition: all 1s ease 0s; width: 3510px; transform: translate3d(-1170px, 0px, 0px);">
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-1.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-2.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-3.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-4.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-5.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-1.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-2.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item active center" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-3.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-4.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-5.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-1.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-2.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-3.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-4.png" alt="sponsor">
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 0px;">
                            <div class="item">
                                <img src="./aSaas _ HTML OnePage Template_files/sponsor-5.png" alt="sponsor">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-controls">
                    <div class="owl-nav">
                        <div class="owl-prev" style="display: none;"><i class="fa fa-angle-left"></i></div>
                        <div class="owl-next" style="display: none;"><i class="fa fa-angle-right"></i></div>
                    </div>
                    <div class="owl-dots" style="">
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot active"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<footer class="footer-area v3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center text-white">
                <h3 class="heading-3 text-white" title="Join our community of 250.000+ users">Join our community of
                    250.000+ users</h3>
                <p>Sign up for a 15-day trial. No obligations. No credit card required.</p>
                <form id="mc-form" class="subscrie-form v2" novalidate="true">
                    <label class="mt10" for="mc-email"></label>
                    <input type="email" class="control" id="mc-email" name="EMAIL">
                    <button type="submit" class="submit">Get Started for free</button>
                </form>
                <div class="space-60"></div>
                <div class="copyright">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>


<div id="login-signup-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="login-modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Login Now!</h4>
            </div>

            <div class="modal-body">
                <form id="frm_login" class="form-horizontal clearfix" method="POST"
                      action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}
                    <fieldset class="col-md-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="rows">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>

                            <div class="rows">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                    </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <p>
                    <a id="FPModal" href="javascript:void(0)">Forgot Password?</a> |
                    <a id="signupModal" href="javascript:void(0)">Register Here!</a>
                </p>
            </div>

        </div>

        <div class="modal-content" id="signup-modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Signup Now!</h4>
            </div>

            <div class="modal-body">
                <form class="form-signin" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    @if( !empty($_GET['plan']) )
                        <input type="hidden" name="hid_plan_type" value="{{ $_GET['plan'] }}">
                    @endif
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>

                        <div class="">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   placeholder="Full Name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail Address</label>

                        <div class="">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="Email Address" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password-confirm" class="control-label">Confirm Password</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Retype Password" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0px">
                        <div class="col-md-6s">
                            <label for="secret_code" class="control-label" style="text-align:left">
                                <input type="checkbox" name="secret_code" id="secret_code"/>
                                Have a Secret Code?
                            </label>

                            <input id="secret_code_text" type="text" class="form-control" name="secret_code_text"
                                   placeholder="Enter the secret code" style="display: none">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4s"></div>
                        <label for="agree_terms" class="control-label" style="text-align:left">
                            <input type="checkbox" name="agree_terms" id="agree_terms" required/>
                            I Agree to the Terms and Conditions
                        </label>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-6s col-md-offset-4s">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                Register
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <p>Already a Member ? <a id="loginModal" href="javascript:void(0)">Login Here!</a></p>
            </div>
        </div>

        <div class="modal-content" id="forgot-password-modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Recover Password!</h4>
            </div>

            <div class="modal-body">
                <form method="post" id="Forgot-Password-Form" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            <input name="email" type="email" class="form-control input-lg" placeholder="Enter Email"
                                   required data-parsley-type="email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block btn-lg">
                        <span class="glyphicon glyphicon-send"></span> SUBMIT
                    </button>
                </form>
            </div>

            <div class="modal-footer">
                <p>Remember Password ? <a id="loginModal1" href="javascript:void(0)">Login Here!</a></p>
            </div>

        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
    });
</script>

<a id="scrollUp" href="#top"
   style="position: fixed; z-index: 2147483647; display: none;"><i class="fa fa-angle-up"></i></a>
</body>
</html>