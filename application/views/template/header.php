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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

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
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
          class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SIAKAD</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url() ?>uploads/default/male.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $user['username']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?php echo site_url('home') ?>" class="nav-link">
              <i class="fas fa-tachometer-alt mr-2"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php echo ($this->uri->segment(1)=="mahasiswa") ? 'menu-open' : '' ;?>">
            <a href="#" class="nav-link <?php echo ($this->uri->segment(1)=="mahasiswa") ? 'active' : '' ;?>">
              <i class="fas fa-users mr-2"></i>
              <p>
                Mahasiswa
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('mahasiswa') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="mahasiswa" && $this->uri->segment(2) != 'create') ? 'active' : '' ;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Mahasiswa</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('mahasiswa/create') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="mahasiswa" && $this->uri->segment(2) == 'create') ? 'active' : '' ;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Mahasiswa</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo ($this->uri->segment(1)=="dosen") ? 'menu-open' : '' ;?>">
            <a href="#" class="nav-link <?php echo ($this->uri->segment(1)=="dosen") ? 'active' : '' ;?>">
              <i class="fas fa-user-graduate mr-2"></i>
              <p>
                Dosen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('dosen') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="dosen" && $this->uri->segment(2) != 'create') ? 'active' : '' ;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Dosen</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('dosen/create') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="dosen" && $this->uri->segment(2) == 'create') ? 'active' : '' ;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Dosen</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('jurusan') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="jurusan") ? 'active' : '' ;?>">
              <i class="fas fa-rainbow mr-2"></i>
              <p>
                Jurusan
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('matkul') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="matkul") ? 'active' : '' ;?>">
              <i class="fas fa-book mr-2"></i>
              <p>
                Mata Kuliah
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('ta') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="ta") ? 'active' : '' ;?>">
              <i class="fas fa-vote-yea mr-2"></i>
              <p>
                Tahun Ajaran
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('semester') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="semester") ? 'active' : '' ;?>">
              <i class="fas fa-vote-yea mr-2"></i>
              <p>
                Semester
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('krs') ?>" class="nav-link <?php echo ($this->uri->segment(1)=="krs") ? 'active' : '' ;?>">
              <i class="fas fa-vote-yea mr-2"></i>
              <p>
                KRS
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?php echo $title; ?> </h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div> /.col --> 
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->