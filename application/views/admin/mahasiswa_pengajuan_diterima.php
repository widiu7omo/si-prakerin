<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>
<!-- Custom Helper -->
<?php $this->load->helper( 'master_helper' );
$perusahaan = masterdata( 'tb_perusahaan', "id_perusahaan = {$id}", 'nama_perusahaan' );
?>
<style>
    td.details-control::before {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f0d7";
    }

    tr.shown td.details-control::before {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f0d8";
    }
</style>
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
        <!-- Export -->
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h3 class="mb-0">Berkas Bukti Diterima Magang</h3>
                                <p class="text-sm mb-3">
                                    Pada perusahaan <?php echo $perusahaan->nama_perusahaan ?>
                                </p>
                                <a href="<?php echo site_url( "mahasiswa?m=pengajuan&q=accept&id={$id}" ) ?>"
                                   class="btn btn-sm btn-success">Setujui bukti penerimaan</a>
                                <a href="<?php echo site_url( "mahasiswa?m=pengajuan&q=decline&id={$id}" ) ?>"
                                   class="btn btn-sm btn-danger">Tolak bukti penerimaan</a>

                            </div>
                            <div class="col-3 col-xs-12 text-right">
                                <a href="<?php echo site_url( 'mahasiswa?m=pengajuan' ) ?>" class="btn btn-sm btn-info">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <!--@TODO: Alternate if docx file , but must hosting <iframe src="https://docs.google.com/gview?url=http://remote.url.tld/path/to/document.doc&embedded=true"></iframe>-->
                                <iframe class="col-md-12 px-0" style="border-radius: 6px" height="500px"
                                        src="<?php echo base_url( '/ViewerJS/#../file_upload/bukti/' . preg_replace( '/^(.*\/)/', '', $berkas ) ) ?>"
                                        frameborder="0"></iframe>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Footer PHP -->
		<?php $this->load->view( 'admin/_partials/footer.php' ); ?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/modal.php' ); ?>
<?php $this->load->view( 'admin/_partials/loading.php' ); ?>
<?php $this->load->view( 'admin/_partials/js.php' ); ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
