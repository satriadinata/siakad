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
			<h3 class="card-title">Tambah Mahasiswa</h3>
		</div>
		<div class="card-body">

			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Input Data</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" enctype="multipart/form-data" action="<?php echo site_url('mahasiswa/store') ?>" method="post" >
					<div class="card-body">

						<?php if ($this->session->flashdata('error')!=null):?>
							<div class="alert alert-danger">
								<?php print_r($this->session->flashdata('error')); ?>
							</div>
						<?php endif; ?>

						<div class="form-group">
							<label for="nim">NIM</label>
							<input required="" name="nim" type="number" class="form-control" id="nim" placeholder="NIM" value="<?= old('nim') ;?>">
						</div>

						<div class="form-group">
							<label for="nik_mhs">NIK</label>
							<input required="" name="nik_mhs" type="number" class="form-control" id="nik_mhs" placeholder="NIK" value="<?= old('nik_mhs') ;?>">
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
							<label for="nama_mhs">Nama Lengkap</label>
							<input required="" name="nama_mhs" type="text" class="form-control" id="nama_mhs" placeholder="Nama Lengkap" value="<?= old('nama_mhs') ;?>">
						</div>

						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea required="" name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat"><?= old('alamat') ;?></textarea>
						</div>

						<div class="form-group">
							<label for="telp">No Telpon</label>
							<input required="" name="telp" type="number" class="form-control" id="telp" placeholder="No Telpon" value="<?= old('telp') ;?>">
						</div>

						<div class="form-group">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input required="" name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= old('tempat_lahir') ;?>">
						</div>

						<div class="form-group">
							<label for="tgl_lahir">Tanggal Lahir</label>
							<input required="" name="tgl_lahir" type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?= old('tgl_lahir') ;?>">
						</div>

						<div class="form-group">
							<label for="nik">Agama</label>
							<select name="agama_mhs" class="custom-select" value="<?= old('agama_mhs') ;?>">
								<?php foreach ($agama as $value):?>
									<option value="<?php echo $value ?>" ><?php echo $value; ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label for="kewarganegaraan">Kewarganegaraan</label>
							<input required="" name="kewarganegaraan" type="text" class="form-control" id="kewarganegaraan" placeholder="Kewarganegaraan" value="<?= old('kewarganegaraan') ;?>">
						</div>

						<div class="form-group">
							<label for="nama_ortu">Nama Ortu</label>
							<input required="" name="nama_ortu" type="text" class="form-control" id="nama_ortu" placeholder="Nama Ortu" value="<?= old('nama_ortu') ;?>">
						</div>

						<div class="form-group">
							<label for="alamat_ortu">Alamat Ortu</label>
							<textarea required="" name="alamat_ortu" type="text" class="form-control" id="alamat_ortu" placeholder="Alamat Ortu"><?= old('alamat_ortu') ;?></textarea>
						</div>

						<div class="form-group">
							<label for="telp_ortu">Telp Ortu</label>
							<input required="" name="telp_ortu" type="number" class="form-control" id="telp_ortu" placeholder="Telp Ortu" value="<?= old('telp_ortu') ;?>">
						</div>

						<div class="form-group">
							<label for="foto">Foto Mahasiswa</label>
							<input name="foto" type="file" class="form-control" id="foto" placeholder="Foto Mahasiswa">
						</div>

						<!-- <div class="form-group">
							<label for="foto">Foto Mahasiswa</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" name="foto" class="custom-file-input" id="foto">
									<label class="custom-file-label" for="foto">Choose file</label>
								</div>
							</div>
						</div> -->

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