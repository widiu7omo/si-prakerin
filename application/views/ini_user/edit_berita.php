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
                    <form data-toggle="validator" action="<?= site_url('users/berita/update_berita')?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_berita" value="<?= $t_berita[0]->id_berita?>">
                        <div class="form-group label-floating">
                          <label class="control-label">Gambar Berita</label>
                          <input class="form-control" type="text" name="file_lama" value="<?= $t_berita[0]->gambar_berita?>" readonly>
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Update Gambar Berita</label>
                          <input class="form-control" type="file" name="file">
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Name Berita</label>
                          <input class="form-control" type="text" name="nama_berita" value="<?= $t_berita[0]->nama_berita?>" required>  
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Konten</label>
                          <textarea class="ckeditor" name="konten_berita" id="ckeditor" required><?= $t_berita[0]->konten_berita?></textarea>
                        </div>
                        <div class="label-floating">
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