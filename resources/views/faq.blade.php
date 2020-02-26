@extends('layouts.default')


{{-- page title --}}
@section('title')
    FAQ's
    @parent
@stop


{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/vallenato.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/simple-line-icons.css') }}">

    <style type="text/css">
        .div-size{
            min-height: 600px;
            margin-top: 10px;
        }

        .red{
            color:#FF0000;
        }
    </style>

@stop
     

@section('content')

        
    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 p-t-10 p-b-10 div-size">
        @include('notifications')
        @foreach($faqs as $faq)
            <div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-12 p-0">
                <div id="accordion-container" class="accord-class">
                    <h4 class="accordion-header">{{ $loop->iteration . '.' . $faq->question }}</h4>
                    <div class="accordion-content iphone_inner">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="abc">
                                    <p>Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.Lorem ipsum dolor sit amet conse ctetur voluptate velit esse cillum dolore eamet conse ctetur adipisicing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach    
    </div>


@stop    

       
{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->

    <script type="text/javascript" src="{{ asset('public/frontend/js/vallenato.js') }}"></script>
     
<!--page level js ends-->
@stop