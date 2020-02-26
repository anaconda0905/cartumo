<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cartumo</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Theme CSS -->
{!! Html::style('css/style.css') !!}

<!-- Custom Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">

@yield('styles')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="index">
<div id="skipnav"><a href="#maincontent">Skip to main content</a></div>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top"><img src="{{ asset('images/logo1.png') }}" style="width:80%"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="page-scroll">
                    <!--<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalSubmitRequest">
                        Submit Request
                    </button>-->
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')

<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4 subscribe-block">
                    <h3>Subscribe</h3>
                    <!--<p>12030 Citrus Leaf Dr.
                        <br>Gibsonton , FL 33534</p>-->
                    <div class="row clearfix user-subscription">
                        <form id="frm_subscription" action="" method="post">
                            <div class="col-md-9 col-sm-12"><input type="email" class="form-control"
                                                                   name="subscribe_email"
                                                                   placeholder="Enter email address here" required/>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button type="submit" id="btn-subcribe" class="btn btn-success btn-block btn-lg">
                                    Subscribe
                                </button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
                <div class="footer-col col-md-4">
                    <h3>Around the Web</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Facebook</span><i
                                        class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Google Plus</span><i
                                        class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Twitter</span><i
                                        class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Linked In</span><i
                                        class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Dribble</span><i
                                        class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>About Cartumo</h3>
                    <p>The team behind Cartumo have worked hard to bring you the concept of Cartumo, a solution which
                        can be used to build an ecommerce online store which enables you to customize your store in many
                        ways, ways which are only imaginable by you, our user! To bring a unique concept to your store,
                        we offer you the best features and tools to create it!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; Cartumo {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Modal -->
<div id="modalSubmitRequest" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form role="form" action="" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Submit Request</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="control-label">
                            <span class="in_label">Your Name</span>
                        </div>

                        <div class="col-inputs">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required="true"
                                       id="contact-form-name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label">
                            <span class="in_label">Email</span>
                        </div>

                        <div class="col-inputs">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required="true">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label">
                            <span class="in_label">Subject</span>
                        </div>

                        <div class="col-inputs">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" required="true">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label">
                            <span class="in_label">Message</span>
                        </div>

                        <div class="control-label">
                            <div class="form-group">
                            <textarea class="form-control" name="message" required="true"
                                      id="contact-message"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-labels">
                            <span class="in_label">Attachments</span>
                        </div>

                        <div class="col-inputs">
                            <div class="form-group">
                                <input type="file" class="form-control" name="attachment">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Request</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
{!! Html::script('js/script.js') !!}

@yield('scripts')


</body>

</html>
    