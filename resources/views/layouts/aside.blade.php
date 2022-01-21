<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('storage/img/majooLogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Majoo</span>
        {{-- <h3>Point Of Sales</h3> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if ($user->role_id == 1)
                    <li class="nav-header"><i class="nav-icon fas fa-poll"></i> &nbsp; Transaksi</li>
                    <li class="nav-item">
                        <a href="{{route('transaction.buy')}}" class="nav-link">
                            <i class="fas fa-shopping-cart nav-icon"></i>
                            <p>Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('transaction.sell')}}" class="nav-link">
                            <i class="fas fa-cash-register nav-icon"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>

                    <li class="nav-header"><i class="nav-icon fas fa-table"></i> &nbsp; Master</li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Pelanggan</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{route('supplier')}}" class="nav-link">
                            <i class="fas fa-people-carry nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('category')}}" class="nav-link">
                            <i class="fas fa-th  nav-icon"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('product')}}" class="nav-link">
                            <i class="fas fa-cubes nav-icon"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users')}}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{route('consumer.buy')}}" class="nav-link">
                            <i class="fas fa-shopping-cart nav-icon"></i>
                            <p>Pembelian</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
