<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>
<!-- Custom Helper -->
<?php $this->load->helper( 'master_helper' );
$prodies      = masterdata( 'tb_program_studi' );
$currentTahun = masterdata( 'tb_waktu' ); ?>
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
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card bg-gradient">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Cetak Pengajuan Magang</h3>
                                <p class="text-sm mb-0">
                                    Pencetakan Surat Permohonan Magang
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
								<?php $kuota = isset( $permohonan[0] ) ? (int) $permohonan[0]->kuota_pkl - count( $permohonan ) : 0 ?>
								<?php if ( $kuota > 0 ): ?>
                                    <div class="alert alert-warning" role="alert">
                                        <p class="alert-heading">Apakah tetapi ingin mencetak surat permohonan untuk
                                            perusahaan ini?</p>
                                        <p class="text-white">Kuota perusahaan masih tersisa
                                            <strong><?php echo $kuota ?></strong>
                                        </p>
                                    </div>
								<?php endif; ?>
                                <h4 class="header"><p>Berikut daftar mahasiswa sementara yang magang pada
                                        perusahaan
                                        <strong><?php echo isset( $permohonan[0] ) ? $permohonan[0]->nama_perusahaan : null ?></strong>
                                    </p></h4>
                                <form action="<?php echo site_url( "mahasiswa?m=pengajuan&q=p&save=true&id=$id_perusahaan") ?>" method="post">
	                                <?php $nomor_surat = masterdata( 'tb_jenis_surat','nama_jenis_surat = "Permohonan Magang"','suffix_no_surat')?>
                                    <div class="form-group col-sm-6">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><small class="font-weight-bold">B/</small></span>
                                            </div>
                                            <input class="form-control" placeholder="Nomor Urut Surat" type="text" name="urut" required>
                                            <input type="hidden" name="id" value="<?php echo $id_perusahaan ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><small class="font-weight-bold"><?php echo $nomor_surat->suffix_no_surat.date('Y') ?></small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <ol class="list-group my-2">
										<?php foreach ( $permohonan as $perm ): ?>
                                            <li class="list-group-item">
                                                <span><?php echo $perm->nama_mahasiswa ?></span><span>&nbsp;(<?php echo $perm->nim ?>)</span>
                                            </li>
										<?php endforeach; ?>
                                    </ol>
                                    <button data-toggle="tooltip" data-placement="top" type="submit" name="button" value="save" title="Cetak"
                                            class="btn btn-success float-right mx-2"><i class="fas fa-print"></i>
                                    </button>
                                </form>
                                <!--                                <div class="alert alert-success alert-dismissible" role="alert">-->
                                <!--                                    <div class="alert-text">Surat berhasil tercetak.</div>-->
                                <!--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
                                <!--                                        <span aria-hidden="true">&times;</span>-->
                                <!--                                    </button>-->
                                <!--                                </div>-->

                                <a href="<?php echo site_url( 'mahasiswa?m=pengajuan' ) ?>"
                                   class="mx-2 btn btn-info float-right">Kembali</a>
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
<script>
    //setTimeout(function () {
    //    location.href = "<?php //echo site_url( 'mahasiswa?m=pengajuan&q=p&save=true&id='.$id_perusahaan ) ?>//"
    //},1000)
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
