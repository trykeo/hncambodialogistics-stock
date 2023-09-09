<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @if (auth()->user()->is_admin || auth()->user()->country == 'thailand')
            {{-- @can('th_stock_in_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.th-stock-ins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/th-stock-ins") || request()->is("admin/th-stock-ins/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                        </i>
                        TH {{ trans('cruds.stockIn.title') }}
                    </a>
                </li>
            {{-- @endcan --}}
            {{-- @can('stock_out_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.th-stock-outs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/th-stock-outs") || request()->is("admin/th-stock-outs/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-truck c-sidebar-nav-icon">

                        </i>
                        TH {{ trans('cruds.stockOut.title') }}
                    </a>
                </li>
            {{-- @endcan --}}
        @endif

        @if (auth()->user()->is_admin || auth()->user()->country == 'cambodia')
            {{-- @can('kh_stock_in_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.pending-kh-stock-ins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pending-kh-stock-ins") || request()->is("admin/pending-kh-stock-ins/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-clock-o c-sidebar-nav-icon">

                        </i>
                        Receiving KH {{ trans('cruds.stockIn.title') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.kh-stock-ins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kh-stock-ins") || request()->is("admin/kh-stock-ins/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                        </i>
                        KH {{ trans('cruds.stockIn.title') }}
                    </a>
                </li>
            {{-- @endcan --}}
            {{-- @can('stock_complete_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.stock-deliver.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/stock-deliver") || request()->is("admin/stock-deliver/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-truck-loading c-sidebar-nav-icon">

                        </i>
                        {{-- {{ trans('cruds.stockComplete.title') }} --}}
                        KH Stock Out - Deliver
                    </a>
                </li>
            {{-- @endcan --}}
            {{-- @can('stock_complete_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.stock-pickup.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/stock-pickup") || request()->is("admin/stock-pickup/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-check-circle c-sidebar-nav-icon">

                        </i>
                        {{-- {{ trans('cruds.stockComplete.title') }} --}}
                        KH Stock Out - Pickup
                    </a>
                </li>
            {{-- @endcan --}}
        @endif

        @can('order_report_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.order-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-reports") || request()->is("admin/order-reports/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-chart-bar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.orderReport.title') }}
                </a>
            </li>
        @endcan
        {{-- @can('product_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.product.title') }}
                </a>
            </li>
        @endcan --}}

        @can('product_movement_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.product-movements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-movements") || request()->is("admin/product-movements/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productMovement.title') }}
                </a>
            </li>
        @endcan

        @can('location_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/locations") || request()->is("admin/locations/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-warehouse c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.location.title') }}
                </a>
            </li>
        @endcan
        
        {{-- @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan --}}
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>