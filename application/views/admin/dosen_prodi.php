<!DOCTYPE html>
<html>
<!-- Head PHP -->
<?php $this->load->view('admin/_partials/header.php'); ?>
<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php'); ?>
<?php $prodies = masterdata('tb_program_studi', null, '*') ?>
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
		<!-- Table -->
		<div class="row">
			<div class="col">
				<div class="card">
					<!-- Card header -->
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Kelola Dosen Prodi</h3>
								<p class="text-sm mb-0">
									Berikut daftar dosen pada masing-masing prodi
								</p>
								<button class="bg-warning btn btn-sm"></button>
								<span class="text-sm text-warning"><i>Belum diatur</i></span>
							</div>

						</div>
					</div>
					<div class="table-responsive py-4">
						<table class="table table-flush" id="datatable-mhs-fix">
							<thead class="thead-light">
							<tr role="row">
								<th>No</th>
								<th>Nama Dosen</th>
								<th>Program Studi</th>
							</tr>
							</thead>
							<tfoot>
							<tr>
								<th>No</th>
								<th>Nama Dosen</th>
								<th>Program Studi</th>
							</tr>
							</tfoot>
							<tbody>
							<?php foreach ($dosens as $key => $dosen): ?>
								<tr role="row" class="odd">
									<td class="sorting_1"><?php echo $key + 1 ?></td>
									<td><?php echo $dosen->nama_pegawai ?></td>
									<td>
										<select id="changeProdi" data-nip="<?php echo $dosen->nip_nik ?>"
												class="form-control <?php echo !$dosen->nama_program_studi ? 'bg-warning text-white' : null ?>"">
										<option value="">---Belum dipilih---</option>
										<?php foreach ($prodies as $prody): ?>
											<option <?php echo $dosen->nama_program_studi == $prody->nama_program_studi ? "selected" : null ?>
												value="<?php echo $prody->id_program_studi ?>"><?php echo $prody->nama_program_studi ?></option>
										<?php endforeach; ?>
										</select>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>

</div>
<?php $this->load->view('admin/_partials/status.php'); ?>

<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php'); ?>
<script>
    $(document).on('change', '#changeProdi', function () {
        let self = $(this);
        $.ajax({
			url:'<?php echo site_url('dosen?m=dosen_prodi&q=u')?>',
			method:'POST',
			data:{nip:$(this).data('nip'),prodi:$(this).val()},
			success:function(res){
			    if(JSON.parse(res).status === 'success'){
                    self.removeClass(["bg-warning","text-white"]);
                    $('#modalLabel').text("Berhasil mengganti program studi");
                    $('#statusModal').modal('show');
				}
			},
			error:function(e){
			    console.log(e)
			}
		})
    });
    var DatatableButtons = (function () {

        // Variables

        var $dtButtons = $('#datatable-mhs-fix');


        // Methods

        function init($this) {

            // For more options check out the Datatables Docs:
            // https://datatables.net/extensions/buttons/
            // Basic options. For more options check out the Datatables Docs:
            // https://datatables.net/manual/options

            var options = {

                lengthChange: !1,
                dom: 'Bfrtip',
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                }
            };

            // Init the datatable

            var table = $this.on('init.dt', function () {
                $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
            }).DataTable(options);
        }


        // Events

        if ($dtButtons.length) {
            init($dtButtons);
        }

    })();
</script>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../aset/js/demo.min.js"></script> -->
</body>

</html>
