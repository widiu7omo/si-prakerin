  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Kuesioner</a>
        </li>
        <li class="breadcrumb-item active">Halaman Soal Kuesioner Monitoring Perusahaan</li>
      </ol>

      <div class="row">
        <div class="col-xl-2 col-sm-6 mb-3">
          <a data-toggle="modal" data-target="#Modaltambahdatasoal">
            <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Data</button>
          </a>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Soal Kuisioner Monitoring Perusahaan
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
              <thead style="vertical-align: middle; text-align: center;">
                <tr align="center">
                  <th>No</th>
                  <th>Soal</th>
                  <th>Jenis Soal Kuisioner</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Soal</th>
                  <th>Jenis Soal Kuisioner</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $no=1; foreach ($data_soal_kuesioner->result() as $key): ?>
                  <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo $no; ?></td>
                    <td style="text-align: justify;"><?php echo $key->soal_kuisioner; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $key->jenis_kuisioner; ?></td>
                    <td style="vertical-align: middle; text-align: center;">     
                    <!-- Tombol Edit -->
                    <a href="<?php echo base_url()?>koordinator/kuisioner/edit_kuisioner?id_data_kuisioner=<?php echo $key->id_data_kuisioner ?>" class="modal-with-form">
                      <button class="btn-sm btn-warning btn-block" data-toggle="tooltip" data-placement="bottom" title="Edit Data <?php echo $key->id_jenis_kuisioner ?>"><i class="fa fa-edit"></i></button>
                    </a>
                    <!-- Tombol Delete -->
                    <a href="<?php echo base_url()?>koordinator/kuisioner/delete?id_data_kuisioner=<?php echo $key->id_data_kuisioner ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $key->id_jenis_kuisioner ?> ?')">
                      <button class="btn-sm btn-danger btn-block" data-toggle="tooltip" data-placement="bottom" title="Hapus Data <?php echo $key->id_jenis_kuisioner ?>"><i class="fa fa-trash-o"></i></button>
                    </a>
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

    <div class="modal fade" id="Modaltambahdatasoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Modaltambahdata" align="text-center">MASUKAN DATA SOAL KUESIONER</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <form class="form-horizontal" method="post" action="<?php echo site_url()?>koordinator/kuisioner/insert_soal">
          <div class="modal-body">
              <!-- <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="url_kuisioner">No Soal</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="id_data_kuisioner" name="id_data_kuisioner" class="form-control" required="" autocomplete="off" autofocus="">
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="row clearfix">
                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                  <label for="tgl_dibuat">Soal Kuisioner</label>
                </div>
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <textarea type="text" class="form-control" required="" name="soal_kuisioner"></textarea>
                    </div>
                  </div>
                </div>
              </div>

          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-primary" type="submit">SIMPAN</button>
            <button class="btn btn-warning" type="reset">BATAL</button>
            <button class="btn btn-danger" type="reset" data-dismiss="modal">TUTUP</button>
          </div>
          </form>
        </div>
      </div>
    </div>