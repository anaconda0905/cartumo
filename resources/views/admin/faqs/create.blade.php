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

    .wrapper-area {
    min-height: 710px;
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
                        <h3>Add New Faq
                            <a class="btn btn-primary pull-right" href="{{ route('admin.faqs.index') }}">Back</a>
                        </h3>
                    </header>
                    <div class="panel-body">
                        <?php

                            $question = Session::has('question') ? Session::get('question') : '';
                            $answer   = Session::has('answer') ? Session::get('answer') : '';
                        ?>
                        <form role="form" method="post" action="{{ route('admin.faqs.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label>Question</label>
                                <input type="text" class="form-control" name="question" placeholder="Enter Question" value="{{ $question }}">
                                @if ($errors->any() && $errors->first('question') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('question') !!}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Answer</label>
                                <textarea class="form-control" name="answer"  id="text-area" rows="15" cols="50">{{ $answer }}  
                                </textarea>
                                @if ($errors->any() && $errors->first('answer') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('answer') !!}
                                    </span>
                                @endif
                                <script>
                                    CKEDITOR.replace('text-area');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                            <a href="{{ route('admin.faqs.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection