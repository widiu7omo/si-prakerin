  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Kuisioner</a>
        </li>
        <li class="breadcrumb-item active">Halaman Kuisioner Pemonitoring Perusahaan</li>
      </ol>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Kuisioner Pemonitoring Perusahaan
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example" width="100%" cellspacing="0">
              <thead>
                <tr align="center">
                  <th width="5px">No</th>
                  <th>Isi Kuisioner</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <!-- <th>Status</th> -->
                </tr>
              </thead>
              <tfoot align="center">
                <tr>
                  <th>No</th>
                  <th>Isi Kuisioner</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <!-- <th>Status</th> -->
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_monitoring->result() as $key): 
                $id_perusahaan = $key->id_perusahaan;
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td>
                    <?php
                      $query = $this->db->query("SELECT COUNT(tb_perusahaan.id_perusahaan) AS total, tb_perusahaan.nama_perusahaan, tb_perusahaan.id_perusahaan, tb_monev.status FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.no_surat = '$key->no_surat'");
                      foreach ($query->result() as $data):
                        $total = $data->total;
                      endforeach;
                      if ($total = 1) {
                        echo  '<a href="'.base_url()?>pemonev/kuisioner/isi_kuisioner2?id_perusahaan=<?php echo $data->id_perusahaan.'">'.$data->nama_perusahaan.'</a> ('.$data->status.')';
                      } else {
                    ?>

                    <ol style="display: block; margin-left: 0; margin-right: 0; padding-left: 20px;">
                    <?php
                      $query = $this->db->query("SELECT tb_perusahaan.nama_perusahaan, tb_perusahaan.id_perusahaan, tb_monev.status FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.no_surat = '$key->no_surat'");
                      foreach ($query->result() as $data):
                        if ($data->nama_perusahaan != NULL) {
                          echo 
                        '<a href="'.base_url()?>pemonev/kuisioner/isi_kuisioner2?id_perusahaan=<?php echo $data->id_perusahaan.'"><li>'.$data->nama_perusahaan.'</li></a>'.'('.$data->status.')';
                        }
                      endforeach;
                    }
                    ?>
                    </ol>
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

