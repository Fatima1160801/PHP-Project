<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_tasks'] ?? 'screen_tasks'); ?>

            </h4>

        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary btn-round btn-fab btn-sm"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add_task'] ?? 'add_task'); ?> ">
                <i class="material-icons">add</i></a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['task_name'] ?? 'task_name'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['Deadline'] ?? 'Deadline'); ?>

                     </th>
                    <th>
                        <?php echo e($labels['task_status'] ?? 'task_status'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['priority'] ?? 'priority'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['AssignedStaffs'] ?? 'AssignedStaffs'); ?>

                     </th>
                    <th>
                        <?php echo e($labels['progress_percent'] ?? 'progress_percent'); ?>

                     </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td>
                            <p class="p_task"><?php echo e($task->task_name); ?>

                                <?php if($task->temp == 1): ?>
                                    <span class=" badge badge-danger"> Temp </span>
                                <?php endif; ?>
                            </p>
                            <small><?php echo e((Auth::user()->lang_id == 1) ? 'Starts at' : 'تبدأ في'); ?> <?php echo e(date('d M, Y',strtotime($task->start_date))); ?></small>

                        </td>
                        <td><?php echo e(date('d M, Y',strtotime($task->end_date))); ?></td>
                        <td><?php echo agendaStatus($task->task_status_id); ?></td>
                        <td><?php echo agendaPriority($task->task_priority_id); ?></td>
                        <td>
                            <ul class="list-unstyled team-info">
                                <?php $__currentLoopData = $task->assigned_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assigned_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="display: inline-block;">
                                        <a href="<?php echo e(route('project.staff.edit',$assigned_staff['id'])); ?>">
                                            <img src="<?php echo e(!empty($assigned_staff['avatar_']) ? asset('images/user/photo/').'/'.$assigned_staff['avatar_'] : asset('assets/img/placeholder.png')); ?>"
                                                 style="width:40px;height:40px" data-toggle="tooltip"
                                                 data-placement="top"
                                                 title="<?php echo e(Auth::user()->lang_id == 1 ? $assigned_staff['staff_name_na'] : $assigned_staff['staff_name_fo']); ?>"
                                                 data-original-title="Avatar">
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar l-slategray progress-<?php echo e(progressBarColor($task->progress_percent)); ?>"
                                     role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100"
                                     style="width: <?php echo e($task->progress_percent); ?>%;"></div>
                            </div>
                            <small>

                                <?php echo e($labels['Completionwith']??'Completionwith'); ?>  : <?php echo e($task->progress_percent); ?>%</small>
                        </td>
                        <td>
                            <a href="<?php echo e(route('tasks.edit',$task->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab" data-toggle="tooltip"
                               data-placement="top"
                               title=" <?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">edit</i>
                            </a>

                            <button type="button" data-href="<?php echo e(route('tasks.delete',$task->id)); ?>"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTaskDelete"
                                    data-placement="top" title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                <i class="material-icons">delete</i>
                            </button>

                            <?php if($task->temp == 0): ?>
                                <a href="<?php echo e(route('task.copy.index',$task->id)); ?>"
                                   class="btn btn-sm   btn-round   btn-fab btn-primary"
                                   rel="tooltip" data-toggle="modal" data-target="#modalCopyTask"
                                   data-original-title="" title="<?php echo e($labels['copyTask'] ?? 'copyTask'); ?> "
                                   data-placement="top" id="copyTask">
                                    <i class="material-icons">file_copy</i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade   bd-example-modal-lg  " id="modalCopyTask" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">


            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            active_nev_link('tasks');

         DataTableCall('#table',8);

            $('[data-toggle="tooltip"]').tooltip();
        })


        $(document).on('click', '.btnTaskDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteTask['text']); ?>',
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

        $(document).on('click', '#copyTask', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalCopyTask #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalCopyTask #contentModal').empty();
                    $('#modalCopyTask #contentModal').html(data.data);
                },
                error: function () {
                }
            });

        })
    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>