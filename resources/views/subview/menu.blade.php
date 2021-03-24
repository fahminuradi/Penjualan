<li class="nav-item active">
    <a class="nav-link" href="/home">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-list"></i>
        <span>Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        @if(Auth::user()->level == 'admin')
        <a class="collapse-item" href="/user"><i class="fa fa-circle-o"></i> User</a>
        @endif
        <a class="collapse-item" href="/supplier"><i class="fa fa-circle-o"></i> Supplier</a>
        <a class="collapse-item" href="/pegawai"><i class="fa fa-circle-o"></i> Pegawai</a>
        <a class="collapse-item" href="/kategori"><i class="fa fa-circle-o"></i> Kategori</a>
        <a class="collapse-item" href="/produk"><i class="fa fa-circle-o"></i> Produk</a>
        <a class="collapse-item" href="/agen"><i class="fa fa-circle-o"></i> Agen</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="/transaksi_masuk">
    <i class="fa fa-fw fa-exchange"></i>
    <span>Transaksi Masuk</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/report_penjualan">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Report Penjualan</span></a>
</li>