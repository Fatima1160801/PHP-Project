<?php if(isset($activityStaff) && $activityStaff->count()<=0): ?>
    <tr align="center">
        <td colspan="4">
            <p>Data Not Found</p>
        </td>
    </tr>
<?php endif; ?>




<?php $__currentLoopData = $activityStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$astaff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="col-md-3" id="staff_<?php echo e($astaff->id); ?>">
        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="img" src="<?php echo e(!empty($astaff->staff->avatar_) ? asset('images/user/photo').'/'.$astaff->staff->avatar_ : asset('images/user/photo/1542457195.png')); ?>" style="width:100px;height:100px">
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray"><?php echo e($astaff->staff->jobTitle->{'job_title_name_'.lang_character()}); ?></h6>
                <h4 class="card-title"><?php echo e($astaff->staff->{'staff_name_'.lang_character()}); ?></h4>
                <p class="card-description">
                </p>

                <a href="<?php echo e(route('project.staff.edit',$astaff->staff_id)); ?>" class="btn btn-sm btn-info btn-round btn-fab" rel="tooltip" data-original-title="" title="Show Profile">
                    <i class="material-icons">person_outline</i>
                </a>

                
                   
                   
                   
                    
                

                <a data-id="<?php echo e($astaff->id); ?>" href="<?php echo e(route('activity.staff.destroy',$astaff->id)); ?>"
                   id="btnDeleteActivityStuff" rel="tooltip" class="btn btn-sm btn-danger btn-fab btn-round"
                   title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                    <i class="material-icons">delete</i>
                </a>
            </div>
        </div>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




<script>
    $(document).ready(function () {
        selectpicker();
    })
</script>