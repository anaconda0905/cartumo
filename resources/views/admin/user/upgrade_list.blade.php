<ul class="user-upgrade-choose-list">
    @if ( $data['users']->count() > 0 )
        @foreach ( $data['users'] as $user )
            <li>
                <label for="user_{{ $user->id }}">
                    <input type="checkbox" name="user_id[]" value="{{ $user->id }}" id="user_{{ $user->id }}" data-user-name="{{ $user->name }}" />
                    <?php echo str_replace($data['keyword'], '<u>' . $data['keyword'] . '</u>', $user->name); ?>
                </label>
            </li>
        @endforeach
    @else
        <li>No user matched</li>
    @endif
</ul>