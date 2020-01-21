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
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="mb-0">Verifikasi Pendaftaran Seminar</h3>
								<p class="text-sm mb-0">
									Proses pengecekan berkas mahasiswa yang di upload, 2 hari sebelum seminar dilaksanakan
								</p>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div id="accordianId" role="tablist" aria-multiselectable="true">
									<div class="card">
										<div class="card-header" role="tab" id="section1HeaderId">
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordianId"
												   href="#section1ContentId" aria-expanded="true"
												   aria-controls="section1ContentId">
													Section 1
												</a>
											</h5>
										</div>
										<div id="section1ContentId" class="collapse in" role="tabpanel"
											 aria-labelledby="section1HeaderId">
											<div class="card-body">
												Section 1 content
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="section2HeaderId">
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordianId"
												   href="#section2ContentId" aria-expanded="true"
												   aria-controls="section2ContentId">
													Section 2
												</a>
											</h5>
										</div>
										<div id="section2ContentId" class="collapse in" role="tabpanel"
											 aria-labelledby="section2HeaderId">
											<div class="card-body">
												Section 2 content
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php');?>
<?php $this->load->view('admin/_partials/js.php');?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
