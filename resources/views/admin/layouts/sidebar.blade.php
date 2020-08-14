<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200">
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>
      <li class="nav-item {{ isSideBarActive("") }}">
        <a href="{{ route('admin.index') }}" class="nav-link nav-toggle">
          <i class="fa fa-tachometer"></i>
          <span class="title">Dashboard</span>
        </a>
      </li>
        @foreach($menus as $menu)
          <li class="{{ $menu->class }} {{ isSideBarActive($menu->route) }}">
            <a href="#" class="nav-link nav-toggle">
              {!! $menu->icon !!}  <span class="title">{{ ucfirst($menu->title) }}</span>
              <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
              @foreach($menu->children as $child)
                @if(routeHas($child->route))
                  <li class="{{ $child->class }} {{ isSubMenuActive($child->route) }} ">
                    <a href="{{ route($child->route) }}" class="nav-link ">
                      {!! $child->icon !!}
                      <span class="title">{{ ucfirst($child->title) }}</span>
                    </a>
                  </li>
                @endif
              @endforeach
            </ul>
          </li>
        @endforeach
    </ul>
  </div>
</div>
