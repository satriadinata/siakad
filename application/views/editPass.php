<div class="card-body">
	<form role="form" action="<?php echo site_url('user_manage/det') ?>" method="post" >
		<div class="card-body">
			<input type="hidden" name="id" value="<?php echo $pass['id'] ?>">

			<div class="form-group">
				<label for="password">Password</label>
				<input required="" value="<?php echo $pass['password'] ?>" name="password" type="text" class="form-control" id="password" placeholder="Password">
			</div>
		</div>
		<!-- /.card-body -->

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
</div>