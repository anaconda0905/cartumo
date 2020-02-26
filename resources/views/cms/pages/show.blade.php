@extends('layouts.page')
@section('content')
    <section class="section-padding-top" id="price-page">
        <div class="container">
            <div class="row">
                <!--<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title purple" title="Simple and Transparent Pricing">Simple and Transparent
                            Pricing</h4>
                        <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few,
                            as
                            you want.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>-->
            <div class="row clearfix">
                <div class="col-xs-12">
                    {!! $cmsPage->details !!}
                </div>
            </div>
        </div>
    </section>
@endsection