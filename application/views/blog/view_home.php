<!--<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>-->
<div class="main_title_2" style="padding-top: 0.5px;">
	<div class="bd-example">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php 
					$ice = 0; 
					foreach ($t_media_slideshows as $data_media) {?>
				<li data-target="#carouselExampleCaptions" data-slide-to="<?= $ice ++; ?>"></li>
				<?php } ?>
			</ol>
			<div class="carousel-inner">
				<?php 
					$ices = 0; 
					foreach ($t_media_slideshows as $data_media) {
				?>
				<div class="carousel-item <?php if($ices == 0){ echo 'active'; } ?>">
					<img src="<?= base_url('file_upload/file_si/').$data_media->data_foto?>" class="d-block w-100" alt="">
					<div class="carousel-caption d-none d-md-block">
					<h5><?= $data_media->nama_foto?></h5>
					<h6><?= $data_media->deskripsi_foto?></h6>
					</div>
				</div>
				<?php $ices++; } ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span>Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span>Next</span>
			</a>
		</div>
	</div>
</div>
<main>
	<div class="container">
		<div class="main_title_2">
			<p>
				<h2>Berita Terbaru</h2>
			</p>
			<span><em></em></span>
		</div>
		<div class="row">
		<?php
		function limit_words($string, $word_limit){
			$words = explode(" ",$string);
			return implode(" ",array_splice($words, 0, $word_limit));
		}
		foreach ($t_popular_post as $data_post) { ?>
			<div class="col-lg-6">
				<a class="box_news" href="<?= base_url('blog/berita/')?><?= $data_post->slug_berita?>">
					<figure><img src="<?= base_url('file_upload/file_si/').$data_post->gambar_berita?>" alt="">
					</figure>
					<ul>
						<li><?= tgl_indo($data_post->tanggal_berita)?></li>
					</ul>
					<h4><?= $data_post->nama_berita;?></h4>
					<p><?= limit_words($data_post->konten_berita, 7).' ....'?></p>
				</a>
			</div>
			<?php }?>
		</div>
		<!-- /row -->
		<p class="btn_home_align"><a href="<?= base_url('blog/berita')?>" class="btn_1 rounded">Semua Berita</a></p>
	</div>
	<!-- /container -->
	<div class="container">
		<div class="main_title_2">
			<p>
				<h2>Galeri Prakerin</h2>
			</p>
			<span><em></em></span>
		</div>
		<ul id="lightgallery" class="list-unstyled row">
			<?php foreach ($t_media as $data_media) {?>
			<li class="col-lg-3 col-sm-6" data-responsive="<?= base_url('file_upload/file_si/').$data_media->data_foto?>"
				data-src="<?= base_url('file_upload/file_si/').$data_media->data_foto?>" data-sub-html="<h3 style='color:#004DDA'><?= $data_media->nama_foto?></h3><p><?= $data_media->deskripsi_foto?></p>">
				<a href="detail-hotel.html" class="grid_item small">
					<figure>
						<img src="<?= base_url('file_upload/file_si/').$data_media->data_foto?>">
						<div class="info">
							<h3><?= $data_media->nama_foto?></h3>
						</div>
					</figure>
				</a>
			</li>
			<?php }?>
		</ul>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
<!--/main-->
