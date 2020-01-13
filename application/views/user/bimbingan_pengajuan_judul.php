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
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header m-0">
							<div class="h4">Daftar Pengajuan Judul Kasus pada tempat magang</div>
						</div>
						<div class="card-body pt-0">
							<div class="table-responsive py-4">
								<table class="table table-flush" id="datatable-mhs-fix">
									<thead class="thead-light">
									<tr role="row">
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Judul</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Judul</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
									</tfoot>
									<tbody>
									<?php $mahasiswas = $mahasiswas ? $mahasiswas : array() ?>
									<?php foreach ($mahasiswas as $key => $mahasiswa): ?>
										<tr role="row" class="odd">
											<td class="sorting_1"><?php echo $key + 1 ?></td>
											<td><?php echo $mahasiswa->nama_mahasiswa ?></td>
											<td class="<?php echo !$mahasiswa->judul_laporan_mhs ? 'text-warning' : null ?>"><?php echo $mahasiswa->judul_laporan_mhs ? $mahasiswa->judul_laporan_mhs : "Belum mengajukan" ?></td>
											<td class="<?php echo !$mahasiswa->status_judul ? "text-warning" : null ?>"><?php echo !$mahasiswa->status_judul ? "Belum di approve" : $mahasiswa->status_judul ?></td>
											<td>
												<div class="btn-group-sm btn-group d-flex">
													<?php if (!$mahasiswa->status_judul): ?>
														<button <?php echo $mahasiswa->judul_laporan_mhs ? "" : "disabled" ?>
															onclick="window.location.href = '<?php echo site_url("bimbingan?m=approvejudul&a=acc&id=$mahasiswa->nim") ?>'"
															class="btn btn-sm btn-success w-100">Setuju
														</button>
														<button <?php echo $mahasiswa->judul_laporan_mhs ? "" : "disabled" ?>
															onclick="window.location.href = '<?php echo site_url("bimbingan?m=approvejudul&a=dec&id=$mahasiswa->nim") ?>'"
															class="btn btn-sm btn-danger w-100">Ajukan Ulang
														</button>
													<?php else: ?>
														<?php if ($mahasiswa->status_judul == 'setuju'): ?>
															<button
																onclick="window.location.href = '<?php echo site_url("bimbingan?m=approvejudul&a=acc&id=$mahasiswa->nim") ?>'"
																class="btn btn-sm btn-success w-100" <?php echo $mahasiswa->status_judul == 'setuju' ? "disabled" : null ?>><?php echo $mahasiswa->status_judul == 'setuju' ? "Disetujui" : "Setuju" ?></button>
														<?php else: ?>
															<button
																onclick="window.location.href = '<?php echo site_url("bimbingan?m=approvejudul&a=dec&id=$mahasiswa->nim") ?>'"
																class="btn btn-sm btn-danger w-100" <?php echo $mahasiswa->status_judul == 'ulang' ? "disabled" : null ?>><?php echo $mahasiswa->status_judul == 'ulang' ? "Pengajuan Ulang" : "Ajukan Ulang" ?></button>
														<?php endif ?>
													<?php endif ?>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
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
	$(document).ready(function () {
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
