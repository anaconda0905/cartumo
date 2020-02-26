@extends('layouts.default')


{{-- page title --}}
@section('title')
	Login
	@parent
@stop


{{-- page level styles --}}
@section('header_styles')
	<!--page level css starts-->
    <!--  -->
    <!--end of page level css-->
@stop


@section('content')

    <section class="main-dialog">
        <div class="table-div">
            <div class="table-cell-div">
                <div class="container">
                    <!-- Notifications -->
                    @include('notifications')

                    <div class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
                            <form method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="content-area">
                                    <h3 class="text-center">LOGIN</h3>
                                    <!-- <div class="text-center form-group col-md-6 col-sm-6 col-xs-12 m-t-20">
                                        <button type="button" class="btn facebk"> <i class="fa fa-facebook"></i> Log in with facebook </button>
                                    </div>

                                    <div class="text-center form-group col-md-6 col-sm-6 col-xs-12 m-t-20">
                                        <button type="button" class="btn ggle"> <i class="fa fa-google-plus"></i> Log in with Google</button>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 m-tb-30">
                                        <div class="mdl"></div>
                                    </div> -->

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="email" placeholder="Email" class="form-control txtfield" />
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="password" name="password" placeholder="Password" class="form-control txtfield" />
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                          </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn cus-btn lgn-btn">login</button>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <p>Forgot your password.?<a href="{{ route('forgot-password') }}" class="text-primary"> Click here</a></p>
                                        
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="sgn-up">
                                        <p>Don't have an account.?<a href="{{ route('register') }}" class="text-primary"> Sign Up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                            
                    </div>  
                </div>
            </div>
        </div>
    </section>

@stop


{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    
    <!--  -->
    
    <!--page level js ends-->
@stop