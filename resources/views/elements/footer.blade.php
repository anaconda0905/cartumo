<footer class="footer-sec">
    <div class="container p-0">
            <div class="col-md-3 col-sm-3 col-xs-12 footer-link">
                <h4>Links</h4>
                <ul class="m-0 p-0" type="none">
                    <li><a href="javascript:void(0);"> Reviews</a></li>
                    <li><a href="javascript:void(0);"> How it works</a></li>
                    <li><a href="javascript:void(0);"> API Status</a></li>
                    <li><a href="javascript:void(0);"> Help &amp; FAQs</a></li>
                    <li><a href="javascript:void(0);"> User agreement</a></li>
                </ul>
            </div>
            
            <div class="col-md-3 col-sm-3 col-xs-12 footer-link">
                <h4>Company</h4>
                <ul class="m-0 p-0" type="none">
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"> About Cartumo</a></li>
                    <li><a href="javascript:void(0);"> Terms</a></li>
                    <li><a href="javascript:void(0);"> Privacy</a></li>
                    <li><a href="javascript:void(0);"> Contact Us</a></li>
                    <li><a href="javascript:void(0);"> Blog</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 footer-link">
                <h4>Support</h4>
                <ul class="m-0 p-0" type="none">
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"> 24/7 Support</a></li>
                    <li><a href="javascript:void(0);"> Shoppify help center</a></li>
                    <li><a href="javascript:void(0);"> Forums</a></li>
                    <li><a href="javascript:void(0);"> API Documentation</a></li>
                    <li><a href="javascript:void(0);"> Free Tools</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 footer-app">
                <h4 class="m-t-0">Join the #Cartumo Here</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="m-0 p-0" type="none">
                            <li><a href="javascript:void(0);"> <i class="fa fa-facebook-square"></i> </a></li>
                            <li><a href="javascript:void(0);"> <i class="fa fa-twitter-square"></i> </a></li>
                            <li><a href="javascript:void(0);"> <i class="fa fa-linkedin-square"></i> </a></li>
                            
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <ul class="m-0 p-0" type="none">
                           
                            <li><a href="javascript:void(0);"> <i class="fa fa-google-plus-square"></i> </a></li>
                            <li><a href="javascript:void(0);"> <i class="fa fa-youtube-square"></i> </a></li>
                            <li><a href="javascript:void(0);"> <i class="fa fa-pinterest-square"></i> </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('newsletters-subscriptions.store') }}">
                            {{ csrf_field() }}
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter Your Email Address">
                            @if ($errors->any() && $errors->first('email') != "")
                                <span class="help-block red">
                                    {!! $errors->first('email') !!}
                                </span>
                            @endif
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
       
        <div class="footer-about text-center">
            <p class="m-t-15"> © 2017 Cartumo. All rights reserved. </p>
        </div>
    </div>
</footer>