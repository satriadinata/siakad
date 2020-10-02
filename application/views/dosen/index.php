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
			<h3 class="card-title">Tambah Dosen</h3>

			<div class="card-tools">
				<a href="<?php echo site_url('dosen/create') ?>" class="btn btn-primary">
					<i class="fas fa-plus"></i>
				</a>
			</div>
		</div>
		<div class="card-footer">
			
		</div>
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Data Dosen</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<table id="tableDosen" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>KD Dosen</th>
						<th>NIDN</th>
						<th>KD Jurusan</th>
						<th>Nama</th>
						<th>Foto</th>
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

	<div class="modal fade" id="modal-edit-mhs">
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
		tabel = $('#tableDosen').DataTable({
			"processing": true,
			"serverSide": true,
			"ordering": true,
			"order": [[ 0, 'asc' ]],
			"ajax":
			{
				"url": "<?php echo site_url('dosen/getAll') ?>",
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
			"columns": [
			{"render":function(data,type,row){
				return no++
			}},
			{ "data": "kd_dosen" },
			{ "data": "nidn" },
			{ "render": function(data, type, row){
				var b=row.kd_jurusan+' - '+row.nama_jurusan;
				return b;
			} },
			{ "data": "nama_dosen" },
			{ "render": function ( data, type, row )
			{
				var html  = "<img src='<?= site_url('uploads');?>/"+row.foto_dosen+"' width='50'/>";
				return html;
			}
		},
		{ "render": function ( data, type, row )
		{
			var id=row.id_dosen;
			var html  = "<a class='btn btn-primary' href='<?= site_url('dosen/edit') ;?>/"+id+"'>Edit</a> | <button class='btn btn-danger' onclick=hapusDosen('"+id+"')>Delete</button>";
			return html;
		}
	},
	],
});
	});
	function hapusDosen(id){
		var confirm=window.confirm('Yakin ?');
		if (confirm) {
			window.location.href='<?php echo site_url('dosen/delete/') ?>'+id;
		}
	}
	function edit(id){
		$.ajax({
			url: "<?php echo site_url('dosen/edit/') ?>"+id,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
</script>
<?php $this->load->view('template/footer') ?>