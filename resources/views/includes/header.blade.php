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
        <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a aria-label="Homepage" class="nav-link nav-link-left nav-button alt-text is-selected"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a aria-label="Legal Authorities" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-gavel" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a aria-label="Message" class="nav-link nav-link-left nav-button alt-text"><i class="fas fa-comments" aria-hidden="true"></i><span class="notification-badge">1</span></a></li>
            <li class="nav-item"><a aria-label="Reports" class="nav-link nav-link-left nav-button alt-text"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="navbar-nav align-items-center w-100 justify-content-end">
            <li class="nav-item"><a aria-label="Notification" class="nav-link nav-link-notification nav-button alt-text nav-link-right"><i class="fa fa-bell" aria-hidden="true"></i><span class="notification-badge" style="top: -10px; right: -8px">12</span></a></li>


            <li class="nav-item" style="margin-left: -29px"><a aria-label="Homepage" class="nav-link nav-button alt-text is-selected nav-link-right"><img src="{{ asset('img/moon.jpg') }}" class="profile-image-cover"></a></li>

        </ul>
    </div>
</nav>
<script>
    $('.navbar-toggler').on('click', function() {
        console.log("wokring");
        $('.navbar-collapse').toggle('show');


    });

</script>
