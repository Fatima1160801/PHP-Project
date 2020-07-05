<?php $__env->startSection('css'); ?>
    <style>


    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <div class="row">
                    <div class="col-md-2">
                        <?php echo e($labels['activities'] ?? 'activities'); ?>


                    </div>

                    <div class="col-md-10" style=" background-color: #fff7d0; border-radius: 10px; ">
                        <form no-jquery-validate="no-jquery-validate">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if(isset($projects)): ?>
                                        <div class="col-md-12"
                                             style=" background-color: #fff7d0; border-radius: 10px; ">
                                            <div class="row">
                                                <label style="text-align: center;padding: 17px;font-weight: bold;"
                                                       for="project_id" class="col-md-4 col-form-label">

                                                    <?php echo e($labels['project_name']??['project_name']); ?>

                                                </label>
                                                <div class='col-md-8'>
                                                    <div class='form-group has-default bmd-form-group'>
                                                        <select id="project_id" name="project_id"
                                                                class="form-control  selectpicker"
                                                                data-live-search="true" data-style="btn btn-link">
                                                            <option value="0"></option>
                                                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($project_id != null && $project->id == $project_id): ?> selected
                                                                        <?php endif; ?> value="<?php echo e($project->id); ?>"><?php echo e($project->{'project_name_'.lang_character()}); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
            </h4>
        </div>
        <div class="card-body ">

            
               
               
               
                
            
            <?php if( Auth::user()->id == 1 || in_array(165,$userPermissions)): ?>
                <a href="<?php echo e(route('activities.report.activities')); ?>" class="btn btn-primary  btn-sm btn-round btn-fab"
                   rel="tooltip" data-placement="top"
                   title="<?php echo e($labels['search'] ?? 'search'); ?>">
                    <i class="material-icons">search</i>
                </a>
            <?php endif; ?>

            <div id="table-content">
                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="15%">
                            <?php echo e($labels['activity_name'] ?? 'activity_name'); ?>

                        </th>
                        <th width="8%">
                            <?php echo e($labels['planed_start_date'] ?? 'planed_start_date'); ?>

                        </th>
                        <th width="8%">
                            <?php echo e($labels['planed_end_date'] ?? 'planed_end_date'); ?>

                        </th>
                        <th width="8%">
                            <?php echo e($labels['act_start_date'] ?? 'act_start_date'); ?>

                        </th>
                        <th width="8%">
                            <?php echo e($labels['act_end_date'] ?? 'act_end_date'); ?>

                        </th>
                        <th width="8%">
                            <?php echo e($labels['status'] ?? 'status'); ?>

                        </th>
                        <th width="17%">
                            <?php echo e($labels['completion_percent'] ?? 'completion_percent'); ?>

                        </th>


                        <th width="20%">
                            <?php echo e($labels['actions'] ?? 'actions'); ?>

                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <?php if($activities != null): ?>

                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($activity->{'activity_name_'.lang_character()}); ?>


                                    <?php if($activity->temp == 1): ?>
                                        <span class=" badge badge-danger">
                                    Temp
                              </span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(dateFormatSite($activity->planed_start_date)); ?></td>
                                <td><?php echo e(dateFormatSite($activity->planed_end_date)); ?></td>
                                <td><?php echo e(dateFormatSite($activity->act_start_date)); ?></td>
                                <td><?php echo e(dateFormatSite($activity->act_end_date)); ?></td>
                                <td>
                                    <?php if($activity->status_id == 1): ?>
                                        <?php echo e($labels['Not_started']??'Not_started'); ?>

                                    <?php elseif($activity->status_id == 2): ?>
                                        <?php echo e($labels['Pending']??'Pending'); ?>

                                    <?php elseif($activity->status_id == 3): ?>
                                        <?php echo e($labels['ongoing']??'ongoing'); ?>

                                    <?php elseif($activity->status_id == 4): ?>
                                        <?php echo e($labels['Finished']??'Finished'); ?>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($activity->subActivity->count() > 0): ?>
                                        <div class="row completion">
                                            <div class="col-md-8" style="padding-top: 8px;">
                                                <div class="progress progress-line-primary">
                                                    <div id="completion_percent<?php echo e($activity->id); ?>"
                                                         class="progress-bar progress-bar-primary" role="progressbar"
                                                         aria-valuenow="<?php echo e($activity->completion_percent); ?>"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: <?php echo e($activity->completion_percent); ?>%;">
                                                    <span class="sr-only"><?php echo e($activity->completion_percent); ?>

                                                        Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="completion_percent_text<?php echo e($activity->id); ?>">
                                        <span class="badge badge-secondary">
                                            <?php echo e($activity->completion_percent); ?> %
                                        </span>
                                            </div>
                                        </div>
                                    <?php else: ?>

                                        <a href="<?php echo e(route('activity.completion_percent',$activity->id)); ?>" rel="tooltip"
                                           class=" "
                                           data-toggle="modal" data-target="#modalCompletionPercent"
                                           rel="tooltip" data-original-title=""
                                           title="<?php echo e($labels['completion_percent'] ?? 'completion_percent'); ?>"
                                           data-placement="top"
                                           completion-percent="completion_percent<?php echo e($activity->id); ?>"
                                           id="AddCompletionPercent">

                                            <div class="row completion">
                                                <div class="col-md-8" style="padding-top: 8px;">
                                                    <div class="progress progress-line-primary">
                                                        <div id="completion_percent<?php echo e($activity->id); ?>"
                                                             class="progress-bar progress-bar-primary"
                                                             role="progressbar"
                                                             aria-valuenow="<?php echo e($activity->completion_percent); ?>"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             style="width: <?php echo e($activity->completion_percent); ?>%;">
                                                    <span class="sr-only"><?php echo e($activity->completion_percent); ?>

                                                        Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="completion_percent_text<?php echo e($activity->id); ?>">
                                        <span class="badge badge-secondary">
                                            <?php echo e($activity->completion_percent); ?> %
                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    
                                    
                                    
                                    
                                    
                                    

                                    <a href="<?php echo e(route('activity.activity.create',['main',$activity->id])); ?>"
                                       class="btn btn-sm   btn-round btn-success btn-fab"
                                       rel="tooltip" title="<?php echo e($labels['edit'] ?? 'edit'); ?>" data-placement="top"
                                       id="EditActivity">

                                        <i class="material-icons">edit</i>
                                    </a>


                                    <a href="<?php echo e(route('activity.activity.create',['sub',$activity->id,'create'])); ?>"
                                       rel="tooltip" class="btn btn-sm   btn-round btn-rose btn-fab"
                                       title="<?php echo e($labels['add_sub_activity'] ?? 'add_sub_activity'); ?>"
                                       data-placement="top"
                                       id="EditActivity">
                                        <i class="material-icons">add</i>
                                    </a>
                                    <a href="<?php echo e(route('activity.main.destroy',$activity->id)); ?>"
                                       class="btn btn-sm btn-round btn-danger btn-fab"
                                       rel="tooltip" title="<?php echo e($labels['deletactivity'] ?? 'deletactivity'); ?>"
                                       data-placement="top"
                                       id="btnDeleteActivity">
                                        <i class="material-icons">delete</i>
                                    </a>

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    <?php if($activity->subActivity->count() > 0): ?>

                                        <a href="<?php echo e(route('activity.subActivity.index',$activity->id)); ?>"
                                           class="showSubActivity btn btn-sm   btn-round btn-info btn-fab"
                                           rel="tooltip" title="<?php echo e($labels['sub_activity'] ?? 'sub_activity'); ?>"
                                           data-placement="left"
                                           id="<?php echo e($activity->id); ?>">
                                            <i class="material-icons">list_alt</i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if($activity->act_start_date == null || empty($activity->act_start_date)): ?>
                                        <button href="<?php echo e(route('activity.activity.start_actually',$activity->id)); ?>"
                                                class="start-activity-actually btn btn-sm  btn-round btn-tumblr btn-fab"
                                                rel="tooltip" title="<?php echo e($labels['startactivity'] ?? 'startactivity'); ?>"
                                                data-placement="top" data-id="<?php echo e($activity->id); ?>">
                                            <i class="material-icons">done</i>
                                        </button>
                                    <?php endif; ?>


                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="modal fade  bd-example-modal-lg" id="modalCompletionPercent" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>


    <div class="modal fade   bd-example-modal-lg" id="modalCopyActivity" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalStartActivityActually" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <br>
                        <h5 class="modal-title card-title" id="">Actually Start Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'activity.activity.start_actually' ,'action'=>'post' ,'id'=>'formActivityStartActually']); ?>


                        <div class="row">
                            <label for="staff_id" class="col-md-3 col-form-label">Actually Start Date</label>
                            <div class="col-md-4">
                                <div class='form-group has-default bmd-form-group'>
                                    <input type='text' class='form-control datetimepicker'
                                           name='activity_act_start_date' id='activity_act_start_date'
                                           autocomplete="off" alt=''>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" btn="btnToggleDisabled" id="btn-activity-start_actually"
                                        class="btn btn-rose pull-center">
                                    Save
                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>
                            </div>
                        </div>


                        <input type="hidden" id="modal_act_activity_id" name="activity_id" value="">

                        <?php echo Form::close(); ?>


                        <hr>

                        <?php echo Form::open(['route' => 'activity.delay.store' ,'action'=>'post' ,'id'=>'formActivityDelayAdd']); ?>


                        <div id="noti_text_"></div>
                        <div id="delay_form"></div>

                        <div class="row" id="btn-add-activity-delay-row" style="display: none">
                            <label for="staff_id" class="col-md-2 col-form-label"></label>
                            <div class="col-md-4">
                                <button type="submit" btn="btnToggleDisabled" id="btn-add-activity-delay"
                                        class="btn btn-rose pull-center">
                                    Save
                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>
                            </div>
                        </div>

                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('#project_id').val('');
            $('#project_id').selectpicker('refresh');
        })


        $(function () {

            DataTableCall('#table', 9);
            tablePageLeng($('table tr').length);
            $('[data-toggle="tooltip"]').tooltip();
            $('[rel="tooltip"]').tooltip();
            active_nev_link('activities_list');
            datetimepicker();

            <?php if($project_id == null): ?>
            $('#strategic_id').change();
            <?php endif; ?>
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

        })

        function rowData(data, $id) {
            $x = "<tr style='display: none;' id='" + $id + "' style='background-color: #fdfdfd'><td style=' background-color: #fff;'></td><td colspan='4'>"
                + data +
                "</td></tr>";

            return $x;
        }


        $(document).on('click', '#AddCompletionPercent', function (e) {
            e.preventDefault()
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalGoal #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalCompletionPercent #contentModal').empty();
                    $('#modalCompletionPercent #contentModal').html(data);

                },
                error: function () {
                }
            });
        });


        $(document).on('click', '#copyActivity', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalCopyActivity #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalCopyActivity #contentModal').empty();
                    $('#modalCopyActivity #contentModal').html(data.data);
                },
                error: function () {
                }
            });


        });


        $('body').on('click', '.start-activity-actually', function () {
            var activity_id = $(this).data('id');
            $('#modalStartActivityActually #modal_act_activity_id').val(activity_id);
            $('#modalStartActivityActually').modal('show');
            $('#modalStartActivityActually #delay_form').html('');
            $('#noti_text_').html('');
            $('#btn-add-activity-delay-row').hide();
            $('#formActivityStartActually #activity_act_start_date').val('');
        });


        $('#formActivityStartActually').submit(function (e) {
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                    $('#btn-activity-start_actually').attr('disabled', true);
                },
                success: function (data) {
                    $('#btn-activity-start_actually').attr('disabled', false);
                    $('.loader').hide();
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalStartActivityActually').modal('hide');
                        $('#modalStartActivityActually #delay_form').html('');
                    } else if (data.success == false) {
                        if (data.delay == true) {
                            $('#modalStartActivityActually #delay_form').empty();
                            $('#modalStartActivityActually #delay_form').html(data.delay_form);
                            $('#btn-add-activity-delay-row').show();
                            $('.selectpicker').selectpicker();
                            datetimepicker();
                            $('#noti_text_').html('<div class="alert alert-rose alert-with-icon" data-notify="container">\n' +
                                '<i class="material-icons" data-notify="icon">notifications</i>\n' +
                                ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                                '                      <i class="material-icons">close</i>\n' +
                                '                    </button>\n' +
                                '                    <span data-notify="message">There are a delay regarding this activity, You should add the delay reason.</span>\n' +
                                '                  </div>');
                        } else {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#modalStartActivityActually #delay_form').html('');
                        }
                    }
                },
                error: function (data) {
                }
            });
        });


        $('#formActivityDelayAdd').submit(function (e) {
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                    $('#btn-add-activity-delay').attr('disabled', true);
                },
                success: function (data) {
                    $('#btn-add-activity-delay').attr('disabled', false);
                    $('.loader').hide();
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalStartActivityActually').modal('hide');
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                },
                error: function (data) {
                }
            });
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


        /*///////////*****delete activity****//////////*/
        $(document).on('click', '#btnDeleteActivity', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteActivity['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        /* when change strategic_id  */
        $(document).on('change', '#strategic_id', function (e) {
            e.preventDefault();
            var strategic_id = $(this).val();

            $url = '<?php echo e(route('activities.project.strategic')); ?>' + '/' + strategic_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('#table-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                    $("#project_id option").remove();
                    $("#project_id").append("<option  style='height: 37px;' value></option>");
                    $('#project_id').selectpicker('refresh');
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[rel="tooltip"]').tooltip();

                },
                success: function (data) {
                    //  console.log(data);
                    //console.log(data.activities);
                    if (data.projects != null) {
                        selectProjects(data['projects']);

                    }
                    $('#table-content').empty();
                    $('#table-content').html(data.activities);
                    $('#project_id').selectpicker('refresh');
                    DataTableCall('#table', 9);
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[rel="tooltip"]').tooltip();
                    datetimepicker();
                },
                error: function () {
                }
            });

        });

        function selectProjects(data) {
            $.each(data, function (index, value) {
                $("#project_id").append('<option value=' + value['id'] + '>' + value["<?php echo e('project_name_'.lang_character()); ?>"] + '</option>');
            });
        }


        /* when change project_id  */
        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();

            $url = '<?php echo e(route('activities.activities.project')); ?>' + '/' + project_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('#table-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#table-content').empty();
                    $('#table-content').html(data.activities);

                    DataTableCall('#table', 9);
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[rel="tooltip"]').tooltip();
                    datetimepicker();
                },
                error: function () {
                }
            });

        });

    </script>



<?php $__env->stopSection(); ?>




<?php $__env->startSection('js'); ?>


    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo e(asset('assets/js/plugins/nouislider.min.js')); ?>"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>