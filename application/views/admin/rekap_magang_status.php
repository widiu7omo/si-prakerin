<?php $section = isset($_GET['section']) ? $_GET['section'] : null ?>
<?php $prodies = isset($prodies) ? $prodies : array() ?>
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
				<?php foreach ($prodies as $prody): ?>
					<div class="col-md-4 col-lg-4 col-sm-6">
						<div class="card">
							<div class="card-header pb-1 pt-3">
								<div class="h4" id="title-<?php echo $prody->id_program_studi ?>"></div>
							</div>
							<div class="card-body">
								<canvas id="<?php echo $prody->id_program_studi ?>"></canvas>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<div class="h3">Status Mahasiswa Magang</div>
							<form action="<?php echo site_url('rekap?m=magang_status') ?>" method="POST">
								<div class="float-right btn-group" role="group" aria-label="Basic example">
									<button type="submit" name="prodi" value="all" class="btn btn-sm btn-primary <?php echo (!isset($_POST['prodi']) or $_POST['prodi']=='all')?'active':null ?>">Semua</button>
									<?php $pr = masterdata('tb_program_studi', null, 'alias,id_program_studi'); ?>
									<?php foreach ($pr as $p): ?>
										<button type="submit" name="prodi" value="<?php echo $p->id_program_studi ?>"
												class="btn btn-sm btn-primary <?php echo $p->id_program_studi == $_POST['prodi']?"active":null?>"><?php echo $p->alias ?></button>
									<?php endforeach; ?>
								</div>
							</form>

						</div>
						<div class="card-body">
							<div class="table-responsive py-0">
								<table class="table table-flush" id="datatable-jadwal">
									<thead class="thead-light">
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Program Studi</th>
										<th>Status</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>NIM</th>
										<th>Nama Mahasiswa</th>
										<th>Program Studi</th>
										<th>Status</th>
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
		var invoice_status_data = {};

		function invoice_status_chart(prodi, nameProdi) {
			$.ajax({
				url: "<?php echo site_url('rekap?m=magang_status') ?>",
				dataType: "json",
				method: "post",
				data: {ajax: true, prodi: prodi},
				success: function (data) {
					$('#title-' + prodi).text(nameProdi);
					let ctx = $("#" + prodi).get(0).getContext('2d');
					let chart = new Chart(ctx, {
						type: 'pie',
						data: {
							datasets: [{
								data: [data.chart.sudah, data.chart.belum],
								backgroundColor: ['#2dce89', '#fb6340'],
								label: prodi
							}],
							labels: ['Sudah', 'Belum'],
						},

						options: {
							responsive: true
						}
					});
				}
			})

		}
		<?php foreach ($prodies as $key=> $prody): ?>
		invoice_status_chart("<?php echo $prody->id_program_studi ?>", "<?php echo $prody->nama_program_studi ?>");
		<?php endforeach; ?>
		let t = $('#datatable-jadwal').dataTable({
			dom: 'Bfrtip',
			language: {
				paginate: {
					previous: "<i class='fas fa-angle-left'>",
					next: "<i class='fas fa-angle-right'>"
				}
			},
			ajax: {
				url: "<?php echo site_url("rekap?m=magang_status") ?>",
				type: "POST",
				data: {
					"ajax": "true",
					"prodi":"<?php echo !isset($_POST['prodi'])?'all':$_POST['prodi'] ?>"
				}
			},
			buttons: [
				'excel', 'pdf', 'print'
			],
			"order": [[0, 'asc']],
			columns: [
				{"data": "nim"},
				{"data": "nama_mahasiswa"},
				{"data": "nama_program_studi"},
				{
					"data": "status",
					"render": function (data, type, row) {
						return data === "0" ? "Belum mendapatkan tempat magang" : "Sudah mendapatkan tempat magang";
					}
				},
			],
			rowCallback: function (row, data, index) {
				if (data.status === '1') {
					$(row).addClass('text-white bg-success');
				}
			}
		}).on('init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
		});
	</script>
</body>
</html>
