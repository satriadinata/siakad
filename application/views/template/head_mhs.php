<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

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

        <li class="nav-item d-sm-inline-block">
          <a href="<?php echo site_url('mhs/krs/get') ?>" class="nav-link">KRS</a>
        </li>

        <li class="nav-item d-sm-inline-block">
          <a href="<?php echo site_url('mhs/khs/get') ?>" class="nav-link">KHS</a>
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
            <a href="#" class="dropdown-item">
              <i class="fas fa-child mr-2"></i> Profile
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
      </nav>