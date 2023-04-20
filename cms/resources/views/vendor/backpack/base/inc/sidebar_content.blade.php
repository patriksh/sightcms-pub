{{-- Backpack admin panel sidebar items --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i> <span>{{ __('Dashboard') }}</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="nav-icon la la-globe"></i> <span>{{ __('Frontend') }}</span></a></li>

<li class="nav-title">Content</li>
@if(backpack_user()->hasPermissionTo('home_blocks'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('home-block') }}"><i class="nav-icon la la-home"></i>{{ __('Homepage') }}</a></li>
@endif
@if(backpack_user()->hasPermissionTo('static_pages'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon la la-file-o"></i>{{ __('Static pages') }}</a></li>
@endif
@if(backpack_user()->hasPermissionTo('articles'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i>{{ __('Articles') }}</a></li>
@endif
@if(in_array(app('currentTenant')->type, ['all', 'government'])) {{-- TODO: Helper function. --}}
    @if(backpack_user()->hasPermissionTo('documents'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('document') }}"><i class="nav-icon la la-file-alt"></i>{{ __('Documents') }}</a></li>
    @endif
@endif
@if(backpack_user()->hasPermissionTo('events'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('event') }}"><i class="nav-icon la la-calendar"></i>{{ __('Events') }}</a></li>
@endif
@if(in_array(app('currentTenant')->type, ['all', 'tourism']))
    @if(backpack_user()->hasPermissionTo('attractions'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('attraction') }}"><i class="nav-icon la la-mountain"></i>{{ __('Attractions') }}</a></li>
    @endif
    @if(backpack_user()->hasPermissionTo('gastronomy'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('gastro') }}"><i class="nav-icon la la-wine-glass"></i>{{ __('Gastronomy') }}</a></li>
    @endif
    @if(0 && backpack_user()->hasPermissionTo('bike_routes'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bike-route') }}"><i class="nav-icon la la-biking"></i>{{ __('Bike routes') }}</a></li>
    @endif
    @if(backpack_user()->hasPermissionTo('audio_tours'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('audio-tour') }}"><i class="nav-icon la la-headphones"></i>{{ __('Audio tours') }}</a></li>
    @endif
@endif

@if(backpack_user()->hasPermissionTo('appearance'))
    <li class="nav-title">Appearance</li>
    <li class="nav-item nav-dropdown">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('preference/identity') }}"><i class="nav-icon la la-pen-alt"></i> <span>{{ __('Identity') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon la la-ellipsis-h"></i> <span>{{ __('Header') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('preference/footer') }}"><i class="nav-icon la la-ellipsis-v"></i> <span>{{ __('Footer') }}</span></a></li>
    </li>
@endif

@if(backpack_user()->hasPermissionTo('settings'))
    <li class="nav-title">Settings</li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i>{{ __('Authentication') }}</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{ __('Users') }}</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i> <span>{{ __('Roles') }}</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{ __('Permissions') }}</span></a></li>
        </ul>
    </li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('preference/contact') }}"><i class="nav-icon la la-at"></i>{{ __('Contact') }}</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('preference/seo') }}"><i class="nav-icon la la-bolt"></i>{{ __('SEO') }}</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('preference/analytics') }}"><i class="nav-icon la la-chart-line"></i>{{ __('Analytics') }}</a></li>
@endif