<!DOCTYPE html>
<?php $nim = $this->session->userdata('id');
$mhs = masterdata('tb_mahasiswa', "nim = '$nim'", 'nama_mahasiswa nama') ?>
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
	<div class="container-fluid mt--6" data-step="1"
		 data-intro="Selamat datang di SIMP (Sistem Informasi Manajemen Prakerin)!">
		<div class="row">
			<div class="col-xl-12">
				<!-- Checklist -->
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<!-- Title -->
						<div class="h2">Kelengkapan berkas</div>
					</div>
					<!-- Card body -->
					<div class="card-body">
						<!-- List group -->
						<?php $allow = isset($allow) ? $allow : false; ?>
						<?php if (!$allow && !isset($status)): ?>
							<div class="h2">Anda belum bisa upload kelengkapan berkas</div>
						<?php elseif (!$allow && isset($status)): ?>
							<div class="h3">ANDA TELAH MENGUPLOAD FILE PEMBERKASAN</div>
						<?php else: ?>
							<div class="h5">Silahkan upload berkas anda disini</div>
							<input type="file" class="my-pond">
						<?php endif; ?>
						<?php
						if (isset($status->message)): ?>
							<div class="alert <?php echo $status->color ?> alert-dismissible fade show"
								 role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong><?php echo $status->message ?></strong>
							</div>
						<?php endif; ?>
						<div class="h5">* Catatan</div>
						<div class="h6 font-weight-normal">- Apabila berkas yang kalian upload kurang lengkap,
							koordinator akan mengintruksikan kalian untuk upload ulang
						</div>
						<?php ?>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('user/_partials/footer'); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/modal.php'); ?>
<?php $this->load->view('user/_partials/js.php'); ?>
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
			maxFileSize: '2560KB',
			acceptedFileTypes: ['application/pdf'],
			fileRenameFunction: (file) => {
				console.log(file);
				return `<?php echo $nim . ' - ' . $mhs->nama ?>${file.extension}`;
			}
		})
		let pond = $('.my-pond').filepond({
			server: "<?php echo site_url('kelengkapan?m=upload') ?>"
		})
		$('.my-pond').on('FilePond:processfile', function (e) {
			window.location.reload();
		})
	})
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
