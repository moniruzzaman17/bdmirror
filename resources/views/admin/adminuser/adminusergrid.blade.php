@extends('admin.index')
@section('title', __('Admin User Grid / bdMirror'))
@section('body-class', 'bdmirror-admin-user-grid')
@section('content')
<div class="grid-head">
    <div style="height: 15px;"></div>
    <div class="head-content row">
        <div class="col-sm-4 text-left d-flex align-items-center">
            <h5>{{ __('Admin Users') }}</h5>
        </div>
        <div class="col-sm-8">
            <a href="{{ route('admin.user.create') }}" class="btn action-button mr-auto"><i class="fa fa-user-plus" aria-hidden="true"></i>{{ __(' Add New User') }}</a>
        </div>
    </div>
    <div style="height: 15px;"></div>
    <div class="order-filter-head">
        <div class="grid-filter w-25">
            <div style="height: 30px;"></div>
            <div class="top">
                <form action="" method="post">
                    <div class="input-group grid-search-input-group">
                        <input type="text" class="form-control search-box" id="adminUserGridSearchBox" placeholder="Start Typing to Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        {{-- <div class="input-group-append">
								<span class="input-group-text" id="basic-addon">
									<button type="submit" class="search-btn"><i class="fas fa-search" for="#butn"></i></button>
								</span>
							</div> --}}
                    </div>
                </form>
            </div>
            {{-- <p>{{count($orders)}} {{__('Records Found')}}</p> --}}
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
<div class="adminuser-grid-body mt-2">
    <div class="table-responsive">
        <table class="table adminUserGridTable">
            <thead>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Action')}}</th>
            </thead>
            <tbody>
                @foreach ($adminusers as $adminuser)
                <tr>
                    <td>{{$adminuser->id}}</td>
                    <td>{{$adminuser->name}}</td>
                    <td>{{$adminuser->email}}</td>
                    <td><a href="{{ route('admin.user.details',['user_id'=>$adminuser->id]) }}">{{__('Details')}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
