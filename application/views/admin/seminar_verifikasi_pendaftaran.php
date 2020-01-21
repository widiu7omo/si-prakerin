<!DOCTYPE html>
<html>
<?php $tanggal_seminar = isset($tanggal_seminar) ? $tanggal_seminar : array(); ?>
<?php function get_upload_status($date, $is_done)
{
	$string = $is_done ? "IN" : "NOT IN";
	$ci =& get_instance();
	return $ci->db->query("SELECT
					tsj.*,tsp.file,tsp.size,tsp.id id_verif,tsp.status
				FROM (
					SELECT
						tsj.id id_jadwal,
						tsj.mulai,
						tm.nama_mahasiswa,
					    tm.nim,
						DATE(tsj.mulai) tanggal_seminar
					FROM
						tb_seminar_jadwal tsj
						INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tsj.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
						INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim) tsj
					LEFT OUTER JOIN tb_seminar_pendaftaran tsp ON tsj.id_jadwal = tsp.id_jadwal_seminar
					WHERE tanggal_seminar = '$date' AND id_jadwal $string (SELECT id_jadwal_seminar FROM tb_seminar_pendaftaran )
				ORDER BY
					mulai")->result();
} ?>
<!-- Head PHP -->
<?php $this->load->view('admin/_partials/header.php'); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
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
							<div class="col-12">
								<h3 class="mb-0">Verifikasi Pendaftaran Seminar</h3>
								<p class="text-sm mb-0">
									Proses pengecekan berkas mahasiswa yang di upload, 2 hari sebelum seminar
									dilaksanakan
								</p>
								<span class="btn btn-sm btn-success"></span>
								<span class="small">Disetujui</span>
								<span class="btn btn-sm btn-warning"></span>
								<span class="small">Diajukan ulang</span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<?php foreach ($tanggal_seminar as $key => $item): ?>
									<div class="h3 text-right">Mahasiswa yang akan
										seminar <b
											class="text-warning"><?php echo convert_date($item->tanggal_seminar, 'long') ?></b>
									</div>
									<div id="accordianId" role="tablist" aria-multiselectable="true">
										<!-- Sudah upload-->
										<?php $status_pendaftaran = get_upload_status($item->tanggal_seminar, true); ?>
										<div class="h4">Mahasiswa yang sudah upload
											(<b><?php echo count($status_pendaftaran) ?></b>)
										</div>
										<div class="accordion" id="accordionExample">
											<?php if (count($status_pendaftaran) == 0): ?>
												<div class="card">
													<div class="card-body">
														<div class="h3 text-center">Belum ada mahasiswa yang mengunggah
															pendaftaran
														</div>
													</div>
												</div>
											<?php endif; ?>
											<?php foreach ($status_pendaftaran as $status): ?>
												<div
													class="card <?php echo $status->status != 'NULL' ? 'disable' : "" ?>">
													<div class="card-header" id="headingOne" data-toggle="collapse"
														 data-target="#collapse-<?php echo $status->id_jadwal ?>"
														 aria-expanded="true"
														 aria-controls="collapse<?php echo $status->id_jadwal ?>">
														<h5 class="mb-0 <?php echo $status->status != 'NULL' ? ($status->status == 'accept' ? 'text-success' : '') : ($status->status == 'decline' ? 'text-warning' : "") ?>"><?php echo $status->nama_mahasiswa ?>
															(<?php echo $status->nim ?>)</h5>
													</div>
													<div id="collapse-<?php echo $status->id_jadwal ?>"
														 class="collapse"
														 aria-labelledby="headingOne"
														 data-parent="#accordionExample">
														<div class="card-body">
															<div class="d-flex justify-content-end mb-3">
																<a href="<?php echo site_url('seminar?m=pendaftaran&q=dec&id=' . $status->id_verif) ?>"
																   class="btn btn-sm btn-danger <?php echo $status->status != 'NULL' ? ($status->status == 'accept' ? 'disabled' : '') : "" ?>">Upload
																	Ulang</a>
																<a href="<?php echo site_url('seminar?m=pendaftaran&q=acc&id=' . $status->id_verif) ?>"
																   class="btn btn-sm btn-primary mr-1 <?php echo $status->status != 'NULL' ? ($status->status == 'accept' ? 'disabled' : '') : "" ?>">Terima</a>
															</div>
															<iframe class="col-md-12 px-0" style="border-radius: 6px"
																	height="500px"
																	src="<?php echo base_url('/ViewerJS/#../file_upload/pendaftaran_seminar/' . $status->file) ?>"
																	frameborder="0"></iframe>
														</div>

													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<!-- Belum upload-->
										<?php $status_pendaftaran_belum = get_upload_status($item->tanggal_seminar, false); ?>

										<div class="h4">Mahasiswa yang belum upload
											(<b><?php echo count($status_pendaftaran_belum) ?>)</div>
										<div class="card">
											<div class="card-header" id="headingOne" data-toggle="collapse"
												 data-target="#collapse-<?php echo $status->id_jadwal ?>-not"
												 aria-expanded="true"
												 aria-controls="collapse<?php echo $status->id_jadwal ?>-not">
												<button class="btn btn-sm btn-primary">Detail</button>
											</div>
											<div id="collapse-<?php echo $status->id_jadwal ?>-not"
												 class="collapse"
												 aria-labelledby="headingOne"
												 data-parent="#accordionExample">
												<div class="card-body">
													<ul>
														<?php foreach ($status_pendaftaran_belum as $status): ?>
															<li class="font-weight-normal h4"><?php echo $status->nama_mahasiswa ?>
																(<?php echo $status->nim ?>)
															</li>
														<?php endforeach; ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php'); ?>
<?php $this->load->view('admin/_partials/js.php'); ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
