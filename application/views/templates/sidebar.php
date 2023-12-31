<style>
    .custom-class {
        margin-right: 5px;
        /* Adjust the margin as needed */
    }
</style>

<body class="sb-nav-fixed" style="background-color: var(--bs-gray-200);">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->

        <div class="navbar-brand ps-3 align-items-center d-flex">
            <img src="<?php echo base_url() ?>assets/img/hiu.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top ms-3">
            <div class="fw-bold mt-2 ms-3">
                <h3>Admin</h3>
            </div>
        </div>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('auth/logout') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
    $currentPage = $this->uri->segment(2); // Assuming the controller method is the second URI segment

    function isMenuItemActive($menuItem, $currentPage)
    {
        return $menuItem === $currentPage ? 'active' : '';
    }
    ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isMenuItemActive('dashboard_admin', $currentPage); ?>" href="<?php echo base_url('admin/dashboard_admin') ?>">
                                <i class="fas fa-fw fa-tachometer-alt custom-class"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <li class="nav-item ">
                            <a class="nav-link  <?php echo isMenuItemActive('data_masakan', $currentPage); ?>" href="<?php echo base_url('admin/data_masakan') ?>">
                                <i class="fas fa-fw fa-database custom-class"></i>
                                <span>Data Masakan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isMenuItemActive('detail_order', $currentPage); ?>" href="<?php echo base_url('admin/detail_order') ?>">
                                <i class="fas fa-fw fa-chart-simple custom-class"></i>
                                <span>Detail Order</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isMenuItemActive('invoice', $currentPage); ?>" href="<?php echo base_url('admin/invoice') ?>">
                                <i class="fas fa-fw fa-file-invoice custom-class"></i>
                                <span>Invoices</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  <?php echo isMenuItemActive('transaksi', $currentPage); ?>" href="<?php echo base_url('admin/transaksi') ?>">
                                <i class="fas fa-fw fa-money-bill-transfer custom-class"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                        <br>
                        <hr class="my-1 mx-3">
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('auth/logout') ?>">
                                <i class="fas fa-fw fa-rocket custom-class"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('registrasi') ?>">
                                <i class="fas fa-fw fa-dragon custom-class"></i>
                                <span>Sign Up</span>
                            </a>
                        </li>
                    </div>
                </div>
            </nav>
        </div>