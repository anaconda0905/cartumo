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
                @include('notifications')
					<div class="row">
						<div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
							<div class="content-area">
                                <form method="post" action="{{ route('forgot-password') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
    								<h3 class="text-center">Enter Your Email</h3>
    								<div class="form-group col-md-12 col-sm-12 col-xs-12">
    			    					<input type="email" name="email" placeholder="Email" class="form-control txtfield" />
                                        {!! $errors->first('email', '<span class="help-block red">:message</span>') !!}
    			    				</div>
    								
    			    				<div class="form-group col-md-12 col-sm-12 col-xs-12">
    									<button class="btn cus-btn lgn-btn">Submit</button>
    								</div>
    							</form> 
								
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<div class="sgn-up">
									<p>Already have an account.?<a href="{{ route('login') }}" class="text-primary"> Sign In</a></p>
								</div>
							</div>
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