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
							   aria-controls="tabs-text-1" aria-selected="true">Validasi AHP</a>
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
				<div class="card">
					<div class="card-header"><h2>Konversi bobot ke Fuzzy</h2></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<h3>Bobot Awal</h3>
								<table class="table table-bordered" id="tabel-matriks-fuzzy">
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
						<div class="row mt-2">
							<div class="col-md-12 col-xs-12">
								<hr>
								<div class="row mt-3 mb-1">
									<div class="col-md-12 col-xs-12 d-flex justify-content-between align-items-center">
										<h3>Konversi Ke Fuzzy</h3>
										<div>
											<button id="btn-acuan-fuzzy" class="btn btn-sm btn-info">Acuan Skala Fuzzy
											</button>
											<button id="btn-konversi-fuzzy" class="btn btn-sm btn-success">Konversi
											</button>
										</div>
									</div>
								</div>
								<table class="table table-bordered table-responsive" id="tabel-konversi-fuzzy">
									<tbody>
									<tr>
										<th style="font-size: 17px">#</th>
										<?php foreach (isset($kriteria) ? $kriteria : [] as $j => $item_j): ?>
											<th colspan="3" style="word-break:break-all;"
												scope="col">C-<?php echo $j + 1 ?></th>
										<?php endforeach; ?>
									</tr>
									<?php foreach (isset($kriteria) ? $kriteria : [] as $i => $item_i): ?>
										<tr>
											<th style="word-break:break-all;"
												scope="row">C-<?php echo $i + 1 ?></th>
											<?php foreach (isset($kriteria) ? $kriteria : [] as $j => $item_j): ?>
												<td data-id="<?php echo $item_j->id ?>"
													id="c_i<?php echo $i + 1 ?>_j<?php echo $j + 1 ?>_k1">0
												</td>
												<td data-id="<?php echo $item_j->id ?>"
													id="c_i<?php echo $i + 1 ?>_j<?php echo $j + 1 ?>_k2">0
												</td>
												<td data-id="<?php echo $item_j->id ?>"
													id="c_i<?php echo $i + 1 ?>_j<?php echo $j + 1 ?>_k3">0
												</td>
											<?php endforeach; ?>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-md-12 col-xs-12">
								<hr>
								<div class="card" style="height: 400px">
									<div class="card-body">
										<canvas id="canvas"></canvas>
									</div>
								</div>
							</div>
						</div>
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
<?php if ($this->input->get('sec') == 'fuzzy'): ?>
	<?php $this->load->view('admin/_partials/modal_preview.php'); ?>
<?php endif; ?>
<?php $this->load->view('admin/_partials/js.php'); ?>
<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
?>
<?php if ($this->input->get('sec') == 'standar'): ?>
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
			if (localStorage.getItem('bobot_ori')) {
				let bobot = JSON.parse(localStorage.getItem('bobot_ori'));
				// console.log(bobot);
				$('#tabel-matriks').find('td').each(function (index, item) {
					$(item).text(bobot[index].value)
				})
			} else {
				$.ajax({
					url: "<?php echo site_url('kuesioner/get_bobot_awal')?>",
					dataType: 'json',
					success: function (res) {
						if (typeof res.bobot_awal !== "undefined") {
							let bobot_awal = JSON.parse(res.bobot_awal);
							$('#tabel-matriks').find('td').each(function (index, item) {
								$(item).text(bobot_awal[index].value)
							})
						}
					}
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
				let originalCriteria = JSON.parse(localStorage.getItem('bobot_ori'));
				console.log(rata2);
				//lanjutkan simpan bobot, tapi ganti struktur database;
				$.ajax({
					url: "<?php echo site_url('kuesioner/simpan_bobot_ahp')?>",
					dataType: 'json',
					method: "POST",
					data: {
						bobot: JSON.stringify(rata2),
						bobot_ori: JSON.stringify(originalCriteria)
					},
					success: function (res) {
						console.log(res);
						Swal.fire({
							type: 'success',
							title: 'Berhasil',
							text: 'Bobot berhasil disimpan',
						})
					},
					error: function (err) {
						console.log(err);
						Swal.fire({
							type: 'error',
							title: 'Gagal',
							text: 'Bobot gagal disimpan',
						})
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
			let originalCriteria = [];
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
				let id_kriteria = $(item).data('id');
				let key = $(item).prop('id');
				let value = $(item).text();
				//create object that original

				let newOriginalObject = {};
				newOriginalObject.key = key;
				newOriginalObject.value = value;
				newOriginalObject.id = id_kriteria;
				originalCriteria.push(newOriginalObject);

				//create object that has been converted to float
				if (value.includes('/')) {
					let [num, den] = value.split('/');
					value = parseFloat(num) / parseFloat(den);
				}
				let newObject = {};
				newObject[key] = parseFloat(value);
				groupedCriteria.push(newObject);

				let splitedKey = key.split('_');
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
			localStorage.setItem('bobot_ori', JSON.stringify(originalCriteria));
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
<?php else: ?>
	<script>
		function get_skala_fuzzy(callback = Function(), bobot_awal) {
			$.ajax({
				url: "<?php echo site_url('kuesioner/ambil_skala_fuzzy')?>",
				dataType: 'json',
				success: function (res) {
					callback(res, bobot_awal);
				}
			})
		}

		function show_modal(res) {
			console.log(res);
			let htmlTable = "<table class='table table-bordered'><tr>" +
					"<th>Skala AHP</th>" +
					"<th colspan='3'>Skala Fuzzy</th>" +
					"<th colspan='3'>Invers Skala Fuzzy</th>" +
					"<th>Keterangan</th>" +
					"</tr>";
			res.forEach(function (row) {
				htmlTable += "<tr>" +
						"<td>" + row.skala_ahp + "</td>" +
						"<td>" + row.skala_fuzzy[0] + "</td>" +
						"<td>" + row.skala_fuzzy[1] + "</td>" +
						"<td>" + row.skala_fuzzy[2] + "</td>" +
						"<td>" + row.invers_skala_fuzzy[0] + "</td>" +
						"<td>" + row.invers_skala_fuzzy[1] + "</td>" +
						"<td>" + row.invers_skala_fuzzy[2] + "</td>" +
						"<td>" + row.desc + "</td>" +
						"</tr>"
			})
			htmlTable += "</table>";
			$('#previewModalLabel').text('Tabel acuan skala fuzzy');
			$('#previewModalBody').html(htmlTable);
			$('#previewModal>.modal-dialog').addClass('modal-lg');
			$('#previewModal').modal('show');
		}

		function konversi_fuzzy(acuan_fuzzy, bobot_awal) {
			let newBobotFuzzy = [];
			let keysI = [];
			let keysJ = [];
			let keysID = [];
			bobot_awal.forEach(function (bobot) {
				let splitedKey = bobot.key.split('_');
				let indexI = splitedKey[1];
				let indexJ = splitedKey[2];
				let fuzzyValue = {};
				keysI.push(indexI);
				keysJ.push(indexJ);
				keysID.push(bobot.id)
				//if index i and j in same point, then
				if (indexI.substring(1) === indexJ.substring(1)) {
					//take first fuzzy, cz i and j in same point
					fuzzyValue.skala_fuzzy = acuan_fuzzy[0].skala_fuzzy;
					fuzzyValue.key = bobot.key;
				} else {
					acuan_fuzzy.forEach(function (fuzzy) {
						//if index i and j arent in same point
						//value that include / are invers value, so you must select invers fuzzy array
						if (bobot.value.includes('/')) {
							let splitedBobot = bobot.value.split('/');
							//if fuzzy scale same value with skala ahp, then value of invers_skala_fuzzy push it to an array
							if (splitedBobot[1] === fuzzy.skala_ahp) {
								fuzzyValue.skala_fuzzy = fuzzy.invers_skala_fuzzy;
								fuzzyValue.key = bobot.key;
							}
						} else {
							//if fuzzy scale same value with skala ahp, then value of skala_fuzzy push it to an array
							if (bobot.value === fuzzy.skala_ahp) {
								fuzzyValue.skala_fuzzy = fuzzy.skala_fuzzy;
								fuzzyValue.key = bobot.key;
							}
						}
					})
				}
				newBobotFuzzy.push(fuzzyValue);
			})
			let uniqueI = keysI.filter(unique);
			let uniqueJ = keysJ.filter(unique);
			let uniqueID = keysID.filter(unique);
			let extendedFuzzy = fuzzyExtend(newBobotFuzzy, uniqueI, uniqueJ);
			let sumExtendedFuzzy = sumFuzzyExtend(extendedFuzzy);
			let transposedFuzzy = transposeSummedFuzzyExtend(sumExtendedFuzzy);
			let synteticedFuzzy = syntectingFuzzy(extendedFuzzy, transposedFuzzy);
			let comparedValueOfFuzzy = countComparisonPosibiliyBetweenFuzzy(synteticedFuzzy)
			let finalFuzzyValue = getFinalResultW(comparedValueOfFuzzy, uniqueID);

			//update chart JS
			barChartData.datasets.forEach(function (dataset) {
				dataset.data = finalFuzzyValue.map(function (value) {
					return value.w_value.toFixed(5);
				});
				dataset.labels = finalFuzzyValue.map(function (value, index) {
					return 'Kriteria ' + index;
				});
			});
			window.myBar.update();
			$('#tabel-konversi-fuzzy').find('td').each(function (index, item) {
				let id = $(item).prop('id');
				// console.log(id);
				newBobotFuzzy.forEach(function (fuzzy) {
					if (id.includes(fuzzy.key)) {
						for (let k = 0; k < 3; k++) {
							let fuzzyId = '#' + fuzzy.key + '_k' + (k + 1);
							$(fuzzyId).text(fuzzy.skala_fuzzy[k]).addClass(k === 0 ? 'bg-warning text-white' : (k === 2 ? 'bg-success text-white' : null));
						}
					}
				})
			})
			Swal.fire({
				title: 'Konversi Bobot ke Fuzzy Selesai',
				text: "Apakah anda ingin menyimpan bobot ini?",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonClass: 'btn btn-sm btn-success',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Simpan'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '<?php echo site_url('kuesioner/simpan_bobot_fuzzy')?>',
						dataType: 'json',
						data: {
							fuzzy: finalFuzzyValue
						},
						method: "POST",
						success: function (res) {
							Swal.fire(
									'Tersimpan',
									'Bobot Fuzzy Berhasil disimpan',
									'success'
							)
						},
						error: function (err) {
							Swal.fire(
									'Gagal',
									'Bobot Fuzzy gagal disimpan',
									'error'
							)
						}
					})
				}
			})
		}

		function fuzzyExtend(bobotFuzzy, keysI, keysJ) {
			console.log(keysI);
			let eachCriteriaFuzzyExtend = [];
			keysI.forEach(function (i) {
				let low = 0, medium = 0, up = 0;
				let fuzzyExtends = {};
				bobotFuzzy.forEach(function (bobot) {
					let bobotLow = 0;
					let bobotMed = 0;
					let bobotUp = 0;
					if (bobot.key.includes(i)) {
						if (bobot.skala_fuzzy[0].includes('/')) {
							let arrSkala = bobot.skala_fuzzy[0].split('/');
							bobotLow = 1 / parseFloat(arrSkala[1]);
						} else {
							bobotLow = parseFloat(bobot.skala_fuzzy[0]);
						}
						if (bobot.skala_fuzzy[1].includes('/')) {
							let arrSkala = bobot.skala_fuzzy[1].split('/');
							bobotMed = 1 / parseFloat(arrSkala[1]);
						} else {
							bobotMed = parseFloat(bobot.skala_fuzzy[1]);
						}
						if (bobot.skala_fuzzy[2].includes('/')) {
							let arrSkala = bobot.skala_fuzzy[2].split('/');
							bobotUp = 1 / parseFloat(arrSkala[1]);
						} else {
							bobotUp = parseFloat(bobot.skala_fuzzy[2]);
						}
						low += bobotLow;
						medium += bobotMed;
						up += bobotUp;
					}
				})
				fuzzyExtends.key = i;
				fuzzyExtends.fuzzy_extend = [low, medium, up]
				eachCriteriaFuzzyExtend.push(fuzzyExtends);
			})
			return eachCriteriaFuzzyExtend;
		}

		function sumFuzzyExtend(criteriaFuzzyExtend) {
			let levelFuzzy = ['low', 'medium', 'up'];
			let sumFuzzyExtend = [];
			levelFuzzy.forEach(function (level, index) {
				let sumVal = 0;
				criteriaFuzzyExtend.forEach(function (fuzzyExtend) {
					sumVal += fuzzyExtend.fuzzy_extend[index];
				})
				sumFuzzyExtend.push(sumVal);
			})
			return sumFuzzyExtend;
		}

		function transposeSummedFuzzyExtend(summedFuzzy) {
			let [low, medium, up] = summedFuzzy;
			return [1 / up, 1 / medium, 1 / low];
		}

		function syntectingFuzzy(extendedFuzzy, transposedFuzzy) {
			// console.log(extendedFuzzy);
			// console.log(transposedFuzzy);
			let synteticedFuzzy = [];
			extendedFuzzy.forEach(function (extended) {
				let synteticedObject = {};
				let [low, med, up] = transposedFuzzy;
				synteticedObject.syntetics = [low * extended.fuzzy_extend[0], med * extended.fuzzy_extend[1], up * extended.fuzzy_extend[2]];
				synteticedObject.key = extended.key;
				synteticedFuzzy.push(synteticedObject);
			})
			// console.log(synteticedFuzzy);
			return synteticedFuzzy;
		}

		function countComparisonPosibiliyBetweenFuzzy(synteticedFuzzy) {
			// console.log(synteticedFuzzy);
			let dValues = [];
			synteticedFuzzy.forEach(function (synteticI) {
				// console.log(synteticI);
				let result = [];
				let dObject = {};
				synteticedFuzzy.forEach(function (synteticJ) {
					if (synteticI.key !== synteticJ.key) {
						let [lowI, mediumI, upI] = synteticI.syntetics;
						let [lowJ, mediumJ, upJ] = synteticJ.syntetics;
						if (lowI >= lowJ) {
							result.push(1)
						} else {
							let countVal = 0;
							countVal = (lowJ - upI) / ((mediumI - upI) - (mediumJ - lowJ));
							result.push(countVal);
						}
					}
				})
				// console.log(result);
				//inject id criteria on result
				dObject.key = synteticI.key;
				if (isAllEqual(result)) {
					//if all value on array is equal 1, then minimal value is 1
					dObject.d_value = 1;
					dValues.push(dObject);
				} else {
					dObject.d_value = Math.min.apply(null, result);
					dValues.push(dObject);
				}
			})
			// console.log(dValues);
			return dValues;
		}

		function getTotalDValue(dValue) {
			// console.log(dValue)
			let totalDValue = 0;
			dValue.forEach(function (d) {
				totalDValue += d.d_value;
			})
			return totalDValue;
		}

		function getFinalResultW(dValue, keysID) {
			let wValues = [];
			let totalD = getTotalDValue(dValue);
			dValue.forEach(function (d, index) {
				let wValue = {}
				wValue.key = d.key;
				wValue.id = keysID[index];
				wValue.w_value = d.d_value / totalD;
				wValues.push(wValue);
			})
			// console.log(wValues);
			return wValues;
		}

		const isAllEqual = function (arr) {
			return arr.every(function (v) {
				return v === arr[0];
			})
		}
		$(document).ready(function () {
			//looking bobot on localstorage (temporary)
			if (localStorage.getItem('bobot_ori')) {
				let bobot = JSON.parse(localStorage.getItem('bobot_ori'));
				// console.log(bobot);
				$('#tabel-matriks-fuzzy').find('td').each(function (index, item) {
					$(item).text(bobot[index].value)
				})
			} else {
				$.ajax({
					url: "<?php echo site_url('kuesioner/get_bobot_awal')?>",
					dataType: 'json',
					success: function (res) {
						if (typeof res.bobot_awal !== "undefined") {
							let bobot_awal = JSON.parse(res.bobot_awal);
							$('#tabel-matriks-fuzzy').find('td').each(function (index, item) {
								$(item).text(bobot_awal[index].value)
							})
						}
					}
				})
			}
		})
		$('#btn-acuan-fuzzy').on('click', function () {
			get_skala_fuzzy(show_modal);
		})
		$('#btn-konversi-fuzzy').on('click', function () {
			$.ajax({
				url: "<?php echo site_url('kuesioner/get_bobot_awal')?>",
				dataType: 'json',
				success: function (res) {
					if (typeof res.bobot_awal !== "undefined") {
						let bobot_awal = JSON.parse(res.bobot_awal);
						get_skala_fuzzy(konversi_fuzzy, bobot_awal);
					}
				}
			})
		})
		//chartjs

		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['C1', 'C2', 'C3', 'C4', 'C5',],
			datasets: [{
				data: [
					0, 0, 0, 0, 0
				]
			}]

		};

		window.onload = function () {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					scaleOverride: true,
					scaleSteps: 0.0002,
					scaleStepWidth: 1,
					scaleStartValue: 0,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Visualisasi Bobot Kriteria'
					},
				}
			});
		};
	</script>
<?php endif; ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
