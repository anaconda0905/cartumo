@if ( !empty($helpCenterTopics) )
    <ul class="lists">
        @if ( $helpCenterTopics->count() > 0 )
            @foreach ( $helpCenterTopics as $helpCenterTopic )
                <li>
                    <a href="{{ route('site.help.topic', $helpCenterTopic->slug) }}">{{ $helpCenterTopic->title }}</a>
                </li>
            @endforeach
        @else
            <li style="padding: 0px 15px">No discussion has found</li>
        @endif
    </ul>
@else
    <li style="padding: 0px 15px">No discussion has found</li>
@endif