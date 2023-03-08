@extends('layouts.app')
@section('title', __('Complaint | BD Mirror'))
@section('body-class', 'complaint-home')
@section('content')
<style>
    .complaint-wrapper {
        width: 50%;
        margin: auto;
    }

</style>
<div class="complaint-wrapper">
    <div class="post-wrapper" style="text-align: left">
        @include('home.post')
    </div>
</div>
@endsection
