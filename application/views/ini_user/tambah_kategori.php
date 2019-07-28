<div class="layout-content">
        <div class="layout-content-body">
          <div class="row gutter-xs">
            <div class="col-xs-6">
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
                    <form data-toggle="validator" action="<?php echo site_url('users/kategori/add_kategori')?>" method="POST">
                        <div class="form-group label-floating">
                          <label class="control-label">Name Kategori</label>
                          <input class="form-control" type="text" name="nama_kategori" placeholder="Masukan Nama Kategori" required>
                        </div>
                        <div class="form-group label-floating">
                            <button type="submit" class="btn btn-primary btn-block" name="Simpan">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>