<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'user/_partials/header.php' ); ?>
<?php $this->load->helper( [ 'master', 'progress' ] );
$nim      = $this->session->userdata( 'id' );
$where    = "(status = 'proses' or status = 'terima' or status = 'cetak' or status = 'pending' or status = 'kirim') AND nim = '{$nim}'";
$join     = [ 'tb_perusahaan', 'tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan', 'left outer' ];
$select   = [ 'tb_perusahaan.nama_perusahaan', 'tb_perusahaan.id_perusahaan', 'tb_perusahaan_sementara.status' ];
$approval = datajoin( 'tb_perusahaan_sementara', $where, $select, $join );
//    var_dump($countApproval);
$exist         = false;
$id_perusahaan = null;
if ( count( $approval ) == 1 || count( $approval ) > 1 ) {
	$exist         = true;
	$id_perusahaan = $approval[0]->id_perusahaan;
}
function getTempMhs( $id ) {
	$joins[0] = [
		'tb_perusahaan',
		'tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan',
		'left outer'
	];
	$joins[1] = [ 'tb_mahasiswa', 'tb_perusahaan_sementara.nim = tb_mahasiswa.nim', 'left outer' ];
	$select   = [ 'nama_mahasiswa' ];
	$where    = "tb_perusahaan_sementara.id_perusahaan = {$id} 
	              AND (tb_perusahaan_sementara.status = 'proses'
	               OR tb_perusahaan_sementara.status = 'cetak'
	               OR tb_perusahaan_sementara.status = 'pending'
	               OR tb_perusahaan_sementara.status = 'terima'
	               OR tb_perusahaan_sementara.status = 'kirim')";

	return datajoin( 'tb_perusahaan_sementara', $where, $select, $joins, null );
}

?>
<body class="g-sidenav-hidden">
<!-- Sidenav PHP-->
<?php $this->load->view( 'user/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view( 'user/_partials/topnav.php' );
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view( 'user/_partials/breadcrumb.php' ); ?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="card text-white bg-gradient-secondary">
						<!--                        <img class="card-img-top" src="holder.js/100px180/" alt="">-->
						<div class="card-header">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<h2 class="card-title">MAAF,&nbsp;<?php echo isset($status)?$status:null?></h2>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view( 'user/_partials/footer.php' ); ?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'user/_partials/modal.php' ); ?>
<?php $this->load->view( 'user/_partials/js.php' ); ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
