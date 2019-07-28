<?php foreach($edit_data->result() as $data) :

    $no_surat = $data->no_surat;

    $date2  = date_create($data->tgl_berangkat);
    $tgl_berangkat = date_format($date2,"m/d/Y");

    $date  = date_create($data->tgl_pulang);
    $tgl_pulang  = date_format($date,"m/d/Y");

    $status = $data->status;

    $id_ttd_pimpinan = $data->id_ttd_pimpinan;

endforeach; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Monitoring</a>
        </li>
        <li class="breadcrumb-item active">Ubah Data Monitoring</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Monitoring
        </div>
        <div class="card-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/monitoring/update" onSubmit="return validasi2()">
              <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="no_surat">No. Surat</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="no_surat" name="no_surat" class="form-control" value="<?php echo $no_surat?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="username">Pemonev</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="nip_nik" name="nip_nik[]" class="form-control selectpicker" multiple data-live-search="true" data-live-search-placeholder="Cari Pegawai">
                        <?php foreach ($data_pemonev->result() as $key): ?>
                          <option <?php  
                          $sql = $this->db->query("SELECT nip_nik FROM tb_monev WHERE no_surat='$no_surat'");
                          foreach ($sql->result() as $data):
                          $nip_nik = $data->nip_nik;
                          if( $nip_nik == $key->nip_nik){echo "selected"; } endforeach; ?> value="<?php echo $key->nip_nik?>"><?php echo $key->nama_pegawai?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">Perusahaan</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7" id="formku">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="id_perusahaan" name="id_perusahaan[]" class="form-control selectpicker" multiple data-live-search="true" data-live-search-placeholder="Cari Perusahaan">

                        <?php foreach ($data_perusahaan_pkl->result() as $key): ?>
                          <option <?php 
                          $sql = $this->db->query("SELECT id_perusahaan FROM tb_monev WHERE no_surat='$no_surat'");
                          foreach ($sql->result() as $data):
                          $id_perusahaan = $data->id_perusahaan;
                          if( $id_perusahaan == $key->id_perusahaan ){echo "selected"; } endforeach; ?> value="<?php echo $key->id_perusahaan?>"><?php echo $key->nama_perusahaan?></option>
                        <?php endforeach;?>

                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal Berangkat</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="datepicker2" name="tgl_berangkat" class="form-control" required="" autocomplete="off" value="<?php echo $tgl_berangkat?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Tanggal Pulang</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="datepicker3" name="tgl_pulang" class="form-control" required="" autocomplete="off" value="<?php echo $tgl_pulang?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">Perusahaan</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7" id="formku">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="status" name="status" class="form-control selectpicker" required="">
                        <option>---Pilih Status---</option>
                        <option <?php if( $status == 'Proses' ){echo "selected"; } ?> value="Proses">Proses</option>
                        <option <?php if( $status == 'Selesai' ){echo "selected"; } ?> value="Selesai">Selesai</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">TTD Pimpinan</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="id_ttd_pimpinan" name="id_ttd_pimpinan" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Cari TTD Pimpinan" required>
                        <option>---Pilih TTD Pimpinan---</option>
                        <?php foreach ($data_ttd_pimpinan->result() as $key): ?>
                          <option <?php if( $id_ttd_pimpinan == $key->id_ttd_pimpinan){echo "selected"; } ?> value="<?php echo $key->id_ttd_pimpinan?>"><?php echo $key->nama_ttd_pimpinan?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-primary" type="submit">UBAH</button>
            <button class="btn btn-warning" type="reset">BATAL</button>
            <button class="btn btn-danger" type="reset" data-dismiss="modal">TUTUP</button>
          </div>
          </form>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

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

   

