@extends('admin.index')
@section('title', __('Admin User Details / ArtCam'))
@section('body-class', 'artcam-admin-user-details')
@section('content')
<div class="grid-container">
    @csrf
    <div class="grid-head">
        <div style="height: 15px;"></div>
        <div class="head-content row">
            <div class="col-sm-4 text-left">
                <h4>{{$user->name}}</h4>
            </div>
            <div class="col-sm-8">
                <a href="{{route('admin.user.grid')}}" class="btn action-button mr-2"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{ __(' Back') }}</a>
                @if($userCount > 1)
                <a href="{{route('admin.user.delete',['user_id'=>request('id')])}}" onclick="return confirm('Are you sure?')" class="btn action-button mr-2"><i class="fa fa-trash" aria-hidden="true"></i>{{ __(' Delete User') }}</a>
                @endif
            </div>
        </div>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
    </div>
    @elseif(session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        <i class="fa fa-times" aria-hidden="true"></i> {{ session()->get('failed') }}
    </div>
    @elseif(session()->has('warning'))
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ session()->get('warning') }}
    </div>
    @elseif ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div style="height: 30px;"></div>
    <div class="details-container">
        <div class="row m-auto">
            {{-- <input type="hidden" name="configID" value="{{request('role_id')}}"> --}}
            <div class="col-sm-12">
                <form action="{{route('admin.user.details',array('user_id'=> request('user_id')))}}" method="POST" class="add-admin-user-form m-auto">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label text-right required">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="userName" class="form-control" id="inputName" value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label text-right required">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="userEmail" class="form-control" id="inputEmail" value="{{$user->email}}" placeholder="{{__('example@onestylife.shop')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPass" class="col-sm-3 col-form-label text-right required">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="userPass" class="form-control" id="inputPass"><br>
                            {{-- <i class="text-danger"></i> --}}
                        </div>
                    </div>
                    <br>
                    <p>Current User Identity Verification</p>
                    <hr>
                    <div class="form-group row">
                        <label for="inputYourPass" class="col-sm-3 col-form-label text-right required">Your Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="currentUserPass" class="form-control" id="inputYourPass" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input type="submit" class="btn action-button" name="updateUserBtn" value="Update User">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
