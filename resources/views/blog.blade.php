@extends('layouts.default')


{{-- page title --}}
@section('title')
    Blogs
    @parent
@stop


{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <!-- blog start -->

    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.transitions.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/vallenato.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/simple-line-icons.css') }}">
    <!-- blog end -->

    <style type="text/css">

        .blog-page-sec{
            padding-top: 20px;
        }
        
        .dashboard-contnt{
            background-color:#FFFFFF;
            padding-bottom: 60px;
        }

        .blog-catg-box img{
            height: 165px;

        }

        .blog-catg-box{
            min-height: 380px;
        }

        .red{
            color:#FF0000;
        }

    </style>
    <!--end of page level css-->
@stop


@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
        <div class="blog-page-sec">
            <div class="blog-outer">
               @include('notifications')
                <!-- <div class="blog-top-head">
                    <h4>Cartumo Blog</h4>
                    <div class="head-divider m-b-0"></div>
                </div> -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="blog-catg-sec">
                        @foreach($blogs as $blog)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <a title="{{ ucfirst($blog->title) }}" href="{{ route('blogs.show', [$blog->id]) }}">
                                    <div class="blog-catg-box">
                                        <?php
                                            $imgPath = App\Models\BaseUrl::getBlogListingThumbnailUrl();
                                        ?>
                                        @if(empty($blog->image) || !file_exists($imgPath . '/' . $blog->image))
                                            <img src="{{ asset('public/global/img/default_blog_listing.png') }}" class="img-responsive">
                                        @else
                                            <img src="{{ asset($imgPath . '/' . $blog->image) }}" class="img-responsive">
                                        @endif    
                                        <div class="blog-catg-desc">
                                            <?php
                                                $description = strip_tags($blog->description);
                                                if(strlen($description) > 50)
                                                {
                                                   $description = substr($description, 0, 47) . '...'; 
                                                }

                                                $title = strip_tags($blog->title);
                                                $title1 = $title;
                                                if(strlen($title) > 15)
                                                {
                                                    $title = substr($title, 0, 12) . '...';
                                                }

                                                $userName = strip_tags($blog->user->first_name);
                                                
                                                if(strlen($userName) > 10)
                                                {
                                                    $userName = substr($userName, 0, 7) . '...';
                                                }
                                            
                                            ?>
                                            <h3 title="{!! ucfirst($title1) !!}">{!! ucfirst($title) !!}</h3>
                                            <p title="{!! $blog->user->email !!}">{!! $userName !!}, <span title="{{ $blog->created_at->format('F d, Y') }}">{{ $blog->created_at->diffForHumans() }}</span>
                                            </p>
                                            <p>{!! wordwrap($description, 20, "\n", true) !!}</p>
                                            <p class="pull-right"><i class="fa fa-comments"></i> {{ count($blog->comments) }}  </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach    
                    </div>
                </div>
                <!-- sidebar -->
                @include('elements.blog_right-sidebar')
            </div>
        </div>
    </div>


    @stop


{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    
     <!-- blog start -->
    <script type="text/javascript" src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/wow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/vallenato.js') }}"></script>
    <!-- blog end -->    

    <!-- start blog -->
    <script type="text/javascript">
        $(".blog-share-icon").hover(function(){            
                var indexclass =  $(".blog-share-icon").index(this);
                $('.blog-share-ul').eq(indexclass).show();         
            },function(){
                var indexclass =  $(".blog-share-icon").index(this);
                $('.blog-share-ul').eq(indexclass).hide();     
            });

        $(".blog-share-ul").hover(function(){            
                var indexclass =  $(".blog-share-ul").index(this);
                $('.blog-share-ul').eq(indexclass).show();         
            },function(){
                var indexclass =  $(".blog-share-icon").index(this);
                $('.blog-share-ul').eq(indexclass).hide();     
            });
      
    </script>

    <script>
        
        $(function(){
            var header_hght=$('header').outerHeight(true);
            $('.page-wrap').css({'margin-top':header_hght});
        });

    </script>


    <script>
        $(document).ready(function() {

            var owl = $("#owl-demo");
            owl.owlCarousel({
                navigation : true,
                pagination : false,
                singleItem : true,
                transitionStyle : "fade",
                slideSpeed : 2000,
                rewindSpeed : 200,
                autoPlay : true,
                rewindNav : true,
                navigationText: [ '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>' ]
            });
        }); 
    </script>

    <script>
        wow = new WOW(
            {
                animateClass: 'animated',
                offset:       100,
                callback:     function(box) {
                    console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
            }
        );
        wow.init();

    </script>
    <!-- end blog -->    
    <!--page level js ends-->
@stop