<body>
	<div id="page">
		<header class="header_in is_sticky">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-12">
						<div id="logo">
							<a href="<?= base_url('sig')?>">
								<img src="<?= base_url()?>assets/frontend/logo_sig.png"  height="40"
									style="padding-left: 15px;" class="logo_sticky">
							</a>
						</div>
					</div>
					<div class="col-lg-9 col-12">
						<?php 
						$i = 0;
						if($form_nama == 'Data Prakerin' && empty($t_mhs_review->row()->nim)) { ?>
						<div class="modal fade" id="reviewperusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Beri Ulasan Perusahaan</h5>
									</div>
									<form action="<?php echo base_url('sig/prakerin/tambah_review_perusahaan')?>" method="POST">
									<div class="modal-body">
										<table class="table table-striped">
											<tbody>
												<?php
												$count = 0;
												foreach ($t_soal_kuesioner as $data_soal_kuesioner) {
												?>
												<tr>
													<input type="hidden" class="form-control" name="id_data_kuisioner[<?= $count?>]" value="<?= $data_soal_kuesioner->id_data_kuisioner?>">
													<td><?= $data_soal_kuesioner->soal_kuisioner?></td>
													<td style="width: 189px">
													<div class="stars" required>
														<input type="radio" name="rating_perusahaan<?= $count?>" class="star-1" id="<?= $data_soal_kuesioner->id_data_kuisioner?>1" value="1" required/>
														<label class="star-1" for="<?= $data_soal_kuesioner->id_data_kuisioner?>1">1</label>
														<input type="radio" name="rating_perusahaan<?= $count?>" class="star-2" id="<?= $data_soal_kuesioner->id_data_kuisioner?>2" value="2" required/>
														<label class="star-2" for="<?= $data_soal_kuesioner->id_data_kuisioner?>2">2</label>
														<input type="radio" name="rating_perusahaan<?= $count?>" class="star-3" id="<?= $data_soal_kuesioner->id_data_kuisioner?>3" value="3" required/>
														<label class="star-3" for="<?= $data_soal_kuesioner->id_data_kuisioner?>3">3</label>
														<input type="radio" name="rating_perusahaan<?= $count?>" class="star-4" id="<?= $data_soal_kuesioner->id_data_kuisioner?>4" value="4" required/>
														<label class="star-4" for="<?= $data_soal_kuesioner->id_data_kuisioner?>4">4</label>
														<input type="radio" name="rating_perusahaan<?= $count?>" class="star-5" id="<?= $data_soal_kuesioner->id_data_kuisioner?>5" value="5" required/>
														<label class="star-5" for="<?= $data_soal_kuesioner->id_data_kuisioner?>5">5</label>
														<span></span>
													</div>
													</td>
												</tr>
												<?php $count++; }?>
											</tbody>
										</table>
										<label>Komentar</label>
										<textarea class="form-control" name="komentar"  minlength="40" rows="5" placeholder="Masukan Komentar Anda" required></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
										<button class="btn btn-primary" type="submit">Kirim Ulasan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<?php }elseif($form_nama == 'Data Prakerin' && !empty($t_mhs_review->row()->nim)){?>
						<?php foreach ($t_mhs_berkas_perusahaan->result() as $data_mhs_berkas_perusahaan) { ?>
						<div class="modal fade" id="Hapus<?= $data_mhs_berkas_perusahaan->id_berkas_pilih_perusahaan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Konfirmasi Hapus</h5>
									</div>
									<form action="<?php echo base_url('sig/prakerin/hapus_foto_perusahaan')?>" method="POST">
									<div class="modal-body">
										<h4 class="text-warning">Anda Yakin Menghapus</h4>
              							<p>Foto : <?= $data_mhs_berkas_perusahaan->nama_berkas_pilih_perusahaan;?></p>
										  	<input type="hidden" name="id_berkas_pilih_perusahaan" value="<?= $data_mhs_berkas_perusahaan->id_berkas_pilih_perusahaan?>">  
											<input type="hidden" name="jenis_berkas_pilih_perusahaan" value="<?= $data_mhs_berkas_perusahaan->jenis_berkas_pilih_perusahaan?>">  
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
										<button class="btn btn-primary" type="submit">Menghapus</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php }elseif($form_nama == 'Informasi Profil'){ ?>
							<div class="modal fade" id="UploadFotoDiri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Ubah Foto Profil</h5>
										</div>
										<form action="<?php echo base_url('sig/prakerin/ubah_foto_profile')?>" method="POST">
										<div class="modal-body">
											<div class="form-group">
												<label>File Foto</label>	
												<input type="file" accept=".jpg,.png,.bmp,.jpeg" id="file" name="file" class="form-control">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
											<button class="btn btn-primary" type="submit">Mulai Merubah</button>
										</div>
										</form>
									</div>
								</div>
							</div>
						<?php }?>
						<a href="#menu" class="btn_mobile">
							<div class="hamburger hamburger--spin" id="hamburger">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<nav id="menu" class="main-menu">
							<ul>
								<li><span><a href="<?= base_url('sig/home')?>"><i class="ti-home"></i> Beranda</a></span></li>
								<?php if($this->session->userdata('level') != 'mahasiswa'){?>
								<li><a class="btn-success" style="background-color:#004dda;" href="<?php echo base_url('sig/login');?>"><i class="pe-7s-next-2"></i> Masuk</a>
								</li>
								<?php }else{ ?> <!--<li><span><a href="<?= base_url('sig/perusahaan')?>"><i class="ti-bookmark-alt"></i> Data
											Perusahaan</a></span></li>-->
								<li><span><a href="<?= base_url('sig/prakerin')?>"><i class="ti-briefcase"></i> Prakerin</a></span></li>
								<li><a class="btn-success" style="background-color:#004dda;" href="#sign-out"> 
								<?php 
									$nama = $this->db->select('nim, nama_mahasiswa')
											->from('tb_mahasiswa')
											->where('nim', $this->session->userdata('id'))
											->get()->row();
									echo $nama->nim.' | '.$nama->nama_mahasiswa;
								?>	
								</a>
									<ul>
										<!--<li><a href="<?= base_url('sig/profile')?>">Perofile</a></li>-->
										<li><a href="<?= base_url('sig/login/login_out')?>">Keluar</a></li>
									</ul>
								</li>
								<?php } ?>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</header>
		<!-- /header -->