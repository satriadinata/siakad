<table id="tableCari" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>NIM</th>
			<th>Nama</th>
			<th>Jurusan</th>
			<th>Semester</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
</table>
<script>
	tableCari=$('#tableCari').DataTable({
		"ajax": {
			url : "<?php echo site_url("khs/getCustom/").$angkatan.'/'.$jurusan ?>",
			type : 'get',
		},
	});
</script>