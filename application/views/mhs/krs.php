<?php $this->load->view('template/style') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>KRS</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Your KRS <?php echo $user['username']; ?></h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?php if ($krs!=null):?>
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
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Nama Mahasiswa</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nim']; ?></h4>
										</div>
									</div>

								</div>
							</div>

							
							<table class="table table-striped" >
								<thead>
									<th>Kode MK</th>
									<th>Mata Kuliah</th>
									<th>Dosen</th>
								</thead>
								<tbody>
									<?php foreach ($item as $value):?>
									<tr>
										<td><?php echo $value->kode_mk; ?></td>
										<td><?php echo $value->kode_mk; ?></td>
										<td><?php echo $value->kode_dosen; ?></td>
									</tr>
									<?php endforeach ?>
								</tbody>

							</table>
							<?php else: ?>
								Tidak Ada Data
							<?php endif ?>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							Footer
						</div>
						<!-- /.card-footer-->
					</div>
					<!-- /.card -->

				</section>
				<!-- /.content -->
			</div>
			<?php $this->load->view('template/script') ?>