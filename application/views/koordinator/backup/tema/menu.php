<body class="fixed-nav sticky-footer bg-dark" id="atas">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo site_url()?>koordinator/koordinator">SIMPRAKERIN</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <!-- Menu -->
        <li class="nav-item <?php if($this->session->userdata('menu') == 'koordinator'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Beranda">
          <a class="nav-link" href="<?php echo site_url()?>koordinator/koordinator">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Beranda</span>
          </a>
        </li>

        <li class="nav-item <?php if($this->session->userdata('menu') == 'mahasiswa'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Data Mahasiswa">
          <a class="nav-link" href="<?php echo site_url()?>koordinator/mahasiswa">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Mahasiswa PKL</span>
          </a>
        </li>

        <li class="nav-item <?php if($this->session->userdata('menu') == 'monitoring'){echo "active"; }?>" data-toggle="tooltip" data-placement="right" title="Kelola Data Monitoring">
          <a class="nav-link" href="<?php echo site_url()?>koordinator/monitoring">
            <i class="fa fa-fw fa-clipboard"></i>
            <span class="nav-link-text">Monitoring</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Kelola Data Kuesioner">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#kuisioner" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Kuisioner</span>
          </a>

          <ul class="sidenav-second-level collapse" id="kuisioner">
            <li class="<?php if($this->session->userdata('menu') == 'kuisioner2'){echo "active"; }?>">
              <a href="<?php echo site_url()?>koordinator/kuisioner2">Data Jawaban Kuisioner</a>
            </li>
            <li class="<?php if($this->session->userdata('menu') == 'kuisioner'){echo "active"; }?>">
              <a href="<?php echo site_url()?>koordinator/kuisioner">Data Soal Kuisioner</a>
            </li>
          </ul>
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