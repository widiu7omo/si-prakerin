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
							<div class="h4">Daftar Mahasiswa yang siap untuk seminar</div>
						</div>
						<div class="card-body pt-0">
							<div class="table-responsive py-4">
								<table class="table table-flush" id="datatable-mhs-fix">
									<thead class="thead-light">
									<tr role="row">
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Jenis Konsultasi</th>
										<th>Judul yang disetujui</th>
										<th>Aksi</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Jenis Konsultasi</th>
										<th>Judul yang disetujui</th>
										<th>Aksi</th>
									</tr>
									</tfoot>
									<tbody>
									<?php $mahasiswas = $mahasiswas ? $mahasiswas : array() ?>
									<?php foreach ($mahasiswas as $key => $mahasiswa): ?>
									<?php if ($mahasiswa->status_judul == 'setuju'): ?>
										<tr role="row" class="odd">
											<td class="sorting_1"><?php echo $key + 1 ?></td>
											<td><?php echo $mahasiswa->nama_mahasiswa ?></td>
											<td class="<?php echo $mahasiswa->mode === 'online' ? 'text-success' : 'text-danger' ?>"><?php echo $mahasiswa->mode ?></td>
											<td><?php echo $mahasiswa->judul_laporan_mhs ?></td>
											<td>
												<div class="btn-group-sm btn-group d-flex">
													<?php if ($mahasiswa->mode === 'online'): ?>
														<?php
														$where = array('id_dosen_bimbingan_mhs' => $mahasiswa->id_dosen_bimbingan_mhs, 'status' => 'accept');
														$bimbingans = masterdata('tb_konsultasi_bimbingan', $where, 'id_konsultasi_bimbingan', true, 'start ASC'); ?>
														<?php if (count($bimbingans) < 4): ?>
															<button
																class="btn btn-sm btn-secondary"><?php echo count($bimbingans) ?>
																X Konsultasi
															</button>
														<?php endif; ?>
														<button
															type="button" <?php echo count($bimbingans) >= 4 ? 'disabled':null ?>
															class="w-100 btn btn-sm btn-<?php echo count($bimbingans) >= 4 ? 'success' : 'warning' ?>"
															onclick="window.location.href='<?php echo site_url("bimbingan?m=approvesidang&a=acc&id=$mahasiswa->nim") ?>'">
															<?php echo count($bimbingans) >= 4 ? 'Disetujui':'Setuju' ?>
														</button>
													<?php else: ?>
														<?php if (!$mahasiswa->status_seminar): ?>
															<a href="<?php echo site_url("bimbingan?m=view_bimbingan_offline&id=$mahasiswa->lembar_konsultasi") ?>"
															   class="btn btn-sm btn-primary">Lihat Konsultasi</a>
														<?php endif; ?>
														<button <?php echo $mahasiswa->status_seminar ? 'disabled' : null ?>
															class="btn btn-sm btn-success w-100"
															onclick="window.location.href='<?php echo site_url("bimbingan?m=approvesidang&a=acc&id=$mahasiswa->nim") ?>'">
															<?php echo $mahasiswa->status_seminar ? 'Disetujui' : 'Setuju' ?>
														</button>
													<?php endif; ?>
												</div>
											</td>
										</tr>
									<?php endif; ?>
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
