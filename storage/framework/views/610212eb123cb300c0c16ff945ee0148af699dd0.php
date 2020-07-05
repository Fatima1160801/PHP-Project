

<input type="hidden" id="flag_reload_index_staff" value="0">
<br>
<br>
<?php if(isset($project->staffManager)): ?>
    <div class="alert alert-info" style="background-color: #f4f4f4;color: #000;     margin-bottom: 25px;">
        <span>  Manager  :<?php echo e($project->staffManager->{'staff_name_'.lang_character()}); ?>  </span>
    </div>
<?php endif; ?>
<div class="row" >

    <?php if(isset($projectStaffs) &&$projectStaffs->count()<=0): ?>
        <tr align="center">
            <td colspan="4">
                <p>Data Not Found</p>
            </td>
        </tr>
    <?php endif; ?>

    <div class="col-md-3" id="staff" style="padding-top: 48px;">
        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px #9c27b07a;">

            <a style="height: inherit" href="<?php echo e(route('project.project.staff.create')); ?>" style="display: inline-block" rel="tooltip" data-toggle="modal" data-target="#modalStaff"
               data-original-title="" title="<?php echo e($labels['add'] ?? 'add'); ?>"
               data-placement="top" id="AddStaff">
                <div class="card-body" style="height: 210px;">

                    <br><br><br>
                    <h1 class="card-title" style="color:#9c27b0;"><i class="material-icons" style="font-size: 38px;">add</i></h1>
                    <p class="card-description">
                    </p>
                </div>
            </a>
        </div>
    </div>

    <?php if($projectStaffs != null): ?>

        <?php $__currentLoopData = $projectStaffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



            <div class="col-md-3" style=" margin-top: 35px; " id="staff_<?php echo e($staff->staff_id); ?>">
                <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                    <div class="card-avatar" style=" background: #ffff; ">
                        <a href="#pablo">

                            <?php if($staff->staff): ?>
                                <img class="img" src="<?php echo e(asset('images/user/photo').'/'.$staff->staff->avatar_); ?>" style="width: 100px;height:100px">
                            <?php else: ?>
                                <img style="width: 100px;height:100px" src="<?php echo e(asset('assets/img/placeholder.png')); ?>" />
                            <?php endif; ?>

                        </a>
                    </div>
                    <div class="card-body" style="text-align: center">
                        <h6 class="card-category text-gray"><?php echo e($staff->getTitleJobNameById($staff->job_title_id)); ?></h6>
                        <h4 class=" text-align-center">
                            <?php echo e($staff->staff ? $staff->staff->{'staff_name_'.lang_character()}: ''); ?></h4>
                        <p class="card-description">
                        </p>

                        <a href="<?php echo e(route('project.staff.edit',$staff->staff_id)); ?>" class="btn btn-sm btn-info btn-round btn-fab" rel="tooltip" data-original-title="" title="Show Profile">
                            <i class="material-icons">person_outline</i>
                        </a>

                        <a href="<?php echo e(route('project.project.staff.edit',[$staff->project_id ,$staff->staff_id])); ?>" rel="tooltip" class="btn btn-sm btn-success  btn-round   btn-fab"
                           data-toggle="modal" data-target="#modalStaff"
                           rel="tooltip" data-original-title="" title="<?php echo e($labels['edit'] ?? 'edit'); ?>"
                           data-placement="top" id="EditStuff">
                            <i class="material-icons">edit</i>
                        </a>

                        <a data-id="<?php echo e($staff->staff_id); ?>" href="<?php echo e(route('project.project.stuff.delete',[$staff->project_id ,$staff->staff_id])); ?>"
                           id="btnDeleteStuff" rel="tooltip" class="btn btn-sm btn-danger btn-fab btn-round"
                           title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>

</div>




