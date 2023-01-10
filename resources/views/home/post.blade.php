@if(empty($mycomplaints))
@php
$complaints = $globalComplaint;
@endphp
@else
@php
$complaints = $mycomplaints;
@endphp
@endif
@foreach($complaints as $key => $complaint)
<article class="post mt-3 mb-3">
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
