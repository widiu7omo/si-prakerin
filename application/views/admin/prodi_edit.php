<!DOCTYPE html>
<html>

<!-- Head PHP -->
<!-- Create Auto generate id -->
<?php $this->load->helper('autoid'); ?>
<?php $newId = generate_id('tb_program_studi','id_program_studi') ?>

<?php  $this->load->view('admin/_partials/header.php');?>

<body>
	<!-- Sidenav PHP-->
	<?php $this->load->view('admin/_partials/sidenav.php');?>
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
							<div class="row align-items-center">
								<div class="col-8">
									<h3 class="mb-0">User Management</h3>
								</div>
								<div class="col-4 text-right">
									<a href="<?php echo site_url('prodi') ?>" class="btn btn-sm btn-primary">Back to
										list</a>
								</div>
							</div>
						</div>
						<!-- Card body -->
						<div class="card-body">
							<form action="<?php site_url('prodi/edit') ?>" method="POST">
								<!-- Input groups with icon -->
								<div class="row">
									<div class="col-md-12">
										<?php if ($this->session->flashdata('success')): ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<span class="alert-icon"><i class="ni ni-like-2"></i></span>
											<span
												class="alert-text"><strong>Success! &nbsp;</strong><?php echo $this->session->flashdata('success'); ?></span>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<?php endif; ?>
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-code"></i></span>
												</div>
												<input class="form-control"
													value="<?php echo $prodi->id_program_studi ?>" name="id"
													placeholder="ID Program Studi" readonly type="text">
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i
															class="fas fa-university"></i></span>
												</div>
												<input class="form-control" name="name"
													value="<?php echo $prodi->nama_program_studi ?>"
													placeholder="Nama Program Studi Baru" type="text">
											</div>
										</div>
									</div>
									<div class="col-md-12 text-md-right align-content-end">
										<button type="submit" class="btn btn-success">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer PHP -->
			<?php $this->load->view('admin/_partials/footer.php');?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/js.php');
    ?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
