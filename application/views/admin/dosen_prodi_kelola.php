<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>
<body>
<!-- Sidenav PHP-->
<?php $this->load->view( 'admin/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view( 'admin/_partials/topnav.php' );
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view( 'admin/_partials/breadcrumb.php' );
	?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<!-- Table -->
		<div class="row">
			<div class="col">
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Kelola Dosen Prodi</h3>
								<p class="text-sm mb-0">
									Berikut daftar dosen pada masing-masing prodi
								</p>
							</div>
							<div class="col-4">

							</div>
						</div>
					</div>
					<div class="card-body">
						<form method="post" action="<?php site_url( 'dosen?m=dosen_prodi&q=u' ) ?>">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>
											<input class="form-control"
												   placeholder="Nama Dosen" type="text" value="<?php echo isset($dosen)?$dosen->nama_pegawai:null ?>">
											<input class="form-control" type="hidden" value="<?php echo isset($dosen)?$dosen->nip_nik:null ?>">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>
											<input name="nama_perusahaan" class="form-control"
												   placeholder="Nama Perusahaan" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-md-right align-content-end mt-2">
									<button type="submit" name="insert" class="btn btn-success">Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view( 'admin/_partials/footer.php' ); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/js.php' ); ?>
<script>
    var DatatableButtons = (function () {

        // Variables

        var $dtButtons = $('#datatable-mhs-fix');


        // Methods

        function init($this) {

            // For more options check out the Datatables Docs:
            // https://datatables.net/extensions/buttons/

            var buttons = [
                'csv', 'excel', 'pdf', 'print'
            ];

            // Basic options. For more options check out the Datatables Docs:
            // https://datatables.net/manual/options

            var options = {

                lengthChange: !1,
                dom: 'Bfrtip',
                buttons: buttons,
                // select: {
                // 	style: "multi"
                // },
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                }
            };

            // Init the datatable

            var table = $this.on('init.dt', function () {
                $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
            }).DataTable(options);
        }


        // Events

        if ($dtButtons.length) {
            init($dtButtons);
        }

    })();
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
