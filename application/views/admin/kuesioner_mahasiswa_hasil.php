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
			<div class="row mb-2">
				<div class="col">
					<ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
						<li class="nav-item">
							<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'hasil' ? 'active' : null ?>"
							   id="tabs-text-1-tab"
							   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=hasil') ?>" role="tab"
							   aria-controls="tabs-text-1" aria-selected="true">Jawaban Responder</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'rekap' ? 'active' : null ?>"
							   id="tabs-text-2-tab"
							   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=rekap') ?>"
							   role="tab" aria-controls="tabs-text-2" aria-selected="false">Rekap per kriteria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'topsis' ? 'active' : null ?>"
							   id="tabs-text-2-tab"
							   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=topsis') ?>"
							   role="tab" aria-controls="tabs-text-2" aria-selected="false">Topsis</a>
						</li>
					</ul>
				</div>
			</div>
			<?php if ($this->session->flashdata('status')): ?>
				<?php $status = $this->session->flashdata('status') ?>
				<div class="alert alert-<?php echo $status['color'] ?> alert-dismissible fade show" role="alert">
					<span class="alert-icon"><i class="ni ni-like-2"></i></span>
					<span class="alert-text"><?php echo $status['message']; ?></span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12">
					<?php if ($this->input->get('sec') == 'hasil'): ?>
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<div>
									<h3 class="mb-0">Hasil Responder</h3>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="table-responsive py-4">
									<table class="display table table-bordered" id="datatable-mhs-hasil"
										   style="width:100%">
										<thead class="thead-light">
										<tr role="row">
											<th>No</th>
											<th>Perusahaan</th>
											<th>Nilai Responder</th>
											<th>Pertanyaan</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php elseif ($this->input->get('sec') == 'rekap'): ?>
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<div>
									<h3 class="mb-0">Rekap Hasil Responder</h3>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="table-responsive py-4">
									<table class="display table table-bordered" id="datatable-mhs-rekap"
										   style="width:100%">
										<thead class="thead-light">
										<tr role="row">
											<th>No</th>
											<th>Perusahaan</th>
											<th>Kriteria dan Nilai</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php elseif ($this->input->get('sec') == 'topsis'): ?>
						<div class="card">
							<div class="card-header d-flex justify-content-between">
								<div>
									<h3 class="mb-0">Hasil perhitungan topsis</h3>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="table-responsive py-4">
									<table class="display table table-bordered" id="datatable-mhs-topsis"
										   style="width:100%">
										<thead class="thead-light">
										<tr role="row">
											<th>Peringkat</th>
											<th>Perusahaan</th>
											<th>Hasil Topsis</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php endif ?>
				</div>
				<!-- Footer PHP -->
				<?php $this->load->view('admin/_partials/footer.php'); ?>
			</div>
		</div>
		<!-- Scripts PHP-->
		<?php $this->load->view('admin/_partials/modal.php'); ?>
		<?php $this->load->view('admin/_partials/js.php'); ?>
		<?php
		//	require APPPATH."libraries/hotreloader.php";
		//	$reloader = new HotReloader();
		//	$reloader->setRoot(__DIR__);
		//	$reloader->currentConfig();
		//	$reloader->init();
		?>
		<script>
			$('#datatable-mhs-hasil').dataTable({
				ajax: '/kuesioner/jawaban_hasil',
				scrollY: 400,
				deferRender: true,
				scroller: true,
				"columns": [
					{"data": "no"},
					{
						"data": "nama_perusahaan",
						"render": function (data) {
							let splited = data.split(" ");
							let firstSen, secondSen;
							if (splited.length % 2 === 0) {
								firstSen = splited.slice(0, splited.length / 2);
								secondSen = splited.slice(splited.length / 2, splited.length);
							} else {
								let sendLeng = splited.length - 1;
								firstSen = splited.slice(0, sendLeng / 2);
								secondSen = splited.slice(sendLeng / 2, sendLeng);
							}
							return firstSen.join(" ") + "<br>" + secondSen.join(" ");
						}
					},
					{"data": "bobot"},
					{
						"data": "pertanyaan",
						"render": function (data) {
							let splited = data.split(" ");
							let firstSen, secondSen;
							if (splited.length % 2 === 0) {
								firstSen = splited.slice(0, splited.length / 2);
								secondSen = splited.slice(splited.length / 2, splited.length);
							} else {
								let sendLeng = splited.length - 1;
								firstSen = splited.slice(0, sendLeng / 2);
								secondSen = splited.slice(sendLeng / 2, sendLeng);
							}
							return firstSen.join(" ") + "<br>" + secondSen.join(" ");
						}
					},
				]
			})
			$('#datatable-mhs-rekap').dataTable({
				ajax: '/kuesioner/jawaban_rekap',
				scrollY: 400,
				deferRender: true,
				scroller: true,
				"columns": [
					{"data": "no"},
					{
						"data": "nama_perusahaan",
						"render": function (data) {
							let splited = data.split(" ");
							let firstSen, secondSen;
							if (splited.length % 2 === 0) {
								firstSen = splited.slice(0, splited.length / 2);
								secondSen = splited.slice(splited.length / 2, splited.length);
							} else {
								let sendLeng = splited.length - 1;
								firstSen = splited.slice(0, sendLeng / 2);
								secondSen = splited.slice(sendLeng / 2, sendLeng);
							}
							return firstSen.join(" ") + "<br>" + secondSen.join(" ");
						}
					},
					{
						"data": "kriteria",
						"render": function (item) {
							let htmlItem = "";
							item.forEach(function (item) {
								htmlItem += "<p>" + item.kriteria + "</p><ul>" +
										"<li>Total Bobot : " + item.total_bobot + "</li>" +
										"<li>Rata-rata : " + item.average + "</li>" +
										"</ul>";
							})
							return htmlItem;
						}
					}]
			})
			$('#datatable-mhs-topsis').dataTable({
				ajax: '/kuesioner/hasil_topsis_mahasiswa',
				scrollY: 400,
				deferRender: true,
				scroller: true,
				"columns": [
					{"data": "no"},
					{
						"data": "nama_perusahaan",
						"render": function (data) {
							let splited = data.split(" ");
							let firstSen, secondSen;
							if (splited.length % 2 === 0) {
								firstSen = splited.slice(0, splited.length / 2);
								secondSen = splited.slice(splited.length / 2, splited.length);
							} else {
								let sendLeng = splited.length - 1;
								firstSen = splited.slice(0, sendLeng / 2);
								secondSen = splited.slice(sendLeng / 2, sendLeng);
							}
							return firstSen.join(" ") + "<br>" + secondSen.join(" ");
						}
					},
					{
						"data": "final_result"
					}]
			})
		</script>
		<!-- Demo JS - remove this in your project -->
		<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
