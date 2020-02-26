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

<script src="{{ asset('public/global/vendors/ckeditor/ckeditor_full/ckeditor.js') }}"></script>

<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-12">

                <section class="panel">
                    <header class="panel-heading">
                        <h3>CMS Pages
                        </h3>
                    </header>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.cms-pages') }}">
                            {{ csrf_field() }}                            
                            <div class="form-group">
                                <h4>About Us</h4>
                                <textarea class="form-control" name="aboutUs" id="aboutUs" rows="15" cols="50">
                                {!! $aboutUs->description !!}   
                                </textarea>
                                <script>
                                    CKEDITOR.replace('aboutUs');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                        </form>
                    </div>

                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.cms-pages') }}">
                            {{ csrf_field() }}                            
                            <div class="form-group">
                                <h4>How It Works</h4>
                                <textarea class="form-control" name="howItWorks" id="howItWorks" rows="15" cols="50">
                                {!! $howItWorks->description !!}   
                                </textarea>
                                <script>
                                    CKEDITOR.replace('howItWorks');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                        </form>
                    </div>
                    
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.cms-pages') }}">
                            {{ csrf_field() }}                            
                            <div class="form-group">
                                <h4>Testimonial</h4>
                                <textarea class="form-control" name="testimonial" id="testimonial" rows="15" cols="50">
                                {!! $testimonial->description !!}   
                                </textarea>
                                <script>
                                    CKEDITOR.replace('testimonial');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                        </form>
                    </div>

                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.cms-pages') }}">
                            {{ csrf_field() }}                            
                            <div class="form-group">
                                <h4>Contact Us</h4>
                                <textarea class="form-control" name="contactUs" id="contactUs" rows="15" cols="50">
                                {!! $contactUs->description !!}   
                                </textarea>
                                <script>
                                    CKEDITOR.replace('contactUs');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                        </form>
                    </div>

                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('admin.cms-pages') }}">
                            {{ csrf_field() }}                            
                            <div class="form-group">
                                <h4>Terms And Conditions</h4>
                                <textarea class="form-control" name="termsAndConditions" id="termsAndConditions" rows="15" cols="50">
                                {!! $termsAndConditions->description !!}   
                                </textarea>
                                <script>
                                    CKEDITOR.replace('termsAndConditions');
                                </script>
                            </div>

                            <input type="submit" value="submit" class="btn btn-success">
                        </form>
                    </div>


                </section>
            </div>
        </div>
    </section>
</section>

@endsection