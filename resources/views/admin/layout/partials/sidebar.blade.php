
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <p class="sidebar-brand" >
            <span class="align-middle">{{$setting->name}}</span>
        </p>
        <ul class="sidebar-nav">
            @foreach( $menus as $menu )
                @if(Auth::guard('admin')->user()->can('index '.lcfirst($menu->title)) )
                    <li class="sidebar-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                        <a class="sidebar-link" href=" {{ route($menu->route) }}  ">
                            <i class="align-middle {{ $menu->icon }}"></i> <span class="align-middle">{{$menu->title}}</span>
                        </a>
                    </li>
                @endif
            @endforeach

            <li class="sidebar-item ">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Master Setup</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class="sidebar-link" href="#">Analytics</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">E-Commerce </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Crypto </a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>