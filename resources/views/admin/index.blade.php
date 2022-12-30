@extends('admin.layouts.app')
@section('title', __('Admin / bdMirror'))
@section('admin_content')
<div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="{{ route('admin.home') }}" class="text-center"><img class="sidebar-img" src="{{ asset('img/logo.png') }}" alt=""></a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header text-center">
                <div class="user-info">
                    <span class="user-name">
                        <strong>{{ Auth::guard('admin')->user()->name }}</strong>
                    </span>
                    <span class="user-role">{{ Auth::guard('admin')->user()->email }}</span>
                </div>
            </div>
            <!-- sidebar-search  -->
            <div class="sidebar-menu">
                <ul>
                    {{-- <li class="sidebar-dropdown">
                    <a href="#">
                        <span>CONFIGURATION</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="#">Config</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                    <li class="header-menu">
                        <span>General</span>
                    </li>
                    <li class="">
                        <a href="" class="click-without-refresh">
                            {{-- <i class="fa fa-tachometer-alt"></i> --}}
                            <span>DASHBOARD</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                    </li>
                    <li class="header-menu">
                        <span>Management</span>
                    </li>

                    <li class="sidebar-dropdown">
                        <a href="#" class="d-flex justify-content-between align-items-center">
                            {{-- <i class="fas fa-cog"></i> --}}
                            <span>Legal Authority</span>
                            <i class="fa-solid fa-greater-than bg-transparent"></i>
                            {{-- <span class="badge badge-pill badge-primary">Beta</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('authority.user.grid') }}">Authority List</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="header-menu">
                        <span>System</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            {{-- <i class="fas fa-sliders-h"></i> --}}
                            <span>CONFIGURATION</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Config</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#" class="d-flex justify-content-between align-items-center">
                            {{-- <i class="fas fa-cog"></i> --}}
                            <span>SYSTEM</span>
                            <i class="fa-solid fa-greater-than bg-transparent"></i>
                            {{-- <span class="badge badge-pill badge-primary">Beta</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li class="header-menu">
                                    <span>Admin Users</span>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.grid') }}">All Users</a>
                                </li>
                                <li class="header-menu">
                                    <span>Cash</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
        <div class="sidebar-footer p-1">
            {{-- <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a> --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i>&nbsp;<b>Logout</b>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="admin page-content">
        <div class="container" style="max-width: 1620px; backgrround: #fff">
            @if(Route::currentRouteName() == 'admin.home')
            @include('admin.dashboard.dashboard')
            @else
            @yield('content')
            @endif
            <!-- page-content" -->
            <footer class="text-center" style="margin-top: 40px;">
                <div class="mb-2">
                    <small>
                        @if(date("Y")==2022)
                        <p class="p-2 m-0 text-center">{{ __('Copyright') }} © 2022 {{ __('Md. Moniruzzaman | All Right Reserved') }}</p>
                        @endif
                    </small>
                </div>
            </footer>
        </div>
    </main>
</div>
<!-- page-wrapper -->
<!-- page-wrapper -->
<script>
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
            .parent()
            .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });

</script>
@endsection
