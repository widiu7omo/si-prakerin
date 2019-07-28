<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>
<main>
	<div class="container margin_60_35">
		<div class="row">
			<aside class="col-lg-4" id="faq_cat">
				<div class="box_style_cat"  id="faq_box">
					<?php 
						if ($mhs_pilih_perusahaaan == 'acc') {
							if(!empty($nama_perusahaan) && !empty($long_perusahaan) && !empty($lat_perusahaan) && !empty($nama_negara) && !empty($nama_provinsi) && !empty($nama_kab_kota) && !empty($nama_kecamatan) && !empty($alamat_perusahaan) && !empty($telepon_perusahaan)){
								$icon = '<i class="pe-7s-check" style="color:green; font-size:30px; margin:10px;"></i>';
							}else {
								$icon = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
							}
							if(empty($t_mhs_review->row()->nim)){
								$icon_u = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
							}else{
								$icon_u = '<i class="pe-7s-check" style="color:green; font-size:30px; margin:10px;"></i>';
							}
							if(!empty($t_mhs_berkas_perusahaan->row()->id_berkas_pilih_perusahaan)){
								$icon_f = '<i class="pe-7s-check" style="color:green; font-size:30px; margin:10px;"></i>';
							}else{
								$icon_f = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
							}
						}else{
							$icon = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
							$icon_u = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
							$icon_f = '<i class="pe-7s-close" style="color:red; font-size:35px; margin:8px;"></i>';
						}
					?>
					<ul id="cat_nav">
						<li><?= $icon;?><a href="#perusahaan">Profil Perusahaan</a></li>
						<li><?= $icon_u;?><a href="#ulasan">Beri Ulasaan</a></li>
						<li><?= $icon_f;?><a href="#foto_kegiatan">Unggah Foto Prakerin</a></li>
					</ul>
				</div>
				<!--/sticky -->
			</aside>
			<div class="col-lg-8" id="faq">
				<?php if ($mhs_pilih_perusahaaan == 'acc') { ?>
				<div class="alert alert-success" role="alert">
					<a href="<?= base_url('sig/perusahaan/').$id_perusahaan?>"><u>Klik Detail Perusahaan <?= $nama_perusahaan?></u></a>
				</div>
				<?php } ?>
				<div role="tablist" class="accordion_2" style="margin-bottom: 30px;" id="perusahaan">
					<div class="card">
						<div class="card-header" role="tab">
							<h5 class="mb-0">
								<a data-toggle="collapse" href="#perusahaan_row" aria-expanded="true">
									<i class="indicator ti-minus"></i>Perusahaan</a>
							</h5>
						</div>
						<div id="perusahaan_row" class="collapse show" role="tabpanel" data-parent="#perusahaan">
							<div class="card-body">
							<?php 
							if ($mhs_pilih_perusahaaan != 'acc') {
								echo '<div class="alert alert-warning" role="alert">';
								echo 'Maaf Anda Belum Memperoleh Tempat Prakerin';
								echo '</div>';
							}else{
							?>
							<form action="<?php echo base_url('sig/prakerin/update_perusahaan')?>" method="POST">
								<input type="hidden" class="form-control" style="height: 40px" name="not_id" value="<?= $nama_perusahaan?>">
								<div class="form-group">
									<label>Nama Perusahaan</label>
									<input type="text" class="form-control" style="height: 40px" name="nama_perusahaan" placeholder="Nama Perusahaan"
										value="<?= $nama_perusahaan?>" required>
								</div>
								<div id="mapid"></div>
								<div class="form-group">
									<label>Garis Lintang</label>
									<input type="text" class="form-control" style="height: 40px" id="lng" name="lng_perusahaan" placeholder="Garis Lintang"
										value="<?= $long_perusahaan?>" readonly required>
								</div>
								<div id="newsletter">
									<div class="form-group">
										<label>Garis Bujur</label>
										<input type="text" class="form-control" style="height: 40px" id="lat" name="lat_perusahaan" placeholder="Garis Bujur"
											value="<?= $lat_perusahaan?>" readonly required>
										<input type="button" onClick="getLocationLeaflet()" value="Koordinat Otomatis" style="margin-top: 25px; position: absolute;"></input>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<label>Negara</label>										
											<select id="id_negara" class="form-control" style="height: 40px" name="id_negara" required>
												<option value="">Pilih Negara</option>
												<?php
												if($nama_negara != NULL){
													echo '<option value="'.$id_negara.'"selected>'.$nama_negara.'</option>';
												}
												foreach ($t_negara as $data_negara) {
													if($data_negara->nama_negara != $nama_negara){
													echo '<option value="'.$data_negara->id_negara.'">'.$data_negara->nama_negara.'</option>';
													}
												} ?>
											</select>
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<label>Provinsi</label>		
											<select id="id_provinsi" class="form-control" style="height: 40px" name="id_provinsi" required>
												<option value="">Pilih Provinsi</option>
												<?php
												if($nama_provinsi != NULL){
													echo '<option value="'.$id_provinsi.'"selected>'.$nama_provinsi.'</option>';
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<label>Kabupaten & Kota</label>		
											<select id="id_kabupaten" class="form-control" style="height: 40px" name="id_kabupaten" required>
												<option value="">Pilih Kabupaten</option>
												<?php
												if($nama_kab_kota != NULL){
													echo '<option value="'.$id_kab_kota.'"selected>'.$nama_kab_kota.'</option>';
												} ?>
											</select>
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<label>Kecamatan</label>		
											<select id="id_kecamatan" class="form-control" style="height: 40px" name="id_kecamatan" required>
												<option value="">Pilih Kecamatan</option>
												<?php
												if($nama_kecamatan != NULL){
													echo '<option value="'.$id_kecamatan.'"selected>'.$nama_kecamatan.'</option>';
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Nomor Telepon</label>		
									<input type="text" class="form-control" style="height: 40px" name="telepon_perusahaan" placeholder="Telepon Perusahaan"
										value="<?= $telepon_perusahaan?>" required>
								</div>
								<div class="form-group">
									<label>Alamat Perusahaan</label>		
									<textarea type="text" class="form-control" style="height: 40px" name="alamat_perusahaan"
										placeholder="Alamat Perusahaan" required><?= $alamat_perusahaan?></textarea>
								</div>
								<div class="form-group">
									<p class="add_top_30">
										<input type="submit" name="PUpdate" value="Perbarui Profile" class="btn_1">
									</p>
								</div>
							</form>
							<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div role="tablist" class="accordion_2" style="margin-bottom: 30px;" id="ulasan">
					<div class="card">
						<div class="card-header" role="tab">
							<h5 class="mb-0">
								<a data-toggle="collapse" href="#ulasan_row" aria-expanded="true">
									<i class="indicator ti-minus"></i>Ulasan Perusahaan</a>
							</h5>
						</div>
						<div id="ulasan_row" class="collapse show" role="tabpanel">
							<div class="card-body">
							<?php
							if ($mhs_pilih_perusahaaan != 'acc') {
								echo '<div class="alert alert-warning" role="alert">';
								echo 'Maaf Anda Belum Memperoleh Tempat Prakerin';
								echo '</div>';
							}else{
								if(!empty($nama_perusahaan) && !empty($long_perusahaan) && !empty($lat_perusahaan) && !empty($nama_negara) && !empty($nama_provinsi) && !empty($nama_kab_kota) && !empty($nama_kecamatan) && !empty($alamat_perusahaan) && !empty($telepon_perusahaan)){ ?>
									<?php if(empty($t_mhs_review->row()->nim)){ ?>
									<p class="add_top_30">
										<button data-toggle="modal" data-target="#reviewperusahaan" class="btn_1">Mulai Mereview</button>															
									</p>
									<?php }else{ ?>
										<form action="<?php echo base_url('sig/prakerin/update_review_perusahaan')?>" method="POST">
										<table class="table table-striped">
											<tbody>
												<?php
												$coun = 0;
												foreach ($t_mhs_review->result() as $data_mhs_review) {
												?>
												<tr>
													<input type="hidden" name="id_data_kuisioner[<?= $coun?>]" value="<?= $data_mhs_review->id_data_kuisioner?>">
													<input type="hidden" name="id_perusahaan_review[<?= $coun?>]" value="<?= $data_mhs_review->id_perusahaan_review?>">											
													<td><?= $data_mhs_review->soal_kuisioner?></td>
													<td style="width: 189px">
														<div class="stars" required>
															<input type="radio" name="rating_perusahaan<?= $coun?>" <?= ($data_mhs_review->rating_perusahaan =='1')?'checked':'' ?> class="star-1" id="<?= $data_mhs_review->id_data_kuisioner?>1" value="1" required/>
															<label class="star-1" for="<?= $data_mhs_review->id_data_kuisioner?>1">1</label>
															<input type="radio" name="rating_perusahaan<?= $coun?>" <?= ($data_mhs_review->rating_perusahaan =='2')?'checked':'' ?> class="star-2" id="<?= $data_mhs_review->id_data_kuisioner?>2" value="2" required/>
															<label class="star-2" for="<?= $data_mhs_review->id_data_kuisioner?>2">2</label>
															<input type="radio" name="rating_perusahaan<?= $coun?>" <?= ($data_mhs_review->rating_perusahaan =='3')?'checked':'' ?> class="star-3" id="<?= $data_mhs_review->id_data_kuisioner?>3" value="3" required/>
															<label class="star-3" for="<?= $data_mhs_review->id_data_kuisioner?>3">3</label>
															<input type="radio" name="rating_perusahaan<?= $coun?>" <?= ($data_mhs_review->rating_perusahaan =='4')?'checked':'' ?> class="star-4" id="<?= $data_mhs_review->id_data_kuisioner?>4" value="4" required/>
															<label class="star-4" for="<?= $data_mhs_review->id_data_kuisioner?>4">4</label>
															<input type="radio" name="rating_perusahaan<?= $coun?>" <?= ($data_mhs_review->rating_perusahaan =='5')?'checked':'' ?> class="star-5" id="<?= $data_mhs_review->id_data_kuisioner?>5" value="5" required/>
															<label class="star-5" for="<?= $data_mhs_review->id_data_kuisioner?>5">5</label>
															<span></span>
														</div>
													</td>
												</tr>
												<?php $coun++; }?>
											</tbody>
										</table>
										<textarea class="form-control" style="height: 40px" name="komentar" rows="5" placeholder="Masukan Komentar Anda" required><?= $data_mhs_review->komentar?></textarea>
										<p class="add_top_30">
											<button class="btn_1" type="submit">Perbarui Ulasaan</button>
										</p>
										</form>
									<?php } ?>
								<?php }else{
									echo '<div class="alert alert-warning" role="alert">';
									echo 'Data Perusahaan Belum Lengkap';
									echo '</div>';
								} ?>
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div role="tablist" class="accordion_2" style="margin-bottom: 30px;" id="foto_kegiatan">
					<div class="card">
						<div class="card-header" role="tab">
							<h5 class="mb-0">
								<a data-toggle="collapse" href="#foto_kegiatan_row" aria-expanded="true">
									<i class="indicator ti-minus"></i>Foto Kegiatan Prakerin</a>
							</h5>
						</div>
						<div id="foto_kegiatan_row" class="collapse show" role="tabpanel" data-parent="#foto_kegiatan">
							<div class="card-body">
								<?php
								if ($mhs_pilih_perusahaaan != 'acc') {
									echo '<div class="alert alert-warning" role="alert">';
									echo 'Maaf Anda Belum Memperoleh Tempat Prakerin';
									echo '</div>';
								}else{
									if(!empty($nama_perusahaan) && !empty($long_perusahaan) && !empty($lat_perusahaan) && !empty($nama_negara) && !empty($nama_provinsi) && !empty($nama_kab_kota) && !empty($nama_kecamatan) && !empty($alamat_perusahaan) && !empty($telepon_perusahaan)){ 
										if(empty($t_mhs_review->row()->nim)){ 
											echo '<div class="alert alert-warning" role="alert">';
											echo 'Maaf Anda Belum Memberikan Ulasan';
											echo '</div>';
										}else{ ?>
											<?php 
											if($t_mhs_berkas_perusahaan->num_rows() <= 2){
											?>
											<form method="POST" action="<?php echo base_url('sig/prakerin/tambah_foto_prakerin')?>" enctype="multipart/form-data">
											<input type="hidden" name="id_mhs_pilih_perusahaan" value="<?= $id_mhs_pilih_perusahaan?>">
											<div class="row no-gutters">
												<div class="col-6 pr-1">
													<div class="form-group">
														<label>Nama Foto</label>	
														<input type="text" name="nama_foto" class="form-control" style="height: 40px" placeholder="Masukan Nama Foto" required>
													</div>
												</div>
												<div class="col-6 pr-1">
													<div class="form-group">
														<label>File Foto</label>	
														<input type="file" accept=".jpg,.png,.bmp,.jpeg" id="file" name="file" class="form-control" style="height: 40px">
													</div>
												</div>
											</div>
											<div class="form-group">
												<button class="btn_1" type="submit">Unggah Foto</button>
											</div>
											</form>
											<?php }?>
											<table class="table table-striped">
												<tbody>
													<?php
													foreach ($t_mhs_berkas_perusahaan->result() as $data_mhs_berkas_perusahaan) {
													?>
													<tr>
														<td><?= $data_mhs_berkas_perusahaan->nama_berkas_pilih_perusahaan?></td>
														<td >
															<a href="<?= base_url('file_upload/file_perusahaan/').$data_mhs_berkas_perusahaan->jenis_berkas_pilih_perusahaan?>">
																<img style="width: 60px; height: 36px;" src="<?= base_url('file_upload/file_perusahaan/').$data_mhs_berkas_perusahaan->jenis_berkas_pilih_perusahaan?>">
															</a>
														</td>
														<td style="width: 74px;"><a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_mhs_berkas_perusahaan->id_berkas_pilih_perusahaan ?>" role="button"><i class="ti-trash" style="color:#fff"></a></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										<?php }?>
									<?php }else{
										echo '<div class="alert alert-warning" role="alert">';
										echo 'Data Perusahaan Belum Lengkap';
										echo '</div>';
									}?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>