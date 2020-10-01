<?php $this->load->view('template/header') ?>
<?php if ($this->session->flashdata('message')!=null):?>
	<div id="toastsContainerTopRight" class="toasts-top-right fixed">
		<div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<strong class="mr-auto">Sukses</strong>
				<small></small>
				<button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="toast-body"><?php echo $this->session->flashdata('message'); ?></div>
		</div>
	</div>
<?php endif ?>
<section class="content">

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Tambah Dosen</h3>
		</div>
		<div class="card-body">

			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Input Data</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" enctype="multipart/form-data" action="<?php echo site_url('dosen/store') ?>" method="post" >
					<div class="card-body">

						<?php if ($this->session->flashdata('error')!=null):?>
							<div class="alert alert-danger">
								<?php print_r($this->session->flashdata('error')); ?>
							</div>
						<?php endif; ?>

						<div class="form-group">
							<label for="kd_dosen">Kode Dosen</label>
							<input required="" name="kd_dosen" type="text" class="form-control" id="kd_dosen" placeholder="Kode Dosen" value="<?= old('kd_dosen') ;?>">
						</div>

						<div class="form-group">
							<label for="nidn">NIDN</label>
							<input required="" name="nidn" type="number" class="form-control" id="nidn" placeholder="NIDN" value="<?= old('nidn') ;?>">
						</div>

						<div class="form-group">
							<label for="nik_dosen">NIK</label>
							<input required="" name="nik_dosen" type="number" class="form-control" id="nik_dosen" placeholder="NIK" value="<?= old('nik_dosen') ;?>">
						</div>

						<div class="form-group">
							<label>Kode Jurusan</label>
							<select name="kd_jurusan" class="custom-select" value="<?= old('kd_jurusan') ;?>">
								<?php foreach ($jurusan as $value):?>
									<option value="<?php echo $value->kd_jurusan ?>" ><?php echo $value->kd_jurusan.' - '.$value->nama_jurusan; ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label for="nama_dosen">Nama Dosen</label>
							<input required="" name="nama_dosen" type="text" class="form-control" id="nama_dosen" placeholder="Nama Lengkap" value="<?= old('nama_dosen') ;?>">
						</div>

						<div class="form-group">
							<label for="telp_dosen">No Telpon</label>
							<input required="" name="telp_dosen" type="number" class="form-control" id="telp_dosen" placeholder="No Telpon" value="<?= old('telp_dosen') ;?>">
						</div>

						<div class="form-group">
							<label for="alamat_dosen">Alamat</label>
							<textarea required="" name="alamat_dosen" type="text" class="form-control" id="alamat_dosen" placeholder="Alamat"><?= old('alamat_dosen') ;?></textarea>
						</div>

						<div class="form-group">
							<label for="foto">Foto Dosen</label>
							<input required="" name="foto" type="file" class="form-control" id="foto" placeholder="Foto Dosen">
						</div>

					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>

		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			
		</div>
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->

</section>
<script></script>
<?php $this->load->view('template/footer') ?>