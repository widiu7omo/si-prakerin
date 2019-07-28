  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Kuesioner</a>
        </li>
        <li class="breadcrumb-item active">Halaman Jawaban Kuesioner Monitoring Perusahaan</li>
      </ol>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Jawaban Kuisioner Monitoring Perusahaan
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example" width="100%" cellspacing="0">
              <thead style="vertical-align: middle; text-align: center;">
                <tr align="center">
                  <th width="5px">No</th>
                  <th>Isi Kuisioner</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                  <th>Cetak</th>
                </tr>
              </thead>
              <tfoot align="center">
                <tr>
                  <th>No</th>
                  <th>Isi Kuisioner</th>
                  <th>Tgl. Berangkat</th>
                  <th>Tgl. Pulang</th>
                  <th>Status</th>
                  <th>Cetak</th>
                </tr>
              </tfoot>
              <tbody style="vertical-align: middle; text-align: center;">
                <?php $no=1; foreach ($data_monitoring->result() as $key): 
                $id_perusahaan = $key->id_perusahaan;
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td>
                    <?php
                    echo 
                    '<a href="'.base_url()?>koordinator/kuisioner2/isi_kuisioner2?id_perusahaan=<?php echo $key->id_perusahaan.'">'.$key->nama_perusahaan.'
                    </a>' 
                    ?>
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
                      echo '<td style="vertical-align: middle; text-align: center;" width="10px" class="bg-info"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Proses Monitoring">Proses</font></td>';
                    }elseif ($status == 'Selesai') {
                      echo '<td style="vertical-align: middle; text-align: center;" class="bg-success"><font class="text-light" data-toggle="tooltip" data-placement="bottom" title="Selesai Monitoring">Selesai</font></td>';
                    }
                    ?>
                  <td width="10px">
                    <?php
                    $status = $key->status;
                    if ($status == 'Selesai') {
                      echo '<a href="'.base_url().'koordinator/kuisioner2/cetak_kuisioner?id_perusahaan='.$id_perusahaan.'" class="modal-with-form">
                      <button class="btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Cetak Data"><i class="fa fa-print"></i></button>
                    </a>';
                    }elseif ($status == 'Proses') {
                      echo '<button class="btn-sm btn-secondry btn-block" disabled data-toggle="tooltip" data-placement="bottom" title="Cetak Data"><i class="fa fa-print"></i></button>';
                    }
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