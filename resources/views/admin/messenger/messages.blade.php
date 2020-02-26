@if ( !empty($messages) && $messages->count() > 0 )
    @foreach ( $messages as $message )
        <!-- From auth user to admin -->
        @if ( ($message->type == 0) ) 
            <div class="chat-history-message message-from-user">
                <ul>                                        
                    <li><img src="{{ asset('images/chat/man.png') }}" /></li>
                    <li class="successful"><p>{{ $message->message_text }}</p></li>
                </ul>
            </div>
        <!-- From admin to user -->
        @else            
            <div class="chat-history-message message-from-admin">
                <ul>                    
                    <li class="successful"><p>{{ $message->message_text }}</p></li>
                    <li><img src="{{ asset('images/chat/admin.png') }}" /></li>
                </ul>
            </div>
        @endif
    @endforeach
@endif