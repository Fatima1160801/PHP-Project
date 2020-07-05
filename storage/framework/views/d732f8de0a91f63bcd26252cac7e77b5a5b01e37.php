<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">business_center
                </i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_edit_donor_types']??'screen_edit_donor_types'); ?>

            </h4>

        </div>


        <?php echo Form::open(['route' => 'project.donors.types.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAdd']); ?>


        <div class="card-body ">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php echo e(method_field('PUT')); ?>

            <?php echo $html; ?>


            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="<?php echo e(route('project.donors.types.index')); ?>"
                       class="btn btn-sm btn-default pull-left">
                        <?php echo e($labels['back'] ?? 'back'); ?>

                    </a>
                    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveDonor">
                        <?php echo e($labels['edit'] ?? 'edit'); ?>

                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            <?php echo Form::close(); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('donor_types');

            $('.selectpicker').selectpicker();

            funValidateForm();
        })

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

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>