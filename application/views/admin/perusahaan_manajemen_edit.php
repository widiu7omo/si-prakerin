<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>
<?php $this->load->helper( 'master' );
$prodies = masterdata( 'tb_program_studi' );
?>


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
					<?php if ( $this->session->flashdata( 'status' ) ): ?>
                        <div class="alert alert-<?php echo $this->session->flashdata( 'status' )['type']=='success'?'success':'danger'?> alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong><?php echo ucfirst($this->session->flashdata( 'status' )['type'])?>
								&nbsp;</strong><?php echo $this->session->flashdata( 'status' )['message']; ?></span><br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
					<?php endif; ?>
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Input <?php echo $this->uri->segment( 1 ) ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo site_url( 'perusahaan?m=manajemen' ) ?>"
                                   class="btn btn-sm btn-primary">Back to
                                    list</a>
                            </div>
                        </div>

                        <p class="text-light font-weight-300">Penginputan data perusahaan secara singkat. untuk
                            detailnya mahasiswa yang akan melengkapinya</p>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="post" action="<?php site_url( 'perusahaan?m=manajemen&q=u' ) ?>">
                            <input type="hidden" name="id_perusahaan" value="<?php echo $perusahaan->id_perusahaan?>">
                            <!-- Input groups with icon
							  `nama_perusahaan` varchar(100) DEFAULT NULL,
							  `alamat_perusahaan` text DEFAULT NULL,
							  `telepon_perusahaan` varchar(20) DEFAULT NULL,
							  `long_perusahaan` varchar(10) DEFAULT NULL,
							  `lat_perusahaan` varchar(10) DEFAULT NULL,
							  `kuota_pkl` int(11) DEFAULT NULL,

							-->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Perusahaan</label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input name="nama_perusahaan" class="form-control"
                                                   placeholder="Nama Perusahaan" type="text" value="<?php echo $perusahaan->nama_perusahaan?>">
                                        </div>
                                        <small class="font-weight-light text-warning">* perubahan nama perusahaan harus menyesuaikan ke semua prodi</small>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row my-2">
                                        <div class="col-md-6 pt-2">
                                            <label for="prodi">Ketersediaan prodi</label><br>

                                            <label for="mo"
                                                   class="align-top"><?php echo $perusahaan->nama_program_studi ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="kuota-<?php echo $perusahaan->id_program_studi ?>">Kuota</label>
                                            <input type="number"
                                                   id="kuota-<?php echo $perusahaan->id_program_studi ?>"
                                                   class="form-control"
                                                   placeholder="Kuota" value="<?php echo $perusahaan->kuota_pkl?>" name="kuota_pkl">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status-<?php echo $perusahaan->id_program_studi ?>">Status</label>
                                            <select type="number"
                                                    id="status-<?php echo $perusahaan->id_program_studi ?>"
                                                    class="form-control"
                                                    placeholder="Status" name="status_perusahaan">
                                                <option <?php echo $perusahaan->status_perusahaan == 'uncheck'?'selected':null?> value="uncheck">Uncheck</option>
                                                <option <?php echo $perusahaan->status_perusahaan == 'whitelist'?'selected':null?> value="whitelist">Whitelist</option>
                                                <option <?php echo $perusahaan->status_perusahaan == 'blacklist'?'selected':null?> value="blacklist">Blacklist</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-md-right align-content-end mt-2">
                                    <button type="submit" name="update" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer PHP -->
	<?php $this->load->view( 'admin/_partials/footer.php' ); ?>
</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/js.php' );
?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
