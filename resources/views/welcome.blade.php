@extends('layouts.app')
@section('title', __('BD Mirror'))
@section('body-class', 'app-home')
@section('content')
{{-- @include('auth.login') --}}
{{-- @include('feed.feed') --}}
@include('home.home')
@endsection
