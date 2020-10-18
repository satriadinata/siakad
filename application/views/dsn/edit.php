<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Nilai</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('nilai/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_nilai" value="<?php echo $nilai['id_nilai'] ?>">

				<div class="form-group">
					<label for="nilai">Nilai</label>
					<input value="<?php echo $nilai['nilai'] ?>" class="form-control" type="number" name="nilai">
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit"  class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>