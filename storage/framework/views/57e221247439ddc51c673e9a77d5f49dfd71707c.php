<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title"><?php echo e($labels['edit_staff'] ??'edit_staff'); ?></h4>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'project.project.staff.update' ,'novalidate'=>'novalidate','action'=>'put' ,'id'=>'formStaffEdit' ]); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <input type="hidden" name="old_staff_id" id="old_staff_id" value="<?php echo e($data->staff_id); ?>">

            <?php echo $html; ?>



            <div class="col-md-12">

                <button id="btnStaffEdit" type="submit" class="btn btn-next btn-rose pull-right btn-sm" btn="btnToggleDisabled">
                    <?php echo e($labels['edit'] ?? 'edit'); ?>

                    <div class="loader pull-left" style="display: none;">  </div>
                </button>
            </div>


            <?php echo Form::close(); ?>

        </div>
    </div>
</div>


