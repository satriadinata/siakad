<div class="card-body">
	<!-- /.card-header -->
	<!-- form start -->
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Tahun Ajar</label>
		<div class="col-sm-10">
			<h4><?php echo $krs['ta']; ?></h4>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Jurusan</label>
		<div class="col-sm-10">
			<h4><?php echo $jurusan['nama_jurusan']; ?></h4>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Semester</label>
		<div class="col-sm-10">
			<h4><?php echo $krs['semester']; ?></h4>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Pembimbing Akademik</label>
		<div class="col-sm-10">
			<h4><?php echo $pa['nama_dosen']; ?></h4>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Items</label>
	</div>
	<table class="table table-striped table-bordered" >
		<thead>
			<th>Kode MK</th>
			<th>Mata Kuliah</th>
			<th>SKS</th>
			<th>Dosen</th>
			<th>Hari</th>
			<th>Jam</th>
		</thead>
		<tbody>
			<?php foreach ($item as $value) :?>
				<tr>
					<td><?php echo $value->kd_mk; ?></td>
					<td><?php foreach ($makul as $v) {
						if ($value->kd_mk==$v->kode_mk) {
							echo $v->nama_mk;
						}
					} ?></td>
					<td><?php foreach ($makul as $v) {
						if ($value->kd_mk==$v->kode_mk) {
							echo $v->sks;
						}
					} ?></td>
					<td><?php foreach ($dosen as $v) {
						if ($value->kd_dosen==$v->kd_dosen) {
							echo $v->nama_dosen;
						}
					} ?></td>
					<td><?php echo $value->hari; ?></td>
					<td><?php echo $value->jam; ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>