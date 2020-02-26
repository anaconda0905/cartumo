<div class="integration-fields">
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
</div>