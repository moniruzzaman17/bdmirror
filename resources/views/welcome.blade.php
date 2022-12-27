@extends('layouts.app')
@section('title', __('BD Mirror'))
@section('body-class', 'app-home')
@section('content')
<div class="body-wrapper">
    {{-- @include('feed.feed') --}}
    @auth('citizen')
    @include('home.home')
    @endauth

    @guest('citizen')
    @include('auth.login')
    @endguest
</div>
@endsection
