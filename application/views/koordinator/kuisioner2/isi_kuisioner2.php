<?php
foreach ($data_perusahaan->result() as $key):
  $id_perusahaan = $key->id_perusahaan;
  $nama_perusahaan = $key->nama_perusahaan;
endforeach;
?>


  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Kuisioner</a>
        </li>
        <li class="breadcrumb-item active">Halaman Kuisioner Pemonitoring Perusahaan</li>
      </ol>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Kuisioner Pemonitoring Perusahaan
        </div>
        <div class="card-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/Kuisioner2/insert_isi_kuisioner">

              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="tgl_dibuat">Pemonitoring</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="nip_nik" name="nip_nik" class="form-control" required>
                        <option style="text-align: center;">---Pilih Pemonitoring---</option>
                        <?php 
                          $data_monev = $this->db->query("SELECT * FROM tb_pegawai WHERE EXISTS(SELECT tb_monev.nip_nik FROM tb_monev WHERE tb_monev.nip_nik=tb_pegawai.nip_nik)");
                          foreach ($data_monev->result() as $key): ?>
                          <option value="<?php echo $key->nip_nik;?>"><?php echo $key->nama_pegawai;?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="tgl_dibuat">Perusahaan</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" hidden="" name="id_perusahaan" value="<?php echo $id_perusahaan; ?>">
                      <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo $nama_perusahaan; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>

              <ol style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" >
              <?php foreach ($data_soal_kuesioner->result() as $key): ?>
              
              <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-control-label">
                  <label for="tgl_dibuat"><?php echo '<li align="justify">'.$key->soal_kuisioner.'</li>'; ?></label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" hidden="hidden" name="id_data_kuisioner[]" value="<?php echo $key->id_data_kuisioner; ?>">
                      <textarea class="form-control" required="" name="jawaban[]" style="height: 150px;"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              
              <?php endforeach;?>
              </ol>

              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="tgl_dibuat">Foto2</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="file" id="foto" class="form-control" name="foto[]" multiple="" accept=".png,.jpg">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <div class="form-line" align="center">
                      <button class="btn btn-primary" type="submit">SIMPAN</button>
                      <button class="btn btn-warning" type="reset">BATAL</button>
                      <button class="btn btn-danger" onclick="goBack()">TUTUP</button>
                    </div>
                  </div>
                </div>
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

   

