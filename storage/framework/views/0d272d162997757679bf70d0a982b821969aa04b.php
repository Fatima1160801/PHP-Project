<?php echo Form::open(['route' => 'project.project.storeprojectmain','novalidate'=>'novalidate','action'=>'post' ,'id'=>'formProjectMain','class'=>'row']); ?>

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
<?php if( $project->userCreate): ?>
    <div class="col-md-12 opp-progress-approve-reject" id="fill-opp-progress-approve-reject">
        <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-right mr-5">
            <?php echo e($labels['created_by'] ?? 'created_by'); ?> :
            <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;">   <?php echo e($project->userCreate->user_full_name); ?></span>
        </h6>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>



<?php echo $html; ?>



<div class='col-md-6'>
    <div class='row'>
        <label for='beneficiaries_type_id' class='col-md-4 col-form-label'>
            <?php echo e($labels['beneficiaries_type'] ?? 'beneficiaries_type'); ?>

        </label>
        <div class='col-md-8'>
            <div class='form-group has-default bmd-form-group'>
                <?php echo Form::select('beneficiaries_type_id[]',$beneficiaries_type ,$beneficiaries_type_Selected,['class'=>'form-control  selectpicker','data-style'=>'btn btn-link','multiple'=>'multiple','required'=>'required'] ); ?>

            </div>
        </div>
    </div>
</div>


<div class='col-md-6'>
    <div class='row'>
        <label for='city_id' class='col-md-4 col-form-label'>
            <?php echo e($labels['city'] ?? 'city'); ?>

        </label>
        <div class='col-md-8'>
            <div class='form-group has-default bmd-form-group'>
                <?php echo Form::select('city_id[]',$cities ,$cities_Selected,['class'=>'form-control  selectpicker','data-style'=>'btn btn-link','multiple'=>'multiple'] ); ?>

            </div>
        </div>
    </div>
</div>



<div class="col-md-12">

    
    
    

    
    
    
    <a href="#" class="btn btn-next btn-rose btn-sm pull-right" id="nextProjectMain">
        <?php echo e($labels['next'] ?? 'next'); ?>

    </a>

    <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right" id="saveProjectMain">
        <?php echo e($labels['save'] ?? 'save'); ?>

        <div class="loader pull-left" style="display: none;"></div>
    </button>

    <a href="<?php echo e(route('project.project.index')); ?>" class="btn btn-sm   btn-default pull-left" id="nextProjectMain">
        <?php echo e($labels['back'] ?? 'back'); ?>


    </a>

</div>



<?php echo Form::close(); ?>



<div id="formProjectMain_rtr" data-serialize=""></div>
