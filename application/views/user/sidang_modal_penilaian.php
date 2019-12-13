<div class="modal fade" id="modal-seminar-penilaian" tabindex="-1" role="dialog" aria-labelledby="new-event-label"
	 style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body pb-1">
				<form class="new-event--form">
					<p id="detail-jadwal" class="h2"></p>
					<ul class="list-group">
						<li class="list-group-item p-1 pl-3">
							<div>
								<p class="h4"><i class="fas fa-user" aria-hidden="true"></i>&nbsp;<b
										>Nama &emsp;&emsp;&emsp;&emsp;&nbsp;: <span id="detail-nama">Ken Hendrik</span></b>
								</p>
							</div>
							<div>
								<p class="h4"><i class="fas fa-dice"></i>&nbsp;<b>NIM&emsp;&emsp;&emsp;&emsp;&emsp;:
										<span id="detail-nim">A1316021</span></b></p>
							</div>
							<div>
								<p class="h4"><i class="fas fa-location-arrow"></i>&nbsp;<b id="detail-waktu">Program
										Studi : <span id="detail-prodi">Teknik Informatika</span></b></p>
							</div>
							<div>
								<p class="h4"><i class="fas fa-file-word"></i>&nbsp;<b id="detail-waktu">Judul
										Laporan &nbsp;&nbsp;: <span id="detail-laporan">Aplikasi bla bla</span></b></p>
							</div>
						</li>
						<li class="list-group-item p-1 pl-3">
							<p class="h4">Penilaian : <b></b></p>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label" id="name-p1">1. Penyajian Presentasi</label>
								<div class="input-group">
									<input type="text" class="form-control" id="p1" autocomplete="off"
										   aria-describedby="helpId"
										   placeholder="Masukkan Nilai">
									<div class="input-group-append">
										<span class="input-group-text">X</span>
										<span class="input-group-text" id="percent-value">10%</span>
										<span class="input-group-text">=</span>
										<span class="input-group-text" id="res-p1">0</span>
									</div>
								</div>
								<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b id="percent-help">10%</b></small>
							</div>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label" id="name-p2">2. Pemahaman Materi</label>
								<div class="input-group">
									<input type="text" class="form-control" id="p2" autocomplete="off"
										   aria-describedby="helpId"
										   placeholder="Masukkan Nilai">
									<div class="input-group-append">
										<span class="input-group-text">X</span>
										<span class="input-group-text" id="percent-value">15%</span>
										<span class="input-group-text">=</span>
										<span class="input-group-text" id="res-p2">0</span>
									</div>
								</div>
								<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b id="percent-help">15%</b></small>
							</div>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label" id="name-p3">3. Hasil yang dicapai</label>
								<div class="input-group">
									<input type="text" class="form-control" id="p3" autocomplete="off"
										   aria-describedby="helpId"
										   placeholder="Masukkan Nilai">
									<div class="input-group-append">
										<span class="input-group-text">X</span>
										<span class="input-group-text" id="percent-value">40%</span>
										<span class="input-group-text">=</span>
										<span class="input-group-text" id="res-p3">0</span>
									</div>
								</div>
								<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b id="percent-help">40%</b></small>
							</div>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label" id="name-p4">4. Objektifitas menganggapi pertanyaan</label>
								<div class="input-group">
									<input type="text" class="form-control" id="p4" autocomplete="off"
										   aria-describedby="helpId"
										   placeholder="Masukkan Nilai">
									<div class="input-group-append">
										<span class="input-group-text">X</span>
										<span class="input-group-text" id="percent-value">20%</span>
										<span class="input-group-text">=</span>
										<span class="input-group-text" id="res-p4">0</span>
									</div>
								</div>
								<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b id="percent-help">20%</b></small>
							</div>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label" id="name-p5">5. Penulisan laporan</label>
								<div class="input-group">
									<input type="text" class="form-control" id="p5" autocomplete="off"
										   aria-describedby="helpId"
										   placeholder="Masukkan Nilai">
									<div class="input-group-append">
										<span class="input-group-text">X</span>
										<span class="input-group-text" id="percent-value">15%</span>
										<span class="input-group-text">=</span>
										<span class="input-group-text" id="res-p5">0</span>
									</div>
								</div>
								<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b id="percent-help">15%</b></small>
							</div>
							<div id="komponen-penilaian" class="form-group">
								<label for="" class="form-control-label">Total keseluruhan</label>
								<p class="h3 font-weight-bold">
									<span id="p1-tot">P1</span>&nbsp;+
									<span id="p2-tot">P2</span>&nbsp;+
									<span id="p3-tot">P3</span>&nbsp;+
									<span id="p4-tot">P4</span>&nbsp;+
									<span id="p5-tot">P5</span>&nbsp;=&nbsp;
									<span id="pn-tot" class="h2">PT</span>
								</p>
							</div>
						</li>
					</ul>
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer mt-2 pt-0">
				<input type="hidden" id="status-penilaian"/>
				<input type="hidden" id="session-penilaian"/>
				<button type="button" class="btn btn-outline-danger btn-sm ml-auto" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-sm" id="btn-simpan-nilai" data-method="i">Simpan</button>
			</div>
		</div>
	</div>
</div>
