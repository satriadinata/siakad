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
			<h3 class="card-title">Tambah Jurusan</h3>

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
				<form role="form" action="<?php echo site_url('jurusan/tambahJurusan') ?>" method="post" >
					<div class="card-body">

						<div class="form-group">
							<label for="kd_jurusan">Kode Jurusan</label>
							<input required="" name="kd_jurusan" type="text" class="form-control" id="kd_jurusan" placeholder="Kode Jurusan">
						</div>

						<div class="form-group">	
							<label for="nama_jurusan">Nama Jurusan</label>
							<input required="" name="nama_jurusan" type="text" class="form-control" id="nama_jurusan" placeholder="Nama Jurusan">
						</div>

						<div class="form-group">
							<label for="ketua_jurusan">Ketua Jurusan</label>
							<input required="" name="ketua_jurusan" type="text" class="form-control" id="ketua_jurusan" placeholder="Ketua Jurusan">
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
			<h3 class="card-title">Data Jurusan</h3>

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
			<table id="tableJurusan" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Kode Jurusan</th>
						<th>Nama Jurusan</th>
						<th>Ketua Jurusan</th>
						<th>Actions</th>
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

</section>

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
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- endmodal -->


<script>
	var tabel = null;
	$(document).ready(function() {
		tabel = $('#tableJurusan').DataTable({
			"processing": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax":
			{
				"url": "<?php echo base_url('jurusan/getAll') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
			"columns": [
				{ "data": "kd_jurusan" }, // Tampilkan nis
				{ "data": "nama_jurusan" },  // Tampilkan nama
				{ "data": "ketua_jurusan" }, // Tampilkan alamat
				{ "render": function ( data, type, row )
					{ // Tampilkan kolom aksi
						var id=row.id_jur;
						var idi=row.id_jur;
						var html  = "<button class='btn btn-primary' onclick='edit("+idi+")' data-toggle='modal' data-target='#modal-edit-jur'>Edit</button> | <button class='btn btn-danger' onclick=hapusJurusan('"+id+"')>Delete</button>";
						return html;
					}
				},
				],
			});
	});
</script>
<script type="text/javascript">
	function hapusJurusan(a){
		var confirm=window.confirm('Yakin ?');
		if (confirm) {
			window.location.href='<?php echo site_url('jurusan/delete/') ?>'+a;
		};
	}
	function edit(id){
		$.ajax({
			url: "<?php echo site_url('jurusan/getEdit/') ?>"+id,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
</script>
<?php $this->load->view('template/footer') ?>