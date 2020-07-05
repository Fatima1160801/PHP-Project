<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title"> <?php echo e($labels['screen_add_donor'] ?? 'screen_add_donor'); ?></h4>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'project.project.donors.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formDonorsCreate']); ?>

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



            <input type="hidden" value="<?php echo e($project_donor_amount); ?>" name="project_donor_amount" id="project_donor_amount" >
            <input type="hidden" value="<?php echo e($type); ?>" name="type" id="type_donor_partner" >

            <div class="col-md-12">

                <button  btn="btnToggleDisabled"] id="btnDonorAdd" type="submit" class="btn btn-next btn-rose pull-right">
                    <?php echo e($labels['save'] ?? 'save'); ?>

                    <div class="loader pull-left" style="display: none;">  </div>
                </button>
            </div>


            <?php echo Form::close(); ?>

        </div>
    </div>
</div>


