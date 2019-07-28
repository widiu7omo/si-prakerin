<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('kuesioner/_partials/header.php');?>

<body>
	<!-- Sidenav PHP-->
	<?php $this->load->view('kuesioner/_partials/sidenav.php');?>
	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav PHP-->
		<?php $this->load->view('kuesioner/_partials/topnav.php');
         ?>
		<!-- Header -->
		<!-- BreadCrumb PHP -->
		<?php $this->load->view('kuesioner/_partials/breadcrumb.php');
         ?>
		<!-- Page content -->
		<div class="container-fluid mt-4">
            <!-- Iframe -->
            <iframe width="100%" height="550px" src="https://docs.google.com/forms/d/e/1FAIpQLSf4vBOal86bn20kJL-J9qOOFCCWP_Q_Chb9Qf6F4XQGp-IGYQ/viewform?usp=sf_link" frameborder="0">
                <p>Your browser not support, plase update or change your browser</p>
            </iframe>
			<!-- Footer PHP -->
			<?php $this->load->view('kuesioner/_partials/footer.php');?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('kuesioner/_partials/js.php');
    ?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
