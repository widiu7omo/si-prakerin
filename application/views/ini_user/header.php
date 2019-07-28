<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>SIG Prakarin</title>
	<?php if($komponen == 'home'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/font.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/vendor.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/elephant.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/application.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/demo.min.css">
	<?php }elseif($komponen == 'view'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/font.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/vendor.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/elephant.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/application.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/demo.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/toast/css/jquery.toast.css">
	<?php }elseif($komponen == 'action'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/font.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/vendor.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/elephant.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/application.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/demo.min.css">
	<?php }elseif($komponen == 'maps'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/font.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/vendor.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/elephant.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/application.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/user/css/demo.min.css">

	<!--Leaflet Maps Library Css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.Default.css" />
	
	<!--Leaflet Maps Library JavaScript-->
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/jquery.min.js'></script>
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	<?php }else{ echo "Kosong";}?>
</head>

<body class="layout layout-header-fixed">
	<div class="layout-header">
		<div class="navbar navbar-default">
			<div class="navbar-header">
				<a class="navbar-brand navbar-brand-center" href="<?= base_url()?>">
					<img class="navbar-brand-logo" src="<?= base_url()?>assets/user/img/logo-inverse.svg" alt="Elephant">
				</a>
				<button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
					data-target="#sidenav">
					<span class="sr-only">Toggle navigation</span>
					<span class="bars">
						<span class="bar-line bar-line-1 out"></span>
						<span class="bar-line bar-line-2 out"></span>
						<span class="bar-line bar-line-3 out"></span>
					</span>
					<span class="bars bars-x">
						<span class="bar-line bar-line-4"></span>
						<span class="bar-line bar-line-5"></span>
					</span>
				</button>
				<button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
					data-target="#navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="arrow-up"></span>
					<span class="ellipsis ellipsis-vertical">
						<img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
					</span>
				</button>
			</div>
			<div class="navbar-toggleable">
				<nav id="navbar" class="navbar-collapse collapse">
					<button class="sidenav-toggler hidden-xs" title="Collapse sidenav ([)" aria-expanded="true" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="bars">
							<span class="bar-line bar-line-1 out"></span>
							<span class="bar-line bar-line-2 out"></span>
							<span class="bar-line bar-line-3 out"></span>
							<span class="bar-line bar-line-4 in"></span>
							<span class="bar-line bar-line-5 in"></span>
							<span class="bar-line bar-line-6 in"></span>
						</span>
					</button>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown hidden-xs"> <button class="navbar-account-btn" data-toggle="dropdown"
								aria-haspopup="true">
								<!--<img class="circle" width="36" height="36" src="<?= base_url()?>assets/img/0180441436.jpg"
									alt="Teddy Wilson">-->Hi | <?= $this->session->userdata('id');?>
								<span class="caret"></span> </button>
								<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?= base_url('sig/login/login_out')?>">
									<h5 class="navbar-upgrade-heading">Keluar</h5>
								</a></li>
								<li class="divider"></li>
							</ul>
						</li>
						<li class="visible-xs-block">
							<a href="contacts.html">
								<span class="icon icon-users icon-lg icon-fw"></span>
								Contacts
							</a>
						</li>
						<li class="visible-xs-block">
							<a href="profile.html">
								<span class="icon icon-user icon-lg icon-fw"></span>
								Profile
							</a>
						</li>
						<li class="visible-xs-block">
							<a href="login-1.html">
								<span class="icon icon-power-off icon-lg icon-fw"></span>
								Sign out
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="layout-main">
