@extends('layouts.app')

@section("title", "SMTP List")

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title clearfix">
            <div class="title_left">
                <h3><i class="fa fa-paper-plane"></i> Setup Email SMTP Settings</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <hr/>

        <div class="row clearfix">

            <div class="x_panel">
                <div class="x_content">
                    {!! Form::model($smtpSetting, array('route' => ['smtp.update', $smtpSetting->id], 'method' => 'PUT', 'data-parsley-required' => '', 'id' => 'frm_smtp_settings')) !!}

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('title', 'Title:') }}
                            {{ Form::text('title', null, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Title')) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('form_name', 'From Name:') }}
                            {{ Form::text('form_name', null, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'From Name')) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('form_email', 'From Email:') }}
                            {{ Form::text('form_email', null, array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'From Email')) }}
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('smtp_server', 'Smtp Server:') }}
                            {{ Form::text('smtp_server', null, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'SMTP Server')) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('smtp_port', 'Smtp Port:') }}
                            {{ Form::text('smtp_port', null, array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'SMTP Port')) }}
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('smtp_user', 'Smtp User:') }}
                            {{ Form::text('smtp_user', null, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'SMTP User')) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('smtp_password', 'Smtp Password:') }}
                            {{ Form::text('smtp_password', null, array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'SMTP Password')) }}
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::label('smtp_domain', 'Smtp Domain:') }}
                            {{ Form::text('smtp_domain', null, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'SMTP Domain')) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-xs-12 form-group">
                            {{ Form::label('smtp_footer', 'Smtp Footer:') }}
                            {{ Form::textarea('smtp_footer', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Footer Added to all Outgoing Emails.')) }}
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            {{ Form::label('status', 'Status:') }}
                            {{ Form::select('status', [1=>'Enabled', 0=>'Disabled'], null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'placeholder' => 'SMTP Status')) }}
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{ route('smtp.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            $("#frm_smtp_settings").submit(function (e) {

                var element = $(this).find("button[type='submit']");
                var form = $(this);

                $.ajax({
                    type: 'post',
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    beforeSend: function () {
                        $(element).html('<i class="fa-li fa fa-spinner fa-spin"></i>');
                        $(element).prop('disabled', 'disabled');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = json.url;
                        } else {
                            alert(json.message)
                        }
                    }
                });
            });
        });
    </script>
@endsection
