<input type="hidden" id="flag_reload_index_staff" value="0">
<br><br>

<div class="row">
    <div class="col-md-12">
        <?php echo Form::open(['route' => 'activity.staff.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAddValue']); ?>


        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <label for='activity_staff_id' class='col-md-2 col-form-label'>

                        
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            <select class="form-control  selectpicker" required id="staff_id"
                                    name="staff_id" data-style="btn btn-link">
                                <option value="" style="height: 30px"></option>
                                <?php if($staffs->count()>0): ?>
                                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($st->id); ?>"><?php echo e($st->{'staff_name_'.lang_character()}); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <option value=""></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" btn="btnToggleDisabled" class="btn btn-rose btn-md btn-sm">
                    <div class="loader pull-left" style="display: none;"></div>
                    <?php echo e($labels['save']??'save'); ?>

                </button>

            </div>
        </div>
        <?php echo Form::close(); ?>


    </div>
</div>
<br>
<div class="row" id="activityStaffRow" style="padding-top: 50px">
    <?php echo $__env->make('activity.staff.row', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="row">
    <div class="col-md-12">

        <a href="#" class="btn btn-previous btn-default btn-sm pull-left" id="previous-location-tab">
            <?php echo e($labels['previous']??'previous'); ?>

        </a>


        <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextLessons">
            <?php echo e($labels['next']??'next'); ?>

        </a>
    </div>
</div>






