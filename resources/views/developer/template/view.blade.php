@extends('layouts.developer')

@section("title", "Template Details")

@section('styles')
    <style>
        .template-details {

        }

        .template-details .template-desc {

        }

        .template-details .template-desc .template-info {
            list-style-type: none;
            padding: 0px;
        }

        .template-details .template-desc .template-info li {
            display: inline-block;
            border-right: 2px solid #ccc;
            padding-right: 7px;
            line-height: 11px;
            font-size: 14px;
        }

        .template-details .template-desc .template-info li:last-child {
            border-right: none;
            padding-left: 4px;
        }

        .template-details .template-desc img {
            width: 100%
        }

        .template-details .template-desc .desc {
            padding: 15px;
            background: #eee
        }

        .template-details .template-desc .desc ul {
            list-style-type: none;
            padding: 0px;
        }

        .template-details .template-desc .desc ul > li {
            display: inline-block
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph clearfic">

                            <div class="col-xs-12 bg-white template-details" style="padding-top: 15px">

                                <div class="row clearfix">
                                    <div class="col-md-6 col-md-offset-3 template-desc">
                                        <h3>{{ $data['pageTemplate']->title }}</h3>
                                        <ul class="template-info">
                                            <li>Category:
                                                <strong>{{ $data['pageTemplate']->getCategory($data['pageTemplate']->type)->name }}</strong>
                                            </li>
                                            <li>Last Update:
                                                <small>{{ date('d m, Y', strtotime($data['pageTemplate']->updated_at)) }}</small>
                                            </li>
                                        </ul>
                                        <img src="{{ $data['pageTemplate']->image }}"/>
                                        <div class="desc">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('developer.template.design', $data['pageTemplate']->id) }}"
                                                       target="_blank" class="btn special-button-success">Design
                                                        template</a></li>
                                                <li>
                                                    <button type="button" class="btn special-button-primary btn-block"
                                                            data-toggle="modal"
                                                            data-target="#updateTemplateModal"><i class="fa fa-pencil"
                                                                                                  aria-hidden="true"></i>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" id="button_clear_content"
                                                            class="btn special-button-warning" title="Clear Content"
                                                            data-action="{{ route('developer.template.clear', $data['pageTemplate']->id) }}">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                </li>
                                                <li>
                                                    <button type="button" id="button_remove_template"
                                                            class="btn special-button-danger" title="Remove template"
                                                            data-action="{{ route('developer.templates.destroy', $data['pageTemplate']->id) }}">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </li>
                                            </ul>
                                        </div>
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
    <div id="updateTemplateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <!--<form id="frm_update_template" action="{{-- route('developer.templates.update') --}}" method="post">-->
                {!! Form::model($data['pageTemplate'], array('route' => ['developer.template.update', $data['pageTemplate']->id], 'id'=>'frm_update_template')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Template</h4>
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
                                                                                         aria-hidden="true"></i> Payment
                                    Type</a>
                            </li>
                        </ul>

                        <div id="myTabContent2" class="tab-content">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_general"
                                 aria-labelledby="home-tab">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        {{ Form::label("title", "Template Name*:") }}
                                        {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Template Name')) }}
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        {{ Form::label("type", "Category*:") }}
                                        {{ Form::select('type', $data['funnelTypes'], null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Category')) }}
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        {{ Form::label("decription", "Description:") }}
                                        {{ Form::textarea('decription', null, array('class' => 'form-control', 'placeholder' => 'Template Description')) }}
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        {{ Form::label("status", "Status*:") }}
                                        {{ Form::select('status', [false=>'Not Available', true=>'Available'], null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_image"
                                 aria-labelledby="home-tab">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        {{ Form::label("image", "Image:") }}
                                        {{ Form::file('image', array('class' => 'form-control', 'placeholder' => 'Template Image')) }}
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_payment_type"
                                 aria-labelledby="home-tab">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        {{ Form::label("payment_type", "Type*:") }}
                                        {{ Form::select('payment_type', ['free'=>'Free'], null, array('class' => 'form-control')) }}
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

            //clear content
            $("#button_clear_content").click(function (e) {

                e.preventDefault();

                var button = $(this);
                var button_text = $(button).html();

                if (confirm("Are you sure to clear all the template contents?")) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('#csrf_token').val()
                        }
                    });

                    $.ajax({
                        type: 'GET',
                        url: $(button).attr('data-action'),
                        //data: 'template_id=' + $(button).attr('data-template-id'),
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
                                alert(json.message);
                            } else {
                                alert(json.message);
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });

            //remove template
            $("#button_remove_template").click(function (e) {

                e.preventDefault();

                var button = $(this);
                var button_text = $(button).html();

                if (confirm("Are you sure to remove the template?")) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('#csrf_token').val()
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: $(button).attr('data-action'),
                        //data: 'template_id=' + $(button).attr('data-template-id'),
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
                                alert(json.message);
                            }
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }
            });
        });

        $("#frm_update_template").submit(function (e) {

            e.preventDefault();

            var button = $(this).find('button[type="submit"]');
            var button_text = $(button).html();
            //var formData = new FormData($(this)[0]);

            var extension = $('#image').val().split('.').pop().toLowerCase();
            if (extension.length > 0) {
                if ($.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                    alert('Please Select Valid File... ');
                    return false;
                }
            }


            var template_image = $('#image').prop('files')[0];
            var template_name = $("#title").val();
            var template_category = $("#type").val();
            var template_description = $("#description").val();
            var template_type = $("#payment_type").val();
            var status = $("#status").val();

            var form_data = new FormData();
            if (typeof template_image != 'undefined')
                form_data.append('image', template_image);

            form_data.append('template_name', template_name);
            form_data.append('template_category', template_category);
            form_data.append('template_description', template_description);
            form_data.append('payment_type', template_type);
            form_data.append('status', status);

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
                    }
                },
                error: function (a, b) {
                    console.log(a.responseText);
                }
            });
        });
    </script>
@endsection
