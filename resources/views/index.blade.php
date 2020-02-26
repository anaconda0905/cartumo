@extends('layouts.start')

@section('styles')
    <style>
        .js-video {
            height: 0;
            padding-top: 25px;
            padding-bottom: 60%;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }
        .js-video.widescreen {
            padding-bottom: 56.34%;
        }
        .js-video.vimeo {
            padding-top: 0;
        }
        .js-video embed, .js-video iframe, .js-video object, .js-video video {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
        }
    </style>
@endsection

@section('content')


    <!-- Header-Area -->
    <header class="header-area text-white xs-center"
            style="background-image: url(&#39;images/shapre-3.png&#39;); " tabindex="-1">
        <div class="overlay dark-blue"></div>
        <div class="table-cell">
            <div class="container">
                <div class="row middle-row">
                    <div class="col-xs-12 col-md-5">
                        <h3 class="heading-3 text-white">Cartumo gives you everything you need to quickly market, sell & grow your business online</h3>
                        <p>Without ever writing a single line of code... OR spending thousands on web developers</p>
                        <div class="space-30"></div>
                        <a href="{{ route('site.plans.get') }}" class="bttn-5">Get Started for {{ env('TRIAL_PERIOD') }} days TRIAL</a>
                        <div class="space-60 hidden visible-xs visible-sm"></div>
                    </div>
                    <div class="hidden-xs1 col-md-7 col-xs-12">

                        <div class="video-box text-center"
                             style="background-image: url({{ asset('images/dashboard.png') }});background-size: cover;">
                            <div class="video-placeholder">
                                <img src="{{ asset('images/dashboard.png') }}" alt="" style="visibility: hidden">
                                <div class="waves-block">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div>
                                <a id="video_icon_animated" href="javascript:void(0)" class="v-bttn popup"><i
                                            class="fa fa-play"></i></a>
                            </div>
                            <div class="js-video [vimeo, widescreen]" style="display: none">
                                <iframe width="560" height="315"
                                        src="http://www.youtube.com/embed/uU4Jv1ky8ds?showinfo=0" frameborder="0"
                                        allowfullscreen></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>

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
                        <p>Helps you in linking products within your store, which greatly increases your chance of making a sale! Add promotional offers to sales through funnels! An innovation by Cartumo!</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <img src="{{ asset('frontend/images/icons-03-64.png') }}" alt="Service Icon">
                        </div>
                        <h4 class="title" title="Checkout Page Templates">Checkout Page Templates</h4>
                        <p>After looking at various checkout page templates, Cartumo has handpicked the best checkout page templates for you which you can choose from for your ecommerce website!</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <img src="{{ asset('frontend/images/integration-64.png') }}" alt="Service Icon">
                        </div>
                        <h4 class="title" title="Affordable  Pricing Plans`">Affordable Pricing Plans</h4>
                        <p>We at Cartumo offer you the best prices for your Ecommerce store features! No one can beat our prices, and it’s a guarantee!</p>
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
                    <p>With Cartumo, you can create an unlimited number of standalone pages right on your own Shopify
                        domain
                        such as "Free + Shipping" offers, landing pages, lead magnets, long-form sales pages, custom
                        review
                        collection pages, "Teespring-style" individual product pages, custom checkout pages, upsell
                        pages,
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
                        well as with Aweber, MailChimp, and Zoho for automated behind-the-scenes email marketing
                        sequences,
                        such as abandoned cart emails, purchase confirmation emails, shipping and tracking
                        notifications,
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
                        conversions and decrease abandoned carts. Our built-in cart also integrates with Stripe and
                        PayPal
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
                        Shopify domain, but you can now create full product funnels complete with landing pages >
                        upsells >
                        downsells > checkout pages > and a thank you page. The best part? Because everything is actually
                        on
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
                        showing you detailed information about user's device, browser, and geographical information, as
                        well
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

    <section id="feature-page" class="section-padding section-even-bg-color"
             style="background-image: url(&#39;images/section-bg-2.png&#39;); background-position: center center; background-size: 100% 100%;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title" title="Benefits of {{ env('APP_NAME') }}">Benefits
                            of {{ env('APP_NAME') }}</h4>
                        <p>Cartumo offers drag & drop funnel building.
                            Even if you've never coded a day in your life, you can start building high tier funnel pages within minutes of signing up.
                            Don't believe us? Try our {{ env('TRIAL_PERIOD') }}-day free trial & find out for yourself.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-1.png') }}" alt="Easy Integration">
                        </div>
                        <h5 class="title" title="Easy Intregration">Easy Integration</h5>
                        <p>We've already added the crucial direct integrations for you tech-savvy funnel builders.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-2.png') }}" alt="Latest Technology">
                        </div>
                        <h5 class="title" title="Latest Technology">Latest Technology</h5>
                        <p>We've included intelligent elements, WITHOUT the need for 3rd party applications.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-3.png') }}" alt="Unlimited Funnels">
                        </div>
                        <h5 class="title" title="Unlimited Funnels">Unlimited Funnels</h5>
                        <p>Build as many funnels/pages as you want & optimize your funnel for peak conversions</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-4.png') }}" alt="Shopify Products">
                        </div>
                        <h5 class="title" title="Team Collaboration">Shopify Products</h5>
                        <p>We've provided direct integrations for your shopify store.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-5.png') }}" alt="Free Page Templates">
                        </div>
                        <h5 class="title" title="Free Page Templates">Free Page Templates</h5>
                        <p>We included free page templates to help get you started for your business.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-6.png') }}" alt="User Permissions">
                        </div>
                        <h5 class="title" title="User Permissions">Instant Template Preview</h5>
                        <p>Our built-in "Instant Template Preview" allows you to see how your funnel looks in browsers</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-7.png') }}" alt="Automatic Report">
                        </div>
                        <h5 class="title" title="Automatic Report">Automatic Report</h5>
                        <p>See your up-to-date real time funnel stats whenever you login to your account.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-feature v2">
                        <div class="feature-icon">
                            <img src="{{ asset('images/feature-icon-2-8.png') }}" alt="Customer Support">
                        </div>
                        <h5 class="title" title="Customer Support">Customer Support</h5>
                        <p>We provide 24/7 chat support technical support, round the clock for any queries you need.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="section-padding-top section-even-bg-color" id="testimonial-page" tabindex="-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title" title="What Our Customer Say">What Our Customer Say</h4>
                        <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few,
                            as
                            you want.</p>
                    </div>
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
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
                                            non-profit fund.
                                        </div>
                                        <h5 class="name" title="Antonio Ferndinando">Antonio Ferndinando</h5>
                                        <span class="position">Project Manager</span>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 945px; margin-right: 30px;">
                                    <div class="single-testimonial">
                                        <div class="desc">Given the enormous wealth creation from cryptocurrency, and
                                            the
                                            future potential upside, I believe there is a rare opportunity to create a
                                            large
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
    </section>-->
    <section class="section-padding-top" id="price-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title purple" title="Simple and Transparent Pricing">Simple and Transparent
                            Pricing</h4>
                        <p>One low price... packed with all the features... every single one of our customers is a priority</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="price-box blue wow animated" style="visibility: visible;">
                        <h5 class="title" title="Pro">Monthly</h5>
                        <div class="price-rate">${{ env('MONTHLY_PLAN') }}</div>
                        <div class="price-time">Per Month</div>
                        <div class="price-content">
                            <ul>
                                <li>Unlimited funnels & funnel pages</li>
                                <li>Native Shopify Integration Tools</li>
                                <li>Mailchimp autoresponder integration</li>
                                <li>Stripe & PayPal Payment Integration</li>
                                <li>Drag & Drop Funnel Builder</li>
                                <li>Built in lead form fields</li>
                                <li>Individual SMTP Integration</li>
                                <li>Built in "Cart" Function</li>
                                <li>One-Click Upsell Buttons & Pages</li>
                                <li>One-Click Downsell Buttons & Pages</li>
                                <li>Cloud Image Database</li>
                                <li>Funnel Page Template Storage</li>
                                <li>Easy Manual Product Creation</li>
                                <li>Built-in Coupon Code Generation</li>
                                <li class="no-icon">5 unique logins for a single account</li>
                                <li class="no-icon">Admin Controls for Account Owner</li>
                                <li class="no-icon">Easy Funnel Sharing Between Users</li>
                                <li class="no-icon">Built-in analytics for all of the funnels</li>
                                <li class="no-icon">Pixel manager integration</li>
                            </ul>
                        </div>
                        <a href="{{ route('register', 'plan=monthly') }}" class="bttn-3">Start My {{ env('TRIAL_PERIOD') }} days
                            Trial</a>
                    </div>
                    <div class="space-60 hidden visible-xs"></div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="price-box blue wow animated" style="visibility: visible;">
                        <h5 class="title" title="Unlimited">Yearly</h5>
                        <div class="price-rate">${{ env('YEARLY_PLAN') }}</div>
                        <div class="price-time">Per Year</div>
                        <div class="price-content">
                            <ul>
                                <li>Unlimited funnels & funnel pages</li>
                                <li>Native Shopify Integration Tools</li>
                                <li>Mailchimp autoresponder integration</li>
                                <li>Stripe & PayPal Payment Integration</li>
                                <li>Drag & Drop Funnel Builder</li>
                                <li>Built in lead form fields</li>
                                <li>Individual SMTP Integration</li>
                                <li>Built in "Cart" Function</li>
                                <li>One-Click Upsell Buttons & Pages</li>
                                <li>One-Click Downsell Buttons & Pages</li>
                                <li>Cloud Image Database</li>
                                <li>Funnel Page Template Storage</li>
                                <li>Easy Manual Product Creation</li>
                                <li>Built-in Coupon Code Generation</li>
                                <li class="no-icon">5 unique logins for a single account</li>
                                <li class="no-icon">Admin Controls for Account Owner</li>
                                <li class="no-icon">Easy Funnel Sharing Between Users</li>
                                <li class="no-icon">Built-in analytics for all of the funnels</li>
                                <li class="no-icon">Pixel manager integration</li>
                            </ul>
                        </div>
                        <a href="{{ route('register', 'plan=yearly') }}" class="bttn-3">Start My {{ env('TRIAL_PERIOD') }} days
                            Trial</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="price-box blue wow animated" style="visibility: visible;">
                        <h5 class="title" title="Unlimited">Agency</h5>
                        <div class="price-rate">${{ env('AGENCY_MONTHLY') }}/${{ env('AGENCY_YEARLY') }}</div>
                        <div class="price-time">Monthly/Yearly</div>
                        <div class="price-content">
                            <ul>
                                <li>Unlimited funnels & funnel pages</li>
                                <li>Native Shopify Integration Tools</li>
                                <li>Mailchimp autoresponder integration</li>
                                <li>Stripe & PayPal Payment Integration</li>
                                <li>Drag & Drop Funnel Builder</li>
                                <li>Built in lead form fields</li>
                                <li>Individual SMTP Integration</li>
                                <li>Built in "Cart" Function</li>
                                <li>One-Click Upsell Buttons & Pages</li>
                                <li>One-Click Downsell Buttons & Pages</li>
                                <li>Cloud Image Database</li>
                                <li>Funnel Page Template Storage</li>
                                <li>Easy Manual Product Creation</li>
                                <li>Built-in Coupon Code Generation</li>
                                <li>5 unique logins for a single account</li>
                                <li>Admin Controls for Account Owner</li>
                                <li>Easy Funnel Sharing Between Users</li>
                                <li>Built-in analytics for all of the funnels</li>
                                <li>Pixel manager integration</li>
                            </ul>
                        </div>
                        <button type="button" class="bttn-3">Coming Soon</button>
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
                        <p>Basically... we have some coding ninjas working with funnel hacking sharpshooting scientists... the office gets a little tense</p>
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
                                <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                            class="fa fa-twitter"></i></a>
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
                                <a href="http://quomodosoft.com/html/asaas/asaas/index3.html#"><i
                                            class="fa fa-twitter"></i></a>
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
                        <p>Don't have an account? Need some information before you make a decision? That's ok.. leave your information & a quick message, and we'll set up a time to chat!</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12">
                    <form action="{{ route('site.contactus') }}" id="contactForm" class="contactform">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                <label for="form-name">Your Name *</label>
                                <input type="text" name="form-name" id="form-name" class="form-input"
                                       style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"
                                       required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                <label for="form-email">Your Email *</label>
                                <input type="text" name="form-email" id="form-email" class="form-input" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                <label for="form-phone">Phone</label>
                                <input type="text" name="form-phone" id="form-phone" class="form-input" required>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="input-box">
                                <label for="form-message">Message *</label>
                                <textarea name="form-message" id="form-message" cols="30" rows="5"
                                          class="form-input" required></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <button class="bttn-3" id="btnSubmit" type="submit">Submit &nbsp;&nbsp;<i
                                        class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="success" id="success"></div>
        </div>
    </section>
    <!--<section class="section-padding-top" id="faq-page">
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
    </section>-->

@endsection
