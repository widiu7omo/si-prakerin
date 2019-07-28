<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	foreach($data_cetak->result() as $data) :
	    $no_surat = $data->no_surat;
	    $date1 = date_create($data->tgl_berangkat);
        $tgl_berangkat = date_format($date1,"d-m-Y");
	endforeach; 

	header("Content-Type: application/vnd.msword"); 
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Surat Tugas Monitoring Perusahaan ".$tgl_berangkat.".doc");
?>

<head>
	<meta charset="utf-8">
	<title>Surat Tugas Monitoring Perusahaan</title>
</head>

<body>

<img src="<?php echo site_url()?>assets/kop_surat_tugas.png" style="width: 16.5cm; height: 3.2cm">

<div id="container">

<p style="text-align: center;">
	<span style="font-size: 12pt; font-family: 'times new roman', times;">SURAT TUGAS </span><br />
	<span style="font-size: 12pt; font-family: 'times new roman', times;">Nomor : <?php echo $no_surat ?></span>
</p>

<p style="text-align: justify;">
	<span style="font-size: 12pt; font-family: 'times new roman', times; line-height: 1.5;">
	Sehubungan dengan pelaksanaan Praktek Kerja Lapangan Mahasiswa Politeknik Negeri Tanah Laut semester ganjil Tahun Akademik 2018/2019, maka Direktur Politeknik Negeri Tanah Laut memberikan tugas kepada :
	</span>
</p>

<table style="width: 100%; border-collapse: collapse; border: none;" width="100%">
	<thead>
		<tr style="height: 30px;">
			<td style="width: 10%; border: 1pt solid black; padding: 0.75pt;" width="10%">
				<p style="text-align: center;">
					<strong>
						<span style="font-size: 12pt; font-family: 'times new roman', times;">No</span>
					</strong>
				</p>
			</td>
			<td style="width: 40%; border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 0.75pt;" width="40%">
				<p style="text-align: center;">
					<strong>
						<span style="font-size: 12pt; font-family: 'times new roman', times;">Nama</span>
					</strong>
				</p>
			</td>
			<td style="width: 25%; border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 0.75pt;" width="25%">
				<p style="text-align: center;">
					<strong>
						<span style="font-size: 12pt; font-family: 'times new roman', times;">Pangkat/Gol.</span>
					</strong>
				</p>
			</td>
			<td style="width: 25%; border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 0.75pt;" width="25%">
				<p style="text-align: center;">
					<strong>
						<span style="font-size: 12pt; font-family: 'times new roman', times;">Jabatan</span>
					</strong>
				</p>
			</td>
		</tr>
	</thead>
	<tbody>
<?php
	$query2 = $this->db->query("SELECT tb_pegawai.nama_pegawai, tb_pegawai.id_pangkat_golongan, tb_pegawai.nip FROM tb_pegawai LEFT JOIN tb_monev ON tb_monev.nip_nik = tb_pegawai.nip WHERE tb_monev.no_surat = '$no_surat'");
	$no2 = 1;
	foreach ($query2->result() as $data2): 
?>
		<tr style="height: 30px;">
			<td style="border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 0.75pt; height: 48px; text-align: center;">
				<p>
					<span style="font-size: 12pt; font-family: 'times new roman', times;line-height: 1.5;">
						<?php echo $no2++; ?>
					</span>
				</p>
			</td>
			<td style="border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; padding: 0.75pt; height: 48px;">
				<p>
					<span style="font-size: 12pt; font-family: 'times new roman', times; line-height: 1.5;">
						<?php echo $data2->nama_pegawai; ?>
						<br>
						<?php echo $data2->nip; ?>
					</span>
				</p>
			</td>
			<td style="border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; padding: 0.75pt; height: 48px;">
				<p>
					<span style="font-size: 12pt; font-family: 'times new roman', times; line-height: 1.5;">
						<?php echo $data2->id_pangkat_golongan; ?>
					</span>
				</p>
			</td>
			<td style="border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; padding: 0.75pt; height: 48px;">
				<p>
					<span style="font-size: 12pt; font-family: 'times new roman', times; line-height: 1.5;">
						<?php echo $data2->id_pangkat_golongan; ?>
					</span>
				</p>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
	<p style="text-align: justify; line-height: 1.5;">
		<span style="font-size: 12pt; font-family: 'times new roman', times; line-height: 1.5;">
			Untuk Monitoring Praktek Kerja Lapangan pada tanggal 14-05-2019 di :
			<ol>
				<?php
					$query = $this->db->query("SELECT tb_perusahaan.nama_perusahaan FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.no_surat = '$no_surat'");
					foreach ($query->result() as $data):
						echo '<li><span style="font-size: 12pt; font-family: "times new roman", times;">'.$data->nama_perusahaan.'</span></li>';
					endforeach; 
				?>
			</ol>
			Surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.
		</span>
	</p>

<table style="border-collapse: collapse; width: 100%; height: 132px;" border="0">
	<tbody>
		<tr style="height: 20px;">
		<td style="width: 70%; height: 20px;">&nbsp;</td>
			<td style="width: 30%; height: 20px;">
				<span style="font-size: 12pt; font-family: 'times new roman', times;">
					Tanah Laut, 13-May-2019
				</span>
			</td>
		</tr>
		<tr style="height: 18px;">
			<td style="width: 70%; height: 18px;">&nbsp;</td>
				<td style="width: 30%; height: 18px;">
					Direktur,
				</td>
			</tr>
		<tr style="height: 18px;">
		<td style="width: 70%; height: 18px;">&nbsp;</td>
		<td style="width: 30%; height: 18px;">&nbsp;</td>
		</tr>
		<tr style="height: 18px;">
		<td style="width: 70%; height: 18px;">&nbsp;</td>
		<td style="width: 30%; height: 18px;">&nbsp;</td>
		</tr>
		<tr style="height: 18px;">
		<td style="width: 70%; height: 18px;">&nbsp;</td>
		<td style="width: 30%; height: 18px;">&nbsp;</td>
		</tr>
		<tr style="height: 40px;">
		<td style="width: 70%; height: 40px;">&nbsp;</td>
			<td style="width: 30%; height: 40px;">
				<span style="font-size: 12pt; font-family: 'times new roman', times;text-decoration: underline;">
					Mufrida Zein
				</span>
				<br>
				<span style="font-size: 12pt; font-family: 'times new roman', times;">
					NIP 196806171997022004
				</span>
			</td>
		</tr>
	</tbody>
</table>
</div>

</body>
</html>