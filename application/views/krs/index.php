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
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Tambah KRS</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i>
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
				<!-- <form role="form" action="<?php echo site_url('krs/store') ?>" method="post" > -->
					<div class="card-body">
						<input type="hidden" id="jmlhKrs" name="jmlhKrs" value="" >

						<div class="form-group">
							<label for="ta">Tahun Ajar</label>
							<select id="ta" name="ta" class="custom-select" value="<?= old('ta') ;?>">
								<?php foreach ($ta as $value):?>
									<option value="<?php echo $value->id_ta ?>" ><?php echo $value->ta; ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">	
							<label for="semester">Semester</label>
							<input id="semester" required="" name="semester" type="text" class="form-control" id="semester" placeholder="Semester">
						</div>

						<div class="form-group">
							<label for="id_jur">Jurusan</label>
							<select id="id_jur" name="id_jur" class="custom-select" value="<?= old('id_jur') ;?>">
								<?php foreach ($jurusan as $value):?>
									<option value="<?php echo $value->id_jur ?>" ><?php echo $value->nama_jurusan; ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label for="pa">Pembimbing Akademik</label>
							<select id="pa" name="pa" class="custom-select" value="<?= old('pa') ;?>">
								<?php foreach ($dosen as $value):?>
									<option value="<?php echo $value->id_dosen ?>" ><?php echo $value->nama_dosen; ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="form-group">
							<label>Mata Kuliah</label><br>
							<a style="color: white;" class="btn btn-primary" onclick="tambahInput()" >Tambah Makul</a><br><br>
							<table class="table table-bordered table-striped" >
								<thead>
									<th>Kode MK-Nama Makul-SKS</th>
									<th>Dosen Pengampu</th>
									<th>Aksi</th>
								</thead>
								<tbody id="addInput" >
								</tbody>
							</table>
						</div>

					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button onclick="simpan()" class="btn btn-primary">Submit</button>
					</div>
					<!-- </form> -->
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
			url: "<?php echo site_url('jurusan/edit/') ?>"+id,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
	var idName=0;
	function tambahInput(){
		idName++;
		// console.log(idName);
		var html="<tr id='baris"+idName+"' ><td><select id='kode_mk"+idName+"' name='kode_mk-"+idName+"' class='custom-select' value='<?= old('kode_mk') ;?>'><?php foreach ($makul as $value):?><option value='<?php echo $value->kode_mk ?>' ><?php echo $value->kode_mk.'-'.$value->nama_mk.'-'.$value->sks; ?></option><?php endforeach ?></select></td><td><select id='id_dosen"+idName+"' name='id_dosen-"+idName+"' class='custom-select' value='<?= old('dosen') ;?>'><?php foreach ($dosen as $value):?><option value='<?php echo $value->id_dosen ?>' ><?php echo $value->nama_dosen; ?></option><?php endforeach ?></select></td><td><button class='btn btn-danger' onclick='removeList("+idName+")' >Remove</button></td></tr>";
		$("#addInput").append(html);
		$("#jmlhKrs").val(idName);
	}
	function removeList(id){
		idName--;
		$('#baris'+id).remove();
		console.log(idName);
	}
	function simpan(){
		var krs=[];
		for (var i = idName; i > 0; i--) {
			var a=$('#kode_mk'+i).val()+'|'+$('#id_dosen'+i).val();
			krs.push(a);
		};
		var postData={
			jmlhKrs:$('#jmlhKrs').val(),
			ta:$('#ta').val(),
			semester:$('#semester').val(),
			id_jur:$('#id_jur').val(),
			pa:$('#pa').val(),
			krs:krs,
		};
		// console.log(postData);
		$.ajax({
			url:'<?php echo site_url('krs/store') ?>',
			type:'post',
			data:postData,
			success: function(data){
				alert('Data berhasil di input');
			}
		});
	}
</script>
<?php $this->load->view('template/footer') ?>