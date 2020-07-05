
<table class="table" >

    <tbody>

    <?php $__currentLoopData = $subActivty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>

            <td><?php echo e($index +1); ?></td>
            <td><?php echo e($sub->activity_name_na); ?></td>
            <td>
            <td>
                <?php if($sub->status_id == 1): ?>
                    <?php echo e($labels['Not_started']??'Not_started'); ?>

                <?php elseif($sub->status_id == 2): ?>
                    <?php echo e($labels['Pending']??'Pending'); ?>

                <?php elseif($sub->status_id == 3): ?>
                    <?php echo e($labels['ongoing']??'ongoing'); ?>

                <?php elseif($sub->status_id == 4): ?>
                    <?php echo e($labels['Finished']??'Finished'); ?>

                <?php endif; ?>
            </td>

            </td>
            <td>

                <a href="<?php echo e(route('activity.completion_percent',$sub->id)); ?>" rel="tooltip"
                   class=" "
                   data-toggle="modal" data-target="#modalCompletionPercent"
                   rel="tooltip" data-original-title=""
                   title="<?php echo e($labels['completion_percent'] ?? 'completion_percent'); ?>"
                   data-placement="top" completion-percent="completion_percent<?php echo e($sub->id); ?>" id="AddCompletionPercent">


                    <div class="row completion">
                        <div class="col-md-8" style="padding-top: 8px;">
                            <div class="progress progress-line-primary">
                                <div id="completion_percent<?php echo e($sub->id); ?>" class="progress-bar progress-bar-primary"
                                     role="progressbar"
                                     aria-valuenow="<?php echo e($sub->completion_percent); ?>" aria-valuemin="0" aria-valuemax="100"
                                     style="width: <?php echo e($sub->completion_percent); ?>%;">
                                    <span class="sr-only"><?php echo e($sub->completion_percent); ?> Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="completion_percent_text<?php echo e($sub->id); ?>">
                                        <span class="badge badge-secondary">
                                  <?php echo e($sub->completion_percent); ?> %
                                        </span>
                        </div>
                    </div>
                </a>
            </td>
            <td>
                <a href="<?php echo e(route('activity.activity.create',['sub',$sub->id,'edit'])); ?>" rel="tooltip"
                   class="btn btn-sm   btn-round btn-success btn-fab"
                   rel="tooltip" data-original-title="" title="Edit Sub Activity"
                   data-placement="top" id="EditSubActivity">
                    <i class="material-icons">edit</i>
                </a>

                <a target="_blank" href="<?php echo e(route('tasks.create',['activitySub',$sub->id])); ?>"
                   class="btn btn-sm btn-default btn-round btn-fab"
                   data-toggle="tooltip" data-placement="top"
                   title="<?php echo e($labels['add_task'] ?? 'add_task'); ?>">
                    <i class="material-icons">assignment</i>
                </a>


            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

