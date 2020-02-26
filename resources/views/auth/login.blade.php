@extends('layouts.page')

@section('styles')
    <style>

        .signin-form {
            padding-top: 120px;
            padding-bottom: 0px;
        }

        .form-signin {
            margin: 0 auto;
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-signin-heading, .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .account-wall {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 22px;
            font-weight: 600;
            display: block;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        .need-help {
            margin-top: 10px;
        }

        .new-account {
            display: block;
            margin-top: 10px;
        }

        .text-colored {
            color: #18BC9C;
        }

        .create-account {
            font-size: 18px;
        }

        .signin-form form input[type="email"], .signin-form form input[type="password"] {
            height: 44px;
            border: 2px solid #a7c3dc;
            margin-top: 0px;
            margin-bottom: 10px;

            border-radius: 4px;
        }

        .signin-form form input[type="password"]:focus, .signin-form form input[type="email"]:focus {
            border-color: #2fbc9e;
            box-shadow: none;
            outline: 0 none;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 signin-form">
                <h1 class="text-center login-title">Sign in to continue to <span style="color:#0975b2">Cart</span><span
                            class="text-colored">umo</span></h1>
                <div class="account-wall">
                    <img class="profile-img"
                         src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                         alt="">
                    <form class="form-horizontal form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="Email Address" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in
                        </button>

                        <div class="clearfix">
                            <div class="col-md-12 text-center">
                                <label class="checkbox pull-left">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                </label>
                                <a class="btn btn-link pull-right" href="{{ route('password.request') }}"
                                   style="padding-right: 0px; color: #18BC9C">
                                    Forgot Password?
                                </a></span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="text-center" style="padding-top: 15px">
                    New user? <a href="{{ route('register') }}" class="create-account">Create new account</a>
                </div>
            </div>
        </div>
    </div>

@endsection
