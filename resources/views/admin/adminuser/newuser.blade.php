@extends('admin.index')
@section('title', __('Add New User / ArtCam'))
@section('body-class', 'artcam-add-new-user')
@section('content')
	<div class="grid-head">
		<div style="height: 15px;"></div>
		<div class="head-content row">
			<div class="col-sm-4 text-left d-flex align-items-center">
				<h5>{{ __('Add Admin User') }}</h5>
			</div>
			<div class="col-sm-8">
				<a href="{{route('admin.user.grid')}}" class="btn action-button mr-auto"><i class="fas fa-arrow-left"></i>&#9; {{ __('Back') }}</a>
			</div>
		</div>
		<div style="height: 15px;"></div>
	</div>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
	<i class="fa fa-check" aria-hidden="true"></i>&#9;{{ session()->get('success') }}
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger" role="alert">
	<i class="fa fa-times" aria-hidden="true"></i>&#9;{{ session()->get('error') }}
</div>
@elseif ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@else
@endif
	<form action="{{ route('admin.user.create') }}" method="POST" class="add-admin-user-form m-auto">
		@csrf
	  <div class="form-group row">
	    <label for="inputName" class="col-sm-3 col-form-label required">Full Name</label>
	    <div class="col-sm-9">
	      <input type="text" name="newuserName" class="form-control" id="inputName">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail" class="col-sm-3 col-form-label required">Email</label>
	    <div class="col-sm-9">
	      <input type="email" name="newuserEmail" class="form-control" id="inputEmail" placeholder="{{__('example@onestylife.shop')}}">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputPass" class="col-sm-3 col-form-label required">New Password</label>
	    <div class="col-sm-9">
	      <input type="password" name="newuserPass" class="form-control" id="inputPass">
	    </div>
	  </div>
	  <br><p>Current User Identity Verification</p><hr>
	  <div class="form-group row">
	    <label for="inputYourPass" class="col-sm-3 col-form-label required">Your Password</label>
	    <div class="col-sm-9">
	      <input type="password" name="currentUserPass" class="form-control" id="inputYourPass">
	    </div>
	  </div>
	  <div class="form-group row">
	  	<div class="col-sm-3"></div>
	    <div class="col-sm-9">
	    	<input type="submit" class="btn action-button" value="Save User">
	    </div>
	  </div>
	</form>
@endsection