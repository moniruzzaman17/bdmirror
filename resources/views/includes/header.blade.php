<nav class="navbar navbar-expand-lg p-0">
    <a class="navbar-brand" href="#"><img src="{{ asset('img/logo.png') }}" class="login-logo" alt=""></a>
    <div class="search-box-wrapper">
        <input type="search" class="search-box" placeholder="Search in BDmirror">
        <span class="icon-search" aria-label="hidden">🔎</span>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="navbarNav" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-nav-left align-items-center">
            <li class="nav-item"><a aria-label="Homepage" class="nav-link nav-link-left nav-button alt-text is-selected active"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a aria-label="Legal Authorities" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-gavel" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a aria-label="Reports" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="navbar-nav navbar-nav-right align-items-center w-100 justify-content-end">
            <li class="nav-item">
                <a aria-label="Message" class="nav-link nav-link-right nav-button alt-text" id="chat-avatar">
                    <i class="fas fa-comments nav-link-notification" aria-hidden="true"></i>
                    <span class="notification-badge">1</span>
                </a>
                <div class="chat-popup-wrapper header-popup">
                    this is Chat wrapper
                </div>

            </li>

            <li class="nav-item">
                <a aria-label="Notification" class="nav-link nav-link-notification nav-button alt-text nav-link-right" id="notification-avatar">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="notification-badge" style="top: -10px; right: -8px">12</span>
                </a>
                <div class="notification-popup-wrapper header-popup">
                    this is Notification wrapper
                </div>

            </li>


            <li class="nav-item">
                <a aria-label="Homepage" class="nav-link nav-button alt-text is-selected nav-link-right" id="profile-avatar">
                    <img src="{{ asset('img/moon.jpg') }}" class="profile-image-cover">
                </a>
                <div class="profile-popup-wrapper header-popup">
                    this is profile wrapper
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
        var _token = $('meta[name="csrf-token"]').attr('content');
        $('.chat-popup-wrapper').toggle();
        $('.profile-popup-wrapper').hide();
        $('.notification-popup-wrapper').hide();
    });

    $(document).mouseup(function(e) {
        e.stopPropagation();

        var container = $(".header-popup");
        // If the target of the click isn't the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.slideUp('fast');

        }
    });

</script>
