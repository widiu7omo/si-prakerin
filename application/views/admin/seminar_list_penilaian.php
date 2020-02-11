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
							<div class="h3">Penilaian Mahasiswa</div>
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
										<th>Detail</th>
										<th>Nama Mahasiswa</th>
										<th>Status Penilaian</th>
										<th>Tanggal Seminar</th>
										<th>Program Studi</th>
										<th>Judul Laporan</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>Detail</th>
										<th>Nama Mahasiswa</th>
										<th>Status Penilaian</th>
										<th>Tanggal Seminar</th>
										<th>Program Studi</th>
										<th>Judul Laporan</th>
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
		function format(d) {
			// `d` is the original data object for the row
			let nilai_pembimbing = d.penilaian_pembimbing == null ? "Belum dinilai" : d.penilaian_pembimbing;
			let nilai_penguji2 = d.penilaian_penguji2 === null ? "Belum dinilai" : d.penilaian_penguji2;
			let nilai_penguji1 = d.penilaian_penguji1 === null ? "Belum dinilai" : d.penilaian_penguji1;
			return "<tr>" +
				"<td>" +
				"<h3>Detail Penilaian</h3>" +
				"<h6>Pembimbing (" + d.p3 + ") = " + nilai_pembimbing + "</h6>" +
				"<h6>Penguji 1 (" + d.p1 + ") = " + nilai_penguji1 + "</h6>" +
				"<h6>Penguji 2 (" + d.p2 + ") = " + nilai_penguji2 + "</h6>" +
				"</td>" +
				"</tr>";
		}
		$(document).ready(function () {

			let table = $('#datatable-jadwal').DataTable({
				"ajax": {
					url: "<?php echo site_url('seminar?m=data_penilaian') ?>",
					type: "POST",
					data: {
						"ajax": true
					}
				},
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
					{"data": "nama_mahasiswa"},
					{
						"data": "nama_mahasiswa",
						"render": function (data, type, row) {
							if (row.penilaian_pembimbing === null || row.penilaian_penguji1 === null || row.penilaian_penguji2 === null) {
								return "Belum Lengkap";
							}
							return "Sudah Lengkap";
						}
					},
					{
						"data": "START",
						"render": function (data, type, row) {
							let datetime = data.split("T");
							return datetime[0];
						}
					},
					{"data": "nama_program_studi"},
					{
						"data": "laporan",
						"render": function (data, type, row) {
							return data.substr(0, 50) + "...";
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
					if (data.penilaian_pembimbing === null || data.penilaian_penguji1 === null || data.penilaian_penguji2 === null) {
						$(row).addClass('text-white bg-warning');
					} else {
						$(row).addClass('text-white bg-success');
					}
				}
			});
			function ajaxRefresh() {
				table.ajax.reload(null, false);
			}
			let Interval = 0;
			$('#switch-realtime').on('change', function () {
				let switchAuto = $(this).prop('checked');
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

