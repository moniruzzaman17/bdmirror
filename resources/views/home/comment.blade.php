@if(count($complaint->comments) > 0)
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
@else
<i>No Comments</i>
@endif
