<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
        <img src="{{asset('images/logo.png')}}" alt="AdminLTE Logo" width="120"  style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pt-4 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('users.profile')}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{setActive('/')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('products.view')
                <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link {{setActive('product')}} {{setActive('product/*')}}">
                        <i class="nav-icon fas fa-gem"></i>
                        <p>
                           Product
                        </p>
                    </a>
                </li>
                @endcan
                @can('vendors.view')
                <li class="nav-item {{menuOpen('purchaseOrder/*')}} {{menuOpen('vendor')}} {{menuOpen('vendor/*')}}">
                    <a href="#" class="nav-link {{setActive('purchaseOrder')}} {{setActive('purchaseOrder/*')}} {{setActive('vendor')}} {{setActive('vendor/*')}}">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                           Vendor
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('vendor.index')}}" class="nav-link {{setActive('vendor')}} {{setActive('vendor/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Vendor</p>
                            </a>
                        </li>
                        @can('orders.view')
                        {{-- <li class="nav-item">
                            <a href="{{route('purchase-order.index')}}" class="nav-link {{setActive('purchaseOrder')}} {{setActive('purchaseOrder/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order</p>
                            </a>
                        </li> --}}
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('customers.view')
                <li class="nav-item {{menuOpen('customer')}} {{menuOpen('customer/*')}} {{menuOpen('saleOrder')}} {{menuOpen('saleOrder/*')}}">
                    <a href="#" class="nav-link {{setActive('customer')}} {{setActive('customer/*')}} {{setActive('saleOrder')}} {{setActive('saleOrder/*')}}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Customer
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('customer.index')}}" class="nav-link {{setActive('customer')}} {{setActive('customer/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Customer</p>
                            </a>
                        </li>
                        @can('orders.view')
                        <li class="nav-item">
                            <a href="{{route('sale-order.index')}}" class="nav-link {{setActive('saleOrder')}} {{setActive('saleOrder/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Order</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('orders.view')
                <li class="nav-item {{menuOpen('report')}} {{menuOpen('report/*')}} ">
                    <a href="#" class="nav-link {{setActive('report')}} {{setActive('report/*')}} ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('report.summarized')}}" class="nav-link {{setActive('report/summarized')}} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Summarized</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.purchaseOrder')}}" class="nav-link {{setActive('report/purchaseOrder')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.saleOrder')}}" class="nav-link {{setActive('report/saleOrder')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.expenses')}}" class="nav-link {{setActive('report/expenses')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expenses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.bestSelling')}}" class="nav-link {{setActive('report/bestSelling')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Best Selling</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-item {{menuOpen('settings')}} {{menuOpen('settings/*')}}">
                    <a href="#" class="nav-link {{setActive('settings')}} {{setActive('settings/*')}}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('other.change_settings')
                            <li class="nav-item">
                                <a href="{{route('category.index')}}" class="nav-link {{setActive('settings/product_category')}} {{setActive('settings/product_category/*')}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product Categories</p>
                                </a>
                            </li>
                        @endcan
                        @can('other.change_settings')
                        <li class="nav-item">
                            <a href="{{route('store.index')}}" class="nav-link {{setActive('settings/store')}} {{setActive('settings/store/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stores & Kiosks</p>
                            </a>
                        </li>
                        @endcan
                        @can('users.view')
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link {{setActive('settings/users')}} {{setActive('settings/users/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        @endcan
                        @can('other.change_settings')
                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link {{setActive('settings/roles')}} {{setActive('settings/roles/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles & Perms</p>
                            </a>
                        </li>
                        @endcan
                        @can('other.change_settings')
                        <li class="nav-item">
                            <a href="{{route('logs.index')}}" class="nav-link {{setActive('settings/logs')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Activity Logs</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{route('users.profile')}}" class="nav-link {{setActive('settings/profile')}} {{setActive('settings/profile/*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
