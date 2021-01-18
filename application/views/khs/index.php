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
			<h3 class="card-title">Cari KHS</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-primary" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">

			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Input Data</h3>
				</div>

				<div class="card-body">

					<div class="form-group">
						<label for="angkatan">Angkatan</label>
						<select id="angkatan" name="ta" class="custom-select" value="<?= old('ta') ;?>">
							<?php foreach ($ta as $value):?>
								<option value="<?php echo $value->id_ta ?>" ><?php echo $value->ta; ?></option>
							<?php endforeach ?>
						</select>
					</div>


					<div class="form-group">
						<label for="jurusan">Jurusan</label>
						<select id="jurusan" name="id_jur" class="custom-select" value="<?= old('id_jur') ;?>">
							<?php foreach ($jurusan as $value):?>
								<option value="<?php echo $value->id_jur ?>" ><?php echo $value->nama_jurusan; ?></option>
							<?php endforeach ?>
						</select>
					</div>

				</div>
				<!-- /.card-body -->

				<div class="card-footer">
					<button id="cari" onclick="cari()" class="btn btn-primary">Cari</button>
				</div>
				<!-- </form> -->
			</div>

			<div id='hasilCari' class="card-body">
				
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
			<h3 class="card-title">Cari KHS dengan Satu Spesifik Kategori</h3>

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
			<table id="tabelMhs" class="table table-bordered table-striped">
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail KRS</h4>
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
	var tabel=null;
	$(document).ready(function() {
		tabel=$('#tabelMhs').DataTable({
			"ajax": {
				url : "<?php echo site_url("khs/getAll")?>",
				type : 'GET'
			},
		});
	});
	function detail(nim){
		$.ajax({
			url: "<?php echo site_url('khs/detail/') ?>"+nim,
			success: function(result){
				$("#modalData").html(result);
			}
		});
	}
	function cari(){
		let data={
			angkatan:$('#angkatan').val(),
			jurusan:$('#jurusan').val(),
		};
		$.ajax({
			url:'<?php echo site_url('khs/cari') ?>',
			type:'post',
			data:data,
			beforeSend:function(){
				$('#cari').html('Processing <i class="fas fa-sync-alt fa-spin" ></i>');
			},
			success: function(data){
				$('#cari').html('Simpan');
				$('#hasilCari').html(data);
			}
		})
	}
</script>
<?php $this->load->view('template/footer') ?>