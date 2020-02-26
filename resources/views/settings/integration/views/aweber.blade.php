<form id="frm_new_integration" action="{{ route('integration.store') }}" method="post">

    <a href="https://auth.aweber.com/1.0/oauth/authorize_app/<APP ID>"></a>

    <div class="integration_details clearfix">
        <img src="{{ asset('frontend/images/integration/aweber.png') }}"> <br />
        <p>Note: You should have Sign Up Form for the selected list in your Aweber account.</p> <br />

        <a href="{{ $data['auth_url'] }}" target="_blank" class="btn special-button-warning">CONNECT</a>
    </div>        

</form>