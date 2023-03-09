<nav class="navbar navbar-expand-lg p-0">
    <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" class="login-logo" alt="">
        @auth('authority')
        <style>
            .navbar-brand {
                text-align: center;
            }

        </style>
        <h6 class="pr-2">Legal Authority Panel</h6>
        @endauth
    </a>
    <div class="search-box-wrapper">
        <input type="search" class="search-box" placeholder="Search in BDmirror">
        <span class="icon-search" aria-label="hidden">🔎</span>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="navbarNav" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-nav-left align-items-center">
            <li class="nav-item"><a href="/" aria-label="Homepage" class="nav-link nav-link-left nav-button alt-text is-selected active"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a href="{{ route('authority.list') }}" aria-label="Legal Authorities" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-gavel" aria-hidden="true"></i></a></li>
            @auth('citizen')
            <li class="nav-item"><a href="{{ route('map') }}" aria-label="Map" class="nav-link nav-link-left nav-button alt-text"><i class="fa-solid fa-location-dot"></i></a></li>

            @endauth
            @auth('authority')
            <li class="nav-item"><a href="{{ route('complaint.list') }}" aria-label="Complaint Details" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-list" aria-hidden="true"></i></a></li>
            @endauth
            <li class="nav-item"><a href="{{ route('complaint.catreport') }}" aria-label="Reports" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="navbar-nav navbar-nav-right align-items-center w-100 justify-content-end">
            <li class="nav-item">
                <a aria-label="Message" class="nav-link nav-link-right nav-button alt-text" id="chat-avatar">
                    <i class="fas fa-comments nav-link-notification" aria-hidden="true"></i>
                    <span class="notification-badge">{{ $totalConversation }}</span>

                </a>
                <div class="chat-popup-wrapper header-popup">
                    <div class="chat-body">
                        {{-- @include('includes.chat') --}}
                    </div>
                </div>

            </li>

            <li class="nav-item">
                <a aria-label="Notification" class="nav-link nav-link-notification nav-button alt-text nav-link-right" id="notification-avatar">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="notification-badge" style="top: -10px; right: -8px">{{ $notificationsCount }}</span>

                </a>
                <div class="notification-popup-wrapper header-popup">
                    <div class="notification-body">
                        @include('includes.notification')
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="" aria-label="Homepage" class="nav-link nav-button alt-text is-selected nav-link-right" id="profile-avatar">
                    @auth('citizen')
                    @if(empty(Auth::guard('citizen')->user()->image))
                    <img src="{{ asset('img/avatar.png') }}" class="profile-image-cover" />
                    @else
                    <img src="{{ Auth::guard('citizen')->user()->image }}" class="profile-image-cover" />
                    @endif
                    @endauth
                    @auth('authority')
                    @if(empty(Auth::guard('authority')->user()->image))
                    <img src="{{ asset('img/avatar.png') }}" class="profile-image-cover" />
                    @else
                    <img src="{{ Auth::guard('authority')->user()->image }}" class="profile-image-cover" />
                    @endif
                    @endauth
                </a>
                <div class="profile-popup-wrapper header-popup">
                    <ul class="common-list p-0">
                        <li class="common-list-item">
                            <a href="{{ route('profile') }}" class="common-list-button">
                                <span class="icon">
                                    @auth('citizen')
                                    @if(empty(Auth::guard('citizen')->user()->image))
                                    <img src="{{ asset('img/avatar.png') }}" class="user-image" height="36" width="36" />
                                    @else
                                    <img src="{{ Auth::guard('citizen')->user()->image }}" class="user-image" height="36" width="36">
                                    @endif
                                    @endauth
                                    @auth('authority')
                                    @if(empty(Auth::guard('authority')->user()->image))
                                    <img src="{{ asset('img/avatar.png') }}" class="user-image" height="36" width="36" />
                                    @else
                                    <img src="{{ Auth::guard('authority')->user()->image }}" class="user-image" height="36" width="36" />
                                    @endif
                                    @endauth
                                </span>
                                <span class="text">
                                    My Profile (
                                    @auth('citizen')
                                    {{ Auth::guard('citizen')->user()->name }}
                                    @endauth
                                    @auth('authority')
                                    {{ Auth::guard('authority')->user()->name }}
                                    @endauth
                                    )</span>
                            </a>
                        </li>
                        <li class="common-list-item">
                            <a href="" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();" class="common-list-button">
                                <span class="icon">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </span>
                                <span class="text">Logout</span>
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
<script>
    $('.navbar-toggler').on('click', function() {
        $('.navbar-collapse').toggle('show');


    });

    $('#profile-avatar').on('click', function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $('.profile-popup-wrapper').toggle();
        $('.notification-popup-wrapper').hide();
        $('.chat-popup-wrapper').hide();
    });

    $('#notification-avatar').on('click', function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $('.notification-popup-wrapper').toggle();
        $('.profile-popup-wrapper').hide();
        $('.chat-popup-wrapper').hide();
    });

    $('#chat-avatar').on('click', function(e) {
        e.preventDefault();
        $('.chat-popup-wrapper').toggle();
        $('.profile-popup-wrapper').hide();
        $('.notification-popup-wrapper').hide();
        var _token = $('meta[name="csrf-token"]').attr('content');
        console.log('working');
        $.ajax({
            url: "/view-chat-notification"
            , type: "POST"
            , data: {
                _token: _token
            },

            // shows the loader element before sending.
            beforeSend: function() {
                $(".msg-spinner").fadeIn('fast');
            }
            , success: function(data) {
                $('.chat-body').html(data);
            }
            , error: function(response) {
                console.log('Error Function Working');
            }
        });
    });

    $(document).mouseup(function(e) {
        e.stopPropagation();

        var container = $(".header-popup");
        // If the target of the click isn't the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.slideUp('fast');

        }
    });

    // $(document).on('click', '#chat-avatar', function(event) {
    //     event.preventDefault();
    //     var _token = $('meta[name="csrf-token"]').attr('content');
    //     console.log('working');
    //     $.ajax({
    //         url: "/view-chat-notification"
    //         , type: "POST"
    //         , data: {
    //             _token: _token
    //         },

    //         // shows the loader element before sending.
    //         beforeSend: function() {
    //             $(".msg-spinner").fadeIn('fast');
    //         }
    //         , success: function(data) {
    //             $('.chat-body').html(data);
    //             console.log(data);
    //         }
    //         , error: function(response) {
    //             console.log('Error Function Working');
    //         }
    //     });
    // });

</script>
