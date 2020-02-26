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

<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>

<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Add New Blog
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
                        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.blogs.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $title }}">
                                @if ($errors->any() && $errors->first('title') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('title') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="text-area" rows="15" cols="50">{{ $description }}
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
                                <input type="file" name="image" id="">
                                @if ($errors->any() && $errors->first('image') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('image') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option selected="selected" value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @if ($errors->any() && $errors->first('status') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('status') !!}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                @foreach($blogCategories as $blogCategory)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="categories[]" value="{{ $blogCategory->id }}">
                                            {{ $blogCategory->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                            <a href="{{ route('admin.blogs.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection