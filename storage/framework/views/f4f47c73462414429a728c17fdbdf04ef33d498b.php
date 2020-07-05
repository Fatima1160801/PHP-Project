<?php echo Form::open(['route' => 'activity.main.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formActivityMainAdd']); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <label class="label label-default col-md-2 col-form-label"><?php echo e($labels['project_name'] ?? ''); ?> :</label>
        <label class="label label-success col-form-label" style=" font-size: 17px !important; background: #f4f4f4; padding: 5px; border-radius: 5px; "><?php echo e($project->{'project_name_'.lang_character()}); ?></label>
    </div>
</div>


<?php if($message != null): ?>
    <div class="alert alert-danger" style=" width: 100%; ">
        <?php echo e($message['text']); ?>

    </div>
<?php endif; ?>
<input type="hidden" name="project_id"  id="project_id"  value="<?php echo e($project->id); ?>">
<?php echo $html; ?>



<div class="col-md-12">

    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextLocation">
        <?php echo e($labels['next'] ?? 'next'); ?>

    </a>

    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="addActivityMain">
        <?php echo e($labels['save'] ?? 'save'); ?>


        <div class="loader pull-left" style="display: none;"></div>
    </button>


</div>

<?php echo Form::close(); ?>


<div id="formActivityMainAdd_rtr" data-serialize=""></div>
