@extends('layouts.admin')

@section("title", "Update Payment Gateway")

@section('styles')
    <style>
        .tab-container > form > div {
            /*display: none;*/
        }
    </style>
@endsection

@section('content')

    <!--<pre><?php print_r($data['availableGateways']) ?></pre>-->


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title clearfix">
            <div class="title_left">
                <h3><i class="fa fa-paper-plane"></i> Update payment Gateway</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <hr/>

        <div class="row clearfix">

            <div class="col-md-7">
                <div class="x_panel">
                    <div class="x_content">


                        <div class="tab-container">

                            <?php $details = json_decode($data['gateway']->details, TRUE); ?>

                            @if ( !empty($data['availableGateways']) )
                                @foreach ( $data['availableGateways'] as $key=>$availableGateway )

                                    @if ( $key == $data['gateway']->type )
                                        {!! Form::open(array('id' => 'frm_update_gateway', 'route' => ['admin.payment-gateway.update', $data['gateway']], 'data-parsley-required' => '', 'class' => 'form-horizontal form-label-left input_mask')) !!}
                                        <div id="{{ $key }}_content" class="{{ $key }}">

                                            @foreach ( $availableGateway[0] as $k=>$field )
                                                @if ( ($k !== 'icon') && ($k !== 'active') )
                                                    @if ( !is_array($field) )
                                                        <div class="form-group">
                                                            {{ Form::label(strtolower($k), ucfirst(str_replace ('_', ' ', $k)) . ":") }}
                                                            {{ Form::text(strtolower($k), $details[strtolower($k)], array('class' => 'form-control', 'name' => 'details[' . $k . ']', 'required' => '', 'maxlength' => 255, 'placeholder' => strtolower($field))) }}
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
                                            <button type="submit" id="button_update_gateway"
                                                    class="btn btn-primary btn-lg"> Save {{ $key }}
                                                Details
                                            </button>

                                        </div>
                                        {!! Form::close() !!}
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script>

        $("#frm_update_gateway").submit(function(e) {

            e.preventDefault();

            var element = $("#button_update_gateway");
            var form = $(this);
            //alert($(form).attr('action'));

            //alert($(form).serialize());

            $.ajax({
                type: 'PUT',
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
        });

    </script>
@endsection