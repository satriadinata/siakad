<?php $this->load->view('template/head_dsn') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?php echo $title; ?> <?php echo $ta['ta']; ?></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<pre>
		<?php print_r($mk) ?>
	</pre>
	<section class="content">

		<!-- Default box -->
		<div class="row">
			<div class="col-md-6">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Pilih Mata Kuliah</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<?php foreach ($mk as $value) :?>
								<div class="form-group">
									<button class="btn btn-block btn-danger btn-lg" ><?php echo $value->nama_mk; ?></button>
								</div>
							<?php endforeach ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-6">
					<div class="card card-secondary table-responsive ">
						<div class="card-header">
							<h3 class="card-title">Mahasiswa</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<table id="table" class="table table-striped table-bordered" >
									<thead>
										<th>NIM</th>
										<th>Nama</th>
										<th>Semester</th>
										<th>Nilai</th>
									</thead>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>

			</section>
			<!-- /.content -->
		</div>
		<?php $this->load->view('template/script') ?>