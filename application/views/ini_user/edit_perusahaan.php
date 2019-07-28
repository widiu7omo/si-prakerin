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
                  <h5><strong><?= $form_nama;?></strong></h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                    <form data-toggle="validator" action="<?= site_url('users/perusahaan/update_perusahaan')?>" method="POST">
                      <input type="hidden" name="not_id" value="<?= $t_perusahaan[0]->nama_perusahaan?>">
                      <div class="form-group label-floating">
                        <label class="control-label">Name Perusahaan</label>
                        <input class="form-control" type="text" name="nama_perusahaan" value="<?= $t_perusahaan[0]->nama_perusahaan?>" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Longitude</label>
                        <input class="form-control" type="text" name="lng_perusahaan" value="<?= $t_perusahaan[0]->long_perusahaan?>" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Latitude</label>
                        <input class="form-control" type="text" name="lat_perusahaan" value="<?= $t_perusahaan[0]->long_perusahaan?>" required>
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">No Telepon</label>
                        <input class="form-control" type="text" name="telepon_perusahaan" value="<?= $t_perusahaan[0]->telepon_perusahaan?>" placeholder="Masukan Nomor Teleon">
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Alamat Perusahaan</label>
                        <textarea class="form-control" rows="3" name="alamat_perusahaan" placeholder="Masukan Alamat"><?= $t_perusahaan[0]->alamat_perusahaan?></textarea>
                      </div>
                        <div class="form-group label-floating">
                            <button type="submit" class="btn btn-primary btn-block" name="PUpdate">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>