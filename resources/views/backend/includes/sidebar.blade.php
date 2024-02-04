<div class="sidebar-base
            {{ !empty(getCustomizationSetting('sidebar_show')) || getCustomizationSetting('sidebar_show') == '' ? 'sidebar' : 'sidebar-none' }}
            {{ !empty(getCustomizationSetting('sidebar_menu_style')) ? getCustomizationSetting('sidebar_menu_style') : 'left-bordered' }}
            {{ getCustomizationSetting('sidebar_color') }}
            {{ !empty(getCustomizationSetting('sidebar_type')) ? implode(' ',getCustomizationSetting('sidebar_type')) : '' }}
            "
            data-toggle="main-sidebar" id="sidebar" data-sidebar="responsive">
    <div class="d-flex align-items-center justify-content-start">
        <div class="logo-main">
            <a href="{{route('backend.dashboard')}}" class="navbar-brand">
            <img class="logo-normal img-fluid" src="{{asset(setting('logo'))}}" height="30" alt="{{ app_name() }}">
                <img class="logo-normal dark-normal img-fluid" src="{{asset(setting('dark_logo'))}}" height="30" alt="{{ app_name() }}">
                <img class="logo-mini img-fluid" src="{{asset(setting('mini_logo'))}}" height="30" alt="{{ app_name() }}">
                <img class="logo-mini dark-mini img-fluid" src="{{asset(setting('dark_mini_logo'))}}" height="30" alt="{{ app_name() }}">
            </a>
        </div>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list" id="sidebar">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
              @php
                  $menu = new \App\Http\Middleware\GenerateMenus();
                  $menu = $menu->handle();
              @endphp
               @include(config('laravel-menu.views.bootstrap-items'), ['items' => $menu->roots()])
            </ul>
        </div>
    </div>
    <div class="sidebar-footer"></div>
</div>
