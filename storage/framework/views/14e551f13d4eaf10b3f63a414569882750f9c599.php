<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['project_achievement_report'] ?? 'project_achievement_report'); ?>

            </h4>

        </div>
        <div class="card-body ">


            <?php echo Form::open(['route' => 'project.report.achievement.search' ,'action'=>'get' ,'id'=>'formProjectSearch','class'=>'']); ?>


            <?php echo $html; ?>

            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    <?php echo e($labels['search'] ?? 'search'); ?>

                    <div class="loader pull-left" style="display: none;"></div>
                </button>
                <a href="<?php echo e(route('reports.prepare',20)); ?>" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="<?php echo e($labels['report_settings'] ?? 'report_settings'); ?>">
                    <i class="material-icons">settings</i>

                </a>
                <a href="<?php echo e(route('project.report.achievement.btnReportPDF')); ?>" class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons">print</i> PDF
                </a>
                <a href="<?php echo e(route('project.report.achievement.reportExportExcel')); ?>" class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
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
        $(document).ready(function (){
            // retriveReportData();
            $('.selectpicker').selectpicker();
            datetimepicker();
            active_nev_link('project_achievement_report');
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
            url = '<?php echo e(route("reports.prepare")); ?>' + '/' + 20;
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
                    $('.selectpicker').selectpicker();                   // setTimeout(function () {
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
            var url = '<?php echo e(route("reports.getData",20)); ?>';
            $.get(url,
                function (data) {
                    if (data.status != 'false') {
                        $('#report-data').empty();
                        $('#report-data').html(data);
                    } else {
                        $('[href="#preparing"]').click();
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                });
        }


        // project.project.search

        $(document).on('submit', '#formProjectSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '<?php echo e(route("project.report.achievement.search")); ?>';
            $.ajax({
                url: url,
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#report-data').html('<div class="col-md-12" align="center"> <div class="loader-div"></div></div>');
                },
                success: function (data) {
                    if (data.status == 'false') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#report-data').empty();
                    $('#report-data').html(data);
                    $('.selectpicker').selectpicker();
                    // setTimeout(function(){
                    //     $('#table').DataTable({
                    //         language: {
                    //             search: "_INPUT_",
                    //             searchPlaceholder: "Search records",
                    //         }
                    //     });
                    // }, 1000);
                },
                error: function () {
                }
            })
        });
        //project.project.reportExportExcel
        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '<?php echo e(route("project.report.achievement.reportExportExcel")); ?>' + '?' + data;
            window.location.href = url;
        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '<?php echo e(route("project.report.achievement.btnReportPDF")); ?>' + '?' + data;
            window.location.href = url;
        });

        var reports_getData = "<?php echo e(route('reports.getData',20)); ?>";


        $(document).on('change', '#strategic_plan_id', function (e) {
            e.preventDefault();
            var strategic_plan_id = $(this).val();
             $("#strategic_objective_id option").remove();
            $('#strategic_objective_id').selectpicker('refresh');
            $("#strategic_result_id option").remove();
            $('#strategic_result_id').selectpicker('refresh');
            $("#indicator_id option").remove();
            $('#indicator_id').selectpicker('refresh');
            $("#project_specific_objective_id option").remove();
            $('#project_specific_objective_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.achievement.getStrategicObjective')); ?>' + '/' + strategic_plan_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                     if (data != null) {
                        selectStrategicObjective(data);
                    }
                    $('#strategic_objective_id').selectpicker('refresh');
                },
                error: function () {
                    $('#strategic_objective_id').selectpicker('refresh');
                }
            });
        });

        function selectStrategicObjective(data) {
            $("#strategic_objective_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#strategic_objective_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        $(document).on('change', '#strategic_objective_id', function (e) {
            e.preventDefault();
            var strategic_objective_id = $(this).val();
            getStrategicResult(strategic_objective_id);
            getIndicator(strategic_objective_id);
        });
        $(document).on('change', '#strategic_result_id', function (e) {
            e.preventDefault();
            var strategic_result_id = $(this).val();
             if (typeof strategic_result_id !== 'undefined' &&  strategic_result_id !=''  &&  strategic_result_id != 0)
            {
                 getIndicator(strategic_result_id);
            }else{
                var strategic_objective_id = $('#strategic_objective_id').val();
                 getIndicator(strategic_objective_id);
            }
        });



        function getStrategicResult(strategic_objective_id) {
            $("#strategic_result_id option").remove();
            $('#strategic_result_id').selectpicker('refresh');
            $("#indicator_id option").remove();
            $('#indicator_id').selectpicker('refresh');
            $("#project_specific_objective_id option").remove();
            $('#project_specific_objective_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.achievement.getStrategicResult')); ?>' + '/' + strategic_objective_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                     if (data != null) {
                        selectStrategicResult(data);
                    }
                    $('#strategic_result_id').selectpicker('refresh');
                },
                error: function () {
                    $('#strategic_result_id').selectpicker('refresh');
                }
            });
        }

        function selectStrategicResult(data) {
            $("#strategic_result_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#strategic_result_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        function getIndicator(id) {
            $("#indicator_id option").remove();
            $('#indicator_id').selectpicker('refresh');
            $("#project_specific_objective_id option").remove();
            $('#project_specific_objective_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.achievement.getIndicator')); ?>' + '/' + id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                     if (data != null) {
                        selectIndicator(data);
                    }
                    $('#indicator_id').selectpicker('refresh');
                },
                error: function () {
                    $('#indicator_id').selectpicker('refresh');
                }
            });
        }

        function selectIndicator(data) {
            $("#indicator_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#indicator_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        $(document).on('change', '#indicator_id', function (e) {
            e.preventDefault();
            var indicator_id = $(this).val();
            $("#project_specific_objective_id option").remove();
            $('#project_specific_objective_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.achievement.getSpecificObjective')); ?>' + '/' + indicator_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                     if (data != null) {
                        selectSpecificObjective(data);
                    }
                    $('#project_specific_objective_id').selectpicker('refresh');
                },
                error: function () {
                    $('#project_specific_objective_id').selectpicker('refresh');
                }
            });

        });
        function selectSpecificObjective(data) {
            $("#project_specific_objective_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#project_specific_objective_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }



        $(document).on('change', '#level_type_id', function (e) {
            e.preventDefault();
            var indicator_id = $('#indicator_id').val();
            var level_type_id = $(this).val();
            var data_ = "indicator_id="+indicator_id+'&level_type_id='+level_type_id;
            $("#level_id option").remove();
            $('#level_id').selectpicker('refresh');
            var url_ = '<?php echo e(route('project.achievement.getLevelNameByLevelTypeIDAndOrgIndicator')); ?>';
            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data_,
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data != null) {
                        selectLevelId(data);
                    }
                    $('#level_id').selectpicker('refresh');
                },
                error: function () {
                    $('#level_id').selectpicker('refresh');
                }
            });

        });
        function selectLevelId(data) {
            $("#level_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#level_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }


    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>


    <!-- Forms Validations Plugin -->
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