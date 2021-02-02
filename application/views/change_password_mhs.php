<?php $this->load->view('template/head_mhs') ?>
<div class="content-wrapper" style="min-height: 1365.2px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Change Password</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Change Password</h3>
			</div>
			<?php if ($this->session->flashdata('error')!=null):?>
				<div class="alert alert-danger">
					<?php print_r($this->session->flashdata('error')); ?>
				</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('message')!=null):?>
				<div class="alert alert-success">
					<?php print_r($this->session->flashdata('message')); ?>
				</div>
			<?php endif ?>
			<!-- /.card-header -->
			<!-- form start -->
			<form method="post" action="<?php echo site_url('change_pass/changePass') ?>" >
				<div class="card-body">
					<div class="form-group">
						<label for="text">Password Lama</label>
						<input type="text" name="password_lama" class="form-control" id="text" placeholder="Password Lama">
					</div>

					<div class="form-group">
						<label for="exampleInputPassword1">Password Baru</label>
						<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>

					<div class="form-group">
						<label for="exampleInputPassword1">Konfirmasi Password Baru</label>
						<input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<?php $this->load->view('template/script') ?>