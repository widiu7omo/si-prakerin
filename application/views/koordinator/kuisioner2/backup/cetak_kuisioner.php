<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	@page {
		margin: 0cm 0cm;
	}
	body {
		margin-top: 3cm;
		margin-left: 3cm;
		margin-right: 3cm;
		margin-bottom: 3cm;
		line-height: 1.5;
		text-align: justify;
		line
	}
	ol, li, br {
		line-height: 1.5;
	}
	table, th, td {
	  border: 0.5px solid black;
	  border-collapse: collapse;
	  padding-left: 1px;
	  padding-bottom: 1px;
	  padding-top: 1px;
	  padding-right: 1px;
	  line-height: 1.5;
	}
	fieldset {
	  border: 0.5px solid black;
	  border-collapse: collapse;
	  padding-bottom: 1px;
	  padding-top: 1px;
	  line-height: 1.5;
	}
	</style>
</head>
<body>
			  <label>Pemonitoring</label><br>
              <label>Perusahaan</label>

              <ol style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" >
              <?php foreach ($cetak_kuisioner->result() as $key): ?>
              <li>
              	<label><?php echo $key->soal_kuisioner; ?></label>
              	<fieldset cellspacing='2'>
              		<?php echo $key->jawaban; ?>
              	</fieldset>
              </li>
              <?php endforeach;?>
              </ol>
</body>
</html>