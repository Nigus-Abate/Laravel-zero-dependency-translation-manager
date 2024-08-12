<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
   <!--  <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ url('public/assets/images/faces/face8.jpg') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">Richard V.Welsh</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">Manager</small>
                <span class="status-indicator online"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
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
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>
                <a class="dropdown-item"> Sign Out </a>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-block">New Project <i class="mdi mdi-plus"></i>
        </button>
      </div>
    </li> -->
   <li class="nav-item {{ active_class('admin') }}">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">{{ trans('global.dashboard') }}</span>
    </a>
</li>

@can('user_management_access')
<li class="nav-item {{ active_class(['admin/users*', 'admin/permissions*', 'admin/roles*', 'admin/audit-logs*']) }}">
    <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="{{ is_active_route(['admin/users*', 'admin/permissions*', 'admin/roles*', 'admin/audit-logs*']) }}" aria-controls="user-management">
        <i class="menu-icon mdi mdi-account"></i>
        <span class="menu-title">{{ trans('userManagement') }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ show_class(['admin/users*', 'admin/permissions*', 'admin/roles*', 'admin/audit-logs*']) }}" id="user-management">
        <ul class="nav flex-column sub-menu">
            @can('permission_access')
            <li class="nav-item {{ active_class('admin/permissions*') }}">
                <a class="nav-link" href="{{ route('admin.permissions.index') }}">{{ trans('permission') }}</a>
            </li>
            @endcan
            @can('role_access')
            <li class="nav-item {{ active_class('admin/roles*') }}">
                <a class="nav-link" href="{{ route('admin.roles.index') }}">{{ trans('role') }}</a>
            </li>
            @endcan
            @can('user_access')
            <li class="nav-item {{ active_class('admin/users*') }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">{{ trans('users') }}</a>
            </li>
            @endcan
            @can('audit_log_access')
            <li class="nav-item {{ active_class('admin/audit-logs*') }}">
                <a class="nav-link" href="{{ route('admin.audit-logs.index') }}">{{ trans('logs') }}</a>
            </li>
            @endcan
        </ul>
    </div>
</li>
@endcan

@can('general_setting_access')
<li class="nav-item {{ active_class('admin/settings*') }}">
    <a class="nav-link" href="{{ url('/admin/settings/general') }}">
        <i class="menu-icon mdi mdi-settings"></i>
        <span class="menu-title">{{ __('settings') }}</span>
    </a>
</li>
@endcan

@php($unread = \App\Models\QaTopic::unreadCount())
<li class="nav-item {{ active_class('admin/messenger*') }}">
    <a class="nav-link" href="{{ route('admin.messenger.index') }}">
        <i class="menu-icon mdi mdi-chat"></i>
        <span class="menu-title">{{ trans('global.messages') }}
            @if($unread > 0)
            <span class="badge badge-primary ml-1">({{ $unread }})</span>
            @endif
        </span>
    </a>
</li>


  <li class="nav-item {{ active_class(['basic-ui/*']) }}">
    <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
      <i class="menu-icon mdi mdi-dna"></i>
      <span class="menu-title">Basic UI Elements</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-ui">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item {{ active_class(['basic-ui/buttons']) }}">
          <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Buttons</a>
        </li>
        <li class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
          <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Dropdowns</a>
        </li>
        <li class="nav-item {{ active_class(['basic-ui/typography']) }}">
          <a class="nav-link" href="{{ url('/basic-ui/typography') }}">Typography</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item {{ active_class(['forms/forms']) }}">
    <a class="nav-link" href="{{ url('/forms/forms') }}">
      <i class="menu-icon mdi mdi-apps-box"></i>
      <span class="menu-title">Forms</span>
    </a>
  </li> 
  <li class="nav-item {{ active_class(['charts/chartjs']) }}">
    <a class="nav-link" href="{{ url('/charts/chartjs') }}">
      <i class="menu-icon mdi mdi-chart-line"></i>
      <span class="menu-title">Charts</span>
    </a>
  </li>
  <li class="nav-item {{ active_class(['tables/basic-table']) }}">
    <a class="nav-link" href="{{ url('/tables/basic-table') }}">
      <i class="menu-icon mdi mdi-table-large"></i>
      <span class="menu-title">Tables</span>
    </a>
  </li>
  <li class="nav-item {{ active_class(['icons/material']) }}">
    <a class="nav-link" href="{{ url('/icons/material') }}">
      <i class="menu-icon mdi mdi-emoticon"></i>
      <span class="menu-title">Icons</span>
    </a>
  </li>
  <li class="nav-item {{ active_class(['user-pages/*']) }}">
    <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="{{ is_active_route(['user-pages/*']) }}" aria-controls="user-pages">
      <i class="menu-icon mdi mdi-lock-outline"></i>
      <span class="menu-title">User Pages</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ show_class(['user-pages/*']) }}" id="user-pages">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item {{ active_class(['user-pages/login']) }}">
          <a class="nav-link" href="{{ url('/user-pages/login') }}">Login</a>
        </li>
        <li class="nav-item {{ active_class(['user-pages/register']) }}">
          <a class="nav-link" href="{{ url('/user-pages/register') }}">Register</a>
        </li>
        <li class="nav-item {{ active_class(['user-pages/lock-screen']) }}">
          <a class="nav-link" href="{{ url('/user-pages/lock-screen') }}">Lock Screen</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="https://www.bootstrapdash.com/demo/star-laravel-free/documentation/documentation.html" target="_blank">
      <i class="menu-icon mdi mdi-file-outline"></i>
      <span class="menu-title">Documentation</span>
    </a>
  </li>
</ul>
</nav>

 
<div class="theme-setting-wrapper">
  <div id="color-settings" class="settings-panel">
    <i class="settings-close mdi mdi-close"></i>
    <div class="d-flex align-items-center justify-content-between border-bottom">
      <p class="settings-heading font-weight-bold border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Template Skins</p>
    </div>
    <div class="sidebar-bg-options" id="sidebar-light-theme">
      <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
    </div>
    <div class="sidebar-bg-options" id="sidebar-dark-theme">
      <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
    </div>
    <p class="settings-heading font-weight-bold mt-2">Header Skins</p>
    <div class="color-tiles mx-0 px-2">
      <div class="tiles primary"></div>
      <div class="tiles success"></div>
      <div class="tiles warning"></div>
      <div class="tiles danger"></div>
      <div class="tiles pink"></div>
      <div class="tiles info"></div>
      <div class="tiles dark"></div>
      <div class="tiles default"></div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the theme options
    const lightThemeButton = document.getElementById('sidebar-light-theme');
    const darkThemeButton = document.getElementById('sidebar-dark-theme');

    // Function to apply the theme
    function applyTheme(theme) {
        document.body.classList.remove('light-theme', 'dark-theme'); // Remove existing theme classes
        document.body.classList.add(theme); // Add the selected theme class

        // Save the selected theme in localStorage
        localStorage.setItem('selectedTheme', theme);
    }

    // Event listeners for theme buttons
    lightThemeButton.addEventListener('click', function() {
        applyTheme('light-theme');
    });

    darkThemeButton.addEventListener('click', function() {
        applyTheme('dark-theme');
    });

    // Apply the saved theme on page load
    const savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
        applyTheme(savedTheme);
    }
});

</script>


<style type="text/css">
/* Light Theme */
.light-theme {
    /* Add your light theme styles here */
    background-color: white;
    color: black;
}

/* Dark Theme */
.dark-theme {
    /* Add your dark theme styles here */
    background-color: black;
    color: white;
}

</style>

