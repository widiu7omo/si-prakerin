<html
        xmlns:o='urn:schemas-microsoft-com:office:office'
        xmlns:w='urn:schemas-microsoft-com:office:word'
        xmlns='http://www.w3.org/TR/REC-html40'
>
<head>
    <meta charset="utf-8">
    <title>Surat Pengajuan Magang</title>
    <title>Generate a document Word</title>
    <!--[if gte mso 9]-->
    <xml>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>90</w:Zoom>
            <w:DoNotOptimizeForBrowser/>
        </w:WordDocument>
    </xml>
    <!-- [endif]-->
    <style type="text/css">

        @page {
            margin: 0;
        }

        body {
            font-family: "Bookman Old Style", serif;
            font-size: 12pt;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            margin: 0;
        }

        p#to {
            text-align: left;
            margin: 0;
        }

        @page Section1 {
            size: 21cm 29.7cm;
            margin: 1cm 2cm 2cm 2cm;
            mso-page-orientation: portrait;
            mso-footer: f1;
        }

        div.Section1 {
            page: Section1;
        }
    </style>
</head>
<body>
<div class="Section1">
    <img src="<?php echo base_url( 'aset/img/surat/header2.png' ) ?>" width="100%" height="100%">
    <hr style="color: #000; border: solid black 4px;height: 4px;">
    <table>
        <tr>
            <td><p style="text-align: left;">Nomor</p></td>
            <td>:</td>
            <td><p>B/<?php echo isset($urut)?$urut:0?><?php echo isset($nomor_surat)?$nomor_surat->suffix_no_surat:null ?><?php echo date( "Y" ); ?></p></td>
            <td><p style="text-align: right;"><?php echo date( 'd-M-Y' ) ?></p></td>
        </tr>
        <tr>
            <td>
                <p style="text-align: left;">Hal</p>
            </td>
            <td>:</td>
            <td colspan="2">Permohonan Praktek Kerja Lapangan (PKL)</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="4"><br><br><p id="to">Kepada Yth.</p></td>
        </tr>
        <tr>
            <td colspan="4"><p id="to">Pimpinan/ HRD <?php echo isset($permohonan)?$permohonan[0]->nama_perusahaan:null ?></p></td>
        </tr>
        <tr>
            <td colspan="4"><p id="to">Di- Tempat</p></td>
        </tr>
        <tr>
            <td colspan="4">
                <br>

                <p style="text-align: justify; font-size: 12pt;line-height: 150%;">Dalam rangka memenuhi persyaratan kurikulum
                    Program Studi <?php echo isset($permohonan)?$permohonan[0]->nama_program_studi:null ?> Politeknik Negeri Tanah Laut, kami
                    memohon
                    kepada Bapak/Ibu untuk dapat
                    memberikan kesempatan kepada mahasiswa kami sebagai berikut:</p>
            </td>
        </tr>
        <br>

    </table>
    <br>
    <table width="80%" align="center" style="border: 1px solid black; border-collapse: collapse;">
        <thead>
        <tr>
            <td width="5%" style="border: 1px solid black; text-align: center;">No</td>
            <td width="45%" style="border: 1px solid black; text-align: center;">Nama</td>
            <td width="25%" style="border: 1px solid black; text-align: center;">NIM</td>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $permohonan as $i => $perm ): ?>
            <tr>
                <td style="border: 1px solid black;"><p style="text-align: center;"><?php echo $i + 1 ?></p></td>
                <td style="border: 1px solid black;"><p style="text-align: left;">&nbsp;<?php echo $perm->nama_mahasiswa ?></p></td>
                <td style="border: 1px solid black;"><p style="text-align: center;"><?php echo $perm->nim ?></p></td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <p style="text-align: justify; font-size: 12pt; line-height: 150%;">
        Untuk melakukan Praktek Kerja Lapangan selama 4 (empat) bulan pada perusahaan yang Bapak/Ibu pimpin. Terhitung
        pada Tanggal 23 September 2019 s.d 23 januari 2020.
    </p>
    <p style="text-align: justify; font-size: 12pt;line-height: 150%;">Demikian permohonan ini disampaikan, atas perhatian dan perkenannya
        diucapkan terima kasih.</p>
    <br>
    <br>
    <div style="align-items:flex-end;">
        <table style="font-size: 12pt;" width="40%" align="right">
            <tbody>
            <tr>
                <td>
                    Direktur, <?php echo date( "d-M-Y" ); ?>
                </td>
            </tr>
            <tr>

                <td>
                    <br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin:0">Dr. Mufrida Zein, S.Ag., M.Pd</p>
                    <p style="margin:0">NIP 196806171997022004</p>
                    </br>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
header( "Content-Type: application/vnd.msword" );

$tanggal = date( 'd-M-Y' );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "content-disposition: attachment;filename=Surat Pengajuan Magang " . $tanggal . ".doc" )
?>