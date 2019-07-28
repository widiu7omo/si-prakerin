<body>
	<div id="page" class="theia-exception">
		<header class="header_in is_sticky">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-12">
						<div id="logo">
							<a href="<?= base_url('blog/home')?>">
								<img src="<?= base_url()?>assets/frontend/logo_si.png"  height="40"
									style="padding-left: 15px;" class="logo_sticky">
							</a>
						</div>
					</div>
					<div class="col-lg-9 col-12">
						<!-- /end top menu login -->
						<a href="#menu" class="btn_mobile">
							<div class="hamburger hamburger--spin" id="hamburger">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<nav id="menu" class="main-menu">
							<ul>
								<li><span><a href="<?= base_url('blog/home')?>"> Beranda</a></span></li>
								<?php
									$kategori = $this->db->select('*')->from('tabel_kategori')->get();
									foreach ($kategori->result() as $data_kategori) {
										echo '<li><span><a href="#"> '.$data_kategori->nama_kategori.'</a></span><ul>';
										$halaman = $this->db->select('*')->from('tabel_halaman')->where('id_kategori', $data_kategori->id_kategori)->get();
										foreach ($halaman->result() as $data_halaman) {
											echo '<li><a href="'.base_url('blog/halaman').'/'.$data_halaman->slug_halaman.'">'.$data_halaman->nama_halaman.'</a></li>';
										}
										echo '</ul></li>';
									}
								?>
								<li><span><a href="<?= base_url('blog/berita')?>"> Berita</a></span></li>
								<li><span><a href="<?= base_url('blog/download')?>"> Unduh Berkas</a></span></li>
								<li>
								<a href="" class="btn-success">Login</a>
									<ul>
										<li><a href="<?= base_url('login')?>">SIM-Prakerin</a></li>
										<li><a href="<?= base_url('sig/home')?>">SIG-Prakerin</a></li>
										<li><a href="<?= base_url('monev/login')?>">SIMONEP</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</header>
		<!-- /header -->