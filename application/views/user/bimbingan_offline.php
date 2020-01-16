<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view('user/_partials/header.php'); ?>

<body class="g-sidenav-hidden">
<!-- Sidenav PHP-->
<?php $this->load->view('user/_partials/sidenav.php'); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view('user/_partials/topnav.php');
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view('user/_partials/breadcrumb.php'); ?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-pills nav-fill">
								<li class="nav-item ">
									<a class="nav-link " href="<?php echo site_url('bimbingan?m=daftar_bimbingan') ?>">Semua
										Mahasiswa Bimbingan</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=bimbingan_online') ?>">Bimbingan
										Online</a>
								</li>
								<li class="nav-item">
									<a class="nav-link active"
									   href="<?php echo site_url('bimbingan?m=bimbingan_offline') ?>">Bimbingan
										Offline</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=belum_bimbingan') ?>">Belum
										Bimbingan</a>
								</li>
							</ul>

						</div>
						<div class="card-body">
							<p class="h4 bold m-0 mb-4">Konsultasi Mahasiswa Bimbingan PKL Offline</p>
							<div class="row">
								<?php $bimbingan_offline = $bimbingan_offline ? $bimbingan_offline : array();
								foreach ($bimbingan_offline as $offline): ?>
									<div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
										<div class="card">
											<!-- Card body -->
											<div class="card-body">

												<div class="row align-items-start">
													<div class="col-auto">
														<!-- Avatar -->
														<a href="#" class="avatar avatar-xl rounded-circle">
															<img alt="Image placeholder"
																 src="https://i.pravatar.cc/300">
														</a>
													</div>
													<div class="col ml--2">
														<h4 class="mb-0">
															<a href="#!"><?php echo $offline->nama_mahasiswa ?></a>
														</h4>
													</div>
													<div class="col-auto">
														<a href='<?php echo site_url("bimbingan?m=view_bimbingan_offline&id=$offline->lembar_konsultasi") ?>'
														   class="btn btn-sm btn-primary">Lihat </a>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/js.php'); ?>
<script>
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
