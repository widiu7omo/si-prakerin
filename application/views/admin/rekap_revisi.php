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
							<div class="h3">Penilaian Revisi Mahasiswa</div>
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
							<div>Keterangan :</div>
							<button class="btn btn-sm btn-dark"></button>
							<span><small>Penilaian seminar belum lengkap</small></span>
							<div class="table-responsive py-0">
								<table class="table table-striped dt-responsive nowrap" id="datatable-jadwal">
									<thead class="thead-light">
									<tr role="row">
										<th>Detail</th>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Status Revisi</th>
										<th>Tanggal Seminar</th>
										<th>Program Studi</th>
										<th>Lama Revisi (Hari Kerja)</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>Detail</th>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Status Revisi</th>
										<th>Tanggal Seminar</th>
										<th>Program Studi</th>
										<th>Lama Revisi (Hari Kerja)</th>
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
				return "<tr>" +
					"<td>" +
					addInfo +
					"<h3>Detail Penilaian Revisi</h3>" +
					detailHtml.join("") +
					"</td>" +
					"</tr>";
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

			let table = $('#datatable-jadwal').DataTable({
				"ajax": {
					url: "<?php echo site_url('seminar?m=revisi') ?>",
					type: "POST",
					data: {
						"ajax": true
					}
				},
				responsive:true,
				buttons: [
					'excel', 'pdf', 'print'
				],
				"bLengthChange": false,
				"render": function (data, type, full, meta) {

				},
				"columns": [
					{
						"className": 'details-control',
						"orderable": false,
						"data": null,
						"defaultContent": ' Detail'
					},
					{"data": "nim"},
					{"data": "nama_mahasiswa"},
					{
						"data": "nama_mahasiswa",
						"render": function (data, type, row) {
							if (row.detail.length == 0) {
								return "Belum ada detail penilaian";
							} else {
								let arrBelum = []
								row.detail.map(function (item) {
									arrBelum.push(item.nilai_2);
								});
								if (arrBelum.includes("belum")) {
									return "Revisi Belum Lengkap"
								} else {
									return "Sudah Revisi"
								}
							}
						}
					},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							let datetime = data.split("T");
							return datetime[0];
						}
					},
					{
						"data": "id",
						"render": function (data, type, row) {
							if (row.detail.length != 0) {
								return row.detail[0].program_studi
							} else {
								return "NULL Detail"
							}
						}
					},
					{
						"data": "mulai",
						"render": function (data, type, row) {
							//TODO:dinamis waktu limit
							if (row.detail.length !== 0) {
								let scheduleTime = new Date(data);
								let detailSorted = row.detail.sort(function (a, b) {
									if(isFinite(new Date(b.tanggal_revisi) - new Date(a.tanggal_revisi))) {
										return new Date(b.tanggal_revisi) - new Date(a.tanggal_revisi);
									} else {
										return isFinite(new Date(a.tanggal_revisi)) ? -1 : 1;
									}
								});
								let Info = "Masih Proses";
								let lamaRevisi = null;
								let finalRevDate = null;
								console.log(detailSorted);
								if (detailSorted[0].tanggal_revisi !== "belum") {
									finalRevDate = new Date(detailSorted[0].tanggal_revisi);
									lamaRevisi = finalRevDate.workingDaysFrom(scheduleTime);
								}
								else if(detailSorted[0].tanggal_revisi === "belum") {
									finalRevDate = new Date("<?php echo date("Y-m-d") ?>");
									lamaRevisi = finalRevDate.workingDaysFrom(scheduleTime);
								}
								if (finalRevDate != null) {
									if (parseInt(lamaRevisi) > 8) {
										Info = "Terlambat";
									} else {
										Info = "Tepat Waktu";
									}
								}
								return "<div>Status Revisi = " + Info + "</div><div> Lama Revisi = " + lamaRevisi + "</div>";
							} else {
								return "NULL Detail"
							}
						}
					},

					// { "data": "mahasiswa.[0].tanggal_pengajuan", "visible": false}
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

