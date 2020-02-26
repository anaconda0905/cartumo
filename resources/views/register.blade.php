@extends('layouts.default')


{{-- page title --}}
@section('title')
	Register
	@parent
@stop


{{-- page level styles --}}
@section('header_styles')
	<!--page level css starts-->
    <style type="text/css">
        .red{
            color:#FF0000;
        }
    </style>
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
                            <form method="post" action="{{ route('register') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="content-area">
                                    <h3 class="text-center">CREATE YOUR ACCOUNT HERE</h3>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="email" name="email" placeholder="Enter Email" class="form-control txtfield" />
                                        {!! $errors->first('email', '<span class="help-block red">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="password" name="password" placeholder="Enter Password" class="form-control txtfield" />
                                        {!! $errors->first('password', '<span class="help-block red">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="password" name="cPassword" placeholder="Confirm Password" class="form-control txtfield" />
                                        {!! $errors->first('confirm_password', '<span class="help-block red">:message</span>') !!}
                                    </div>
                                    <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="zip" placeholder="Zip" class="form-control txtfield" />
                                    </div> -->
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox"> By clicking, you agree to our <a href="#" class="text-primary">Terms Of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>

                                            </label>
                                          </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn cus-btn lgn-btn">Create Account</button>
                                    </div>

                                    
                                    
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="sgn-up">
                                        <p>Already have an account.?<a href="{{ route('login') }}" class="text-primary"> Click here</a></p>
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