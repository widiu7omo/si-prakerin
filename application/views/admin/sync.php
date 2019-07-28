<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<?php $currentTahunAkademik = getCurrentTahun()?>

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
		<div class="row">

		</div>
		<!-- Table -->
		<div class="row">
			<div class="col-md-12 col-lg-md-12 col-sm-12 col-xs-12">
				<?php if ($this->session->flashdata('status')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<span class="alert-icon"><i class="ni ni-like-2"></i></span>
						<span class="alert-text"><strong>Success!
								&nbsp;</strong><?php echo $this->session->flashdata('status')->message; ?></span><br>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>
				<div class="card">
					<div class="card-header">
						<h3>Sinkronasi data pegawai</h3>
						<a href="<?php echo site_url('sync?do=true')?>" class="btn btn-primary">Sync</a>
					</div>
					<div class="card-body">
						<h3>Terakhir di sinkronkan pada </h3>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php');?>
<!-- custom script -->
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
