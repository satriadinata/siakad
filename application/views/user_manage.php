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
		<!-- /.card -->

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">User List</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

				<!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
					<i class="fas fa-times"></i>
				</button> -->
			</div>
		</div>
		<div class="card-body table-responsive">
			<table id="tableJurusan" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Email</th>
						<th>Blokir</th>
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
			"order": [[ 1, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax":
			{
				"url": "<?php echo base_url('user_manage/getAll') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [[10, 50, 100],[ 10, 50, 100]], // Combobox Limit
			"columns": [
				{ "data": "username" }, // Tampilkan nis
				{ "data": "password" }, // Tampilkan nis
				{ "data": "level" }, // Tampilkan nis
				{ "data": "email" },  // Tampilkan nama
				{ "render": function ( data, type, row )
					{ // Tampilkan kolom aksi
						if (row.blokir=='y') {
							var id=row.id;
							var html  = "<button class='btn btn-primary' id='unlock"+id+"' onclick='unlock("+id+")'>Unlock</button>";
						}else{
							var idi=row.id;
							var html  = "<button class='btn btn-warning' id='unlock"+idi+"' onclick='lock("+idi+")'>Lock</button>";
						};
						return html;
					}
				},
				],
			});
	});
</script>
<script type="text/javascript">
	function lock(id){
		$.ajax({
			url:'<?php echo site_url('user_manage/lock') ?>',
			type:'post',
			data:{id:id},
			beforeSend:function(){
				$('#lock'+id).html('Processing <i class="fas fa-sync-alt fa-spin" ></i>');
			},
			success: function(data){
				// console.log(data);
				// alert('Data berhasil di input');
				tabel.ajax.reload();
			}
		});
	}
	function unlock(id){
		$.ajax({
			url:'<?php echo site_url('user_manage/unlock') ?>',
			type:'post',
			data:{id:id},
			beforeSend:function(){
				$('#unlock'+id).html('Processing <i class="fas fa-sync-alt fa-spin" ></i>');
			},
			success: function(data){
				// console.log(data);
				// alert('Data berhasil di input');
				tabel.ajax.reload();
			}
		});
	}
</script>
<?php $this->load->view('template/footer') ?>