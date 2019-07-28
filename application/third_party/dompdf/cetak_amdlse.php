<?php

		require_once('dompdf/dompdf_config.inc.php');
		include 'config.php';

		$no_amdlse = $_GET['no_amdlse'];

		include 'config.php';
	    $query = mysqli_query($connect,"SELECT *, tb_kapal.nama AS nama_kapal, tb_eksportir.nama AS nama_eskportir, tb_eksportir.alamat AS alamat_eskportir FROM tb_amandemenlse 
	    JOIN tb_perbaikan ON tb_amandemenlse.kd_perbaikan = tb_perbaikan.kd_perbaikan
	    JOIN tb_pveb ON tb_amandemenlse.no_pveb = tb_pveb.no_pveb
	    JOIN tb_lse ON tb_amandemenlse.no_lse = tb_lse.no_lse
	    JOIN tb_eksportir ON tb_amandemenlse.npwp = tb_eksportir.npwp
	    JOIN tb_pegawai ON tb_amandemenlse.npp = tb_pegawai.npp
	    JOIN tb_kapal ON tb_amandemenlse.kd_kapal = tb_kapal.kd_kapal WHERE tb_amandemenlse.no_amdlse = '$no_amdlse'");
	    while ($data = mysqli_fetch_assoc($query)) {
	    	$no_amdlse = $data['no_amdlse'];
	    	$get_tanggal = date_create($data['tanggal']);
	    	$tanggal = date_format($get_tanggal, "d-M-Y");

	    	$no_lse = $data['no_lse'];
	    	$get_tanggal_lse = date_create($data['tanggallse']);
	    	$tanggal_lse = date_format($get_tanggal_lse, "d-M-Y");

	    	$no_pveb = $data['no_pveb'];
	    	$get_tanggal_pveb = date_create($data['tanggalpveb']);
	    	$tanggal_pvbe = date_format($get_tanggal_pveb, "d-M-Y");

	    	$nama_eskportir = $data['nama_eskportir'];
	    	$alamat_eskportir = $data['alamat_eskportir'];

	    	$nama_kapal = $data['nama_kapal'];
	    	
	    	$get_tglinvoice_tertulis = date_create($data['tglinvoice_tertulis']);
	    	$tglinvoice_tertulis = date_format($get_tglinvoice_tertulis, "d-M-Y");

	    	$get_tglinvoice_seharusnya = date_create($data['tglinvoice_seharusnya']);
	    	$tglinvoice_seharusnya = date_format($get_tglinvoice_seharusnya, "d-M-Y");

	    	$nilaifob_tertulis = $data['nilaifob_tertulis'];
	    	$nilaifob_seharusnya = $data['nilaifob_seharusnya'];

	    	$ket = $data['ket'];
	    };

$html = '
<html>
<head>
	<title>Cetak Data</title>
	<style type="text/css">
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	}
	@page {
		margin: 0cm 0cm;
	}
	body {
		margin-top: 3cm;
		margin-left: 2cm;
		margin-right: 2cm;
		margin-bottom: 2cm;
	}
	</style>
</head>
<body>
		
	<table border="0" align="center">
		<tbody >
			<tr>
				<td><font style="font-size: 14"><b><u>AMANDEMEN Laporan Surveyor Ekspor (LSE)</u></b></font></h5></td>
			</tr>
			<tr align="center">
				<td><font style="font-size: 12">Nomor : '.$no_amdlse.' </font></td>
			</tr>
			<tr align="center">
				<td><font style="font-size: 12">Tanggal : '.$tanggal.'</font></td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>

	<table align="center" border="0" width="100%">
		<tbody>
			<tr align="left" valign="top">
				<td width="180px"><font style="font-size: 12">
				Nomor Dan Tangal LSE</font></h5>
				</td>
				<td width="10px">:</td>
				<td>
					'.$no_lse.'- Tgl. '.$tanggal_lse.'
				</td>
			</tr>
			<tr align="left" valign="top">
				<td><font style="font-size: 12">
				Nomor Dan Tangal PVEB</font></h5>
				</td>
				<td align="left" valign="top">:</td>
				<td align="left" valign="top">
					'.$no_pveb.'- Tgl. '.$tanggal_pvbe.'
				</td>
			</tr>
			<tr align="left" valign="top">
				<td><font style="font-size: 12">
				Nama Eksportir</font></h5>
				</td>
				<td>:</td>
				<td align="left" valign="top">
					<b>'.$nama_eskportir.'</b>
				</td>
			</tr>
			<tr align="left" valign="top">
				<td><font style="font-size: 12">
				Alamat Eksportir</font></h5>
				</td>
				<td >:</td>
				<td >
					'.$alamat_eskportir.'
				</td>
			</tr>
			<tr>
				<td><font style="font-size: 12">
				Nama Kapal</font></h5>
				</td>
				<td>:</td>
				<td>
					'.$nama_kapal.'
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
		<font style="font-size: 12;">
			Dilakukan Perubahan Data  Sebagai Berikut :
		</font>
	</p>
	<br>
	<table border="1" align="center" width="100%">
		<thead>
			<tr>
				<th><font style="font-size: 12">No.</font></th>
				<th><font style="font-size: 12">Kolom</font></th>
				<th><font style="font-size: 12">Tertulis</font></th>
				<th><font style="font-size: 12">Seharusnya</font></th>
				<th><font style="font-size: 12">Keterangan</font></th>
			</tr>
		</thead>

		<tbody align="center">
			<tr>
				<td><font style="font-size: 12">1</font></td>
				<td><font style="font-size: 12">Tanggal Invoice</font></td>
				<td><font style="font-size: 12">'.$tglinvoice_tertulis.'</font></td>
				<td><font style="font-size: 12">'.$tglinvoice_seharusnya.'</font></td>
				<td rowspan="2"><font style="font-size: 12">'.$ket.'</font></td>
			</tr>
			<tr>
				<td><font style="font-size: 12">2</font></td>
				<td><font style="font-size: 12">Nillai FOB (Usd)</font></td>
				<td><font style="font-size: 12">'.$nilaifob_tertulis.'</font></td>
				<td><font style="font-size: 12">'.$nilaifob_seharusnya.'</font></td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
		<font style="font-size: 12;">
			Selain data tersebut diatas, tidak mengalami perubahan
		</font>
		<p>
		<font style="font-size: 12;">
			PT. (PERSERO) SUCOFINDO
		</font>
		</p>
		<br>
		<br
		<p>
		<font style="font-size: 12;">
			<u>S U R O T O</u><br>
		<font style="font-size: 11;">
			NPP : 90.67.02675
		</font>
		</font>
		</p>	
	</p>


</body>
</html>
';

$dompdf = new dompdf();

//$html = file_get_contents("cetak.php");

$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Data_'.$nama.'pdf', array("Attachment"=>0)); //untuk pemberian nama
?>