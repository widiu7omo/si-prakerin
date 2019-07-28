<body class="fixed-nav sticky-footer bg-dark" id="atas">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo site_url()?>pemonev/pemonev">SIMONEP</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <!-- Menu -->
        <li class="nav-item <?php if($this->session->userdata('menu') == 'beranda'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Beranda">
          <a class="nav-link" href="<?php echo site_url()?>pemonev/pemonev">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Beranda</span>
          </a>
        </li>

        <li class="nav-item <?php if($this->session->userdata('menu') == 'monitoring'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Kelola Data Monitoring">
          <a class="nav-link" href="<?php echo site_url()?>pemonev/monitoring">
            <i class="fa fa-fw fa-clipboard"></i>
            <span class="nav-link-text">Monitoring</span>
          </a>
        </li>

        <li class="nav-item <?php if($this->session->userdata('menu') == 'kuisioner'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Kelola Data Kuisioner">
          <a class="nav-link" href="<?php echo site_url()?>pemonev/kuisioner">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Kuisioner</span>
          </a>
        </li>
        <!-- Batas Menu -->
      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link">
            <i class="fa fa-fw fa-user" data-toggle="tooltip" data-placement="left" title="Profile">
            </i> <?php echo $this->session->userdata('nama_pegawai');?>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link">
            <i class="fa fa-fw fa-calendar" data-toggle="tooltip" data-placement="left" title="Tanggal">
            </i> <?php echo date("d-m-Y");?>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#ModalLogout">
            <i class="fa fa-fw fa-power-off" data-toggle="tooltip" data-placement="right" title="Logout"></i>
            Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>