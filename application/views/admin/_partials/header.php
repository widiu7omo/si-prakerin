<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
    <!-- Favicon -->
    <link href="<?php echo base_url('aset/img/brand/favicon.png') ?>" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?php echo base_url('aset/vendor/nucleo/css/nucleo.css') ?> " rel="stylesheet">
    <link href="<?php echo base_url('aset/vendor/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <!-- Optional CSS -->
    <link rel="stylesheet" href="<?php echo base_url('aset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('aset/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('aset/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('aset/vendor/introjs/introjs.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('aset/vendor/dropzone/dist/min/dropzone.css') ?>">
    <!-- Argon CSS -->
    <link type="text/css" href="<?php echo base_url('aset/css/argonpro.css') ?>" rel="stylesheet">
	<style>
		.pulsate {
			background-color: #ff6666;
			color: #fff;
		}


		.pulsate::before {
			content: '';
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			-webkit-animation: pulse 0.9s ease infinite;
			animation: pulse 0.9s ease infinite;
			border-radius: 50%;
			border: 9px double #ff8080;
		}

		@-webkit-keyframes pulse {
			0% {
				-webkit-transform: scale(3);
				transform: scale(3);
				opacity: 0.6;
			}
			60% {
				-webkit-transform: scale(1);
				transform: scale(1);
				opacity: 0.4;
			}
			100% {
				-webkit-transform: scale(5);
				transform: scale(5);
				opacity: 0;
			}
		}

		@keyframes pulse {
			0% {
				-webkit-transform: scale(3);
				transform: scale(3);
				opacity: 0.6;
			}
			60% {
				-webkit-transform: scale(1);
				transform: scale(1);
				opacity: 0.4;
			}
			100% {
				-webkit-transform: scale(5);
				transform: scale(5);
				opacity: 0;
			}
		}


	</style>
</head>
