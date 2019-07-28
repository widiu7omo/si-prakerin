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
                    <form data-toggle="validator" action="<?php echo site_url('users/file/update_file')?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_file" value="<?php echo $t_file[0]->id_file?>">
                        <div class="form-group label-floating">
                          <label class="control-label">Name Berkas</label>
                          <input class="form-control" type="text" name="nama_file" value="<?php echo $t_file[0]->nama_file?>" required>  
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Berkas</label>
                          <input class="form-control" type="text" name="file_lama" value="<?php echo $t_file[0]->data_file?>" readonly>
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Ubah Berkas</label>
                          <input class="form-control" type="file" name="file">
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