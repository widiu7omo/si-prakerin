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
						<input type="hidden" name="tag" value="bg-info" autocomplete="off" checked="">
					</div>
					<div class="form-group">
						<label for="keluhan" class="form-control-label">Keluhan</label>
						<textarea rows="4" class="form-control form-control-alternative edit-event--masalah textarea-autosize" placeholder="Sampaikan keluhan disini"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<div class="form-group">
						<label for="solusi" class="form-control-label">Solusi</label>
						<textarea rows="4" disabled class="form-control form-control-alternative edit-event--solusi textarea-autosize" placeholder="Solusi akan diberikan oleh dosen pembimbing"></textarea>
						<i class="form-group--bar"></i>
					</div>
					<input type="hidden" class="edit-event--id">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer pt-0">
				<button class="btn btn-primary btn-sm" id="update-konsul-btn" data-calendar="update">Update Konsultasi</button>
				<button class="btn btn-danger btn-sm" id="delete-konsul-btn" data-calendar="delete">Delete</button>
				<button class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
