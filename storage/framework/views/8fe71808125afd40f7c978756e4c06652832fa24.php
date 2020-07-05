<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <button class="btn btn-rose  float-direction" data-toggle="modal" data-target="#modalDashboardSettings" role="tooltip" data-placement="top" title="Dashboard Settings"><i class="material-icons">settings</i></button>
    </div>

    <br><br>

    <?php if(Auth::user()->user_type == 1): ?>
         <?php echo $__env->make('dashboard.admin_dash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif(Auth::user()->user_type == 2): ?>
        <?php echo $__env->make('dashboard.manager_coor_dash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif(Auth::user()->user_type == 3): ?>
        <?php echo $__env->make('dashboard.casual_user_dash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('setting.dashboard.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function (){
            datetimepicker();
            function datetimepicker() {
                $('.datetimepicker').datetimepicker({
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    },
                    format: 'L'
                });
            }
            $('.selectpicker').selectpicker();
        });

        DataTableCall('#table_agenda');


        $(document).on('click', '.btnAgendaDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e(getMessage('2.105')['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true){
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('data-href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $('#agenda_status_').change(function(){

            var agenda_status = [];

            $('#agenda_status_ option:selected').each(function () {
                agenda_status.push($(this).attr('value'));
            });

            var _token = $('#_token').val();

            var request_params = {
                agenda_status : agenda_status,
                _token : _token,
            };

            $('#agenda_table_').html('<div align="center" id="loader-icon-a" class="col-md-12"> <div class="loader loader-div">  </div></div>');

            $.post('<?php echo e(route('agenda.index')); ?>',request_params,function(response){
                $('#agenda_table_').html(response);
                DataTableCall('#table_agenda');

            });

        });


        $(document).on('click', '.showSubActivity', function (e) {
            e.preventDefault();

            $row = $(this).closest('tr');

            $id = 'row' + $(this).attr('id');

            if ($("#" + $id).length >= 1) {

                $table = $("#" + $id + " .table").fadeOut('slow', function () {
                    $table.closest('tr').remove();
                });
            } else {
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    dataTypes: 'html',
                    type: 'get',
                    beforeSend: function () {
                    },
                    success: function (data) {

                        $rowdata = $row.after(rowData(data, $id))
                        $('#' + $id).fadeIn('slow');

                        $('[rel="tooltip"]').tooltip();
                    },
                    error: function () {
                    }
                });
            }

        });

        function rowData(data, $id) {
            $x = "<tr style='display: none;' id='" + $id + "' style='background-color: #fdfdfd'><td style=' background-color: #fff;'></td><td colspan='4'>"
                + data +
                "</td></tr>";
            return $x;
        }


        $('#formDashboardSettings').submit(function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                    $('#btn-dashboard-settings-save').attr('disabled',true);
                },
                success: function (data) {
                    $('#btn-dashboard-settings-save').attr('disabled',false);
                    $('.loader').hide();
                    if (data.success == true) {
                       location.reload();
                    } else if (data.success == false) {

                    }
                },
                error: function (data) {
                }
            });
        });


        $('#formDashboardProjectsFilter').submit(function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                    $('#btn-dashboard-projects-filter').attr('disabled',true);
                    $('#activities-list').html('<div align="center" id="loader-icon-a" class="col-md-12"> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#btn-dashboard-projects-filter').attr('disabled',false);
                    $('.loader').hide();
                    $('#activities-list').html(data);
                    $('#modalDashboardProjectsFilter').modal('hide');
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (data) {
                }
            });
        });


        $('#btn-show-activities-filter-modal').click(function(){
            $('#modalDashboardActivitiesFilter').modal('show');
        });


        $('#formDashboardActivitiesFilter').submit(function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                    $('#btn-dashboard-activities-filter').attr('disabled',true);
                    $('#activities-list').html('<div align="center" id="loader-icon-a" class="col-md-12"> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#btn-dashboard-activities-filter').attr('disabled',false);
                    $('.loader').hide();
                    $('#activities-list').html(data);
                    $('#modalDashboardActivitiesFilter').modal('hide');
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (data) {
                }
            });
        });


        $('#formDashboardLogsFilter').submit(function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function() {
                    $('.loader').show();
                    $('#loader-icon-a-logs').show();
                    $('#btn-dashboard-logs-filter').attr('disabled',true);
                    $('#table_logs').html('');
                },
                success: function(data) {
                    $('#btn-dashboard-logs-filter').attr('disabled',false);
                    $('.loader').hide();
                    $('#loader-icon-a-logs').hide();
                    $('#table_logs').show();
                    $('#table_logs').html(data);
                    DataTableCall('#table_logs_');

                },
                error: function (data) {
                }
            });
        });




    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/fullcalendar.min.js')); ?>"></script>

     <script>
         $(function(){

             initFullCalendar();

             function initFullCalendar() {

                 $calendar = $('#agendaCalendar');

                 today = new Date();
                 y = today.getFullYear();
                 m = today.getMonth();
                 d = today.getDate();

                 $calendar.fullCalendar({
                     viewRender: function(view, element) {
                         // We make sure that we activate the perfect scrollbar when the view isn't on Month
                         if (view.name != 'month') {
                             $(element).find('.fc-scroller').perfectScrollbar();
                         }
                     },
                     header: {
                         left: 'title',
                         center: 'month,agendaWeek,agendaDay',
                         right: 'prev,next,today'
                     },
                     defaultDate: today,
                     selectable: true,
                     selectHelper: true,
                     views: {
                         month: { // name of view
                             titleFormat: 'MMMM YYYY'
                             // other view-specific options here
                         },
                         week: {
                             titleFormat: " MMMM D YYYY"
                         },
                         day: {
                             titleFormat: 'D MMM, YYYY'
                         }
                     },

                     select: function(start, end) {

                         // on select we show the Sweet Alert modal with an input
                         swal({
                             title: 'Create an Agenda',
                             html: '<div class="form-group">' +
                                        '<input class="form-control" placeholder="Agenda Title" id="input-field">' +
                                   '</div>',
                             showCancelButton: true,
                             confirmButtonClass: 'btn btn-success',
                             cancelButtonClass: 'btn btn-danger',
                             buttonsStyling: false
                         }).then(function(result) {

                             var eventData;
                             event_title = $('#input-field').val();

                             if (event_title) {
                                 eventData = {
                                     title: event_title,
                                     start: start,
                                     end: end
                                 };
                                 $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                             }

                             $calendar.fullCalendar('unselect');

                         }).catch(swal.noop);
                     },
                     contentHeight: 450,
                     editable: false,
                     eventLimit: true, // allow "more" link when too many events

                     // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
                     events: [
                      <?php foreach($agenda as $a){ ?>
                         {
                             id: '<?php echo e($a->id); ?>',
                             title: '<?php echo e($a->agenda_name); ?>',
                             start: new Date('<?php echo e(date('Y',strtotime($a->start_date))); ?>', '<?php echo e(date('m',strtotime($a->start_date))); ?>', '<?php echo e(date('d',strtotime($a->start_date))); ?>', '<?php echo e(date('H',strtotime($a->start_date))); ?>', '<?php echo e(date('i',strtotime($a->start_date))); ?>'),
                             end: new Date('<?php echo e(date('Y',strtotime($a->end_date))); ?>', '<?php echo e(date('m',strtotime($a->end_date))); ?>', '<?php echo e(date('d',strtotime($a->end_date))); ?>', '<?php echo e(date('H',strtotime($a->end_date))); ?>', '<?php echo e(date('i',strtotime($a->end_date))); ?>'),
                             allDay: false,
                             className: 'event-<?php echo e(agendaStatus_($a->agenda_status_id)); ?>',
                             url: '<?php echo e(route('agenda.edit',$a->id)); ?>'
                         },
                      <?php } ?>
                     ]
                 });
             }


         });

     </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>