<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
                <i class="bi bi-grid"></i><span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Management</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users*') ? '' : 'collapsed' }}" href="{{route('users.index')}}">
                <i class="bi bi-people"></i><span>Users</span>
            </a>
        </li><!-- End users Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/roles*') ? '' : 'collapsed' }}" href="{{route('roles.index')}}">
                <i class="bi bi-receipt"></i><span>Roles</span>
            </a>
        </li><!-- End roles Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/products*') ? '' : 'collapsed' }}" href="{{route('products.index')}}">
                <i class="bi bi-shop"></i><span>Products</span>
            </a>
        </li><!-- End products Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/categories*') ? '' : 'collapsed' }}" href="{{route('categories.index')}}">
                <i class="bi bi-tag"></i><span>Category</span>
            </a>
        </li><!-- End categories Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/sub_category*') ? '' : 'collapsed' }}" href="{{route('sub_category.index')}}">
                <i class="bi bi-text-indent-left"></i><span>Sub Category</span>
            </a>
        </li><!-- End sub category Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/posts*') ? '' : 'collapsed' }}" href="{{route('posts.index')}}">
                <i class="bi bi-view-list"></i><span>Posts</span>
            </a>
        </li><!-- End posts Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/country*') ? '' : 'collapsed' }}" href="{{route('country.index')}}">
                <i class="bi bi-geo-alt"></i><span>Country</span>
            </a>
        </li><!-- End country Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/currency*') ? '' : 'collapsed' }}" href="{{route('currency.index')}}">
                <i class="bi bi-currency-dollar"></i><span>Currency</span>
            </a>
        </li><!-- End currency Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/banner*') ? '' : 'collapsed' }}" href="{{route('banner.index')}}">
                <i class="bi bi-hdd-stack"></i><span>Banner</span>
            </a>
        </li><!-- End banner Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/order_status*') ? '' : 'collapsed' }}" href="{{route('order_status.index')}}">
                <i class="bi bi-sticky"></i><span>Order Status</span>
            </a>
        </li><!-- End order_status Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/orders*') ? '' : 'collapsed' }}" href="{{route('orders.index')}}">
                <i class="bi bi-minecart"></i><span>Orders</span>
            </a>
        </li><!-- End orders Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/profile') ? '' : 'collapsed' }}" href="{{route('profile.edit')}}">
                <i class="bi bi-person"></i><span>My Profile</span>
            </a>
        </li><!-- End orders Nav -->

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-right"></i><span>Sign Out</span>
                </a>
            </form>
        </li><!-- End orders Nav -->

    </ul>

  </aside>
