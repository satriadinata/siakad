<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Data</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('matkul/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_mk" value="<?php echo $makul['id_mk'] ?>">

				<div class="form-group">
					<label for="kode_mk">Kode Mata Kuliah</label>
					<input required="" value="<?php echo $makul['kode_mk'] ?>" name="kode_mk" type="text" class="form-control" id="kode_mk" placeholder="Kode Mata Kuliah">
				</div>

				<div class="form-group">
					<label for="nama_mk">Nama</label>
					<input required="" value="<?php echo $makul['nama_mk'] ?>" name="nama_mk" type="text" class="form-control" id="nama_mk" placeholder="Nama Mata Kuliah">
				</div>

				<div class="form-group">
					<label for="sks">SKS</label>
					<input required="" value="<?php echo $makul['sks'] ?>" name="sks" type="text" class="form-control" id="sks" placeholder="SKS">
				</div>

				<div class="form-group">
					<label for="semester">Semester</label>
					<input required="" value="<?php echo $makul['semester'] ?>" name="semester" type="text" class="form-control" id="semester" placeholder="semester">
				</div>

				<div class="form-group">
					<label>Kode Jurusan</label>
					<select name="kd_jurusan" class="custom-select">
						<?php foreach ($jurusan as $value):?>
							<option <?php if ($value->kd_jurusan==$makul['kd_jurusan']): ?>
								selected
							<?php endif ?> value="<?php echo $value->kd_jurusan ?>" ><?php echo $value->kd_jurusan.' - '.$value->nama_jurusan; ?></option>
						<?php endforeach ?>
					</select>
				</div>

			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>