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
	<div class="card collapsed-card">
		<div class="card-header">
			<h3 class="card-title">Tambah Jadwal</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-primary" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-plus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">

			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Input Data</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="<?php echo site_url('jadwal/store') ?>" method="post" >
					<div class="card-body">
						<?php if ($this->session->flashdata('error')!=null):?>
							<div class="alert alert-danger">
								<?php print_r($this->session->flashdata('error')); ?>
							</div>
						<?php endif; ?>

						<div class="form-group">
							<label for="kd_mk">Mata Kuliah</label>
							<select class="custom-select" name="kd_mk" >
								<?php foreach ($makul as $v):?>
									<option value="<?php echo $v->kode_mk ?>" ><?php echo $v->kode_mk.' '.$v->nama_mk.' - Semester '.$v->semester;foreach ($jurusan as $k) {
										if ($v->kd_jurusan==$k->kd_jurusan) {
											echo ' - '.$k->nama_jurusan;
										}
									} ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label for="kd_dosen">Dosen</label>
							<select class="custom-select" name="kd_dosen" >
								<?php foreach ($dosen as $v):?>
									<option value="<?php echo $v->kd_dosen ?>" ><?php echo $v->kd_dosen.' '.$v->nama_dosen ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label for="hari">Hari</label>
							<select class="custom-select" name="hari" >
								<option value="Senin" >Senin</option>
								<option value="Selasa" >Selasa</option>
								<option value="Rabu" >Rabu</option>
								<option value="Kamis" >Kamis</option>
								<option value="Jum'at" >Jum'at</option>
								<option value="Sabtu" >Sabtu</option>
								<option value="Minggu" >Minggu</option>
							</select>
						</div>

						<div class="form-group">
							<label for="jam">Jam</label>
							<input class="form-control" type="time" name="jam">
						</div>

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

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Data Jadwal</h3>

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
			<table id="tableTa" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>TA</th>
						<th>Kode Mata Kuliah</th>
						<th>Mata Kuliah</th>
						<th>Semester</th>
						<th>Jurusan</th>
						<th>Dosen</th>
						<th>Hari</th>
						<th>Jam</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			
		</div>
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->
	<!-- modal -->

	<div class="modal fade" id="modal-edit-jur">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalData">
					<!-- <p>One fine body&hellip;</p> -->
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- endmodal -->

</section>
<script>
	var tabel = null;
	$(document).ready(function() {
		var no=1;
		tabel = $('#tableTa').DataTable({
			"processing": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax":
			{
				"url": "<?php echo site_url('jadwal/getAll') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [[10, 50, 100],[ 10, 50, 100]], // Combobox Limit
			"columns": [
				{ "data": "ta" }, // Tampilkan alamat
				{ "data": "kd_mk" }, // Tampilkan alamat
				{ "data": "nama_mk" }, // Tampilkan alamat
				{ "data": "semester" }, // Tampilkan alamat
				{ "data": "nama_jurusan" }, // Tampilkan alamat
				{ "data": "nama_dosen" }, // Tampilkan alamat
				{ "data": "hari" }, // Tampilkan alamat
				{ "data": "jam" }, // Tampilkan alamat
				{ "render": function ( data, type, row )
					{ // Tampilkan kolom aksi
						var id=row.id_jadwal;
						var idi=row.id_jadwal;
						var html  = "<button class='btn btn-primary' onclick='edit("+idi+")' data-toggle='modal' data-target='#modal-edit-jur'>Edit</button> | <button class='btn btn-danger' onclick=hapusTa('"+id+"')>Delete</button>";
						return html;
					}
				},
				],
			});
	});
	function hapusTa(id){
		var confirm=window.confirm('Yakin? Penghapusan jadwal akan berpengaruh pada KRS, KHS untuk arsip');
		if (confirm) {
			window.location.href='<?php echo site_url('jadwal/delete/') ?>'+id;
		}
	};
	function edit(id){
		$.ajax({
			url: "<?php echo site_url('jadwal/edit/') ?>"+id,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
</script>
<?php $this->load->view('template/footer') ?>