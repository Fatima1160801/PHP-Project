
<tr data-id="<?php echo e($user->id); ?>">
    <td><?php echo e(isset($loop->iteration) ? $loop->iteration : '{index}'); ?></td>
    <td class="width45 sorting_1">
        <img src="<?php echo e(!empty($user->user_photo) ? asset('images/user/photo/').'/'.$user->user_photo : asset('assets/img/placeholder.jpg')); ?>" class="rounded-circle avatar" style="width:40px;height:40px"alt="">
    </td>
    <td>
        <h6 class="mb-0"><?php echo e($user->user_full_name); ?></h6>
        <span><?php echo e($user->email); ?></span>
    </td>
    <td><?php echo e($user->user_name); ?></td>
    <td><?php echo e($user->job_title); ?></td>
    <td>
        <?php $__currentLoopData = $user->group_user()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="badge badge-secondary">
                                    <?php echo e($group->group()->first()->group_name); ?>

                              </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <a href="#" user_id="<?php echo e($user->id); ?>" id="addGroupToUser"
           class="btn btn-primary btn-fab btn-sm btn-fab-mini btn-round"
           data-toggle="modal" data-target="#modalUserGroup"
           rel="tooltip" data-original-title="" title="Grant Group">
            <i class="material-icons">settings</i>
        </a>
    </td>
    <td class="td-actions text-center">

        <a href="#" user-id="<?php echo e($user->id); ?>"
           class="btn btn-danger btn-sm  btn-round user-status-id" id="user-status-id"


        <?php if($user->user_status_id == 1): ?>
           rel="tooltip" data-original-title="" title="lock" status="1"

        <?php elseif($user->user_status_id == 3): ?>
           rel="tooltip" data-original-title="" title="un lock" status="3"
        <?php endif; ?>
        >
            <?php if($user->user_status_id == 1): ?>
                <i class="material-icons">lock_open</i>
            <?php elseif($user->user_status_id == 3): ?>
                <i class="material-icons">lock</i>
            <?php endif; ?>
        </a>



        <a href="<?php echo e(route('permission.user.edit',$user->id)); ?>" rel="tooltip"
           class="btn btn-success btn-sm  btn-round" data-original-title="" title="Edit User">
            <i class="material-icons">edit</i>
        </a>

        <a href="<?php echo e(route('permission.permission.index',['user',$user->id])); ?>" rel="tooltip"
           class="btn btn-info btn-sm  btn-round" data-original-title="" title="Grant Permission">
            <i class="material-icons">vpn_key</i>
        </a>


        <?php if($user->staff != null): ?>
            <a href="<?php echo e(route('project.staff.edit',$user->staff->id)); ?>"
               rel="tooltip" class="btn btn-rose btn-round"
               data-original-title="" title="Staff">
                <i class="material-icons">person_outline</i>
            </a>
        <?php endif; ?>
    </td>
</tr>