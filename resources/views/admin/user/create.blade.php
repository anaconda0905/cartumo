@extends('layouts.admin')

@section('title', 'Add New User')

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
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.user.index') }}">User</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add User
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

                    {!! Form::open(array('route' => 'admin.user.store')) !!}
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
                                        {{ Form::label('confirm_password', 'Confrm Password:') }}
                                        {{ Form::password('confirm_password', array('class'=>'form-control', 'required' => '', 'data-parsley-equalto' => '#password' ) ) }}
                                    </div>
                                </div>                                
                            </div>                                                     

                            <div class="form-group">
                                {{ Form::Label('status', 'Status:') }}
                                {{ Form::select('status', ['Disabled', 'Enabled'], null, ['class' => 'form-control', 'required' => '']) }}
                            </div>

                            <div class="form-group" style="margin-bottom: 0px">
                                <div class="col-md-12s">
                                    <label for="secret_code" class="control-label" style="text-align:left">
                                        <input type="checkbox" name="secret_code" id="secret_code" />
                                        Have a Secret Code?
                                    </label>

                                    <input id="secret_code_text" type="text" class="form-control" name="secret_code_text" placeholder="Enter the secret code" style="display: none">
                                </div>
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

        $(document).on("click", "#secret_code", function(e) {

            //e.preventDefault();

            //alert(this);

            if ( $(this).is(":checked") ) {
                $(this).parent().next().show();
                $(this).parent().next().focus();
            }
            else
                $(this).parent().next().hide();
        });
    </script>
@endsection
