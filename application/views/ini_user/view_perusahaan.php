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
               <!--<a class="btn btn-info" href="<?php echo base_url('users/perusahaan/tambah_perusahaan')?>">Tambah Data</a>-->
                  <table id="demo-datatables-fixedheader-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Longitude(Lng)</th>
                        <th>Latitude(Lat)</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($t_perusahaan as $data_perusahaan) {
                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $data_perusahaan->nama_perusahaan;?></td>
                        <td><?php echo $data_perusahaan->long_perusahaan;?></td>
                        <td><?php echo $data_perusahaan->lat_perusahaan;?></td>
                        <td><?php echo $data_perusahaan->telepon_perusahaan;?></td>
                        <td><?php echo $data_perusahaan->alamat_perusahaan;?></td>
                        <td>
                        <a class="btn btn-warning" href="<?php echo base_url('users/perusahaan/edit_perusahaan/'.$data_perusahaan->id_perusahaan)?>" role="button">
                            <span class="icon icon-pencil-square-o"></span> Edit</a>
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