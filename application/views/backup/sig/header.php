<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Prakerin Politeknik Negeri Tanah Laut</title>
	<!--CSS -->
	<?php if($komponen == 'home'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/css/style.css">
	<?php }elseif($komponen == 'maps'){ ?>
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/free_user/css/style.css">
	
	<!--Leaflet Maps Library Css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/autocomplete/jquery-ui.css" />
	
	<?php }else{ echo "Kosong";}?>
</head>