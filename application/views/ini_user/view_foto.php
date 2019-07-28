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
                <a class="btn btn-info" href="<?php echo base_url('users/foto/tambah_foto')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px;">No</th>
                        <th>Nama foto</th>
                        <th>Deskripsi Foto</th>
                        <th>Foto</th>
                        <th>Tanggal foto</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_foto as $data_foto) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $data_foto->nama_foto;?></td>
                        <td><?php echo $data_foto->deskripsi_foto;?></td>
                        <td><a href="<?= base_url('file_upload/file_si/').$data_foto->data_foto;?>">
                          <img height="40" src="<?= base_url('file_upload/file_si/').$data_foto->data_foto;?>">
                        </a></td>
                        <td><?php echo tgl_indo($data_foto->tanggal_foto)?></td>
                        <td>
                          <a class="btn btn-warning" href="<?php echo base_url('users/foto/edit_foto/'.$data_foto->id_foto)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
                          <a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_foto->id_foto?>" role="button">
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
      <?php foreach ($t_foto as $data_foto) {?>
      <!--Start Modals-->
      <div id="Hapus<?= $data_foto->id_foto?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-warning">Anda Yakin Menghapus<h4>
              <h4>Foto : <?= $data_foto->nama_foto;?><h4>
            </div>
            <form action="<?= site_url('users/foto/hapus_foto')?>" method="POST">
            <input type="hidden" name="id_foto" value="<?= $data_foto->id_foto?>">
            <input type="hidden" name="file_lama" value="<?= $data_foto->data_foto?>">      
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