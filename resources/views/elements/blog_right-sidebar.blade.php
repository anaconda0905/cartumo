<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="blog-sidebar">
        <!-- <div class="blog-sid-listing">
            <h4> Search Our Blog</h4>
            <div class="blog-search-div">
                <form>
                    <div class="form-group blog-f-grp">
                        <input type="text"  class="form-control txtfield" placeholder="Search our blog" name="">
                    </div>
                    <div class="form-group blog-f-grp">
                        <a type="button" class="btn cus-btn ancr">Search</a>
                    </div>
                </form>
            </div>
        </div> -->
        <div class="blog-sid-listing">
            <h4>Categories</h4>
            <ul class="category-ul">
                @foreach($blogCategories as $blogCategory)
                <li><a href="{{ route('blogs.index'). '?category=' . $blogCategory->id }}"><i class="icon-calendar"></i>{{ $blogCategory->name }}<span class="list-count">({{ count($blogCategory->blogHasCategory) }})</span></a></li>
                @endforeach
            </ul>
        </div>

        <!-- <div id="accordion-container" class="accord-class">
            <h4 class="accordion-header">2013</h4>
            <div class="accordion-content iphone_inner">
                <div class="row">
                    <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="apply_detail_inner text-center">       
                            <p><a href="#">January</a></p>
                            <p><a href="#">February</a></p>
                            <p><a href="#">March</a></p>
                            <p><a href="#">April</a></p>
                            <p><a href="#">June</a></p>
                            <p><a href="#">July</a></p>
                            <p><a href="#">August</a></p>
                            <p><a href="#">September</a></p>
                            <p><a href="#">October</a></p>
                            <p><a href="#">November</a></p>
                            <p><a href="#">December</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="accordion-container" class="accord-class">
            <h4 class="accordion-header">2014</h4>
            <div class="accordion-content iphone_inner">
                <div class="row">
                    <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="apply_detail_inner text-center">       
                            <p><a href="#">January</a></p>
                            <p><a href="#">February</a></p>
                            <p><a href="#">March</a></p>
                            <p><a href="#">April</a></p>
                            <p><a href="#">June</a></p>
                            <p><a href="#">July</a></p>
                            <p><a href="#">August</a></p>
                            <p><a href="#">September</a></p>
                            <p><a href="#">October</a></p>
                            <p><a href="#">November</a></p>
                            <p><a href="#">December</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="accordion-container" class="accord-class">
            <h4 class="accordion-header">2015</h4>
            <div class="accordion-content iphone_inner">
                <div class="row">
                    <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="apply_detail_inner text-center">       
                            <p><a href="#">January</a></p>
                            <p><a href="#">February</a></p>
                            <p><a href="#">March</a></p>
                            <p><a href="#">April</a></p>
                            <p><a href="#">June</a></p>
                            <p><a href="#">July</a></p>
                            <p><a href="#">August</a></p>
                            <p><a href="#">September</a></p>
                            <p><a href="#">October</a></p>
                            <p><a href="#">November</a></p>
                            <p><a href="#">December</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="accordion-container" class="accord-class">
            <h4 class="accordion-header">2016</h4>
            <div class="accordion-content iphone_inner">
                <div class="row">
                    <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="apply_detail_inner text-center">       
                            <p><a href="#">January</a></p>
                            <p><a href="#">February</a></p>
                            <p><a href="#">March</a></p>
                            <p><a href="#">April</a></p>
                            <p><a href="#">June</a></p>
                            <p><a href="#">July</a></p>
                            <p><a href="#">August</a></p>
                            <p><a href="#">September</a></p>
                            <p><a href="#">October</a></p>
                            <p><a href="#">November</a></p>
                            <p><a href="#">December</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="accordion-container" class="accord-class">
            <h4 class="accordion-header">2017</h4>
            <div class="accordion-content iphone_inner">
                <div class="row">
                    <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="apply_detail_inner text-center">       
                            <p><a href="#">January</a></p>
                            <p><a href="#">February</a></p>
                            <p><a href="#">March</a></p>
                            <p><a href="#">April</a></p>
                            <p><a href="#">June</a></p>
                            <p><a href="#">July</a></p>
                            <p><a href="#">August</a></p>
                            <p><a href="#">September</a></p>
                            <p><a href="#">October</a></p>
                            <p><a href="#">November</a></p>
                            <p><a href="#">December</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        

        <div class="blog-sid-listing">
            <h4>Recent Posts</h4>  
            <ul class="recent-posts">
                <?php
                    $recentPosts = App\Blog::orderBy('id', 'desc')->limit(10)->get();
                ?>
                @foreach($recentPosts as $recentPost)
                    <li>
                        <div class="col-sm-4 p-0">
                            <div class="blog-s-img">
                                <?php
                                    $imgPath = App\BaseUrl::getRecentPostsThumbnailUrl();
                                ?>
                                @if(empty($recentPost->image) || !file_exists($imgPath . '/' . $recentPost->image))
                                <a href="{{ route('blogs.show', [$recentPost->id]) }}">
                                    <img src="{{ asset('public/global/img/default_recent_post.png') }}" class="img-responsive">
                                </a>    
                                @else
                                <a href="{{ route('blogs.show', [$recentPost->id]) }}">
                                    <img src="{{ asset($imgPath . '/' . $recentPost->image) }}" class="img-responsive">
                                </a>    
                                @endif   
                            </div>
                        </div>
                        <div class="col-sm-8 p-0">
                            <div class="blog-s-content">
                                <a href="{{ route('blogs.show', [$recentPost->id]) }}">{{ $recentPost->title }} </a>
                                <span class="posted-s-date"><i class="icon-clock"></i>{{ date('M d, Y', strtotime($recentPost->created_at)) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach   
            </ul>
        </div>
    </div>
</div>