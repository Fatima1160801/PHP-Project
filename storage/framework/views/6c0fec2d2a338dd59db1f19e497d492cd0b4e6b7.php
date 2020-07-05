<?php $__env->startSection('content'); ?>



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
    <?php echo e($screenName_add); ?>

                <br>
                <?php echo e($screenName); ?></h4>
        </div>
        <div class="card-body ">


            <?php echo Form::open(['route' => 'goals.sub.store' ,'action'=>'post'  ,'novalidate'=>'novalidate','id'=>'formGoalsSubCreate']); ?>

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



            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="<?php echo e(route('goals.main.index.table')); ?>" class="btn btn-default btn-sm">
                            <?php echo e($labels['back']??'back'); ?>

                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">
                            <?php echo e($labels['save']??'save'); ?>

                        </button>
                    </div>
                </div>
            </div>


            <?php echo Form::close(); ?>

        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <td>#</td>
                        <td>
                            <?php echo e($labels['sub_goals']??'sub_goals'); ?>

                        </td>
                        <td>
                            <?php echo e($labels['actions']??'actions'); ?>

                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $goalsSubByMain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index+1); ?></td>
                            <td><?php echo e($goal->goal_name_na); ?></td>
                            <td>
                                <a href="<?php echo e(route('goals.sub.edit',$goal->id)); ?>" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab"
                                   rel="tooltip" data-original-title="" title="<?php echo e($labels['edit_sub_goals']??'edit_sub_goals'); ?>  "
                                   data-placement="top" id="EditGoals">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            funValidateForm();
        });
        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>