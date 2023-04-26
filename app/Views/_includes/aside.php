<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aplikasi Gudang</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home text-light"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="<?= base_url('kategori') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sitemap text-primary"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('satuan') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th text-warning"></i>
                        <p>Satuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('barang') ?>" class="nav-link">
                        <i class="nav-icon fas fa-box text-danger"></i>
                        <p>Barang</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>