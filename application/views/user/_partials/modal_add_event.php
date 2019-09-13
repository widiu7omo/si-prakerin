<div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body pb-1">
				<form class="new-event--form">
					<div class="form-group">
						<label class="form-control-label">Pengajuan Konsutasi</label>
						<input type="text" class="form-control form-control-sm form-control-alternative new-event--title" placeholder="Title">
					</div>
					<div class="form-group mb-0">
						<label class="form-control-label d-block mb-3">Status color</label>
						<div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
							<label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked=""></label>
							<label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
							<label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
							<label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
							<label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
							<label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
						</div>
					</div>
					<div class="form-group">
						<label for="keluhan" class="form-control-label">Keluhan</label>
						<textarea rows="4" id="add-masalah" class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Sampaikan keluhan disini"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<div class="form-group">
						<label for="solusi" class="form-control-label">Solusi</label>
						<textarea rows="4" id="add-solusi" class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Solusi yang kamu dapatkan dari dosen (Jika sudah konsultasi)"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<?php
					$nim = $this->session->userdata('id');
					$bimbingan = masterdata('tb_dosen_bimbingan_mhs',"nim = '$nim'",'id_dosen_bimbingan_mhs');
					if($bimbingan){
						echo form_hidden('id_dosen_bimbingan',"$bimbingan->id_dosen_bimbingan_mhs");
					}
					?>
					<input type="hidden" class="new-event--start" value="2019-08-05">
					<input type="hidden" class="new-event--end" value="2019-08-05">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer mt-0 pt-0">
				<button type="submit" class="btn btn-primary btn-sm new-event--add">Add event</button>
				<button type="button" class="btn btn-link btn-sm ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
