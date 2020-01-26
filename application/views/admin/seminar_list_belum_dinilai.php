<?php $section = isset($_GET['section']) ? $_GET['section'] : null ?>
<?php $belum_dinilai = isset($belum_dinilai) ? $belum_dinilai : array(); ?>
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
							<div class="h3">Mahasiswa Belum dinilai per tanggal
								< <?php echo convert_date(date('Y-m-d')) ?></div>
							<div class="text-right">
								<a href="<?php echo site_url('seminar?m=data_penilaian') ?>"
								   class="btn btn-sm btn-primary">Sudah dinilai</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-flush" id="datatable-jadwal">
									<thead class="thead-light">
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Ruangan</th>
										<th>Waktu Seminar</th>
										<th>Nama Pembimbing</th>
										<th>Nama Penguji 1</th>
										<th>Nama Penguji 2</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Ruangan</th>
										<th>Waktu Seminar</th>
										<th>Nama Pembimbing</th>
										<th>Nama Penguji 1</th>
										<th>Nama Penguji 2</th>
									</tr>
									</tfoot>
									<tbody>
									<?php foreach ($belum_dinilai as $item): ?>
										<tr>
											<td><?php echo $item->nim ?></td>
											<td><?php echo $item->nama_mahasiswa ?></td>
											<td><?php echo $item->nama_tempat ?></td>
											<td><?php echo convert_date(get_time_range($item->START, $item->END, 'datestart'), 'long') ?>
												Pukul <?php echo substr(get_time_range($item->START, $item->END, 'start'), 0, 5) ?></td>
											<td><?php echo $item->p3 ?></td>
											<td><?php echo $item->p1 ?></td>
											<td><?php echo $item->p2 ?></td>
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
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/modal.php'); ?>
	<?php $this->load->view('admin/_partials/js.php'); ?>
	<script>
		function format(value) {
			return '<div>Hidden Value: ' + value + '</div>';
		}

		let t = $('#datatable-jadwal').dataTable({
			dom: 'Bfrtip',
			language: {
				paginate: {
					previous: "<i class='fas fa-angle-left'>",
					next: "<i class='fas fa-angle-right'>"
				}
			},
			buttons: [],
			"order": [[3, 'asc'],[2,'asc']],
			columnsDefs: [
				{
					"targets": [2],
					"visible": false,
				},
				{
					"targets": [3],
					"visible": false
				}
			]
		}).on('init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
		});
	</script>
</body>
</html>

