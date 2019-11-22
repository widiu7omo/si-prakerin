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
	<div class="container-fluid mt--6">
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-pills nav-fill">
								<li class="nav-item ">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=daftar_bimbingan')?>">Semua Mahasiswa Bimbingan</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link active" href="<?php echo site_url('bimbingan?m=bimbingan_online') ?>">Bimbingan Online</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=bimbingan_offline') ?>">Bimbingan Offline</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=belum_bimbingan') ?>">Belum Bimbingan</a>
								</li>
							</ul>

						</div>
						<div class="card-body">
							<p class="h4 bold m-0 mb-4">Konsultasi Mahasiswa Bimbingan PKL Online</p>
							<?php if ($this->session->flashdata('status')): ?>
								<?php $status = $this->session->flashdata('status'); ?>
								<div class="alert alert-<?php echo $status->alert ?> alert-dismissible fade show"
									 role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<strong><?php echo $status->status ?></strong>&nbsp;<?php echo $status->message ?>
								</div>
							<?php endif; ?>
							<div class="accordion" id="accordionBimbingan">
								<?php $bimbingan_online = $bimbingan_online ? $bimbingan_online : array();
								if ($bimbingan_online): ?>
									<?php foreach ($bimbingan_online as $mahasiswa): ?>
										<div class="card"
											 style="box-shadow: rgba(0,0,0,.1) 0 0 0 1px, rgba(0,0,0,.1) 0 4px 16px;">
											<div class="card-header" id="headingOne" data-toggle="collapse"
												 data-target="#<?php echo $mahasiswa->nim ?>" aria-expanded="true"
												 aria-controls="<?php echo $mahasiswa->nim ?>">
												<h5 class="mb-0"><?php echo $mahasiswa->nama_mahasiswa ?></h5>
											</div>
											<div id="<?php echo $mahasiswa->nim ?>" class="collapse"
												 aria-labelledby="headingOne"
												 data-parent="#accordionBimbingan">
												<div class="card-body">
													<table class="table table-bordered">
														<tr>
															<th style="width:5%">Bimbingan ke</th>
															<th style="width:5%">Tanggal</th>
															<th>Judul</th>
															<th>Aksi</th>
														</tr>
														<?php
														$where = array('id_dosen_bimbingan_mhs' => $mahasiswa->id_dosen_bimbingan_mhs);
														$bimbingans = masterdata('tb_konsultasi_bimbingan', $where, '*', true, 'start ASC'); ?>
														<?php if (count($bimbingans) == 0): ?>
															<tr>
																<td colspan="3">
																	<h4 class="text-center">Mahasiswa belum melakukan
																		konsultasi</h4>
																</td>
															</tr>
														<?php endif ?>
														<?php foreach ($bimbingans as $key => $bimbingan): ?>
															<tr>
																<td><?php echo $key + 1 ?></td>
																<td><?php echo $bimbingan->start ?></td>
																<td><?php echo $bimbingan->title ?></td>
																<td>
																	<?php if ($bimbingan->status == null): ?>
																		<a class="btn btn-sm btn-success"
																		   href="<?php echo site_url('bimbingan?m=bimbinganmhs&a=accept&id=' . $bimbingan->id_konsultasi_bimbingan) ?>">Terima</a>
																		<a class="btn btn-sm btn-danger"
																		   href="<?php echo site_url('bimbingan?m=bimbinganmhs&a=decline&id=' . $bimbingan->id_konsultasi_bimbingan) ?>">Tolak</a>
																	<?php else: ?>
																		<p class="text-sm">Telah Dikonfirmasi</p>
																	<?php endif; ?>
																</td>

															</tr>
														<?php endforeach; ?>
													</table>

												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/modal.php'); ?>
<?php $this->load->view('user/_partials/js.php'); ?>
<script>
    $(document).ready(function () {
        $('#bimbingan-mhs').dataTable({
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            },
            ajax: {
                url: "<?php site_url('bimbingan?m=bimbinganmhs')?>",
                type: "POST",
                data: {getall: true},
                dataSrc: function (res) {
                    console.log(res);
                    return res;
                },
            },
            "bLengthChange": false,
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ' Detail'
                },
                {"data": "title"},
                {"data": "start"},
                {"data": "masalah", "visible": false},
                {"data": "solusi", "visible": false},
                {"data": "solusi", "visible": false},
                // { "data": "mahasiswa.[0].tanggal_pengajuan", "visible": false}
            ],
        })
        $('#bimbingan-mhs tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            console.log($('#bimbingan-mhs'));
            var row = $('#bimbingan-mhs').row(tr);

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
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
