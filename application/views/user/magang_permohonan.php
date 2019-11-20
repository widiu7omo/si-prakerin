<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view('user/_partials/header.php'); ?>
<?php $this->load->helper(array('master', 'progress'));
$get = $this->input->get();
$nim = $this->session->userdata('id');
$where = "(status = 'proses' or status = 'terima' or status = 'cetak' or status = 'pending' or status = 'kirim') AND nim = '{$nim}'";
$join = array(
	'tb_perusahaan',
	'tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan',
	'left outer'
);
$select = array('tb_perusahaan.nama_perusahaan', 'tb_perusahaan.id_perusahaan', 'tb_perusahaan_sementara.status');
$approval = datajoin('tb_perusahaan_sementara', $where, $select, $join);
//    var_dump($countApproval);
$exist = false;
$id_perusahaan = null;
if (count($approval) == 1 || count($approval) > 1) {
	$exist = true;
	$id_perusahaan = $approval[0]->id_perusahaan;
}
function getTempMhs($id)
{
	$joins[0] = array(
		'tb_perusahaan',
		'tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan',
		'left outer'
	);
	$joins[1] = array('tb_mahasiswa', 'tb_perusahaan_sementara.nim = tb_mahasiswa.nim', 'left outer');
	$select = array('nama_mahasiswa');
	$where = "tb_perusahaan_sementara.id_perusahaan = {$id} 
	              AND (tb_perusahaan_sementara.status = 'proses'
	               OR tb_perusahaan_sementara.status = 'cetak'
	               OR tb_perusahaan_sementara.status = 'pending'
	               OR tb_perusahaan_sementara.status = 'terima'
	               OR tb_perusahaan_sementara.status = 'kirim')";

	return datajoin('tb_perusahaan_sementara', $where, $select, $joins, null);
}

?>
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
				<div class="col-md-12 col-sm-12">
					<div class="card text-white bg-gradient-secondary"
						 data-step="<?php echo isset($intro) ? $intro[0]['step_intro'] : null ?>"
						 data-intro="<?php echo isset($intro) ? $intro[0]['message_intro'] : null ?>">
						<!--                        <img class="card-img-top" src="holder.js/100px180/" alt="">-->
						<div class="card-body">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h4 class="card-title">Status Pengajuan Magang</h4>
									<h4 class="h5 small">
										Tujuan:&nbsp; <?php echo $exist ? (isset($approval[0]) ? $approval[0]->nama_perusahaan : null) : 'Belum mengajukan' ?></h4>

								</div>
								<div class="col-md-4 col-sm-4 text-right" id="div-btn-diterima">
									<?php if (isset($approval[0]) && $approval[0]->status == 'kirim'): ?>
										<a class="btn btn-sm btn-primary" data-toggle="collapse"
										   href="#collapse-bukti-diterima" role="button" aria-expanded="false"
										   aria-controls="collapseExample">
											Diterima
										</a>
										<a href="<?php echo site_url('magang?m=pengajuan&status=decline&id=' . $approval[0]->id_perusahaan) ?>"
										   class="btn btn-sm btn-warning">Ditolak</a>
									<?php endif; ?>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="collapse" id="collapse-bukti-diterima">
										<div class="card card-body">
											<div class="dropzone dropzone-multiple dz-clickable"
												 data-toggle="dropzone" data-dropzone-multiple=""
												 data-dropzone-url="<?php echo site_url('ajax/uploadbukti?id=' . $id_perusahaan) ?>">
												<ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush"></ul>
												<div class="dz-default dz-message">
													<span>Upload bukti diterima magang</span><br>
													<small class="text-danger">*format harus .pdf</small>
													<div class="spinner-border text-danger" role="status">
														<span class="sr-only">Loading...</span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<button id="confirmation-bukti" disabled
															class="btn btn-sm btn-success float-right ml-2">Simpan
													</button>
													<button class="btn btn-sm btn-danger float-right"
															data-toggle="collapse"
															href="#collapse-bukti-diterima">Batal
													</button>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="progress-wrapper">
								<div class="progress-info">
									<div class="progress-label">
										<span>Status :</span>
										<span><?php echo $exist ? 'Di' . (isset($approval[0]) ? $approval[0]->status : null) : 'N/A' ?></span>
										<?php if (isset($approval[0]) && $approval[0]->status == 'pending'): ?>
											<span>/ Menunggu persetujuan dari prakerin</span>
										<?php endif; ?>
										<?php if (isset($approval[0]) && $approval[0]->status == 'terima'): ?>
											<span>/ Disetujui sepenuhnya oleh prakerin</span>
										<?php endif; ?>
									</div>
									<div class="progress-percentage">
										<span><?php echo getProgress(isset($approval[0]) ? $approval[0]->status : null) ?>%</span>
									</div>
								</div>
								<div class="progress">
									<div
										class="progress-bar bg-<?php echo (isset($approval[0]) && $approval[0]->status == 'terima') ? 'success' : 'gradient-primary' ?>"
										role="progressbar"
										aria-valuenow="<?php echo getProgress(isset($approval[0]) ? $approval[0]->status : null) ?>"
										aria-valuemin="0" aria-valuemax="100"
										style="width: <?php echo getProgress(isset($approval[0]) ? $approval[0]->status : null) ?>%;"></div>
								</div>
								<?php
								$nim = $this->session->userdata('id');
								$join = array(
									'tb_perusahaan as pr',
									'pr.id_perusahaan = tb_history_pemilihan.id_perusahaan',
									'LEFT OUTER'
								);
								$riwayats = datajoin('tb_history_pemilihan', "nim = '$nim'", 'pr.nama_perusahaan', $join);
								?>
								<?php if (count($riwayats) > 0): ?>
									<a class="btn btn-sm btn-primary" data-toggle="collapse"
									   href="#collapse-history" role="button" aria-expanded="false"
									   aria-controls="collapseExample">
										Riwayat Pengajuan Perusahaan (Ditolak)
									</a>
								<?php endif; ?>
								<div class="collapse mt-3" id="collapse-history">
									<ul class="list-group">
										<?php foreach ($riwayats as $key => $riwayat): ?>
											<li class="list-group-item text-danger h6"><?php echo $riwayat->nama_perusahaan ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php if ($this->session->flashdata('status')): ?>
						<div
							class="alert alert-<?php echo $this->session->userdata('status')['type'] == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show"
							role="alert">
							<span class="alert-icon"><i class="ni ni-like-2"></i></span>
							<span
								class="alert-text"><strong><?php echo ucfirst($this->session->userdata('status')['type']) ?>!
								&nbsp;</strong><?php echo $this->session->flashdata('status')['message']; ?></span><br>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="d-flex justify-content-end">
						<form method="GET" action="<?php echo site_url('magang') ?>"
							  class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
							<div class="form-group mb-0"
								 data-step="<?php echo isset($intro) ? $intro[1]['step_intro'] : null ?>"
								 data-intro="<?php echo isset($intro) ? $intro[1]['message_intro'] : null ?>">
								<div class="input-group-sm input-group input-group-alternative input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-search"></i></span>
									</div>
									<?php echo form_hidden(array('m' => 'pengajuan')) ?>
									<input class="form-control" name="q" placeholder="Cari Perusahaan"
										   autocomplete="off" type="text">
								</div>
							</div>
							<button type="button" class="close" data-action="search-close"
									data-target="#navbar-search-main" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row"
				 style="max-height: 800px;height: 100%;overflow-x: scroll;-ms-overflow-x: scroll;padding-top: 20px">
				<?php if (isset($get['q']) && $get['q'] != ""): ?>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<?php if (count($perusahaans) === 0): ?>
									<h3>Pencarian untuk <span class="text-primary">"<?php echo $get['q'] ?>"</span>
										tidak
										ditemukan. <a class="text-warning"
													  href="<?php echo site_url('magang?m=perusahaanbaru') ?>">Klik
											disini</a> untuk mengajukan perusahaan baru</h3>
								<?php elseif (count($perusahaans) > 0): ?>
									<h3>Berikut hasil pencarian dari <span class="text-primary">"<?php echo $get['q'] ?>"</span>.
									</h3>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-4 col-xs-12 col-sm-12" id="contoh-perusahaan">
					<div class="card">
						<!-- Card header -->
						<div class="card-header py-2">
							<!-- Title -->
							<div class="row">
								<div class="col"><h5 class="h3 mb-0">Perusahaan</h5></div>
								<div class="col-auto">
									<div class="badge badge-info"
										 data-step="<?php echo isset($intro) ? $intro[2]['step_intro'] : null ?>"
										 data-intro="<?php echo isset($intro) ? $intro[2]['message_intro'] : null ?>">
										Kuota&nbsp;3
									</div>
								</div>
							</div>
						</div>
						<div class="card-body py-2">
							<p class="card-text mb-2 text-sm">PT. Contoh Media</p>
							<div class="h5 badge badge-success"
								 data-step="<?php echo isset($intro) ? $intro[3]['step_intro'] : null ?>"
								 data-intro="<?php echo isset($intro) ? $intro[3]['message_intro'] : null ?>">
								Status : Tersisa 2 Slot
							</div>
							<div class="accordion mb-2" id="accordionExample">
								<div class="card p-0 m-0 shadow-none">
									<div class="card-header border-0 p-0 m-0" id="headingOne"
										 data-step="<?php echo isset($intro) ? $intro[4]['step_intro'] : null ?>"
										 data-intro="<?php echo isset($intro) ? $intro[4]['message_intro'] : null ?>"
										 data-toggle="collapse"
										 data-target="#collapse-contoh" aria-expanded="false"
										 aria-controls="collapseOne">
										<h5 class="mb-0">Detail</h5>
									</div>
									<div id="collapse-contoh" class="collapse"
										 aria-labelledby="headingOne"
										 data-parent="#accordionExample">
										<div class="card-body p-0 m-0">
											<ul class="my-0 py-0">
												<li class="my-0 py-0">
													<span class="small">Raditya Dika</span>
												</li>
												<li class="my-0 py-0">
													<span class="small">Dodit Mulyanto</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer py-2">
							<form action="#" method="post">
								<button type="submit" name="insert" class=" float-right btn btn-sm btn-primary"
										data-step="<?php echo isset($intro) ? $intro[5]['step_intro'] : null ?>"
										data-intro="<?php echo isset($intro) ? $intro[5]['message_intro'] : null ?>">
									Ajukan
								</button>
							</form>
						</div>
					</div>
				</div>
				<?php foreach ($perusahaans as $index => $perusahaan): ?>
					<div class="col-md-4 col-xs-12 col-sm-12">

						<div class="card">
							<!-- Card header -->
							<div class="card-header py-2">
								<!-- Title -->
								<div class="row">
									<div class="col"><h5 class="h3 mb-0">Perusahaan</h5></div>
									<div class="col-auto">
										<div class="badge badge-info">
											Kuota&nbsp;<?php echo $perusahaan->kuota_pkl ?></div>
									</div>
								</div>
							</div>
							<div class="card-body py-2">
								<p class="card-text mb-2 text-sm"><?php echo $perusahaan->nama_perusahaan ?></p>
								<?php $tempMhs = getTempMhs($perusahaan->id_perusahaan);
								$countTempMhs = (int)count($tempMhs);
								$countKuota = (int)$perusahaan->kuota_pkl;
								$diff = $countKuota - $countTempMhs;
								?>
								<div
									class="h5 badge badge-<?php echo $diff == 0 ? 'danger' : ($diff == 1 ? 'warning' : 'success') ?>">
									Status
									: <?php echo $diff == 0 ? 'Kuota Penuh' : 'Tersisa ' . $diff . ' Slot' ?></div>
								<div class="accordion mb-2" id="accordionExample">
									<div class="card p-0 m-0 shadow-none">
										<div class="card-header border-0 p-0 m-0" id="headingOne"
											 data-toggle="collapse"
											 data-target="#collapse-<?php echo $index ?>" aria-expanded="false"
											 aria-controls="collapseOne">
											<h5 class="mb-0">Detail</h5>
										</div>
										<div id="collapse-<?php echo $index ?>" class="collapse"
											 aria-labelledby="headingOne"
											 data-parent="#accordionExample">
											<div class="card-body p-0 m-0">
												<ul class="my-0 py-0">
													<?php foreach ($tempMhs as $temp_mh): ?>
														<li class="my-0 py-0"><span
																class="small"><?php echo $temp_mh->nama_mahasiswa ?></span>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer py-2">
								<form action="<?php echo site_url('magang?m=pengajuan&q=i') ?>" method="post">
									<input type="hidden" name="id_perusahaan"
										   value="<?php echo $perusahaan->id_perusahaan ?>">
									<button
										style="display:<?php echo $exist ? 'none' : ($diff == 0 ? 'none' : 'block'); ?>"
										type="submit" name="insert" class=" float-right btn btn-sm btn-primary">
										Ajukan
									</button>
								</form>
							</div>
						</div>
					</div>

				<?php endforeach; ?>
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
        if (!localStorage.getItem('pengajuan_magang')) {
            introJs().start().oncomplete(function () {
                localStorage.setItem('pengajuan_magang', 'yes');
                $('#contoh-perusahaan').remove();
            }).onexit(function () {
                localStorage.setItem('pengajuan_magang', 'yes');
                $('#contoh-perusahaan').remove();
            })
        } else {
            $('#contoh-perusahaan').remove();
        }
    })
</script>
<script>
    var Dropzones = (function () {

        //
        // Variables
        //

        var $dropzone = $('[data-toggle="dropzone"]');
        var $dropzonePreview = $('.dz-preview');

        //
        // Methods
        //

        function init($this) {
            var multiple = ($this.data('dropzone-multiple') !== undefined) ? true : false;
            var preview = $this.find($dropzonePreview);
            var currentFile = undefined;


            // Init options
            var options = {
                url: $this.data('dropzone-url'),
                maxFiles: (!multiple) ? 1 : 1,
                acceptedFiles: '.pdf',
                addRemoveLinks: true,
                removedfile: function (file) {
                    let _ref;
                    let decodeFile;
                    if (typeof file.id === 'undefined') {
                        decodeFile = JSON.parse(file.xhr.response);
                    } else {
                        decodeFile = file;
                        decodeFile.file_name = decodeFile.name;
                    }
                    $.ajax({
                        url: "<?php echo site_url('ajax/remove_bukti')?>",
                        method: 'POST',
                        data: {
                            id_perusahaan: decodeFile.id,
                            file_name: decodeFile.file_name
                        },
                        dataType: "json",
                        success: function () {
                            $('#confirmation-bukti').attr('disabled', true);
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    })
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function () {
                    let previousFile = $.ajax({
                        url: "<?php echo site_url('ajax/init_files')?>",
                        data: {
                            nim: "<?php echo $nim?>",
                        },
                        method: "POST",
                        async: false,
                        dataType: "json",
                    }).done(function (res) {
                        return res
                    });
                    let response = previousFile.responseJSON;
                    if (response.name !== null) {
                        let splited = response.name.split("/");
                        response.name = splited[splited.length - 1];
                        this.options.addedfile.call(this, response);
                        this.options.thumbnail.call(this, response, 'https://image.flaticon.com/icons/svg/337/337946.svg');
                        $('#confirmation-bukti').attr('disabled', false).data('id', response.id);
                    }

                    this.on("addedfile", function (file) {
                        if (!multiple && currentFile) {
                            this.removeFile(currentFile);
                        }
                        currentFile = file;
                    }),
                        this.on("processing", function (file, progress) {
                            // console.log('processing')
                            $('.dz-message').addClass('loading-overlay')
                        }),
                        this.on("success", function (file, response) {
                            var res = JSON.parse(response);
                            $('.dz-message').removeClass('loading-overlay')
                            $('.sheet-form-name').css('display', 'block')
                            $('#confirmation-bukti').attr('disabled', false).data('id', res.id);
                        }),
                        this.on("error", function (error) {
                            console.log(error);
                        })
                }
            }

            // Clear preview html
            preview.html('');

            // Init dropzone
            $this.dropzone(options)
        }

        function globalOptions() {
            Dropzone.autoDiscover = false;
        }

        //
        // Events
        //

        if ($dropzone.length) {

            // Set global options
            globalOptions();

            // Init dropzones
            $dropzone.each(function () {
                init($(this));
            });
        }

    })();
    $('#confirmation-bukti').on('click', function () {
        $.ajax({
            url: '<?php echo site_url("ajax/simpan_bukti")?>',
            dataType: "json",
            method: "POST",
            data: {
                id: $(this).data('id')
            },
			success:function(response){
                alert('Bukti berhasil disimpan');
				location.reload()
			},
			error:function(err){
                alert('Bukti gagal disimpan, sedang terjadi kesalahan');
			}
        })
    })
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
