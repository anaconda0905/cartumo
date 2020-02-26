@extends('layouts.page')

@section('content')

    <section class="section-padding-top" id="price-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title purple" title="Simple and Transparent Pricing">Simple and Transparent
                            Pricing</h4>
                        <p>One low price... packed with all the features... every single one of our customers is a
                            priority.</p>
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
                        @if ( !empty($_GET['affiliate_id']) )
                            <a href="{{ route('register', 'plan=monthly&affiliate_id=' . $_GET['affiliate_id']) }}"
                               class="bttn-3">Start
                                My {{ env('TRIAL_PERIOD') }} days
                                Trial</a>
                        @else
                            <a href="{{ route('register', 'plan=monthly') }}" class="bttn-3">Start
                                My {{ env('TRIAL_PERIOD') }} days
                                Trial</a>
                        @endif
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
                        @if ( !empty($_GET['affiliate_id']) )
                            <a href="{{ route('register', 'plan=yearly&affiliate_id=' . $_GET['affiliate_id']) }}"
                               class="bttn-3">Start
                                My {{ env('TRIAL_PERIOD') }} days
                                Trial</a>
                        @else
                            <a href="{{ route('register', 'plan=yearly') }}" class="bttn-3">Start
                                My {{ env('TRIAL_PERIOD') }} days
                                Trial</a>
                        @endif
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


@endsection

@section('scripts')
    <script>
    </script>
@endsection
