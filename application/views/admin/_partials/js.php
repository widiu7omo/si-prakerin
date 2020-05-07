<script src="<?php echo base_url('aset/vendor/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/js-cookie/js.cookie.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/jquery.scrollbar/jquery.scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/chart.js/dist/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/chart.js/dist/Chart.extension.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/chart.js/dist/chartjs-plugin-datalabels.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/lavalamp/js/jquery.lavalamp.min.js') ?>"></script>
<!-- Optional JS -->
<script src="<?php echo base_url('aset/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net/js/dataTables.scroller.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net/js/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>

<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/dropzone/dist/min/dropzone.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/select2/select2.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/introjs/intro.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/momentjs/moment.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/sweetalert/sweetalert2.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/clockpicker/bootstrap-clockpicker.min.js') ?>"></script>

<!-- Argon JS -->
<script src="<?php echo base_url('aset/js/argonpro.js') ?>"></script>
<script>
	function deleteConfirm(url) {
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}

	function unique(value, index, self) {
		return self.indexOf(value) === index;
	}
</script>
