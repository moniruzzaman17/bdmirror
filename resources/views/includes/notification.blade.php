<div class="notification-container">
    <!--     Notification list header -->
    <header class="notification-heading">
        <strong>Notification</strong>
    </header>
    <!--     Notification Options -->
    <div class="notification-option pt-3 pb-3">
        <p> {{ $notificationsCount }} notification unread </p>
    </div>
    <!--     Notification list container/box -->
    <div class="notification-list-box">
        <div class="list-group">
            @foreach($notifications as $key => $notification)
            <a href="{{ $notification->url }}" class="list-group-item active w-100">

                <div class="d-flex align-items-center">
                    <div class="list-content">
                        <h4 class="list-heading">{{ $notification->message }}</h4>
                        <div class="list-time"> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}} </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
{{-- <a href="#" class="list-group-item w-100">
                <div class="d-flex align-items-center">
                    <div class="list-content">
                        <h4 class="list-heading"> Mr. Josim sent you a message</h4>
                        <div class="list-time"> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
</div>
</div>
</div>
</a> --}}
