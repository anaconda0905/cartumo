<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top"><img src="{{ asset('images/logo1.png') }}" style="width:80%" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('index', '#home') }}">Home</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('index', '#why_choose_us') }}">Why Choose Us?</a>
                </li>
                <!--<li class="page-scroll">
                    <a href="{{ route('index', '#what_people_say') }}">What People Say?</a>
                </li>-->
                <li class="page-scroll">
                    <a href="{{ route('index', '#brand') }}">Brand</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('index', '#contact') }}">Contact</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('login') }}">Login</a>
                </li>

                <li class="page-scroll">
                    <a href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>