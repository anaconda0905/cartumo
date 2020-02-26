@extends('layouts.app')

@section("title", "Shop")

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3>Shopify Store</h3>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-md-8">
                <div class="x_panel">
                    <div class="x_content">
                        {!! Form::open(array('route' => 'shopify.shop.save', 'id' => 'frm_shopify_save')) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Shop Name:') }}
                            {{ Form::text('name', (!empty($data['info']->name)) ? $data['info']->name : NULL, array('class' => 'form-control', 'name' => 'details[name]', 'required' => '', 'placeholder' => "Provide shop name", 'autofocus' => '')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('api_key', 'API key:') }}
                            {{ Form::text('api_key', (!empty($data['info']->api_key)) ? $data['info']->api_key : NULL, array('class' => 'form-control', 'name' => 'details[api_key]', 'required' => '', 'placeholder' => "Provide APi Key")) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Password:') }}
                            {{ Form::text('password', (!empty($data['info']->password)) ? $data['info']->password : NULL, array('class' => 'form-control', 'name' => 'details[password]', 'required' => '', 'placeholder' => "Provide password")) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('shared_secret', 'Shared secret:') }}
                            {{ Form::text('shared_secret', (!empty($data['info']->shared_secret)) ? $data['info']->shared_secret : NULL, array('class' => 'form-control', 'name' => 'details[shared_secret]', 'required' => '', 'placeholder' => "Provide Shared secret")) }}
                        </div>

                        {{ Form::submit('Update Details', array('class' => 'btn btn-primary pull-right')) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>





            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_content">
                        test
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script>
        $("#frm_shopify_save").submit(function(e) {

            e.preventDefault();

            var button = $(this).find("input[type='submit']");

            $.ajax({
                type: 'POST',
                url: $("#frm_shopify_save").attr('action'),
                data: $("#frm_shopify_save").serialize(),
                beforeSend: function() {
                    $(button).prop('disabled', 'disabled');
                },
                success: function(response) {
                    console.log(response);

                    $(button).prop('disabled', '');
                    var json = JSON.parse(response);

                    if ( json.status == 'success' ) {
                        location.href = json.url;
                    }
                }
            })
        });
    </script>
@endsection