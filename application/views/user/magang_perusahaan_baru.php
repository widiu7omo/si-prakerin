<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'user/_partials/header.php' ); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view( 'user/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav PHP-->
	<?php $this->load->view( 'user/_partials/topnav.php' );
	?>
    <!-- Header -->
    <!-- BreadCrumb PHP -->
	<?php $this->load->view( 'user/_partials/breadcrumb.php' );
	?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
	    <?php if ( $this->session->flashdata( 'status' ) ): ?>
            <div class="alert alert-<?php echo $this->session->userdata( 'status' )['type'] == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show"
                 role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong><?php echo ucfirst( $this->session->userdata( 'status' )['type'] ) ?>!
								&nbsp;</strong><?php echo $this->session->flashdata( 'status' )['message']; ?></span><br>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
	    <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-9 col-xs-12 col-sm-12 col-lg-9">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Pengajuan perusahaan baru</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="<?php echo site_url( 'magang?m=perusahaanbaru&q=i' ) ?>">
                            <!-- Input groups with icon -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-auto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
													<span class="input-group-text"><i
                                                                class="fas fa-building"></i></span>
                                                    </div>
                                                    <input class="form-control" name="nama_perusahaan"
                                                           placeholder="Nama Perusahaan" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
													<span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input class="form-control" name="telepon_perusahaan"
                                                           placeholder="Nomor yang bisa dihubungi" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
													<span class="input-group-text"><i
                                                                class="fas fa-globe-americas"></i></span>
                                                    </div>
                                                    <input class="form-control" name="long_perusahaan"
                                                           placeholder="Longitude"
                                                           type="text">
                                                    <input class="form-control" name="lat_perusahaan"
                                                           placeholder="Latitude"
                                                           type="text">
                                                </div>
                                                <p class="text-sm text-sm-right">*pastikan letak titik benar</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <textarea rows="6" class="form-control" name="alamat_perusahaan"
                                                      placeholder="Alamat" type="text"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <button type="submit" name="insert" id="" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer PHP -->
		<?php $this->load->view( 'user/_partials/footer.php' ); ?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'user/_partials/js.php' );
?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
