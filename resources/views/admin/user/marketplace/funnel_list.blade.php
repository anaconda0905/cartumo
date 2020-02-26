<table class="table table-bordered">
    <thead>
        <tr><th></th><th>Name</th> <th>Type</th></tr>
    </thead>
     @foreach ( $funnels as $funnel )
        <tr>
            <td><input type="checkbox" name="marketplace_funnels[]" id="funnel_{{ $funnel->id }}" value="{{ $funnel->id }}" /></td>
            <td>
                <label for="funnel_{{ $funnel->id }}">
                    &nbsp; {{ $funnel->name }} &nbsp;
                </label>
            </td>
            <td><small>({{ $funnel->type }})</small></td>
        </tr>
    @endforeach
</table>