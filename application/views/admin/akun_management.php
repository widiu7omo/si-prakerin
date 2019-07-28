<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');
$pegawais = isset($pegawais)?$pegawais:array();
$mahasiswas = isset($mahasiswas)?$mahasiswas:array();
$akuns = array_merge($pegawais,$mahasiswas);

?>

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
								<h3 class="mb-0">Akun</h3>
								<p class="text-sm mb-0">
									Kelola akun user dan level dari user.
								</p>
							</div>
							<div class="col-4 text-right">
								<a href="<?php echo site_url('prodi/create') ?>"
								   class="btn btn-sm btn-primary">Kelola Akun</a>
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
