<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title> {{setting('site_title')}}</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('public/assets/favicon.ico') }}">

   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/uploads/logo/'.setting('site_favicon')).'?'.time() }}')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/uploads/logo/'.setting('site_favicon')).'?'.time() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/uploads/logo/'.setting('site_favicon')).'?'.time() }}">

    <link rel="manifest" href="{{ asset('assets/site.webmanifest')}}">
    
    <link rel="mask-icon" href="{{ asset('public/uploads/logo/'.setting('site_favicon')).'?'.time() }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <!-- <meta name="msapplication-config" content="{{ asset('assets/browserconfig.xml')}}"> -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content="{{config('app.name')}}">
    <meta name="application-name" content="{{config('app.name')}}">

  <!-- plugin css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}">
  <!-- end plugin css -->
  @stack('styles')
  <!-- common css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/flag/css/flag-icons.min.css') }}">
  <!-- end common css -->
  @stack('style')
</head>
<body data-base-url="{{url('/')}}">
  <div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')
      <div class="main-panel"> 
        <div class="content-wrapper">
          @include('layout.alert')
          @yield('content')
        </div>
        @include('layout.footer')
      </div>
    </div>
  </div>
  <!-- base js -->
  <script type="text/javascript" src="{{ asset('public/js/theme.js') }}"></script>

  <script type="text/javascript" src="{{ asset('public/js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <!-- end base js -->

  <!-- plugin js -->
  @stack('scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script type="text/javascript" src="{{ asset('public/assets/js/off-canvas.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/hoverable-collapse.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/misc.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/settings.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/todolist.js') }}"></script>
  <!-- end common js -->

  @stack('custom-scripts')
</body>
</html>