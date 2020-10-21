<table id="table" class="table table-striped table-bordered" >
	<thead>
		<th>NIM</th>
		<th>Nama</th>
		<th>Nilai</th>
		<th>Action</th>
	</thead>
</table>

<!-- modal -->

<div class="modal fade" id="modal-edit-jur">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Nilai</h4>
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

<script type="text/javascript">
	var tabel=null;
	$(document).ready(function() {
		tabel=$('#table').DataTable({
			"ajax": {
				url : "<?php echo site_url("nilai/getAll/").$id_jadwal ?>",
				type : 'GET'
			},
		});
	});
	function ehe(id){
		$.ajax({
			url: "<?php echo site_url('nilai/edit/') ?>"+id,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
</script>