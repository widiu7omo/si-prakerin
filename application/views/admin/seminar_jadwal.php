<?php $section = isset($_GET['section']) ? $_GET['section'] : null ?>
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
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12">
					<div class="card card-calendar">
						<div class="card-header">
							<ul class="nav nav-pills">
								<li class="nav-item">
									<a href="<?php echo site_url('seminar?m=kelola&section=tempat') ?>"
									   class="nav-link <?php echo $section == 'tempat' ? 'active' : null ?>">Tempat</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('seminar?m=kelola&section=waktu') ?>"
									   class="nav-link <?php echo $section == 'waktu' ? 'active' : null ?>">Waktu</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('seminar?m=kelola&section=penguji') ?>"
									   class="nav-link <?php echo $section == 'penguji' ? 'active' : null ?>">Penguji</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('seminar?m=kelola&section=jadwal') ?>"
									   class="nav-link <?php echo $section == 'jadwal' ? 'active' : null ?>">Buat Jadwal
										Sidang</a>
								</li>
							</ul>
							<!-- Title -->
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h5 class="h3 mb-0">Kalender Konsutasi</h5>
									<small>* Jika anda ingin melakukan bimbingan online</small><br>
								</div>
								<div class="col-md-4 col-sm-4 text-right">
									<a href="#" class="fullcalendar-btn-prev btn btn-sm btn-primary">
										<i class="fas fa-angle-left"></i>&nbsp;Previous
									</a>
									<a href="#" class="fullcalendar-btn-next btn btn-sm btn-primary">
										Next&nbsp;<i class="fas fa-angle-right"></i>
									</a><br>
									<h6 class="h5 d-inline-block mb-0 mr-2" id="fullcalendar-title"></h6>
								</div>
							</div>
						</div>
						<div class="card-body p-0">
							<div id="calendar" class="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/modal_add_event.php') ?>
		<?php $this->load->view('admin/_partials/modal_edit_event.php') ?>
		<?php $this->load->view('admin/_partials/footer.php'); ?>
	</div>
	<!-- Scripts PHP-->
	<?php $this->load->view('admin/_partials/modal.php'); ?>
	<?php $this->load->view('admin/_partials/js.php'); ?>
	<!--	<script src="--><?php //echo base_url('aset/vendor/fullcalendar/fullcalendar.min.js') ?><!--"></script>-->
	<!--	<script src="--><?php //echo base_url('aset/vendor/fullcalendar/locale-all.js') ?><!--"></script>-->
	<script src="<?php echo base_url('aset/vendor/fullcalendar/4/core/main.min.js') ?>"></script>
	<script src="<?php echo base_url('aset/vendor/fullcalendar/4/daygrid/main.min.js')?>"></script>
	<script src="<?php echo base_url('aset/vendor/fullcalendar/4/timegrid/main.min.js')?>"></script>
	<script src="<?php echo base_url('aset/vendor/fullcalendar/4/interaction/main.min.js')?>"></script>
	<script>
        $('.clockpicker').clockpicker();
        $('#tanggal-seminar').datepicker({
            startDate: "-60y",
            format: "yyyy-mm-dd"
        });
        $('#select-penguji1').select2({
            placeholder: "Penguji 1",
            ajax: {
                url: '<?php echo site_url("seminar?m=penguji") ?>',
                dataType: 'json',
                data: {status: "p1"},
                processResults: function (res) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: $.map(res.data, function (item) {
                            return {
                                text: item.nama_pegawai,
                                id: item.id
                            }
                        })
                    };
                }
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        }).on('select2:select', function ({params}) {
            $('#id_p1').val(params.data.id)
        });
        $('#select-penguji2').select2({
            placeholder: "Penguji 2",
            ajax: {
                url: '<?php echo site_url("seminar?m=penguji") ?>',
                dataType: 'json',
                data: {status: "p2"},
                processResults: function (res) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: $.map(res.data, function (item) {
                            return {
                                text: item.nama_pegawai,
                                id: item.id,
                            }
                        })
                    };
                }
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        }).on('select2:select', function ({params}) {
            $('#id_p2').val(params.data.id)
        })
        $('#select-mahasiswa').select2({
            placeholder: 'Mahasiswa seminar',
            ajax: {
                url: '<?php echo site_url("seminar?m=mahasiswa") ?>',
                dataType: 'json',
                processResults: function (res) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: $.map(res.data, function (item) {
                            return {
                                text: item.nama_mahasiswa,
                                id: item.id_dosen_bimbingan_mhs,
                                laporan: item.judul_laporan_mhs
                            }
                        })
                    };
                }
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        }).on('select2:select', function ({params}) {
            $('#id_dosen_bimbingan_mhs').val(params.data.id)
            $('#input-judul').val(params.data.laporan)
        });
        $('#select-ruangan').select2({
            placeholder: 'Ruang seminar',
            ajax: {
                url: '<?php echo site_url("seminar?m=tempat") ?>',
                dataType: 'json',
                processResults: function (res) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: $.map(res.data, function (item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        }).on('select2:select', function ({params}) {
            $('#id_ruangan').val(params.data.id)
        })
        //var Fullcalendar = (function () {
        //
        //            // Variables
        //
        //            let $calendar = $('[data-toggle="calendar-konsultasi"]');
        //
        //            //
        //            // Methods
        //            //
        //
        //            // Init
        //            function init($this) {
        //
        //                // Calendar events
        //
        //                // Full calendar options
        //                // For more options read the official docs: https://fullcalendar.io/docs
        //
        //                options = {
        //                    plugins: [ 'timeGrid' ],
        //                    locale: 'id',
        //                    defaultView: 'timeGridWeek',
        //                    header: {
        //                        left: 'prev,next today',
        //                        center: 'title',
        //                        right: 'timeGridWeek,timeGridDay'
        //                    },
        //                    buttonIcons: {
        //                        prev: 'calendar--prev',
        //                        next: 'calendar--next'
        //                    },
        //                    theme: false,
        //                    selectable: true,
        //                    selectHelper: true,
        //                    editable: true,
        //                    events: {
        //                        url: "<?php echo site_url('seminar?m=jadwal') ?>",
        //                        cache: true,
        //                        type: "POST",
        //                        data: {events: true},
        //                        error: function () {
        //                            alert('Gagal akses jadwal seminar');
        //                        }
        //                    },
        //                    dayClick: function (date, jsEvent, view) {
        //                        // if (moment().format('YYYY-MM-DD') === date.format('YYYY-MM-DD') || date.isAfter(moment())) {
        //                        // This allows today and future date
        //                        let isoDate = moment(date).toISOString();
        //                        $('#tanggal-seminar').val(isoDate);
        //                        $('#new-event').modal('show');
        //                        //ajax to update current data
        //                        //$.ajax({
        //                        //    url: "<?php //echo site_url('bimbingan?m=konsultasi&q=is_exist') ?>//",
        //                        //    method: "POST",
        //                        //    success: function (data) {
        //                        //        let parsedData = JSON.parse(data);
        //                        //        if (parsedData.length !== 0) {
        //                        //            $('#new-event').modal('show');
        //                        //        } else {
        //                        //            alert('Anda belum mendapatkan pembimbing')
        //                        //        }
        //                        //    },
        //                        //    error: function () {
        //						//
        //                        //    }
        //                        //});
        //                        // } else {
        //                        //     Else part is for past dates
        //                        // alert('Tidak bisa mengajukan konsultasi pada tanggal ini');
        //                        // }
        //
        //                    },
        //
        //                    viewRender: function (view) {
        //                        var calendarDate = $this.fullCalendar('getDate');
        //                        var calendarMonth = calendarDate.month();
        //
        //                        //Set data attribute for header. This is used to switch header images using css
        //                        // $this.find('.fc-toolbar').attr('data-calendar-month', calendarMonth);
        //
        //                        //Set title in page header
        //                        $('#fullcalendar-title').text(view.title);
        //                    },
        //
        //                    // Edit calendar event action
        //
        //                    eventClick: function (event, element) {
        //                        $('#edit-event input[value=' + event.tag + ']').prop('checked', true);
        //                        $('#edit-event').modal('show');
        //                        $('.edit-event--id').val(event.id);
        //                        $('.edit-event--title').val(event.title);
        //                        $('.edit-event--masalah').val(event.masalah);
        //                        $('.edit-event--solusi').val(event.solusi);
        //                    }
        //                };
        //
        //                // Initalize the calendar plugin
        //                $this.fullCalendar(options);
        //
        //
        //                //
        //                // Calendar actions
        //                //
        //
        //
        //                //Add new Event
        //
        //                $('body').on('click', '.new-event--add', function () {
        //                    let eventDate = $('#tanggal-seminar').val();
        //                    let eventStart = $('#waktu-mulai').val();
        //                    let eventEnd = $('#waktu-selesai').val();
        //                    let eventId = $('#id_dosen_bimbingan_mhs').val();
        //                    let eventRuangan = $('#id_ruangan').val();
        //                    let eventPenguji1 = $('#id_p1').val();
        //                    let eventPenguji2 = $('#id_p2').val();
        //                    let mahasiswa = $('#select-mahasiswa').val();
        //
        //                    // Generate ID
        //                    let GenRandom = {
        //                        Stored: [],
        //                        /**
        //                         * @return {string}
        //                         */
        //                        Job: function () {
        //                            let newId = Date.now().toString().substr(6); // or use any method that you want to achieve this string
        //
        //                            if (!this.Check(newId)) {
        //                                this.Stored.push(newId);
        //                                return newId;
        //                            }
        //                            return this.Job();
        //                        },
        //                        /**
        //                         * @return {boolean}
        //                         */
        //                        Check: function (id) {
        //                            for (let i = 0; i < this.Stored.length; i++) {
        //                                if (this.Stored[i] === id) return true;
        //                            }
        //                            return false;
        //                        }
        //                    };
        //
        //                    if (eventDate !== '' && eventEnd !== '' && eventStart !== '') {
        //                        let createdEvent = {
        //                            id: GenRandom.Job(),
        //                            id_dosen_bimbingan_mhs: eventId,
        //                            id_seminar_ruangan: eventRuangan,
        //							mulai:eventDate+"T"+eventStart,
        //							berakhir:eventDate+"T"+eventEnd,
        //							id_penguji: [eventPenguji1,eventPenguji2]
        //                        };
        //                        //render event to calendar
        //                        $this.fullCalendar('renderEvent', createdEvent, true);
        //                        //push to database
        //                        $.ajax({
        //                            url: "<?php echo site_url('seminar?m=jadwal&q=i')?>",
        //                            method: "POST",
        //                            data: createdEvent,
        //                            success: function () {
        //                                swal({
        //                                    title: 'Success',
        //                                    text: 'Jadwal '+mahasiswa+' berhasil dibuat',
        //                                    type: 'success',
        //                                    buttonsStyling: false,
        //                                    confirmButtonClass: 'btn btn-primary btn-sm'
        //                                });
        //                            },
        //                            error: function () {
        //                                swal({
        //                                    title: 'Error',
        //                                    text: 'Jadwal '+mahasiswa+' gagal dibuat',
        //                                    type: 'error',
        //                                    buttonsStyling: false,
        //                                    confirmButtonClass: 'btn btn-primary btn-sm'
        //                                });
        //                            }
        //                        });
        //                        $('.new-event--form')[0].reset();
        //                        $('.new-event--title').closest('.form-group').removeClass('has-danger');
        //                        $('#new-event').modal('hide');
        //                    } else if (eventTitle !== '' && eventProblem === '') {
        //                        $('#add-masalah').closest('.form-group').addClass('has-danger').focus();
        //                    } else {
        //                        $('.new-event--title').closest('.form-group').addClass('has-danger').focus();
        //                    }
        //                });
        //
        //
        //                //Update/Delete an Event
        //                $('body').on('click', '[data-calendar]', function () {
        //                    let calendarAction = $(this).data('calendar');
        //                    let currentId = $('.edit-event--id').val();
        //                    let currentTitle = $('.edit-event--title').val();
        //                    let currentMasalah = $('.edit-event--masalah').val();
        //                    let currentSolusi = $('.edit-event--solusi').val();
        //                    let currentClass = $('#edit-event .event-tag input:checked').val();
        //                    let currentEvent = $this.fullCalendar('clientEvents', currentId);
        //                    //Update
        //                    if (calendarAction === 'update') {
        //                        if (currentTitle !== '') {
        //                            // let data = {"title":currentTitle,"masalah":currentMasalah,"solusi":currentSolusi,"tag":[currentClass]};
        //                            // currentEvent.push(data);
        //                            currentEvent[0].title = currentTitle;
        //                            currentEvent[0].masalah = currentMasalah;
        //                            currentEvent[0].solusi = currentSolusi;
        //                            currentEvent[0].className = [currentClass];
        //                            //update rendered item
        //                            $this.fullCalendar('updateEvent', currentEvent[0]);
        //                            //push to database
        //                            $.ajax({
        //                                url: "<?php echo site_url('bimbingan?m=konsultasi&q=u')?>",
        //                                method: "POST",
        //                                data: {
        //                                    id: currentId,
        //                                    title: currentTitle,
        //                                    id_dosen_bimbingan: $('[name="id_dosen_bimbingan"]').val(),
        //                                    masalah: currentMasalah,
        //                                    solusi: currentSolusi,
        //                                    allDay: true,
        //                                    tag: currentClass,
        //                                },
        //                                success: function (res) {
        //                                    console.log(res);
        //                                    swal({
        //                                        title: 'Success',
        //                                        text: 'Konsultasi berhasil diubah',
        //                                        type: 'success',
        //                                        buttonsStyling: false,
        //                                        confirmButtonClass: 'btn btn-primary btn-sm'
        //                                    });
        //                                },
        //                                error: function (err) {
        //                                    console.log(err);
        //                                    swal({
        //                                        title: 'Gagal',
        //                                        text: 'Konsultasi gagal diubah',
        //                                        type: 'error',
        //                                        buttonsStyling: false,
        //                                        confirmButtonClass: 'btn btn-danger btn-sm'
        //                                    });
        //                                }
        //                            });
        //                            $('#edit-event').modal('hide');
        //                        } else {
        //                            $('.edit-event--title').closest('.form-group').addClass('has-error').focus();
        //                        }
        //                    }
        //
        //                    //Delete
        //                    if (calendarAction === 'delete') {
        //                        $('#edit-event').modal('hide');
        //
        //                        // Show confirm dialog
        //                        setTimeout(function () {
        //                            swal({
        //                                title: 'Apakah anda yakin menghapus ini?',
        //                                text: "Konsultasi yang sudah hapus tidak bisa dikembalikan lagi",
        //                                type: 'warning',
        //                                showCancelButton: true,
        //                                buttonsStyling: false,
        //                                confirmButtonClass: 'btn btn-danger btn-sm',
        //                                confirmButtonText: 'Yes, hapus!',
        //                                cancelButtonClass: 'btn btn-secondary btn-sm'
        //                            }).then((result) => {
        //                                if (result.value) {
        //                                    // Delete event
        //                                    $this.fullCalendar('removeEvents', currentId);
        //                                    console.log(currentId);
        //
        //                                    // Delete from database
        //                                    $.ajax({
        //                                        url: "<?php echo site_url('bimbingan?m=konsultasi&q=d')?>",
        //                                        method: "POST",
        //                                        data: {id: currentId},
        //                                        success: function (res) {
        //                                            console.log(res);
        //                                            swal({
        //                                                title: 'Success',
        //                                                text: 'Konsultasi berhasil dihapus',
        //                                                type: 'success',
        //                                                buttonsStyling: false,
        //                                                confirmButtonClass: 'btn btn-primary btn-sm'
        //                                            });
        //                                        },
        //                                        error: function () {
        //                                            swal({
        //                                                title: 'Error',
        //                                                text: 'Konsultasi Gagal dihapus',
        //                                                type: 'error',
        //                                                buttonsStyling: false,
        //                                                confirmButtonClass: 'btn btn-primary btn-sm'
        //                                            });
        //                                        }
        //                                    })
        //                                }
        //                            })
        //                        }, 200);
        //                    }
        //                });
        //
        //
        //                //Calendar views switch
        //                $('body').on('click', '[data-calendar-view]', function (e) {
        //                    e.preventDefault();
        //
        //                    $('[data-calendar-view]').removeClass('active');
        //                    $(this).addClass('active');
        //
        //                    var calendarView = $(this).attr('data-calendar-view');
        //                    $this.fullCalendar('changeView', calendarView);
        //                });
        //
        //
        //                //Calendar Next
        //                $('body').on('click', '.fullcalendar-btn-next', function (e) {
        //                    e.preventDefault();
        //                    $this.fullCalendar('next');
        //                });
        //
        //
        //                //Calendar Prev
        //                $('body').on('click', '.fullcalendar-btn-prev', function (e) {
        //                    e.preventDefault();
        //                    $this.fullCalendar('prev');
        //                });
        //            }
        //
        //
        //            //
        //            // Events
        //            //
        //
        //            // Init
        //            if ($calendar.length) {
        //                init($calendar);
        //            }
        //
        //        })();
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['timeGrid', 'dayGrid','interaction'],
                defaultView: 'dayGridMonth',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                selectable: true,
                selectHelper: true,
                editable: true,
                events: {
                    url: "<?php echo site_url('seminar?m=jadwal') ?>",
                    cache: true,
                    type: "POST",
                    data: {events: true},
                    error: function () {
                        alert('Gagal akses jadwal seminar');
                    }
                },
                select: function (info) {
                    console.log(info);
                },
                dateClick: function (info, jsEvent, view) {
                    // if (moment().format('YYYY-MM-DD') === date.format('YYYY-MM-DD') || date.isAfter(moment())) {
                    // This allows today and future date
                    let isoDate = info.date.toISOString();
                    $('#tanggal-seminar').val(isoDate);
                    $('#new-event').modal('show');
                    //ajax to update current data
                    //$.ajax({
                    //    url: "<?php echo site_url('bimbingan?m=konsultasi&q=is_exist') ?>",
                    //    method: "POST",
                    //    success: function (data) {
                    //        let parsedData = JSON.parse(data);
                    //        if (parsedData.length !== 0) {
                    //            $('#new-event').modal('show');
                    //        } else {
                    //            alert('Anda belum mendapatkan pembimbing')
                    //        }
                    //    },
                    //    error: function () {
                    //
                    //    }
                    //});
                    // } else {
                    //     Else part is for past dates
                    // alert('Tidak bisa mengajukan konsultasi pada tanggal ini');
                    // }

                },
            });
            calendar.render();
        })
	</script>
</body>
z
</html>
