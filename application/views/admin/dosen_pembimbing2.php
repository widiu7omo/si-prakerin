<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view('admin/_partials/header.php');
$join = array('tahun_akademik', 'tahun_akademik.id_tahun_akademik = tb_waktu.id_tahun_akademik', 'right join');
$tahun_akademik = datajoin('tb_waktu', null, 'tahun_akademik.tahun_akademik', $join);

$join = array();
$join[0] = array(
	'(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik WHERE tm.nim NOT IN(select tdbm.nim FROM tb_dosen_bimbingan_mhs tdbm) ) tb_mahasiswa',
	'tb_mahasiswa.nim = tb_mhs_pilih_perusahaan.nim',
	'inner'
);
$join[1] = array(
	'tb_perusahaan',
	'tb_perusahaan.id_perusahaan = tb_mhs_pilih_perusahaan.id_perusahaan',
	'inner'
);
$join[2] = array(
	'tb_program_studi',
	'tb_program_studi.id_program_studi = tb_perusahaan.id_program_studi',
	'left outer'
);
$id_prodi = $this->session->userdata('prodi');
$where = '';
if (isset($id_prodi)) {
	$where .= " AND tb_program_studi.id_program_studi = '$id_prodi'";
}

$mahasiswas = datajoin('tb_mhs_pilih_perusahaan', $where, '*', $join, null, "tb_mahasiswa.nama_mahasiswa");

//mahasiswa berdasarakan tahun akademik

?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
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
	<style>
		body.dragging, body.dragging * {
			cursor: move !important;
		}

		.dragged {
			position: absolute;
			opacity: 0.5;
			z-index: 999;
		}
	</style>
	<div class="container-fluid mt--6">
		<!-- Card -->
		<!--        <form action=""></form>-->
		<div class="header-body">
			<div class="row align-items-center mb-3 text-white">
				<div class="col-8">
					<h3 class="mb-0 text-white">Pembagian Dosen Pembimbing</h3>
					<p class="text-sm mb-0">
						Drag dan drop mahasiswa ke dosen yang bersangkutan
					</p>
				</div>
				<div class="col-4 text-right">
					<!--					<button id="simpan" class="btn btn-sm btn-neutral">Simpan</button>-->
				</div>
			</div>
			<!-- Table -->
			<div class="row">
				<div class="col-md-6">
					<div class="card border-primary">
						<div class="card-body">
							<h4 class="card-title">Mahasiswa
								Magang <?php echo $tahun_akademik[0]->tahun_akademik ?></h4>
							<p class="card-text text-sm">*&nbsp;Drag dan Drop ke arah dosen yang diinginkan</p>
							<ul class="nested_with_switch list-group" id="mahasiswa"
								style="height: 100%;max-height: 500px;overflow-y: scroll">
								<?php foreach ($mahasiswas as $mahasiswa): ?>
									<li data-idpilih="<?php echo $mahasiswa->id_mhs_pilih_perusahaan ?>"
										data-nim="<?php echo "$mahasiswa->nim" ?>"
										class="list-group-item"><?php echo "$mahasiswa->nama_mahasiswa ($mahasiswa->nim)" ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card border-primary">
						<div class="card-body">
							<h4 class="card-title">Dosen </h4>
							<p class="card-text text-sm">*&nbsp;Drag dan Drop ke arah mahasiswa untuk mengembalikan</p>
							<div style="height: 100%;max-height: 500px;overflow-y: scroll;padding:10px">
								<?php foreach ($dosens as $dosen): ?>
									<div class="card"
										 style="box-shadow: rgba(0,0,0,.1) 0 0 0 1px, rgba(0,0,0,.1) 0 4px 16px;">
										<div class="card-body">
											<h4 class="card-title mb-0"><?php echo "$dosen->nama_pegawai" ?></h4>
											<p class="card-text p-2 mb-0 text-sm text-center text-dark">Taruh disini</p>
											<ul class="nested_with_switch list-group"
												data-nip="<?php echo "$dosen->nip_nik" ?>"
												id="<?php echo "$dosen->nip_nik" ?>">
												<?php
												$join = array('tb_mahasiswa', 'tdbm.nim = tb_mahasiswa.nim', 'LEFT OUTER');
												$mhs_bimbingan = datajoin('tb_dosen_bimbingan_mhs tdbm', "tdbm.nip_nik = $dosen->nip_nik", "tb_mahasiswa.nama_mahasiswa,tdbm.nim,tdbm.id_dosen_bimbingan_mhs", $join, null, 'tb_mahasiswa.nama_mahasiswa') ?>
												<?php foreach ($mhs_bimbingan as $mhs): ?>
													<li data-nim=""
														data-idbimbingan="<?php echo $mhs->id_dosen_bimbingan_mhs ?>"
														class="badge badge-pill badge-primary badge-md m-1"><?php echo $mhs->nama_mahasiswa ?>
														(<?php echo $mhs->nim ?>)
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php'); ?>
<?php $this->load->view('admin/_partials/js.php'); ?>
<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
?>

<!-- Sortable Draggable -->
<script src="https://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
<!--<script src="--><?php //echo base_url('aset/vendor/sortablejs/Sortable.js') ?><!--"></script>-->
<!--<script src="--><?php //echo base_url('aset/vendor/sortablejs/jquery-sortable.js') ?><!--"></script>-->
<script>
    let oldContainer;
    let sortable = $(`ul.nested_with_switch`).sortable({
        group: 'nested',
        afterMove: function (placeholder, container) {
            if (oldContainer !== container) {
                if (oldContainer)
                    oldContainer.el.removeClass("active");
                container.el.addClass("active");
                oldContainer = container;
            }
        },
        onCancel: function ($item, container, _super, event) {
            $item.removeClass(['dragged', 'badge', 'badge-pill', 'badge-primary', 'badge-md']);
        },
        onDrop: function ($item, container, _super) {
            if (container.el[0].id !== 'mahasiswa') {
                $item.removeClass('list-group-item');
                $item.addClass(['badge', 'badge-pill', 'badge-primary', 'badge-md', 'm-1']);
                let nip_nik = $(container.el).attr('id');
                let nim = $($item).data('nim');
                let id_mhs_pilih_perusahaan = $($item).data('idpilih');
                let send = true;
                $.ajax({
                    url: "<?php echo site_url('dosen?m=pembimbing&q=u')?>",
                    data: {nip_nik, nim, id_mhs_pilih_perusahaan, send},
                    method: "POST",
                    success: function (res) {
                        console.log(res)
                    },
                    error: function (e) {
                        console.log(e)
                    }
                })
                //do insert or update

            } else {
                $item.css('z-index', 999999);
                $item.removeClass(['badge', 'badge-pill', 'badge-primary', 'badge-md', 'm-1']);
                $item.addClass('list-group-item');
                //do delete
            }
            _super($item, container);
        }
    });
</script>
</body>

</html>
