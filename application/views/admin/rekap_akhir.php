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
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
	</div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php');?>
<?php $this->load->view('admin/_partials/js.php');?>
<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
