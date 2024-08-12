<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/') }}">
      <img src="{{ asset('public/uploads/logo/'.setting('site_logo')).'?'.time() }}" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
        <img src="{{ asset('public/uploads/logo/'.setting('site_favicon')).'?'.time() }}" alt="logo" /> </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav">
         @if(count(config('panel.available_languages', [])) > 1)
         <li class="nav-item dropdown language-dropdown">
          <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="d-inline-flex mr-0 mr-md-3">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-us"></i>
              </div>
            </div>
            <span class="profile-text font-weight-medium  d-md-block {{ config('panel.available_languages.' . app()->getLocale() . '.flag') }}"> <!-- {{ strtoupper(app()->getLocale()) }} --> </span>
          </a>
          <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
           @foreach(config('panel.available_languages') as $langLocale => $langData)
           <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}" title="{{ $langData['name'] }}">
            <div class="flag-icon-holder">
              <span class="{{$langData['flag']}}"></span>
            </div> {{ strtoupper($langData['name']) }}
          </a>
          @endforeach

        </div>
      </li>
      @endif
    </ul>

    <ul class="navbar-nav navbar-nav-left header-links">
      <li class="nav-item active d-none d-xl-flex">
        <a href="{{ route('clear-cache')}}" class="nav-link">{{ __('App Optimization')}} <!-- <span class="badge badge-primary ml-1">New</span> -->
        </a>
      </li>
      
      <li class="nav-item dropdown d-none d-lg-flex">
        <a class="nav-link dropdown-toggle px-0" id="quickDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> Quick Links </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown pt-3" aria-labelledby="quickDropdown">
          <a href="#" class="dropdown-item">Schedule <span class="badge badge-primary ml-1">New</span></a>
          <a href="#" class="dropdown-item"><i class="mdi mdi-cached"></i>{{ __('Reports')}}</a>
          <a href="#" class="dropdown-item"><i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <!-- notification -->
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            <span class="count bg-success">{{ auth()->user()->unreadNotifications()->count() }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
            @if (auth()->user()->unreadNotifications()->count() > 0)
            <a href="{{ route('notifications.markAllAsRead') }}" class="dropdown-item py-3 border-bottom">
              <p class="mb-0 font-weight-medium float-left">{{ auth()->user()->unreadNotifications->count() }} new notifications </p>
              <span class="btn btn-link float-right mdi me-2">Mark All as Read</span>
            </a>

            @else
            <a href="#" class="dropdown-item py-3 border-bottom">
              <p class="mb-0 font-weight-medium float-left">There are no unread notifications</p>
            </a>
            @endif

            @foreach(auth()->user()->unreadNotifications as $notification)
            @if (isset($notification->data['url']))
            <a class="dropdown-item preview-item py-3" href="{{ $notification->data['url'] }}">
             <div class="preview-thumbnail">
              <!-- <i class="mdi mdi-chevron-double-right m-auto text-primary"></i> -->
            </div>

            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal text-dark mb-1">{{ $notification->data['message'] }}</h6>
              <p class="font-weight-light small-text mb-0"> {{ $notification->created_at->diffForHumans()}} </p>
            </div>
            @if (!$notification->read_at)
            <form action="{{ route('notifications.markAsRead', ['id' => $notification->id]) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-link btn-sm p-0 ms-2">
                <i class="mdi mdi-checkbox-marked-circle-outline m-auto text-success"></i>
              </button>
            </form>
            @endif
          </a>
          @else
           <a class="dropdown-item preview-item py-3" href="#">
          <div class="preview-item-content">
            <h6 class="preview-subject font-weight-normal text-dark mb-1">{{ $notification->data['message'] }}</h6>
            <p class="font-weight-light small-text mb-0"> {{ $notification->created_at->diffForHumans()}} </p>
          </div>
        </a>
          @endif
          @endforeach
        </div>
      </li>
      <!-- end notification -->
       <li class="nav-item d-none d-lg-block" id="color-setting">
        <a class="nav-link" href="#">
          <i class="mdi mdi-tune"></i>
        </a>
      </li>

      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text d-none d-md-inline-flex">{{auth()->user()->name}}</span>
          <img class="img-xs rounded-circle" src="{{ url('public/assets/images/faces/face8.jpg') }}" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <a class="dropdown-item p-0">
              <div class="d-flex border-bottom w-100 justify-content-center">
                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                  <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                </div>
                <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                  <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                </div>
                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                  <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                </div>
              </div>
            </a>
            <a class="dropdown-item mt-2" href="{{ route('profile.password.edit') }}"> Manage Accounts </a>
            <a class="dropdown-item"> Check Inbox </a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
              <i class="mdi mdi-flattr "></i> {{ trans('global.logout') }}
            </a>
          </div>
        </li>
      </ul>
      <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu icon-menu"></span>
      </button>
    </div>
  </nav>

