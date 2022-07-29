<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <p class="sidebar-brand" >
            <span class="align-middle">{{$setting->name}}</span>
        </p>
        <ul class="sidebar-nav">
            @foreach( $menus as $menu )
                @if(Auth::guard('admin')->user()->can('View All '.$menu->title) || Auth::guard('admin')->user()->can('Create Module'))
                    <li class="sidebar-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                        <a class="sidebar-link" href=" {{ route($menu->route) }}  ">
                            <i class="align-middle {{ $menu->icon }}"></i> <span class="align-middle">{{$menu->title}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>