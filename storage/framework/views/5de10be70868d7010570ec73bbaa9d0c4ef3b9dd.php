<div class="loader m-auto p-2"></div>
<br>
<div  class="col-md-4 pull-left sortable3 menu-task-list3">

    <?php if(sizeof($task_list->where("task_status_id",1)) >0): ?>
        <?php $__currentLoopData = $task_list->where("task_status_id",1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="cursor:move;" class="col-md-12  text-center task-item-div" data-fileid="<?php echo e($item1->id); ?>">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <div class="card card-stats" style="background: <?php echo e($item1->parent_color ?? "#eee"); ?>">

                        <div class="card-footer">
                            <p class="card-category text-center" style="color:#000;"><?php echo e($item1->task_name ?? ""); ?></p>
                            <a href="<?php echo e(route('tasks.edit',$item1->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"
                               data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">settings</i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


</div>
<div  class="col-md-4 pull-left sortable4 menu-task-list4">

    <?php if(sizeof($task_list->where("task_status_id",2))> 0): ?>
        <?php $__currentLoopData = $task_list->where("task_status_id",2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div style="cursor:move;" class="col-md-12  text-center task-item-div" data-fileid="<?php echo e($item2->id); ?>">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-stats" style="background: <?php echo e($item2->parent_color ?? "#eee"); ?>">
                        <div class="card-footer">
                            <p class="card-category text-center" style="color:#000;"> <?php echo e($item2->task_name ?? ""); ?></p>
                            <a href="<?php echo e(route('tasks.edit',$item2->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"
                               data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">settings</i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


</div>
<div  class="col-md-4 pull-left sortable5 menu-task-list5">
    <?php if(sizeof($task_list->where("task_status_id",3)) > 0): ?>
        <?php $__currentLoopData = $task_list->where("task_status_id",3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="cursor:move;" class="col-md-12  text-center task-item-div" data-fileid="<?php echo e($item3->id); ?>">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-stats" style="background: <?php echo e($item3->parent_color ?? "#eee"); ?>">

                        <div class="card-footer">
                            <p class="card-category text-center" style="color:#000;"><?php echo e($item3->task_name ?? ""); ?></p>
                            <a href="<?php echo e(route('tasks.edit',$item3->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"
                               data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">settings</i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>

<?php $__env->startSection('js'); ?>




















    <?php $__env->stopSection(); ?>