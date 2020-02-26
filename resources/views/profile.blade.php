@extends('layouts.dashboard')


{{-- page title --}}
@section('title')

    @parent
@stop


{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <style type="text/css">
        #profilePic {
            cursor: pointer;
        }

        .red {
            color: #FF0000;
        }
    </style>
    <!--end of page level css-->
@stop


@section('content')

    @include('elements.sidebar')

    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-md-offset-2 col-sm-offset-2">
        <div class="frm-contnt">
            <!-- Notifications -->
            @include('notifications')

            <div class="col-md-8 col-sm-8 col-xs-12 p-0">
				<?php

				$first_name = Session::has( 'first_name' ) ? Session::get( 'first_name' ) : '';
				$last_name = Session::has( 'last_name' ) ? Session::get( 'last_name' ) : '';
				$email = Session::has( 'email' ) ? Session::get( 'email' ) : '';
				$image = Session::has( 'image' ) ? Session::get( 'image' ) : '';
				?>
                <form method="post" action="{{ route('user-profile') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label>Your Cartumo Subdomain</label>
                        <div class="input-group">
                            <input type="text" class="form-control frm-field" id="exampleInputAmount"
                                   placeholder="inubaan">
                            <div class="input-group-addon">.cartumo.com</div>

                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="frm-divider"></div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">First Name</label>
                        <input type="text" class="form-control frm-field" name="first_name" id="exampleInputName2"
                               placeholder="First Name" value="{{ Auth::User()->first_name }}">
                        @if ($errors->any() && $errors->first('first_name') != "")
                            <span class="help-block red">
                                {!! $errors->first('first_name') !!}
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">Last Name</label>
                        <input type="text" class="form-control frm-field" name="last_name" id="exampleInputName2"
                               placeholder="Last Name" value="{{ Auth::User()->last_name }}">
                        @if ($errors->any() && $errors->first('last_name') != "")
                            <span class="help-block red">
                                {!! $errors->first('last_name') !!}
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control frm-field" id="exampleInputEmail2"
                               placeholder="name@example.com" name="email" value="{{ Auth::User()->email }}">
                        @if ($errors->any() && $errors->first('email') != "")
                            <span class="help-block red">
                                {!! $errors->first('email') !!}
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Upload Image</label>
                        <input type="file" name="image" class="form-control frm-field">
                    </div>
                {!! $errors->first('image', '<span class="help-block red">:message</span>') !!}

                <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">Password</label>
                        <input type="password" class="form-control frm-field" id="exampleInputName2" placeholder="password">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Account Time zone</label>
                        <select class="form-control">
                            <option>(GMT-5:50)-East-west</option>
                             <option>(GMT-6:50)-west-east</option>
                              <option>(GMT-7:50)-north-south</option>
                               <option>(GMT-8:50)-south-west</option>
                                <option>(GMT-9:50)-north-west</option>

                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="frm-divider"></div>
                    </div>



                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">Country</label>
                        <input type="text" class="form-control frm-field" id="exampleInputName2" placeholder="Which Country">
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Locale</label>
                        <select class="form-control">
                            <option> la </option>
                             <option> fa </option>
                              <option> ga </option>
                               <option> da </option>
                                <option> ma </option>

                        </select>
                     </div> -->


                <!-- <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Phone</label>
                        <input type="text" name="phone" value="{{ Auth::User()->phone }}" class="form-control frm-field" id="exampleInputEmail2" placeholder="+976-2785454">
                    </div> -->


                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">Street Address</label>
                        <input type="text" class="form-control frm-field" id="exampleInputName2" placeholder="1203 st lr dr">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputEmail2">City</label>
                        <input type="email" class="form-control frm-field" id="exampleInputEmail2" placeholder="gibston">
                     </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputName2">State</label>
                        <input type="text" class="form-control frm-field" id="exampleInputName2" placeholder="Florida">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <label for="exampleInputEmail2">Zip code / Postal code</label>
                        <input type="email" class="form-control frm-field" id="exampleInputEmail2" placeholder="425244">
                     </div> -->

                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="badge">
                            <div class="badge-cnt">
                                <label class="switch pull-left">
                                    <input type="checkbox" checked>
                                    <div class="slider round"></div>
                                </label>
                                <h5 class="text-right">Turn on cartumo Affiliate Badge by default?</h5>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <div class="updt-stng">
                            <button class="btn cus-btn">Update account setting</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="prfl-wndw">
                    <div class="prfl-smll">
                        <h4 class="pull-left">{{ Auth::User()->first_name }}</h4>
                        <span class="pull-left" style="font-size:12px;">{{ Auth::User()->email }}</span>
                        <div id="profilePic">

							<?php
							$imgPath = App\BaseUrl::getUserProfileThumbnailUrl();
							?>

                            @if(empty(Auth::User()->image) || !file_exists($imgPath . '/100x90/' . Auth::User()->image))
                                <img src="{{ asset('public/global/uploads/images/userprofile/thumbnails/100x90/prfl.png') }}"
                                     class="img-responsive pull-right"/>
                            @else
                                <img src="{{ $imgPath . '/100x90/' . Auth::User()->image }}"
                                     class="img-responsive pull-right"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="plan-sec">
                    <span>Plan</span>
                    <span class="trial"> Startup ($97/mo after 14-day trial) </span>
                    <div class="gry-lne"></div>
                    <div class="plan-cnt view-cnt">
                        <span>views</span>
                        <span class="trial pull-right"> 25 of 20000 </span>
                        <div class="gry-lne">
                            <div class="colr-line" style="width: 25%;"></div>
                        </div>
                    </div>
                    <div class="plan-cnt clr-blu">
                        <span>Pages</span>
                        <span class="trial pull-right"> 45 of 100 </span>
                        <div class="gry-lne">
                            <div class="colr-line" style="width: 45%;"></div>
                        </div>
                    </div>
                    <div class="plan-cnt clr-grn">
                        <span>Funnels</span>
                        <span class="trial pull-right"> 19 of 20 </span>
                        <div class="gry-lne">
                            <div class="colr-line" style="width: 90%;"></div>
                        </div>
                    </div>

                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="frm-lst">
                        <form>
                          <div class="form-group">
                          <label>Affiliate</label>
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-money"></i></div>
                              <input type="text" class="form-control" id="exampleInputAmount" placeholder="529040">
                            </div>
                          </div>


                          <div class="form-group botm-line">
                          <label>Wordpress API key</label>
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-wordpress"></i></div>
                              <input type="text" class="form-control" id="exampleInputAmount" placeholder="sfgfg-sdsasa-yyhh">
                            </div>
                          </div>
                        </form>
                        <div class="social-afi">
                            <p>Share with affiliate link:</p>
                            <a href="#"><i class="fa fa-facebook-square"></i> Recommend </a>
                            <a href="#">Share</a>
                            <a href="#"><i class="fa fa-thumbs-o-up"> Like 77k </i></a>
                        </div>
                     </div>
                </div> -->
            </div>
        </div>

    @stop


    {{-- page level scripts --}}
    @section('footer_scripts')
        <!-- page level js starts-->
            <!--  -->

            <!--page level js ends-->
@stop