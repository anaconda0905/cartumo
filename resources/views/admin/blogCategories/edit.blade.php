@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<style type="text/css">
    .red{
        color:#FF0000;
    }
</style>

<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Edit Blog Category
                            <a class="btn btn-primary pull-right" href="{{ route('admin.blog-categories.index') }}">Back</a>
                        </h3>
                    </header>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.blog-categories.update', [$blogCategory->id]) }}">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Title" value="{{ $blogCategory->name }}">
                                {!! $errors->first('name', '<span class="help-block red">:message</span>') !!}
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                            
                            <a href="{{ route('admin.blog-categories.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection