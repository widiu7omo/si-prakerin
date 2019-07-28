<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' ); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view( 'admin/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view( 'admin/_partials/topnav.php' );
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view( 'admin/_partials/breadcrumb.php' );
	?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-6">
				<!--* Card header *-->
				<!--* Card body *-->
				<!--* Card init *-->
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<!-- Surtitle -->
						<h6 class="surtitle">Overview</h6>
						<!-- Title -->
						<h5 class="h3 mb-0">Total sales</h5>
					</div>
					<!-- Card body -->
					<div class="card-body">
						<div class="chart">

							<!-- Chart wrapper -->
							<canvas id="chart-sales"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6">
				<!--* Card header *-->
				<!--* Card body *-->
				<!--* Card init *-->
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<!-- Surtitle -->
						<h6 class="surtitle">Prakerin berdasarkan status</h6>
						<!-- Title -->
						<h5 class="h3 mb-0">Total mahasiswa</h5>
					</div>
					<!-- Card body -->
					<div class="card-body">
						<div class="chart">

							<!-- Chart wrapper -->
							<canvas id="chart-area"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<?php $this->load->view('admin/_partials/footer.php')?>
	<!-- Footer -->

</div>


<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/js.php' );
?>
<script>
	<?php
	$total = custom_query( "SELECT COUNT(*) as jumlah FROM tb_mahasiswa" );
	$ditolak = custom_query( "SELECT  COUNT(*) as jumlah FROM ( SELECT *  FROM tb_perusahaan_sementara  WHERE status = 'tolak' GROUP BY nim) tps " );
	$masuk = custom_query( "SELECT  COUNT(*) as jumlah FROM ( SELECT *  FROM tb_perusahaan_sementara  WHERE status = 'masuk' GROUP BY nim) tps " );
	$diterima = custom_query( "SELECT  COUNT(*) as jumlah FROM ( SELECT *  FROM tb_perusahaan_sementara  WHERE status = 'terima' GROUP BY nim) tps " );
	$pending = custom_query( "SELECT  COUNT(*) as jumlah FROM ( SELECT *  FROM tb_perusahaan_sementara  WHERE status = 'pending' OR status = 'kirim'  GROUP BY nim) tps " );
	$belum = $total->jumlah - ( $ditolak->jumlah + $pending->jumlah + $diterima->jumlah + $masuk->jumlah );
	$datachart = array(
		(int) $masuk->jumlah,
		(int) $pending->jumlah,
		(int) $diterima->jumlah,
		(int) $ditolak->jumlah,
		$belum
	);
	?>
    let randomScalingFactor = function () {
        return Math.round(Math.random() * 100);
    };

    let config = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo json_encode( $datachart ) ?>,
                backgroundColor: [
                    'purple',
                    'aqua',
                    'green',
                    'red',
                    'orange'
                ],
                label: 'Jumlah Mahasiswa Magang berdasarkan status'
            }],
            labels: [
                'Masuk',
                'Pending',
                'Diterima',
                'Ditolak',
                'Belum Mengajukan'
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                labels: {}
            },
            tooltips: {
                enabled: true
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(1) + "%";
                        return percentage;
                    },
                    color: '#020',
                    anchor: 'center',
                    clip: true,
                    display: "auto"
                }
            }

        }
    };

    window.onload = function () {
        let ctx = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
