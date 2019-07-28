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
            <a class="btn btn-primary" href="<?php echo site_url()?>monev/login/logout">Ya</a>
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

    <!-- Select Plugin Js -->
    <!-- <script src="<?php //echo base_url()?>assets/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="<?php echo base_url()?>assets/dist/js/bootstrap-select.js"></script>

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
      $(document).ready(function() {
          $('#txtDate1').datepicker();
          $('#txtDate1').datepicker('setDate', '<?php echo $tgl_berangkat;?>');
      });

      $(document).ready(function() {
          $('#txtDate2').datepicker();
          $('#txtDate2').datepicker('setDate', '<?php echo $tgl_berangkat;?>');
      });
    </script>

    <script type="text/javascript">
      $(function(){
          $("#datepicker2").datepicker({
            autoclose: true, 
            todayHighlight: true,
          });
      });
    </script>

    <script type="text/javascript">
      $(function(){
          $("#datepicker3").datepicker({
            autoclose: true, 
            todayHighlight: true,
          });
      });
    </script>

    <script type="text/javascript">
      $(function(){
          $("#datepicker4").datepicker({
            autoclose: true, 
            todayHighlight: true,
            locale:'id',
            format:'dd/mm/yyyy',
          });
      });
    </script>

    <script type="text/javascript">
      $(function(){
          $("#datepicker5").datepicker({
            autoclose: true, 
            todayHighlight: true,
            locale:'id',
            format:'dd/mm/yyyy',
          });
      });
    </script>

    <script type="text/javascript">
      $(function(){
          $('#select').selectpicker();
      });
    </script>

    <script>
      function goBack() {
        window.history.back();
      }
    </script>

    <script>
      function createOptions(number) {
        var options = [], _options;

        for (var i = 0; i < number; i++) {
          var option = '<option value="' + i + '">Option ' + i + '</option>';
          options.push(option);
        }

        _options = options.join('');
        
        $('#number')[0].innerHTML = _options;
        $('#number-multiple')[0].innerHTML = _options;


        $('#number2')[0].innerHTML = _options;
        $('#number2-multiple')[0].innerHTML = _options;
      }

      var mySelect = $('#first-disabled2');

      createOptions(4000);

      $('#special').on('click', function () {
        mySelect.find('option:selected').prop('disabled', true);
        mySelect.selectpicker('refresh');
      });

      $('#special2').on('click', function () {
        mySelect.find('option:disabled').prop('disabled', false);
        mySelect.selectpicker('refresh');
      });

      $('#basic2').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });
    </script>
    <!-- <script>
        function tambah_form(){
            var target=document.getElementById("formku");
            var div1=document.createElement("div");
            var div2=document.createElement("div");
            var select=document.createElement("select");
            var option=document.createElement("option");

            target.appendChild(div1);
            div1.appendChild(div2);
            div2.appendChild(select);

            var array = [
            <?php 
            // $sql2 = $this->db->query("SELECT * FROM `tb_perusahaan_sementara"); 
            // foreach ($sql2->result() as $perusahaan):
            
            // echo '"'.$perusahaan->nama_perusahaan_sementara.'",'; 

            // endforeach; 
            ?>];

            div1.setAttribute('class','form-group');
            div2.setAttribute('class','form-line');

            for (var i = 0; i < array.length; i++) {
                var option = document.createElement("option");
                option.setAttribute("value", array[i]);
                option.text = array[i];
                select.appendChild(option);
            }

            select.setAttribute('name','inputan[]');
            select.setAttribute('required','');
            select.setAttribute('class','form-control');
        }
        function kurangi_form(){
            var target=document.getElementById("formku");
            if (target <= 0) {
              alert("data Kosong");
            } else {
              var akhir=target.lastChild;
              target.removeChild(akhir);
            }
        }
      </script> -->
      <script type="text/javascript">
        $(document).ready(function(){
          $('#getJawaban').on('click',()=>{
            console.log('tes')
            getJawaban();
          })

          function getJawaban(){
          var spreadsheetID = '1-v84g-YbKbbjpRGCAXvDO7YlXULLjEOfpPsSwFP6EH0';
          var url = 'http://gsx2json.com/api?id='+spreadsheetID;
          $.ajax({
              url:url,
              dataType:"json",
              success:function(data){
                console.log(data)
                var id_jenis_kuesioner = '1';
                var encodeData = JSON.stringify(data.rows)
                console.log(encodeData)
                pushDatabase(encodeData)
                  // data.feed.entry is an array of objects that represent each cell
              },
          });
          function pushDatabase($jawaban){
            $.ajax({
              url:"<?php echo site_url('koordinator/dosen/insert_kuesioner'); ?>",
              method :'POST',
              data :{
                jawaban : $jawaban,
              },
              success:function(data2){
                console.log(data2)
                var encodeData2 = JSON.stringify(data2)
                console.log(encodeData2)
              },
            })
          }

          } 
        })
      </script>
  </div>
</body>

</html>