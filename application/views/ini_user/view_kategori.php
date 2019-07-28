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
                <a class="btn btn-info" href="<?php echo base_url('users/kategori/tambah_kategori')?>">Tambah Data</a>
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px;">No</th>
                        <th>Nama Kategori Menu</th>
                        <th>Slug Kategori</th>
                        <th style="width:250px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_kategori as $data_kategori) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $data_kategori->nama_kategori;?></td>
                        <td><?php echo $data_kategori->slug_kategori;?></td>
                        <td>
                        <?php if($data_kategori->slug_kategori != 'profile' && $data_kategori->slug_kategori != 'tata-tertib' && $data_kategori->slug_kategori != 'waktu-pelaksanaan'){?>
                          <a class="btn btn-warning" href="<?php echo base_url('users/kategori/edit_kategori/'.$data_kategori->id_kategori)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
                          <a class="btn btn-danger" href="<?php echo base_url('users/kategori/hapus_kategori/'.$data_kategori->id_kategori)?>" role="button">
                            <span class="icon icon-trash-o"></span> Hapus</a>
                        <?php }?>
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