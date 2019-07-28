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
						<h5><strong><?= $form_nama;?></strong></h5>
					</div>
					<div class="card-body">
						<form data-toggle="md-validator" method="POST" action="<?= base_url('users/foto/update_foto')?>"
							enctype="multipart/form-data">
							<div class="col-md-12">
                				<input type="hidden" name="id_foto" value="<?= $t_foto[0]->id_foto?>">
								<div class="form-group label-floating">
									<label class="control-label">Name Foto</label>
									<input class="form-control" type="text" name="nama_foto" value="<?= $t_foto[0]->nama_foto?>" required>
								</div>
								<div class="form-group label-floating">
									<label class="control-label">Deskripsi Foto</label>
									<input class="form-control" type="text" name="deskripsi_foto" value="<?= $t_foto[0]->deskripsi_foto?>" required>
								</div>
								<div class="form-group label-floating">
									<label class="control-label">Foto</label>
									<input class="form-control" type="text" name="file_lama" value="<?php echo $t_foto[0]->data_foto?>" readonly>
								</div>
								<div class="form-group label-floating">
									<label class="control-label">Ubah Foto</label>
									<input class="form-control" type="file" name="file">
								</div>
								<div class="form-group label-floating">
									<button type="submit" class="btn btn-primary btn-block" name="Upload">Ubah</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
