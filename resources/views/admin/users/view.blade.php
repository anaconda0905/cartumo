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
                    <!-- <section class="panel">
                        <form>
                            <textarea placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
                        </form>
                        <footer class="panel-footer">
                            <button class="btn btn-danger pull-right">Post</button>
                            <ul class="nav nav-pills">
                                <li>
                                      <a href="#"><i class="fa fa-map-marker"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-camera"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class=" fa fa-film"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-microphone"></i></a>
                                </li>
                            </ul>
                        </footer>
                    </section> -->
                    <section class="panel">
                        <!-- <div class="bio-graph-heading">
                              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                        </div> -->
                        <div class="panel-body bio-graph-info">
                            <h1>Bio Graph</h1>
                            <table>
                                <tr>
                                    <th>First Name</th>
                                    <td class="profileTd">{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td class="profileTd">{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td class="profileTd">{{ $user->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </section>
                    <!-- <section>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-chart">
                                            <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="35" data-fgColor="#e06b7d" data-bgColor="#e8e8e8">
                                        </div>
                                        <div class="bio-desk">
                                            <h4 class="red">Envato Website</h4>
                                            <p>Started : 15 July</p>
                                            <p>Deadline : 15 August</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-chart">
                                            <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="63" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                                        </div>
                                        <div class="bio-desk">
                                            <h4 class="terques">ThemeForest CMS </h4>
                                            <p>Started : 15 July</p>
                                            <p>Deadline : 15 August</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-chart">
                                            <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="75" data-fgColor="#96be4b" data-bgColor="#e8e8e8">
                                        </div>
                                        <div class="bio-desk">
                                            <h4 class="green">VectorLab Portfolio</h4>
                                            <p>Started : 15 July</p>
                                            <p>Deadline : 15 August</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="bio-chart">
                                            <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="50" data-fgColor="#cba4db" data-bgColor="#e8e8e8">
                                        </div>
                                        <div class="bio-desk">
                                            <h4 class="purple">Adobe Muse Template</h4>
                                            <p>Started : 15 July</p>
                                            <p>Deadline : 15 August</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> -->
                </aside>
            </div>
        </section>
    </section>
</section>
@endsection