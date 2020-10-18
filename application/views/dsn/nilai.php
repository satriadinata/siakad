<?php $this->load->view('template/head_dsn') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?php echo $title; ?> <?php echo $ta['ta']; ?></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->

	<section class="content">

		<!-- Default box -->
		<div class="row">
			<div class="col-md-12" id="wrap-matkul">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Pilih Mata Kuliah</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<?php foreach ($mk as $value) :?>
								<div class="form-group">
									<button id="makul<?php echo $value->id_jadwal ?> " onclick="setSelectedId(<?php echo $value->id_jadwal; ?>)" class="btn btn-block btn-danger btn-lg" ><?php echo $value->nama_mk; ?></button>
								</div>
							<?php endforeach ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-6" id="wrap-mhs">
					<div class="card card-secondary table-responsive ">
						<div class="card-header">
							<h3 id="load" class="card-title">Mahasiswa</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i></button>
								</div>
							</div>
							<div id="mhs" class="card-body">
								
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>

			</section>
			<!-- /.content -->
		</div>
		<script>
			$("#wrap-mhs").hide();
			var selectedId = 0;

			function setSelectedId(id) {
				$("#wrap-matkul").removeClass('col-md-12');
				$("#wrap-matkul").addClass('col-md-6');
				$("#wrap-mhs").show(500);
				selectedId = id;
				change();
			}

			function change(){
				// alert(id);
				$.ajax({
					url: '<?php echo site_url('nilai/getMhs/') ?>'+selectedId,
					type: "get",
					beforeSend:function(){
						$('#load').html('<i class="fas fa-sync-alt fa-spin" ></i>');
					},
					complete: function(){
						$('#load').html('Mahasiswa');
					},
					success: function(response){
						$('#mhs').html(response);
					},
				});
			}

			$(document).on("click", "#btn-nilai", function(){
				let id = $("#id-nilai").val();
				let nilai = $("#input-nilai").val();

				if(nilai == "" || nilai == 0){
					$("#error-nilai").html('Nilai Harus Diisi');
				}else{
					$.ajax({
						url: '<?= site_url("nilai/update"); ?>',
						method: 'POST',
						data: {
							id_nilai: id,
							nilai: nilai
						},
						success: function(d){
							if(d == "ok"){
								$("#modal-edit-jur").modal('hide');
								$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								change();
							}else{
								$("#error-nilai").html(d);	
							}
						},
						error: function(e){
							$("#error-nilai").html('Terjadi Kesalahan');
						}
					});
				}
			});
		</script>
		<?php $this->load->view('template/script') ?>