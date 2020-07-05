
<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                    <?php echo e($labels['edit_targeted_beneficiaries'] ??'edit_targeted_beneficiaries'); ?>

                </h4>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'project.project.targetedBeneficiaries.update' ,'novalidate'=>'novalidate','action'=>'put' ,'id'=>'formEditTargetedBeneficiaries' ]); ?>

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
                    <label for="level_id"
                           class="col-md-2 col-form-label"><?php echo e($labels["project_goals"]??"project_goals"); ?> </label>
                    <div class="col-md-10">
                        <div class="form-group has-default bmd-form-group">
                            <select data-live-search="true" class="form-control  selectpicker" name="level_id"
                                    data-style="btn btn-link" id="level_id">
                                <option value=" "></option>

                                <?php if(count($level_III)>0): ?>
                                    <optgroup label="level III">
                                        <?php $__currentLoopData = $level_III; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($level_id_selected==$key): ?> selected  <?php endif; ?> value="<?php echo e($key); ?>"><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if(count($level_IV)>0): ?>
                                            <optgroup label="level IV - Activities">

                                                <?php $__currentLoopData = $level_IV; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($level_id_selected==$key): ?> selected  <?php endif; ?>  value="<?php echo e($key); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </select>
                        </div>
                    </div>
                </div>

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