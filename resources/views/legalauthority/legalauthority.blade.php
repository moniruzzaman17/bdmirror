@extends('layouts.app')
@section('title', __('Legal Authority List BD Mirror'))
@section('body-class', 'legal-list-home')
@section('content')
<div class="authority-list-wrapper">
    <div class="container table-responsive py-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-bg">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Organization</th>
                    <th scope="col">Working District</th>
                    <th scope="col">Photo</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($authorities as $key => $authority)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $authority->name }}</td>
                    <td>{{ $authority->designation }}</td>
                    <td>{{ $authority->organization }}</td>
                    <td>{{ $authority->district->bn_name }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
