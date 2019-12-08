<div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body pb-1">
				<form class="edit-event--form">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="form-control-label">Tanggal Seminar</label>
								<div class="input-group input-group-merge">
									<input type="text" name="tanggal_seminar"
										   id="tanggal-seminar-edit" class="form-control"
										   placeholder="Pilih Tanggal" autocomplete="off"
										   value="yyyy-mm-dd">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-control-label">Mulai Seminar</label>
								<div class="input-group clockpicker input-group-merge" data-placement="left"
									 data-align="top" data-autoclose="true">
									<input id="waktu-mulai-edit" class="form-control" placeholder="Waktu Seminar" type="time">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-control-label">Selesai Seminar</label>
								<div class="input-group clockpicker input-group-merge" data-placement="left"
									 data-align="top" data-autoclose="true">
									<input id="waktu-selesai-edit" class="form-control" placeholder="Waktu Seminar" type="time">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<select id="select-mahasiswa-edit" class="form-control"></select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<input type="text" class="form-control" id="input-pembimbing-edit" placeholder="Pembimbing" readonly/>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<select id="select-ruangan-edit" class="form-control"></select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<select id="select-penguji1-edit" class="form-control"></select>
							</div>
						</div>
						<div class="col-6">
							<div class="from-group">
								<select id="select-penguji2-edit" class="form-control"></select>
							</div>
						</div>
						<input type="hidden" id="id_dosen_bimbingan_mhs_edit">
						<input type="hidden" id="id_ruangan_edit">
						<input type="hidden" id="id_p1_edit">
						<input type="hidden" id="id_p2_edit">
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
