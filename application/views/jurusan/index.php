<?php $this->load->view('template/header') ?>

<section class="content">

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
			Footer
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
						var html  = "<a href=''>EDIT</a> | <a href=''>DELETE</a>"
						return html
					}
				},
			],
		});
	});
</script>

<?php $this->load->view('template/footer') ?>