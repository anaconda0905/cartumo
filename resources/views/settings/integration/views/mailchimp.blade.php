<div class="integration-fields">
    <div class="form-group">
        {{ Form::label('username', 'Username:') }}
        {{ Form::text('username', NULL, array('class' => 'form-control', 'name' => 'details[username]', 'required' => '', 'placeholder' => "Provide username", 'autofocus' => '')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password:') }}
        {{ Form::text('password', NULL, array('class' => 'form-control', 'name' => 'details[password]', 'required' => '', 'placeholder' => "Provide password")) }}
    </div>
    <div class="form-group">
        {{ Form::label('apikey', 'API Key:') }}
        {{ Form::text('apikey', NULL, array('class' => 'form-control', 'name' => 'details[apikey]', 'required' => '', 'placeholder' => "Provide API Key")) }}
    </div>
</div>