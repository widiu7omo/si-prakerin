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
						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-flush" id="datatable-jadwal">
									<thead class="thead-light">
									<tr>
										<th>Nama Mahasiswa</th>
										<th>Nama Dosen</th>
										<th>Sebagai</th>
										<th>Nilai Seminar</th>
										<th>Nilai Revisi</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>Nama Mahasiswa</th>
										<th>Nama Dosen</th>
										<th>Sebagai</th>
										<th>Nilai Seminar</th>
										<th>Nilai Revisi</th>
									</tr>
									</tfoot>
									<tbody></tbody>
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
		let t = $('#datatable-jadwal').dataTable({
			dom: 'Bfrtip',
			language: {
				paginate: {
					previous: "<i class='fas fa-angle-left'>",
					next: "<i class='fas fa-angle-right'>"
				}
			},
			ajax: {
				url: "<?php echo site_url("seminar?m=data_penilaian") ?>",
				type: "POST",
				data: {
					"ajax": "true"
				}
			},
			buttons: [
				'excel', 'pdf', 'print'
			],
			"order": [[0, 'asc']],
			columns: [
				{"data": "nama_mahasiswa"},
				{
					"data": null,
					"render": function (data, type, row) {
						if (row.status_dosen === 'p1') {
							return row.p1;
						} else if (row.status_dosen === 'p2') {
							return row.p2;
						} else {
							return row.p3
						}
					}
				},
				{
					"data": null,
					"render": function (data, type, row) {
						if (row.status_dosen === 'p1') {
							return 'Penguji 1';
						} else if (row.status_dosen === 'p2') {
							return 'Penguji 2';
						} else {
							return 'Pembimbing'
						}
					}
				},
				{
					"data": "nilai_seminar",
					"render": function (data, type, row) {
						return data !== null ? data : "Tidak ada penilaian"
					}
				},
				{
					"data": "nilai_seminar_past",
					"render": function (data, type, row) {
						return data !== null ? data : "Tidak ada penilaian"
					}
				}
			]
		}).on('init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
		});
		setInterval( function () {
			console.log(t)
			t.api().ajax.reload(null, false );
		}, 5000 );
	</script>
</body>
</html>

