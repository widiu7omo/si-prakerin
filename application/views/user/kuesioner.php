<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('user/_partials/header.php');?>

<body class="g-sidenav-hidden">
	<!-- Sidenav PHP-->
	<?php $this->load->view('user/_partials/sidenav.php');?>
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
			<div class="row">
				<div class="col-xl-12">
					<!-- Checklist -->
					<div class="card shadow-sm">
						<!-- Card header -->
						<div class="card-header">
							<!-- Title -->
							<h5 class="h3 mb-0">Kuesioner Perusahaan</h5>
						</div>
						<!-- Card body -->
						<div class="card-body p-0">
							<!-- Iframe -->
							<iframe width="100%" height="550px"
								src="https://docs.google.com/forms/d/e/1FAIpQLSf4vBOal86bn20kJL-J9qOOFCCWP_Q_Chb9Qf6F4XQGp-IGYQ/viewform?usp=sf_link"
								frameborder="0">
								<p>Your browser not support, plase update or change your browser</p>
							</iframe>
						</div>
					</div>
				</div>
			</div>
			<!--  -->
			<!-- Footer -->
			<?php $this->load->view('user/_partials/footer'); ?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('user/_partials/modal.php');?>
	<?php $this->load->view('user/_partials/js.php');?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
