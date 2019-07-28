<!DOCTYPE html>
<html>
<head>
	<div style="text-decoration: underline; font-weight: bold;font-size:20pt; margin-top: 5px;">PT.Geoinfo Teknologi</div>
	<style>
		
		@page {
			margin: 100px 25px;
		}

		main {
			font-size: 10pt;
		}

		table,th,td{
			border : 1px solid black;
		}

		header {
			position: fixed;
			top: -60px;
			left: 0px;
			right: 0px;
			height: 50px;
			/* border-color: red; */
			/* line-height: 35px; */
			text-align: right;
			font-size: 10pt;
			/** Extra personal styles **/
			/* background-color: #03a9f4; */


		}

		footer {
			position: fixed;
			bottom: -60px;
			left: 0px;
			right: 0px;
			height: 50px;
			text-align: right;
			font-size: 9pt;
		}

	</style>
</head>
<body>
	<?php if(! empty($notulen)){
		foreach ($notulen as $data) {
			$tempat = $data['tempat'];
			$tanggal = $data['tanggal'];
			$mulai_rapat = $data['mulai_rapat'];
			$selesai_rapat = $data['selesai_rapat'];
			$notulis = $data['nm'];
			$peserta_rapat = $data['peserta_rapat'];
			$cc = $data['cc'];

			
			
			
		}
	} ?>

	<main>
		<div style="margin-top: 20px;">
			<table style="border:1px solid black; width:80%;border-collapse: collapse;table-layout: fixed;">
				<tbody>
					<tr>
						<td style="width: 200px; font-weight: bold;" rowspan="5"><img scr="C:\xampp5.6\htdocs\Notulenrapat\tampilan\geo.png" width="120px"> GEOINFO TEKNOLGI</td>
						<td style="border:1px solid black; text-align: center; width: 550px; font-weight: bold;"colspan="3">NOTULEN RAPAT</td>
					</tr>
					<tr>
						
						<td style="font-weight: bold;">Tempat: </td>
						<td style="font-weight: bold;">Tanggal:</td>
						<td style="font-weight: bold;">Notulis:</td>
					</tr>
					<tr>
						
						<td><?php echo $tempat;?></td>
						<td><?php echo $tanggal;?></td>
						<td><?php echo $notulis;?></td>
					</tr>
					<tr>
						
						<td></td>
						<td>Pukul: </td>
						<td></td>
						
					</tr>
					<tr>
						<td></td>
						<td><?php echo $mulai_rapat;?>-<?php echo $selesai_rapat;?></td>
						<td></td>
					</tr>
					<tr>
						<td rowspan="1" colspan="2" style="font-weight: bold;">Peserta Rapat Yang Hadir :</td>
						<td colspan="2" style="font-weight: bold;"> CC : </td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $peserta_rapat;?></td>
						<td colspan="2">Menejemen <?php echo $cc;?></td>
						
					</tr>
				</tbody>
			</table>
		</div></br></br>

			<div style="text-decoration: underline; font-weight: bold;font-size:10pt; margin-top: 20px;">TABEL BAHASAN RAPAT</div>
			<div style="margin-top:5px;">
				<table style="border:1px solid black; width:80%;border-collapse: collapse;table-layout: fixed;">
					<thead>
						<tr>
							<th style="border:1px solid black;text-align: center;width: 20px;">No</th>
							<th style="border:1px solid black;text-align: center;width: 30px;">Bahasan Rapat</th>
							<th style="border:1px solid black;text-align: center;width: 200px;">Hasil Rapat</th>
							<th style="border:1px solid black;text-align: center;width: 30px;">Pelaksana</th>
						</tr>
					</thead>
					<tbody>
						
					<?php if(! empty($cetak)){
						$no=1;
					foreach ($cetak as $data) {
						echo'<tr>	 
								<td style="border:1px solid black;text-align: center;">'.$no++.'.</td>	
								<td style="border:1px solid black;padding-left: 5px;word-wrap: break-word;">'.$data['bahasan_rapat'].'</td>
								<td style="border:1px solid black;padding-left: 5px;word-wrap: break-all;">'.$data['hasil_rapat'].'</td>
								<td style="border:1px solid black;padding-left: 5px;word-wrap: break-word;">'.$data['pelaksana'].'</td>
							</tr>';
							}
						}
							 ?>
						</tbody>
					</table>
				</div>							
			</table>
			<div style="margin-top:40px;">
				</div>
				<div style="font-style:italic; text-align: center; width: 1300px">Terima kasih,</div>
				<div style="margin-top:10px;">
					<table style="border:none;">
						<tr>
							<td style="border:none; text-align: center; width: 1300px">Tertanda</td>
						</tr>
						<tr>
							<td style="padding-top:50px; border:none; text-align: center; width: 1300px">
							Nama Lengkap</td>
						</tr>
				</div>
		</div>
	</main>
</body>
</html>