<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php $akuns = (isset($akuns) && count($akuns) > 0) ? $akuns : array(); ?>
<?php $levels = masterdata('tb_master_level'); ?>
<?php $this->load->view('admin/_partials/header.php'); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view('admin/_partials/topnav.php');
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view('admin/_partials/breadcrumb.php');
	?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<!-- Table -->
		<div class="row">
			<div class="col">
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<div class="row align-items-center mb-3">
							<div class="col-8">
								<h3 class="mb-0">Akun</h3>
								<p class="text-sm mb-0">
									Kelola akun user dan level dari user.
								</p>
							</div>
							<div class="col-4 text-right">
								<a href="<?php echo site_url('akun') ?>"
								   class="btn btn-sm btn-primary">Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<form action="<?php echo site_url('akun/edit_password') ?>" method="POST">
									<input type="hidden"
										   value="<?php echo isset($akuns[0]->id) ? $akuns[0]->id : null ?>" name="id">
									<div class="form-group">
										<label for="">Username</label>
										<input readonly type="text" class="form-control" name="username"
											   aria-describedby="helpId"
											   placeholder=""
											   value="<?php echo isset($akuns[0]->username) ? $akuns[0]->username : null ?>">
									</div>
									<div class="form-group">
										<label for="">Perbarui Password</label>
										<input type="text" class="form-control" name="newpass" aria-describedby="helpId"
											   placeholder="">
										<small id="helpId" class="form-text text-muted">Tuliskan password baru</small>
									</div>
									<button type="submit" name="submit" class="btn btn-sm btn-primary">Ganti Password</button>
								</form>
							</div>
							<div class="col-6">
								<form action="<?php echo site_url('akun/edit/');
								echo isset($akuns[0]->id) ? $akuns[0]->id : null ?>" method="POST">
									<div class="form-group">
										<label for="">Edit Level</label>
										<input type="hidden" name="username" id="uname"
											   value="<?php echo isset($akuns[0]->username) ? $akuns[0]->username : null ?>">
										<select class="select_2_level" multiple>
											<?php foreach ($levels as $key => $level): ?>
												<?php $is_same = false; ?>
												<?php foreach ($akuns as $akun): ?>
													<?php if ($level->nama_master_level === $akun->level): ?>
														<?php $is_same = true; ?>
														<option selected
																value="<?php echo $level->id_master_level ?>"><?php echo ucfirst($level->nama_master_level) ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
												<?php if (!$is_same): ?>
													<option
														value="<?php echo $level->id_master_level ?>"><?php echo ucfirst($level->nama_master_level) ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										<small id="helpId" class="form-text text-muted">Pilih level (bisa lebih dari
											satu)</small>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php'); ?>
<?php $this->load->view('admin/_partials/js.php'); ?>
<!-- Demo JS - remove this in your project -->
<script>
	$('.select_2_level').select2({
		maximumSelectionLength: 5,
		multiple: true,
		placeholder: "Pilih level (bisa lebih dari satu)"
	}).on('select2:unselect', function ({params}) {
		$.ajax({
			url: "<?php echo site_url('akun/hapus_level') ?>",
			method: "POST",
			dataType: 'json',
			data: {
				submit: true,
				username: $('#uname').val(),
				id_lev: params.data.id
			},
			success: function (res) {
				console.log(res);
			},
			error: function (err) {
				console.log(err)
			}
		})
	}).on('select2:select', function ({params}) {
		$.ajax({
			url: "<?php echo site_url('akun/edit_level') ?>",
			method: "POST",
			dataType: 'json',
			data: {
				submit: true,
				username: $('#uname').val(),
				id_lev: params.data.id
			},
			success: function (res) {
				console.log(res);
			},
			error: function (err) {
				console.log(err)
			}
		})
	})
</script>
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
