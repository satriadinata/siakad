<?php $this->load->view('template/header') ?>
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Mahasiswa</span>
        <span class="info-box-number">
          <?php echo $jumlah_mhs; ?>
          <small>Orang</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-graduation-cap"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Dosen</span>
        <span class="info-box-number"><?php echo $jmlh_dosen; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Mata Kuliah</span>
        <span class="info-box-number"><?php echo $jmlh_makul; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-graduation-cap"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tahun Ajar</span>
        <span class="info-box-number"><?php if ($ta!=null) {
          echo $ta['ta'];
        }else{
          echo "None";
        } ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<?php $this->load->view('template/footer') ?>