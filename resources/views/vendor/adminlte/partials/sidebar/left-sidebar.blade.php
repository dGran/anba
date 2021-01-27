<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')

{{--                 <li class="nav-item">
                <a href="{{ route('home') }}" class="my-4 btn btn-danger text-xs text-uppercase tracking-widest w-100">
                    cerrar admin
                </a>
            </li> --}}

                <li class="nav-item py-4 mt-4" style="border-top: 1px solid #4b545c;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('home') }}" style="line-height: 1.1em; padding-top: .7em; padding-bottom: .7em">
                        <i class="fas fa-door-open text-center" style="width: 24px; font-size: 1.1em; margin-right: .3em"></i>
                        <p>
                            Cerrar Admin
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>
