<main class="main-feed">
    @auth('citizen')
    @include('home.create')
    @endauth
    <div class="post-wrapper" style="text-align: left">
        @include('home.post')
    </div>
</main>
