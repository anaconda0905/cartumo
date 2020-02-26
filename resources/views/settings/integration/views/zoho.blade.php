<div class="integration-fields">
    <div class="form-group">
        {{ Form::label('email', 'Email Address:') }}
        {{ Form::email('email', NULL, array('class' => 'form-control', 'name' => 'details[email]', 'required' => '', 'placeholder' => "Provide email", 'autofocus' => '')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password:') }}
        {{ Form::text('password', NULL, array('class' => 'form-control', 'name' => 'details[password]', 'required' => '', 'placeholder' => "Provide password")) }}
    </div>
</div>