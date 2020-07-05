
<div class="modal-content group-permission-class">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">Group Permission</h4>
            </div>
        </div>
        <div class="modal-body">
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                    <div class="togglebutton switch-sidebar-mini">
                        <label class="text-dark">
                            <input user_id="<?php echo e($user->id); ?>" group-id="<?php echo e($group->id); ?>" type="checkbox"
                                   <?php echo e(\App\Models\Permission\GroupUser::checkUserGroup($user->id,$group->id)); ?> class="groupId default">

                            <span class="toggle te"></span>
                            <?php echo e($group->group_name); ?>


                    </label>
                    </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


