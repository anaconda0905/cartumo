<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CARTUMO | Error</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css" />
    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{ asset('css/social.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <style>
        body {
            color: #73879C;
            background: #2A3F54;
            font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.471;
            font-family: Arial;
        }

        .wrap{
        	width:1000px;
        	margin:0 auto;
        }
        .main{
        	text-align:center;
        	background: rgba(255, 255, 255, 0.04);
        	color:#FFF;
        	font-weight:bold;
        	margin-top:160px;
        	border:1px solid rgba(102, 102, 102, 0.31);
        	-webkit-border-radius:5px;
        	-moz-border-radius:5px;
        	border-radius:5px;
        }
        .main h3{
        	font-size:16px;
        	text-align:left;
        	padding:30px 30px;
        }
        .main h1{
        	font-size:52px;
        	margin-top:15px;
        	color:#fb7878;
        	text-transform:uppercase;
        }
        .main p{
        	font-size:17px;
        	margin-top:15px;
        	line-height:1.6em;
        }
        .main  span.error{
        	color:#48C8D3;
        	font-size:18px;
        }
        .main p span{
        	font-size:14px;
        	color:#49ba9a;
        }
        .search{
        	border: 1px solid rgba(173, 173, 173, 0);
        	margin-left:320px;
        	margin-top:20px;
        	width:390px;
        	position:relative;
            background:rgba(156, 156, 156, 0.12);
            box-shadow: inset 0px -1px 5px rgba(94, 94, 94, 0.19);
            border-radius:5px;
            -webkit-border-radius:5px;
        	-moz-border-radius:5px;
        }
        form input[type="text"]{
        	border:none;
        	outline:none;
        	width:287px;
        	padding:8px;
        	font-size:12px;
            background:rgba(255, 255, 255, 0);
           color:#A2A2A2;
        }
        form input[type="submit"]{
        	border:none;
        	background:none;
        	cursor:pointer;
        	padding:10px 20px;
        	font-size:13px;
        	color:#EEE;
        	box-shadow: inset 1px -2px 8px rgba(0, 0, 0, 0.33);
            margin: 0;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            background:#174242;
        }
        form input[type="submit"]:hover{
        	box-shadow: inset 0px 0px 4px #222;
        	color:#FFF;
        }
        .icons{
        	padding-bottom:20px;
        	text-align:right;
        }
        .icons p{
        	padding-right:130px;
        	color:#D5CECE;
        	font-size:13px;
        	cursor:pointer;
        }
        .icons p:hover{
        	text-decoration:underline;
        }
        .icons ul{
        	padding-right:109px;
        }
        .icons li {
        	display:inline-block;
        	padding-top:10px;
        }
        .icons li a{
        	margin:2px;
        }
        .footer{
        	text-align:right;
        	padding-top:10px;
        }
        .footer p{
        	font-size:12px;
        	color:#DDD;
        }
        .footer p a{
        	font-size:13px;
        	color:#076161;
        }
        .footer p a:hover{
        	color:#0C7C7C;
        }
        p > a {
            background: transparent;
            color: #49ba9a;
        }
        p > a:hover {
          color: #2675b3;
        }
    </style>
</head>

<body>
  <div class="container">
    <div class="wrap">
       <div class="main">
        <img src="{{ asset('images/logo1.png') }}" style="margin: 15px 0 15px" />
        <!---728x90--->
        <h1>Oops! Something went wrong</h1>
        <h2>Sorry for inconvenience</h2> <br />
        <p>Please contact customer support at <a href="mailto:admin@inubaan.com">admin@inubaan.com</a></p> <br />
          <!---728x90--->
          <!--<div class="search">
            <form>
              <input type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter ur email';}" value="Enter ur email">
              <input type="submit" value="Submit">
            </form>
          </div>-->

        <div class="icons">
            <p>Follow us on:</p>
            <ul class="social-network social-circle">
                <li><a href="#" class="icoYoutube" title="Rss" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li><a href="https://www.facebook.com/cartumo.io/" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            </ul>
         </div>
       </div>
       <!---728x90--->
      <div class="footer">
        <p>&copy; {{ date('Y') }} Cartumo. All Rights Reserved</p>
        </div>
      </div>
  </div>


  <!-- jQuery -->
  <script src="{{ asset('frontend/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('frontend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
