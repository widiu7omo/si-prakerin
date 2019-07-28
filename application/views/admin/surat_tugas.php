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
            <td colspan="4" style="text-align: center;"><br><br>SURAT TUGAS</td>
        </tr>
        <tr>
            <td><p style="text-align: center;">Nomor :&nbsp;&nbsp; kosong/PL40/PK.01.06/<?php echo date( "Y" ); ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <br>

                <p style="text-align: justify; font-size: 12pt;line-height: 150%;">Berdasarkan surat balasan diterimanya
                    dari perusahaan <?php echo $permohonan[0]->nama_perusahaan ?> dengan nomor xxx pada tanggal xxx,
                    maka Direktur Politeknik Negeri Tanah Laut
                    memberikan tugas kepada : </p>
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
            <td width="25%" style="border: 1px solid black; text-align: center;">Program Studi</td>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $permohonan as $i => $perm ): ?>
            <tr>
                <td style="border: 1px solid black;"><p style="text-align: center;"><?php echo $i + 1 ?></p></td>
                <td style="border: 1px solid black;">
                    <p style="text-align: center;"><?php echo $perm->nama_mahasiswa ?></p>
                    <p style="text-align: center;">NIM.&nbsp;<?php echo $perm->nim ?></p>
                </td>
                <td style="border: 1px solid black;"><p
                            style="text-align: center;"><?php echo $perm->nama_program_studi ?></p></td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <p style="text-align: justify; font-size: 12pt; line-height: 150%;">
        Untuk melaksanakan Praktek Kerja Lapangan (PKL) selama empat (4) bulan sejak tanggal 20 September 2018 sampai
        dengan 20 Januari 2019 di <?php echo isset( $permohonan[0] ) ? $permohonan[0]->nama_perusahaan : null ?>.
    </p>
    <p style="text-align: justify; font-size: 12pt;line-height: 150%;">Surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.</p>
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

$tanggal = date( 'd-m-Y' );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "content-disposition: attachment;filename=Surat Tugas  " . $tanggal . ".doc" )
?>