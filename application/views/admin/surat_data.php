<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>
<?php $currentTahunAkademik = getCurrentTahun() ?>

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
	<?php if ( $this->session->flashdata( 'status' ) ): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Success!
								&nbsp;</strong><?php echo $this->session->flashdata( 'status' )->message; ?></span><br>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	<?php endif; ?>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-6 col-lg-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Daftar Nomor Surat</h3>
                        <a href="#" class="btn btn-primary btn-sm" id="headingTwo" data-toggle="collapse"
                           data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">Tambah</a>
                    </div>
                    <div class="accordion" id="accordionExample1">
                        <div class="card">
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordionExample1">
                                <div class="card-body">
                                    <form action="<?php echo site_url( 'surat/save_jenis_surat' ) ?>" method="POST">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" name="no_surat" placeholder="Nomor Surat"
                                                       aria-label="Nomor Surat" aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" name="jenis_surat" placeholder="Jenis Surat"
                                                       aria-describedby="basic-addon2">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-sm" type="submit" name="surat">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive py-2">
                            <table class="table table-flush" id="datatable-buttons-1">
                                <thead class="thead-light">
                                <tr role="row">
                                    <th style="width:30px">Aksi</th>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Jenis Surat</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th style="width:30px">Aksi</th>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Jenis Surat</th>
                                </tr>
                                </tfoot>
                                <tbody>
								<?php foreach ( $jenis_surats as $key => $jenis_surat ): ?>
                                    <tr role="row" class="odd">
                                        <td>
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url( 'surat/surat_edit/' . $jenis_surat->id_jenis_surat ) ?>">Edit</a>
                                                <a class="dropdown-item" href="#"
                                                   onclick="deleteConfirm('<?php echo site_url( 'surat/surat_remove/' . $jenis_surat->id_jenis_surat ) ?>')">Hapus</a>
                                            </div>
                                        </td>
                                        <td class="sorting_1"><?php echo $key + 1 ?></td>
                                        <td><?php echo $jenis_surat->nama_jenis_surat ?></td>
                                        <td><?php echo $jenis_surat->suffix_no_surat ?></td>
                                    </tr>
								<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Data TTD Surat</h3>
                        <a href="#" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                           aria-expanded="true" aria-controls="collapseOne" class="btn btn-primary btn-sm">Tambah</a>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                <div class="card-body">
                                    <form action="<?php echo site_url( 'surat/save_ttd' ) ?>" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="nip" class="form-control form-control-sm" placeholder="NIP"
                                                       aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="nama_pegawai" class="form-control form-control-sm" placeholder="Nama Pegawai"
                                                       aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="jabatan" class="form-control form-control-sm"
                                                       placeholder="Jabatan"
                                                       aria-describedby="basic-addon2">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-sm" type="submit" name="ttd">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive py-2">
                            <table class="table table-flush" id="datatable-buttons-2">
                                <thead class="thead-light">
                                <tr role="row">
                                    <th style="width:30px">Aksi</th>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th style="width:30px">Aksi</th>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                </tr>
                                </tfoot>
                                <tbody>
								<?php foreach ( $ttds as $key => $ttd ): ?>
                                    <tr role="row" class="odd">
                                        <td>
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url( 'surat/ttd_edit/' . $ttd->id_ttd_pimpinan ) ?>">Edit</a>
                                                <a class="dropdown-item" href="#"
                                                   onclick="deleteConfirm('<?php echo site_url( 'surat/ttd_remove/' . $ttd->id_ttd_pimpinan ) ?>')">Hapus</a>
                                            </div>
                                        </td>

                                        <td class="sorting_1"><?php echo $key + 1 ?></td>
                                        <td><?php echo $ttd->nip_nik_ttd_pimpinan ?></td>
                                        <td><?php echo $ttd->nama_ttd_pimpinan ?></td>
                                        <td><?php echo $ttd->jabatan_ttd_pimpinan ?></td>
                                    </tr>
								<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table -->
        <!-- Footer PHP -->
		<?php $this->load->view( 'admin/_partials/footer.php' ); ?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php');?>

<?php $this->load->view( 'admin/_partials/js.php' ); ?>
<!-- custom script -->
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
