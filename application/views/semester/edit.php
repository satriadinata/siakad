<div class="card-body">

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Semester</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" action="<?php echo site_url('semester/det') ?>" method="post" >
			<div class="card-body">
				<input type="hidden" name="id_mhs" value="<?php echo $semester['id_mhs'] ?>">

				<div class="form-group">
					<label for="semester">Semester</label>
					<input required="" value="<?php echo $semester['semester'] ?>" name="semester" type="number" class="form-control" id="semester" placeholder="Kode Mata Kuliah">
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>