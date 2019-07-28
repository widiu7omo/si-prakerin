<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SIMPRAKERIN</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo base_url()?>assets/logo.ico">
</head>

<style>
    body { 
      
      background:url(/assets/bg2.jpg);
      background-size:cover;
      background-position:center;
      background-attachment: fixed;
      background-repeat:no-repeat;
    }
</style>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <marquee behavior="alternate" onMouseOver="this.stop()" onMouseOut="this.start()">Silahkan Login</marquee>
      </div>
      <?php echo $this->session->flashdata('message');?>
      <div class="card-body">
        <form method="post" action="<?php echo base_url()?>monev/login/proses_login">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="" type="text" name="username" placeholder="Masukan Username" required="">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="" type="password" name="password" placeholder="Masukan Password" required="Password Harus Diisi">
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-power-off"></i> Login</button>
            <button class="btn btn-danger btn-block" type="reset"><i class="fa fa-refresh"></i> Batal</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
