<table class="user-marketplace-table">
    @if ( $funnels->count() > 0 )
        @foreach ( $funnels as $funnel )
            <tr>
                <td>{{ $funnel->funnel->name }} &nbsp; <small>{{ $funnel->funnel->type }}</small></td> 
                <td class="text-right"><button type="button" class="btn btn-danger" data-marketplace-id="{{ $funnel->id }}" data-user-id="{{ $funnel->user_id }}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
            </tr>
        @endforeach
    @else
        <tr><td colspan="2">No funnels in users's marketplace</td></tr>
    @endif
</table>