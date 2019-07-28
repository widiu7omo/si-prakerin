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
                <a class="btn btn-info" href="<?php echo base_url('users/kuesioner/tambah_kuesioner')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px;">No</th>
                        <th>Keriteria Ulasan</th>
                        <th>Jenis Kuesioner</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_kuesioner as $data_kuesioner) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $data_kuesioner->soal_kuisioner;?></td>
                        <td>Keriteria Ulasan<!--<?php echo $data_kuesioner->id_jenis_kuisioner;?>---></td>
                        <td>
                        <a class="btn btn-warning" href="<?php echo base_url('users/kuesioner/edit_kuesioner/'.$data_kuesioner->id_data_kuisioner)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
                        <a class="btn btn-danger" data-toggle="modal" data-target="#Hapus<?= $data_kuesioner->id_data_kuisioner?>" role="button">
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
      <?php foreach ($t_kuesioner as $data_kuesioner) { ?>
      <!--Start Modals-->
      <div id="Hapus<?= $data_kuesioner->id_data_kuisioner?>" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
              <h4 class="text-warning">Anda Yakin Menghapus<h4>
              <h4>Keriteria : <?= $data_kuesioner->soal_kuisioner;?><h4>
            </div>
            <form action="<?= site_url('users/kuesioner/hapus_kuesioner')?>" method="POST">
            <input type="hidden" name="id_data_kuisioner" value="<?= $data_kuesioner->id_data_kuisioner?>">    
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