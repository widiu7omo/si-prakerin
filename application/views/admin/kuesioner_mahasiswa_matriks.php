<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view('admin/_partials/header.php'); ?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
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
		<!-- Card -->
		<div class="header-body">
			<!-- Card stats -->
			<div class="row mb-2">
				<div class="col">
					<ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
						<li class="nav-item">
							<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'standar' ? 'active' : null ?>"
							   id="tabs-text-1-tab"
							   href="<?php echo site_url('kuesioner?m=matriks&sec=standar') ?>" role="tab"
							   aria-controls="tabs-text-1" aria-selected="true">AHP Konvensional</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-sm-3 mb-md-0 <?php echo $this->input->get('sec') == 'fuzzy' ? 'active' : null ?>"
							   id="tabs-text-2-tab"
							   href="<?php echo site_url('kuesioner?m=matriks&sec=fuzzy') ?>"
							   role="tab" aria-controls="tabs-text-2" aria-selected="false">Fuzzy AHP</a>
						</li>
					</ul>
				</div>
			</div>
			<?php if ($this->input->get('sec') == 'standar'): ?>
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="card">
							<div class="card-body">
								<div id="form-matriks">
									<div class="row">
										<?php
										$kriteria_show = [];
										foreach (isset($kriteria) ? $kriteria : [] as $i => $item): ?>
											<?php array_push($kriteria_show, $item->kriteria); ?>
											<?php foreach (isset($kriteria) ? $kriteria : [] as $j => $jtem): ?>
												<?php if ($item->kriteria != $jtem->kriteria && !in_array($jtem->kriteria, $kriteria_show)): ?>
													<div class="col-md-4 col-xs-12">
														<div class="form-group mb-1">
															<label for="" class="form-label"
																   style="font-size: 13px">*) <?php echo $item->kriteria ?>
																<br>terhadap<br><?php echo $jtem->kriteria ?></label>
															<div class="d-flex justify-content-start">
																<input type="number"
																	   class="form-control form-control-sm col-6 mr-1"
																	   name="matriks"
																	   id="c_<?php echo $i + 1 ?>_<?php echo $j + 1 ?>"
																	   aria-describedby="helpId"
																	   placeholder="C-<?php echo $i + 1 ?> dengan C-<?php echo $j + 1 ?>">
																<input type="text"
																	   class="form-control form-control-sm col-6"
																	   name="invers"
																	   readonly
																	   id="c_<?php echo $j + 1 ?>_<?php echo $i + 1 ?>"
																	   aria-describedby="helpId"
																	   placeholder="Invers">
															</div>
														</div>
													</div>
												<?php endif ?>
											<?php endforeach; ?>
										<?php endforeach; ?>
									</div>
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<h3>Preview Bobot</h3>
											<table class="table table-bordered" id="tabel-matriks">
												<tbody>
												<tr>
													<th style="font-size: 17px">#</th>
													<?php foreach (isset($kriteria) ? $kriteria : [] as $j => $item_j): ?>
														<th style="word-break:break-all;"
															scope="col">C-<?php echo $j + 1 ?></th>
													<?php endforeach; ?>
												</tr>
												<?php foreach (isset($kriteria) ? $kriteria : [] as $i => $item_i): ?>
													<tr>
														<th style="word-break:break-all;"
															scope="row">C-<?php echo $i + 1 ?></th>
														<?php foreach (isset($kriteria) ? $kriteria : [] as $j => $item_j): ?>
															<td data-id="<?php echo $item_j->id ?>"
																id="c_i<?php echo $i + 1 ?>_j<?php echo $j + 1 ?>">0
															</td>
														<?php endforeach; ?>
													</tr>
												<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button id="btn-normalize" class="btn btn-info">Normalisasi Nilai</button>
								<button id="btn-validasi" class="btn btn-success">Validasi Nilai</button>
								<button id="btn-simpan" class="btn btn-success" disabled>Simpan</button>
							</div>
						</div>
					</div>
				</div>
			<?php elseif ($this->input->get('sec') == 'fuzzy'): ?>
				<div class="row">
					<div class="col-md-12 col-xs-12">

					</div>
				</div>
			<?php endif ?>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php'); ?>
<?php $this->load->view('admin/_partials/js.php'); ?>
<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
?>
<script>
	function averageNormalization(normalizeCriteria, keys, keysID) {
		let averageEachI = [];
		// console.log(normalizeCriteria);
		keys.forEach(function (key, index) {
			let averageI = 0;
			let objectI = {};
			normalizeCriteria.forEach(function (criteria) {
				//if key contain Ix then
				if (criteria.key.includes(key)) {
					averageI += criteria.normalize;
				}
			})
			averageI = averageI / keys.length;
			objectI.rata2 = averageI;
			objectI.key = key;
			objectI.id = keysID[index];
			averageEachI.push(objectI);
		})
		return averageEachI;
	}

	function normalizationValue(totalEachJ, groupedCriteria) {
		let eachKeyJ = Object.keys(totalEachJ);
		let total = 0;
		eachKeyJ.forEach(function (key) {
			total += totalEachJ[key]
		})
		//ganti struktur
		// sebelumnya key dinamis {c_ix_jx:nilai}
		// setelahnya key statis {key:c_ix_jx:
		let newJsonFormatCriteria = [];
		// console.log(total);
		groupedCriteria.forEach(function (criteria) {
			let newObject = {};
			// console.log(criteria);
			//kriteria hanya punya 1 key
			let keyCriteria = Object.keys(criteria);
			// let splitedKeyCri = keyCriteria.split('_');
			// //indexx J number 2;
			// let indexJ = splitedKeyCri[2];
			// if()
			let normalizeCriteria = 0;
			eachKeyJ.forEach(function (key) {
				if (keyCriteria[0].includes(key)) {
					normalizeCriteria = parseFloat(criteria[keyCriteria]) / parseFloat(totalEachJ[key])
					newObject.key = keyCriteria[0];
					newObject.normalize = normalizeCriteria
					newJsonFormatCriteria.push(newObject);
				}
			})
		})
		// console.log(newJsonFormatCriteria);
		return newJsonFormatCriteria;
	}

	function getRandomIndex(callback, RI, n) {
		$.ajax({
			url: "<?php echo site_url('kuesioner/ambil_random_index')?>",
			dataType: 'json',
			success: function (res) {
				callback(res, RI, n);
			}
		})
	}

	function countCI(lamdaMax, n) {
		let CI = 0;
		CI = (lamdaMax - n) / (n - 1);
		//countCR
		//ajax RI first, then call countCR;
		getRandomIndex(countCR, CI, n);
	}

	function countCR(RIs, CI, n) {
		let RI = 0;
		RIs.forEach(function (item) {
			//om = ORDE MATRIK
			if (parseInt(item.om) === n) {
				RI = item.ri
			}
		})
		let CR = CI / RI;
		let percentage = CR * 100;
		let status = percentage < 10 ? "success" : "error";
		Swal.fire({
			type: status,
			title: status === 'success' ? 'Validasi berhasil, dengan hasil ' + percentage.toFixed(1) + '%' : 'Validasi gagal dengan hasil ' + percentage.toFixed(1) + '%',
			text: status === 'success' ? 'Persentasi kurang dari 10% sehingga nilai bobot dapat digunakan. Silahkan klik tombol Simpan' : 'Persentasi lebih dari 10%, bobot tidak dapat digunakan. Silahkan tentukan bobot ulang.',
		})
		$('#btn-simpan').prop('disabled', status !== 'success');
	}

	$(document).ready(function () {
		//looking bobot on localstorage (temporary)
		if (localStorage.getItem('bobot')) {
			let bobot = JSON.parse(localStorage.getItem('bobot'));
			// console.log(bobot);
			$('#tabel-matriks').find('td').each(function (index, item) {
				let key = Object.keys(bobot[index]);
				$(item).text(bobot[index][key])
			})
		}
	})
	$('#btn-simpan').on('click', function () {
		if (!localStorage.getItem('rata2')) {
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Bobot tidak bisa disimpan, coba lakukan perhitungan lagi',
			})
		} else {
			let rata2 = JSON.parse(localStorage.getItem('rata2'));
			console.log(rata2);
			//lanjutkan simpan bobot, tapi ganti struktur database;
			$.ajax({
				url:"<?php echo site_url('kuesioner/simpan_bobot_ahp')?>",
				dataType: 'json',
				method:"POST",
				data: {
					bobot: JSON.stringify(rata2),
				},
				success: function (res) {
					console.log(res);
				},
				error: function (err) {
					console.log(err);
				}
			})
		}
	})
	$('#btn-validasi').on('click', function () {
		if ((!localStorage.getItem('rata2') && !localStorage.getItem('bobot')) || (!localStorage.getItem('keysI') && !localStorage.getItem('keysJ'))) {
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Bobot belum di normalisasi, silahkan klik tombol normalisasi terlebih dahulu',
			})
		} else {
			let averageCriteria = JSON.parse(localStorage.getItem('rata2'));
			let bobotCriteria = JSON.parse(localStorage.getItem('bobot'));
			let keysI = JSON.parse(localStorage.getItem('keysI'));
			let keysJ = JSON.parse(localStorage.getItem('keysJ'));
			//reformat bobot
			let newFormatBobot = bobotCriteria.map(function (item) {
				let keys = Object.keys(item);
				return {key: keys[0], bobot: item[keys[0]]};
			})

			//invers i to j
			let inversSverageCriteria = averageCriteria.map(function (j) {
				let newKey = 'j' + j.key.substring(1);
				return {key: newKey, rata2: j.rata2};
			})
			// console.log(inversSverageCriteria);
			newFormatBobot.forEach(function (bobot) {
				inversSverageCriteria.forEach(function (j) {
					if (bobot.key.includes(j.key)) {
						bobot.validasi = bobot.bobot * j.rata2;
					}
				})
			})
			// console.log(newFormatBobot);
			//sum i way
			let sumEachValidasi = [];
			keysI.forEach(function (i) {
				let sumValidasi = 0;
				newFormatBobot.forEach(function (bobot) {
					if (bobot.key.includes(i)) {
						sumValidasi += bobot.validasi;
					}
				})
				sumEachValidasi.push({key: i, sumvalidasi: sumValidasi});
			})
			// console.log(sumEachValidasi);
			//hasil bagi
			let subtrackEachValidasiI = [];
			let sumSubstractedValidasi = 0;
			let sumSub = 0;
			sumEachValidasi.forEach(function (validasi) {
				let subResult = 0;
				averageCriteria.forEach(function (criteria) {
					if (validasi.key === criteria.key) {
						subResult = validasi.sumvalidasi / criteria.rata2;
					}
				})
				sumSub += subResult;
				subtrackEachValidasiI.push({key: validasi.key, subvalidasi: subResult})
			})
			sumSubstractedValidasi = sumSub / sumEachValidasi.length;
			let n = averageCriteria.length;
			countCI(sumSubstractedValidasi, n);
			//ENABLE THIS < VERY IMPORTANT >
			// hapus data normalisasi sebelumnya
			// localStorage.removeItem('rata2');
			// localStorage.removeItem('bobot');
		}
	})
	$('#btn-normalize').on('click', function () {
		let groupedCriteria = [];
		let groupByJ = {};
		let totalEachJ = {};
		let keysJ = [];
		let keysI = [];
		let keysId = [];
		$('#tabel-matriks').find('td').each(function (index, item) {
			let itemVal = $(item).text().replace(/^\s+|\s+$/g, "");
			if (itemVal === "0") {
				alert('Pengisian ada yang terlewat');
				return false;
			}
			let key = $(item).prop('id');
			let value = $(item).text();
			if (value.includes('/')) {
				let [num, den] = value.split('/');
				value = parseFloat(num) / parseFloat(den);
			}
			let newObject = {};
			newObject[key] = parseFloat(value);
			groupedCriteria.push(newObject);

			let splitedKey = key.split('_');
			let id_kriteria = $(item).data('id');
			keysI.push(splitedKey[1]);
			keysJ.push(splitedKey[2]);
			keysId.push(id_kriteria);
			//count total Each J
			if (key.includes(splitedKey[2])) {
				if (typeof totalEachJ[splitedKey[2]] === "undefined") {
					totalEachJ[splitedKey[2]] = 0;
				}
				//total each J
				totalEachJ[splitedKey[2]] += parseFloat(value);
				//store key to keysJ
			}
		})
		//total
		//filter unique keys of I and J
		let uniqI = keysI.filter(unique);
		let uniqJ = keysJ.filter(unique);
		let uniqId = keysId.filter(unique);
		let normalizeCriteria = normalizationValue(totalEachJ, groupedCriteria, keysId)
		let averageCriteria = averageNormalization(normalizeCriteria, uniqI, uniqId);
		localStorage.setItem('bobot', JSON.stringify(groupedCriteria));
		localStorage.setItem('rata2', JSON.stringify(averageCriteria));
		localStorage.setItem('keysI', JSON.stringify(uniqI));
		localStorage.setItem('keysJ', JSON.stringify(uniqJ));
		Swal.fire({
			type: 'success',
			title: 'Normalisasi Berhasil',
			text: 'Bobot berhasil di normalisasi, klik tombol validasi untuk memvalidasi bobot',
		})
	})

	let firstValue = 0;
	let filledMatriks = [];
	$('#form-matriks').on('blur', '[name="matriks"]', function () {
		let inputId = $(this).prop('id')
		let splitId = inputId.split('_');
		let inputI = splitId[1];
		let inputJ = splitId[2];
		let valueThis = $(this).val();
		let idInvers = '#c_' + inputJ + '_' + inputI;
		let idTable = '#c_i' + inputI + '_j' + inputJ;
		let idTableInvers = '#c_i' + inputJ + '_j' + inputI;
		$(idInvers).val('1/' + valueThis);
		$(idTable).text(valueThis);
		$(idTableInvers).text('1/' + valueThis);
		$('#tabel-matriks').find('td').map(function (index, item) {
			let splitedTable = $(item).prop('id').split('_');
			// console.log(splitedTable)
			let splitedI = splitedTable[1].substring(1);
			let splitedJ = splitedTable[2].substring(1);
			if (splitedI === splitedJ) {
				let id = splitedTable.join('_');
				$('#' + id).text(valueThis / valueThis);
				// } else if (splitedI[1] < splitedJ[1]) {
				// 	$(id).text(valueThis / firstValue);
			}
		})
	})
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
