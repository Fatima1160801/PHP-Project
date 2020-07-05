

<input type="hidden" id="flag_reload_index_staff" value="0">
<br>
<br>
<?php if(isset($project->staffManager)): ?>
<div class="alert alert-info" style="background-color: #f4f4f4;color: #000;     margin-bottom: 25px;">
    <span>  Manager  : <?php echo e($project->staffManager->{'staff_name_'.lang_character()}); ?>  </span>
 </div>
<?php endif; ?>
<div class="row"  >


    <?php if(isset($projectStaffs) &&$projectStaffs->count()<=0): ?>
        <tr align="center">
            <td colspan="4">
                <p>Data Not Found</p>
            </td>
        </tr>
    <?php endif; ?>


    <?php if($projectStaffs != null): ?>

        <?php $__currentLoopData = $projectStaffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


            <div class="col-md-3" id="staff_<?php echo e($staff->staff_id); ?>" style="padding-top: 48px;">
                <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <img class="img" src="<?php echo e(!empty($staff->avatar) ? asset('images/user/photo').'/'.$staff->avatar : asset('assets/img/image_placeholder.jpg')); ?>" style="width: 100px;height:100px">
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray"><?php echo e($staff->getTitleJobNameById($staff->job_title_id)); ?></h6>
                        <h4 class="card-title"><?php echo e($staff->staff->{'staff_name_'.lang_character()}); ?></h4>
                        <p class="card-description">
                        </p>
                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>

</div>




