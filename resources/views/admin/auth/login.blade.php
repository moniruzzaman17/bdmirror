@extends('admin.layouts.app')
@section('title', __("Login"))
@section('body-class', __("admin-login-body"))
@section('admin_content')
<div class="admin-login">
    <div class="admin-login-container">
        <header class="login-header">
            <a href="" data-edition="Community Edition" class="logo">
                <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="bdMirror Admin Logo" title="bdMirror-30 BCS">

            </a>
        </header>
        <div class="admin-content">
            <form method="post" action="{{ route('admin.login.action') }}" id="login-form" autocomplete="off" novalidate="novalidate">
                @csrf
                <fieldset class="form-group admin_fieldset mt-2">

                    @if(session()->has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session()->get('warning') }}
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
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
                    <legend class="mb-2">{{ __('Welcome, Admin Login') }}</legend>
                    @endif
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    <div style="height: 28px;"></div>
                    <label for="email">Password</label>
                    <input type="password" name="password" class="form-control">
                </fieldset>
                <fieldset class="action-bar">
                    <div class="forgot-pass-link">
                        <a href="">Forgot Your Password?</a>
                    </div>
                    <div style="height: 28px;"></div>
                    <input type="submit" class="action-button" value="{{ __('LOGIN') }}">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<footer class="login-footer">
    <p class="copyright text-light">{{ __('Copyright') }} © 2022 {{ __('Md. Moniruzzaman | All Right Reserved') }}</p>
</footer>
@endsection
