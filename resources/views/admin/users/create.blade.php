@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<style type="text/css">
    .red{
        color:#FF0000;
    }

    .panel-body .form-control
    {
        color: #666666;
    }
    .wrapper-area {
        min-height: 710px;
    }
</style>


<section id="main-content">
    <section class="wrapper wrapper-area">
    @include('admin.elements.notifications')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Add New User
                            <a class="btn btn-primary pull-right" href="{{ route('admin.users.index') }}">Back</a>
                        </h3>
                    </header>
                    <div class="panel-body">
                        <?php

                            $first_name = Session::has('first_name') ? Session::get('first_name') : '';
                            $last_name   = Session::has('last_name') ? Session::get('last_name') : '';
                            $email   = Session::has('email') ? Session::get('email') : '';
                        ?>
                        <form role="form" method="post" action="{{ route('admin.users.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{ $first_name }}">
                                @if ($errors->any() && $errors->first('first_name') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('first_name') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ $last_name }}">
                                @if ($errors->any() && $errors->first('last_name') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('last_name') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{ $email }}">
                                @if ($errors->any() && $errors->first('email') != "")
                                    <span class="help-block red">
                                        {!! $errors->first('email') !!}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                {!! $errors->first('password', '<span class="help-block red">:message</span>') !!}
                            </div>

                            <div class="form-group ">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirmPassword">
                                {!! $errors->first('confirmPassword', '<span class="help-block red">:message</span>') !!}
                            </div>
                            
                            <input type="submit" value="submit" class="btn btn-success">
                            <a href="{{ route('admin.users.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection