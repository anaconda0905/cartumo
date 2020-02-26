<div class="integration-fields">
    <div class="form-group">
        {{ Form::label('api_secret', 'API Secret:') }}
        {{ Form::text('api_secret', NULL, array('class' => 'form-control', 'name' => 'details[api_secret]', 'required' => '', 'placeholder' => "Provide API Secret", 'autofocus' => '')) }}
    </div>
    <div class="form-group">
        {{ Form::label('apikey', 'API Key:') }}
        {{ Form::text('apikey', NULL, array('class' => 'form-control', 'name' => 'details[apikey]', 'required' => '', 'placeholder' => "Provide API Key")) }}
    </div>
</div>