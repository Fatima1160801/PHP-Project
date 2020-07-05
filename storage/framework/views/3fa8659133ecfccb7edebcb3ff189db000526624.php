
<?php echo Form::open(['route' => 'activity.subActivity.store' ,'action'=>'post' ,'id'=>'formSubActivity']); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php if($message != null): ?>
    <div class="alert alert-danger" style=" width: 100%; ">
        <?php echo e($message['text']); ?>

    </div>
<?php endif; ?>



<?php echo $html; ?>



<div class="col-md-12">

    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextLocation">
        <?php echo e($labels['next'] ?? 'next'); ?>

    </a>

    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="addActivitySub">
        <?php echo e($labels['save'] ?? 'save'); ?>

        <div class="loader pull-left" style="display: none;"></div>
    </button>


</div>


<?php echo Form::close(); ?>




