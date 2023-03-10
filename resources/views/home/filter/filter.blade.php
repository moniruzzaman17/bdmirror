@extends('layouts.app')
@section('title', __('Profile | BD Mirror'))
@section('body-class', 'profile-home')
@section('content')
<div class="profile-wrapper">
    <main class="main-feed w-50 m-auto">
        @auth('citizen')
        @include('home.create')
        @endauth
        <div class="post-wrapper" style="text-align: left">
            @include('home.post')
        </div>
    </main>
</div>
@endsection
