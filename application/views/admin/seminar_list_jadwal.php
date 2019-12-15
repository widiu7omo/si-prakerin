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
							<div class="h3">Jadwal seminar mahasiswa</div>
						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-flush" id="datatable-jadwal">
									<thead class="thead-light">
									<tr>
										<th>Nama Mahasiswa</th>
										<th>Tempat</th>
										<th>Tanggal</th>
										<th>Waktu</th>
										<th>Pembimbing</th>
										<th>Penguji 1</th>
										<th>Penguji 2</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>Nama Mahasiswa</th>
										<th>Tempat</th>
										<th>Tanggal</th>
										<th>Waktu</th>
										<th>Pembimbing</th>
										<th>Penguji 1</th>
										<th>Penguji 2</th>
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
				url: "<?php echo site_url("seminar?m=data") ?>",
				type: "POST",
				data: {
					"ajax": "true"
				}
			},
			buttons: [
				'excel', 'pdf', 'print'
			],
			"order": [[ 2, 'asc' ]],
			columns: [
				{"data": "title"},
				{"data": "nama_tempat"},
				{"data": "start",
				"render":function(data,type,row){
					return moment(data).locale('id').format('DD-MM-YYYY');
				}},
				{"data": null,
				"render":function(data,type,row){
					let start = moment(row.start).locale('id').format('HH:mm');
					let end = moment(row.end).locale('id').format('HH:mm');
					return start+" - "+end;
				}},
				{"data": "nama_pembimbing"},
				{"data": "p1"},
				{"data": "p2"},
			]
		}).on('init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
		});
	</script>
</body>
</html>
