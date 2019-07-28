<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>
<main>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-5">
				<?php 
				foreach ($t_perusahaan as $data_perusahaan) {
				?>
				<section id="description">
					<div class="detail_title_1">
						<h2><?= $data_perusahaan->nama_perusahaan?></h2>
					</div>
					<h6><i class="ti-location-pin"></i> <?= $data_perusahaan->alamat_perusahaan?></h6>
					<h6><i class="ti-headphone"></i> <?= $data_perusahaan->telepon_perusahaan?></h6>
					<!-- /row -->
					<hr>
						<ul id="content-slider" class="content-slider">
						<?php foreach($t_berkas_mhs_pilih_perusahaan->result() as $data_berkas){?>
							<li style="background-color: #ed3020; text-align: center; color: #FFF;" data-responsive="<?= base_url('file_upload/file_perusahaan/').$data_berkas->jenis_berkas_pilih_perusahaan?>" data-src="<?= base_url('file_upload/file_perusahaan/').$data_berkas->jenis_berkas_pilih_perusahaan?>" data-sub-html="<p><?= $data_berkas->nama_berkas_pilih_perusahaan?></p>">
							<a href="<?= base_url('file_upload/file_perusahaan/').$data_berkas->jenis_berkas_pilih_perusahaan?>">
								<img src="<?= base_url('file_upload/file_perusahaan/').$data_berkas->jenis_berkas_pilih_perusahaan; ?>" style="width: 100%; height: 130px;"/>
								</a>
							</li>
						<?php } ?>
						</ul>
					<hr>
					<div id="mapid" style="position: relative;height: 350px;"></div>
				</section>
				<hr>
				<?php }?>
				<!-- /section -->
			</div>
			<!-- /col -->	
			<div class="col-lg-7">
				<section id="reviews">
					<div class="reviews-container">
						<div class="row">
							<div class="col-lg-3">
								<?php
									$row_jumlah = $t_jumlah_mhs_review->row();
									if (empty($row_jumlah)) {
										$rata 	= 0;
										$bin_satu = 0;
										$bin_dua = 0;
										$bin_tiga = 0;
										$bin_empat = 0;
										$bin_lima = 0;
									}else{
										$rata = (($row_jumlah->satu * 1) + ($row_jumlah->dua * 2) + ($row_jumlah->tiga * 3) + ($row_jumlah->empat * 4) + ($row_jumlah->lima *5)) / $row_jumlah->jumlah;
										$bin_satu = ($row_jumlah->satu / $row_jumlah->jumlah) * 100;
										$bin_dua = ($row_jumlah->dua / $row_jumlah->jumlah) * 100;
										$bin_tiga = ($row_jumlah->tiga / $row_jumlah->jumlah) * 100;
										$bin_empat = ($row_jumlah->empat / $row_jumlah->jumlah) * 100;
										$bin_lima = ($row_jumlah->lima / $row_jumlah->jumlah) * 100;
									}
								?>
								<div id="review_summary" style="background-color:#004dda;">
									<em>Rata - Rata</em>
									<strong><?= round($rata, 1)?></strong>
									<small>Dari 
									<?php 
										if(!empty($t_mhs_review->num_rows())){
											echo $t_mhs_review->num_rows(); 
										}else{
											echo '0';
										} 
									?> Pengulas</small>
								</div>
							</div>
							<div class="col-lg-9">
								<div class="row">
									<div class="col-lg-11 col-11">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $bin_lima?>%; background-color:#004dda;" aria-valuenow="90"
												aria-valuemin="0" aria-valuemax="100">5 Bintang</div>
										</div>
									</div>
									<div class="col-lg-1 col-1"><small><strong><?= $row_jumlah->lima?></strong></small></div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-lg-11 col-11">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $bin_empat;?>%; background-color:#004dda;" aria-valuenow="95"
												aria-valuemin="0" aria-valuemax="100">4 Bintang</div>
										</div>
									</div>
									<div class="col-lg-1 col-1"><small><strong><?= $row_jumlah->empat?></strong></small></div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-lg-11 col-11">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $bin_tiga;?>%; background-color:#004dda;" aria-valuenow="60"
												aria-valuemin="0" aria-valuemax="100">3 Bintang</div>
										</div>
									</div>
									<div class="col-lg-1 col-1"><small><strong><?= $row_jumlah->tiga?></strong></small></div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-lg-11 col-11">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $bin_dua;?>%; background-color:#004dda;" aria-valuenow="20"
												aria-valuemin="0" aria-valuemax="100">2 Bintang</div>
										</div>
									</div>
									<div class="col-lg-1 col-1"><small><strong><?= $row_jumlah->dua?></strong></small></div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-lg-11 col-11">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $bin_satu;?>%; background-color:#004dda;" aria-valuenow="0" aria-valuemin="0"
												aria-valuemax="100">1 Bintang</div>
										</div>
									</div>
									<div class="col-lg-1 col-1"><small><strong><?= $row_jumlah->satu?></strong></small></div>
								</div>
								<!-- /row -->
							</div>
						</div>
						<!-- /row -->
					</div>
					<hr>
					<div class="reviews-container">
						<!-- /review-box -->
						<?php
						if(empty($t_mhs_review->row()->nim)){
							echo '<div class="alert alert-info" role="alert"><b>Info !</b> Belum ada ulasan pada perusahan ini</div>';
						}else{
							foreach ($t_mhs_review->result() as $data_mhs_review) {
						?>
						<div class="count_tampil review-box clearfix">
							<figure class="rev-thumb"><img src="<?= base_url('assets/frontend/img/')?>user_default.png" alt="">
							</figure>
							<div class="rev-content">
								<strong><?= $data_mhs_review->nama_mahasiswa.' | '.$data_mhs_review->nim?></strong>
								<div class="rev-info">
									<?= tgl_indo($data_mhs_review->tanggal_review_perusahaan)?>
								</div>
								<table class="table table-striped">
									<tbody>
									<?php 
									$query_oke = $this->db->select('tb_perusahaan_review.id_perusahaan, tb_perusahaan_review.nim, tb_perusahaan_review.rating_perusahaan, tb_perusahaan_review.komentar, tb_perusahaan_review.tanggal_review_perusahaan, tb_perusahaan.nama_perusahaan, tb_data_kuisioner.soal_kuisioner')
									->from('tb_perusahaan_review')
									->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
									->join('tb_data_kuisioner', 'tb_data_kuisioner.id_data_kuisioner = tb_perusahaan_review.id_data_kuisioner')
									->where('tb_perusahaan_review.nim', $data_mhs_review->nim)->get();
									foreach ($query_oke->result() as $data_perusahaan_review) { ?>
										<tr>
											<td><?= $data_perusahaan_review->soal_kuisioner?></td>
											<?php
											if ($data_perusahaan_review->rating_perusahaan == '1') {
												$ket = '<span>Kurang<em></em></span>';
											}elseif($data_perusahaan_review->rating_perusahaan == '2'){
												$ket = '<span>Cukup<em></em></span>';
											}elseif($data_perusahaan_review->rating_perusahaan == '3'){
												$ket = '<span>Cukup Baik<em></em></span>';
											}elseif($data_perusahaan_review->rating_perusahaan == '4'){
												$ket = '<span>Baik<em></em></span>';
											}elseif($data_perusahaan_review->rating_perusahaan == '5'){
												$ket = '<span>Sangat Baik<em></em></span>';
											}else{
												$ket = '';
											}
											?>
											<td style="width: 150px; text-align:right;">
												<div class="score"><?= $ket?><strong style="background-color:#004dda;"><?= $data_perusahaan_review->rating_perusahaan?></strong></div>					
											</td>
										</tr>
									<?php } ?>	
									</tbody>
								</table>
								<div class="rev-text">
									<p><b>Komentar : </b>
										<?= $data_mhs_review->komentar?>
									</p>
								</div>
							</div>
						</div>			
						<?php } 
						}	?>		
						<!-- /review-box -->
						<div class="pagination__wrapper">
							<ul class="pagination" style="background-color:#FFF;"></ul>
						</div>
					</div>
					<!-- /review-container -->
				</section>
				<!-- /section -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->

</main>
<!--/main-->
