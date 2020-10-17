<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Jadwal</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('jadwal/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_jadwal" value="<?php echo $jadwal['id_jadwal'] ?>">

				<div class="form-group">
					<label for="kd_mk">Mata Kuliah</label>
					<select class="custom-select" name="kd_mk" >
						<?php foreach ($makul as $v):?>
							<option <?php if($v->kode_mk==$jadwal['kd_mk']): ?> selected <?php endif ?> value="<?php echo $v->kode_mk ?>" ><?php echo $v->kode_mk.' '.$v->nama_mk ?></option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<label for="kd_dosen">Dosen</label>
					<select class="custom-select" name="kd_dosen" >
						<?php foreach ($dosen as $v):?>
							<option <?php if($v->kd_dosen==$jadwal['kd_dosen']): ?> selected <?php endif ?> value="<?php echo $v->kd_dosen ?>" ><?php echo $v->kd_dosen.' '.$v->nama_dosen ?></option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<label for="hari">Hari</label>
					<select class="custom-select" name="hari" >
						<option <?php if($jadwal['hari']=='senin'): ?> selected <?php endif ?> value="senin" >Senin</option>
						<option <?php if($jadwal['hari']=='selasa'): ?> selected <?php endif ?> value="selasa" >Selasa</option>
						<option <?php if($jadwal['hari']=='rabu'): ?> selected <?php endif ?> value="rabu" >Rabu</option>
						<option <?php if($jadwal['hari']=='kamis'): ?> selected <?php endif ?> value="kamis" >Kamis</option>
						<option <?php if($jadwal['hari']=='jumat'): ?> selected <?php endif ?> value="jumat" >Jum'at</option>
						<option <?php if($jadwal['hari']=='sabtu'): ?> selected <?php endif ?> value="sabtu" >Sabtu</option>
						<option <?php if($jadwal['hari']=='minggu'): ?> selected <?php endif ?> value="minggu" >Minggu</option>
					</select>
				</div>

				<div class="form-group">
					<label for="jam">Jam</label>
					<input value="<?php echo $jadwal['jam'] ?>" class="form-control" type="time" name="jam">
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>