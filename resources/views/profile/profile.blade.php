@extends('layouts.app')
@section('title', __('Profile | BD Mirror'))
@section('body-class', 'profile-home')
@section('content')
<div class="profile-wrapper">
    @include('profile.profilecontent')
</div>
@endsection
