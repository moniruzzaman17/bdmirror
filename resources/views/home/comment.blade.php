@auth('citizen')
<div class="add-comment add-comment{{ $complaint->id }} mt-3">
    <figure class="avatar-wrapper">
        @auth('citizen')
        @if(empty(Auth::guard('citizen')->user()->image))
        <img src="{{ asset('img/avatar.png') }}" class="avatar" alt="Post avatar" />
        @else
        <img src="{{ Auth::guard('citizen')->user()->image }}" class="avatar" alt="Post avatar" />
        @endif
        @endauth
    </figure>
    <div class="textfield">
        <input type="text" name="comment" data="{{ $complaint->id }}" user-data="{{ Auth::guard('citizen')->user()->id }}" class="commentBox" placeholder="Add a comment" />
        <button class="btn btn-camera"> <i class="fa fa-camera-retro" aria-hidden="true"></i> </button>
    </div>
</div>
@endauth

@if(count($complaint->comments) > 0)
@foreach($complaint->comments as $key => $comment)
<div class="comment">
    <figure class="avatar-wrapper">
        @if(empty($complaint->citizen->image))
        <img src="{{ asset('img/avatar.png') }}" class="avatar" alt="Post avatar" />
        @else
        <img src="{{ $complaint->citizen->image }}" class="avatar" alt="Post avatar" />
        @endif
    </figure>
    <div class="content">
        <span class="user"> {{ $comment->citizen->name }} </span>
        <span class="text"> {{ $comment->details }}</span>
        <h5 class="updated"> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </h5>
        @if(Auth::guard('citizen')->check())
        <div class="comment-ellipsis-wrapper comment-ellipsis-wrapper{{ $comment->id }}" style="display: none">
            <a href="" class="deleteCommentBtn" data1="{{ $comment->id }}" data="{{ $complaint->id }}" user-data="{{ Auth::guard('citizen')->user()->id }}">Delete</a>
        </div>
        @endif
    </div>
    @if(Auth::guard('citizen')->check())
    @if($comment->citizen->id == Auth::guard('citizen')->user()->id)
    <i class="fa fa-ellipsis-h comment-ellipsis" data="{{ $comment->id }}" aria-hidden="true"></i>
    @endif
    @endif
</div>
@endforeach
@else
<i>No Comments</i>
@endif
<script>
    $(document).unbind().on("keypress", ".commentBox", function(e) {
        if (e.which == 13) {
            var commentText = $(this).val();
            var complaint_id = $(this).attr('data');
            var citizen_id = $(this).attr('user-data');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/add-comment"
                , type: "GET"
                , data: {
                    complaint_id: complaint_id
                    , citizen_id: citizen_id
                    , commentText: commentText
                    , _token: _token
                }
                , success: function(data) {
                    $('.commentSection' + complaint_id).html(data);
                    // console.log(data)
                }
            });

        }
    });

    $('.btn-comment').unbind().click(function(e) {
        var complaint_id = $(this).attr('data');
        $('.add-comment' + complaint_id).toggle();
    });

    $('.comment-ellipsis').unbind().click(function(e) {
        var comment_id = $(this).attr('data');
        $('.comment-ellipsis-wrapper').not('.comment-ellipsis-wrapper' + comment_id).hide();
        $('.comment-ellipsis-wrapper' + comment_id).toggle();
    });

    $('.deleteCommentBtn').unbind().click(function(e) {
        e.preventDefault();
        var comment_id = $(this).attr('data1');
        var complaint_id = $(this).attr('data');
        var citizen_id = $(this).attr('user-data');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/delete-comment"
            , type: "GET"
            , data: {
                complaint_id: complaint_id
                , citizen_id: citizen_id
                , comment_id: comment_id
                , _token: _token
            }
            , success: function(data) {
                $('.commentSection' + complaint_id).html(data);
            }
        });
    });

</script>
