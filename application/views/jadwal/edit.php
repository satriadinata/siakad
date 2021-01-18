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
				<input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:j') ?>">

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
						<option <?php if($jadwal['hari']=='Senin'): ?> selected <?php endif ?> value="Senin" >Senin</option>
						<option <?php if($jadwal['hari']=='Selasa'): ?> selected <?php endif ?> value="Selasa" >Selasa</option>
						<option <?php if($jadwal['hari']=='Rabu'): ?> selected <?php endif ?> value="Rabu" >Rabu</option>
						<option <?php if($jadwal['hari']=='Kamis'): ?> selected <?php endif ?> value="Kamis" >Kamis</option>
						<option <?php if($jadwal['hari']=="Jum'at"): ?> selected <?php endif ?> value="Jum'at" >Jum'at</option>
						<option <?php if($jadwal['hari']=='Sabtu'): ?> selected <?php endif ?> value="Sabtu" >Sabtu</option>
						<option <?php if($jadwal['hari']=='Minggu'): ?> selected <?php endif ?> value="Minggu" >Minggu</option>
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