<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Data</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('mahasiswa/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_ta" value="<?php echo $mahasiswa['id_ta'] ?>">

				<div class="form-group">
					<label for="nim">NIM</label>
					<input required="" value="<?php echo $mahasiswa['nim'] ?>" name="nim" type="text" class="form-control" id="nim" placeholder="NIM">
				</div>

			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>