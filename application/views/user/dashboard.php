<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view('user/_partials/header.php'); ?>
<body class="g-sidenav-hidden">
<!-- Sidenav PHP-->
<?php $this->load->view('user/_partials/sidenav.php'); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view('user/_partials/topnav.php');
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view('user/_partials/breadcrumb.php'); ?>
	<!-- Page content -->
	<div class="container-fluid mt--6" data-step="1"
		 data-intro="Selamat datang di SIMP (Sistem Informasi Manajemen Prakerin)!">
		<div class="row">
			<div class="col-xl-4">
				<!-- Members list group card -->
				<?php foreach ($menus as $menu): ?>
					<div class="row">
						<div class="col-xl-12 col-lg-12">
							<div class="card card-stats mb-4 mb-xl-2">
								<a href="<?php echo $menu['href'] ?>">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="card-title text-uppercase text-muted mb-0"><?php echo $this->session->userdata('level') ?></h5>
												<span
													class="h2 font-weight-bold mb-0"><?php echo $menu['name'] ?></span>
											</div>
											<div class="col-auto">
												<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
													<i class="<?php echo $menu['icon'] ?>"></i>
												</div>
											</div>
										</div>
										<p class="mt-3 mb-0 text-muted text-sm">
											<span class="text-wrap"><?php echo $menu['desc'] ?></span>
										</p>
									</div>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="col-xl-8">
				<!-- Checklist -->
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<!-- Title -->
						<?php $level = $this->session->userdata('level'); ?>
						<?php if ($level === 'mahasiswa') : //mahasiswa?>
							<h5 class="h3 mb-0">Bimbinganmu</h5>
						<?php else: //dosen?>
							<h5 class="h3 mb-0">Daftar Mahasiswa Bimbingan</h5>
						<?php endif; ?>
					</div>
					<!-- Card body -->
					<div class="card-body p-0">
						<!-- List group -->
						<?php if ($level === 'mahasiswa') : //mahasiswa?>
							<p class="text-center text-sm">Berikut daftar bimbingan terakhirmu</p>
							<?php if (isset($latest_bimbingan)): ?>
								<?php if (count($latest_bimbingan) == 0) : ?>
									<div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											<span class="sr-only">Close</span>
										</button>
										<strong>Informasi</strong> Kalian bisa mengajukan sidang
										setelah <?php echo isset($latest_bimbingan) ? 4 - count($latest_bimbingan) : 0 ?>
										konsultasi
										lagi. <br>
										<small>Kalian harus konsultasi minimal <b>4 Kali</b> untuk bisa mengajukan
											sidang</small>
									</div>
								<?php endif; ?>
								<div style="max-height: 400px;overflow-x: scroll;-ms-overflow-x: scroll">
									<ul class="list-group list-group-flush" data-toggle="checklist">
										<?php foreach ($latest_bimbingan as $bimbingan): ?>
											<li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
												<div
													class="checklist-item checklist-item-<?php echo substr($bimbingan->tag, 3) ?> checklist-item-checked">
													<div class="checklist-info">
														<h5 class="checklist-title mb-0"><?php echo $bimbingan->title ?></h5>
														<small><?php echo $bimbingan->start ?></small>
														<small
															class="text-<?php echo $bimbingan->status !== null ? ($bimbingan->status == 'accept' ? 'success' : 'red') : 'warning' ?>"><b><?php echo $bimbingan->status !== null ? ($bimbingan->status == 'accept' ? 'Konsultasi Dikonfirmasi' : 'Konsultasi Ditolak') : 'Belum dikonsultasikan' ?></b></small>
													</div>
													<div>
														<div
															class="custom-control custom-checkbox custom-checkbox-success">
															<input class="custom-control-input" id="chk-todo-task-1"
																   disabled
																   type="checkbox" <?php echo $bimbingan->status !== NULL ? "checked" : null ?>>
															<label class="custom-control-label"
																   for="chk-todo-task-1"></label>
														</div>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
										<?php if (count($latest_bimbingan) == 0) : ?>
											<li class="list-group-item"><p class="h3">Belum mengajukan konsultasi</p>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							<?php else: ?>
								<div class="p-3"><p class="text-center text-lg">
										Belum mengajukan konsultasi</p></div>
							<?php endif; ?>
						<?php elseif ($level === 'dosen') : //dosen?>
							<?php if (isset($all_latest_bimbingan)): ?>
								<div style="max-height: 400px;overflow-x: scroll;-ms-overflow-x: scroll">
									<ul class="list-group list-group-flush" data-toggle="checklist">
										<?php foreach ($all_latest_bimbingan as $all_bimbingan): ?>
											<li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
												<div
													class="checklist-item checklist-item-<?php echo substr($all_bimbingan->tag, 3) ?> checklist-item-checked">
													<div class="checklist-info">
														<h5 class="checklist-title mb-0"><?php echo $all_bimbingan->title ?></h5>
														<small><?php echo $all_bimbingan->start ?></small>
														<small
															class="text-<?php echo $all_bimbingan->status !== null ? ($all_bimbingan->status == 'accept' ? 'success' : 'red') : 'warning' ?>"><b><?php echo $all_bimbingan->status !== null ? ($all_bimbingan->status == 'accept' ? 'Konsultasi Dikonfirmasi' : 'Konsultasi Ditolak') : 'Belum dikonsultasikan' ?></b></small>
													</div>
													<div>
														<h4 class="font-weight-400">Mahasiswa: <b><?php echo $all_bimbingan->nama_mahasiswa ?></b></h4>
													</div>
													<div>
														<div
															class="custom-control custom-checkbox custom-checkbox-success">
															<input class="custom-control-input" id="chk-todo-task-1"
																   disabled
																   type="checkbox" <?php echo $all_bimbingan->status !== NULL ? "checked" : null ?>>
															<label class="custom-control-label"
																   for="chk-todo-task-1"></label>
														</div>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
										<?php if (count($all_latest_bimbingan) == 0) : ?>
											<li class="list-group-item"><p class="h3">Belum mengajukan konsultasi</p>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							<?php endif; ?>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
		<!--		<div class="row">-->
		<!--			<div class="col-xl-12">-->
		<!--				<div class="card">-->
		<!--					<div class="card-header">-->
		<!--						<h5 class="h3 mb-0">Informasi Terkini</h5>-->
		<!--					</div>-->
		<!--					<div class="card-header d-flex align-items-center">-->
		<!--						<div class="d-flex align-items-center">-->
		<!--							<a href="#">-->
		<!--								<img src="../../aset/img/theme/team-1.jpg" class="avatar">-->
		<!--							</a>-->
		<!--							<div class="mx-3">-->
		<!--								<a href="#" class="text-dark font-weight-600 text-sm">John Snow</a>-->
		<!--								<small class="d-block text-muted">3 days ago</small>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--						<div class="text-right ml-auto">-->
		<!--							<button type="button" class="btn btn-sm btn-primary btn-icon">-->
		<!--								<span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>-->
		<!--								<span class="btn-inner--text">Follow</span>-->
		<!--							</button>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="card-body">-->
		<!--						<p class="mb-4">-->
		<!--							Personal profiles are the perfect way for you to grab their attention and persuade-->
		<!--							recruiters to continue reading your CV because you’re telling them from the off exactly-->
		<!--							why they should hire you.-->
		<!--						</p>-->
		<!--						<img alt="Image placeholder" src="../../aset/img/theme/img-1-1000x600.jpg"-->
		<!--						     class="img-fluid rounded">-->
		<!--						<div class="row align-items-center my-3 pb-3 border-bottom">-->
		<!--							<div class="col-sm-6">-->
		<!--								<div class="icon-actions">-->
		<!--									<a href="#" class="like active">-->
		<!--										<i class="ni ni-like-2"></i>-->
		<!--										<span class="text-muted">150</span>-->
		<!--									</a>-->
		<!--									<a href="#">-->
		<!--										<i class="ni ni-chat-round"></i>-->
		<!--										<span class="text-muted">36</span>-->
		<!--									</a>-->
		<!--									<a href="#">-->
		<!--										<i class="ni ni-curved-next"></i>-->
		<!--										<span class="text-muted">12</span>-->
		<!--									</a>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--							<div class="col-sm-6 d-none d-sm-block">-->
		<!--								<div class="d-flex align-items-center justify-content-sm-end">-->
		<!--									<div class="avatar-group">-->
		<!--										<a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip"-->
		<!--										   data-original-title="Jessica Rowland">-->
		<!--											<img alt="Image placeholder" src="../../aset/img/theme/team-1.jpg"-->
		<!--											     class="">-->
		<!--										</a>-->
		<!--										<a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip"-->
		<!--										   data-original-title="Audrey Love">-->
		<!--											<img alt="Image placeholder" src="../../aset/img/theme/team-2.jpg"-->
		<!--											     class="rounded-circle">-->
		<!--										</a>-->
		<!--										<a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip"-->
		<!--										   data-original-title="Michael Lewis">-->
		<!--											<img alt="Image placeholder" src="../../aset/img/theme/team-3.jpg"-->
		<!--											     class="rounded-circle">-->
		<!--										</a>-->
		<!--									</div>-->
		<!--									<small class="pl-2 font-weight-bold">and 30+ more</small>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--						<div class="mb-1">-->
		<!--							<div class="media media-comment">-->
		<!--								<img alt="Image placeholder"-->
		<!--								     class="avatar avatar-lg media-comment-avatar rounded-circle"-->
		<!--								     src="../../aset/img/theme/team-1.jpg">-->
		<!--								<div class="media-body">-->
		<!--									<div class="media-comment-text">-->
		<!--										<h6 class="h5 mt-0">Michael Lewis</h6>-->
		<!--										<p class="text-sm lh-160">Cras sit amet nibh libero nulla vel metus-->
		<!--											scelerisque ante sollicitudin. Cras purus odio vestibulum in vulputate-->
		<!--											viverra turpis.</p>-->
		<!--										<div class="icon-actions">-->
		<!--											<a href="#" class="like active">-->
		<!--												<i class="ni ni-like-2"></i>-->
		<!--												<span class="text-muted">3 likes</span>-->
		<!--											</a>-->
		<!--											<a href="#">-->
		<!--												<i class="ni ni-curved-next"></i>-->
		<!--												<span class="text-muted">2 shares</span>-->
		<!--											</a>-->
		<!--										</div>-->
		<!--									</div>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--							<div class="media media-comment">-->
		<!--								<img alt="Image placeholder"-->
		<!--								     class="avatar avatar-lg media-comment-avatar rounded-circle"-->
		<!--								     src="../../aset/img/theme/team-2.jpg">-->
		<!--								<div class="media-body">-->
		<!--									<div class="media-comment-text">-->
		<!--										<h6 class="h5 mt-0">Jessica Stones</h6>-->
		<!--										<p class="text-sm lh-160">Cras sit amet nibh libero, in gravida nulla. Nulla-->
		<!--											vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in-->
		<!--											vulputate at, tempus viverra turpis.</p>-->
		<!--										<div class="icon-actions">-->
		<!--											<a href="#" class="like active">-->
		<!--												<i class="ni ni-like-2"></i>-->
		<!--												<span class="text-muted">10 likes</span>-->
		<!--											</a>-->
		<!--											<a href="#">-->
		<!--												<i class="ni ni-curved-next"></i>-->
		<!--												<span class="text-muted">1 share</span>-->
		<!--											</a>-->
		<!--										</div>-->
		<!--									</div>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--							<hr>-->
		<!--							<div class="media align-items-center">-->
		<!--								<img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4"-->
		<!--								     src="../../aset/img/theme/team-3.jpg">-->
		<!--								<div class="media-body">-->
		<!--									<form>-->
		<!--											<textarea class="form-control" placeholder="Write your comment"-->
		<!--											          rows="1"></textarea>-->
		<!--									</form>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--		</div>-->
		<!-- Footer -->
		<?php $this->load->view('user/_partials/footer'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/modal.php'); ?>
<?php $this->load->view('user/_partials/js.php'); ?>
<script>
    $(document).ready(function () {
        if (!localStorage.getItem('wizard')) {
            introJs().start().oncomplete(function () {
                localStorage.setItem('wizard', 'yes')
            }).onexit(function () {
                localStorage.setItem('wizard', 'yes')
            })
        }
    })
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
