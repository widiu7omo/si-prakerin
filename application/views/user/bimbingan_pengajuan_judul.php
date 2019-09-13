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
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-10 col-sm-12">
					<div class="card">
						<div class="card-header m-0">
							<div class="h4">Pengajuan Judul Kasus pada tempat magang</div>
						</div>
						<div class="card-body pt-0">
							<ul class="list-group">
								<li class="list-group-item list-group-item-primary"><span>Jumlah konsultasi saat ini</span><span class="float-right"><b>6</b></span></li>
								<li class="list-group-item list-group-item-primary"><span>Sudah memiliki judul</span> checked</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>

	</div>
	<?php $this->load->view('user/_partials/modal_add_event.php') ?>
	<?php $this->load->view('user/_partials/modal_edit_event.php') ?>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/js.php'); ?>
<script src="<?php echo base_url('aset/vendor/fullcalendar/locale-all.js') ?>"></script>

<script>
    $(document).ready(function(){
        if (!localStorage.getItem('bimbingan_pengajuan')) {
            introJs().start().oncomplete(function () {
                localStorage.setItem('bimbingan_pengajuan', 'yes');
            }).onexit(function () {
                localStorage.setItem('bimbingan_pengajuan', 'yes');
            })
        }
    })
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
