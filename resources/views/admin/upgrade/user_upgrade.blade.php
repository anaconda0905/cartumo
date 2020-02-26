@extends('layouts.admin')

@section('title', 'User Upgrade')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }
        #search_user_list {
            border: 2px solid #eee;
            max-height: 500px;
            overflow: auto;
            text-align: center;
            display: none;
        }
        #search_user_list ul {
            list-style-type: none;
            padding: 0px;
            text-align: left;
        }
        #search_user_list ul > li {
            padding: 9px 15px 5px;
            padding-top: 9px;
            padding-bottom: 5px;
            border-top: 1px solid #eee;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                User Upgrade
                <small>assign upgrade to user</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.feature-upgrade.index') }}">Feature Upgrades</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> User Upgrade
                </li>
            </ol>
        </div>
    </div>

    @if(!empty($errors))
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">
    
        {!! Form::open(array('route' => ['admin.upgrade.users.store', $data['feature_upgrade']->id])) !!}
        {{ csrf_field() }}
        <div class="col-md-6 form-upgrade">

                    
                        
                        <fieldset>
                            <div class="form-group">
                                {{ Form::label('upgrade_id', 'Upgrade:') }}
                                <p>{{ $data['feature_upgrade']->name }}</p>
                                {{ Form::hidden('upgrade_id', $data['feature_upgrade']->id) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type', 'Type:') }}
                                {{ Form::select('type', ['paid'=>'Paid', 'free'=>'Free'], null, array('class' => 'form-control', 'required' => '')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('payment_method', 'Payment Method:') }}
                                <select name="payment_gateway_id" class="form-control">
                                    <option value="">Choose</option>
                                    @foreach ( $data['gateways'] as $gateway )
                                        <option value="{{ $gateway->id }}">{{ ucfirst($gateway->type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-lg btn-block btn-submit-form')) }}
                        </fieldset>
                    

        </div>

        <div class="col-md-6 form-upgrade">
            <div class="form-group">
                {{ Form::label('search_user', 'Search users:') }}
                {{ Form::text('search_user', null, array('id' => 'search_textbox', 'name' => 'keyword', 'class'=>'form-control', 'required' => '', 'placeholder' => 'Enter user name to search' ) ) }}
                <div id="search_user_list"></div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();
        $(document).on('keyup', '#search_textbox', function(e) {

            if ( $(this).val().length > 0 ) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.user.list') }}",
                    data: "_token={{ csrf_token() }}&keyword=" + $(this).val(),
                    beforeSend: function() {
                        $("#search_user_list").html('<img style="margin:auto" src="{{ asset('images/ajax-loader.gif') }}" />');
                        $("#search_user_list").show();
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $("#search_user_list").html(json.html);
                        }
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            } else {
                $("#search_user_list").hide();
            }
            
        });
    </script>
@endsection
