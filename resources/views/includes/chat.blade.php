<div class="notification-container">
    <!--     Notification list header -->
    <header class="notification-heading">
        <strong>Message</strong>
    </header>
    <!--     Notification Options -->
    <div class="notification-option pt-3 pb-3">
        <p> {{ $totalmsg }} conversation found </p>
    </div>
    <!--     Notification list container/box -->
    <div class="chat-list-box">
        <div class="list-group">
            @php
            $i = 0;
            if(Auth::guard('citizen')->check()){
            $type = "authority";
            }
            if(Auth::guard('authority')->check()){
            $type = "citizen";

            }
            // $senders = $senders->reverse();
            @endphp
            @foreach($senders as $key => $sender)
            <a href="{{ route('message',['type'=>$type ,'id'=>$sender->id]) }}" class="list-group-item w-100">
                <div class="d-flex align-items-center">
                    <div class="list-left">
                        <img class="img-circle" src="{{ asset('img/moon.jpg') }}">
                    </div>
                    <div class="list-right">
                        <h4 class="list-heading"> <b>{{ $sender->name }}</b> Send you a message</h4>
                        <div class="list-time"> {{ Carbon\Carbon::parse($sentMessages[$i++]->created_at)->diffForHumans()}}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
