<?php $section = isset($_GET['section']) ? $_GET['section'] : 'today'; ?>
<?php $level = $this->session->userdata('level') ?>
<?php $temp_date = "" ?>
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
																<h5 class="mb-0"><?php echo $r_uji->nilai_seminar_past ? $r_uji->nilai_seminar_past : $r_uji->nilai_seminar ?></h5>
															</div>
															<div class="col col-xs-12">
																<small>Nilai Revisi:</small>
																<h5 class="mb-0"><?php echo $r_uji->status_revisi ? $r_uji->nilai_seminar : "Belum revisi" ?></h5>
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
												<?php endforeach; ?>
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
														<button id="btn-penilaian" class="btn btn-primary"
																data-ij="<?php echo $item->ij ?>">Penilaian
														</button>
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
			$('#pn-tot').text(parseInt(p1) + parseInt(p2) + parseInt(p3) + parseInt(p4) + parseInt(p5));
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
		{name: "1. Penguasaan teori", percentage: "20%"},
		{name: "2. Kemampuan analisis dan pemecahan masalah", percentage: "25%"},
		{name: "3. Keaktifan bimbingan", percentage: "15%"},
		{name: "4. Kemampuan penulisan laporan", percentage: "20%"},
		{name: "5. Sikap / Etika", percentage: "20%"}
	];
	let komponenPenguji = [
		{name:"1. Penyajian Presentasi",percentage:"10%"},
		{name:"2. Pemahaman Materi",percentage:"15%"},
		{name:"3. Hasil yang dicapai",percentage:"40%"},
		{name:"4. Objektifitas menganggapi pertanyaan",percentage:"20%"},
		{name:"5. Penulisan laporan",percentage:"15%"}
	];
	$(document).ready(function () {
		//TODO:clean this code
		$('#p1').inputFilter(function (value) {
			if (parseInt(value) <= 100 || value === '') {
				let nilai = (parseInt(value) * 10) / 100;
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
				let nilai = (parseInt(value) * 15) / 100;
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
				let nilai = (parseInt(value) * 40) / 100;
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
				let nilai = (parseInt(value) * 20) / 100;
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
				let nilai = (parseInt(value) * 15) / 100;
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
		$(document).on('click', '#btn-penilaian', function () {
			id_jdw = $(this).data('ij');
			req = $(this).data('req') ? $(this).data('req') : "ajax";
			id_n = section === 'history' ? $(this).data('in') : "";
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
								total_nilai = total_nilai + parseInt(val.res)
							})
							for (let i = 1; i <= 5; i++) {
								$('#p' + i).val(data_nilai[i - 1].value);
								$('#p' + i + '-tot').text(data_nilai[i - 1].res);
								$('#res-p' + i).text(data_nilai[i - 1].res);
							}
							$('#pn-tot').text(total_nilai);
						}
						let label = $('#komponen-penilaian>label');
						let percentage =$('span#percent-value');
						let percentHelp = $('b#percent-help');
						if (res[0].sebagai === 'p3') {
							label.map(function(index){
								if(index < label.length-1){
									$(this).text(komponenPembimbing[index].name)
								}
							})
							percentage.map(function(index){
								$(this).text(komponenPembimbing[index].percentage);
							})
							percentHelp.map(function (index) {
								$(this).text(komponenPembimbing[index].percentage);
							})
						} else {
							label.map(function(index){
								if(index < label.length-1){
									$(this).text(komponenPenguji[index].name)
								}
							})
							percentage.map(function(index){
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
