  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Perusahaan</a>
        </li>
        <li class="breadcrumb-item active">Halaman Perusahaan</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Perusahaan
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama Perusahaan</th>
                  <th>Alamat</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama Perusahaan</th>
                  <th>Alamat</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_perusahaan->result() as $key): ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $key->nim ?></td>
                  <td><?php echo $key->nama_perusahaan_sementara ?></td>
                  <td><?php echo $key->alamat_perusahaan_sementara ?></td>
                  <td><?php echo $key->id_status_pkl ?></td>
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
                        <option value="mahasiswa">Perusahaan</option>
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

