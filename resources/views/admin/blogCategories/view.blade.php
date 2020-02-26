@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<section id="main-content">
    <section class="wrapper wrapper-area">
        @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <h3> Blog View
                            <a class="btn btn-primary pull-right" href="{{ route('admin.blogs.index') }}">Back</a>
                        </h3>
                    </header>
                    <div class="panel-body">
                        <div class="form-group ">
                            <?php
                                $img_path = App\BaseUrl::getBlogImageUrl(); 
                            ?>
                            @if(!file_exists($img_path . '/' . $blog->image ))
                                <img class="img-responsive" src="{{ asset('public/global/img/abc.png') }}" >
                            @else
                                <img class="img-responsive" src="{{ asset($img_path . '/' . $blog->image) }}" >
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group ">
                            <h4>
                                {{ $blog->title }}
                            </h4>   
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group ">
                            {{ strip_tags($blog->description) }}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group ">
                            @if($blog->status == '1')
                                <span class="label label-success label-mini spn-status" blog-id="{{ $blog->id }}">Active</span>
                            @else
                                <span class="label label-danger label-mini spn-status" blog-id="{{ $blog->id }}">Inactive</span>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

@endsection
                    
