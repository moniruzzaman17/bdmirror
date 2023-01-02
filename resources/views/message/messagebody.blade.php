<div class="body-container" id="chat_body_container">
    @foreach($messages as $key => $message)
    @if(Auth::guard('citizen')->check())
    @if($message->receiver_type == "citizen")
    <div class="incoming">
        <div class="bubble m-0">
            <p>{{ $message->message }}</p>
        </div><br>
        <i class="msg-time">{{ date('d-m-y h:ia', strtotime($message->created_at)) }}</i>
    </div>
    @else
    <div class="outgoing">
        <div class="bubble m-0">
            <p>{{ $message->message }}</p>
        </div><br>

        <i class="msg-time">{{ date('d-m-y h:ia', strtotime($message->created_at)) }}</i>
    </div>
    @endif
    @endif
    @if(Auth::guard('authority')->check())
    @if($message->receiver_type == "authority")
    <div class="incoming">
        <div class="bubble m-0">
            <p>{{ $message->message }}</p><br>
            <i class="msg-time">{{ date('d-m-y h:ia', strtotime($message->created_at)) }}</i>
        </div>
    </div>
    @else
    <div class="outgoing">
        <div class="bubble m-0">
            <p>{{ $message->message }}</p><br>
            <i class="msg-time">{{ date('d-m-y h:ia', strtotime($message->created_at)) }}</i>
        </div>
    </div>
    @endif
    @endif
    @endforeach
    {{-- <div class="typing">
    <div class="bubble m-0">
        <div class="ellipsis dot_1"></div>
        <div class="ellipsis dot_2"></div>
        <div class="ellipsis dot_3"></div>
    </div>
</div> --}}
</div>
