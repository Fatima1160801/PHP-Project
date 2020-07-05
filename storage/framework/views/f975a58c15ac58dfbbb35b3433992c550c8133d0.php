<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['activities'] ?? 'activities'); ?>

            </h4>

        </div>
        <div class="card-body ">

            <?php echo Form::open(['route' => 'activities.report.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']); ?>

            <?php echo $html; ?>

            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    <?php echo e($labels['search'] ?? 'search'); ?>

                    <div class="loader pull-left" style="display: none;"></div>
                </button>

                <a href="<?php echo e(route('reports.prepare',3)); ?>" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="<?php echo e($labels['report_settings'] ?? 'report_settings'); ?>">
                    <i class="material-icons">settings</i>
                </a>

                <a href="#"  class="btn btn-sm btn-primary"
                  target="_blank"  id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons">print</i> PDF
                </a>
                <a href="#" class="btn btn-sm btn-info"
                   target="_blank"   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                    <i class="material-icons">print</i> Excel
                </a>
            </div>
            <?php echo Form::close(); ?>


            <div class="" id="report-data">
                
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('activity_report')

            $('.selectpicker').selectpicker({
                <?php if(Auth::user()->lang_id == 2 ): ?>
                noneSelectedText: 'لم يتم تحديد شيء',
                <?php endif; ?>
            });            datetimepicker();
            
        });

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
                format: 'DD/MM/YYYY'
            });
        }

        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '<?php echo e(route("reports.prepare")); ?>' + '/' + 3;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalReport .modal-body').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalReprt .modal-body').html();
                    $('#modalReport .modal-body').html(data);
                    $('.selectpicker').selectpicker({
                        <?php if(Auth::user()->lang_id == 2 ): ?>
                        noneSelectedText: 'لم يتم تحديد شيء',
                        <?php endif; ?>
                    });                    // setTimeout(function () {
                    //     selectpicker();
                    //     $('#wizardGoalStyle .card-body').perfectScrollbar();
                    // }, 200);
                },
                error: function () {
                }
            });
        });

        $(document).on('hidden.bs.modal', '#modalReport', function () {
            retriveReportData();
        });

        function retriveReportData() {
            var url = '<?php echo e(route("reports.getData",3)); ?>';
            $.get(url,
                function (data) {
                    if (data.status != 'false') {
                        $('#report-data').empty();
                        $('#report-data').html(data);
                    }
                    else {
                        $('[href="#preparing"]').click();
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                });
        }


        // project.project.search

        $(document).on('submit', '#formSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '<?php echo e(route("activities.report.search")); ?>';
            $.ajax({
                url: url,
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#report-data').html('<div class="col-md-12" align="center"> <div class="loader-div"></div></div>');
                },
                success: function (data) {
                    if(data.status == 'false'){
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#report-data').empty();
                    $('#report-data').html(data);
                    $('.selectpicker').selectpicker({
                        <?php if(Auth::user()->lang_id == 2 ): ?>
                        noneSelectedText: 'لم يتم تحديد شيء',
                        <?php endif; ?>
                    });
                },
                error: function () {
                }
            })
        });

        //project.project.reportExportExcel

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            var data = $('#formSearch').serialize();
            var url = '<?php echo e(route("activities.report.reportExportExcel")); ?>'+'?'+data;
            window.location.href = url;

        });


        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            var  data = $('#formSearch').serialize();
            var url = '<?php echo e(route("activities.report.btnReportPDF")); ?>'+'?'+data;
            window.location.href = url;
        });


    var reports_getData = "<?php echo e(route('reports.getData',3)); ?>";


        /* strategic_plan  change*/
        $(document).on('change', '#strategic_plan', function (e) {
            e.preventDefault();
            var strategic_id = $(this).val();
            $("#project_id option").remove();
            $('#project_id').selectpicker('refresh');
            $("#activity_id option").remove();
            $('#activity_id').selectpicker('refresh');
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');

            $url = '<?php echo e(route('project.project.getProjectByStrategicID')); ?>' + '/' + strategic_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status == true) {
                        selectproject(data.projects);
                    }
                    $('#project_id').selectpicker('refresh');
                },
                error: function () {
                    $('#project_id').selectpicker('refresh');
                }
            });

        });

        function selectproject(data) {
            $("#project_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#project_id").append('<option value=' + index+ '>' + value + '</option>');
            });
        }

        /* project_id  change*/
        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();
            $("#activity_id option").remove();
            $('#activity_id').selectpicker('refresh');

            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');

            $url = '<?php echo e(route('activity.activity.getActivityByProject')); ?>' + '/' + project_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status == true) {
                        selectActivity(data.activities);
                    }
                    $('#activity_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_id').selectpicker('refresh');
                }
            });

        });

        function selectActivity(data) {
            $("#activity_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_id").append('<option value=' + index+ '>' + value + '</option>');
            });
        }


    /* project_id  change*/
        $(document).on('change', '#activity_id', function (e) {
            e.preventDefault();
            var activity_id = $(this).val();
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');
            $url = '<?php echo e(route('activity.activity.getActivityByActivityParent')); ?>' + '/' + activity_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status == true) {
                        selectActivitySub(data.activities);
                    }
                    $('#activity_sub_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_sub_id').selectpicker('refresh');
                }
            });

        });

        function selectActivitySub(data) {
            $("#activity_sub_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_sub_id").append('<option value=' + index+ '>' + value + '</option>');
            });
        }




    </script>

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modal_setting.js')); ?>"></script>
    <script src="<?php echo e(asset('js/wizardReport.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>