<footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>
            Sistem Informasi Monitoring Politeknik Negeri Tanah Laut (SIMPRAKERIN) - 2019
            (Waktu Eksekusi : <strong>{elapsed_time}</strong> Detik, Penggunaan Data : <strong>{memory_usage}</strong>) 
          </small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#atas">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="ModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" align="text-center">Yakin Ingin Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer" align="center">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
            <a class="btn btn-primary" href="<?php echo site_url()?>login/logout">Ya</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalNotif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" align="text-center">Pemberitahuan</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer" align="center">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
            <a class="btn btn-primary" href="<?php echo site_url()?>login/logout">Ya</a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url()?>assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo base_url()?>assets/js/sb-admin-datatables.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/sb-admin-charts.min.js"></script>

    <script src="<?php echo base_url()?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datepicker/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          // menambahkan inputan text di bagian footer
          $('#example tfoot th').each( function () {
              var title = $(this).text();
              $(this).html( '<input type="text" class="form-control" placeholder="Cari '+title+'" />' );
          } );
       
          // membuat datatabel
          var table = $('#example').DataTable(
            {
              "language": {
                "sProcessing":   "Sedang memproses...",
                "sLengthMenu":   "Tampilkan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari:",
                "oPaginate": {
                  "sFirst":    "Pertama",
                  "sPrevious": "Sebelumnya",
                  "sNext":     "Selanjutnya",
                  "sLast":     "Terakhir"
                }
              }
          });
       
          // menerapkan pencarian pada tabel
          table.columns().every( function () {
              var that = this;
       
              $( 'input', this.footer() ).on( 'keyup change', function () {
                  if ( that.search() !== this.value ) {
                      that
                          .search( this.value )
                          .draw();
                  }
              } );
          } );
      } );
    </script>

    <script type="text/javascript">
      $(function(){
          $("#datepicker").datepicker({
            autoclose: true, 
            todayHighlight: true,
            locale:'id',
            format:'dd/mm/yyyy',
          });
      });
    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
  </div>
</body>

</html>