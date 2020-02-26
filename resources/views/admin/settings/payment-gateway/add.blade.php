@extends('layouts.admin')

@section("title", "Add New Payment gateway")

@section('styles')
    <style>
        .tab-container > form > div {
            display: none;
        }
    </style>
@endsection

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                New Payment gateway
                <small>new payment gateway</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.payment-gateway.index') }}">Payment gateways</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add Gateway
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
        <div class="col-md-6 form-payment-gateway">
            <div class="form-group">
                            @if ( !empty($data['availableGateways']) )
                                <label for="choose_gateway_type">Choose gateway type:</label>
                                <select name="type" class="form-control payment-types" id="choose_gateway_type">

                                    <option value="">--Select--</option>
                                    @foreach ( $data['availableGateways'] as $key=>$availableGateway )
                                        <option data-target-id="{{ $key }}_content" class="tab_{{ $key }}"
                                                value="{{ $key }}"><i
                                                    class="{{ $availableGateway[0]['icon'] }}" aria-hidden="true"></i>
                                            &nbsp; {{ ucfirst($key) }}</option>
                                    @endforeach
                                </select>
                            @else
                                <p>All payment gateway has been configured.</p>
                                <a class="btn btn-primary" href="{{ route('payment-gateway.index') }}"> Back </a>
                            @endif
                        </div>

                        <div class="tab-container col-md-12">
                            @if ( !empty($data['availableGateways']) )
                                @foreach ( $data['availableGateways'] as $key=>$availableGateway )
                                    {!! Form::open(array('id' => 'frm_'.$key.'_add_gateway', 'route' => 'admin.payment-gateway.store', 'data-parsley-required' => '', 'class' => 'form-horizontal form-label-left input_mask')) !!}
                                    <div id="{{ $key }}_content" class="{{ $key }}">

                                        @foreach ( $availableGateway[0] as $k=>$field )
                                            @if ( ($k !== 'icon') && ($k !== 'active') )
                                                @if ( !is_array($field) )
                                                    <div class="form-group">
                                                        {{ Form::label(strtolower($k), ucfirst(str_replace ('_', ' ', $k)) . ":") }}
                                                        {{ Form::text(strtolower($k), null, array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255, 'placeholder' => strtolower($field))) }}
                                                    </div>
                                                @else
                                                    @if ( $k == 'icon' )
                                                        <div class="form-group">
                                                            {{ Form::label(strtolower($k), ucfirst($k) . ":") }}
                                                            {{ Form::select(strtolower($k), $field, null, array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255)) }}
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        <input type="hidden" name="gateway" value="{{ strtolower($key) }}"/>
                                        <button type="submit" id="button_{{ $key }}_add_gateway"
                                                class="btn btn-primary btn-lg"
                                                onclick="add_gateway('{{ $key }}'); return false;"> Save {{ $key }}
                                            Details
                                        </button>

                                    </div>
                                    {!! Form::close() !!}
                                @endforeach
                            @endif
                        </div>
        </div>
    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script>
        var tmp_content;
        $(".payment-types").change(function (e) {

            e.preventDefault();

            //alert("#" + $('option:selected', this).attr('data-target-id'));

            $(tmp_content).hide();

            $(this).addClass('active');
            $("#" + $('option:selected', this).attr('data-target-id')).show();
            tmp_content = $("#" + $('option:selected', this).attr('data-target-id'));
        });

        function add_gateway(gateway_type) {

            var element = $("#button_" + gateway_type + "_add_gateway");
            var form = $("#frm_" + gateway_type + "_add_gateway");
            //alert($(form).attr('action'));

            $.ajax({
                type: 'post',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                beforeSend: function () {
                    $(element).html('<i class="fa-li fa fa-spinner fa-spin"></i> saving');
                    $(element).prop('disabled', 'disabled');
                },
                success: function (response) {
                    $(element).html('Save');
                    $(element).prop('disabled', '');
                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {
                        location.href = json.url;
                    } else {
                        alert(json.message)
                    }

                    //$(element).after('<div class="alert alert-success"><strong>Success!</strong> Indicates a successful or positive action.</div>');
                }
            });
        }
    </script>
@endsection