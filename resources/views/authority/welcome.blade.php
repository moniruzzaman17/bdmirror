@extends('authority.layouts.app')
@section('title', __('BD Mirror'))
@section('body-class', 'app-home-authority')
@section('content')
<div class="body-wrapper">
    {{-- @include('feed.feed') --}}
    @include('authority.home.home')
</div>
@endsection
