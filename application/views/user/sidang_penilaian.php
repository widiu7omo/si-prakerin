<?php $section = isset($_GET['section']) ? $_GET['section'] : 'today'; ?>
<?php $level = $this->session->userdata('level') ?>
<?php $temp_date = "" ?>
<?php function get_another_penilaian($id_jadwal, $status)
{
	$join = array('tb_history_seminar_penilaian thsp', 'thsp.id_seminar_penilaian = tsp.id', 'LEFT OUTER');
	$data = datajoin('tb_seminar_penilaian tsp', "id_seminar_jadwal = '$id_jadwal' AND status_dosen = '$status'", 'tsp.nilai_seminar n1,tsp.detail_nilai_seminar dn1,thsp.nilai_seminar n2,thsp.detail_nilai_seminar dn2', $join);
	return $data;
} ?>
<?php function get_penilaian_perusahaan($id_bimbingan)
{
	return masterdata('tb_perusahaan_penilaian', "id_dosen_bimbingan_mhs = '$id_bimbingan'", 'nilai_pkl');
} ?>
<?php function get_nilai_mutu($nilai, $get_status = false)
{
	$mutu = '';
	switch ($nilai) {
		case $nilai >= 80:
			$mutu = 'A';
			break;
		case $nilai >= 75 && $nilai < 80 :
			$mutu = 'B+';
			break;
		case $nilai >= 70 && $nilai < 75:
			$mutu = 'B';
			break;
		case $nilai >= 65 && $nilai < 70:
			$mutu = 'C+';
			break;
		case $nilai >= 60 && $nilai < 65:
			$mutu = 'C';
			break;
		case $nilai >= 50 && $nilai < 60:
			$mutu = 'D+';
			break;
		case $nilai >= 40 && $nilai < 50:
			$mutu = 'D';
			break;
		case $nilai < 40:
			$mutu = 'E';
			break;
	}
	if ($get_status) {
		if ($mutu != 'D+' && $mutu != 'D' && $mutu != 'E') {
			return 'LULUS DENGAN REVISI';
		} else {
			return 'TIDAK LULUS';
		}
	}
	return $mutu;
} ?>
<?php
function get_another_penilaian_revisi($id, $filter = true)
{
	$where = "";
	if ($filter) {
		$where = "AND status_dosen <> 'p3'";
	}
	$join = array('tb_history_seminar_penilaian thsp', 'thsp.id_seminar_penilaian = tsp.id', 'LEFT OUTER');
	return datajoin('tb_seminar_penilaian tsp', "id_seminar_jadwal = '$id' $where", 'tsp.nilai_seminar nilai1,thsp.nilai_seminar nilai2,tsp.status_dosen', $join);

}

?>
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
						<ul class="nav nav-pills nav-stacked ">
							<li class="nav-item">
								<a href="<?php echo site_url('sidang?m=penilaian&section=today') ?>"
								   class="nav-link <?php echo !isset($section) ? 'active' : null ?> <?php echo $section == 'today' ? 'active' : null ?>">Uji
									Hari ini</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('sidang?m=penilaian&section=hasil') ?>"
								   class="nav-link <?php echo !isset($section) ? 'active' : null ?> <?php echo $section == 'hasil' ? 'active' : null ?>">Hasil
									Uji</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('sidang?m=penilaian&section=history') ?>"
								   class="nav-link <?php echo $section == 'history' ? 'active' : null ?>">Riwayat
									Menguji dan Nilai Revisi</a>
							</li>
						</ul>
					<?php else: ?>
						<div class="h2">Penilaian seminar</div>
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
												<div class="col-md-12 col-sm-12">
													<h5 class="h3 mb-0">Berikut daftar mahasiswa yang telah anda uji
														ini</h5>
													<small>* Pilih untuk melihat detail</small><br>
												</div>
											</div>
										</div>
										<div class="card-body p-0">
											<div class="row">
												<div class="col-md-12 m-3">
													<button class="btn btn-sm btn-info"></button>
													<span>Approved berkas akhir</span><br>
													<button class="btn btn-sm btn-success"></button>
													<span>Acc semua dosen (Penguji dan Pembimbing)</span><br>
													<button class="btn btn-sm btn-secondary"></button>
													<span>Belum Acc semua dosen (Penguji dan Pembimbing)</span>
												</div>
											</div>
											<div class="list-group list-group-flush">
												<?php if (isset($riwayat_uji) and count($riwayat_uji) === 0): ?>
													<div><p class="text-center h2">Belum ada mahasiswa yang anda uji</p>
													</div>
												<?php endif; ?>
												<?php foreach (isset($riwayat_uji) ? $riwayat_uji : array() as $key => $r_uji): ?>
													<?php $date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
													<?php if ($date != $temp_date): ?>
														<div
															class="h4 bg-secondary p-3 m-0 font-weight-bold text-right d-flex justify-content-between">
															<div>Tanggal</div>
															<div><?php echo convert_date($date, 'long') ?></div>
														</div>
														<?php $temp_date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
													<?php endif; ?>
													<?php $is_complete = array();
													$checking_revisi = get_another_penilaian_revisi($r_uji->ij, false);
													foreach ($checking_revisi as $item) {
														array_push($is_complete, $item->nilai1 != NULL ? 1 : 0);
														array_push($is_complete, $item->nilai2 != NULL ? 1 : 0);
													}
													$color_success = !in_array(0, $is_complete) ? "bg-success" : "";
													$text_success = !in_array(0, $is_complete) ? "text-white" : "";
													$status_berkas = masterdata('tb_kelengkapan_berkas', "id_dosen_bimbingan_mhs = '$r_uji->id_bimbingan'", 'status', false);
													if (isset($status_berkas->status) && $status_berkas->status == 'approve') {
														$color_success = 'bg-info';
													}
													?>
													<a class="list-group-item <?php echo $color_success ?> <?php echo $text_success ?> list-group-item-action flex-column align-items-start py-4 px-4"
													   role="button"
													   data-toggle="collapse"
													   href="#collapse<?php echo $r_uji->id ?>"
													   aria-expanded="false"
													   aria-controls="collapse<?php echo $r_uji->id ?>">
														<?php if ($r_uji->sebagai == 'p3'): ?>
															<small class="text-warning">Mahasiswa Bimbingan anda (klik
																untuk
																melihat
																detail nilai revisi penguji)</small>
														<?php endif; ?>
														<div
															class="d-flex row justify-content-between align-items-center">
															<div class="col col-xs-12">
																<small>Mahasiswa:</small>
																<h5 class="mb-0 h4 <?php echo $text_success ?> "><?php echo $r_uji->nama_mahasiswa ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Ruangan:</small>
																<h5 class="mb-0 <?php echo $text_success ?> "><?php echo $r_uji->nama_tempat ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Waktu:</small>
																<h5 class="mb-0 <?php echo $text_success ?> ">
																	Pukul <?php echo get_time_range($r_uji->start, $r_uji->end, 'time') ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Nilai Seminar:</small>
																<h5 class="mb-0 <?php echo $text_success ?> "><?php echo $r_uji->nilai_seminar_past ? $r_uji->nilai_seminar_past : $r_uji->nilai_seminar ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Nilai Revisi:</small>
																<h5 class="mb-0 <?php echo $text_success ?> "><?php echo $r_uji->status_revisi ? $r_uji->nilai_seminar : "Belum revisi" ?></h5>
															</div>
															<div class="col col-xs-12">
																<?php if (!$r_uji->status_revisi): ?>
																	<button type="submit" id="btn-penilaian"
																			data-ij="<?php echo $r_uji->ij ?>"
																			data-in="<?php echo $r_uji->id ?>"
																			class="m-1 btn btn-sm btn-primary">
																		Penilaian Revisi
																	</button>
																<?php endif; ?>
															</div>
														</div>
													</a>
													<?php if ($r_uji->sebagai == 'p3'): ?>
														<div class="collapse" id="collapse<?php echo $r_uji->id ?>">
															<div class="card card-body shadow-none m-0 pt-2 pb-2">
																<?php
																$revisi = get_another_penilaian_revisi($r_uji->ij, false) ?? array(); ?>
																<?php $perusahaan = get_penilaian_perusahaan($r_uji->id_bimbingan);
																$total_seminar = 0;
																$total_revisi = 0;
																$n_perusahaan = isset($perusahaan->nilai_pkl) ? $perusahaan->nilai_pkl : 0;
																$percentage_n_perusahaan = isset($perusahaan->nilai_pkl) ? round(($perusahaan->nilai_pkl * 50) / 100, 2) : 0
																?>
																<div class="row">
																	<div class="col-md-6 col-xs-12">
																		<div class="list-group">
																			<?php foreach ($revisi as $rev): ?>
																				<a href="#"
																				   class="list-group-item list-group-item-action list-group-item-primary">
																					<div class="col col-xs-12">
																						<small><?php echo $rev->status_dosen == 'p1' ? "Nilai Seminar Penguji 1" : ($rev->status_dosen == 'p2' ? "Nilai Seminar Penguji 2" : "Nilai Seminar Pembimbing") ?>
																							:</small>
																						<?php $n_rev = $rev->nilai2 == NULL ? $rev->nilai1 : $rev->nilai2;
																						$val_rev = $rev->nilai2 == NULL ? $rev->nilai1 : $rev->nilai2;
																						$percent = $rev->status_dosen == 'p3' ? 30 : 10;
																						$total_all_s = round(($val_rev * $percent) / 100, 2);
																						$total_seminar = $total_seminar + $total_all_s;
																						?>
																						<span
																							class="mb-0 h4"><?php echo $n_rev ?> X <?php echo $percent ?>% = <?php echo $total_all_s ?> </span>
																					</div>
																				</a>
																			<?php endforeach; ?>
																			<a href="#"
																			   class="list-group-item list-group-item-action list-group-item-primary">
																				<div class="col col-xs-12">
																					<small>Nilai Perusahaan :</small>
																					<span
																						class="mb-0 h4"><?php echo $n_perusahaan ?> X 50% = <?php echo $percentage_n_perusahaan ?></span>
																				</div>
																			</a>
																			<a href="#"
																			   class="list-group-item list-group-item-action list-group-item-primary">
																				<div class="col col-xs-12">
																					<small>Nilai Total Sebelum Revisi
																						:</small>
																					<?php $total_seminar = $total_seminar + $percentage_n_perusahaan; ?>
																					<span
																						class="mb-0 h4"><?php echo $total_seminar ?> dengan Mutu <?php echo get_nilai_mutu($total_seminar) ?></span>
																				</div>
																			</a>
																		</div>
																	</div>
																	<div class="col-md-6 col-xs-12">
																		<div class="list-group">
																			<?php foreach ($revisi as $rev): ?>
																				<a href="#"
																				   class="list-group-item list-group-item-action list-group-item-primary">
																					<div class="col col-xs-12">
																						<small><?php echo $rev->status_dosen == 'p1' ? "Nilai Revisi Penguji 1" : ($rev->status_dosen == 'p2' ? "Nilai Revisi Penguji 2" : "Nilai Revisi Pembimbing") ?>
																							:</small>
																						<?php $n_rev = $rev->nilai2 != NULL ? $rev->nilai1 : "Belum ada penilaian";
																						$val_rev = $rev->nilai2 != NULL ? $rev->nilai1 : 0;
																						$percent = $rev->status_dosen == 'p3' ? 30 : 10;
																						$total_all_r = round(($val_rev * $percent) / 100, 2);
																						$total_revisi = $total_revisi + $total_all_r;
																						?>
																						<span
																							class="mb-0 h4"><?php echo $n_rev ?> X <?php echo $percent ?>% = <?php echo $total_all_r ?> </span>
																					</div>
																				</a>
																			<?php endforeach; ?>
																			<a href="#"
																			   class="list-group-item list-group-item-action list-group-item-primary">
																				<div class="col col-xs-12">
																					<small>Nilai Perusahaan :</small>
																					<span
																						class="mb-0 h4"><?php echo $n_perusahaan ?> X 50% = <?php echo $percentage_n_perusahaan ?></span>
																				</div>
																			</a>
																			<a href="#"
																			   class="list-group-item list-group-item-action list-group-item-primary">
																				<div class="col col-xs-12">
																					<small>Nilai Total Setelah Revisi
																						:</small>
																					<?php $total_revisi = $total_revisi + $percentage_n_perusahaan; ?>
																					<span
																						class="mb-0 h4"><?php echo $total_revisi ?> dengan Mutu <?php echo get_nilai_mutu($total_revisi) ?></span>
																				</div>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
							<?php if ($section === 'hasil'): ?>
							<div class="row">
								<div class="col">
									<div class="card">
										<div class="card-header">
											<!-- Title -->
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<h5 class="h3 mb-0">Berikut daftar mahasiswa yang telah anda uji
														(Sebagai Pembimbing)</h5>
													<small>* Pilih untuk melihat detail</small><br>
												</div>
											</div>
										</div>
										<div class="card-body p-0">
											<div class="list-group list-group-flush">
												<?php if (isset($riwayat_uji) and count($riwayat_uji) === 0): ?>
													<div><p class="text-center h2">Belum ada hasil uji (Pembimbing)</p>
													</div>
												<?php endif; ?>
												<div class="accordion" id="accordionExample">
													<?php foreach (isset($riwayat_uji) ? $riwayat_uji : array() as $key => $r_uji): ?>
														<?php if ($r_uji->sebagai === 'p3'): ?>
															<?php $date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
															<?php if ($date != $temp_date): ?>
																<div
																	class="h4 bg-secondary p-3 m-0 font-weight-bold text-right d-flex justify-content-between">
																	<div>Tanggal</div>
																	<div><?php echo convert_date($date, 'long') ?></div>
																</div>
																<?php $temp_date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
															<?php endif; ?>

															<a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4"
															   data-toggle="collapse"
															   data-target="#collapse-<?php echo $r_uji->id ?>"
															   aria-expanded="false" aria-controls="collapseOne">
																<div
																	class="d-flex row justify-content-between align-items-center">
																	<div class="col col-xs-12">
																		<small>Mahasiswa:</small>
																		<h5 class="mb-0 h4"><?php echo $r_uji->nama_mahasiswa ?></h5>
																	</div>
																	<div class="col col-xs-12">
																		<small>Ruangan:</small>
																		<h5 class="mb-0"><?php echo $r_uji->nama_tempat ?></h5>
																	</div>
																	<div class="col col-xs-12">
																		<small>Waktu:</small>
																		<h5 class="mb-0">
																			Pukul <?php echo get_time_range($r_uji->start, $r_uji->end, 'time') ?></h5>
																	</div>
																	<div class="col col-xs-12">
																		<button type="submit" id="btn-penilaian"
																				data-ij="<?php echo $r_uji->ij ?>"
																				data-in="<?php echo $r_uji->id ?>"
																				class="m-1 btn btn-sm btn-primary">
																			Detail Penilaian
																		</button>
																	</div>
																</div>
															</a>
															<div id="collapse-<?php echo $r_uji->id ?>" class="collapse"
																 aria-labelledby="headingOne"
																 data-parent="#accordionExample">
																<h4 class="ml-3 mt-2 text-primary">Penilaian seminar
																	(Sementara)</h4>
																<div class="card-body">
																	<?php
																	$nilai_p1 = get_another_penilaian($r_uji->ij, 'p1');
																	$nilai_p2 = get_another_penilaian($r_uji->ij, 'p2');
																	$nilai_p3 = get_another_penilaian($r_uji->ij, 'p3');
																	$nilai_perusahaan = get_penilaian_perusahaan($r_uji->id_bimbingan); ?>
																	<div class="row">
																		<div class="col-xs-12 col-sm-12 col-md-6">
																			<ul class="list-group">
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal">
																						Penilaian dari Penguji
																						1</h4>
																					<?php $n1 = count($nilai_p1) > 0 ? $nilai_p1[0]->n1 : 0 ?>
																					<b> 10% X <?php echo $n1 ?>
																						= <?php echo ($n1 * 10) / 100; ?></b>
																				</li>
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal">
																						Penilaian dari Penguji
																						2</h4>
																					<?php $n2 = count($nilai_p2) > 0 ? $nilai_p2[0]->n1 : 0 ?>
																					<b> 10% X <?php echo $n2 ?>
																						= <?php echo ($n2 * 10) / 100 ?></b>
																				</li>
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal">
																						Penilaian dari
																						Pembimbing</h4>
																					<?php $n3 = count($nilai_p3) > 0 ? $nilai_p3[0]->n1 : 0 ?>
																					<b> 30% X <?php echo $n3 ?>
																						= <?php echo ($n3 * 30) / 100 ?></b>
																				</li>
																			</ul>
																		</div>
																		<div class="col-xs-12 col-sm-12 col-md-6">
																			<ul class="list-group list-group-flush">
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal font-weight-bold">
																						Penilaian Seminar
																						(P1+P2+P3)</h4>
																					<?php $total_nilai_seminar = (($n1 * 10) / 100) + (($n2 * 10) / 100) + (($n3 * 30) / 100) ?>
																					<b><?php echo $total_nilai_seminar ?></b>
																				</li>
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal font-weight-bold">
																						Total
																						Penilaian Perusahaan
																						(50%)</h4>
																					<?php $n4 = isset($nilai_perusahaan->nilai_pkl) ? $nilai_perusahaan->nilai_pkl : 0 ?>
																					<b><?php echo ($n4 * 50) / 100 ?></b>
																				</li>
																				<li class="list-group-item d-flex justify-content-between">
																					<h4 class="font-weight-normal font-weight-bold">
																						Total Nilai Keseluruhan</h4>
																					<?php $total_nilai_semua = (($n4 * 50) / 100) + $total_nilai_seminar ?>
																					<b><?php echo $total_nilai_semua ?></b>
																				</li>
																			</ul>
																		</div>
																	</div>
																	<hr class="m-0 mb-3">
																	<div class="row">
																		<div class="col-md-12 ml-3">
																			<h2>Hasil akhir </h2>
																			<div
																				class="row">
																				<div
																					class="col-xs-12 col-md-6 col-sm-6">
																					<h4>- Hasil Nilai
																						Mutu
																					</h4>
																					<b
																						class="h1 text-primary"><?php echo get_nilai_mutu($total_nilai_semua) ?></b>
																				</div>
																				<div
																					class="col-xs-12 col-md-6 col-sm-6">
																					<h4>- Mahasiswa dinyatakan
																					</h4>
																					<b
																						class="h1 text-primary"><?php echo get_nilai_mutu($total_nilai_semua, true) ?></b>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endif; ?>
													<?php endforeach; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
							<?php if ($section === 'today'): ?>
							<div class="h3">Berikut seminar yang anda uji hari ini</div>
							<div class="row">
								<?php if (isset($jadwaluji) and count($jadwaluji) === 0): ?>
									<div class="col-12">
										<div class="card">
											<div class="card-body"><p class="h2 text-center font-weight-bold mt-3">Tidak
													ada jadwal
													uji
													untuk anda hari ini</p></div>
										</div>
									</div>
								<?php endif ?>
								<?php foreach (isset($jadwaluji) ? $jadwaluji : array() as $item): ?>

									<div class="col-md-6 col-sm-12 col-xs-12">
										<div class="card">
											<!-- Card body -->
											<div class="card-body">
												<div class="row justify-content-between align-items-center">
													<div class="col">
														<i class="ni ni-badge text-primary"></i>
														<span
															class="h6 surtitle">&nbsp; Anda sebagai <?php echo $item->sebagai === 'p1' ? 'Penguji 1' : ($item->sebagai === 'p2' ? "Penguji 2" : "Pembimbing") ?></span>
													</div>
													<?php
													$time_start = get_time_range($item->start, $item->end, 'start');
													$date_time_schedule = strtotime(date('Y-m-d') . ' ' . $time_start);
													$now = strtotime(date('Y-m-d H:i'))
													?>
													<div class="col-auto">
														<?php if ($now > $date_time_schedule): ?>
															<?php if ($item->sebagai === 'p3'): ?>
																<div class="btn btn-sm btn-primary"
																	 id="nilai-penguji-sementara"
																	 data-ij="<?php echo $item->ij ?>">Nilai Penguji
																</div>
															<?php endif ?>
														<?php endif; ?>
													</div>
												</div>
												<div class="row mx-0 d-flex justify-content-between align-items-center">
													<div class="my-4">
													<span class="h6 surtitle text-muted">
													  Nama
													</span>
														<div class="h1"><?php echo $item->nama_mahasiswa ?></div>
													</div>
													<div>
														<?php if ($now > $date_time_schedule): ?>
															<button id="btn-penilaian" class="btn btn-primary"
																	data-ij="<?php echo $item->ij ?>">Penilaian
															</button>
														<?php endif; ?>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<span class="h6 surtitle text-muted">Ruangan</span>
														<span class="d-block h3"><?php echo $item->nama_tempat ?></span>
													</div>
													<div class="col">
														<span class="h6 surtitle text-muted">Waktu</span>
														<span
															class="d-block h3"><?php echo get_time_range($item->start, $item->end, 'time') ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="h3 mt-2">Berikut seminar besok</div>
							<div class="row">
								<?php if (isset($besok) and count($besok) === 0): ?>
									<div class="col-12">
										<div class="card">
											<div class="card-body"><p class="h2 text-center font-weight-bold mt-3">Tidak
													ada jadwal
													uji
													untuk besok</p></div>
										</div>
									</div>
								<?php endif ?>
								<?php foreach (isset($besok) ? $besok : array() as $item): ?>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="card">
											<!-- Card body -->
											<div class="card-body">
												<div class="row justify-content-between align-items-center">
													<div class="col">
														<i class="ni ni-badge text-primary"></i>
														<span
															class="h6 surtitle">&nbsp; Anda sebagai <?php echo $item->sebagai === 'p1' ? 'Penguji 1' : ($item->sebagai === 'p2' ? "Penguji 2" : "Pembimbing") ?></span>
													</div>
													<div class="col-auto">
														<span class="badge badge-lg badge-success">Active</span>
													</div>
												</div>
												<div class="row mx-0 d-flex justify-content-between align-items-center">
													<div class="my-4">
													<span class="h6 surtitle text-muted">
													  Nama
													</span>
														<div class="h1"><?php echo $item->nama_mahasiswa ?></div>
													</div>
													<div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<span class="h6 surtitle text-muted">Ruangan</span>
														<span class="d-block h3"><?php echo $item->nama_tempat ?></span>
													</div>
													<div class="col">
														<span class="h6 surtitle text-muted">Waktu</span>
														<span
															class="d-block h3"><?php echo get_time_range($item->start, $item->end, 'time') ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="h3 mt-2">Berikut ini adalah daftar mahasiswa yang
								terlewat penilaian
							</div>
							<div class="row">
								<?php if (isset($riwayat_uji_terlewat) and count($riwayat_uji_terlewat) === 0): ?>
									<div class="col-12">
										<div class="card">
											<div class="card-body">
												<p class="h2 text-center font-weight-bold mt-3">Tidak
													ada
													mahasiswa terlewat
													penilaiannya</p>
											</div>
										</div>
									</div>
								<?php endif; ?>
								<div class="col">
									<div class="card"
										 data-step="<?php echo isset($intro) ? $intro[0]['step_intro'] : null ?>"
										 data-intro="<?php echo isset($intro) ? $intro[0]['message_intro'] : null ?>">
										<div class="card-body p-0">
											<div class="list-group list-group-flush">
												<?php foreach (isset($riwayat_uji_terlewat) ? $riwayat_uji_terlewat : array() as $key => $r_uji): ?>
													<?php $date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
													<?php if ($date != $temp_date): ?>
														<div
															class="h4 bg-secondary p-3 m-0 font-weight-bold text-right d-flex justify-content-between">
															<div>Tanggal</div>
															<div><?php echo convert_date($date, 'long') ?></div>
														</div>
														<?php $temp_date = get_time_range($r_uji->start, $r_uji->end, 'datestart'); ?>
													<?php endif; ?>
													<a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
														<div
															class="d-flex row justify-content-between align-items-center">
															<div class="col col-xs-12">
																<small>Mahasiswa:</small>
																<h5 class="mb-0 h4"><?php echo $r_uji->nama_mahasiswa ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Ruangan:</small>
																<h5 class="mb-0"><?php echo $r_uji->nama_tempat ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Waktu:</small>
																<h5 class="mb-0">
																	Pukul <?php echo get_time_range($r_uji->start, $r_uji->end, 'time') ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Nilai Seminar:</small>
																<h5 class="mb-0">Belum dinilai</h5>
															</div>
															<div class="col col-xs-12">
																<small>Nilai Revisi:</small>
																<h5 class="mb-0">Belum revisi</h5>
															</div>
															<div class="col col-xs-12">
																<button type="submit" id="btn-penilaian"
																		data-ij="<?php echo $r_uji->ij ?>"
																		data-req="ajax_left"
																		class="m-1 btn btn-sm btn-primary">
																	Penilaian Seminar
																</button>
															</div>
														</div>
													</a>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
							<?php break ?>
						<?php case 'mahasiswa': ?>
							<?php $penilaian = isset($penilaian) ? $penilaian : array(); ?>
							<div class="row">
								<div class="col-xs-12 col-md-12 col-lg-12">
									<div class="h3 ml-3">Rincian detail penilaian</div>
									<ul class="list-group">
										<?php foreach ($penilaian as $nilai): ?>
											<li class="list-group-item accordion"
												id="accordion<?php echo $nilai->status_dosen ?>">
												<div id="accordion-title" class="justify-content-between d-flex">
													<span><?php echo $nilai->status_dosen == 'p1' ? "Penguji 1 - " . $nilai->p1 : ($nilai->status_dosen == 'p2' ? 'Penguji 2 - ' . $nilai->p2 : "Pembimbing - " . $nilai->p3) ?></span>
													<span data-toggle="collapse"
														  data-target="#accordionBody<?php echo $nilai->status_dosen ?>"
														  aria-expanded="false"
														  aria-controls="accordionBody<?php echo $nilai->status_dosen ?>"><a
															href="javascript:void(0);"
															class="text-primary">Rincian</a></span>
												</div>
												<div id="accordionBody<?php echo $nilai->status_dosen ?>"
													 class="collapse"
													 aria-labelledby="accordionBody<?php echo $nilai->status_dosen ?>"
													 data-parent="#accordion<?php echo $nilai->status_dosen ?>">
													<hr class="mt-3 mb-1">
													<div class="row">
														<div
															class="col-md-6 col-xs-12 col-sm-12 <?php echo !$nilai->nilai_seminar ? 'd-flex justify-content-center align-items-center flex-grow-1' : null ?>">
															<?php if ($nilai->nilai_seminar == null): ?>
																<div
																	class="d-flex justify-content-center align-items-center flex-grow-1">
																	<p class="h3">Belum ada penilaian seminar dari
																		dosen</p>
																</div>
															<?php elseif ($nilai->nilai_seminar != null):
																$percentsPembimbing = array('20%', '25%', '15%', '20%', '20%');
																$percentsPenguji = array('10%', '15%', '40%', '20%', '15%');
																$detail_nilai = array();
																$nilai_total = 0;
																$i = 0;
																if ($nilai->nilai_seminar_past == null) {
																	//belum revisi
																	$detail_nilai = json_decode($nilai->detail_nilai_seminar);
																	$nilai_total = $nilai->nilai_seminar;
																} else {
																	//sudah revisi
																	$detail_nilai = json_decode($nilai->detail_nilai_seminar_past);
																	$nilai_total = $nilai->nilai_seminar_past;
																}
																?>
																<div class="p-3 border-default my-2"
																	 style="border:1px #525f7f40 solid !important;border-radius: 4px;">
																	<div class="h3">Penilaian Seminar</div>
																	<?php foreach ($detail_nilai as $dnbr): ?>
																		<div class="row">
																			<div class="col-7">
																				<p>
																					<span><?php echo $dnbr->name ?></span>
																				</p>
																			</div>
																			<div class="col-5">
																				<span>: </span>
																				<span> <?php echo $dnbr->value ?> </span>
																				<span>X <?php echo $percentsPenguji[$i] ?></span>
																				<span> = </span>
																				<span> <?php echo $dnbr->res ?> </span>
																			</div>
																		</div>
																		<?php $i++ ?>
																		<?php if ($i === count($detail_nilai)): ?>
																			<hr class="mt-3 mb-1 ml-0">
																			<div class="row">
																				<div class="col-7">
																					<p><span>Total</span></p>
																				</div>
																				<div class="col-5">
																					<span>: </span>
																					<span> <?php echo $nilai_total ?> </span>
																				</div>
																			</div>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>
															<?php endif; ?>
														</div>
														<div
															class="col-md-6 col-xs-12 col-sm-12 <?php echo !$nilai->nilai_seminar_past ? 'd-flex justify-content-center align-items-center flex-grow-1' : null ?>">
															<?php if ($nilai->nilai_seminar_past == null): ?>
																<div class="">
																	<p class="h3">Belum ada penilaian revisi dari
																		dosen</p>
																</div>
															<?php elseif ($nilai->nilai_seminar_past != null):
																$percentsPembimbing = array('20%', '25%', '15%', '20%', '20%');
																$percentsPenguji = array('10%', '15%', '40%', '20%', '15%');
																$detail_nilai = array();
																$i = 0;
																//sudah revisi
																$detail_nilai = json_decode($nilai->detail_nilai_seminar);
																$nilai_total = $nilai->nilai_seminar;
																?>
																<div class="p-3 border-default my-2"
																	 style="border:1px #525f7f40 solid !important;border-radius: 4px;">
																	<div class="h3">Penilaian Revisi</div>
																	<?php foreach ($detail_nilai as $dnbr): ?>
																		<div class="row">
																			<div class="col-7">
																				<p>
																					<span><?php echo $dnbr->name ?></span>
																				</p>
																			</div>
																			<div class="col-5">
																				<span>: </span>
																				<span> <?php echo $dnbr->value ?> </span>
																				<span>X <?php echo $percentsPenguji[$i] ?></span>
																				<span> = </span>
																				<span> <?php echo $dnbr->res ?> </span>
																			</div>
																		</div>
																		<?php $i++ ?>
																		<?php if ($i === count($detail_nilai)): ?>
																			<hr class="mt-3 mb-1 ml-0">
																			<div class="row">
																				<div class="col-7">
																					<p><span>Total</span></p>
																				</div>
																				<div class="col-5">
																					<span>: </span>
																					<span> <?php echo $nilai_total ?> </span>
																				</div>
																			</div>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>
															<?php endif; ?>
														</div>
													</div>

												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php break ?>
						<?php endswitch; ?>
				</div>
			</div>

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>

	</div>
	<?php $this->load->view('user/sidang_modal_penilaian_sementara.php') ?>
	<?php if (isset($_GET['section']) and $_GET['section'] === 'history'): ?>
		<?php $this->load->view('user/sidang_modal_penilaian_revisi.php') ?>
	<?php else: ?>
		<?php $this->load->view('user/sidang_modal_penilaian.php') ?>
	<?php endif; ?>

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
<script>
	(function ($) {
		$.fn.inputFilter = function (inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		};
	}(jQuery));
	//mahasiswa
	<?php if($level === 'mahasiswa'): ?>

	<?php endif; ?>
	<?php if($level === 'dosen'): ?>
	//dosen
	function get_total() {
		//TODO: clean this code
		let p5 = $('#p5-tot').text();
		let p4 = $('#p4-tot').text();
		let p3 = $('#p3-tot').text();
		let p2 = $('#p2-tot').text();
		let p1 = $('#p1-tot').text();
		if (p5 !== 'P5' && p4 !== 'P4' && p3 !== 'P3' && p2 !== 'P2' && p1 !== 'P1') {
			let result = parseFloat(p1) + parseFloat(p2) + parseFloat(p3) + parseFloat(p4) + parseFloat(p5);
			$('#pn-tot').text(result.toFixed(2));
		}
	}

	function get_detail_nilai() {
		let nilai = [];
		for (let i = 1; i <= 5; i++) {
			nilai.push({name: $('#name-p' + i).text(), value: $('#p' + i).val(), res: $('#res-p' + i).text()})
		}
		return nilai;
	}

	let komponenPembimbing = [
		{name: "1. Penguasaan teori", percentage: "20%", value: 20},
		{name: "2. Kemampuan analisis dan pemecahan masalah", percentage: "25%", value: 25},
		{name: "3. Keaktifan bimbingan", percentage: "15%", value: 15},
		{name: "4. Kemampuan penulisan laporan", percentage: "20%", value: 20},
		{name: "5. Sikap / Etika", percentage: "20%", value: 20}
	];
	let komponenPenguji = [
		{name: "1. Penyajian Presentasi", percentage: "10%", value: 10},
		{name: "2. Pemahaman Materi", percentage: "15%", value: 15},
		{name: "3. Hasil yang dicapai", percentage: "40%", value: 40},
		{name: "4. Objektifitas menganggapi pertanyaan", percentage: "20%", value: 20},
		{name: "5. Penulisan laporan", percentage: "15%", value: 15}
	];

	function get_value_penilaian(index) {
		let value_penilaian = $('#status-penilaian').data('status');
		if (value_penilaian === 'p3') {
			return komponenPembimbing[index].value
		} else {
			return komponenPenguji[index].value
		}
	}

	$(document).ready(function () {
		//TODO:clean this code
		$('#p1').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let percentageValue = get_value_penilaian(0)
				nilai = (parseInt(value) * percentageValue) / 100;
				if (isNaN(nilai)) {
					nilai = 0;
				}
				$('#p1-tot').text(nilai);
				$('#res-p1').text(nilai);
				get_total();
				return /^\d*$/.test(value);
			}
		})
		$('#p2').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let percentageValue = get_value_penilaian(1);
				let nilai = (parseInt(value) * percentageValue) / 100;
				if (isNaN(nilai)) {
					nilai = 0;
				}
				$('#p2-tot').text(nilai);
				$('#res-p2').text(nilai);
				get_total();
				return /^\d*$/.test(value);
			}
		})
		$('#p3').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let percentageValue = get_value_penilaian(2);
				let nilai = (parseInt(value) * percentageValue) / 100;
				if (isNaN(nilai)) {
					nilai = 0;
				}
				$('#p3-tot').text(nilai);
				$('#res-p3').text(nilai);
				get_total();
				return /^\d*$/.test(value);
			}
		})
		$('#p4').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let percentageValue = get_value_penilaian(3);
				let nilai = (parseInt(value) * percentageValue) / 100;
				if (isNaN(nilai)) {
					nilai = 0;
				}
				$('#p4-tot').text(nilai);
				$('#res-p4').text(nilai);
				get_total();
				return /^\d*$/.test(value);
			}
		})
		$('#p5').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let percentageValue = get_value_penilaian(4);
				let nilai = (parseInt(value) * percentageValue) / 100;
				if (isNaN(nilai)) {
					nilai = 0;
				}
				$('#p5-tot').text(nilai);
				$('#res-p5').text(nilai);
				get_total();
				return /^\d*$/.test(value);
			}
		});
		let id_jdw = 0;
		let id_n = "";
		let req = "ajax";
		let section = "<?php echo (isset($_GET['section']) and $_GET['section'] == 'history') ? $_GET['section'] : 'today' ?>"
		<?php if (isset($_GET['section']) and $_GET['section'] == 'history'): ?>
		for (let i = 1; i <= 5; i++) {
			$('#edit-p' + i).on('click', function () {
				let toggle = $('#p' + i).prop('disabled');
				$('#p' + i).prop('disabled', !toggle);
				$(this).text(toggle ? 'Save' : 'Edit');
			})
		}
		<?php endif; ?>
		function get_penilaian_perusahaan(id_jdw) {
			console.log(id_jdw)
			$.ajax({
				url: '<?php echo site_url("sidang?m=penilaian&q=fetch_company_val") ?>',
				method: "POST",
				dataType: 'json',
				data: {
					id_jadwal: id_jdw
				},
				success: function (res) {
					if (res.length > 0) {
						let innerHtml = "";
						innerHtml += "<h4>Penilaian Keseluruhan : <b>" + res[0].nilai_pkl + "</b></h4>";
						let detail = res[0].detail_nilai_pkl;
						let detailHtml = detail.map(function (item) {
							return "<li><h5>" + item.name + " : " + item.value + "</h5></li>";
						}).join("");
						innerHtml += "<ul>" + detailHtml + "</ul>";
						// console.log(innerHtml)
						$('#place-penilaian-perusahaan').html(innerHtml);
					} else {
						$('#place-penilaian-perusahaan').html('<h3 class="text-center">Mahasiswa belum mengisi penilaian dari perusahaan</h3>');
					}
				},
				error: function (er) {
					console.log(er)
				}
			})
		}

		$(document).on('click', '#nilai-penguji-sementara', function () {
			let ij = $(this).data('ij');
			$.ajax({
				url: "<?php echo site_url('sidang?m=penilaian&q=get_temp_nilai')?>",
				method: "POST",
				data: {
					ij: ij
				},
				dataType: 'json',
				success: function (data) {
					if (data.length > 0) {
						let ulHTML = "<ul class='list-group'>";
						let innerHTML = data.map(function (item) {
							let name = "";
							let p = item.status_dosen === 'p1' ? '1' : '2';
							name = "<li class='list-group-item'>" +
								"<h4 class='d-flex justify-content-between'>" +
								"<span>Penilaian Penguji " + p + "</span><span class='h3'> = " + item.nilai_seminar + "</span></h4>" +
								"<h6>" + "(" + item.nama_pegawai + ")" + "</h6>" +
								"</li>";
							return name;
						}).join('');
						let finalHTML = ulHTML + innerHTML + '</ul>';
						$('#body_penilaian_sementara').html(finalHTML);
					} else {
						$('#body_penilaian_sementara').html('<h2 class="text-center">Belum ada penilaian dari penguji</h2>');
					}
					console.log(data)
				},
				error: function (err) {
					console.log(err)
				}
			})
			$('#modal-seminar-penilaian-sementara').modal('show');
		})
		$(document).on('click', '#btn-penilaian', function () {
			id_jdw = $(this).data('ij');
			req = $(this).data('req') ? $(this).data('req') : "ajax";
			id_n = section === 'history' ? $(this).data('in') : "";
			get_penilaian_perusahaan(id_jdw);
			$.ajax({
				url: '<?php echo site_url("sidang?m=penilaian&section=") ?>' + section,
				method: "POST",
				dataType: 'json',
				data: {
					req: req,
					ij: id_jdw
				},
				success: function (res) {
					if (res.length !== 0) {
						$('#detail-nama').text(res[0].nama_mahasiswa);
						$('#detail-nim').text(res[0].nim);
						$('#detail-laporan').text(res[0].laporan);
						$('#detail-prodi').text(res[0].nama_program_studi);
						$('#status-penilaian').data('status', res[0].sebagai);
						$('#session-penilaian').data('session', res[0].session);
						if (section === 'history') {
							let data_nilai = JSON.parse(res[0].detail_nilai_seminar);
							let total_nilai = 0;
							data_nilai.forEach(function (val) {
								total_nilai = total_nilai + parseFloat(val.res)
							})
							for (let i = 1; i <= 5; i++) {
								$('#p' + i).val(data_nilai[i - 1].value);
								$('#p' + i + '-tot').text(data_nilai[i - 1].res);
								$('#res-p' + i).text(data_nilai[i - 1].res);
							}
							$('#pn-tot').text(total_nilai.toFixed(2));
						}
						let label = $('#komponen-penilaian>label');
						let percentage = $('span#percent-value');
						let percentHelp = $('b#percent-help');
						if (res[0].sebagai === 'p3') {
							label.map(function (index) {
								if (index < label.length - 1) {
									$(this).text(komponenPembimbing[index].name)
								}
							})
							percentage.map(function (index) {
								$(this).text(komponenPembimbing[index].percentage);
							})
							percentHelp.map(function (index) {
								$(this).text(komponenPembimbing[index].percentage);
							})
						} else {
							label.map(function (index) {
								if (index < label.length - 1) {
									$(this).text(komponenPenguji[index].name)
								}
							})
							percentage.map(function (index) {
								$(this).text(komponenPenguji[index].percentage);
							})
							percentHelp.map(function (index) {
								$(this).text(komponenPenguji[index].percentage);
							})
						}
						$('#modal-seminar-penilaian').modal('show');
					}
				},
				error: function (err) {
					console.log(err);
				}
			})
		}).on('click', '#btn-simpan-nilai', function () {
			let nas = $('#pn-tot').text();
			$(this).addClass('disabled');
			$(this).text("Menyimpan...")
			let dns = get_detail_nilai();
			let q = $(this).data('method');
			if (nas !== 'PT' && nas !== '0') {
				$.ajax({
					url: "<?php echo site_url('sidang?m=penilaian&q=') ?>" + q,
					method: "POST",
					data: {
						id: id_n,
						nas: nas,
						ij: id_jdw,
						dns: JSON.stringify(dns),
						status: $('#status-penilaian').data('status'),
						session: $('#session-penilaian').data('session')
					},
					success: function (res) {
						$('#modal-seminar-penilaian').modal('hide');
						setTimeout(function () {
							window.location.reload();
						}, 1000)
					}
				})

			}
		}).on('click', '#btn-penilaian-left', function () {

		})
	})
	<?php endif; ?>
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
