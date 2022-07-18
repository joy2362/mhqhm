<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <p class="sidebar-brand" >
            <span class="align-middle">CMS</span>
        </p>
        <ul class="sidebar-nav">
            @foreach( $menus as $menu )
            <li class="sidebar-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                <a class="sidebar-link" href=" {{ route($menu->route) }}  ">
                    <i class="align-middle {{ $menu->icon }}"></i> <span class="align-middle">{{$menu->title}}</span>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</nav>