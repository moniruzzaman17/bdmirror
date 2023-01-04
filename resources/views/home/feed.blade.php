<main class="main-feed">
    @auth('citizen')
    @include('home.create')
    @endauth
    <div class="post-wrapper">
        @include('home.post')
    </div>
</main>
