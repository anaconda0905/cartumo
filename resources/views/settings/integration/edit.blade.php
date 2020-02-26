<form id="frm_new_integration" action="{{ route('integration.store') }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Integration</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <div class="row clearfix">
                <div class="col-md-6">
                    <label for="integration_title">Title</label>
                    <input type="text" name="integration_title" id="integration_title" class="form-control"
                           placeholder="give integration a name" required/>
                </div>
                <div class="col-md-6">
                    <label for="choose_service">Choose Services</label>
                    <select class="form-control" name="choose_service" id="choose_service">
                        <option value="">Select Integration type</option>
                        @if ( !empty($data['availableIntegrations']) )
                            @foreach ( $data['availableIntegrations'] as $key=>$availableIntegration )
                                <option value="{{ $key }}">{{ ucfirst($key) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        </div>

        <div class="form-group dynamic-service-details">
            <p>No Service Selected</p>
        </div>
    </div>
</form>