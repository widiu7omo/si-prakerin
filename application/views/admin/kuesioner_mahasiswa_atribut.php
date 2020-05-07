<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php $this->load->view('admin/_partials/header.php'); ?>
<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
<?php $prodies = masterdata('tb_program_studi', null, '*') ?>
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
		<!-- Table -->
		<div class="row mb-2">
			<div class="col">
				<ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
					<li class="nav-item">
						<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'kriteria' ? 'active' : null ?>"
						   id="tabs-text-1-tab"
						   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=kriteria') ?>" role="tab"
						   aria-controls="tabs-text-1" aria-selected="true">Kriteria</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'pertanyaan' ? 'active' : null ?>"
						   id="tabs-text-2-tab"
						   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=pertanyaan') ?>"
						   role="tab" aria-controls="tabs-text-2" aria-selected="false">Pertanyaan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'bobot' ? 'active' : null ?>"
						   id="tabs-text-3-tab"
						   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=bobot') ?>"
						   role="tab" aria-controls="tabs-text-3" aria-selected="false">Bobot</a>
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
			<div class="col">
				<?php if ($this->input->get('sec') == 'kriteria'): ?>
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<div>
								<h3 class="mb-0">Kelola Data Kriteria</h3>
							</div>
							<a href="#" class="btn btn-primary btn-sm" id="headingTwo" data-toggle="collapse"
							   data-target="#collapseKriteria" aria-expanded="true"
							   aria-controls="collapseOne">Tambah</a>
						</div>
						<div class="accordion" id="accordionExample1">
							<div class="card">
								<div id="collapseKriteria"
									 class="collapse <?php echo isset($kriteria[0]->id_master_level) ? 'show' : null ?>"
									 aria-labelledby="headingTwo"
									 data-parent="#accordionExample1">
									<div class="card-body">
										<form action="<?php echo site_url(!isset($kriteria[0]->id) ? 'kuesioner?m=mahasiswa&sec=kriteria&q=i' : 'kuesioner?m=mahasiswa&sec=kriteria&q=u') ?>"
											  method="POST">
											<input type="hidden" name="id"
												   value="<?php echo isset($kriteria[0]->id) ? $kriteria[0]->id : null ?>">
											<div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control"
														   name="kriteria" placeholder="Nama Kriteria"
														   aria-label="Nama Kriteria" aria-describedby="basic-addon1"
														   value="<?php echo isset($kriteria[0]->kriteria) ? $kriteria[0]->kriteria : null ?>">
												</div>
											</div>

											<select name="id_master_level" class="form-control" data-toggle="select"
													title="Level Kriteria" data-live-search="true"
													data-live-search-placeholder="Search ...">
												<option>Pilih Level Kriteria</option>
												<?php foreach (isset($master_level) ? $master_level : [] as $level): ?>
													<option <?php
													$current_id_level = isset($kriteria[0]->id_master_level) ? $kriteria[0]->id_master_level : 0;
													echo $current_id_level == $level->id_master_level ? "selected" : null ?>
															value="<?php echo $level->id_master_level ?>"><?php echo ucfirst($level->nama_master_level) ?></option>
												<?php endforeach; ?>
											</select>
											<button class="btn btn-primary btn-sm mt-3" type="submit">
												Simpan
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="table-responsive py-4">
								<table class="table table-flush compact" id="datatable-mhs-kriteria" style="width:100%">
									<thead class="thead-light">
									<tr role="row">
										<th>Aksi</th>
										<th>No</th>
										<th>Kriteria</th>
										<th>Pengguna Kriteria</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach (isset($rows) ? $rows : [] as $i => $row): ?>
										<tr>
											<td>
												<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
												   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fas fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
													<a class="dropdown-item"
													   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=kriteria&q=s&id=' . $row->id) ?>">Edit</a>
													<a class="dropdown-item" href="#"
													   onclick="deleteConfirm('<?php echo site_url('kuesioner?m=mahasiswa&sec=kriteria&q=d&id=' . $row->id) ?>')">Hapus</a>
												</div>
											</td>
											<td><?php echo $i + 1 ?></td>
											<td><?php echo $row->kriteria ?></td>
											<td><?php echo ucfirst($row->nama_master_level) ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php elseif ($this->input->get('sec') == 'pertanyaan'): ?>
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<div>
								<h3 class="mb-0">Kelola Data Pertanyaan</h3>
							</div>
							<a href="#" class="btn btn-primary btn-sm" id="headingTwo" data-toggle="collapse"
							   data-target="#collapsePertanyaan" aria-expanded="true"
							   aria-controls="collapseOne">Tambah</a>
						</div>
						<div class="accordion" id="accordionExample1">
							<div class="card">
								<div id="collapsePertanyaan"
									 class="collapse <?php echo isset($pertanyaan[0]->id) ? 'show' : null ?>"
									 aria-labelledby="headingTwo"
									 data-parent="#accordionExample1">
									<div class="card-body">
										<form action="<?php echo site_url(!isset($pertanyaan[0]->id) ? 'kuesioner?m=mahasiswa&sec=pertanyaan&q=i' : 'kuesioner?m=mahasiswa&sec=pertanyaan&q=u') ?>"
											  method="POST">
											<input type="hidden" name="id"
												   value="<?php echo isset($pertanyaan[0]->id) ? $pertanyaan[0]->id : null ?>">
											<div class="form-group">
												<div class="input-group">
													<textarea type="text" class="form-control"
															  name="pertanyaan" placeholder="Pertanyaan"
															  aria-label="Pertanyaan"
															  rows="4"
															  aria-describedby="basic-addon1"><?php echo isset($pertanyaan[0]->pertanyaan) ? $pertanyaan[0]->pertanyaan : null ?></textarea>
												</div>
											</div>

											<select name="id_kriteria" class="form-control" data-toggle="select"
													title="Nama Kriteria" data-live-search="true"
													data-live-search-placeholder="Search ...">
												<option>Pilih Nama Kriteria</option>
												<?php foreach (isset($kriteria) ? $kriteria : [] as $kr): ?>
													<option <?php
													$current_id_kriteria = isset($pertanyaan[0]->id_kriteria) ? $pertanyaan[0]->id_kriteria : 0;
													echo $current_id_kriteria == $kr->id ? "selected" : null ?>
															value="<?php echo $kr->id ?>"><?php echo ucfirst($kr->kriteria) ?></option>
												<?php endforeach; ?>
											</select>
											<button class="btn btn-primary btn-sm mt-3" type="submit">
												Simpan
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="table-responsive py-4">
								<table class="table compact" id="datatable-mhs-pertanyaan" style="width:100%">
									<thead class="thead-light">
									<tr role="row">
										<th>Aksi</th>
										<th>No</th>
										<th>Pertanyaan</th>
										<th>Kriteria</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach (isset($rows) ? $rows : [] as $i => $row): ?>
										<tr>
											<td>
												<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
												   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fas fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
													<a class="dropdown-item"
													   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=pertanyaan&q=s&id=' . $row->id) ?>">Edit</a>
													<a class="dropdown-item" href="#"
													   onclick="deleteConfirm('<?php echo site_url('kuesioner?m=mahasiswa&sec=pertanyaan&q=d&id=' . $row->id) ?>')">Hapus</a>
												</div>
											</td>
											<td><?php echo $i + 1 ?></td>
											<td><?php echo $row->pertanyaan ?></td>
											<td><?php echo $row->kriteria ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<div>
								<h3 class="mb-0">Kelola Data Bobot</h3>
							</div>
							<a href="#" class="btn btn-primary btn-sm" id="headingTwo" data-toggle="collapse"
							   data-target="#collapseBobot" aria-expanded="true"
							   aria-controls="collapseOne">Tambah</a>
						</div>
						<div class="accordion" id="accordionExample1">
							<div class="card">
								<div id="collapseBobot"
									 class="collapse <?php echo isset($bobot[0]->id_master_level) ? 'show' : null ?>"
									 aria-labelledby="headingTwo"
									 data-parent="#accordionExample1">
									<div class="card-body">
										<form action="<?php echo site_url(!isset($bobot[0]->id) ? 'kuesioner?m=mahasiswa&sec=bobot&q=i' : 'kuesioner?m=mahasiswa&sec=bobot&q=u') ?>"
											  method="POST">
											<input type="hidden" name="id"
												   value="<?php echo isset($bobot[0]->id) ? $bobot[0]->id : null ?>">
											<div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control"
														   name="bobot" placeholder="Nilai Bobot Pertanyaan"
														   aria-label="Nama Kriteria" aria-describedby="basic-addon1"
														   value="<?php echo isset($bobot[0]->bobot) ? $bobot[0]->bobot : null ?>">
												</div>
											</div>

											<select name="id_master_level" class="form-control" data-toggle="select"
													title="Level Kriteria" data-live-search="true"
													data-live-search-placeholder="Search ...">
												<option>Pilih Level Kriteria</option>
												<?php foreach (isset($master_level) ? $master_level : [] as $level): ?>
													<option <?php
													$current_id_level = isset($bobot[0]->id_master_level) ? $bobot[0]->id_master_level : 0;
													echo $current_id_level == $level->id_master_level ? "selected" : null ?>
															value="<?php echo $level->id_master_level ?>"><?php echo ucfirst($level->nama_master_level) ?></option>
												<?php endforeach; ?>
											</select>
											<button class="btn btn-primary btn-sm mt-3" type="submit">
												Simpan
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="table-responsive py-4">
								<table class="table table-flush compact" id="datatable-mhs-bobot">
									<thead class="thead-light">
									<tr role="row">
										<th>Aksi</th>
										<th>No</th>
										<th>Nilai Bobot</th>
										<th>Pengguna Bobot</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach (isset($rows) ? $rows : [] as $i => $row): ?>
										<tr>
											<td>
												<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
												   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fas fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
													<a class="dropdown-item"
													   href="<?php echo site_url('kuesioner?m=mahasiswa&sec=bobot&q=s&id=' . $row->id) ?>">Edit</a>
													<a class="dropdown-item" href="#"
													   onclick="deleteConfirm('<?php echo site_url('kuesioner?m=mahasiswa&sec=bobot&q=d&id=' . $row->id) ?>')">Hapus</a>
												</div>
											</td>
											<td><?php echo $i + 1 ?></td>
											<td><?php echo $row->bobot ?></td>
											<td><?php echo ucfirst($row->nama_master_level) ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>

</div>
<?php $this->load->view('admin/_partials/status.php'); ?>
<?php $this->load->view('admin/_partials/modal.php'); ?>

<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php'); ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
<script>
	$('#datatable-mhs-bobot').dataTable({});
	$('#datatable-mhs-pertanyaan').dataTable({});
	$('#datatable-mhs-kriteria').dataTable({});
</script>
</body>

</html>
