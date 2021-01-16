<?php $this->load->view('template/head_mhs') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>KHS</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">KHS - <?php echo $mhs['nim'].' - '.$mhs['nama_mhs']; ?></h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?php if ($nilai!=null): ?>

							<div class="row">
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Tahun Ajar</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['ta']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Semester</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['semester']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Jurusan</label>
										<div class="col-sm-10">
											<?php foreach ($jurusan as $v):?>
												<?php if ($v->id_jur==$krs['id_jurusan']):?>
													<h4><?php echo $v->nama_jurusan; ?></h4>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</div>

								</div>
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Nama Mahasiswa</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nama_mhs']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >NIM</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nim']; ?></h4>
										</div>
									</div>

								</div>
							</div>

							
							<table class="table table-striped table-bordered" >
								<thead>
									<th>Kode MK</th>
									<th>Mata Kuliah</th>
									<th>SKS</th>
									<th>Dosen</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>Nilai</th>
								</thead>
								<tbody>
									<?php foreach ($nilai as $value):?>
										<tr>
											<input type="hidden" class="id_nilai" value="<?php echo $value->id_nilai ?>" >
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													echo $k->kd_mk;
												}
											} ?></td>
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													foreach ($makul as $v) {
														if ($k->kd_mk==$v->kode_mk) {
															echo $v->nama_mk;
														}
													}
												}
											} ?></td>
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													foreach ($makul as $v) {
														if ($k->kd_mk==$v->kode_mk) {
															echo $v->sks;
														}
													}
												}
											} ?></td>
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													foreach ($pa as $v) {
														if ($k->kd_dosen==$v->kd_dosen) {
															echo $v->nama_dosen;
														}
													}
												}
											} ?></td>
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													echo $k->hari;
												}
											} ?></td>
											<td><?php foreach ($jadwal as $k) {
												if ($value->id_jadwal==$k->id_jadwal) {
													echo $k->jam;
												}
											} ?></td>
											<td><?php echo $value->nilai; ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>

							</table>

						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button id="batal" onclick="cetak()" class="btn btn-warning" >Cetak</button>
						</div>

						<?php else: ?>
							Tidak Ada Data
						<?php endif ?>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
				</div>
			</section>
			<!-- /.content -->
		</div>
		<script>
			function cetak(){
				window.location.href='<?php echo site_url('mhs/khs/print/').$smster ?>';
			}
		</script>
		<?php $this->load->view('template/script') ?>