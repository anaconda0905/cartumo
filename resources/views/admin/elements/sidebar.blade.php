<aside>
    <div id="sidebar"  class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a class="{{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="{{ route('admin.users.index') }}" >
                    <i class="fa fa-laptop"></i>
                    <span>Users</span>
                </a>
                <ul class="sub">
                    <li class="{{ (Route::currentRouteName() == 'admin.users.index') ? 'active' : '' }}">
                        <a  href="{{ route('admin.users.index') }}">All</a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.users.create') ? 'active' : '' }}">
                        <a  href="{{ route('admin.users.create') }}">Add New</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{ route('admin.blogs.index') }}" >
                    <i class="fa fa-laptop"></i>
                    <span>Blogs</span>
                </a>
                <ul class="sub">
                    <li class="{{ (Route::currentRouteName() == 'admin.blogs.index') ? 'active' : '' }}">
                        <a  href="{{ route('admin.blogs.index') }}">All</a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'admin.blogs.create') ? 'active' : '' }}">    <a  href="{{ Route('admin.blogs.create') }}">Add New</a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'admin.blogs.archived') ? 'active' : '' }}">    
                        <a href="{{ Route('admin.blogs.archived') }}">Archived</a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'admin.blog-categories.index') ? 'active' : '' }}">
                        <a  href="{{ route('admin.blog-categories.index') }}">Categories</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{ route('admin.faqs.index') }}" >
                    <i class="fa fa-laptop"></i>
                    <span>Faqs</span>
                </a>
                <ul class="sub">
                    <li class="{{ (Route::currentRouteName() == 'admin.faqs.index') ? 'active' : '' }}">
                        <a  href="{{ route('admin.faqs.index') }}">All</a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.faqs.create') ? 'active' : '' }}">
                        <a  href="{{ route('admin.faqs.create') }}">Add New</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{ route('admin.newsletters-templates.index') }}" >
                    <i class="fa fa-laptop"></i>
                    <span>Templates</span>
                </a>
                <ul class="sub">
                    <li class="{{ (Route::currentRouteName() == 'admin.newsletters-templates.index') ? 'active' : '' }}">
                        <a  href="{{ route('admin.newsletters-templates.index') }}">Newsletters</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{ route('admin.cms-pages') }}" >
                    <i class="fa fa-laptop"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub">
                    <li class="{{ (Route::currentRouteName() == 'admin.cms-pages') ? 'active' : '' }}">
                        <a  href="{{ route('admin.cms-pages') }}">CMS pages</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>