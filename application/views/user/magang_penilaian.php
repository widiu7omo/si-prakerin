<!DOCTYPE html>
<html>
<?php $bimbingan = isset($bimbingan) ? $bimbingan : null;
$perusahaan = isset($perusahaan_terpilih)?$perusahaan_terpilih:null;
?>
<!-- Head PHP -->
<?php $this->load->view('user/_partials/header.php'); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view('user/_partials/sidenav.php'); ?>
<!-- Main content -->
<div class="main-content" id="panel">
	<!-- Topnav PHP-->
	<?php $this->load->view('user/_partials/topnav.php');
	?>
	<!-- Header -->
	<!-- BreadCrumb PHP -->
	<?php $this->load->view('user/_partials/breadcrumb.php');
	?>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<!-- Table -->
		<?php if ($this->session->flashdata('status')): ?>
			<div
				class="alert alert-<?php echo $this->session->userdata('status')['type'] == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show"
				role="alert">
				<span class="alert-icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-text"><strong><?php echo ucfirst($this->session->userdata('status')['type']) ?>!
								&nbsp;</strong><?php echo $this->session->flashdata('status')['message']; ?></span><br>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif; ?>
		<div class="row justify-content-center">
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<h3 class="mb-0">Penilaian dari perusahaan</h3>
					</div>
					<!-- Card body -->
					<div class="card-body">
						<?php if (isset($perusahaan->id) && $perusahaan->id != null): ?>
						<!-- Input groups with icon -->
						<?php $nilai_pkl = isset($nilai_pkl) ? $nilai_pkl : array();
						$nilai = array();
						if (count($nilai_pkl) > 0) {
							$nilai = $nilai_pkl[0];
							$dec_dn = json_decode($nilai->detail_nilai_pkl);
						}
						?>
						<input type="hidden" name="idbm"
							   value="<?php echo isset($bimbingan) ? $bimbingan->id : null ?>">
						<input type="hidden" name="id" value="<?php echo isset($nilai->id) ? $nilai->id : 0 ?>">
						<input type="hidden" name="mode" value="<?php echo isset($nilai->id) ? "u" : "i" ?>">
						<div class="row">
							<div class="col-md-6">
								<div id="komponen-penilaian" class="form-group">
									<label for="" class="form-control-label" id="name-p">1. Disiplin</label>
									<div class="input-group">
										<input type="text" class="form-control" autocomplete="off"
											   value="<?php echo isset($dec_dn) ? $dec_dn[0]->value : null ?>"
											   aria-describedby="helpId"
											   placeholder="Masukkan Nilai">
										<div class="input-group-append">
											<span class="input-group-text">X</span>
											<span class="input-group-text" id="percent-value">15%</span>
											<span class="input-group-text">=</span>
											<span class="input-group-text"
												  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[0]->res : 0 ?></span>
										</div>
									</div>
									<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
											id="percent-help">15%</b></small>
								</div>
							</div>
							<div class="col-md-6">
								<div id="komponen-penilaian" class="form-group">
									<label for="" class="form-control-label" id="name-p">2. Komunikasi</label>
									<div class="input-group">
										<input type="text" class="form-control" autocomplete="off"
											   value="<?php echo isset($dec_dn) ? $dec_dn[1]->value : null ?>"
											   aria-describedby="helpId"
											   placeholder="Masukkan Nilai">
										<div class="input-group-append">
											<span class="input-group-text">X</span>
											<span class="input-group-text" id="percent-value">10%</span>
											<span class="input-group-text">=</span>
											<span class="input-group-text"
												  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[1]->res : 0 ?></span>
										</div>
									</div>
									<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
											id="percent-help">10%</b></small>
								</div>
							</div>
							<div class="col-md-6">
								<div id="komponen-penilaian" class="form-group">
									<label for="" class="form-control-label" id="name-p">3. Kerja Tim</label>
									<div class="input-group">
										<input type="text" class="form-control" autocomplete="off"
											   value="<?php echo isset($dec_dn) ? $dec_dn[2]->value : null ?>"
											   aria-describedby="helpId"
											   placeholder="Masukkan Nilai">
										<div class="input-group-append">
											<span class="input-group-text">X</span>
											<span class="input-group-text" id="percent-value">15%</span>
											<span class="input-group-text">=</span>
											<span class="input-group-text"
												  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[2]->res : 0 ?></span>
										</div>
									</div>
									<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
											id="percent-help">15%</b></small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div id="komponen-penilaian" class="form-group">
										<label for="" class="form-control-label" id="name-p">4. Kerja
											Mandiri</label>
										<div class="input-group">
											<input type="text" class="form-control" autocomplete="off"
												   value="<?php echo isset($dec_dn) ? $dec_dn[3]->value : null ?>"
												   aria-describedby="helpId"
												   placeholder="Masukkan Nilai">
											<div class="input-group-append">
												<span class="input-group-text">X</span>
												<span class="input-group-text" id="percent-value">10%</span>
												<span class="input-group-text">=</span>
												<span class="input-group-text"
													  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[3]->res : 0 ?></span>
											</div>
										</div>
										<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
												id="percent-help">10%</b></small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div id="komponen-penilaian" class="form-group">
										<label for="" class="form-control-label" id="name-p">5. Penampilan</label>
										<div class="input-group">
											<input type="text" class="form-control" autocomplete="off"
												   value="<?php echo isset($dec_dn) ? $dec_dn[4]->value : null ?>"
												   aria-describedby="helpId"
												   placeholder="Masukkan Nilai">
											<div class="input-group-append">
												<span class="input-group-text">X</span>
												<span class="input-group-text" id="percent-value">10%</span>
												<span class="input-group-text">=</span>
												<span class="input-group-text"
													  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[4]->res : 0 ?></span>
											</div>
										</div>
										<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
												id="percent-help">10%</b></small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div id="komponen-penilaian" class="form-group">
										<label for="" class="form-control-label" id="name-p">6. Sikap dan
											Etika</label>
										<div class="input-group">
											<input type="text" class="form-control" autocomplete="off"
												   value="<?php echo isset($dec_dn) ? $dec_dn[5]->value : null ?>"
												   aria-describedby="helpId"
												   placeholder="Masukkan Nilai">
											<div class="input-group-append">
												<span class="input-group-text">X</span>
												<span class="input-group-text" id="percent-value">20%</span>
												<span class="input-group-text">=</span>
												<span class="input-group-text"
													  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[5]->res : 0 ?></span>
											</div>
										</div>
										<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
												id="percent-help">20%</b></small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div id="komponen-penilaian" class="form-group">
										<label for="" class="form-control-label" id="name-p">7. Pengetahuan</label>
										<div class="input-group">
											<input type="text" class="form-control" autocomplete="off"
												   value="<?php echo isset($dec_dn) ? $dec_dn[6]->value : null ?>"
												   aria-describedby="helpId"
												   placeholder="Masukkan Nilai">
											<div class="input-group-append">
												<span class="input-group-text">X</span>
												<span class="input-group-text" id="percent-value">20%</span>
												<span class="input-group-text">=</span>
												<span class="input-group-text"
													  id="res-p"><?php echo isset($dec_dn) ? $dec_dn[6]->res : 0 ?></span>
											</div>
										</div>
										<small id="helpId" class="form-text text-muted">Bobot penilaian sebesar <b
												id="percent-help">20%</b></small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div id="komponen-penilaian" class="form-group">
										<span class="h2 sum-all"
											  id="sum-p1"><?php echo isset($dec_dn) ? $dec_dn[0]->res : "P1" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p2"><?php echo isset($dec_dn) ? $dec_dn[1]->res : "P2" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p3"><?php echo isset($dec_dn) ? $dec_dn[2]->res : "P3" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p4"><?php echo isset($dec_dn) ? $dec_dn[3]->res : "P4" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p5"><?php echo isset($dec_dn) ? $dec_dn[4]->res : "P5" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p6"><?php echo isset($dec_dn) ? $dec_dn[5]->res : "P6" ?></span> +
										<span class="h2 sum-all"
											  id="sum-p7"><?php echo isset($dec_dn) ? $dec_dn[6]->res : "P7" ?></span> =
										<span class="h2 sum-all"
											  id="sum-all"><?php echo isset($nilai->nilai_pkl) ? $nilai->nilai_pkl : "P total" ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-end">
							<div class="col-md-6">
								<button name="insert" id="" class="btn btn-primary btn-block">Simpan
								</button>
							</div>
						</div>
						<?php else: ?>
						<div class="h3 text-warning">Anda belum bisa mengisi penilaian karena anda belum mendapatkan tempat magang</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('user/_partials/footer.php'); ?>
	</div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('user/_partials/js.php');
?>
<script>
	(function ($) {
		$.fn.inputFilter = function (inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		};
	}(jQuery));
	$('[name="insert"]').on('click', function () {
		let isFloatArr = [];
		let detailNilai = [];
		for (let i = 1; i <= 7; i++) {
			let isFloat_n = $('#sum-p' + i).text();
			isFloatArr.push(!isNaN(parseFloat(isFloat_n)));
		}
		if (!isFloatArr.includes(false)) {
			$('input.form-control').map(function (index) {
				let res_n = $(this).siblings('div').children('span#res-p').text();
				let name_n = $(this).parents('div').siblings('label#name-p').text().replace(/\s\s+/g, ' ');
				let value_n = $(this).val();
				detailNilai[index] = {name: name_n, value: value_n, res: res_n};
			});
			let tn = $('#sum-all').text();
			detailNilai.shift();
			let mode = $('input[name="mode"]').val();
			let data = {
				id: $('input[name="id"]').val(),
				tnp: tn,
				dnp: JSON.stringify(detailNilai),
				idbm: $('input[name="idbm"]').val()
			}
			$.ajax({
				url: "<?php echo site_url('magang?m=penilaian&q=') ?>" + 'i',
				method: "POST",
				dataType: "json",
				data: data,
				success: function (e) {
					swal({
						type: "success",
						title: "Berhasil menyimpan nilai",
						buttonsStyling: false,
						confirmButtonClass: 'btn btn-success',
						confirmButtonText: 'OK',
					}).then(function () {
						window.location.reload();
					})
				},
				error: function (e) {
					swal({
						type: "error",
						title: "Gagal menyimpan nilai",
						buttonsStyling: false,
						confirmButtonClass: 'btn btn-warning',
						confirmButtonText: 'Ulangi',
					})
				}
			})
		} else {
			swal({
				type: "error",
				title: "Perika kembali, ada beberapa nilai yang belum dimasukkan",
				buttonsStyling: false,
				confirmButtonClass: 'btn btn-warning',
				confirmButtonText: 'OK',
			})
		}

	})
	$('input.form-control').inputFilter(function (value) {
		if (value <= 100) {
			return /^\d*$/.test(value);
		}
	})

	function calculate() {
		let total = 0;
		for (let i = 1; i <= 7; i++) {
			let sum_n = $('span#sum-p' + i).text();
			if (!isNaN(parseFloat(sum_n))) {
				total = total + parseFloat(sum_n);
			}
		}
		return total.toFixed(2);
	}

	$(document).on('keyup', 'input.form-control', function (e) {
		let value = $(this).val();
		let percentageArr = $(this).siblings('div').children('span#percent-value').text().split('%');
		let result = 0;
		if (!isNaN(parseInt(value))) {
			result = parseInt(value) * parseInt(percentageArr[0]) / 100;
		}
		$(this).siblings('div').children('span#res-p').text(result);
		let index = $('input.form-control').index(this);
		$('#sum-p' + index).text(isNaN(parseInt(value)) ? 'P' + index : result);
		let total = calculate();
		$('span#sum-all').text(total);
	})
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
