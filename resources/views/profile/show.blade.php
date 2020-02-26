@extends('layouts.app')

@section("title", "Profile")

@section('content')


        <!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
        <div class="title_left">
            <h3>User Profile</h3>
        </div>
    </div>

    <div class="row clearfix">

        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_content">
                    <form>
                        <div class="form-group">
                            <div class="clearfix">
                                <div class="col-md-6 has-feedback">
                                    {{ Form::label('first_name', 'First Name:') }}
                                    {{ Form::text('first_name', explode(' ', Auth::user()->name)[0], array('class' => 'form-control, has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '')) }}
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('last_name', 'Last Name:') }}
                                    {{ Form::text('last_name', (!empty(explode(' ', Auth::user()->name)[1])) ? explode(' ', Auth::user()->name)[1] : '', array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="clearfix">
                                <div class="col-md-6">
                                    {{ Form::label('email', 'Email:') }}
                                    {{ Form::email('email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('password', 'Password:') }}
                                    {{ Form::password('password', array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    {{ Form::label('city', 'City:') }}
                                    {{ Form::text('city', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('country', 'Country:') }}
                                    {{ Form::text('country', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    {{ Form::label('locale', 'Locale:') }}
                                    {{ Form::text('locale', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('phone', 'Phone:') }}
                                    {{ Form::text('phone', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('street_address', 'Street Address:') }}
                            {{ Form::textarea('street_address', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                        </div>

                        <div class="row form-group">
                            <div class="clearfix">
                                <div class="col-md-6">
                                    {{ Form::label('state', 'State:') }}
                                    {{ Form::text('state', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('zip', 'Zip:') }}
                                    {{ Form::text('zip', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255)) }}
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>





        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_content">
                    test
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
        <!-- js placed at the end of the document so the pages load faster -->