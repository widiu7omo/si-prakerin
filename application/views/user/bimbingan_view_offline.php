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
							<p class="h4 bold m-0">Konsultasi Mahasiswa Bimbingan PKL Offline</p>
							<a href="<?php echo site_url('bimbingan?m=bimbinganmhs') ?>" class="btn btn-primary btn-sm float-right">Kembali</a>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12">
									<!--@TODO: Alternate if docx file , but must hosting <iframe src="https://docs.google.com/gview?url=http://remote.url.tld/path/to/document.doc&embedded=true"></iframe>-->
									<iframe class="col-md-12 px-0" style="border-radius: 6px" height="500px"
											src="<?php echo base_url('/ViewerJS/#../file_upload/bimbingan/' . $_GET['id']) ?>"
											frameborder="0"></iframe>
								</div>
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
    $(document).ready(function () {

    })

</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
