@extends('layouts.page')

@section('styles')
    <style>
        .signin-form {
            padding-top: 130px;
            padding-bottom: 50px;
        }

        .signin-form label {
            font-size: 13px !important;
            font-weight: 600;
        }

        .form-signin {
            margin: 0 auto;
            max-width: auto;
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
            padding: 40px 0px 0px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 32px;
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

        .signin-form form input[type="email"], .signin-form form input[type="password"], .signin-form form input[type="text"] {
            height: 44px;
            border: 2px solid #a7c3dc;
            margin-top: 0px;
            margin-bottom: 10px;
            border-radius: 4px !important
        }

        .signin-form form input[type="password"]:focus, .signin-form form input[type="email"]:focus, .signin-form form input[type="text"]:focus {
            border-color: #2fbc9e;
            box-shadow: none;
            outline: 0 none;
        }

        .promo-highlight {
            text-transform: uppercase;
            text-align: center;
            font-weight: 700;
            font-family: Nunito;
            margin-bottom: 30px;
        }

        .promo-highlight > span {
            color: #f00;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 signin-form">
                @if(!empty($errors))
                    @foreach($errors->all() as $error)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <strong>Error!</strong> {{ $error }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


				<?php if ( ! empty( $_GET['code'] ) ) { ?>
                <h2 class="promo-highlight"><span>Lifetime</span> exclusive promo with a 7 day <span>free</span> trial
                </h2>
				<?php } ?>

                <h3 class="text-center login-title">Sign Up with <span style="color:#0975b2">Cart</span><span
                            class="text-colored">umo</span></h3>
                <div class="account-wall">
                    <img class="profile-img"
                         src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                         alt="">
                    <form class="form-signin" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        @if( !empty($_GET['plan']) )
                            <input type="hidden" name="hid_plan_type" value="{{ $_GET['plan'] }}">
                        @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>

                            <div class="">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       placeholder="Full Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="Email Address" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control" name="password"
                                               placeholder="Password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" placeholder="Retype Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>

						<?php if ( empty( $_GET['code'] ) ) { ?>
                        <div class="form-group" style="margin-bottom: 0px">
                            <div class="col-md-6s">
                                <label for="secret_code" class="control-label" style="text-align:left">
                                    <input type="checkbox" name="secret_code" id="secret_code"/>
                                    Have a Secret Code?
                                </label>

                                <input id="secret_code_text" type="text" class="form-control" name="secret_code_text"
                                       placeholder="Enter the secret code" style="display: none">
                            </div>
                        </div>
						<?php } else { ?>
                        <input type="hidden" name="register_special_code"
                               value="{{ env('REGISTER_CODE_LIFETIME_PROMO') }}">
						<?php }?>

                        <div class="form-group">
                            <div class="col-md-4s"></div>
                            <label for="agree_terms" class="control-label" style="text-align:left">
                                <input type="checkbox" name="agree_terms" id="agree_terms" required/>
                                I Agree to the Terms and Conditions
                            </label>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6s col-md-offset-4s">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                        </div>
                        @if ( !empty($_GET['affiliate_id']) )
                            <input type="hidden" name="affiliate_id" value="{{ $_GET['affiliate_id'] }}"/>
                        @endif
                    </form>
                </div>

                <div class="text-center" style="padding-top: 15px">
                    Already have account? <a href="{{ route('login') }}" class="create-account">Sign In</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).on("click", "#secret_code", function (e) {

            if ($(this).is(":checked")) {
                $(this).parent().next().show();
                $(this).parent().next().focus();
            }
            else
                $(this).parent().next().hide();
        });
    </script>
@endsection
