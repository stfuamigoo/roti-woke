<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>admin_dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_dashboard' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

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

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kriteria
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Kriteria/index">
            <i class="fas fa-scroll"></i>
            <span>Kriteria</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Siswa
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Siswa">
            <i class="fas fa-database"></i>
            <span>Siswa</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Nilai_siswa">
            <i class="fas fa-database"></i>
            <span>Nilai Siswa</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Perhitungan
    </div>

    <!-- Nav Item - Test Qeustion Collpapse -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_test' ? 'active' : ''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-table"></i>
            <span>Perbandingan</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url(); ?>perbandingan/perbandingan_kriteria">Perbandingan Kriteria</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>perbandingan/perbandingan_alternatif">Perbandingan Alternatif</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Payment -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_payment' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Hasil/tampil">
            <i class="far fa-fw fa-credit-card"></i>
            <span>Hasil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->