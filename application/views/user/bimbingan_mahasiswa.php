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
						<div class="card-header"></div>
						<div class="card-body table-responsive ">
							<table id="bimbingan-mhs" class="table table-flush">
								<thead>
								<tr>
									<th>Bimbingan Ke-</th>
									<th>Mahasiswa</th>
									<th>Masalah</th>
									<th>Konsultasi</th>
									<th>Persetujuan</th>
								</tr>
								</thead>
								<tfoot>
								<tr>
									<th>Bimbingan Ke-</th>
									<th>Mahasiswa</th>
									<th>Masalah</th>
									<th>Konsultasi</th>
									<th>Persetujuan</th>
								</tr>
								</tfoot>
								<tbody>
								<tr>
									<td>1</td>
									<td>Dendi Krisnadi</td>
									<td>Tidak Mendapatkan kasus diperusahaan</td>
									<td>Tanyakan pada pembimbing lapangan</td>
									<td>
										<a href="#" class="btn btn-success btn-sm">Setujui</a>
										<a href="#" class="btn btn-danger btn-sm">Tolak</a>
									</td>
								</tr>
								</tbody>
							</table>
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
	$('#bimbingan-mhs').dataTable({
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        }
	})
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
