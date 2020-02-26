<form id="frm_new_integration" action="{{ route('integration.store') }}" method="post">

        <div class="form-group">
            <div class="row clearfix">
                <div class="col-md-12">
                    <label for="integration_title">Title</label>
                    <input type="text" name="integration_title" id="integration_title" class="form-control"
                           placeholder="give integration a name" value="{{ $data['userIntegration']->name }}" required/>
                </div>
                <input type="hidden" name="choose_service" value="{{ $data['userIntegration']->service_type }}" />
                <input type="hidden" name="integration" value="{{ $data['userIntegration']->service_type }}" />
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        </div>

        <div class="form-group dynamic-service-details">
            <div class="integration-fields">
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::text('email', $data['info']->email, array('class' => 'form-control', 'name' => 'details[email]', 'required' => '', 'placeholder' => "Provide email", 'autofocus' => '')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password:') }}
                    {{ Form::text('password', $data['info']->password, array('class' => 'form-control', 'name' => 'details[password]', 'required' => '', 'placeholder' => "Provide password")) }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <button type="submit" class="btn special-button-success"><i class="fa fa-floppy-o"
                                                                    aria-hidden="true"></i>
            Save Integration
        </button>
    </div>
</form>