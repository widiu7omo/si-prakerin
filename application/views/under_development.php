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
				<div class="card mt-5">
					<!-- Card header -->
					<div class="card-header">
						<h1 class="mb-0 text-center">Page is Under Development</h1>
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
