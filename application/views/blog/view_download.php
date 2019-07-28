<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>

<main>
	<div class="container">
		<div class="main_title_2">
			<p>
				<h3><?= $form_nama?></h3>
			</p>
			<span><em></em></span>
		</div>
		<div class="list_articles add_bottom_30 clearfix">
			<ul>
			<?php $no=1; foreach ($t_download as $data_download) {?>
				<li>	
					<h5><?= $data_download->nama_file?></h5>	
					<a style="color:blue" href="<?= base_url('file_upload/file_si/').$data_download->data_file?>"><i class="icon-download-1"></i> Klik Untuk Unduh</a>
				</li>
			<?php }?>
			</ul>
		</div>
	</div>
	<!-- /container -->
</main>
<!--/main-->
