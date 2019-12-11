<?php $section = isset($_GET['section']) ? $_GET['section'] : 'today'; ?>
<?php $level = $this->session->userdata('level') ?>
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
			<div class="card">
				<div class="card-header">
					<?php if ($level === 'dosen'): ?>
						<ul class="nav nav-pills nav-stacked">
							<li class="nav-item">
								<a href="<?php echo site_url('sidang?m=penilaian&section=today') ?>"
								   class="nav-link <?php echo !isset($section) ? 'active' : null ?> <?php echo $section == 'today' ? 'active' : null ?>">Uji
									Hari ini</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('sidang?m=penilaian&section=history') ?>"
								   class="nav-link <?php echo $section == 'history' ? 'active' : null ?>">Riwayat
									Menguji</a>
							</li>
						</ul>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<?php switch ($level):
						case 'dosen':
							?>
							<?php if ($section === 'history'): ?>
							<div class="row">
								<div class="col">
									<div class="card"
										 data-step="<?php echo isset($intro) ? $intro[0]['step_intro'] : null ?>"
										 data-intro="<?php echo isset($intro) ? $intro[0]['message_intro'] : null ?>">
										<div class="card-header">
											<!-- Title -->
											<div class="row">
												<div class="col-md-8 col-sm-8">
													<h5 class="h3 mb-0">Berikut daftar mahasiswa yang akan anda uji hari
														ini</h5>
													<small>* Pilih untuk melihat detail</small><br>
												</div>
											</div>
										</div>
										<div class="card-body p-0">
											<div class="list-group list-group-flush">
												<div
													class="h4 bg-secondary p-3 m-0 font-weight-bold text-right d-flex justify-content-between">
													<div>Tanggal</div>
													<div>1 November 2019</div>
												</div>
												<a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
													<div class="d-flex row justify-content-between align-items-center">
														<div class="col col-xs-12">
															<small>Mahasiswa:</small>
															<h5 class="mb-0 h4">Ken Kendrik</h5>
														</div>
														<div class="col col-xs-12">
															<small>Ruangan:</small>
															<h5 class="mb-0">Belum dinilai</h5>
														</div>
														<div class="col col-xs-12">
															<small>Waktu:</small>
															<h5 class="mb-0">Pukul 08:00 - 09:00</h5>
														</div>
														<div class="col col-xs-12">
															<small>Nilai Seminar:</small>
															<h5 class="mb-0">Belum dinilai</h5>
														</div>
														<div class="col col-xs-12">
															<small>Nilai Revisi:</small>
															<h5 class="mb-0">Belum dinilai</h5>
														</div>
														<div class="col col-xs-12">
															<button type="submit" class="m-1 btn btn-sm btn-primary">
																Penilaian Seminar
															</button>
															<button type="submit" class="m-1 btn btn-sm btn-primary">
																Penialian Revisi
															</button>
														</div>
													</div>
												</a>
												<div
													class="h4 bg-secondary p-3 m-0 font-weight-bold text-right d-flex justify-content-between">
													<div>Tanggal</div>
													<div>2 November 2019</div>
												</div>
												<a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
													<div
														class="d-flex justify-content-md-between flex-wrap align-items-center">
														<div>(A1317002) Ken Hendrik</div>
														<div>Ruang Bootstrap</div>
														<div>
															<div>12 November 2019</div>
															<span>Mulai 08:00</span>
															<span>Sampai 09:00</span>
														</div>
														<div>
															<button type="submit" class="btn btn-primary">Beri penilaian
															</button>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
							<?php if ($section === 'today'): ?>
							<div class="h3">Sidang berlangsung</div>
							<div class="row d-flex justify-content-center">
								<?php foreach (array('bg-gradient-primary', 'bg-gradient-warning', 'bg-gradient-default', 'bg-gradient-danger') as $item): ?>
									<div class="col-xs-12 col-md-6 ">
										<div class="card <?php echo $item ?>">
											<!-- Card body -->
											<div class="card-body">
												<div class="row justify-content-between align-items-center">
													<div class="col">
														<i class="ni ni-badge text-white"></i>
														<span class="h6 surtitle text-white">&nbsp; Anda sebagai Penguji 1</span>
													</div>
													<div class="col-auto">
														<span class="badge badge-lg badge-danger">ON-AIR</span>
													</div>
												</div>
												<div class="row mx-0 d-flex justify-content-between align-items-center">
													<div class="my-4">
														<span class="h6 surtitle text-muted">
														  Nama
														</span>
														<div class="h1 text-white">Ken Hendrik</div>
													</div>
													<div>
														<div class="btn btn-secondary">Penilaian</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<span class="h6 surtitle text-muted">Ruangan</span>
														<span class="d-block h3 text-white">Bootstrap</span>
													</div>
													<div class="col">
														<span class="h6 surtitle text-muted">Waktu</span>
														<span class="d-block h3 text-white">08:00 - 09:00</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="h3">Sidang yang akan datang</div>
							<div class="row">
								<?php foreach (array(1, 1, 1, 1, 1, 1, 1) as $item): ?>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="card">
											<!-- Card body -->
											<div class="card-body">
												<div class="row justify-content-between align-items-center">
													<div class="col">
														<i class="ni ni-badge text-primary"></i>
													</div>
													<div class="col-auto">
														<span class="badge badge-lg badge-success">Active</span>
													</div>
												</div>
												<div class="my-4">
												<span class="h6 surtitle text-muted">
												  Nama
												</span>
													<div class="h1">Ken Hendrik</div>
												</div>
												<div class="row">
													<div class="col">
														<span class="h6 surtitle text-muted">Ruangan</span>
														<span class="d-block h3">Bootstrap</span>
													</div>
													<div class="col">
														<span class="h6 surtitle text-muted">Waktu</span>
														<span class="d-block h3">08:00 - 09:00</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
							<?php break ?>
						<?php case 'mahasiswa': ?>
							<div
								class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
								<div class="h1 font-weight-bold">80</div>
							</div>
							<?php break ?>
						<?php endswitch; ?>
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
