@extends('layouts.admin')

@section('title', 'Edit Feature Upgrade')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit Feature Upgrade
                <small>Edit upgrade</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.feature-upgrade.index') }}">Feature Upgrades</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Edit Feature Upgrade
                </li>
            </ol>
        </div>
    </div>

    @if(!empty($errors))
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">

        <div class="col-md-6 form-upgrade">

                    {!! Form::model($data['feature_upgrade'], array('route' => ['admin.feature-upgrade.update', $data['feature_upgrade']->id], 'method' => 'PUT', 'data-parsley-required' => '')) !!}
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::label('name', 'Name:') }}
                                {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 191, 'autofocus' => '')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Description:') }}
                                {{ Form::textarea('description', null, array('class' => 'form-control', 'maxlength' => 191)) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('type', 'Type:') }}
                                {{ Form::text('type', null, array('class'=>'form-control', 'required' => '' ) ) }}
                            </div>

                            <div class="form-group clearfix">
                                <?php $details = json_decode($data['feature_upgrade']->details); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::label('monthly', 'Monthly:') }}
                                        {{ Form::text('monthly', $details->payment->monthly, array('name' => 'details[payment][monthly]', 'class'=>'form-control', 'required' => '' ) ) }}
                                    </div>

                                    <div class="col-md-6">
                                        {{ Form::label('yearly', 'Yearly:') }}
                                        {{ Form::text('yearly', $details->payment->yearly, array('name' => 'details[payment][yearly]', 'class'=>'form-control', 'required' => '' ) ) }}
                                    </div>
                                </div>                                
                            </div>                                              

                            <div class="form-group">
                                {{ Form::Label('status', 'Status:') }}
                                {{ Form::select('status', ['Disabled', 'Enabled'], null, ['class' => 'form-control', 'required' => '']) }}
                            </div>                            

                            <!-- Change this to a button or input when using this as a form -->
                            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-lg btn-block btn-submit-form')) }}
                        </fieldset>
                    {!! Form::close() !!}

        </div>

    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();
    </script>
@endsection
