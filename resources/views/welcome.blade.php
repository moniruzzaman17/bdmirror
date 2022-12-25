@extends('layouts.app')
@section('title', __('BD Mirror'))
@section('body-class', 'app-home')
@section('content')
<div class="body-wrapper">
    {{-- @include('auth.login') --}}
    {{-- @include('feed.feed') --}}
    @include('home.home')
</div>
@endsection
