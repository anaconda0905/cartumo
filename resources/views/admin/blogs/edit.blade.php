@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<style type="text/css">
    .red{
        color:#FF0000;
    }

    .panel-body .form-control{
        color: #666666;
    }
</style>

<?php
    $resourceName = "Move to Archive";
?>

@include('admin.elements.modal-archive')

<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>

<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Edit Blog
                            <a class="btn btn-primary pull-right" href="{{ route('admin.blogs.index') }}">Back</a>
                        </h3>
                    </header>
                    <div class="panel-body">
                        <?php

                            $title = Session::has('title') ? Session::get('title') : '';
                            $description   = Session::has('description') ? Session::get('description') : '';
                            $image = Session::has('image') ? Session::get('image') : '';
                            $status   = Session::has('status') ? Session::get('status') : '';
                        ?>
                        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.blogs.update', [$blog->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $blog->title }}">
                                @if ($errors->any() && $errors->first('title') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('title') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="text-area" rows="15" cols="50">
                                {{ $blog->description }}   
                                </textarea>

                                @if ($errors->any() && $errors->first('description') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('description') !!}
                                    </span>
                                @endif
                                <script>
                                    CKEDITOR.replace('text-area');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <?php
                                    $img_path = App\BaseUrl::getRecentPostsThumbnailUrl(); 
                                ?>
                                @if(empty($blog->image) || !file_exists($img_path . '/' . $blog->image ))
                                    <img class="img-responsive" src="{{ asset('public/global/img/default_recent_post.png') }}" height="50px;" width="100px;">
                                @else
                                    <img class="img-responsive" src="{{ asset($img_path . '/' . $blog->image) }}" height="50px;" width="100px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label>New Image</label>
                                <input type="file" name="image">
                                @if ($errors->any() && $errors->first('image') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('image') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option selected="selected">Select Status</option>
                                    <option value="1"   
                                    @if($blog->status == 1)
                                        selected="selected"
                                    @endif    
                                        >Active</option>
                                    <option value="0" 
                                    @if($blog->status == 0)
                                        selected="selected"
                                    @endif    
                                    >Inactive</option>
                                </select>
                                {!! $errors->first('status', '<span class="help-block red">:message</span>') !!}
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                @foreach($blogCategories as $blogCategory)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="categories[]" value="{{ $blogCategory->id }}" {{ in_array($blogCategory->id, $blogHasCategories) ? 'checked' : '' }}>
                                            {{ $blogCategory->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                            <a href="{{ route('admin.blogs.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>

                            <a href="{{ route('admin.blogs.move-to-archive', [$blog->id]) }}" class="btn btn-primary btn-confirm-moveArchive pull-right">Move to Archive</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript">

    $(".btn-confirm-moveArchive").on('click', function(e){

        e.preventDefault();
        href = $(this).attr('href');
        $("#frmMoveArchive").attr('action', href);
        $("#modalArchive").modal("show");

    });

</script>

@endsection