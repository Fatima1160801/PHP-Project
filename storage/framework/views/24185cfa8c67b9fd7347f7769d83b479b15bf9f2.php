<?php $__env->startSection('content'); ?>

    <div class="col-md-12 col-12 mr-auto ml-auto">


        <?php if($task->task_status_id == 3): ?>
            <button class="btn btn-success btn-sm" id="btn-open-task" data-id="<?php echo e($task->id); ?>">
                <?php echo e($labels['Open_Task'] ?? 'Open_Task'); ?>

            </button>
        <?php elseif($task->task_status_id == 1 || $task->task_status_id == 2): ?>
            <button class="btn btn-danger btn-sm" id="btn-close-task" data-id="<?php echo e($task->id); ?>">
                <?php echo e($labels['Close_Task'] ?? 'Close_Task'); ?>

            </button>
        <?php endif; ?>

        <div class="card card-wizard" data-color="rose" id="wizardTask">

            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            <div class="card-header text-center">
                <h3 class="card-title">
                    <?php echo e($labels['screen_edit_tasks'] ?? 'screen_edit_tasks'); ?>

                    <span id="temp-massage">

                    <?php if(isset($task->temp) && $task->temp == 1): ?>
                            <span class=" badge badge-danger">
                                    Temp
                              </span>

                            <div class="alert alert-rose alert-with-icon" data-notify="container"
                                 style=" margin-top: 7px; ">
                            <i class="material-icons" data-notify="icon">notifications</i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span data-notify="message" style=" font-size: 13px; ">
This Task has been saved temporarily, please confirmation save
                                </span>
                        </div>
                        <?php endif; ?>
                    </span>

                </h3>
                <h5 class="card-description"></h5>
            </div>
            <div class="wizard-navigation">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#main_info" data-toggle="tab" role="tab">
                            <?php echo e($labels['task_info'] ?? 'task_info'); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#task_progress" data-toggle="tab" role="tab">
                            <?php echo e($labels['progress_percent'] ?? 'progress_percent'); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#comments" data-toggle="tab" role="tab">
                            <?php echo e($labels['comments'] ?? 'comments'); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#log_hour" data-toggle="tab" role="tab">
                            <?php echo e($labels['log_hour'] ?? 'log_hour'); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#attachments" data-toggle="tab" role="tab">
                            <?php echo e($labels['attachments'] ?? 'attachments'); ?>

                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="main_info">
                        <div id="task_main_info">
                            <?php echo Form::open(['route' => 'tasks.update' ,'action'=>'post' ,'novalidate'=>'novalidate','id'=>'formTaskUpdate']); ?>

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php echo $html; ?>


                            <div class='row'>
                                <label for='assigned_staffs' class='col-md-2 col-form-label'>Assigned Staffs</label>
                                <div class='col-md-10'>
                                    <div class='form-group has-default bmd-form-group'>
                                        <select required class="form-control selectpicker" id="assigned_staffs"
                                                name="assigned_staffs[]" data-style="select-with-transition" multiple
                                                data-live-search="true" title="Choose Staffs">
                                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((is_array($assigned_staffs) && in_array($key,$assigned_staffs) ? 'selected' : '')); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="col-md-12">
                                <input type="hidden" id="activity_start_date" value="">
                                <a href="#" class="btn btn-next btn-rose pull-right btn-sm" id="nextProjectMain">
                                    <?php echo e($labels['next'] ?? 'next'); ?>

                                </a>

                                <button type="submit" id="saveTaskbtn" class="btn btn-primary pull-right btn-sm">
                                    <?php echo e($labels['save'] ?? 'save'); ?>

                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>

                                <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-default pull-left btn-sm"
                                   id="nextProjectMain">
                                    <?php echo e($labels['back'] ?? 'back'); ?>

                                    <div class="ripple-container"></div>
                                </a>

                            </div>

                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="tab-pane" id="task_progress">
                        <div id="task_progress_content">
                            <h4 class="title">               <?php echo e($labels['progress_percent'] ?? 'progress_percent'); ?> (%)</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="sliderRegular" class="slider"></div>
                                </div>
                                <input type="hidden" id="task_id" name="task_id" value="<?php echo e($task->id); ?>">
                                <input type="hidden" id="task_completion_percent" name="task_completion_percent">
                                <div class="col-md-2">
                                    <button disabled id="btnChangePerc" class="btn btn-sm btn-success pull-right">
                                        <span class="material-icons">check</span>
                                        <div class="loader pull-left" style="display: none;"></div>
                                    </button>
                                </div>
                            </div>

                            <div id="task_progress_content_">

                            </div>
                            <div align="center" id="loader-icon-a" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="comments">
                        <div id="comments_content">
                            <div align="center" id="loader-icon-c" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="log_hour">
                        <div id="log_hour_content">
                            <div align="center" id="loader-icon-l" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="attachments">
                        <!-- <div align="center" id="loader-icon" class="col-md-12"> <div class="loader loader-div">  </div></div> -->
                        <div id="files-content">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mr-auto">

                </div>
                <div class="ml-auto">

                    <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish"
                           style="display: none;">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- ==============================================  Modals  ======================================================= -->



    <!-- ==============================================  Comments Modal  ======================================================= -->

    <div class="modal fade" id="taskCommentsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="comments_modal_title">
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'tasks_comments.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAddComment']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div id="taskCommentsModalForm_"></div>

                        <ul class="fileList"></ul>
                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default btn-sm">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>


                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="taskLoghourModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="logour_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'tasks_loghour.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAddLogour']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div id="taskLoghourModalForm"></div>

                        <ul class="fileList"></ul>
                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-l" href="#" class="btn btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
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
            active_nev_link('tasks');

            funValidateForm();
             $("#end_date").on("dp.change", function (e) {
                $('#start_date').data("DateTimePicker").maxDate(e.date);
            });
            datetimepicker();
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


        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var pid = $(this).val();
            if (pid != '' && pid != null && pid != 0) {
                var url = '<?php echo e(route('task.getActivitiesList')); ?>' + '/' + pid;
                $.get(url, function (response) {
                    $('#activity_id').attr('disabled', false);
                    $('#activity_id').html(response);
                    $('#activity_id').selectpicker('refresh');
                });
            } else {
                $('#activity_id').html();
                $('#activity_id').attr('disabled', true);
            }
        })

        $(document).on('change', '#activity_id', function (e) {
            e.preventDefault();
            var aid = $(this).val();

            //   $('#result_id').selectpicker('refresh');
            var url__ = '<?php echo e(route('task.getSubActivitiesList')); ?>' + '/' +aid;
            $.ajax({
                url: url__ ,
                dataTypes: 'html',
                type: 'get',
                beforeSend: function () {
                    $('#sub_activity_id option').remove();
                    $('#sub_activity_id').html('<option value=""></option>');
                    $('#sub_activity_id').selectpicker('refresh');


                },
                success: function (data) {
                    if(data.status == true){
                        $('#sub_activity_id').html(data.html);
                        $('#sub_activity_id').removeAttr('disabled');
                        $('#sub_activity_id').attr('required','required');
                        $('#sub_activity_id').selectpicker('refresh');
                    }else{
                        $('#sub_activity_id').empty();
                        $('#sub_activity_id').html('<option value=""></option>');
                        $('#sub_activity_id').attr('disabled','disabled');
                        $('#sub_activity_id').removeAttr('required','required');
                        $('#sub_activity_id').selectpicker('refresh');
                    }

                },
                error: function () {

                }
            });
            fill_assigned_staffs(aid);
            
            
                
                
                
                

                
                

                    
                        
                        
                        
                        

                    
                        
                    

                
                

                
            

        })


        function fill_assigned_staffs(activity_id) {
            var url = '<?php echo e(route('task.getStaffByActivityID')); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#assigned_staffs option').remove();
                    $('#assigned_staffs').html('<option value=""></option>');
                    $('#assigned_staffs').selectpicker('refresh');

                },
                success: function (data) {
                    if (data.status == true) {
                        $("#assigned_staffs").append("<option value=''></option>");
                        $.each(data.staff, function (index, value) {
                            $("#assigned_staffs").append('<option value=' + index + '>' + value + '</option>');
                        });
                        $('#assigned_staffs').selectpicker('refresh');
                    }
                },
                error: function () {

                }
            });
        }


        $(document).on('change', '#sub_activity_id', function (e) {
            e.preventDefault();
            var aid = $(this).val();
            fill_assigned_staffs(aid);
            
            
                
                
                
                

                
                
                    
                        
                        
                        
                        
                    
                        
                    

                
                

                
            
        });




        $('.selectpicker').selectpicker();
        datetimepicker();

        $('a[href="#attachments"]').click(function () {
            var primary_id = '<?php echo e($primary_id); ?>';
            if (primary_id == 0) {
                primary_id = $('#object_primary_id').val();
            }
            var get_attachments_url = '<?php echo e(route('attachments.get_by_activity',['activity_type' => $activity_type])); ?>' + '/' + primary_id;
            $.get(get_attachments_url, function (response) {
                $('#files-content').html(response);
                $('#attachments-table').DataTable({language: {search: "_INPUT_", searchPlaceholder: "Search records"}});
                $('[data-toggle="tooltip"]').tooltip();
            });
        });


        //$('.id_100 option[value=val2]').attr('selected','selected');





            $('#formTaskUpdate').submit(function (e) {

                e.preventDefault();
                if (!is_valid_form($(this))) {
                    return false;
                }

                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        // $('#saveTaskbtn').prop("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        //$('#saveTaskbtn').removeAttr("disabled");
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#temp-massage').fadeOut()

                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                        $('.loader').hide();

                    },
                    error: function (data) {
                    }
                });

            });


            $('#formAssignStaff').submit(function (e) {
                if (!is_valid_form($(this))) {
                    return false;
                }

                e.preventDefault();

                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        // $('#saveTaskbtn').prop("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        //$('#saveTaskbtn').removeAttr("disabled");
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#assignStaffModal').modal('hide');
                            $('#loader-icon').show();
                            loadAssignedTo();
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                        $('.loader').hide();

                    },
                    error: function (data) {
                    }
                });

            });


            $('body').on('submit', '#formAddComment', function (e) {
                if (!is_valid_form($(this))) {
                    return false;
                }

                e.preventDefault();

                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        // $('#saveTaskbtn').prop("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        //$('#saveTaskbtn').removeAttr("disabled");
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#taskCommentsModal').modal('hide');
                            $('#loader-icon-c').show();
                            loadComments();
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                        $('.loader').hide();

                    },
                    error: function (data) {
                    }
                });

            });


            $('#formAddLogour').submit(function (e) {
                e.preventDefault();
                if (!is_valid_form($(this))) {
                    return false;
                }

                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        $('.loader').show();
                    },
                    success: function (data) {
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#taskLoghourModal').modal('hide');
                            $('#loader-icon-l').show();
                            loadLoghour();
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                        $('.loader').hide();
                    },
                    error: function (data) {
                    }
                });

            });

            /* $('a[href="#main_info_"]').click(function(){
                 alert(5);
                 $('body').scrollTo('#task_main_info');
             });*/


            $('body').on('click', '#btnAssignStaff', function () {
                var url_ = '';
                $.get(url_, function (response) {
                    $('#assignStaffModalForm').html(response);
                    $('.selectpicker').selectpicker();
                    $('#formAssignStaff input[name="task_id"]').val('<?php echo e($task->id); ?>');
                });
                $('#assignStaffModal').modal('show');
                $('#assign_staff_modal_title').html('Assign New Staff');
            });


            $('body').on('click', '#btnAddComment', function () {
                var url_ = '<?php echo e(route('tasks_comments.create',$task->id)); ?>';
                $.get(url_, function (response) {
                    $('#taskCommentsModalForm').html(response.html);
                    $('.selectpicker').selectpicker();
                    $('#formAddComment input[name="task_id"]').val('<?php echo e($task->id); ?>');
                    $('#formAddComment input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                    $('#comments_modal_title').html(response.AddComment);
                });
                $('#taskCommentsModal').modal('show');

            });


            $('body').on('click', '.btnEditTaskComment', function () {
                var url_ = $(this).attr('data-href');
                $.get(url_, function (response) {
                    $('#taskCommentsModalForm_').html(response.html);
                    $('.selectpicker').selectpicker();
                    $('body').animate({scrollTop: 0}, 600);
                    $('#comments_modal_title').html(response.EditComment);
                });
                $('#taskCommentsModal').modal('show');

            });


            $(document).on('click', '#btnAddLogHour', function () {
                //var task_id = $('#task_link').attr('data-task-id');
                // var url_ = '<?php echo e(route('tasks_loghour.create')); ?>' + '/' + task_id;
                var url_ = $(this).attr('data-href');
                $.get(url_, function (response) {
                    console.log(response)
                    $('#taskLoghourModalForm').html(response.html);
                    $('.selectpicker').selectpicker();
               //     $('#formAddLogour input[name="task_id"]').val(task_id);
                    $('#formAddLogour input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                    datetimepicker();
                   $('#log_date').val($('#activity_start_date').val());
                $( "#log_date" ).datetimepicker("refresh");
                });
                datetimepicker();
                $('#taskLoghourModal').modal('show');
                $('#logour_modal_title').html('<?php echo e($labels['add_log_hour'] ?? 'add_log_hour'); ?>')

            });


            $('body').on('click', '.btnEditTaskLogHour', function () {
                var url_ = $(this).attr('data-href');
                $.get(url_, function (response) {
                    $('#taskLoghourModalForm').html(response);
                    $('.selectpicker').selectpicker();
                    $('#formAddLogour input[name="task_id"]').val('<?php echo e($task->id); ?>');
                    $('#formAddLogour input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                    $('#log_date').data("DateTimePicker").minDate($('#activity_start_date').val());
                    datetimepicker();
                });
                $('#taskLoghourModal').modal('show');
                $('#logour_modal_title').html('Edit Log Hour');
            });


            $(document).on('click', '.btnAssignedTaskDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '<?php echo e(getMessage('2.73')['text']); ?>',
                    confirmButtonClass: 'btn btn-success btn-sm',
                    cancelButtonClass: 'btn btn-danger btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true) {
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('data-href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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

            $(document).on('click', '.btnCommentTaskDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '<?php echo e(getMessage('2.76')['text']); ?>',
                    confirmButtonClass: 'btn btn-success btn-sm',
                    cancelButtonClass: 'btn btn-danger btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true) {
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('data-href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('li').delay(300).hide(1000);
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


            $(document).on('click', '.btnLoghourTaskDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '<?php echo e(getMessage('2.66')['text']); ?>',
                    confirmButtonClass: 'btn btn-success btn-sm',
                    cancelButtonClass: 'btn btn-danger btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true) {
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('data-href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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

            $(document).on('click', '.btnTaskProgReportDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '<?php echo e(getMessage('2.109')['text']); ?>',
                    confirmButtonClass: 'btn btn-success btn-sm',
                    cancelButtonClass: 'btn btn-danger btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true) {
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('data-href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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

            $('#btn-open-task').click(function () {
                var tid = $(this).attr('data-id');
                $.post('<?php echo e(route('tasks.change_status')); ?>', {tid: tid, status: 2}, function (data) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                });
            });

            $('#btn-close-task').click(function () {
                var tid = $(this).attr('data-id');
                $.post('<?php echo e(route('tasks.change_status')); ?>', {tid: tid, status: 3}, function (data) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                });
            });


            $('#assignStaffModal #modal-dismiss-f').click(function () {
                $('#assignStaffModal .close').click();
            });

            $('#taskCommentsModal #modal-dismiss-f').click(function () {
                $('#taskCommentsModal .close').click();
            });

            $('#taskLoghourModal #modal-dismiss-l').click(function () {
                $('#taskLoghourModal .close').click();
            });

            $('#btnChangePerc').click(function () {
                var com_perc = $('#task_completion_percent').val();
                var task_id = $('#formTaskUpdate #id').val();
                $.post('<?php echo e(route('task_progress.update')); ?>', {task_id: task_id, com_perc: com_perc}, function () {

                });
            });




    </script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>

    <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2): ?>
        <script src="<?php echo e(asset('js/task_edit_wizard_rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/task_edit_wizard.js')); ?>"></script>
    <?php endif; ?>

    <script src="<?php echo e(asset('assets/js/plugins/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/material-dashboard.min.js?v=2.0.2')); ?>"></script>
    <script src="https://refreshless.com/nouislider/documentation/assets/wNumb.js"></script>
    <script src="<?php echo e(asset('summernote/summernote.js')); ?>"></script>
    <script src="<?php echo e(asset('js/editor-summernote.js')); ?>"></script>

    <script>


        wizard();

        //initSliders($('#progress_percent').val());

        function wizard() {
            taskWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardTask').addClass('active');
            }, 100);
        }

        function loadProgress() {
            var url = '<?php echo e(route('task_progress.get',$task->id)); ?>';
            $.get(url, function (response) {
                $('#loader-icon-a').hide();
                $('#task_progress_content_').html(response.html);
                $('#task_progress_perc').show();
                //initSliders(response.progress_percent);
                $('[data-toggle="tooltip"]').tooltip();
                $('.selectpicker').selectpicker();

            });
        }

        $('.summernote-code').summernote({
            height: 250,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        });


        function loadComments() {
            var url = '<?php echo e(route('tasks_comments.index',$task->id)); ?>';
            $.get(url, function (response) {
                $('#loader-icon-c').hide();
                $('#comments_content').html(response);
                /*$('#task-comments-table').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });*/
                $('#formAddComment input[name="task_id"]').val('<?php echo e($task->id); ?>');
                $('#formAddComment input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                $('[data-toggle="tooltip"]').tooltip();
            });
        }


        function loadLoghour() {
            var url = '<?php echo e(route('tasks_loghour.index',$task->id)); ?>';
            $.get(url, function (response) {
                $('#loader-icon-l').hide();
                $('#log_hour_content').html(response);
                setTimeout(function () {
                    $('#btn_collapse_loghour').click();
                }, 500);
                /*$('#task-comments-table').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });*/
                $('[data-toggle="tooltip"]').tooltip();
            });
        }


        function slider() {
            if ($('.slider').length != 0) {
                md.initSliders();
            }
        }

        function initSliders(start) {
            var e = document.getElementById("sliderRegular");
            noUiSlider.create(e, {
                start: start,
                connect: [!0, !1],
                range: {
                    min: 0,
                    max: 100
                },
                tooltips: true,
                step: 1,
                format: wNumb({
                    decimals: 0
                }),

            });
        }

        var slider = document.getElementById("sliderRegular");

        noUiSlider.create(slider, {
            start: $('#progress_percent').val(),
            connect: [!0, !1],
            range: {
                min: 0,
                max: 100
            },
            tooltips: true,
            step: 1,
            format: wNumb({
                decimals: 0
            })
        });

        slider.noUiSlider.on('update', function (values, handle) {
            $('#task_completion_percent').val(values);
        });

        slider.noUiSlider.on('change', function (values, handle) {
            $('#task_completion_percent').val(values);
            $('#btnChangePerc').prop('disabled', false);
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>