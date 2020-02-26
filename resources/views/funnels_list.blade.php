@extends('layouts.dashboard')


{{-- page title --}}
@section('title')
	Funnels
	@parent
@stop


{{-- page level styles --}}
@section('header_styles')
	<!--page level css starts-->
    <style type="text/css">
        .dashboard-contnt{
            background-color:#FFFFFF;
            padding-bottom: 60px;
        }
    </style>
    <!--end of page level css-->
@stop


@section('content')

    @include('elements.sidebar')

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Funnel</h4>
                </div>
                <form method="post" action="{{ route('funnels.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="funnelName" placeholder="Enter Funnel Name" class="form-control txtfield" />
                                </div>

                                <div class="pull-right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right:25px;">  
                                <h3 style="color:#666666; font-family: sans-serif; font-size:20px;">Funnel Steps :</h3>
                                <ol style="color:#888888; font-family: sans-serif; font-size:12px;">
                                    <li>Squeeze Page</li>
                                    <li>Sell Page</li>
                                    <li>Payment Page</li>
                                    <li>Upsell Page</li>
                                    <li>Downsell Page</li>
                                    <li>Confirmation Page</li>
                                </ol>
                                <p style="color:#888888; font-family: sans-serif; text-align:justify; font-size:12px;">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-md-offset-2 col-sm-offset-2 p-0">
        
        <div class="dashboard-contnt">
            <!-- Notifications -->
            @include('notifications')

            <div class="video-set">
                <div class="col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="video-sec text-center">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="vid-ply">
                              <video controls="">
                                    <source src="{{ asset('public/frontend/videos/vidz1.mp4') }}" type="video/mp4">
                              </video>
                          </div>
                        </div> 
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="vid-ply">
                              <video controls="">
                                    <source src="{{ asset('public/frontend/videos/vidz1.mp4') }}" type="video/mp4">
                              </video>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="vid-ply">
                              <video controls="">
                                    <source src="{{ asset('public/frontend/videos/vidz1.mp4') }}" type="video/mp4">
                              </video>
                          </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="filtr-btn ad-fil">
                        <button href="#" class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus icn-clr"></i> Add Funnel </button>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="srch-box">
                          <input type="text" class="form-control txtfield pull-right" placeholder="Search" aria-describedby="basic-addon2">
                          <span><button class="btn" type="submit"><i class="fa fa-search icn-clr"></i></button> </span>
                         
                    </div>
                </div>
            </div>

            @if($funnels->isEmpty())
                <p style="border:1px soli; margin-top:20%; text-align:center; color:#888888; font-size:30px;">No funnel found.</p>
            @else
                <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                    <div class="filtr">
                        <div class="filtr-btn">
                            <div class="filtr-sec">
                                <button class="btn btn-default" type="button"><i class="fa fa-list icn-clr"></i>All Funnels</button>
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar-o icn-clr"></i>Recently Updated</button>
                                <button class="btn btn-default" type="button"><i class="fa fa-archive icn-clr"></i>Archived</button>
                            </div>
                
                            <div class="pull-right">
                                <button class="btn btn-default" type="button"><i class="fa fa-sort-amount-asc icn-clr"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-sort-amount-desc icn-clr"></i></button>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="numbr-field">
                        <button class="btn btn-default" type="button"><i class="fa fa-angle-double-left"></i></button>
                        <button class="btn btn-default" type="button">1</button>
                        <button class="btn btn-default" type="button">2</button>
                        <button class="btn btn-default" type="button"><i class="fa fa-angle-double-right"></i></button>
                    </div>
                    <div class="text-right numbr-field">
                        <span>1 to 24 of 29</span>
                    </div>
                </div>
                @foreach($funnels as $funnel)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="{{ route('funnels.show', [$funnel->id]) }}">
                            <div class="listing">
                                <div class="col-md-10 col-lg-10 col-sm-9 col-xs-12">
                                    <div class="listing-files">
                                        <span class="pull-left estate">{{ $funnel->name }}</span>    
                                        <!-- <span class="pull-left colini"><img src="{{ asset('public/frontend/img/funl.jpg') }}" class="img-responsive" />Collini <i class="fa fa-bars"></i>Custom</span> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
                                    <div class="bg-img">
                                        <img src="{{ asset('public/frontend/img/funl.jpg') }}" class="img-responsive" />
                                    </div>
                                </div> -->
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

@stop


{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    
    <!--  -->
    
    <!--page level js ends-->
@stop