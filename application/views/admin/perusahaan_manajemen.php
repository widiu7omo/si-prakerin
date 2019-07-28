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
                                <h3 class="mb-0">Tambah Perusahaan</h3>
                                <p class="text-sm mb-0">
                                    Ketika mahasiswa sudah melakukan pemilihan, pihak admin tidak lagi bisa mengedit kuota perusahaan untuk menghindari
                                    ketidak cocokan data.
                                </p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo site_url( 'perusahaan?m=manajemen&q=i' ) ?>"
                                   class="btn btn-sm btn-primary">Add
                                    Perusahaan</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                            <tr role="row">
                                <th style="width:30px">Aksi</th>
                                <th>No</th>
                                <th>Perusahaan</th>
                                <th>Jurusan</th>
                                <th>Kuota</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th style="width:30px">Aksi</th>
                                <th>No</th>
                                <th>Perusahaan</th>
                                <th>Jurusan</th>
                                <th>Kuota</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                            <tbody>
							<?php foreach ( $perusahaans as $key => $perusahaan ): ?>
                                <tr role="row" class="odd">
                                    <td>
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                               href="<?php echo site_url( 'perusahaan?m=manajemen&q=u&id=' . $perusahaan->id_perusahaan ) ?>">Edit</a>
                                            <a class="dropdown-item" href="#"
                                               onclick="deleteConfirm('<?php echo site_url( 'perusahaan?m=manajemen&q=d&id=' . $perusahaan->id_perusahaan ) ?>')">Hapus</a>
                                        </div>
                                    </td>
                                    <td class="sorting_1"><?php echo $key + 1 ?></td>
                                    <td><?php echo $perusahaan->nama_perusahaan ?></td>
                                    <td><?php echo $perusahaan->nama_program_studi ?></td>
                                    <td><?php echo $perusahaan->kuota_pkl ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $perusahaan->status_perusahaan == 'uncheck' ? 'primary' : ( $perusahaan->status_perusahaan == 'whitelist' ? 'success' : ( $perusahaan->status_perusahaan == 'blacklist' ? 'danger' : 'secondary' ) ) ?>"><?php echo $perusahaan->status_perusahaan ?></span>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer PHP -->

        <?php $this->load->view( 'admin/_partials/footer.php' ); ?>
    </div>

</div>
<!-- modal confirm delete -->
<?php $this->load->view('admin/_partials/modal.php');?>
<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/js.php' );
?>
<script>
    // $('#datatable-perusahaan').on( 'init.dt', function () {
    //     $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
    // }).dataTable({
    //     lengthChange: !1,
    //     dom: 'Bfrtip',
    //     buttons: ["copy", "print"],
    //     // select: {
    //     // 	style: "multi"
    //     // },
    //     language: {
    //         paginate: {
    //             previous: "<i class='fas fa-angle-left'>",
    //             next: "<i class='fas fa-angle-right'>"
    //         }
    //     },
    //     rowCallback: function (row, data, index) {
    //         console.log(data[5])
    //         if (data[5] ==='blacklist') {
    //             $(row).addClass('text-white bg-danger');
    //         }
    //         if (data[5] ==='whitelist') {
    //             $(row).addClass('text-white bg-success');
    //         }
    //     }
    // })
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
