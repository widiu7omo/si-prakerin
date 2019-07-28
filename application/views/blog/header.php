<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php if($form_nama == 'Detail Berita'){ echo $nama_berita.' - '; }elseif($form_nama == 'Halaman'){ echo $t_halaman->nama_halaman.' - '; } ?>Sistem Informasi Prakerin</title>
    <!-- Favicons-->
    <meta name="description" content="<?php if($form_nama == 'Detail Berita'){ echo $nama_berita; }elseif($form_nama == 'Halaman'){ echo $t_halaman->nama_halaman; } ?>">
    <?php if($komponen == 'home'){ ?>
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?= base_url()?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
		<link href="<?= base_url()?>assets/frontend/css/vendors.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url()?>assets/frontend/css/custom.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/css/blog.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/media/lightgallery.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/frontend/media/lightslider.css" rel="stylesheet">
    <script src="<?= base_url()?>assets/frontend/media/jquery.min.js"></script>
		<?php }?>
</head>