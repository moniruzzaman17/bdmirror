{{-- geting current local variable --}}
<?php $local= Config::get('app.locale') ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1024" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('img/favicon.png') }}' />

    <!-- Scripts -->
    <script src="{{ asset('js/admin/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

</head>
<body class="@yield('body-class')">
    {{-- include main pagecontent --}}
    @yield('admin_content')
</body>
</html>
