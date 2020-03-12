<?php $section = isset($_GET['section']) ? $_GET['section'] : null ?>
<!DOCTYPE html>
<html>

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
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<div class="h3">Rekap Akhir <?php echo $tahun ?? 'null' ?></div>
							<div class="text-right">
								<div class="d-flex align-items-center justify-content-end">Auto Refresh &nbsp;
									<label class="custom-toggle">
										<input type="checkbox" id="switch-realtime">
										<span class="custom-toggle-slider rounded-circle" data-label-off="No"
											  data-label-on="Yes"></span>
									</label>
								</div>
								<!--								<a href="-->
								<?php //echo site_url('seminar?m=data_penilaian&q=filter_belum_menilai') ?><!--"-->
								<!--								   class="btn btn-sm btn-primary">Belum dinilai per hari ini</a>-->
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-striped dt-responsive nowrap" id="datatable-jadwal">
									<thead class="thead-light">
									<tr role="row">
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Perusahaan</th>
										<th>Judul</th>
										<th>Tanggal Seminar</th>
										<th>Waktu</th>
										<th>Ruangan</th>
										<th>Pembimbing</th>
										<th>Penguji 1</th>
										<th>Penguji 2</th>
										<th>Nilai Angka</th>
										<th>Nilai Huruf</th>
										<th>Keterangan</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Perusahaan</th>
										<th>Judul</th>
										<th>Tanggal Seminar</th>
										<th>Waktu</th>
										<th>Ruangan</th>
										<th>Pembimbing</th>
										<th>Penguji 1</th>
										<th>Penguji 2</th>
										<th>Nilai Angka</th>
										<th>Nilai Huruf</th>
										<th>Keterangan</th>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/modal.php'); ?>
	<?php $this->load->view('admin/_partials/js.php'); ?>
	<script>
		function get_nilai_revisi(status, nilai = null) {
			if (status === "Sudah Revisi") {
				return "dengan Nilai Revisi = " + nilai;
			} else {
				return "";
			}
		}

		function format(d) {
			// `d` is the original data object for the row
			let {detail} = d;
			let addInfo = "";
			if (detail.length !== 0) {
				let detailHtml = detail.map(function (item) {
					let nilaiRevisi = item.nilai_2 === "belum" ? "" : "dengan nilai " + item.nilai_1;
					let statusRevisi = item.nilai_2 === "belum" ? "Belum direvisi" : "Sudah Revisi";
					let tanggalRevisi = item.nilai_2 === "belum" ? "" : item.tanggal_revisi;
					return "<h6>" + item.status + " (" + item.dosen + ") <b>" + statusRevisi + "</b> " + nilaiRevisi + " |<b>" + tanggalRevisi + "</b></h6>"
				});

				if (detail.length !== 3) {
					addInfo = "<small class='text-warning'>Penilaian Seminar Belum Lengkap</small>";
				}
				return "<tr>" + "<td>" + addInfo + "<h3>Detail Penilaian Revisi</h3>" + detailHtml.join("") + "</td>" + "</tr>";
			} else {
				"NULL Detail"
			}
		}

		$(document).ready(function () {
			Date.prototype.workingDaysFrom = function (fromDate) {
				// ensure that the argument is a valid and past date
				if (!fromDate || isNaN(fromDate) || this < fromDate) {
					return -1;
				}

				// clone date to avoid messing up original date and time
				var frD = new Date(fromDate.getTime()),
					toD = new Date(this.getTime()),
					numOfWorkingDays = 1;

				// reset time portion
				frD.setHours(0, 0, 0, 0);
				toD.setHours(0, 0, 0, 0);

				while (frD < toD) {
					frD.setDate(frD.getDate() + 1);
					var day = frD.getDay();
					if (day != 0 && day != 6) {
						numOfWorkingDays++;
					}
				}
				return numOfWorkingDays;
			};

			function pushDate(date) {
				let dates = [];
				if (date !== null) {
					dates.push(date)
				}
				return dates;
			}

			function getMutu(nilai) {
				let mutu = "NULL";
				if (nilai >= 80) {
					mutu = 'A';
				} else if (nilai >= 75 && nilai < 80) {
					mutu = 'B+';
				} else if (nilai >= 70 && nilai < 75) {
					mutu = 'B';
				} else if (nilai >= 65 && nilai < 70) {
					mutu = 'C+';
				} else if (nilai >= 60 && nilai < 65) {
					mutu = 'C';
				} else if (nilai >= 50 && nilai < 60) {
					mutu = 'D+';
				} else if (nilai >= 40 && nilai < 50) {
					mutu = 'D';
				} else {
					mutu = 'E';
				}
				return mutu;
			}

			let table = $('#datatable-jadwal').DataTable({
				dom: 'Bfrtip',
				"ajax": {
					url: "<?php echo site_url('seminar?m=rekap_akhir') ?>",
					type: "POST",
					data: {
						"ajax": true
					}
				},
				responsive: true,
				buttons: [
					'excel', 'pdf', 'print'
				],
				"columns": [
					{"data": "nim"},
					{"data": "nama_mahasiswa"},
					{"data": "perusahaan"},
					{"data": "judul"},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							var tanggal = data.split('T');
							return tanggal[0];
						}
					},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							let mulai = data.split('T');
							let berakhir = row.berakhir.split('T');
							return mulai[1].substr(0, 5) + ' - ' + berakhir[1].substr(0, 5);
						}
					},
					{"data": "tempat"},
					{"data": "pembimbing"},
					{"data": "penguji_1"},
					{"data": "penguji_2"},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							if (row.status_pemberkasan !== 'approve') {
								return "0"
							}
							if (row.detail.length === 3) {
								let nilai = row.detail;
								let nilai_total = 0;
								let nilai_dosen = 0;
								let nilai_perusahaan = row.nilai_perusahaan;
								nilai.forEach(function (item) {
									if (item.status === 'Pembimbing') {
										nilai_dosen = (parseFloat(item.nilai_1) * 30) / 100;
									} else {
										nilai_dosen = (parseFloat(item.nilai_1) * 10) / 100;
									}
									nilai_total += parseFloat(nilai_dosen)
								})
								nilai_perusahaan = (parseFloat(nilai_perusahaan) * 50) / 100;
								nilai_total += nilai_perusahaan;
								return nilai_total.toFixed(2);
							} else if (row.detail.length > 3) {
								return "Nilai terdobel"
							} else {
								return "0"
							}
						}
					},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							//TODO:dinamis waktu limit
							if (row.status_pemberkasan !== 'approve') {
								return "E"
							}
							if (row.detail.length === 3) {
								let nilai = row.detail;
								let nilai_total = 0;
								let nilai_dosen = 0;
								let nilai_perusahaan = row.nilai_perusahaan;
								nilai.forEach(function (item) {
									if (item.status === 'Pembimbing') {
										nilai_dosen = (parseFloat(item.nilai_1) * 30) / 100;
									} else {
										nilai_dosen = (parseFloat(item.nilai_1) * 10) / 100;
									}
									nilai_total += parseFloat(nilai_dosen)
								})
								nilai_perusahaan = (parseFloat(nilai_perusahaan) * 50) / 100;
								nilai_total += nilai_perusahaan;
								return getMutu(nilai_total);
							} else if (row.detail.length > 3) {
								return "Nilai terdobel"
							} else {
								return "E"
							}
						}
					},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							//TODO:dinamis waktu limit
							if (row.status_pemberkasan !== 'approve') {
								return "Belum Melakukan Pemberkasan"
							}
							if (row.detail.length !== 0) {
								let scheduleTime = new Date(data);
								let detailSorted = row.detail.sort(function (a, b) {
									if (isFinite(new Date(b.tanggal_revisi) - new Date(a.tanggal_revisi))) {
										return new Date(b.tanggal_revisi) - new Date(a.tanggal_revisi);
									} else {
										return isFinite(new Date(a.tanggal_revisi)) ? -1 : 1;
									}
								});
								let Info = "Masih Proses";
								let lamaRevisi = null;
								let finalRevDate = null;
								if (detailSorted[0].tanggal_revisi !== "belum") {
									finalRevDate = new Date(detailSorted[0].tanggal_revisi);
									lamaRevisi = finalRevDate.workingDaysFrom(scheduleTime);
								} else if (detailSorted[0].tanggal_revisi === "belum") {
									finalRevDate = new Date("<?php echo date("Y-m-d") ?>");
									lamaRevisi = finalRevDate.workingDaysFrom(scheduleTime);
								}
								//kurangi hari karena di hitung tanggal besok setelah seminar
								lamaRevisi = lamaRevisi - 1;
								if (finalRevDate != null) {
									if (parseInt(lamaRevisi) > 8) {
										Info = "Terlambat";
									} else {
										Info = "Tepat Waktu";
									}
								}
								let tanggal_upload = row.tanggal_pemberkasan;
								let new_upload_date = new Date(tanggal_upload);
								let lamaPemberkasan = new_upload_date.workingDaysFrom(finalRevDate);
								let statusPemberkasan = lamaPemberkasan < 8 ? "Tepat Waktu" : "Terlambat"
								return "<ul>" +
									"<li>Status Revisi = " + Info + "</li>" +
									"<li>Lama Revisi = " + lamaRevisi + "</li>" +
									"<li>Status Pemberkasan = " + statusPemberkasan + "</li>" +
									"<li>Lama Pemberkasan = " + lamaPemberkasan + "</li>" +
									"</ul>";
							} else {
								return ""
							}
						}
					},
				],
				"order": [[1, 'asc'], [3, 'asc']],
				language: {
					paginate: {
						previous: "<i class='fas fa-angle-left'>",
						next: "<i class='fas fa-angle-right'>"
					}
				},
				rowCallback: function (row, data, index) {
					// console.log(data)
					//take first array, cz every company have mahasiswa intern. another company with zero mahasiswa, already filter on server side
					if (data.detail.length !== 3) {
						$(row).addClass('text-white bg-dark');
					}
				}
			})
				.on('init.dt', function () {
					$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
				});

			function ajaxRefresh() {
				console.log('auto refresh');
				table.ajax.reload(null, false);
			}

			let Interval = 0;
			$('#switch-realtime').on('change', function () {
				let switchAuto = $(this).prop('checked');
				console.log(switchAuto);
				if (switchAuto === false) {
					clearInterval(Interval);
				} else {
					Interval = setInterval(ajaxRefresh, 5000);
				}
			})
			$('#datatable-jadwal tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = table.row(tr);

				if (row.child.isShown()) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				} else {
					// Open this row
					row.child(format(row.data())).show();
					tr.addClass('shown');
				}
			});
		})

	</script>
</body>
</html>

