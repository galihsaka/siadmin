<!DOCTYPE html>
<html lang="en">

<head>

    <title>Sistem Informasi Administrasi (SIADMIN) | Teknik Elektro - UM</title>
    <link rel="icon" href="http://bakpik.um.ac.id/wp-content/uploads/2016/05/cropped-Logo-UM.png" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="sidebar-brand d-flex align-items-center justify-content-center"
                                     style="padding-bottom: 20px;">
                                    <div class="sidebar-brand-icon">
                                        <img src="img/logo/logo_um.png"
                                             style="width:50px;height:50px;" alt="Logo UM">
                                    </div>
                                    <div class="sidebar-brand-text mx-3">Login SIADMIN</div>
                                </div>

                                <?php
                                if (validation_errors()) {
                                    ?>
                                    <div class="alert alert-danger">
                                        <?php echo validation_errors('<p style="margin:0">', '</p>') ?>
                                    </div>
                                    <?php
                                }
                                if ($this->session->flashdata('fail')) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('fail'); ?>
                                </div>
                                    <?php
                                }
                                ?>

                                <?php echo form_open('login/verify_user') ?>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                               id="inputNoInduk" aria-describedby="emailHelp"
                                               placeholder="Masukkan NIP/NIM" name="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="inputPassword" placeholder="Password" name="password">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login"/>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?> "></script>

</body>

</html>
