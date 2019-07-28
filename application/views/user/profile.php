<html>
<!-- Head PHP -->
<?php  $this->load->view('user/_partials/header.php');?>

<body class="g-sidenav-hidden">
	<!-- Sidenav PHP-->
	<?php $this->load->view('user/_partials/sidenav.php');?>
	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav PHP-->
		<?php $this->load->view('user/_partials/topnav.php');
         ?>
		<!-- Header -->
		<?php 
        $data['nama'] = isset($profile->nama_mahasiswa)?$profile->nama_mahasiswa:null;
        $this->load->view('user/_partials/headerprofile',$data);
         ?>
		<!-- Page content -->
		<div class="container-fluid mt--6">
			<div class="row">
<!--				<div class="col-xl-4 order-xl-2">-->
<!--					<div class="card card-profile">-->
<!--						<img src="--><?php //echo base_url('aset/img/theme/bg-profile.svg') ?><!--" alt="Image placeholder"-->
<!--							class="card-img-top">-->
<!--						<div class="row justify-content-center">-->
<!--							<div class="col-lg-3 order-lg-2">-->
<!--								<div class="card-profile-image">-->
<!--									<a href="#">-->
<!--										<img src="--><?php //echo base_url('aset/img/theme/team-4-800x800.jpg') ?><!-- "-->
<!--											class="rounded-circle">-->
<!--									</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">-->
<!--							<div class="d-flex justify-content-between">-->
<!--								<a href="#" class="btn btn-sm btn-info mr-4">Connect</a>-->
<!--								<a href="#" class="btn btn-sm btn-default float-right">Message</a>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="card-body pt-0">-->
<!--							<div class="row">-->
<!--								<div class="col">-->
<!--									<div class="card-profile-stats d-flex justify-content-center">-->
<!--										<div>-->
<!--											<span class="heading">22</span>-->
<!--											<span class="description">Friends</span>-->
<!--										</div>-->
<!--										<div>-->
<!--											<span class="heading">10</span>-->
<!--											<span class="description">Photos</span>-->
<!--										</div>-->
<!--										<div>-->
<!--											<span class="heading">89</span>-->
<!--											<span class="description">Comments</span>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="text-center">-->
<!--								<h5 class="h3">-->
<!--									Jessica Jones<span class="font-weight-light">, 27</span>-->
<!--								</h5>-->
<!--								<div class="h5 font-weight-300">-->
<!--									<i class="ni location_pin mr-2"></i>Bucharest, Romania-->
<!--								</div>-->
<!--								<div class="h5 mt-4">-->
<!--									<i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer-->
<!--								</div>-->
<!--								<div>-->
<!--									<i class="ni education_hat mr-2"></i>University of Computer Science-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
				<div class="col-xl-8 order-xl-1">
					<div class="row">
						<!-- <div class="col-lg-6">
							<div class="card bg-gradient-info border-0"> -->
						<!-- Card body -->
						<!-- <div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0 text-white">Total
												traffic</h5>
											<span class="h2 font-weight-bold mb-0 text-white">350,897</span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-white text-dark rounded-circle shadow">
												<i class="ni ni-active-40"></i>
											</div>
										</div>
									</div>
									<p class="mt-3 mb-0 text-sm">
										<span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
										<span class="text-nowrap text-light">Since last month</span>
									</p>
								</div> -->
						<!-- </div>
						</div> -->
						<!-- <div class="col-lg-6">
							<div class="card bg-gradient-danger border-0"> -->
						<!-- Card body -->
						<!-- <div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0 text-white">Performance
											</h5>
											<span class="h2 font-weight-bold mb-0 text-white">49,65%</span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-white text-dark rounded-circle shadow">
												<i class="ni ni-spaceship"></i>
											</div>
										</div>
									</div>
									<p class="mt-3 mb-0 text-sm">
										<span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
										<span class="text-nowrap text-light">Since last month</span>
									</p>
								</div>
							</div>
						</div> -->
					</div>
					<div class="card">
						<?php if ($this->session->flashdata('status')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<span class="alert-icon"><i class="ni ni-like-2"></i></span>
							<span class="alert-text"><strong>Success!
									&nbsp;</strong><?php echo $this->session->flashdata('status'); ?></span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php endif; ?>
						<form action="<?php echo site_url('user/editprofile') ?>" method="POST">
							<div class="card-header">
								<div class="row align-items-center">
									<div class="col-8">
										<h3 class="mb-0">Edit profile </h3>
									</div>
									<div class="col-4 text-right" id="container-button">
										<button type="button" id="btn-edit" class="btn btn-sm btn-primary"
											onclick="enableInput()">Edit</button>
									</div>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" name="nim" value="<?php echo isset($profile->nim)?$profile->nim:null ?>">
								<h6 class="heading-small text-muted mb-4">User information</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-username">Username</label>
												<input readonly name="username" type="text" id="input-username"
													class="form-control" placeholder="Username"
													value="<?php echo isset($profile->username)?$profile->username:null ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-email">Email
													address</label>
												<input readonly type="email" name="email_mhs" id="input-email"
													class="form-control" placeholder="Isi email dengan benar"
													value="<?php echo isset($profile->email_mhs)?$profile->email_mhs:null ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label class="form-control-label" for="input-first-name">Nama
													Mahasiswa</label>
												<input readonly type="text" name="nama_mahasiswa" id="input-first-name"
													class="form-control" placeholder="Nama lengkap"
													value="<?php echo isset($profile->nama_mahasiswa)?$profile->nama_mahasiswa:null ?>">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label class="form-control-label" for="input-first-name">Nomor
													Telepon
													Mahasiswa</label>
												<input readonly type="text" name="no_hp_mahasiswa" id="input-first-name"
													class="form-control" placeholder="+62"
													value="<?php echo isset($profile->no_hp_mahasiswa)?$profile->no_hp_mahasiswa:null ?>">
											</div>
										</div>
									</div>
								</div>
								<hr class="my-4">
								<!-- Address -->
								<h6 class="heading-small text-muted mb-4">Contact information</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label" for="input-address">Alamat</label>
												<textarea readonly rows="4" name="alamat_mhs" class="form-control"
													placeholder="Alamat"><?php echo isset($profile->alamat_mhs)?$profile->alamat_mhs:null ?></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-city">Jenis
													Kelamin</label>
												<select disabled name="jenis_kelamin_mhs" class="form-control"
													placeholder="Laki-laki/Perempuan"
													value="<?php echo isset($profile->jenis_kelamin_mhs)?$profile->jenis_kelamin_mhs:null ?>">
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Tempat
													Lahir</label>
												<input readonly type="text" name="tempat_lahir_mhs" class="form-control"
													placeholder="Kota Kelahiran"
													value="<?php echo isset($profile->tempat_lahir_mhs)?$profile->tempat_lahir_mhs:null ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Tanggal
													Lahir</label>
												<input readonly type="text" name="tanggal_lahir_mhs"
													id="tanggal_lahir_mhs" class="form-control datepicker"
													placeholder="Pilih Tanggal"
													value="<?php echo isset($profile->tanggal_lahir_mhs)?$profile->tanggal_lahir_mhs:null ?>">
											</div>
										</div>
									</div>
								</div>
								<hr class="my-4">
								<!-- Description -->
								<h6 class="heading-small text-muted mb-4">Orang Tua</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label" for="input-address">Nama Orang
													Tua</label>
												<input readonly id="alamat_mhs" name="nama_orangtua_mhs"
													class="form-control" placeholder="Nama Orang Tua"
													value="<?php echo isset($profile->nama_orangtua_mhs)?$profile->nama_orangtua_mhs:null ?>"
													type="text">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label" for="input-address">Nomor
													Telepon</label>
												<input readonly id="i" name="no_hp_orangtua_mhs" class="form-control"
													placeholder="+62"
													value="<?php echo isset($profile->no_hp_orangtua_mhs)?$profile->no_hp_orangtua_mhs:null ?>"
													type="text">
											</div>
										</div>
									</div>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
			<?php $this->load->view('user/_partials/footer')?>
		</div>
		<!-- Footer -->

	</div>

	<?php $this->load->view('user/_partials/js'); ?>
	<script>
		function enableInput() {
			$('input[name=nama_mahasiswa]').prop('readonly', false);
			$('textarea[name=alamat_mhs]').prop('readonly', false);
			$('select[name=jenis_kelamin_mhs]').prop('disabled', false);
			$('input[name=email_mhs]').prop('readonly', false);
			$('input[name=tempat_lahir_mhs]').prop('readonly', false);
			$('input[name=tanggal_lahir_mhs]').prop('readonly', false);
			$('input[name=no_hp_mahasiswa]').prop('readonly', false);
			$('input[name=nama_orangtua_mhs]').prop('readonly', false);
			$('input[name=no_hp_orangtua_mhs]').prop('readonly', false);
			$('#container-button').append('<button type="submit" class="btn btn-sm btn-primary">Simpan</button>');
			$('#btn-edit').prop('disabled', true);
		}

	</script>
	<!-- Demo JS - remove this in your project -->


</body>

</html>
