<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">work</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['job_title'] ?? 'job_title'); ?>


            </h4>
        </div>
        <div class="card-body ">


            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="6">
                        <a href="<?php echo e(route('project.jobtitle.create')); ?>"
                           class="btn btn-sm btn-sm btn-primary btn-round btn-fab"
                           data-toggle="tooltip" data-placement="top"
                           title=" <?php echo e($labels['add'] ?? 'add'); ?>">
                            <i class="material-icons">add
                            </i>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['job_title_enghlish'] ?? 'job_title_enghlish'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['job_title_rabic'] ?? 'job_title_rabic'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['job_title_status'] ?? 'job_title_status'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['used_status'] ?? 'used_status'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $jobtitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$jobtitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($jobtitle->job_title_name_na); ?></td>
                        <td><?php echo e($jobtitle->job_title_name_fo); ?></td>
                        <td>
                            <?php echo activeLabel($jobtitle->is_hidden ); ?>

                        </td>
                        <td>
                            <?php echo is_inside_outside($jobtitle->is_inside_outside); ?>



                        </td>
                        <td>
                            <a href="<?php echo e(route('project.jobtitle.edit',$jobtitle->id)); ?>"
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">edit</i>
                            </a>

                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"
                                    data-target="#delete<?php echo e($jobtitle->id); ?>"
                                    data-tooltip="tooltip" data-placement="top"
                                    title="<?php echo e($labels['delete'] ?? 'delete'); ?>"

                            >
                                <i class="material-icons">delete</i>
                            </button>
                            <?php echo Form::close(); ?>


                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal" id="delete<?php echo e($jobtitle->id); ?>" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Delete Job Title
                                        Confirmation</h4>
                                </div>
                                <?php echo Form::open(['method' => 'DELETE','route' => ['project.jobtitle.destroy', $jobtitle->id],'style'=>'display:inline']); ?>

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
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('job_title');
            DataTableCall('#table',6);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>