<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>
<main>
	<div class="container margin_60_35">
		<div class="row">
			<?php 
			if ($form_nama == 'Berita') {?>
			<div class="col-lg-9">
				<div class="row">
					<?php
					function limit_words($string, $word_limit){
						$words = explode(" ",$string);
						return implode(" ",array_splice($words, 0, $word_limit));
					}
					foreach ($t_berita as $data_post) { ?>
					<div class="count_tampil col-md-6">
						<article class="blog">
							<figure>
								<a href="<?= site_url('blog/berita/'.$data_post->slug_berita)?>"><img
										src="<?= base_url('file_upload/file_si/').$data_post->gambar_berita?>" alt="">
									<div class="preview"><span>Lebih Lanjut</span></div>
								</a>
							</figure>
							<div class="post_info">
								<small><?= tgl_indo($data_post->tanggal_berita)?></small>
								<h5><a href="<?= base_url('blog/berita/'.$data_post->slug_berita)?>"><?= $data_post->nama_berita;?></a>
								</h5>
								<p><?= limit_words($data_post->konten_berita, 7).' ....'?></p>
							</div>
						</article>
						<!-- /article -->
					</div>
					<?php }?>
					<!-- /col -->
				</div>
				<!-- /row -->
				<div class="pagination__wrapper add_bottom_30">
					<ul class="pagination" style="background-color:#FFF;"></ul>
				</div>
				<!-- /pagination -->
			</div>
			<!-- /col -->
			<?php }else{?>
			<div class="col-lg-9">
				<div class="singlepost">
					<figure><img class="img-fluid" src="<?= base_url('file_upload/file_si/').$gambar_berita?>"></figure>
					<h1><?= $nama_berita?></h1>
					<div class="postmeta">
						<ul>
							<li><a href="#"><i class="ti-calendar"></i> <?= $tanggal_berita?></a></li>
						</ul>
					</div>
					<!-- /post meta -->
					<div class="post-content">
						<?= $konten_berita?>
					</div>
					<!-- /post -->
				</div>
				<!-- /single-post -->
			</div>
			<?php }?>
			<aside class="col-lg-3">
				<div class="widget search_blog">
					<div class="form-group">
						<input type="text" name="search" id="search" class="form-control" placeholder="Pencariaan..">
						<span><input type="submit" value="Cari"></span>
					</div>
				</div>
				<!-- /widget -->
				<div class="widget">
					<div class="widget-title">
						<h4>Berita Terbaru</h4>
					</div>
					<ul class="comments-list">
						<?php foreach ($t_popular_post as $data_popular_post) {?>
						<li>
							<div class="alignleft">
								<a href="#0"><img src="<?= base_url('file_upload/file_si/').$data_popular_post->gambar_berita?>" alt=""></a>
							</div>
							<small><?= tgl_indo($data_popular_post->tanggal_berita)?></small>
							<h3><a href="<?php echo site_url('blog/berita/')?><?php echo $data_popular_post->slug_berita?>"
									title="<?= $data_popular_post->nama_berita?>"><?= $data_popular_post->nama_berita?></a></h3>
						</li>
						<?php }?>
					</ul>
				</div>
				<!-- /widget -->
			</aside>
			<!-- /aside -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
<!--/main-->
