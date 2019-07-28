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
                  <strong><?php echo $form_nama;?></strong>
                </div>
                <div class="card-body">
                <a class="btn btn-info" href="<?php echo base_url('users/slideshows/tambah_slideshows')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px;">No</th>
                        <th>Foto Slideshows</th>
                        <th>Tanggal Foto</th>
                        <th style="width:250px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_slideshows as $data_slideshows) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><a href="<?= base_url('file_upload/file_si/').$data_slideshows->data_foto;?>">
                          <img height="40" src="<?= base_url('file_upload/file_si/').$data_slideshows->data_foto;?>">
                        </a></td>
                        <td><?php echo tgl_indo($data_slideshows->tanggal_foto)?></td>
                        <td>
                          <a class="btn btn-warning" href="<?php echo base_url('users/slideshows/edit_slideshows/'.$data_slideshows->id_foto)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
                          <a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_slideshows->id_foto?>" role="button">
                            <span class="icon icon-trash-o"></span> Hapus</a>
                        </td>
                      </tr>
                    <?php
                    }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php foreach ($t_slideshows as $data_slideshows) {?>
      <!--Start Modals-->
      <div id="Hapus<?= $data_slideshows->id_foto?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-warning">Anda Yakin Menghapus<h4>
              <h4>Foto<h4>
              <img height="100" src="<?= base_url('file_upload/file_si/').$data_slideshows->data_foto;?>">
            </div>
            <form action="<?= site_url('users/slideshows/hapus_slideshows')?>" method="POST">
            <input type="hidden" name="id_foto" value="<?= $data_slideshows->id_foto?>">
            <input type="hidden" name="file" value="<?= $data_slideshows->data_foto?>">      
            <div class="modal-footer">
              <button class="btn btn-warning" type="submit">Lanjut</button>
              <button class="btn btn-default" data-dismiss="modal" type="button">Batal</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--End Modals-->
      <?php }?>