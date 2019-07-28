<!DOCTYPE html>
<html>

<!-- Head PHP -->
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
							<h3 class="mb-0">Input groups</h3>
						</div>
						<!-- Card body -->
						<div class="card-body">
							<form>
								<!-- Input groups with icon -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input class="form-control" placeholder="Your name" type="text">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i
															class="fas fa-envelope"></i></span>
												</div>
												<input class="form-control" placeholder="Email address" type="email">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<input class="form-control" placeholder="Location" type="text">
												<div class="input-group-append">
													<span class="input-group-text"><i
															class="fas fa-map-marker"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<input class="form-control" placeholder="Password" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-eye"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Input groups with icon -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i
															class="fas fa-credit-card"></i></span>
												</div>
												<input class="form-control" placeholder="Payment method" type="text">
												<div class="input-group-append">
													<span class="input-group-text"><small
															class="font-weight-bold">USD</small></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text"><i
															class="fas fa-globe-americas"></i></span>
												</div>
												<input class="form-control" placeholder="Phone number" type="text">
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-phone"></i></span>
												</div>
											</div>
										</div>
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
