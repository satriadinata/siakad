<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Input Data</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('jurusan/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_jur" value="<?php echo $jurusan['id_jur'] ?>">

				<div class="form-group">
					<label for="kd_jurusan">Kode Jurusan</label>
					<input required="" value="<?php echo $jurusan['kd_jurusan'] ?>" name="kd_jurusan" type="text" class="form-control" id="kd_jurusan" placeholder="Kode Jurusan">
				</div>

				<div class="form-group">
					<label for="nama_jurusan">Nama Jurusan</label>
					<input required="" value="<?php echo $jurusan['nama_jurusan'] ?>" name="nama_jurusan" type="text" class="form-control" id="nama_jurusan" placeholder="Nama Jurusan">
				</div>

				<div class="form-group">
					<label for="ketua_jurusan">Ketua Jurusan</label>
					<input required="" value="<?php echo $jurusan['ketua_jurusan'] ?>" name="ketua_jurusan" type="text" class="form-control" id="ketua_jurusan" placeholder="Ketua Jurusan">
				</div>

			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>