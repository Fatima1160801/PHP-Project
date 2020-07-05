<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                    <?php echo e($screen_name); ?>

                </h4>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'activity.location.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLocationCreate']); ?>

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

                <button id="btnLocationAdd" btn="btnToggleDisabled" type="submit"
                        class="btn btn-next btn-rose pull-right btn-sm">
                    <?php echo e($labels['save'] ?? 'save'); ?>

                    <div class="loader pull-left" style="display: none;">  </div>
                </button>
            </div>


            <?php echo Form::close(); ?>

        </div>
    </div>
</div>


