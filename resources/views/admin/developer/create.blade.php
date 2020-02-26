@extends('layouts.admin')

@section('title', 'Add New Developer')

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
                New user
                <small>Add new user</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.developer.index') }}">Developer</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add Developer
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

        <div class="col-md-6 form-user">

                    {!! Form::open(array('route' => 'admin.developer.store')) !!}
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::label('name', 'Name:') }}
                                {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('email', 'Email Address:') }}
                                {{ Form::text('email', null, array('class'=>'form-control', 'required' => '' ) ) }}
                            </div>

                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::label('password', 'Password:') }}
                                        {{ Form::password('password', array('class'=>'form-control', 'required' => '' ) ) }}
                                    </div>

                                    <div class="col-md-6">
                                        {{ Form::label('confirm_password', 'Confirm Password:') }}
                                        {{ Form::password('confirm_password', array('class'=>'form-control', 'required' => '', 'data-parsley-equalto' => '#password' ) ) }}
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
