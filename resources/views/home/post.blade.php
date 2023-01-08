@foreach($complaints as $key => $complaint)
<article class="post mt-3 mb-3">
    <div class="info">
        <a href="#" class="user"> Josim Uddin </a>
        <span class="text"> commented on this</span>
    </div>
    <!-- Post Header -->
    <header class="post-header">
        <figure class="avatar-wrapper">
            <img src="{{ asset('img/moon.jpg') }}" class="avatar" alt="Post avatar" class="w-100" />
        </figure>
        <div class="content">
            <h4><strong> {{ $complaint->citizen->name }}</strong></h4>
            <p class="title"> {{ Carbon\Carbon::parse($complaint->created_at)->diffForHumans()}} </p>
            <span class="updated">{{ $complaint->complaintdivision->name }} | {{ $complaint->complaintdistrict->name }}| {{ $complaint->complaintupazila->name }}</span>
        </div>
    </header>

    <!-- Post Content Section -->
    <section class="post-content">
        <p class="content">
            {{ $complaint->details }}
        </p>
        <div class="stats">
            <span clas="likes"> {{ count($complaint->ratings) }} Likes </span>
            <span class="comments"> . {{ count($complaint->comments) }} Comments</span>
        </div>
        <div class="post-controls">
            <button class="btn btn-like"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like </button>
            <button class="btn btn-comment"> <i class="fa fa-comment" aria-hidden="true"></i> Comment </button>
            <button class="btn btn-share"> <i class="fa fa-share" aria-hidden="true"></i> Share </button>
        </div>
    </section>
    <!-- Post Comments Section -->
    <section class="post-comment-feed">
        @foreach($complaint->comments as $key => $comment)
        <div class="comment">
            <figure class="avatar-wrapper">
                <img src="https://avatars1.githubusercontent.com/u/1109686?v=4&s=460" class="avatar" alt="Post avatar" />
            </figure>
            <div class="content">
                <span class="user"> {{ $comment->citizen->name }} </span>

                <span class="text"> {{ $comment->details }}</span>

                <h5 class="updated"> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </h5>
            </div>
        </div>
        @endforeach
    </section>
</article>
@endforeach
