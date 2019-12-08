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
			<div class="row" id="row-calendar">
				<div class="col">
					<div class="card card-calendar"
						 data-step="<?php echo isset($intro) ? $intro[0]['step_intro'] : null ?>"
						 data-intro="<?php echo isset($intro) ? $intro[0]['message_intro'] : null ?>">
						<div class="card-header">
							<!-- Title -->
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h5 class="h3 mb-0">Berikut daftar mahasiswa yang akan anda uji hari ini</h5>
									<small>* Pilih untuk melihat detail</small><br>
								</div>
							</div>
						</div>
						<div class="card-body p-0">
							<ul class="list-group">
								<li class="list-group-item">
									<div class="d-flex justify-content-between align-items-center">
										<div>(NIM)Mahasiswa</div>
										<div>Ruangan</div>
										<div>
											<div>12 November 2019</div>
											<span>Mulai 08:00</span>
											<span>Sampai 09:00</span>
										</div>
										<div><button type="submit" class="btn btn-primary">Beri penilaian</button></div>
									</div>
								</li>
								<li class="list-group-item">
									<div class="d-flex justify-content-md-between flex-wrap align-items-center">
										<div>(NIM)Mahasiswa</div>
										<div>Ruangan</div>
										<div>
											<div>12 November 2019</div>
											<span>Mulai 08:00</span>
											<span>Sampai 09:00</span>
										</div>
										<div><button type="submit" class="btn btn-primary">Beri penilaian</button></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>

	</div>
	<?php $this->load->view('user/_partials/modal_view_event.php') ?>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/js.php'); ?>

<script>
	$(document).ready(function () {
		let bimbinganMode = '';
		if (!localStorage.getItem('bimbingan_konsultasi')) {
			introJs().start().oncomplete(function () {
				localStorage.setItem('bimbingan_konsultasi', 'yes');
			}).onexit(function () {
				localStorage.setItem('bimbingan_konsultasi', 'yes');
			})
		}
	});

</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
