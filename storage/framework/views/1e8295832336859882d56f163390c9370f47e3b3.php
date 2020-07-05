<?php echo Form::open(['route' => 'project.donors.store' ,'action'=>'post' ,'novalidate'=>'novalidate','id'=>'formEditDonor','enctype'=>'multipart/form-data']); ?>

<?php echo e(csrf_field()); ?>

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


<div class="">
    <div class="ml-auto mr-auto">

    </div>
</div>


<div class="col-md-12">

    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextDonorContact">
        <?php echo e($labels['next'] ?? 'next'); ?>

    </a>

    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="updateDonor">

        <?php echo e($labels['save'] ?? 'save'); ?>

        <div class="loader pull-left" style="display: none;"></div>
    </button>

    <a href="<?php echo e(route('project.donors.index')); ?>" class="btn  btn-default  btn-sm pull-left" id="">
        <?php echo e($labels['back'] ?? 'back'); ?>

    </a>

</div>


<?php echo Form::close(); ?>





