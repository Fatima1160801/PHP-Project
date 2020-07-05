<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">storage</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['staff'] ?? 'staff'); ?>

            </h4>
        </div>
        <div class="card-body">
            <a href="<?php echo e(route('project.staff.create')); ?>" class="btn btn-sm btn-primary btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add'] ?? 'add'); ?>">
                <i class="material-icons">add
                </i>
            </a>

            <table id="table" class="table">
                <thead>
                <tr>
                    <th>#</th>

                    <th>
                        <?php echo e($labels['staff_name_arabic'] ?? 'staff_name_arabic'); ?>

                    </th>

                <th>
                        <?php echo e($labels['job_title_id'] ?? 'job_title_id'); ?>

                    </th>

                    <th>
                        <?php echo e($labels['supervisor_id'] ?? 'supervisor_id'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['user_name'] ?? 'user_name'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['action'] ?? 'action'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($staff->staff_name_fo); ?></td>
                        <td><?php echo e($staff->jobTitle ? $staff->jobTitle->{'job_title_name_'.lang_character()} : ''); ?></td>
                        <td><?php echo e($staff->supervisor ? $staff->supervisor->{'staff_name_'.lang_character()} : ''); ?></td>
                        <td><?php echo e($staff->user ? $staff->user->user_name : ''); ?></td>

                        <td>
                            <?php if($staff->user != null): ?>
                                <a href="<?php echo e(route('permission.user.edit',$staff->user->id)); ?>"
                                   class="btn btn-rose btn-round btn-fab btn-sm" data-toggle="tooltip"
                                   data-placement="left"
                                   title="<?php echo e($labels['user_staff'] ?? 'user_staff'); ?>">
                                    <i class="material-icons">person</i>
                                </a>
                            <?php endif; ?>

                            <a href="<?php echo e(route('project.staff.show',$staff->id)); ?>"
                               class="btn btn-info btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="left"
                               title="<?php echo e($labels['view'] ?? 'view'); ?>">
                                <i class="material-icons">pageview</i>
                            </a>

                            <a href="<?php echo e(route('project.staff.edit',$staff->id)); ?> "
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="left"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">edit</i>
                            </a>

                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"
                                    data-target="#delete<?php echo e($staff->id); ?>"
                                    data-tooltip="tooltip" data-placement="top"
                                    title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                <i class="material-icons">delete</i>
                            </button>

                        </td>
                    </tr>
                    <!--Modal -->
                    <div class="modal" id="delete<?php echo e($staff->id); ?>" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Delete Project Staff
                                        Confirmation</h4>
                                </div>
                                <?php echo Form::open(['method' => 'DELETE','route' => ['project.staff.destroy', $staff->id],'style'=>'display:inline']); ?>

                                <?php echo e(method_field('delete')); ?>

                                <?php echo e(csrf_field()); ?>

                                <div class="modal-body">
                                    <p class="text-center">
                                        Are you sure you want to delete this?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
                                    </button>
                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                </div>
                                <?php echo Form::close(); ?>


                            </div>
                        </div>
                    </div> <!-- End Modal -->

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>


        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('script'); ?>
            <script>
                $(document).ready(function () {
                    active_nev_link('staff-link');
                    DataTableCall('#table',6);
                })

            </script>
    <?php $__env->stopSection(); ?>



    <?php $__env->startSection('js'); ?>

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
            <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>