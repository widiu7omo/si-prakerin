<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<!-- Custom Helper -->
<?php $this->load->helper('master_helper');
	$prodies = masterdata('tb_program_studi');
	$currentTahun = datajoin('tb_waktu',null,'tb_waktu.*,ta.tahun_akademik',['tahun_akademik ta','ta.id_tahun_akademik = tb_waktu.id_tahun_akademik','left outer']);
?>
<style>
    td.details-control::before{
        font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f0d7";
    }
    tr.shown td.details-control::before {
        font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f0d8";
    }
</style>
<body>
	<!-- Sidenav PHP-->
	<?php $this->load->view('admin/_partials/sidenav.php');?>
	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav PHP-->
		<?php $this->load->view('admin/_partials/topnav.php');
         ?>
		<!-- Header -->
		<!-- BreadCrumb PHP -->
		<?php $this->load->view('admin/_partials/breadcrumb.php');
         ?>
		<!-- Page content -->
		<div class="container-fluid mt--6">
			<!-- Export -->

			<div class="row">
				<div class="col" id="mainbody">
					<?php if ($this->session->flashdata('status')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<span class="alert-icon"><i class="ni ni-like-2"></i></span>
						<span class="alert-text"><strong>Success!
								&nbsp;</strong><?php echo $this->session->flashdata('status'); ?></span><br>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php endif; ?>
				</div>
			</div>


			<!-- Table -->
			<div class="row">
				<div class="col">
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<div class="row align-items-center">
								<div class="col-8">
									<h3 class="mb-0">Pengajuan Magang <?php echo $currentTahun[0]->tahun_akademik ?></h3>
									<p class="text-sm mb-0">
										Daftar Mahasiswa yang mengajukan permohonan magang
									</p>
                                    <small>* Keterangan</small>
                                    <br>
                                    <button class="btn btn-sm btn-invert btn-outline-light"></button><small>Masuk</small>
                                    <button class="btn btn-sm btn-primary"></button><small>Dicetak</small>
                                    <button class="btn btn-sm btn-info"></button><small>Dikirim</small>
                                    <button class="btn btn-sm btn-warning"></button><small>Pending</small>
                                    <button class="btn btn-sm btn-success"></button><small>Diterima</small>
                                    <button class="btn btn-sm btn-danger"></button><small>Ditolak</small>

								</div>
<!--								<div class="col-4 text-right">-->
<!--									<a href="--><?php //echo site_url('mahasiswa/create') ?><!--"-->
<!--										class="btn btn-sm btn-primary">Add-->
<!--										Mahasiswa</a>-->
<!--								</div>-->
							</div>
						</div>
						<div class="table-responsive py-4">
							<table class="table table-striped dt-responsive nowrap" id="datatable-pengajuan">
								<thead class="thead-light">
									<tr role="row">
										<th>Detail</th>
                                        <th>Perusahaan</th>
										<th>Program Studi</th>
                                        <th>Kuota</th>
<!--                                        <th style="width:30px">Aksi</th>-->
                                        <!--<th>Mahasiswa</th>-->
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Detail</th>
                                        <th>Perusahaan</th>
                                        <th>Program Studi</th>
                                        <th>Kuota</th>
<!--                                        <th style="width:30px">Aksi</th>-->
                                        <!--<th>Mahasiswa</th>-->
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer PHP -->
			<?php $this->load->view('admin/_partials/footer.php');?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/modal.php');?>
	<?php $this->load->view('admin/_partials/loading.php'); ?>
	<?php $this->load->view('admin/_partials/js.php');?>
    <script>
        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<div>' +
                '<p>Daftar Mahasiswa: <br></p>' +
                '<ul>'+d.mahasiswa.map(m =>{return '<li>' + m.nama_mahasiswa + '</li>'}).join('\n')+'</ul>' +
                (d.mahasiswa[0].status === 'pending'?'<a class="btn-sm btn btn-primary" target="_blank" href="<?php echo site_url('mahasiswa?m=pengajuan&q=view&id=') ?>'+d.id_perusahaan+'">Lihat Bukti Penerimaan</a>' :'')+
                (d.mahasiswa[0].status === 'pending'?'<a class="btn-sm btn btn-primary" href="<?php echo site_url('mahasiswa?m=pengajuan&q=accept&id=') ?>'+d.id_perusahaan+'">Setujui Bukti Penerimaan</a>' :'')+
                (d.mahasiswa[0].status === 'proses'?'<a class="btn-sm btn btn-primary" href="<?php echo site_url('mahasiswa?m=pengajuan&q=p&id=') ?>'+d.id_perusahaan+'">Cetak Surat Permohonan</a>' :'')+
                (d.mahasiswa[0].status === 'cetak'? '<a class="btn-sm btn btn-primary" href="<?php echo site_url('mahasiswa?m=pengajuan&q=notif&id=') ?>'+d.id_perusahaan+'">Infokan Surat Jadi</a>' :'')+
                (d.mahasiswa[0].status === 'terima'? '<a class="btn-sm btn btn-primary" href="<?php echo site_url('mahasiswa?m=pengajuan&q=ptugas&id=') ?>'+d.id_perusahaan+'">Cetak Surat Tugas</a>' :'')+
                '</div>';
        }
        $(document).ready(function() {
            var table = $('#datatable-pengajuan').DataTable( {
                "ajax":{url:"<?php echo site_url('mahasiswa/daftar_pengajuan') ?>",
                    dataSrc:function ( json ) {

                        return json.perusahaans}
                },
                "bLengthChange": false,
                "render": function ( data, type, full, meta ) {
                    console.log(data);
                    console.log(type,full,meta)
                },
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ' Detail'
                    },
                    { "data": "nama_perusahaan" },
                    { "data": "nama_program_studi" },
                    { "data": "kuota_pkl" },
                    // { "data": "mahasiswa" }
                ],
                "order": [[1, 'asc']],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                rowCallback: function (row, data, index) {
                    // console.log(data.mahasiswa)
                    //take first array, cz every company have mahasiswa intern. another company with zero mahasiswa, already filter on server side
                    if (data.mahasiswa[0].status === 'cetak') {
                        $(row).addClass('text-white bg-primary');
                    }
                    if (data.mahasiswa[0].status === 'kirim'){
                        $(row).addClass('text-white bg-info');
                    }
                    if (data.mahasiswa[0].status === 'pending'){
                        $(row).addClass('text-white bg-warning');
                    }
                    if (data.mahasiswa[0].status === 'tolak'){
                        $(row).addClass('text-white bg-danger');
                    }
                    if (data.mahasiswa[0].status === 'terima'){
                        $(row).addClass('text-white bg-success');
                    }

                }
            } );

            // Add event listener for opening and closing details
            $('#datatable-pengajuan tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

        } );
    </script>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
