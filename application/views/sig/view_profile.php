<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>
<main>
	<div class="container margin_60">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-8">
				<div class="box_account">
					<div class="form_container">
						<div class="main_title_2">
							<h4>Foto Profil</h4>
							<span><em></em></span>
						</div>
						<div style="text-align:center;">
							<img style="border-radius: 50%; width: 250px; height: 250px;" src="http://localhost/sig_prakerin/file_upload/img_perusahaan/C1316004_1560909343_Foto_Bersama_dengan_pimpinan_Perusahaan.png">
						</div>
						<p class="add_top_30">
							<button data-toggle="modal" data-target="#UploadFotoDiri" class="btn_1 full-width">Ubah Foto Profil</button>															
						</p>
					</div>
					<!-- /form_container -->
				</div>
            </div>
			<div class="col-xl-8 col-lg-8 col-md-10">
				<div class="box_account">
					<div class="form_container">
						<div class="main_title_2">
							<h4>Informasi Profil</h4>
							<span><em></em></span>
						</div>
						<form action="<?php echo base_url('sig/profile/update_profile')?>" method="POST">
						<input type="hidden" class="form-control" name="not_id" value="">
							<div class="form-group">
								<label>NIM</label>
								<input type="text" class="form-control" name="nama_perusahaan" placeholder="NIM"
									value="<?= $nim?>" required>
							</div>
							<div class="form-group">
								<label>Nama Mahasiswa</label>
								<input type="text" class="form-control" name="lng_perusahaan" placeholder="Nama Mahasiswa"
									value="<?= $nama_mahasiswa?>">
							</div>
							<div class="form-group">
								<label>Program Studi</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="Program Studi"
									value="<?= $nama_program_studi?>">
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="Jenis Kelamin"
									value="<?= $jenis_kelamin_mhs?>">
							</div>
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="Tempat Lahir"
									value="<?= $tempat_lahir_mhs?>">
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="Tanggal Lahir"
									value="<?= $tanggal_lahir_mhs?>">
							</div>
							<div class="form-group">
								<label>No HP</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="No HP"
									value="<?= $no_hp_mahasiswa?>">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" name="lat_perusahaan" placeholder="Email"
									value="<?= $email_mhs?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea type="text" class="form-control" name="lat_perusahaan" placeholder="Alamat"><?= $alamat_mhs?>
								</textarea>
							</div>
						</form>
					</div>
					<!-- /form_container -->
				</div>
            </div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
