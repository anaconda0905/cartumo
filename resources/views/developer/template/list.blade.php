@extends('layouts.developer')

@section("title", "Template List")

@section('styles')
    <style>
        .template-list-items {

        }

        .template-list-items > .item {
            padding: 15px;
            margin-bottom: 15px;
        }

        .template-list-items > .item .wrap {

        }
        .template-list-items > .item .image {
            min-height: 150px;
            max-height: 150px;
            overflow: hidden;
        }
        .template-list-items > .item img {

        }
        .template-list-items > .item strong {

        }
        .template-list-items > .item .details {
            padding: 7px 0px;
        }
        .template-list-items > .item .details > strong {
        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <!-- /top tiles -->

        <br/>

        <div class="row clearfix">
            <div class="col-md-8 col-xs-8">
                <div class="row">
                    <div class="dashboard-search">
                        <form action="{{ route('funnels.search') }}" method="post">
                            <div class="form-group col-sm-12 col-md-9 col-xs-12">
                                <input type="text" name="search" id="search_funnels" class="form-control"
                                       placeholder="Search template ..."/>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xs-12">

                                <button type="button" class="btn special-button-primary btn-block" data-toggle="modal"
                                        data-target="#addNewTemplateModal">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Template
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph">

                            <div class="col-xs-12 bg-white dashboard-funnels" style="padding-top: 15px">

                                <div id="myTabContent2" class="tab-content">
                                    <div class="rows clearfix template-list-items">
                                        @if ( (count($data['page_templates']) > 0) )
                                            @foreach ( $data['page_templates'] as $key=>$pageTemplate )
                                                <div class="col-md-4 item">
                                                    <div class="wrapper">
                                                        <a href="{{ route('developer.templates.show', $pageTemplate->id) }}">
                                                            <div class="image">
                                                                @if ( is_readable(public_path('developers/images/uploads/' . basename($pageTemplate->image))) )
                                                                    <img src="{{ asset('asset/Timthumb.php?src=') . asset( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $pageTemplate->image . env('TEMPLATE_IMAGE_SIZE') ) }}"
                                                                     style="width: 100%"/>
                                                                @else
                                                                    <img src="http://via.placeholder.com/350x300" style="width: 100%"/>
                                                                @endif
                                                            </div>
                                                            <div class="details">
																<?php //print_r($pageTemplate->category); die; ?>
                                                                <strong>{{ $pageTemplate->title }}</strong>
                                                                <small>{{
                                                                    $pageTemplate->getCategory($pageTemplate->type)->name
                                                                    }}
                                                                </small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <p>No Templates you have created yet.</p>
                                                @endif
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 col-xs-4">
                <div class="x_panel">
                    <div class="x_content">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODALS -->
    <div id="addNewTemplateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="frm_new_template" action="{{ route('developer.templates.store') }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Template</h4>
                    </div>
                    <div class="modal-body">

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_general" id="pannels-tabb" role="tab" data-toggle="tab"
                                       aria-controls="funnels" aria-expanded="true">
                                        <i class="fa fa-bars" aria-hidden="true"></i> General
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab_image" id="pannels-tabb2" role="tab" data-toggle="tab"
                                       aria-controls="funnels">
                                        <i class="fa fa-file-image-o" aria-hidden="true"></i> Image
                                    </a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_payment_type" role="tab"
                                                                    id="archived-tabb"
                                                                    data-toggle="tab" aria-controls="archived"
                                                                    aria-expanded="false"><i class="fa fa-usd"
                                                                                             aria-hidden="true"></i>
                                        Payment Type</a>
                                </li>
                            </ul>

                            <div id="myTabContent2" class="tab-content">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_general"
                                     aria-labelledby="home-tab">
                                    <div class="row clearfix">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            {{ Form::label("template_name", "Template Name*:") }}
                                            {{ Form::text('template_name', Null, array('class' => 'form-control',
                                            'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' =>
                                            'Template Name')) }}
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            {{ Form::label("template_category", "Category*:") }}
                                            {{ Form::select('template_category', $data['funnelTypes'], null,
                                            array('class' => 'form-control', 'required' => '', 'maxlength' => 255,
                                            'autofocus' => '', 'placeholder' => 'Category')) }}
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            {{ Form::label("template_description", "Description:") }}
                                            {{ Form::textarea('template_description', Null, array('class' =>
                                            'form-control', 'placeholder' => 'Template Description')) }}
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab_image"
                                     aria-labelledby="home-tab">
                                    <div class="row clearfix">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            {{ Form::label("template_image", "Image:") }}
                                            {{ Form::file('template_image', array('class' => 'form-control',
                                            'placeholder' => 'Template Image')) }}
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab_payment_type"
                                     aria-labelledby="home-tab">
                                    <div class="row clearfix">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            {{ Form::label("payment_type", "Type*:") }}
                                            {{ Form::select('payment_type', ['free'=>'Free'], null, array('class' =>
                                            'form-control')) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create Template</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @endsection
    @section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
    <script>
        $(document).ready(function () {

            $('form').parsley();

            $("#frm_new_template").submit(function (e) {

                e.preventDefault();

                var button = $(this).find('button[type="submit"]');
                var button_text = $(button).html();
                //var formData = new FormData($(this)[0]);

                var extension = $('#template_image').val().split('.').pop().toLowerCase();
                if (extension.length > 0) {
                    if ($.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                        alert('Please Select Valid File... ');
                        return false;
                    }
                }

                var template_image = $('#template_image').prop('files')[0];
                var template_name = $("#template_name").val();
                var template_category = $("#template_category").val();
                var template_description = $("#template_description").val();
                var template_type = $("#payment_type").val();

                var form_data = new FormData();
                if (typeof template_image != 'undefined')
                    form_data.append('image', template_image);

                form_data.append('template_name', template_name);
                form_data.append('template_category', template_category);
                form_data.append('template_description', template_description);
                form_data.append('payment_type', template_type);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('#csrf_token').val()
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: form_data,
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    beforeSend: function () {
                        $(button).attr('disabled', 'disabled');
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        $(button).attr('disabled', false);
                        $(button).html(button_text);

                        var json = JSON.parse(response);
                        if (json.status == 'success') {
                            location.href = json.url;
                        } else {
                            alert("Error");
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        });
    </script>
    @endsection
