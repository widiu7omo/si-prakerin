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
        $('#select-penguji1,#select-penguji1-edit').empty().select2({
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
            $('#id_p1,#id_p1_edit').val(params.data.id)
        });
        $('#select-penguji2,#select-penguji2-edit').empty().select2({
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
            $('#id_p2,#id_p2_edit').val(params.data.id)
        })
        $('#select-mahasiswa,#select-mahasiswa-edit').empty().select2({
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
            $('#id_dosen_bimbingan_mhs,#id_dosen_bimbingan_mhs_edit').val(params.data.id)
            $('#input-judul').val(params.data.laporan)
        });
        $('#select-ruangan, #select-ruangan-edit').empty().select2({
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
            $('#id_ruangan,#id_ruangan_edit').val(params.data.id)
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['timeGrid', 'dayGrid','interaction'],
                defaultView: 'dayGridMonth',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,dayGridMonth'
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
                    $('#tanggal-seminar').val(moment(isoDate).format('YYYY-MM-DD'));
                    //ajax to update current data
                    $.ajax({
						url: '<?php echo site_url("seminar?m=mahasiswa") ?>',
						dataType: 'json',
                        success: function ({data}) {
                            let parsedData = data;
                            if (parsedData.length !== 0) {
                                $('#new-event').modal('show');
                            } else {
								swal({
									title: 'Error',
									text: 'Semua mahasiswa sudah mendapatkan jadwal seminar',
									type: 'error',
									buttonsStyling: false,
									confirmButtonClass: 'btn btn-primary btn-sm'
								});
                            }
                        },
                        error: function (e) {
							console.log(e)
                        }
                    });
                     // } else {
                     //     Else part is for past dates
                     // alert('Tidak bisa mengajukan konsultasi pada tanggal ini');
                     // }

                },
                eventClick: function (info, element) {
                    let {event} = info;
                    let mulai = moment(event.start).format('HH:mm:ss');
                    let selesai = moment(event.end).format('HH:mm:ss');
                    let tanggal = moment(event.start).format('YYYY-MM-DD');
                    // $('#edit-event input[value=' + event.tag + ']').prop('checked', true);
                    $('#edit-event').modal('show');
                    $('.edit-event--id').val(event.id);
                    $('#select-mahasiswa-edit').empty().prepend('<option value='+event.id+'>'+event.title+'</option>');
                    $('#select-ruangan-edit').empty().prepend('<option value='+event.extendedProps.id_tempat+'>'+event.extendedProps.nama_tempat+'</option>');
					$('#select-penguji1-edit').empty().prepend('<option value='+event.extendedProps.id_penguji_1+'>'+event.extendedProps.p1+'</option>');
					$('#select-penguji2-edit').empty().prepend('<option value='+event.extendedProps.id_penguji_2+'>'+event.extendedProps.p2+'</option>');
					$('#id_dosen_bimbingan_mhs_edit').val(event.extendedProps.id_dosen_bimbingan_mhs);
					$('#id_ruangan_edit').val(event.extendedProps.id_tempat);
					$('#id_p1_edit').val(event.extendedProps.id_penguji_1);
					$('#id_p2_edit').val(event.extendedProps.id_penguji_2);
                    $('#tanggal-seminar-edit').val(tanggal);
                    $('#waktu-mulai-edit').val(mulai);
                    $('#waktu-selesai-edit').val(selesai);
                },
				eventDrop:function(info){
                	console.log(info);
					swal({
						title: 'Apakah anda yakin memindah '+info.event.title+' ?',
						text: "Pemindahan jadwal bisa di batalkan",
						type: 'warning',
						showCancelButton: true,
						buttonsStyling: false,
						confirmButtonClass: 'btn btn-warning btn-sm',
						confirmButtonText: 'Ya, pindah!',
						cancelButtonClass: 'btn btn-secondary btn-sm'
					}).then((result) => {
						if(result.value){
							let {event} = info;
							let eventDate = moment(event.start).format('YYYY-MM-DD');
							let eventStart = moment(event.start).format('HH:mm:ss');
							let eventEnd = moment(event.end).format('HH:mm:ss');
							let updateEvent = {
								id: event.id,
								id_dosen_bimbingan_mhs: event.extendedProps.id_dosen_bimbingan_mhs,
								id_seminar_ruangan: event.extendedProps.id_tempat,
								mulai: eventDate + "T" + eventStart,
								berakhir: eventDate + "T" + eventEnd,
								id_penguji: [event.extendedProps.id_penguji_1, event.extendedProps.id_penguji_2]
							};
							$.ajax({
								url: "<?php echo site_url('seminar?m=jadwal&q=u')?>",
								method: "POST",
								data: updateEvent,
								success: function () {
									swal({
										title: 'Success',
										text: 'Jadwal ' + event.title + ' berhasil dibuat',
										type: 'success',
										buttonsStyling: false,
										confirmButtonClass: 'btn btn-primary btn-sm'
									});
								},
								error: function () {
									swal({
										title: 'Error',
										text: 'Jadwal ' + event.title + ' gagal dibuat',
										type: 'error',
										buttonsStyling: false,
										confirmButtonClass: 'btn btn-primary btn-sm'
									});
								}
							});
						}
						else{
							info.revert();
						}

					})
				}
            });
            calendar.render();
            $('body').on('click', '.new-event--add', function () {
                let eventDate = $('#tanggal-seminar').val();
                let eventStart = $('#waktu-mulai').val();
                let eventEnd = $('#waktu-selesai').val();
                let eventId = $('#id_dosen_bimbingan_mhs').val();
                let eventRuangan = $('#id_ruangan').val();
                let eventPenguji1 = $('#id_p1').val();
                let eventPenguji2 = $('#id_p2').val();
                let mahasiswa = $('#select-mahasiswa').text();

                // Generate ID
                let GenRandom = {
                    Stored: [],
                    /**
                     * @return {string}
                     */
                    Job: function () {
                        let newId = Date.now().toString().substr(6); // or use any method that you want to achieve this string

                        if (!this.Check(newId)) {
                            this.Stored.push(newId);
                            return newId;
                        }
                        return this.Job();
                    },
                    /**
                     * @return {boolean}
                     */
                    Check: function (id) {
                        for (let i = 0; i < this.Stored.length; i++) {
                            if (this.Stored[i] === id) return true;
                        }
                        return false;
                    }
                };

                if (eventDate !== '' && eventEnd !== '' && eventStart !== '') {
                    let createdEvent = {
                        id: GenRandom.Job(),
                        id_dosen_bimbingan_mhs: eventId,
                        id_seminar_ruangan: eventRuangan,
                        mulai: eventDate + "T" + eventStart,
                        berakhir: eventDate + "T" + eventEnd,
                        id_penguji: [eventPenguji1, eventPenguji2]
                    };
                    //render event to calendar
                    calendar.addEvent({
						title:mahasiswa,
						start:createdEvent.mulai,
						end:createdEvent.berakhir,
						extendedProps:{
							id_tempat:id_seminar_ruangan,
							id_penguji_1:eventPenguji1,
							id_penguji_2:eventPenguji2
						}
					});
                    //push to database
                    $.ajax({
                        url: "<?php echo site_url('seminar?m=jadwal&q=i')?>",
                        method: "POST",
                        data: createdEvent,
                        success: function () {
                            swal({
                                title: 'Success',
                                text: 'Jadwal ' + mahasiswa + ' berhasil dibuat',
                                type: 'success',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-primary btn-sm'
                            });
                        },
                        error: function () {
                            swal({
                                title: 'Error',
                                text: 'Jadwal ' + mahasiswa + ' gagal dibuat',
                                type: 'error',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-primary btn-sm'
                            });
                        }
                    });
                    $('.new-event--form')[0].reset();
                    $('.new-event--title').closest('.form-group').removeClass('has-danger');
                    $('#new-event').modal('hide');
                } else if (eventDate !== '' || eventEnd !== '' || eventStart !== '') {
                	console.log('Lengkapi data');
					$('#tanggal-seminar').closest('.form-group').addClass('has-danger').focus();
					$('#waktu-mulai').closest('.form-group').addClass('has-danger').focus();
					$('#waktu-selesai').closest('.form-group').addClass('has-danger').focus();
					$('#select-ruangan').closest('.form-group').addClass('has-danger').focus();
					$('#select-mahasiswa').closest('.form-group').addClass('has-danger').focus();
					$('#select-penguji1').closest('.form-group').addClass('has-danger').focus();
					$('#select-penguji2').closest('.form-group').addClass('has-danger').focus();
                } else {
                    $('.new-event--title').closest('.form-group').addClass('has-danger').focus();
                }
            });


            //Update/Delete an Event
            $('body').on('click', '[data-calendar]', function () {
                let calendarAction = $(this).data('calendar');
                let currentId = $('.edit-event--id').val();
				let eventDate = $('#tanggal-seminar-edit').val();
				let eventStart = $('#waktu-mulai-edit').val();
				let eventEnd = $('#waktu-selesai-edit').val();
				let eventBimbingan = $('#id_dosen_bimbingan_mhs_edit').val();
				let eventRuangan = $('#id_ruangan_edit').val();
				let eventRuanganName = $('#select-ruangan-edit option:selected').text();
				let eventPenguji1 = $('#id_p1_edit').val();
				let eventPenguji2 = $('#id_p2_edit').val();
				let eventPenguji1Name = $('#select-penguji1-edit option:selected').text();
				let eventPenguji2Name = $('#select-penguji2-edit option:selected').text();
				let mahasiswa = $('#select-mahasiswa-edit').text();
				let currentEvent = calendar.getEventById(currentId);
                //Update
                if (calendarAction === 'update') {
                    if (currentId !== '') {
                        // let data = {"title":currentTitle,"masalah":currentMasalah,"solusi":currentSolusi,"tag":[currentClass]};
                        // currentEvent.push(data);
						let updateEvent = {
							id:currentId,
							id_dosen_bimbingan_mhs: eventBimbingan,
							id_seminar_ruangan: eventRuangan,
							mulai: eventDate + "T" + eventStart,
							berakhir: eventDate + "T" + eventEnd,
							id_penguji: [eventPenguji1, eventPenguji2]
						};
						//render event to calendar
						currentEvent.setProp('title',mahasiswa);
						currentEvent.setStart(updateEvent.mulai);
						currentEvent.setEnd(updateEvent.berakhir);
						currentEvent.setExtendedProp('id_tempat',updateEvent.id_seminar_ruangan);
						currentEvent.setExtendedProp('nama_tempat',eventRuanganName);
						currentEvent.setExtendedProp('id_penguji_1',updateEvent.id_penguji[0]);
						currentEvent.setExtendedProp('id_penguji_2',updateEvent.id_penguji[1]);
						currentEvent.setExtendedProp('p1',eventPenguji1Name);
						currentEvent.setExtendedProp('p2',eventPenguji2Name);
						console.log(currentEvent);
                        //update rendered item
                        //push to database
						$.ajax({
							url: "<?php echo site_url('seminar?m=jadwal&q=u')?>",
							method: "POST",
							data: updateEvent,
							success: function () {
								swal({
									title: 'Success',
									text: 'Jadwal ' + mahasiswa + ' berhasil diupdate',
									type: 'success',
									buttonsStyling: false,
									confirmButtonClass: 'btn btn-primary btn-sm'
								});
							},
							error: function () {
								swal({
									title: 'Error',
									text: 'Jadwal ' + mahasiswa + ' gagal diupdate',
									type: 'error',
									buttonsStyling: false,
									confirmButtonClass: 'btn btn-primary btn-sm'
								});
							}
						});
						$('.edit-event--form')[0].reset();
						$('.edit-event--title').closest('.form-group').removeClass('has-danger');
                        $('#edit-event').modal('hide');
                    } else {
                        $('.edit-event--title').closest('.form-group').addClass('has-error').focus();
                    }
                }

                ////Delete
                if (calendarAction === 'delete') {
                    $('#edit-event').modal('hide');

                    // Show confirm dialog
                    setTimeout(function () {
                        swal({
                            title: 'Apakah anda yakin menghapus ini?',
                            text: "Jadwal sidang yang sudah hapus tidak bisa dikembalikan lagi",
                            type: 'warning',
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-danger btn-sm',
                            confirmButtonText: 'Yes, hapus!',
                            cancelButtonClass: 'btn btn-secondary btn-sm'
                        }).then((result) => {
                            if (result.value) {
                                // Delete event
                                currentEvent.remove();
                                console.log(currentId);

                                // Delete from database
                                $.ajax({
                                    url: "<?php echo site_url('seminar?m=jadwal&q=d')?>",
                                    method: "POST",
                                    data: {id: currentId},
                                    success: function (res) {
                                        console.log(res);
                                        swal({
                                            title: 'Success',
                                            text: 'Jadwal berhasil dihapus',
                                            type: 'success',
                                            buttonsStyling: false,
                                            confirmButtonClass: 'btn btn-primary btn-sm'
                                        });
                                    },
                                    error: function () {
                                        swal({
                                            title: 'Error',
                                            text: 'Jadwal Gagal dihapus',
                                            type: 'error',
                                            buttonsStyling: false,
                                            confirmButtonClass: 'btn btn-primary btn-sm'
                                        });
                                    }
                                })
                            }
                        })
                    }, 200);
                }
            });
        })
	</script>
</body>
z
</html>
