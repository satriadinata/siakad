<?php $this->load->view('template/header') ?>
<div <?php if ($this->session->flashdata('message')!=null):?> style="display: block;" <?php else: ?> style="display: none;" <?php endif ?>  id="toastsContainerTopRight" class="toasts-top-right fixed">
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
						var html  = "<a href=''>EDIT</a> | <button class='btn btn-danger' onclick=hapusJurusan('"+id+"')>Delete</button>";
						return html;
					}
				},
				],
			});
	});
</script>
<script type="text/javascript">
	function hapusJurusan(a){
		console.log(a);
	}
</script>
<?php $this->load->view('template/footer') ?>