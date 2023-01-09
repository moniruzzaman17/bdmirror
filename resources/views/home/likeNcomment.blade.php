<div class="stats">
    <span clas="likes"> {{ count($complaint->ratings) }} Likes </span>
    <span class="comments"> . {{ count($complaint->comments) }} Comments</span>
</div>
<div class="post-controls">
    @auth('citizen')
    @if(count($complaint->ratings) > 0)
    @foreach($complaint->ratings as $key => $rating)
    @if($rating->complaint_id == $complaint->id && $rating->citizen->id == Auth::guard('citizen')->user()->id)
    @php
    $rated = true;
    @endphp
    @else
    @php
    $rated = false;
    @endphp
    @endif
    @endforeach
    @if($rated == true)
    <button class="btn btn-like text-success" data="{{ $complaint->id }}" user-data="{{ Auth::guard('citizen')->user()->id }}"> <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i> Like </button>
    @else
    <button class="btn btn-like" data="{{ $complaint->id }}" user-data="{{ Auth::guard('citizen')->user()->id }}"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like </button>
    @endif
    @else
    <button class="btn btn-like" data="{{ $complaint->id }}" user-data="{{ Auth::guard('citizen')->user()->id }}"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like </button>
    @endif
    @endauth
    <button class="btn btn-comment"> <i class="fa fa-comment" aria-hidden="true"></i> Comment </button>
    <button class="btn btn-share"> <i class="fa fa-share" aria-hidden="true"></i> Share </button>
</div>
<script>
    $('.btn-like').unbind().click(function(e) {

        // e.preventDefault;
        var complaint_id = $(this).attr('data');
        var citizen_id = $(this).attr('user-data');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/like"
            , type: "POST"
            , data: {
                complaint_id: complaint_id
                , citizen_id: citizen_id
                , _token: _token
            }
            , success: function(data) {
                // console.log($(this).parent().parent('.linNcomment')).text();
                $('.linNcomment' + complaint_id).html(data);
                console.log(data);
            }
        });
    });

</script>
