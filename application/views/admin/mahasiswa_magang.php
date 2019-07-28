<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<!-- Custom Helper -->
<?php $this->load->helper('master_helper');
	$prodies = masterdata('tb_program_studi');
	$currentTahun = masterdata('tb_waktu');
 ?>

<body>
	<!-- Sidenav PHP-->
	<?php $this->load->view('admin/_partials/sidenav.php');?>
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
			<!-- Export -->

			<div class="row">
				<div class="col" id="mainbody">
					<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<span class="alert-icon"><i class="ni ni-like-2"></i></span>
						<span class="alert-text"><strong>Success!
								&nbsp;</strong><?php echo $this->session->flashdata('success'); ?></span><br>
						<small class="alert-text">Data Mahasiswa sebanyak <?php echo $this->session->flashdata('status')->tb_mahasiswa ?></small><br>
						<small class="alert-text">Akun sebanyak <?php echo $this->session->flashdata('status')->tb_akun ?> telah terbuat</small>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php endif; ?>
					<?php if($this->session->flashdata('notif')):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
	                    <?php echo $this->session->flashdata('notif')->message;?>
                    </div>
					<?php endif;?>
					<div class="card mb-5">
						<div class="card-header">
							<h3>Import Data Mahasiswa Magang</h3>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="row">
									<div class="col-xl-12 col-lg-6 col-md-12">
										<div class="tab-content">
											<p>
												<a class="btn btn-primary" data-toggle="collapse"
													href="#collapseExample" role="button" aria-expanded="false"
													aria-controls="collapseExample">
													Import
												</a>
											</p>
											<div class="collapse" id="collapseExample">
												<div class="card card-body">
													<?php echo form_open_multipart('mahasiswa/import') ?>
													<div class="form-group">
														<label class="form-control-label" for="program-studi">Tentukan
															Program
															Studi</label>
														<select class="form-control" id="program-studi"
															name="programstudi">
															<option value="">Pilih Program Studi</option>
															<?php foreach ($prodies as $prodi): ?>
															<option value="<?php echo $prodi->id_program_studi ?>">
																<?php echo $prodi->nama_program_studi ?></option>
															<?php endforeach; ?>
														</select>
														<input type="hidden" name="tahunakademik" value="<?php echo $currentTahun[0]->id_tahun_akademik ?>">
													</div>
													<div class="dropzone dropzone-multiple dz-clickable"
														data-toggle="dropzone" data-dropzone-multiple=""
														data-dropzone-url="<?php echo site_url('ajax/initimport') ?>">

														<ul
															class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush ">
														</ul>
														<div class="dz-default dz-message">
															<span>Drop files here to upload</span>
															<div class="spinner-border text-danger" role="status">
																<span class="sr-only">Loading...</span>
															</div>
														</div>

													</div>

													<div class="form-group sheet-form-name" style="display:none">
														<div class="row">
															<div class="col-md-5 col-sm-5 col-lg-5">
																<label class="form-control-label" for="sheet-name">Pilih
																	Nama
																	sheet yang akan di import</label>
																<select class="form-control" id="sheet-name"
																	name="sheet-name">
																	<option value="">Pilih Sheet</option>
																</select>
															</div>
															<div class="col-md-7 col-sm-7 col-lg-7 mt-4">
																<small>* Pastikan nama kolom (header) berada pada baris
																	pertama (pada posisi A1)
																</small><br>
																<small>* Kami hanya akan mengimport kolom 'nama' dan
																	'nim' (pastikan nama kolom benar)</small>
															</div>
														</div>


													</div>

													<div class="text-md-right align-content-end mt-3 mb-2">
														<a id="btn_import" href="#" onclick="doImport();return false"
															class="btn btn-success">Simpan</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- Table -->
			<div class="row">
				<div class="col">
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<div class="row align-items-center">
								<div class="col-8">
									<h3 class="mb-0">Mahasiswa</h3>
									<p class="text-sm mb-0">
										Berikut daftar mahasiswa yang diperbolehkan magang
									</p>
								</div>
								<div class="col-4 text-right">
									<a href="<?php echo site_url('mahasiswa/create') ?>"
										class="btn btn-sm btn-primary">Add
										Mahasiswa</a>
								</div>
							</div>
						</div>
						<div class="table-responsive py-4">
							<table class="table table-flush" id="datatable-magang">
								<thead class="thead-light">
									<tr role="row">
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>ID</th>
										<th>Mahasiswa</th>
                                        <th>Program Studi</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>ID</th>
										<th>Mahasiswa</th>
                                        <th>Program Studi</th>
                                    </tr>
								</tfoot>
								<tbody>
									<?php foreach ($mahasiswas as $key => $mahasiswa): ?>
									<tr role="row" class="odd">
										<td>
											<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
												data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-ellipsis-v"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
												<a class="dropdown-item"
													href="<?php echo site_url('mahasiswa/edit/'.$mahasiswa->nim) ?>">Edit</a>
												<a class="dropdown-item" href="#"
													onclick="deleteConfirm('<?php echo site_url('mahasiswa/remove/'.$mahasiswa->nim) ?>')">Hapus</a>
											</div>
										</td>
										<td class="sorting_1"><?php echo $key +1?></td>
										<td><?php echo $mahasiswa->nim?></td>
                                        <td><?php echo $mahasiswa->nama_mahasiswa?></td>
                                        <td><?php echo $mahasiswa->nama_program_studi?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer PHP -->
			<?php $this->load->view('admin/_partials/footer.php');?>
		</div>

	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/modal.php');?>
	<?php $this->load->view('admin/_partials/loading.php'); ?>
	<?php $this->load->view('admin/_partials/js.php');?>
	<script src="<?php echo base_url('aset/vendor/js-xlsx/dist/xlsx.full.min.js') ?>"></script>
	<script>
		var DatatableButtons = (function() {

	// Variables

	var $dtButtons = $('#datatable-magang');


	// Methods

	function init($this) {

		// For more options check out the Datatables Docs:
		// https://datatables.net/extensions/buttons/

		var buttons = ["copy", "print","excel"];

		// Basic options. For more options check out the Datatables Docs:
		// https://datatables.net/manual/options

		var options = {

			lengthChange: !1,
			dom: 'Bfrtip',
			buttons: buttons,
			// select: {
			// 	style: "multi"
			// },
			language: {
				paginate: {
					previous: "<i class='fas fa-angle-left'>",
					next: "<i class='fas fa-angle-right'>"
				}
			},
			initComplete: function () {
				console.log(this.api().columns());
	            this.api().columns(4).every( function () {
	                var column = this;
	                var select = $('<select class="form-control form-control-sm"><option value="Pilih Prodi"></option></select>')
	                    .appendTo( $(column.header()).empty() )
	                    .on( 'change', function () {
	                        var val = $.fn.dataTable.util.escapeRegex(
	                            $(this).val()
	                        );
	 
	                        column
	                            .search( val ? '^'+val+'$' : '', true, false )
	                            .draw();
	                    } );
	 
	                column.data().unique().sort().each( function ( d, j ) {
	                    select.append( '<option value="'+d+'">'+d+'</option>' )
	                } );
	            } );
        	}
		};

		// Init the datatable

		var table = $this.on( 'init.dt', function () {
			$('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
	    }).DataTable(options);
	}


	// Events

	if ($dtButtons.length) {
		init($dtButtons);
	}

})();
		var Dropzones = (function () {

			//
			// Variables
			//

			var $dropzone = $('[data-toggle="dropzone"]');
			var $dropzonePreview = $('.dz-preview');

			//
			// Methods
			//

			function init($this) {
				var multiple = ($this.data('dropzone-multiple') !== undefined) ? true : false;
				var preview = $this.find($dropzonePreview);
				var currentFile = undefined;


				// Init options
				var options = {
					url: $this.data('dropzone-url'),
					maxFiles: (!multiple) ? 1 : 1,
					acceptedFiles: (!multiple) ? '.xls,.xlsx' : null,
					init: function () {
						this.on("addedfile", function (file) {
								if (!multiple && currentFile) {
									this.removeFile(currentFile);
								}
								currentFile = file;
							}),
							this.on("processing", function (file, progress) {
								console.log('processing')
								$('.dz-message').addClass('loading-overlay')
							}),
							this.on("success", function (file, response) {
								console.log(file)
								getWorkbook(file)
								console.log(JSON.parse(response))
								var sheetNames = JSON.parse(response);
								$('.dz-message').removeClass('loading-overlay')
								$('.sheet-form-name').css('display', 'block')

							})
					}
				}

				// Clear preview html
				preview.html('');

				// Init dropzone
				$this.dropzone(options)
			}

			function globalOptions() {
				Dropzone.autoDiscover = false;
			}

			//
			// Events
			//

			if ($dropzone.length) {

				// Set global options
				globalOptions();

				// Init dropzones
				$dropzone.each(function () {
					init($(this));
				});
			}

		})();

		///WORKBOOK SHEET.JS
		var workbook = null;
		var filteredData = null;

		function getWorkbook(file) {
			var rABS = false
			const fileReader = new FileReader()
			fileReader.onload = (e) => {
				// store to data from event target
				var data = e.target.result
				// if not readAsArrayBinnary String, then convert to Unit8Array
				if (!rABS) data = new Uint8Array(data)
				// get workbook data with xlsx read method
				workbook = XLSX.read(data, {
					type: rABS ? 'binary' : 'array'
				})
				// dispatch workbook to excel store
				console.log(workbook)
				console.log(workbook.SheetNames)
				var listSheet = workbook.SheetNames
				listSheet.forEach((sheet) => {
					$('#sheet-name').append('<option value="' + sheet + '">' +
						sheet + '</option>')
				})

				$('#sheet-name').on('change', (e) => {
					console.log(e.target.value)
					if (e.target.value !== '') {
						let dataFilter = retriveColumn(e.target.value)
						let filteredCase = [];

						filteredData = dataFilter.map(function(object){
							return {"nim":object.nim,"nama":toTitleCase(object.nama)}
						})
						console.log(filteredData);
					}
				})
			}
			if (rABS) {
				fileReader.readAsBinaryString(file)
			} else {
				fileReader.readAsArrayBuffer(file);
			}
		}

		function retriveColumn(sheetName) {
			console.log(sheetName)
			var selectedColumn = []
			var patternHeaders = ['nim', 'nama']
			var listHeaders = [];
			var newObj = {}
			var converToJson = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {
				header: 1
			})
			if (converToJson.length !== 0) {
				// get header file
				listHeaders = converToJson[0]
				// push data to temp sheet
				// this how we slice the excel, make sure that your data on second row. (assume, you have header and sub header(2 row),and you start slice from third row [index == 2])
				var tempSheet = converToJson.slice(2, converToJson.length)
				console.log(tempSheet)
				console.log(listHeaders)
				var indexFound = []
				listHeaders.map((header, index) => {
					patternHeaders.forEach((pattern) => {
						if ((typeof header !== 'number' ? header.toLowerCase() : null) === pattern
							.toLowerCase()) {
							indexFound.push({
								name: header.toLowerCase(),
								value: index
							})
						}
					})
				})
				console.log(indexFound)
				tempSheet.map((item) => {
					indexFound.forEach((index) => {
						newObj[index.name] = item[index.value]
					})
					Object.values(newObj)[0] !== undefined ? selectedColumn.push(newObj) : null
					newObj = {}
				})
				console.log(selectedColumn)
				return selectedColumn;
			} else return null;
		}

		 function toTitleCase(str) {
	        return str.replace(
	            /\w\S*/g,
	            function(txt) {
	                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	            }
	        );
	    }

		function doImport() {

			console.log(workbook)
			console.log(filteredData)

			console.log('show modal')
			$('#loadingModal').modal({backdrop: 'static', keyboard: false})
			$('#loadingModal').modal('show')
			$('#btn_import').prop('disabled', true)
			$.ajax({
				url: '<?php echo site_url('mahasiswa/import') ?>',
				method: 'POST',
				datatype: 'JSON',
				data: {
					id_program_studi:$("[name=programstudi]").val(),
					id_tahun_akademik:$("input[name=tahunakademik]").val(),
					mahasiswas: JSON.stringify(filteredData)
				},
				success: (data) => {
					$('#btn_import').prop('disabled', false)
					$('#loadingModal').modal('hide')
					console.log(data)
					location.reload()
				},
				error: (err) => {
					$('#btn_import').prop('disabled', false)
					var filterStyleTag = err.responseText.replace(/(<(script|style)\b[^>]*>).*?(<\/\2>)/is,'')
					var filterAllHtmlTag = filterStyleTag.replace(/(<([^>]+)>)|[ \t]+|\s+|^\s|$/gi,' ')
					alert(filterAllHtmlTag)
					// console.log(err)
				}
			})
		}

	</script>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
