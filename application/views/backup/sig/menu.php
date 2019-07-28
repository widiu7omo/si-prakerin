<body>
	<div class="ts-page-wrapper ts-homepage" id="page-top">
		<header id="ts-header" class="fixed-top">
			<nav id="ts-primary-navigation" class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<a class="navbar-brand" href="#">
						<img src="<?= base_url()?>assets/free_user/img/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary"
						aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarPrimary">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url('sig/home')?>">HOME</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mr-2" href="<?= base_url('sig/maps')?>">MAP PERUSAHAAN</a>
							</li>
							<?php
								if($this->session->userdata('level') == 'mahasiswa'){
							?>
							<li class="nav-item">
								<a class="nav-link mr-2" href="<?= base_url('sig/perusahaan')?>">DATA PERUSAHAAN</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mr-2" href="<?= base_url('sig/perusahaan')?>">PROFILE DIRI</a>
							</li>
							<?php }else{ ?>
							<li class="nav-item">
								<a class="nav-link mr-2" href="<?= base_url('sig/login')?>">LOGIN</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
