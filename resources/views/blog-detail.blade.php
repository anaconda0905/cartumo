@extends('layouts.default')


{{-- page title --}}
@section('title')
    Blog Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <!-- blog start -->
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.transitions.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/vallenato.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/simple-line-icons.css') }}">
    <!-- blog end -->
    <!--page level css starts-->
    <style type="text/css">
        .dashboard-contnt{
            background-color:#FFFFFF;
            padding-bottom: 60px;
        }

        .blog-page-sec{
            padding-top: 20px;
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
                <!-- <div class="blog-top-head">
                    <h4>Blog Posts</h4>
                    <div class="head-divider m-b-0"></div>
                </div> -->
                @include('notifications')
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="blog-post-div">
                        <div class="blog-detail-div">
                            <div class="blog-img-caption">
                                <div class="blog-post-caption">
                                @foreach($blogCategories as $blogCategory)
                                    <span class="blog-category">
                                        <a href="javascript::">
                                            {{ in_array($blogCategory->id, $blogHasCategories) ? $blogCategory->name : ''}}
                                        </a>
                                    </span>
                                @endforeach       
                                    <a href="javascript:;" title="{!! ucfirst($blog->title) !!}">{!! $blog->title !!}</a>                      
                                    <div class="blog-post-on">
                                        <span class="blog-date"><i class="icon-clock"></i>{{ date('M d, Y ', strtotime($blog->created_at)) }}</span>
                                        <span class="blog-by"><a href="javascript::" title="{!! ucfirst($blog->user->email) !!}">by {!! ucfirst($blog->user->first_name) !!}</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="large-img">
                                <?php
                                    $imgPath = App\BaseUrl::getBlogImageUrl();
                                ?>
                                @if(empty($blog->image) || !file_exists($imgPath . '/' . $blog->image))
                                    <img src="{{ asset('public/global/img/abc1.png') }}" class="img-responsive">
                                @else
                                    <img src="{{ asset($imgPath . '/' . $blog->image) }}" class="img-responsive">
                                @endif
                            </div>
                            <div class="blog-det-desc">
                                <div class="blog-dest-sec">
                                    <p>{!! wordwrap($blog->description, 70, "\n", true) !!}
                                    </p>
                                </div>
                                <div class="blog-dest-sec1">
                                    <div class="blog-post-foot">
                                        <span class="comments"><a href="javascript:;"><i class="icon-speech"></i>{{ count($blog->comments) }} comment(s)</a></span>
                                        <div class="blog-share">
                                            <ul class="blog-share-ul">
                                                <li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                            <span class="blog-share-icon"><a href="javascript:;" class="show-share-icon"><i class="icon-share"></i>Share</a></span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @foreach($blog->comments as $blogComment)
                                    <div class="comments-list-div">
                                        <div class="comment-list">
                                            <div class="row">
                                                <div class="col-md-1 col-xs-12 col-sm-1 p-r-0 r-p-0">
                                                    <div class="comt-user">

                                                        <?php 
                                                            $imgPath = App\BaseUrl::getUserProfileThumbnailUrl();
                                                            
                                                        ?>

                                                        @if( empty( $blogComment->user->image ) || !file_exists( $imgPath . '/100x90/' .  $blogComment->user->image ) )
                                                            <img src="{{ asset('public/global/uploads/images/userprofile/thumbnails/100x90/prfl.png') }}" class="img-responsive">
                                                        @else
                                                            <img src="{{ asset($imgPath . '/100x90/' . $blogComment->user->image) }}" class="img-responsive">
                                                        @endif


                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="comment-desc">
                                                        <div class="cmnt-user-info">
                                                            <div class="blog-info-left">
                                                                <span class="blog-cmnt-by">{{ ($blogComment->user) ? $blogComment->user->first_name : $blogComment->sender_name }}</span>
                                                                <span class="blog-cmnt-date"><i class="icon-clock"></i>{{ date('M d,Y', strtotime($blogComment->created_at)) }}</span>
                                                            </div>
                                                        </div>
                                                        <span class="blog-cmnt-desc">
                                                            <p>{!! $blogComment->message !!}
                                                            </p>
                                                        </span>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="comment-div-form">
                                    <h4>Leave a reply</h4>
                                    <p>Enter your name and email address. Required fields are marked *</p>
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-12 col-xs-12">
                                            <form method="post" action="{{ route('blog.comment') }}">
                                                {{ csrf_field() }}
                                                @if(!Auth::check())
                                                    <div class="form-group blog-f-grp">
                                                        <label>Name<span class="blog-req">*</span></label>
                                                        <input type="text" name="name" placeholder="Name"  class="form-control txtfield">
                                                        {!! $errors->first('name', '<span class="help-block red">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group blog-f-grp">
                                                        <label>Email<span class="blog-req">*</span></label>
                                                        <input type="text" name="email" placeholder="Email"  class="form-control txtfield">
                                                        {!! $errors->first('email', '<span class="help-block red">:message</span>') !!}
                                                    </div>
                                                @endif    
                                                <div class="form-group blog-f-grp">
                                                    <textarea name="message" placeholder="Enter your message here.." class="form-control txtfield" rows="4" cols="20"></textarea>
                                                    {!! $errors->first('message', '<span class="help-block red">:message</span>') !!}
                                                </div>
                                                <div class="form-group blog-f-grp">
                                                        <input type="hidden" name="blog_id" class="form-control txtfield" value="{{ $blog->id }}">
                                                        
                                                </div>

                                                <div class="form-group blog-f-grp">
                                                    <input type="submit" value="Post Comment" class="btn cus-btn">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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