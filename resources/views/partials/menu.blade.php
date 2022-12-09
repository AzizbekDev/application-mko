<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is("admin") ? "active" : "" }}"
                       href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon" aria-hidden="true">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is("admin/search") || request()->is("admin/search/*") ? "active" : "" }}"
                       href="{{ route('admin.application.search') }}">
                        <i class="fa fa-fw fa-search nav-icon" aria-hidden="true"></i>
                        <p>
                            {{ trans('cruds.search.title') }}
                        </p>
                    </a>
                </li>
                @can('application_access')
                    <li class="nav-item has-treeview
                    {{ request()->is("admin/applications*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-id-card"></i>
                            <p>
                                {{ trans('cruds.application.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon" aria-hidden="true"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.applications', 'new')}}" class="nav-link {{ request()->is("admin/applications/new") || request()->is("admin/applications/new/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fa fa-minus-square color-blue"></i>
                                    <p>
                                        {{ trans('cruds.applicationNew.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.applications', 'viewed')}}" class="nav-link {{ request()->is("admin/applications/viewed") || request()->is("admin/applications/viewed/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fa fa-plus-square color-yellow"></i>
                                    <p>
                                        {{ trans('cruds.applicationViewed.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.applications', 'approved')}}" class="nav-link {{ request()->is("admin/applications/approved") || request()->is("admin/applications/checked/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fa fa-check-square color-green"></i>
                                    <p>
                                        {{ trans('cruds.applicationChecked.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.applications', 'rejected')}}" class="nav-link {{ request()->is("admin/applications/rejected") || request()->is("admin/applications/checked/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fa fa-window-close color-red"></i>
                                    <p>
                                        {{ trans('cruds.applicationRejected.title') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.applications', 'blocked')}}" class="nav-link {{ request()->is("admin/applications/blocked") || request()->is("admin/applications/blocked/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fa fa fa-ban color-gray"></i>
                                    <p>
                                        {{ trans('cruds.applicationBlocked.title') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('client_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fa fa-address-book"></i>
                            <p>
                                {{ trans('cruds.clients.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('marketing_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/brands*") ? "menu-open" : "" }} {{ request()->is("admin/merchants*") ? "menu-open" : "" }} {{ request()->is("admin/merchant-periods*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fa fa-sitemap"></i>
                            <p>
                                {{ trans('cruds.marketing.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon" aria-hidden="true"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('brands_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.brands.index") }}" class="nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fa fa-user"></i>
                                        <p>
                                            {{ trans('cruds.brands.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('merchants_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.merchants.index") }}" class="nav-link {{ request()->is("admin/merchants") || request()->is("admin/merchants/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fa fa-users"></i>
                                        <p>
                                            {{ trans('cruds.merchants.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('merchant_periods_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.merchant-periods.index") }}" class="nav-link {{ request()->is("admin/merchant-periods") || request()->is("admin/merchant-periods/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fa fa-users"></i>
                                        <p>
                                            {{ trans('cruds.merchantPeriods.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('report_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "active" : "" }}"
                           href="{{ route("admin.application.reports") }}">
                            <i class="fa-fw nav-icon fa fa-signal" aria-hidden="true"> </i>
                            <p>
                                {{ trans('cruds.reports.title') }}
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users" aria-hidden="true"></i>
                            <p>
                                {{ trans('cruds.employee.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt"></i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user"></i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('setting_access')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "active" : "" }}"
                           href="{{ route("admin.settings.index") }}">
                            <i class="fa-fw nav-icon fa fa-cogs" aria-hidden="true"></i>
                            <p>
                                {{ trans('cruds.settings.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>