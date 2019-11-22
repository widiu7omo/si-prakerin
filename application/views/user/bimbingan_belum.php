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
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=daftar_bimbingan')?>">Semua Mahasiswa Bimbingan</a>
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=bimbingan_online') ?>">Bimbingan
										Online</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url('bimbingan?m=bimbingan_offline') ?>">Bimbingan
										Offline</a>
								</li>
								<li class="nav-item active">
									<a class="nav-link active"
									   href="<?php echo site_url('bimbingan?m=belum_bimbingan') ?>">Belum Bimbingan</a>
								</li>
							</ul>

						</div>
						<div class="card-body">
							<p class="h4 bold m-0 mb-4">Daftar mahasiswa yang belum bimbingan sama sekali</p>
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
							<div class="table-responsive py-4">
								<table class="table table-flush" id="datatable-mhs-fix">
									<thead class="thead-light">
									<tr role="row">
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Program Studi</th>
										<th>Perusahaan</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>Mahasiswa</th>
										<th>Program Studi</th>
										<th>Perusahaan</th>
									</tr>
									</tfoot>
									<tbody>
									<?php $belum_bimbingan = $belum_bimbingan?$belum_bimbingan:array() ?>
									<?php foreach ( $belum_bimbingan as $key => $belum ): ?>
										<tr role="row" class="odd">
											<td>
												<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
												   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fas fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
													<a class="dropdown-item"
													   href="<?php echo site_url( 'mahasiswa/edit/'  ) ?>">Edit</a>
													<a class="dropdown-item" href="#"
													   onclick="deleteConfirm('<?php echo site_url( 'mahasiswa/remove/'  ) ?>')">Hapus</a>
												</div>
											</td>
											<td class="sorting_1"><?php echo $key + 1 ?></td>
											<td><?php echo $belum->nama_mahasiswa ?></td>
											<td></td>
											<td></td>
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
