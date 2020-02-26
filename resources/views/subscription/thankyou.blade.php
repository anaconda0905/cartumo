<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CARTUMO | Thank You For Register</title>

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

    <style>
        body {
            padding-top: 90px;
            background-color: #f7f7f7;
        }

        h1 {
            font-size: 3em;
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 30px;
            color: #2675b3;
        }

        .big-check-icon {
            color: #49ba9a;
            font-size: 5em;
        }

        .redirect-text {
            font-size: 15px;
            letter-spacing: 1px;
            color: #333333;
        }

        .footer {
            /*padding-top: 90px;*/
        }

        .loader-img {
            width: 100px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .footer {
            position: fixed;
            left: 0px;
            bottom: 0px;
            height: 30px;
            width: 100%;
            color: #888888;
            font-weight: 500;
        }

        /* IE 6 */
        * html .footer {
            position: absolute;
            top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
        }
    </style>
</head>

<body>
<div class="container text-center">

    <section>
        <div class="rows clearfix">
            <div class="col-md-12">

                <img src="{{ asset('images/cartumoi_modified.png') }}" style="width: 40%;"/>

                <h1>Thank You for Register</h1>

                <!--<div class="big-check-icon"><i class="fa fa-check" aria-hidden="true"></i></div>-->

                <img class="loader-img" src="{{ asset('images/locate-loader.gif') }}"/>

                <p class="redirect-text">You will be redirect to the dashboard in <strong
                            id="redirect_timer">10</strong> seconds</p>

                <div class="footer">
                    <p>Copyright &copy; {{ date('Y') }} | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- jQuery -->
<script src="{{ asset('frontend/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('frontend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function () {

        var timer = 10;

        var redirect_timer = setInterval(function () {
            if (timer >= 0)
                $("#redirect_timer").text(timer--);
            else {
                clearInterval(redirect_timer);
                location.href = "{{ route('dashboard.index') }}";
            }
        }, 1000);

    });
</script>
<script>
    fbq('track', 'Purchase');
</script>
</body>
</html>
