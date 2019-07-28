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
                <a class="btn btn-info" href="<?php echo base_url('users/berita/tambah_berita')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Berita</th>
                        <th>Tanggal Berita</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_berita as $data_berita) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $data_berita->nama_berita;?></td>
                        <td><?php echo tgl_indo($data_berita->tanggal_berita)?></td>
                        <td>
                        <a class="btn btn-warning" href="<?php echo base_url('users/berita/edit_berita/'.$data_berita->id_berita)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
                        <a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_berita->id_berita?>" role="button">
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
      <?php foreach ($t_berita as $data_berita) { ?>
      <!--Start Modals-->
      <div id="Hapus<?= $data_berita->id_berita?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-warning">Anda Yakin Menghapus<h4>
              <h4>Berita : <?= $data_berita->nama_berita;?><h4>
            </div>
            <form action="<?= site_url('users/berita/hapus_berita')?>" method="POST">
            <input type="hidden" name="id_berita" value="<?= $data_berita->id_berita?>">    
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