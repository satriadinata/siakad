<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Nilai</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<div>
			<div class="card-body">
				<input type="hidden" name="id_nilai" value="<?php echo $nilai['id_nilai'] ?>" id="id-nilai">

				<div class="form-group">
					<label for="nilai">Nilai</label>
					<input value="<?php echo $nilai['nilai'] ?>" class="form-control" type="number" name="nilai" id="input-nilai">
					<div class="text-danger" id="error-nilai"></div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button id="btn-nilai" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>