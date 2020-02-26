@extends('admin.layouts.master')

@section('title', 'StellerWinds')

@section('content')

<style type="text/css">
    .wrapper {
        min-height: 1000px;
    }

    .profileTd{
        padding-left: 10px;
    }

    .panel-body .form-control{
        color: #666666;
    }

    .red,.errEmail{
            color:#FF0000;
    }

</style>
<section id="container" class="">
    <section id="main-content">
        <section class="wrapper">
            @include('admin.elements.notifications')
            <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="panel">
                        <div class="user-heading round">
                            <?php 
                                $imgPath = App\BaseUrl::getUserProfileThumbnailUrl(); 
                            ?>
                            @if(empty($user->image) || !file_exists($imgPath . '/100x90/' . $user->image))
                                <a href="javascript:void(0);">
                                    <img src="{{ asset('public/global/uploads/images/userprofile/thumbnails/100x90/prfl.png') }}"/>
                                </a>    
                            @else
                                <a href="javascript:void(0);">
                                    <img src="{{ asset($imgPath . '/100x90/' . $user->image) }}"/>
                                </a>
                            @endif
                            <h1>{{ $user->first_name }}</h1>
                            <p>{{ $user->email }}</p>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ (Route::currentRouteName() == 'admin.users.show') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.show', [$user->id]) }}"> <i class="fa fa-user"></i> Profile</a>
                            </li>
                            <!-- <li>
                                <a href="profile-activity.html"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a>
                            </li> -->
                            <li class="{{ (Route::currentRouteName() == 'admin.users.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.edit', [$user->id]) }}"> <i class="fa fa-edit"></i> Edit profile</a>
                            </li>
                        </ul>
                    </section>
                </aside>
                <aside class="profile-info col-lg-9">
                    <section class="panel">
                        <!-- <div class="bio-graph-heading">
                            Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                        </div> -->
                        <div class="panel-body bio-graph-info">
                            <?php

                                $first_name = Session::has('first_name') ? Session::get('first_name') : '';
                                $last_name   = Session::has('last_name') ? Session::get('last_name') : '';
                                $email   = Session::has('email') ? Session::get('email') : '';
                            ?>

                            <h1> Profile Info</h1>
                            <form class="form-horizontal" action="{{ route('admin.users.update', [$user->id]) }}" method="post" enctype="multipart/form-data" role="form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">First Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" id="f-name" placeholder=" ">
                                        @if ($errors->any() && $errors->first('first_name') != "")
                                            <span class="help-block red">
                                                {!! $errors->first('first_name') !!}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Last Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="l-name" placeholder=" ">
                                        @if ($errors->any() && $errors->first('last_name') != "")
                                            <span class="help-block red">
                                                {!! $errors->first('last_name') !!}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder=" ">
                                        @if ($errors->any() && $errors->first('email') != "")
                                            <span class="help-block red">
                                                {!! $errors->first('email') !!}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Image</label>
                                    <div class="col-lg-6">
                                        <?php
                                            $img_path = App\BaseUrl::getUserProfileThumbnailUrl(); 
                                        ?>
                                        @if(empty($user->image) || !file_exists($img_path . '/100x90/' . $user->image ))
                                            <img class="img-responsive" src="{{ asset('public/global/uploads/images/userprofile/thumbnails/100x90/prfl.png') }}" height="50px;" width="100px;">
                                        @else
                                            <img class="img-responsive" src="{{ asset($img_path . '/100x90/' . $user->image) }}" height="50px;" width="100px;">
                                        @endif
                                    </div>    
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">New Image</label>
                                    <div class="col-lg-6">
                                        <input type="file" name="image">
                                        <!-- {!! $errors->first('image', '<span class="help-block red">:message</span>') !!} -->
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" value="submit" class="btn btn-success">
                                        <a href="{{ route('admin.users.index') }}">
                                            <button class="btn btn-danger" type="button">Cancel</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section>
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Sets New Password</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="post" action="{{ route('admin.user.change.password', [$user->id]) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label  class="col-lg-2 control-label">Old Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="oldPassword" class="form-control" id="c-pwd">
                                            {!! $errors->first('oldPassword', '<span class="help-block red">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-lg-2 control-label">New Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="password" class="form-control" id="n-pwd">
                                            {!! $errors->first('password', '<span class="help-block red">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-lg-2 control-label">Re-type New Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="confirmPassword" class="form-control" id="rt-pwd">
                                            {!! $errors->first('confirmPassword', '<span class="help-block red">:message</span>') !!}
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label  class="col-lg-2 control-label">Change Avatar</label>
                                        <div class="col-lg-6">
                                            <input type="file" class="file-pos" id="exampleInputFile">
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="submit" value="submit" class="btn btn-success">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
    </section>
</section>    
 @endsection