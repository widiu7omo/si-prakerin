<div class="layout-content">
        <div class="layout-content-body">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                  </div>
                  <h5><strong><?php echo $form_nama;?></strong></h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                    <form data-toggle="validator" action="<?php echo base_url('users/perusahaan/add_perusahaan')?>" method="POST">
                      <div class="form-group label-floating">
                        <label class="control-label">Name Perusahaan</label>
                        <input class="form-control" type="text" name="nama_perusahaan" placeholder="Masukan Nama Perusahaan" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Longitude</label>
                        <input class="form-control" type="text" name="lng" placeholder="114.33433" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Latitude</label>
                        <input class="form-control" type="text" name="lat" placeholder="-5.33433" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">No Telepon</label>
                        <input class="form-control" type="text" name="no_telepon" placeholder="Masukan Nomor Teleon">
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Alamat Perusahaan</label>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Masukan Alamat"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>