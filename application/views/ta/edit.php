<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Data</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('ta/update') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_ta" value="<?php echo $ta['id_ta'] ?>">

				<div class="form-group">
					<label for="ta">Tahun Ajar</label>
					<input required="" value="<?php echo $ta['ta'] ?>" name="ta" type="text" class="form-control" id="ta" placeholder="Tahun Ajar">
				</div>

			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>