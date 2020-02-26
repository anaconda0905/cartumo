@extends('layouts.default')


{{-- Page Title --}}
@section('title')
    How It Works
    @parent
@stop


{{-- Page Level Styles --}}
@section('header_styles')
    <!--page level css starts-->
    <style type="text/css">
        .profile-area{
            min-height: 710px;
        }

        .red{
            color:#FF0000;
        }
    </style>
@stop


@section('content')
        
    <section class="profile-area">
        @include('notifications')
        <div class="container">
            {!! $content !!}
        </div>
    </section>


@stop


{{-- Page Level Scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>

    <!--page level js ends-->
@stop
    


    