<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo SITE_NAME . ": " . ucfirst($title) ?></title>
    <link rel="icon" href="img/logo/logo_um.png" >
    
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') ?>"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
          rel="stylesheet"/>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?> "></script>

    <link href="<?php echo base_url('js/timepicker/jquery.timepicker.css'); ?>" rel="stylesheet">





</head>

<body id="page-top" class="sidebar-toggled">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar Staff Admin -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
            <div class="sidebar-brand-icon">
                <img src="img/logo/logo_um.png"
                     style="width:50px;height:50px;" alt="Logo UM">
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo SITE_NAME ?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php echo $label == 'Dashboard' ? 'active' : '' ?> ">
            <a class="nav-link" href="<?php echo base_url() ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider"/>

        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php echo $label == 'Penjadwalan' ? 'active' : '' ?> ">
            <a class="nav-link" href="<?php echo base_url('admin/penjadwalan') ?>">
                <i class="fas fa-envelope-open-text"></i>
                <span>Penjadwalan</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php echo $label == 'Penelitian' ? 'active' : '' ?> ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSurat"
               aria-expanded="true"
               aria-controls="collapseTwo">
                <i class="fas fa-mail-bulk"></i>
                <span>Izin Penelitian</span>
            </a>
            <div id="collapseSurat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jenis:</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/penelitian/studi_lapangan') ?> ">Studi
                        Lapangan</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/penelitian/izin_penelitian') ?> ">Penelitian
                        Skripsi</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php echo $label == 'Laporan' ? 'active' : '' ?> ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
               aria-expanded="true"
               aria-controls="collapseTwo">
                <i class="fas fa-book"></i>
                <span>Serah Terima</span>
            </a>
            <div id="collapseLaporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/serahterima/seminar') ?> ">
                        Sempro / Semhas</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/serahterima/skripsi') ?> ">
                        Skripsi / TA</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php echo $label == 'Surat Masuk' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/suratmasuk') ?>">
                <i class="fas fa-envelope-open-text"></i>
                <span>Surat Masuk</span></a>
        </li>

        <li class="nav-item <?php echo $label == 'Ticket' ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTicket"
               aria-expanded="true"
               aria-controls="collapseTwo">
                <i class="fas fa-ticket-alt"></i>
                <span>Cek Ticket Support</span></a>
                <div id="collapseTicket" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php echo $title == 'Buat Ticket Support' ? 'active' : '' ?>" href="<?php echo base_url('ticket/openTicketadm/') ?> ">Buat Ticket</a>
                    <a class="collapse-item <?php echo $title == 'Status Ticket' ? 'active' : '' ?>" href="<?php echo base_url('ticket/statusAdm/') ?> ">Status Ticket</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= $nama ?>
                                </span>
                            <img class="img-profile rounded-circle" src="assets/img/fr-05.jpg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <!--                                <a class="dropdown-item" href="#">-->
                            <!--                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>-->
                            <!--                                    Profile-->
                            <!--                                </a>-->
                            <!--                                <a class="dropdown-item" href="#">-->
                            <!--                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>-->
                            <!--                                    Settings-->
                            <!--                                </a>-->
                            <!--                                <a class="dropdown-item" href="#">-->
                            <!--                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>-->
                            <!--                                    Activity Log-->
                            <!--                                </a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->