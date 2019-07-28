  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Monitoring</a>
        </li>
        <li class="breadcrumb-item active">Halaman Monitoring</li>
      </ol>

      <div class="row">
        <div class="col-xl-2 col-sm-6 mb-3">
          <a data-toggle="modal" data-target="#Modaltambahdata">
            <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Data</button>
          </a>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3">
          <a data-toggle="modal" data-target="#Modalcetak"><button class="btn btn-primary btn-block"><i class="fa fa-print"></i> Cetak Word</button></a>
        </div>
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Monitoring
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example" width="100%" cellspacing="0">
              <thead style="vertical-align: middle; text-align: center;">
                <tr>
                  <th width="5px">No</th>
                  <th>No. Surat</th>
                  <th>Pemonitoring</th>
                  <th>Perusahaan</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                  <th>TTD Pimpinan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>No. Surat</th>
                  <th>Pemonitoring</th>
                  <th>Perusahaan</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                  <th>TTD Pimpinan</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_monev->result() as $key): 
                $id_perusahaan = $key->id_perusahaan;
                ?>
                <tr>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $no ?></td>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $key->no_surat ?></td>
                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" type="disk">
                    <?php
                    $query = $this->db->query("SELECT tb_monev.nip_nik, tb_pegawai.nama_pegawai FROM tb_monev LEFT JOIN tb_pegawai ON tb_monev.nip_nik = tb_pegawai.nip_nik WHERE tb_monev.no_surat = '$key->no_surat'");
                    foreach ($query->result() as $data):
                    if ($data->nip_nik != NULL) {
                      echo '<li>'.$data->nama_pegawai.'</li>';
                    }
                    endforeach; 
                    ?>
                  </ul>
                  </td>
                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" type="disk">
                    <?php
                    $query = $this->db->query("SELECT tb_perusahaan.nama_perusahaan FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.no_surat = '$key->no_surat'");
                    foreach ($query->result() as $data):
                    if ($data->nama_perusahaan != NULL) {
                      echo '<li>'.$data->nama_perusahaan.'</li>';
                    }
                    endforeach; 
                    ?>
                  </ul>
                  </td>
                  <td style="vertical-align: middle; text-align: center;">
                    <?php 
                      $date1  = date_create($key->tgl_berangkat);
                      $tgl_berangkat = date_format($date1,"d-m-Y");
                      echo $tgl_berangkat;
                    ?>
                  </td>
                  <td style="vertical-align: middle; text-align: center;">
                    <?php 
                      $date1  = date_create($key->tgl_pulang);
                      $tgl_pulang = date_format($date1,"d-m-Y");
                      echo $tgl_pulang; 
                    ?>  
                  </td>
                    <?php
                    $status = $key->status;
                    if ($status == 'Proses') {
                      echo '<td style="vertical-align: middle; text-align: center;" width="10px" class="bg-info"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Proses Monitoring">Proses</font></td>';
                    }elseif ($status == 'Selesai') {
                      echo '<td style="vertical-align: middle; text-align: center;" class="bg-success"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Selesai Monitoring">Selesai</font></td>';
                    }
                    ?>
                  <td style="vertical-align: middle; text-align: center;">
                    <?php echo $key->nama_ttd_pimpinan; ?>
                  </td>
                  <td style="vertical-align: middle; text-align: center;">
                    <!-- Tombol Print -->
                    <a href="<?php echo base_url()?>koordinator/Cetak_monitoring/cetak_perdata?no_surat=<?php echo $key->no_surat ?>" class="modal-with-form">
                      <button class="btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Cetak Data <?php echo $key->no_surat ?>"><i class="fa fa-print"></i></button>
                    </a>
                    <!-- Tombol Edit -->
                    <a href="<?php echo base_url()?>koordinator/Monitoring/edit?no_surat=<?php echo $key->no_surat ?>" class="modal-with-form">
                      <button class="btn-sm btn-warning btn-block" data-toggle="tooltip" data-placement="bottom" title="Edit Data <?php echo $key->no_surat ?>"><i class="fa fa-edit"></i></button>
                    </a>
                    <!-- Tombol Delete -->
                    <a href="<?php echo base_url()?>koordinator/Monitoring/delete?no_surat=<?php echo $key->no_surat ?>&id_perusahaan=<?php echo $key->id_perusahaan ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $key->no_surat ?> ?')">
                      <button class="btn-sm btn-danger btn-block" data-toggle="tooltip" data-placement="bottom" title="Hapus Data <?php echo $key->no_surat ?>"><i class="fa fa-trash-o"></i></button>
                    </a>
                  </td>
                </tr>
                <?php $no++; endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Modal Tambah Data-->
    <div class="modal fade" id="Modaltambahdata" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Modaltambahdata" align="text-center">MASUKAN DATA JADWAL MONITORING</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/Monitoring/insert2" onsubmit="return validasi2()">
          <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="no_surat">No. Surat</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="no_surat" name="no_surat" class="form-control" value="<?php echo $no_surat;?>/PL40/KP/<?php echo date('Y');?>" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="username">Pemonitoring</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="nip_nik" name="nip_nik[]" class="form-control selectpicker" multiple data-live-search="true" data-live-search-placeholder="Cari Pegawai" required>
                        <?php foreach ($data_pemonev->result() as $key): ?>
                          <option value="<?php echo $key->nip_nik?>"><?php echo $key->nama_pegawai?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">Perusahaan</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7" id="formku">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="id_perusahaan" name="id_perusahaan[]" class="form-control selectpicker" multiple data-live-search="true" data-live-search-placeholder="Cari Perusahaan" required>
                        <?php foreach ($data_mahasiswa->result() as $key): ?>
                          <option value="<?php echo $key->id_perusahaan?>"><?php echo $key->nama_perusahaan?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal Berangkat</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="datepicker2" name="tgl_berangkat" class="form-control" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal Pulang</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="datepicker3" name="tgl_pulang" class="form-control" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">TTD Pimpinan</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="id_ttd_pimpinan" name="id_ttd_pimpinan" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Cari TTD Pimpinan" required>
                        <option>---Pilih TTD Pimpinan---</option>
                        <?php foreach ($data_ttd_pimpinan->result() as $key): ?>
                          <option value="<?php echo $key->id_ttd_pimpinan?>"><?php echo $key->nama_ttd_pimpinan?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-primary" type="submit">SIMPAN</button>
            <button class="btn btn-warning" type="reset">BATAL</button>
            <button class="btn btn-danger" type="reset" data-dismiss="modal">TUTUP</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Data-->
    <div class="modal fade" id="Modalcetak" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Modalcetak" align="text-center">CETAK SURAT TUGAS</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/cetak_monitoring/cetak_semua_data" onSubmit="return validasi()">
          <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="tanggal_dari" name="tanggal_dari" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Tanggal" required>
                        <option style="text-align: center;">---Pilih Tanggal Dari---</option>
                        <?php foreach ($data_monev->result() as $key): ?>
                          <option value="<?php echo $key->tgl_berangkat?>"><?php echo $key->tgl_berangkat?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="tanggal_sampai" name="tanggal_sampai" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Tanggal" required>
                        <option style="text-align: center;">---Pilih Tanggal Sampai---</option>
                        <?php foreach ($data_monev->result() as $key): ?>
                          <option value="<?php echo $key->tgl_berangkat?>"><?php echo $key->tgl_berangkat?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-primary" type="submit">CETAK</button>
            <button class="btn btn-warning" type="reset">BATAL</button>
            <button class="btn btn-danger" type="reset" data-dismiss="modal">TUTUP</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<script type="text/javascript">
  function validasi() {
    var get_tgl_1 = document.getElementById("datepicker4").value;
    var get_tgl_2 = document.getElementById("datepicker5").value;
    if ( Date.parse(get_tgl_1) <  Date.parse(get_tgl_2)) {
      return true;
    }else{
      alert('Tanggal Pulang Tidak Boleh Sebelum Tanggal '+get_tgl_1+'!');
      return false;
    }
  }
</script>

<script type="text/javascript">
  function validasi2() {
    var get_tgl_1 = document.getElementById("datepicker2").value;
    var get_tgl_2 = document.getElementById("datepicker3").value;
    if ( Date.parse(get_tgl_1) <  Date.parse(get_tgl_2)) {
      return true;
    }else{
      alert('Tanggal Pulang Tidak Boleh Sebelum Tanggal '+get_tgl_1+'!');
      return false;
    }
  }
</script>