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
                  <strong><?= $form_nama;?></strong>
                </div>
                <div class="card-body">
                <a class="btn btn-info" href="<?= base_url('users/file/tambah_file')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px;">No</th>
                        <th>Nama Berkas</th>
                        <th>Tanggal Berkas</th>
                        <th>Status</th>
                        <th style="width:100px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $i = 1;
                      foreach ($t_file as $data_file) {
                    ?>
                      <tr>
                        <td><?= $i++;?></td>
                        <td><?= $data_file->nama_file;?></td>
                        <td><?= tgl_indo($data_file->tanggal_file)?></td>
                        <td>
                        <?php
                        if($data_file->status_file == 'Tampil'){
                          $warna = 'label-outline-success';
                        }else{
                          $warna = 'label-outline-danger';
                        }
                        ?>
                        <span class="label <?= $warna?>"><?= $data_file->status_file; ?></span></td>
                        <td>
                        <a class="btn btn-info"  data-toggle="modal" data-target="#Status<?= $data_file->id_file?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Ubah Status</a>
                        <a class="btn btn-warning" href="<?= base_url('users/file/edit_file/'.$data_file->id_file)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Ubah</a>
                        <a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_file->id_file?>" role="button">
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
      <?php foreach ($t_file as $data_file) { ?>
      <!--Start Modals-->
      <div id="Hapus<?= $data_file->id_file?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-warning">Anda Yakin Menghapus<h4>
              <h4>File : <?= $data_file->nama_file;?><h4>
            </div>
            <form action="<?= site_url('users/file/hapus_file')?>" method="POST">
            <input type="hidden" name="id_file" value="<?= $data_file->id_file?>">
            <input type="hidden" name="file_lama" value="<?= $data_file->data_file?>">      
            <div class="modal-footer">
              <button class="btn btn-warning" type="submit">Lanjut</button>
              <button class="btn btn-default" data-dismiss="modal" type="button">Batal</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--End Modals-->
      <!--Start Modals-->
      <div id="Status<?= $data_file->id_file?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Konfirmasi Ubah Status</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-info">Anda Yakin Merubah<h4>
              <h5>Status File:
              <?php 
                if($data_file->status_file == 'Tampil'){
                  $status = 'Tidak Tampil';
                }else{
                  $status = 'Tampil';
                }
                echo '<b style="color:green">'.$data_file->status_file.'</b> Menjadi <b style="color:green">'.$status.'</b>';
              ?> 
              <h5>
            </div>
            <form action="<?= site_url('users/file/update_status')?>" method="POST">
            <input type="hidden" name="id_file" value="<?= $data_file->id_file?>">
            <input type="hidden" name="status_file" value="<?= $status?>">      
            <div class="modal-footer">
              <button class="btn btn-info" type="submit">Lanjut</button>
              <button class="btn btn-default" data-dismiss="modal" type="button">Batal</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--End Modals-->
      <?php }?>