<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 p-0 m-0 fixed-demo">
    <div class="side-small-sec">
        <ul type="none" class="dash-list p-0 m-0">
            <li class="{{ (Route::currentRouteName() == 'dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-list"></i>Dashboard</a></li>
            <li class="{{ (Route::currentRouteName() == 'user-profile') ? 'active' : '' }}"><a href="{{ route('user-profile') }}"><i class="icon-profile"></i>Account Details</a></li>
            <li class="{{ (Route::currentRouteName() == 'funnels') ? 'active' : '' }}"><a href="{{ route('funnels') }}"><i class="icon-profile "></i>Funnels</a></li>
            <!--<li class="{{ (Route::currentRouteName() == 'blogs.index') ? 'active' : '' }}"><a href="{{ route('blogs.index') }}"><i class="icon-profile "></i>Blogs</a></li>-->
            <!-- <li><a href="#"><i class="icon-flag"></i>Growth &amp; Goals</a></li>
            <li><a href="#"><i class="icon-chart"></i>Trends</a></li>
            <li><a href="#"><i class="icon-graph"></i>Cash Flow</a></li>
            <li><a href="#"><i class="icon-people"></i>Customers</a></li>
            <li><a href="#"><i class="icon-refresh"></i>Retain</a></li>
            <li><a href="#"><i class="icon-pie-chart"></i>Transaction</a></li>
            <li><a href="#"><i class="icon-book-open"></i>Learn</a></li> -->
        </ul>
    </div>
</div>