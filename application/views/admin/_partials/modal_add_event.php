<div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label"
	 style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body pb-1">
				<form class="new-event--form">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="form-control-label">Tanggal Seminar</label>
								<div class="input-group input-group-merge">
									<input required type="text" name="tanggal_seminar"
										   id="tanggal-seminar" class="form-control"
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
									<input required id="waktu-mulai" class="form-control" placeholder="Waktu Seminar"
										   type="time">
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
									<input required id="waktu-selesai" class="form-control" placeholder="Waktu Seminar"
										   type="time">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<select required id="select-mahasiswa" class="form-control" data-toggle="select" title="Mahasiswa Seminar" data-live-search="true" data-live-search-placeholder="Search ..."></select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<input type="text" class="form-control" id="input-laporan" placeholder="Judul Laporan" readonly/>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<input type="text" class="form-control" id="input-pembimbing" placeholder="Pembimbing" readonly/>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<select required id="select-ruangan" class="form-control"></select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<select required id="select-penguji1" class="form-control"></select>
							</div>
						</div>
						<div class="col-6">
							<div class="from-group">
								<select required id="select-penguji2" class="form-control"></select>
							</div>
						</div>
						<input type="hidden" id="id_dosen_bimbingan_mhs">
						<input type="hidden" id="id_ruangan">
						<input type="hidden" id="id_p1">
						<input type="hidden" id="id_p2">
					</div>
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer mt-0 pt-0">
				<button type="submit" class="btn btn-primary btn-sm new-event--add">Tambah Jadwal</button>
				<button type="button" class="btn btn-link btn-sm ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
