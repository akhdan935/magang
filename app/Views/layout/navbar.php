<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
<!-- Navbar Brand-->
<a class="navbar-brand ps-3" href="<?= site_url('auth/success') ?>">Magang</a>
<!-- Sidebar Toggle-->
<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
<!-- Navbar-->
<ul class="navbar-nav ms-auto me-3 me-lg-4">
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
    </ul>
</li>
</ul>
</nav>
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <?php if(session()->get('type_account') == 'admin') : ?>
            <div class="sb-sidenav-menu-heading">Admin</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts0a" aria-expanded="false" aria-controls="collapseLayouts0a">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Users
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts0a" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('admin') ?>">Users List</a>
                    <a class="nav-link" href="<?= site_url('admin/addusers') ?>">Add Users</a>
                </nav>
            </div>
            <?php endif; ?>

            <div class="sb-sidenav-menu-heading">User</div>

            <a class="nav-link" href="<?= site_url('user') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Presence
            </a>

            <?php if(session()->get('type_account') == 'user') : ?>
            <a class="nav-link" href="<?= site_url('user/absent') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Absent
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?= session()->get('username_account') ?>
    </div>
</nav>