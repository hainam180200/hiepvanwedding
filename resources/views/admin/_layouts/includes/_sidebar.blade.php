@php
    $menus = config('menu_aside.items');
@endphp
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @forelse($menus as $menu)
                @php
                    $permission = explode(',', $menu['permission'] ?? '');
                @endphp
            @if(Auth::user()->hasRole('admin') || ($menu['permission'] ?? '') == '' || (count(array_intersect(Auth::user()->getAllPermissions()->pluck('name')->toArray(), $permission)) > 0)  )
                    @if(isset($menu['section']))
                        <li class="nav-header">{{$menu['section']}}</li>
                    @elseif(isset($menu['submenu']))
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="{{$menu['icon']}}"></i>
                                <p>
                                    {{$menu['title']}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    @forelse($menu['submenu'] as $subMenu)
                                        <a href="{{route($subMenu['route'])}}" class="nav-link @if(Request::routeIs($subMenu['route'])) active @endif">
                                            <i class="{{$subMenu['icon'] ?? 'far fa-circle nav-icon'}}"></i>
                                            <p>{{$subMenu['title']}}</p>
                                        </a>
                                    @empty
                                    @endforelse
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{route($menu['route'])}}" class="nav-link @if(Request::routeIs($menu['route'])) active @endif">
                                <i class="{{$menu['icon']}}"></i>
                                <p>
                                    {{$menu['title'] ?? ''}}
                                </p>
                            </a>
                        </li>
                    @endif
            @endif
            @empty
            @endforelse
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
