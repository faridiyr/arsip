<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Dashboard_Operator') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Operator</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Dashboard_Operator') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Arsip Surat
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Masuk') ?>">
            <i class="fas fa-fw fa-download"></i>
            <span>Masuk</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keluar') ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Keluar</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Nikah') ?>">
            <i class="fas fa-fw fa-house-user"></i>
            <span>Keterangan Nikah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Usaha') ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Keterangan Usaha</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Catatan_Kepolisian') ?>">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>SKCK</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Izin_Kayu') ?>">
            <i class="fas fa-fw fa-tree"></i>
            <span>Keterangan Izin Kayu</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Ahli_Waris') ?>">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Keterangan Ahli Waris</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Kematian') ?>">
            <i class="fas fa-fw fa-bed"></i>
            <span>Keterangan Kematian</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Tidak_Mampu') ?>">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>Keterangan Tidak Mampu</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Surat_Keterangan_Lainnya') ?>">
            <i class="fas fa-fw fa-database"></i>
            <span>Keterangan Lainnya</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Profile') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Operator_Profile/edit_profile') ?>">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Edit Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Auth/change_password_operator') ?>">
            <i class="fas fa-fw fa-key"></i>
            <span>Change Password</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->