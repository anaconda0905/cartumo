@if ( Session::has('success') )
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('success') }}
    </div>
@elseif(Session::has('alert'))
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; {{ Session::get('alert') }}
    </div>
@endif
