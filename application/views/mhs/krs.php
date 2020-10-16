<?php $this->load->view('template/style') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>KRS</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Your KRS <?php echo $user['username']; ?></h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?php if ($krs!=null && $nilai==null ):?>
							<div class="row">
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Tahun Ajar</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['ta']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Semester</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['semester']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Jurusan</label>
										<div class="col-sm-10">
											<?php foreach ($jurusan as $v):?>
												<?php if ($v->id_jur==$krs['id_jurusan']):?>
													<h4><?php echo $v->nama_jurusan; ?></h4>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >PA</label>
										<div class="col-sm-10">
											<h4><?php echo $pa['nama_dosen']; ?></h4>
										</div>
									</div>

								</div>
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Nama Mahasiswa</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nama_mhs']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >NIM</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nim']; ?></h4>
										</div>
									</div>

								</div>
							</div>

							
							<table class="table table-striped table-bordered" >
								<thead>
									<th><input type="checkbox" id="selectAll" name=""></th>
									<th>Kode MK</th>
									<th>Mata Kuliah</th>
									<th>SKS</th>
									<th>Dosen</th>
								</thead>
								<tbody>
									<?php foreach ($item as $value):?>
										<tr>
											<td>
												<input type="checkbox" class="check" value="<?php echo $value->id_item_krs ?>" name="">
											</td>
											<td><?php echo $value->kode_mk; ?></td>
											<td><?php foreach ($makul as $v) {
												if ($v->kode_mk==$value->kode_mk) {
													echo $v->nama_mk;
												}
											} ?></td>
											<td><?php foreach ($makul as $v) {
												if ($v->kode_mk==$value->kode_mk) {
													echo $v->sks;
												}
											} ?></td>
											<td><?php foreach ($dosen as $v) {
												if ($v->id_dosen==$value->id_dosen) {
													echo $v->nama_dosen;
												}
											} ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>

							</table>

						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button id="simpan" onclick="simpan()" class="btn btn-primary ">Simpan</button>
						</div>
						<!-- /.card-footer-->
						<?php elseif ($krs!=null && $nilai!=null): ?>

							<div class="row">
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Tahun Ajar</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['ta']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Semester</label>
										<div class="col-sm-10">
											<h4><?php echo $krs['semester']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Jurusan</label>
										<div class="col-sm-10">
											<?php foreach ($jurusan as $v):?>
												<?php if ($v->id_jur==$krs['id_jurusan']):?>
													<h4><?php echo $v->nama_jurusan; ?></h4>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</div>

								</div>
								<div class="col-sm-6">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >Nama Mahasiswa</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nama_mhs']; ?></h4>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;" >NIM</label>
										<div class="col-sm-10">
											<h4><?php echo $mhs['nim']; ?></h4>
										</div>
									</div>

								</div>
							</div>

							
							<table class="table table-striped table-bordered" >
								<thead>
									<th>Kode MK</th>
									<th>Mata Kuliah</th>
									<th>SKS</th>
									<th>Dosen</th>
								</thead>
								<tbody>
									<?php foreach ($nilai as $value):?>
										<tr>
											<input type="hidden" class="id_nilai" value="<?php echo $value->id_nilai ?>" >
											<td><?php echo $value->kd_mk; ?></td>
											<td><?php foreach ($makul as $v) {
												if ($v->kode_mk==$value->kd_mk) {
													echo $v->nama_mk;
												}
											} ?></td>
											<td><?php foreach ($makul as $v) {
												if ($v->kode_mk==$value->kd_mk) {
													echo $v->sks;
												}
											} ?></td>
											<td><?php foreach ($dosen as $v) {
												if ($v->kd_dosen==$value->kd_dosen) {
													echo $v->nama_dosen;
												}
											} ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>

							</table>

						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button id="batal" onclick="batal()" class="btn btn-danger" >Batal</button>
						</div>

						<?php else: ?>
							Tidak Ada Data
						<?php endif ?>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
				</div>
			</section>
			<!-- /.content -->
		</div>
		<script>
			$('#selectAll').click(function(){
				if (this.checked) {
					$(".check").prop("checked", true);
				}else{
					$(".check").prop("checked", false);
				};
			});
			function simpan(){
				var store=[];
				var i=0;
				$(".check:checked").each(function(){
					store[i]=$(this).val();
					i++;
				});
					// console.log(store);
				$.ajax({
					url: '<?php echo site_url('mhs/krs/simpan') ?>',
					type: "POST",
					data: {
						nim:'<?php echo $mhs['nim']; ?>',
						store
					},
					beforeSend:function(){
						$('#simpan').html('Simpan<i class="fas fa-sync-alt fa-spin" ></i>');
					},
					success: function(response){
						location.reload();
					},
					error:function(data){
        				alert("error occured"); //===Show Error Message====
    				},
				});
			};
			function batal(){
				var store=[];
				var i=0;
				$(".id_nilai").each(function(){
					store[i]=$(this).val();
					i++;
				});
				console.log(store);
				$.ajax({
					url: '<?php echo site_url('mhs/krs/batal') ?>',
					type: "POST",
					data: {
						nim:'<?php echo $mhs['nim']; ?>',
						store
					},
					beforeSend:function(){
						$('#batal').html('Batal<i class="fas fa-sync-alt fa-spin" ></i>');
					},
					success: function(response){
						location.reload();
					},
					error:function(data){
        				alert("error occured"); //===Show Error Message====
    				},
				});
			};
		</script>
		<?php $this->load->view('template/script') ?>