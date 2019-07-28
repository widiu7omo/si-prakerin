<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SIG Tempat Prakerin">
    <meta name="author" content="SIG">
    <title>SIG Tempat Prakerin</title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
    <?php if($komponen == 'login'){ ?>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?= base_url()?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
		<link href="<?= base_url()?>assets/frontend/css/vendors.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url()?>assets/frontend/css/custom.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/blog.css" rel="stylesheet">
    <?php }elseif($komponen == 'home'){ ?>
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?= base_url()?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
		<link href="<?= base_url()?>assets/frontend/css/vendors.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url()?>assets/frontend/css/custom.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/blog.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/autocomplete/jquery-ui.css" rel="stylesheet">
		<!--Leaflet Maps Library Css-->
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/routing/leaflet-routing-machine.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.Default.css" />
		<?php }elseif($komponen == 'perusahaan'){ ?>
		<!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?= base_url()?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
		<link href="<?= base_url()?>assets/frontend/css/vendors.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url()?>assets/frontend/css/custom.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/blog.css" rel="stylesheet">
      
    <link href="<?= base_url()?>assets/frontend/media/lightslider.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/media/lightgallery.css" rel="stylesheet">
    <!--Leaflet Maps Library Css-->
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.css"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.Default.css"/>

    <?php }elseif($komponen == 'prakerin'){ ?>
      <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?= base_url()?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
		<link href="<?= base_url()?>assets/frontend/css/vendors.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url()?>assets/frontend/css/custom.css" rel="stylesheet">
    
    <link href="<?= base_url()?>assets/frontend/media/lightgallery.css" rel="stylesheet">
    <!--Rating Library -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/frontend/rating/rating-radio.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.css"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/MarkerCluster.Default.css"/>
		<?php }else{ echo "Kosong";}?>
</head>