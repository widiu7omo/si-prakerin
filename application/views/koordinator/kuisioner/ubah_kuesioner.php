<?php foreach($edit_data->result() as $data) :
    $id_pengguna= $data->id_pengguna;
    $username = $data->username;
    $password = $data->password;
    $level = $data->level;

endforeach; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Monitoring</a>
        </li>
        <li class="breadcrumb-item active">Halaman Monitoring</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Monitoring
        </div>
        <div class="card-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/kuisioner/update_soal">
          <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="url_kuisioner">No Soal</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="id_soal_kuisioner" name="id_soal_kuisioner" class="form-control" required="" autocomplete="off" autofocus="">
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="tgl_dibuat">Soal Kuisioner</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <textarea type="text" class="form-control" required="" name="soal_kuisioner"></textarea>
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
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

