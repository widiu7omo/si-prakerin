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
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/monitoring/update">
              <div class="modal-body">
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="id_jenis_kuisioner">Kode kuesioner</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="id_jenis_kuisioner" name="id_jenis_kuisioner" class="form-control" value="IDK" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="url_kuisioner">URL Google Form</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="url_kuisioner" name="url_kuisioner" class="form-control" required="" autocomplete="off" autofocus="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-line">
                      <a class="btn btn-light btn-block" href="<?php echo site_url()?>koordinator/dosen/form_google" target="_blank"><i class="fa fa-google"> Buat Form</i></a>
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

