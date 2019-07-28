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
                <form data-toggle="md-validator" action="<?php echo base_url('users/halaman/add_halaman')?>" method="POST">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                          <label class="control-label">Name Halaman</label>
                          <input class="form-control" type="text" name="nama_halaman" required>  
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Kategori</label>
                          <select id="form-control" class="form-control" name="id_kategori" required>
                          <?php
                            foreach ($t_kategori as $data_kategori) {
                              echo '<option value="'.$data_kategori->id_kategori.'">'.$data_kategori->nama_kategori.'</option>';
                          }?>
                          </select>
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Konten</label>
                          <textarea class="ckeditor" name="konten_halaman" id="ckeditor" required></textarea>
                        </div>
                        <div class="form-group label-floating">
                            <button type="submit" class="btn btn-primary btn-block" name="Simpan">Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>