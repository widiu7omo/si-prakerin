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
                    <form data-toggle="validator" action="<?php echo site_url('users/kuesioner/add_kuesioner')?>" method="POST">
                        <div class="form-group label-floating">
                          <label class="control-label">Keriteria Ulasan</label>
                          <input class="form-control" type="text" name="soal_kuesioner" placeholder="Masukan Soal Kuesioner" required>
                        </div>
                        <div class="form-group label-floating">
                            <button type="submit" class="btn btn-primary btn-block" name="PSimpan">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>