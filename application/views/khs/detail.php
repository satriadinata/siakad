<!-- /.card -->
<div class="form-group">
	<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Nama</label>
	<div class="col-sm-10">
		<h4><?php echo $mhs['nama_mhs']; ?></h4>
	</div>
</div>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Jurusan</label>
	<div class="col-sm-10">
		<h4><?php echo $jurusan['nama_jurusan']; ?></h4>
	</div>
</div>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Angkatan</label>
	<div class="col-sm-10">
		<h4><?php echo $mhs['angkatan']; ?></h4>
	</div>
</div>
<!-- Default box -->
<?php foreach ($collect as $value) :?>
	<?php if ($value[0]!='null'):?>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Semester <?php echo $value['semester']; ?></h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

				<!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
					<i class="fas fa-times"></i>
				</button> -->
			</div>
		</div>
		<div class="card-body">
			<table id="" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Kode Makul</th>
						<th>Nama Makul</th>
						<th>Dosen</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($value[0] as $v) : ?>
						<tr>
							<td><?php echo $v->kd_mk; ?></td>
							<td><?php foreach ($makul as $m) {
								if ($m->kode_mk==$v->kd_mk) {
									echo $m->nama_mk;
								}
							} ?></td>
							<td><?php foreach ($dosen as $d) {
								if ($d->kd_dosen==$v->kd_dosen) {
									echo $d->nama_dosen;
								}
							} ?></td>
							<td><?php echo $v->nilai; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			
		</div>
		<!-- /.card-footer-->
	</div>
	<?php else: ?>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Semester ...</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

				<!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
					<i class="fas fa-times"></i>
				</button> -->
			</div>
		</div>
		<div class="card-body">
			<h2>Tidak ada Data</h2>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			
		</div>
		<!-- /.card-footer-->
	</div>
<?php endif ?>

<?php endforeach ?>
<button type="button" onclick="print(<?php echo $mhs['nim']; ?>)" class="btn btn-warning">Cetak Legger</button>
<!-- /.card -->
<script>
	function print(nim){
		window.location.href='<?php echo site_url('khs/cetakLegger/') ?>'+nim;
	}
</script>