<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>admin_dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo ($role == "Admin") ? 'Admin' : 'Pegawai' ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_dashboard' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>



    <?php if ($role == "Admin") : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            User
        </div>
        <!-- Nav Item - Users -->
        <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo site_url(); ?>Admin_manage_user/index">
                <i class="fas fa-fw fa-users"></i>
                <span>Pengguna Web</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Produk/index">
            <i class="fas fa-database"></i>
            <span>Data Varian</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Data_Aktual/index">
            <i class="fas fa-database"></i>
            <span>Data Penjualan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Forecasting
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'perhitungan' ? 'active' : ''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-table"></i>
            <span>Perhitungan</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url(); ?>perhitungan/perhitungan">Perhitungan Penjualan</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>perhitungan/varian">Perhitungan Varian</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->