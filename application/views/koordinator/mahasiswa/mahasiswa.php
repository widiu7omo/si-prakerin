  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Mahasiswa PKL</a>
        </li>
        <li class="breadcrumb-item active">Halaman Mahasiswa PKL</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Mahasiswa PKL
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example" width="100%" cellspacing="0">
              <thead style="vertical-align: middle; text-align: center;">
                <tr>
                  <th width="50px">No</th>
                  <th>Nama / NIM</th>
                  <th>Jurusan</th>
                  <th>Perusahaan</th>
                  <th>Tahun Akademik</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama / NIM</th>
                  <th>Jurusan</th>
                  <th>Perusahaan</th>
                  <th>Tahun Akademik</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_mahasiswa->result() as $key): 
                $id_perusahaan = $key->id_perusahaan;
                ?>
                <tr>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $no ?></td>

                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;width: 300px;" type="disk">
                  <?php
                  $query = $this->db->query("SELECT  
                  tb_mahasiswa.nama_mahasiswa, tb_mahasiswa.nim
                  FROM `tb_mahasiswa` JOIN tb_mhs_pilih_perusahaan ON tb_mahasiswa.nim = tb_mhs_pilih_perusahaan.nim JOIN tb_perusahaan ON tb_mhs_pilih_perusahaan.id_perusahaan = tb_perusahaan.id_perusahaan JOIN tahun_akademik ON tb_mahasiswa.id_tahun_akademik = tahun_akademik.id_tahun_akademik JOIN tb_program_studi ON tb_mahasiswa.id_program_studi = tb_program_studi.id_program_studi WHERE tb_perusahaan.id_perusahaan = '$id_perusahaan' ORDER BY tb_mahasiswa.nim ASC");
                  foreach ($query->result() as $data):
                  echo '<li>'.$data->nama_mahasiswa.' / '.$data->nim.'</li>';
                  endforeach;
                  ?>
                  </ul>
                  </td>

                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" type="disk">
                  <?php
                  $query = $this->db->query("SELECT 
                  tb_program_studi.nama_program_studi  
                  FROM `tb_mahasiswa` JOIN tb_mhs_pilih_perusahaan ON tb_mahasiswa.nim = tb_mhs_pilih_perusahaan.nim JOIN tb_perusahaan ON tb_mhs_pilih_perusahaan.id_perusahaan = tb_perusahaan.id_perusahaan JOIN tahun_akademik ON tb_mahasiswa.id_tahun_akademik = tahun_akademik.id_tahun_akademik JOIN tb_program_studi ON tb_mahasiswa.id_program_studi = tb_program_studi.id_program_studi WHERE tb_perusahaan.id_perusahaan = '$id_perusahaan' ORDER BY tb_mahasiswa.nim ASC");
                  foreach ($query->result() as $data):
                  echo '<li>'.$data->nama_program_studi.'</li>';
                  endforeach;
                  ?>
                  </ul>
                  </td>
                  
                  <td style="vertical-align: middle; text-align: center;"><?php echo $key->nama_perusahaan ?></td>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $key->tahun_akademik ?></td>
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

    <div class="modal fade" id="Modaltambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Modaltambahdata" align="text-center">MASUKAN DATA JADWAL MONITORING</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/monitoring/insert">
          <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="kode_jadwal">Kode Jadwal</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="kode_jadwal" name="kode_pengguna" class="form-control" readonly="" value="<?php echo $kode_otomatis; ?>" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="username">Username</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="username" name="username" class="form-control" required="" autocomplete="off" autofocus="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="password">Password</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="password" name="password" class="form-control" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="level">Level</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <select id="level" name="level" class="form-control" required="">
                        <option value="koordinator">Koordinator</option>
                        <option value="dosen">Dosen</option>
                        <option value="mahasiswa">Mahasiswa</option>
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

