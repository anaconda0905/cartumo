@include('admin.partials.header')
    <input type="hidden" id="hid_base_url" value="{{ url('/') }}" />
    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
    <div class="container body">
        <div class="main_container">
            @include('admin.partials.leftnav')
            @include('admin.partials.nav')

            @yield('content')
        </div>
    </div>
@include('admin.partials.footer')
