<div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body pb-1">
				<form class="edit-event--form">
					<div class="form-group">
						<label class="form-control-label">Pengajuan Konsutasi</label>
						<input type="text" class="form-control form-control-alternative edit-event--title" placeholder="Event Title"/>
					</div>
					<div class="form-group">
						<label class="form-control-label d-block mb-3">Status color</label>
						<div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
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
						<textarea rows="4" class="form-control form-control-alternative edit-event--masalah textarea-autosize" placeholder="Sampaikan keluhan disini"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<div class="form-group">
						<label for="solusi" class="form-control-label">Solusi</label>
						<textarea rows="4" class="form-control form-control-alternative edit-event--solusi textarea-autosize" placeholder="Solusi yang kamu dapatkan dari dosen (Jika sudah konsultasi)"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<input type="hidden" class="edit-event--id">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer pt-0">
				<button class="btn btn-primary btn-sm" data-calendar="update">Update</button>
				<button class="btn btn-danger btn-sm" data-calendar="delete">Delete</button>
				<button class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
