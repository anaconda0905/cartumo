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

    .wrapper-area{
        min-height: 710px;
    }
</style>

<script src="{{ asset('public/global/vendors/ckeditor/ckeditor_full/ckeditor.js') }}"></script>

<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>
                            Edit Newsletter Template
                        </h3>
                    </header>
                    @foreach($newsletterTemplates as $newsletterTemplate)
                        <div class="panel-body">
                            <form role="form" method="post" action="{{ route('admin.newsletters-templates.update', $newsletterTemplate->id) }}">
                                {{ csrf_field() }}                            
                                <div class="form-group">
                                    <h4>{{ $newsletterTemplate->name }}</h4>
                                    <textarea class="form-control" name="content" id="content{{ $loop->iteration }}" rows="15" cols="50">
                                    {!! $newsletterTemplate->content !!}   
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace('content{{ $loop->iteration }}');
                                    </script>
                                </div>

                                <input type="submit" value="submit" class="btn btn-success">
                            </form>
                        </div>
                    @endforeach    
                </section>
            </div>
        </div>
    </section>
</section>

@endsection