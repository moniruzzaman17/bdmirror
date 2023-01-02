@extends('layouts.app')
@section('title', __('BD Mirror'))
@section('body-class', 'app-home')
@section('content')
<div class="body-wrapper">
    {{-- @include('feed.feed') --}}
    @if(Auth::guard('authority')->check())
    @include('home.home')
    @elseif (Auth::guard('citizen')->check())
    @include('home.home')
    @else
    @include('auth.login')
    @endif
</div>
@endsection
