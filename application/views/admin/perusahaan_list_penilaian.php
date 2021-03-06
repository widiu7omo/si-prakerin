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
							<div class="d-flex justify-content-between">
								<div class="h3">Nilai Prakerin Perusahaan</div>
								<?php if (isset($_GET['filter'])): ?>
									<a href="<?php echo site_url('perusahaan?m=penilaian') ?>"
									   class="btn btn-sm btn-primary">Sudah mengisi penilaian</a>
								<?php else: ?>
									<a href="<?php echo site_url('perusahaan?m=penilaian&filter=belum') ?>"
									   class="btn btn-sm btn-primary">Belum mengisi penilaian</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-flush" id="datatable-jadwal">
									<thead class="thead-light">
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Pembimbing</th>
										<th>Total Nilai</th>
										<th>Detail Nilai</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Pembimbing</th>
										<th>Total Nilai</th>
										<th>Detail Nilai</th>
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
	<?php $uri = site_url('perusahaan?m=penilaian');
	$uri = isset($_GET['filter']) ? $uri . "&filter=belum" : $uri;
	?>
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
				url: "<?php echo $uri?>",
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
				{"data": "nim"},
				{"data": "nama_mahasiswa"},
				{"data": "nama_pembimbing"},
				{"data": "nilai_pkl"},
				{
					"data": "detail_nilai_pkl",
					"render": function (data) {
						let encodedData = JSON.parse(data);
						let lists = encodedData.map(function (item) {
							return '<li><span>' + item.name + '</span> : <span>' + item.res + '</span></li>'
						});
						return '<ul>' + lists.join(" ") + '</ul>';
					}
				},
			]
		}).on('init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
		});
	</script>
</body>
</html>
