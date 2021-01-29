<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?php echo base_url('assets/logo.jpg') ?>" type="image/x-icon">
  

  <title>Siakad</title>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href=" <?php echo base_url() ?>assets/DataTables/datatables.min.css"/>

  <script type="text/javascript" src=" <?php echo base_url() ?>assets/DataTables/datatables.min.js"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="sidebar-collapse" >
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-sm-inline-block">
          <a href="<?php echo site_url('home') ?>" class="nav-link">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Input Nilai</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
            <?php foreach ($menu as $value):?>
              <li><a href="<?php echo site_url('nilai/semester/').$value->semester ?>" class="dropdown-item">Semester <?php echo $value->semester; ?></a></li>
            <?php endforeach ?>
          </ul>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bars"></i>
            <span class="badge badge-warning navbar-badge">me</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
            <div class="dropdown-divider"></div>
            <a href="<?= site_url('change_pass/changePassword') ?>" class="dropdown-item">
              <i class="fas fa-child mr-2"></i> Change Password
              <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('auth/logout') ?>" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i> Logout
              <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
          </div>
        </li>
      </ul>
    </nav>