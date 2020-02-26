<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css"/>
    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css"
          rel="stylesheet">

    <!-- Custom Theme Style -->
    {!! Html::style('frontend/css/custom.min.css') !!}
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

    @yield('styles')
</head>

<body class="nav-sm" style="position: relative">
<div class="container body">
    <input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                <!--<a href="{{ route('dashboard.index') }}" class="site_title"><i class="fa fa-bars"></i>
                        <span>CARTUMO</span></a>-->
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <!--<div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>-->
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li>
                                <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i> Home <span
                                            class="fa fa-chevron-down"></span></a>
                            </li>
                        <!--<li><a href="#"> <i class="fa fa-filter" aria-hidden="true"></i> Funnel <span
                                            class="fa fa-chevron-down"></span></a>
                                <!<ul class="nav child_menu">
                                    <li><a href="{{ route('funnels.index') }}">Browse Funnels</a></li>
                                    <li><a href="#">Contacts</a></li>
                                    <li><a href="{{ route('sales.index') }}">Sales</a></li>
                                    <li><a href="#">Funnel Marketplace</a></li>
                                </ul>
                            </li>--> <!-- {{-- route('order.index') --}} -->
                            <li><a href="{{ route('funnels.index') }}"> <i class="fa fa-filter" aria-hidden="true"></i>
                                    Funnels <span class="fa fa-chevron-down"></span></a></li>
                            <li><a href="{{ route('products.index') }}"> <i class="fa fa-cubes" aria-hidden="true"></i>
                                    Products <span class="fa fa-chevron-down"></span></a></li>
                            <li><a href="{{ route('sales.index') }}"> <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    Sales <span class="fa fa-chevron-down"></span></a></li>
                        <!--<li><a href="{{ route('feature-upgrade.index') }}"> <i class="fa fa-bolt" aria-hidden="true"></i>
                                    Upgrades <span class="fa fa-chevron-down"></span></a></li>-->
                        </ul>
                    </div>
                    <div class="menu_section">
                        <h3>Live On</h3>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <!--<div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>-->

                    <div class="nav toggles pull-left"
                         style="margin-top: 0px;position: absolute;left: 0px;z-index: 99999;">
                        <!--<a id="menu_toggle"><i class="fa fa-bars"></i></a>-->


                    <!--<h2 style="margin: 0px;">
                        <a href="{{ route('dashboard.index') }}" class="site_title"><i class="fa fa-bars"></i>
                        <span>CARTUMO</span></a>
                        </h2>-->
                        <a href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo1.png') }}"
                                                                      class="company-logo"
                                                                      style="width:167px;padding: 10px"/></a>
                    </div>


                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> Account
                                <!--<span class=" fa fa-angle-down"></span>-->
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('profile.edit', Auth::user()->id) }}"><i class="fa fa-user"></i>
                                        &nbsp; Account Details</a></li>
                                <li><a href="{{ route("integration.index") }}"><i class="fa fa-plug"></i> &nbsp;
                                        Integrations</a></li>
                                <li><a href="{{ route('payment-gateway.index') }}"><i class="fa fa-shopping-cart"></i>
                                        &nbsp; Payment
                                        Gateways</a></li>
                                <li><a href="{{ route('smtp.index') }}"><i class="fa fa-paper-plane"></i> &nbsp; SMTP
                                        Settings</a>
                                </li>
                                <li><a href="{{ route('account-billing.index') }}"><i class="fa fa-credit-card"></i>
                                        &nbsp; Account Billing</a>
                                </li>
                                <li><a href="{{ route('affiliate.index') }}"><i class="fa fa-dollar"></i> &nbsp;
                                        Affiliate</a>
                                </li>
                                <li><a href="{{ route('coupon.index') }}"><i class="fa fa-life-ring"
                                                                             aria-hidden="true"></i> &nbsp; Coupon
                                        Settings</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> &nbsp; Log Out</a>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="">
                            <a href="{{ route('site.help.index') }}" target="_blank" class="dropdown-toggle"
                               data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-question-circle"></i> Help
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->


        <div class="area-body">
            @yield('content')
        </div>


        <!--<footer>
            <div class="pull-right">
                <a href="http://www.inubaan.com/cartumo/public/">Cartumo</a>
            </div>
            <div class="clearfix"></div>
        </footer> -->


    </div>
</div>

<!-- CHAT -->
<div class="user-chat">
    <div class="chat-circle-normal chat-button-shadow"><i class="fa fa-comments-o" aria-hidden="true"></i></div>
    <div class="chat-window" style="display:none">
        <div class="chat-window-header">
            <h2>
                <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Conversations
                <ul class="messenger_controls">
                    <li class="refresh-chat"><i class="fa fa-refresh" aria-hidden="true"></i></li>
                    <!--<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>-->
                </ul>
            </h2>
        </div>

        <div class="chat-window-body">
            <div class="chat-history">
                <div class="blank_chat_info">
                    Here you can ask any question to admin and get replay soon.
                    So, what's your question?
                </div>
            </div>
        </div>

        <div class="chat-window-footer">
            <textarea class="form-control" id="chat_message_text" placeholder="Send a message..."></textarea>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="{{ asset('frontend/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('frontend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('frontend/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('frontend/vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ asset('frontend/vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- jQuery Sparklines -->
<script src="{{ asset('frontend/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('frontend/vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('frontend/vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('frontend/vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('frontend/vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('frontend/vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('frontend/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('frontend/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('frontend/vendors/DateJS/build/date.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('frontend/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- JQVMap -->
<script src="{{ asset('frontend/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
<script src="{{ asset('frontend/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('frontend/vendors/jqvmap/dist/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('frontend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/custom.min.js') }}"></script>

<script>
    $(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
    });
</script>

<!-- SCRIPT FOR CHAT -->
<script>
    $(document).ready(function () {

        $(".chat-circle-normal").click(function (e) {

            var chat_button = $(this);

            e.preventDefault();

            if ($(".chat-window").is(":visible")) {
                $(".chat-window").hide();
                $(chat_button).html('<i class="fa fa-comments-o" aria-hidden="true"></i>');
                $(chat_button).addClass('chat-button-shadow');
            } else {
                $(".chat-window").show();
                $(chat_button).html('<i class="fa fa-times" aria-hidden="true"></i>');
                $(chat_button).removeClass('chat-button-shadow');

                //load user's previous messages
                $.ajax({
                    type: 'GET',
                    url: "{{ route('messenger.show', Auth::user()->id) }}",
                    data: "_token={{ csrf_token() }}&user=Auth::user()->id",
                    beforeSend: function () {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                        $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                            if (json.html.length > 0) {

                                if ($(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0) {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                                }
                                /*else {
                                                                   $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                                                               }*/

                                var $target = $(".user-chat .chat-window .chat-window-body .chat-history").parent();
                                //alert($target.prop("scrollHeight"));
                                $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);
                            }
                        }

                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });


                $("#chat_message_text").focus();
            }
        });

        $(document).on("keyup", "#chat_message_text", function (e) {

            //e.preventDefault();

            var code = e.keyCode || e.which;
            var chat_body_container = $(".user-chat .chat-window .chat-window-body .chat-history");

            //if enter key has hit
            if (code == 13) {
                //alert("submit");

                $.ajax({
                    type: 'POST',
                    url: "{{ route('messenger.store') }}",
                    data: 'message=' + $(this).val() + "&from={{ Auth::user()->id }}&to=1&is_user=true&_token={{ csrf_token() }}",
                    beforeSend: function () {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    },
                    success: function (response) {
                        console.log(response);
                        $(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#68afa0');
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });

                var html = '<div class="chat-history-message message-from-user">';
                html += '<ul>';
                html += '<li><p>' + $(this).val() + '</p></li>';
                html += '<li><img src={{ asset("images/chat/man.png") }} /></li>';
                html += '</ul></div>';

                if ($(chat_body_container).find('.blank_chat_info').length > 0) {
                    $(chat_body_container).html(html);
                } else {
                    $(chat_body_container).append(html);
                }

                var $target = $(chat_body_container).parent();
                $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);

                $(this).val('');
            }
        });


        $(document).on("click", "#chat_message_text", function (e) {

            $.ajax({
                type: 'POST',
                url: "{{ route('messenger.message.mark.read', Auth::user()->id) }}",
                data: "_token={{ csrf_token() }}",
                beforeSend: function () {
                    //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });

        });


        $(document).on('click', '.user-chat .chat-window .chat-window-header .messenger_controls > .refresh-chat', function (e) {

            e.preventDefault();

            //load user's previous messages
            $.ajax({
                type: 'GET',
                url: "{{ route('messenger.show', Auth::user()->id) }}",
                data: "_token={{ csrf_token() }}&user=Auth::user()->id",
                beforeSend: function () {
                    //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                        if (json.html.length > 0) {
                            //$(".user-chat .chat-window .chat-window-body .chat-history").html('');
                            if ($(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0) {
                                $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                            }
                            /*else {
                                                               $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                                                           }*/

                            var $target = $(".user-chat .chat-window .chat-window-body .chat-history").parent();
                            $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);
                        }
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });


        //auto check message
        setInterval(function () {
            //load user's previous messages
            $.ajax({
                type: 'GET',
                url: "{{ route('messenger.message.unread', Auth::user()->id) }}",
                data: "_token={{ csrf_token() }}&user=Auth::user()->id",
                beforeSend: function () {
                    //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    //$(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        //$(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                        if (json.html.length > 0) {

                            if ($(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0) {
                                $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                            } else {
                                $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                            }
                        }
                    }

                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        }, 1000);//time in milliseconds
    });


    //Proof upgrade
    $(document).ready(function () {

                @if ( App\Models\UserUpgrade::isUpgradeAvailable(Auth::id(), 1) )
        var timerID = setInterval(function () {
                // your code goes here...
                //check_new_order();
            }, 5000);
        @endif
    });


</script>

@yield('scripts')
</body>
</html>