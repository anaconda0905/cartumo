<header class="header-sec">
    <nav class="navbar m-b-0">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}"> CARTUMO </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right cus-nvbar">
                    @if(Auth::check())
                        <li><a href="{{ route('funnels') }}" class="{{ (Route::currentRouteName() == 'funnels') ? 'active' : '' }}"> Funnels</a></li>
                        <li>
                            <a href="javascript:void(0);"> Welcome {{ Auth::user()->first_name }}</a>
                            <ul type="none" class="prfl-list">
                                <li><a href="{{ route('dashboard') }}"><i class="fa fa-list"></i>Dashboard</a></li>
                                <li><a href="{{ route('user-profile') }}"><i class="fa fa-user"></i>Profile</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>Log Out</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('index') }}"> Home</a></li>
                        <li><a href="#"> How it works?</a></li>
                        <li><a href="#"> Services</a></li>
                        <li><a href="#"> About</a></li>
                        <li><a href="{{ route('login') }}"> LOGIN</a></li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>