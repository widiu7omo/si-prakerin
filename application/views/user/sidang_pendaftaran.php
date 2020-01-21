<?php $section = isset($_GET['section']) ? $_GET['section'] : 'today'; ?>
<?php $level = $this->session->userdata('level') ?>
<?php $temp_date = "" ?>
<?php $nim = $this->session->userdata('id');
$pendaftaran = isset($pendaftaran) ? $pendaftaran : null;
$mhs = masterdata('tb_mahasiswa', "nim = '$nim'", 'nama_mahasiswa nama') ?>
<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php $this->load->view('user/_partials/header.php'); ?>
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
			<div class="card">
				<div class="card-header">
					<div class="h3">Pendaftaran Seminar</div>
				</div>
				<div class="card-body">
					<?php $allow = isset($allow) ? $allow : false; ?>
					<?php $ontime = isset($ontime) ? $ontime : false; ?>
					<?php if (!$allow): ?>
						<div class="h2">Anda belum bisa upload kelengkapan berkas pendaftaran seminar karena belum
							dijadwalkan di aplikasi
						</div>
					<?php elseif (!$ontime): ?>
						<div class="h2">Anda terlambat mengupload berkas pendaftaran, silahkan hubungi koordinator untuk
							di jadwalkan ulang
						</div>
					<?php else: ?>
						<div class="h5">* Catatan</div>
						<div class="h6 font-weight-normal">- Pendafaran seminar akan hilang ketika waktu sidang kurang
							dari 2 hari
						</div>
						<div class="h6 font-weight-normal">- Harap mengecek kembali file pdf sebelum di <i>upload</i>
						</div>
						<div class="h6 font-weight-normal">- Segera lakukan pendaftaran jika jadwal sudah di
							informasikan oleh koordinator Prakerin
						</div>
						<input type="file" class="my-pond">
					<?php endif; ?>
				</div>
			</div>

		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>

	</div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/js.php'); ?>

<script>
	$(document).ready(function () {
		let bimbinganMode = '';
		if (!localStorage.getItem('bimbingan_konsultasi')) {
			introJs().start().oncomplete(function () {
				localStorage.setItem('bimbingan_konsultasi', 'yes');
			}).onexit(function () {
				localStorage.setItem('bimbingan_konsultasi', 'yes');
			})
		}
	});

</script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond-plugin-file-rename.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond-plugin-file-validate-size.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond-plugin-file-validate-type.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond-plugin-image-preview.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/filepond/filepond.jquery.js') ?>"></script>
<script>
	$(document).ready(function () {
		if (!localStorage.getItem('wizard')) {
			introJs().start().oncomplete(function () {
				localStorage.setItem('wizard', 'yes')
			}).onexit(function () {
				localStorage.setItem('wizard', 'yes')
			})
		}
		FilePond.registerPlugin(FilePondPluginFileRename);
		FilePond.registerPlugin(FilePondPluginFileValidateSize);
		FilePond.registerPlugin(FilePondPluginFileValidateType);
		FilePond.setOptions({
			maxFileSize: '2048MB',
			acceptedFileTypes: ['application/pdf'],
			fileRenameFunction: (file) => {
				console.log(file);
				return `<?php echo $nim . ' - ' . $mhs->nama ?>${file.extension}`;
			}
		})
		let pond = $('.my-pond').filepond({
			server: "<?php echo site_url('sidang?m=upload_pendaftaran') ?>"
		})
		<?php if(isset($pendaftaran->file) && $pendaftaran->file != ''): ?>
		setTimeout(function () {
			$('.my-pond').filepond('addFile', '<?php echo base_url('file_upload/pendaftaran_seminar/') . $pendaftaran->file ?>')
		}, <?php echo $pendaftaran->size ?>);
		<?php endif ?>
	})
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
