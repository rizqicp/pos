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
