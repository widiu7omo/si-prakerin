  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Monitoring</a>
        </li>
        <li class="breadcrumb-item active">Halaman Monitoring</li>
      </ol>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Monitoring
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example" width="100%" cellspacing="0">
              <thead>
                <tr align="center">
                  <th width="5px">No</th>
                  <th hidden="">No. Surat</th>
                  <th>Pemonev</th>
                  <th>Perusahaan</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot align="center">
                <tr>
                  <th>No</th>
                  <th hidden="">No. Surat</th>
                  <th>Pemonev</th>
                  <th>Perusahaan</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_monitoring->result() as $key): 
                $id_perusahaan = $key->id_perusahaan;
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td hidden=""><?php echo $key->no_surat ?></td>
                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" type="disk">
                    <?php
                    $query = $this->db->query("SELECT tb_monev.nip_nik, tb_pegawai.nama_pegawai FROM tb_monev LEFT JOIN tb_pegawai ON tb_monev.nip_nik = tb_pegawai.nip_nik WHERE tb_monev.no_surat = '$key->no_surat'");
                    foreach ($query->result() as $data):
                    if ($data->nip_nik != NULL) {
                      echo '<li>'.$data->nama_pegawai.'</li>';
                    }
                    endforeach; 
                    ?>
                  </ul>
                  </td>
                  <td>
                  <ul style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;" type="disk">
                    <?php
                    $query = $this->db->query("SELECT tb_perusahaan.nama_perusahaan FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.no_surat = '$key->no_surat'");
                    foreach ($query->result() as $data):
                    if ($data->nama_perusahaan != NULL) {
                      echo '<li>'.$data->nama_perusahaan.'</li>';
                    }
                    endforeach; 
                    ?>
                  </ul>
                  </td>
                  <td >
                    <?php 
                      $date1  = date_create($key->tgl_berangkat);
                      $tgl_berangkat = date_format($date1,"d-m-Y");
                      echo $tgl_berangkat;
                    ?>
                  </td>
                  <td>
                    <?php 
                      $date1  = date_create($key->tgl_pulang);
                      $tgl_pulang = date_format($date1,"d-m-Y");
                      echo $tgl_pulang; 
                    ?>  
                  </td>
                    <?php
                    $status = $key->status;
                    if ($status == 'Proses') {
                      echo '<td width="10px" class="bg-info"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Proses Monitoring">Proses</font></td>';
                    }elseif ($status == 'Selesai') {
                      echo '<td class="bg-success"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Selesai Monitoring">Selesai</font></td>';
                    }
                    ?>
                </tr>
                <?php $no++; endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->



