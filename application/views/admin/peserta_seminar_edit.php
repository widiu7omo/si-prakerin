<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<?php $current_tahun_akademik = getCurrentTahun();
$program_studies = masterdata('tb_program_studi');
$id = $this->uri->segment(3);
$peserta = masterdata( 'tb_peserta',"nimpes = '$id'");
?>
<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php');?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav PHP-->
	<?php $this->load->view('admin/_partials/topnav.php');
	?>
    <!-- Header -->
    <!-- BreadCrumb PHP -->
	<?php $this->load->view('admin/_partials/breadcrumb.php');
	?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Edit Peserta Seminar <?php echo $current_tahun_akademik->now?></h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                       
                        <form method="POST" action="<?php echo site_url('peserta/edit')?>">
                            <!-- Input groups with icon -->
                            <?php if ($this->session->flashdata('success')): ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<span class="alert-icon"><i class="ni ni-like-2"></i></span>
											<span
												class="alert-text"><strong>Success! &nbsp;</strong><?php echo $this->session->flashdata('success'); ?></span>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
							<?php endif; ?>
                            <input type="hidden" name="id_tahun_akademik" value="<?php echo $current_tahun_akademik->tahun_id?>" id="">
                            <input type="hidden" name="id" value="<?php echo $id?>" id="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input name="username" value="<?php echo isset($peserta->username)?$peserta->username:null?>" class="form-control" placeholder="NIM" readonly type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
													<span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                            </div>
                                            <input name="namapes" value="<?php echo isset($peserta->namapes)?$peserta->namapes:null?>" class="form-control" placeholder="Nama Mahasiswa" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select class="input-group-prepend form-control" name="id_program_studi" id="">
												<?php foreach ($program_studies as $program_study):?>
                                                    <option <?php echo  $program_study->id_program_studi == $peserta->id_program_studi?'selected':null?> value="<?php echo $program_study->id_program_studi?>"><?php echo $program_study->nama_program_studi?></option>
												<?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php');
?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
