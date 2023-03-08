@if(empty($mycomplaints) && empty($singlecomplaints))
@php
$complaints = $globalComplaint;
@endphp
{{-- $singlecomplaints from individual complaint view --}}
@elseif (!empty($singlecomplaints))
@php
$complaints = $singlecomplaints;
@endphp
@else
@php
$complaints = $mycomplaints;
@endphp
@endif
@foreach($complaints as $key => $complaint)
<article class="post mt-3 mb-3">
    <div class="info" style="padding-bottom: 40px;">
        @if($complaint->status ==1)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-todo">In Progress</li>
            <li class="progtrckr-todo">Resolved</li>
        </ol>
        @endif
        @if($complaint->status ==2)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-done">In Progress</li>
            <li class="progtrckr-todo">Resolved</li>
        </ol>
        @endif
        @if($complaint->status ==4)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-done">In Progress</li>
            <li class="progtrckr-done">Resolved</li>
        </ol>
        @endif
        @if($complaint->status ==3)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-done">On Hold</li>
            <li class="progtrckr-todo">In Progress</li>
            <li class="progtrckr-todo">Resolved</li>
        </ol>
        @endif
        @if($complaint->status ==5)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-done">In Progress</li>
            <li class="progtrckr-done">Closed</li>
        </ol>
        @endif
        @if($complaint->status ==6)
        <ol class="progtrckr" data-progtrckr-steps="5">
            <li class="progtrckr-done">Open</li>
            <li class="progtrckr-done">In Progress</li>
            <li class="progtrckr-done">Closed</li>
            <li class="progtrckr-done">Reopened</li>
            <li class="progtrckr-todo">In Progress</li>
            <li class="progtrckr-todo">Resolved</li>
        </ol>
        @endif
    </div>
    @foreach($complaint->comments as $key => $comment)
    @php
    $lastcommenter = $comment->citizen->name;
    @endphp
    @endforeach
    @if(empty($lastcommenter))
    @else
    <div class="info">
        <a href="#" class="user"> {{ $lastcommenter }} </a>
        <span class="text"> commented on this</span>
    </div>
    @endif
    <!-- Post Header -->
    <header class="post-header">
        <figure class="avatar-wrapper">
            @if(empty($complaint->citizen->image))
            <img src="{{ asset('img/avatar.png') }}" class="avatar" alt="Post avatar" class="w-100" />
            @else
            <img src="{{ $complaint->citizen->image }}" class="avatar" alt="Post avatar" class="w-100" />
            @endif
        </figure>
        <div class="content">
            <h4><strong> {{ $complaint->citizen->name }}</strong></h4>
            <p class="title"> {{ Carbon\Carbon::parse($complaint->created_at)->diffForHumans()}} </p>
            <span class="updated">{{ $complaint->complaintdivision->name }} | {{ $complaint->complaintdistrict->name }}| {{ $complaint->complaintupazila->name }}</span>
        </div>
        @if(Route::is('profile'))
        <div class="right-side-content">
            @if ($complaint->is_published == 1)
            <span class="text-success d-flex text-center flex-column"><i class="fa fa-globe" aria-hidden="true"></i> Published</span>
            @else
            <span class="text-danger d-flex text-center" style="border: 1px solid;">Not Published</span>
            @endif
        </div>
        @endif
        @if(Auth::guard('citizen')->check())
        @if($complaint->citizen->id == Auth::guard('citizen')->user()->id)
        <div class="post-options-wrapper">
            <i class="fa fa-ellipsis-h post-ellipsis" data="{{ $complaint->id }}" aria-hidden="true"></i>
            <div class="post-options post-options{{ $complaint->id }}" style="display: none">
                @if($complaint->is_published == 1)
                <style>
                    .post-options {
                        width: 160px;
                    }

                </style>
                <a href="javascript:void(0)" class="hidehBTN" data="{{ $complaint->id }}"><i class="fa fa-eye-slash" aria-hidden="true"></i>&nbsp;Hide from others</a>
                @else
                <style>
                    .post-options {
                        width: 90px;
                    }

                </style>
                <a href="javascript:void(0)" class="publishBTN" data="{{ $complaint->id }}"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Publish</a>
                @endif
                <a href="javascript:void(0)"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Update</a>
                <a href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
            </div>
        </div>
        <script>
            $('.post-ellipsis').unbind().click(function(e) {
                var post_id = $(this).attr('data');
                $('.post-options').not('.post-options' + post_id).hide();
                $('.post-options' + post_id).toggle();
            });

        </script>
        @endif
        @endif
        @if(Auth::guard('authority')->check())
        <div class="post-options-wrapper">
            <i class="fa fa-ellipsis-h post-ellipsis" data="{{ $complaint->id }}" aria-hidden="true"></i>
            <div class="post-options post-options{{ $complaint->id }}" style="display: none">
                <style>
                    .post-options {
                        width: 138px;
                    }

                </style>
                <a href="/messages/citizen/{{  $complaint->citizen_id }}"><i class="fa-solid fa-message"></i>&nbsp;Send Message</a>
            </div>
        </div>
        <script>
            $('.post-ellipsis').unbind().click(function(e) {
                var post_id = $(this).attr('data');
                $('.post-options').not('.post-options' + post_id).hide();
                $('.post-options' + post_id).toggle();
            });

        </script>
        @endif

    </header>

    <!-- Post Content Section -->
    <section class="post-content">
        <div class="content">
            {{ $complaint->details }}
        </div>
        <div class="post-image-preview">
            @if(count($complaint->medias) == 0)
            {{-- nothing --}}
            @elseif (count($complaint->medias) == 1)
            @if($complaint->medias[0]->type == "image")
            <div class="row w-100 p-0 m-0">
                <img src="{{ asset('medias/images') }}/{{ $complaint->medias[0]->medias }}" class="w-100" alt="">
            </div>
            @elseif ($complaint->medias[0]->type == "video")
            <video width="100" src="{{ asset('medias/videos') }}/{{ $complaint->medias[0]->medias }}" height="200" style="margin-right: 18px;" controls autoplay>
                Your browser does not support the video tag.
            </video>
            @elseif ($complaint->medias[0]->type == "document")
            <a href="{{ asset('medias/documents') }}/{{ $complaint->medias[0]->medias }}" download>{{ $complaint->medias[0]->medias }}</a>
            @else
            @endif
            @elseif (count($complaint->medias) > 1)
            <div class="row w-100 p-0 m-0">
                @php
                $i = 1;
                @endphp
                @foreach($complaint->medias as $key => $media)
                @if($media->type == "image")
                <div class="col-sm-6">
                    <img src="{{ asset('medias/images') }}/{{ $media->medias }}" class="w-100" alt="">
                </div>
                @elseif ($media->type == "video")
                <div class="row w-100 p-0 mt-3">
                    <video width="100" src="{{ asset('medias/videos') }}/{{ $media->medias }}" height="200" style="margin-right: 18px;" controls autoplay>
                        Your browser does not support the video tag.
                    </video>
                </div>
                @elseif ($media->type == "document")
                <div class="row w-100 p-0 mt-3">
                    <b>Downloadable Documents:</b>
                    <div class="d-flex align-items-center">
                        <span>{{ $i++ }}.</span>&nbsp;<a href="{{ asset('medias/documents') }}/{{ $media->medias }}" download>{{ $media->medias }}</a>
                    </div>
                </div>
                @else
                @endif
                @endforeach
            </div>
            @else
            @endif
        </div>
        <div class="linNcomment{{ $complaint->id }}">
            @include('home.likeNcomment')
        </div>
    </section>
    <!-- Post Comments Section -->
    <section class="post-comment-feed commentSection{{ $complaint->id }}">
        @include('home.comment')
    </section>
</article>
@endforeach
<script>
    $('.publishBTN').unbind().click(function(e) {
        // console.log('working');
        e.preventDefault;
        var complaint_id = $(this).attr('data');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/publish-complaint"
            , type: "POST"
            , data: {
                complaint_id: complaint_id
                , _token: _token
            }
            , success: function(data) {
                document.location.reload(true);
            }
        });
    });

    $('.hidehBTN').unbind().click(function(e) {
        // console.log('working');
        e.preventDefault;
        var complaint_id = $(this).attr('data');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/hide-complaint"
            , type: "POST"
            , data: {
                complaint_id: complaint_id
                , _token: _token
            }
            , success: function(data) {
                document.location.reload(true);
            }
        });
    });

</script>
