<table class="table" id="table">
    <thead>
    <tr>
        <th width="2%">#</th>
        <th width="15%">
            <?php echo e($labels['activity_name'] ?? 'activity_name'); ?>

        </th>
        <th width="8%">
            <?php echo e($labels['planed_start_date'] ?? 'planed_start_date'); ?>

        </th>
        <th width="8%">
            <?php echo e($labels['planed_end_date'] ?? 'planed_end_date'); ?>

        </th>
        <th width="8%">
            <?php echo e($labels['act_start_date'] ?? 'act_start_date'); ?>

        </th>
        <th width="8%">
            <?php echo e($labels['act_end_date'] ?? 'act_end_date'); ?>

        </th>
        <th width="8%">
            <?php echo e($labels['status'] ?? 'status'); ?>

        </th>
        <th width="17%">
            <?php echo e($labels['completion_percent'] ?? 'completion_percent'); ?>

        </th>


        <th width="20%">
            <?php echo e($labels['actions'] ?? 'actions'); ?>

        </th>
    </tr>

    </thead>
    <tbody>

    <?php if($activities != null): ?>

        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index+1); ?></td>
                <td><?php echo e($activity->{'activity_name_'.lang_character()}); ?>


                    <?php if($activity->temp == 1): ?>
                        <span class=" badge badge-danger">
                                    Temp
                              </span>
                    <?php endif; ?>
                </td>
                <td><?php echo e(dateFormatSite($activity->planed_start_date)); ?></td>
                <td><?php echo e(dateFormatSite($activity->planed_end_date)); ?></td>
                <td><?php echo e(dateFormatSite($activity->act_start_date)); ?></td>
                <td><?php echo e(dateFormatSite($activity->act_end_date)); ?></td>
                <td>
                    <?php if($activity->status_id == 1): ?>
                        <?php echo e($labels['Not_started']??'Not_started'); ?>

                    <?php elseif($activity->status_id == 2): ?>
                        <?php echo e($labels['Pending']??'Pending'); ?>

                    <?php elseif($activity->status_id == 3): ?>
                        <?php echo e($labels['ongoing']??'ongoing'); ?>

                    <?php elseif($activity->status_id == 4): ?>
                        <?php echo e($labels['Finished']??'Finished'); ?>

                    <?php endif; ?>
                </td>

                <td>
                    <?php if($activity->subActivity->count() > 0): ?>
                        <div class="row completion">
                            <div class="col-md-8" style="padding-top: 8px;">
                                <div class="progress progress-line-primary">
                                    <div id="completion_percent<?php echo e($activity->id); ?>"
                                         class="progress-bar progress-bar-primary" role="progressbar"
                                         aria-valuenow="<?php echo e($activity->completion_percent); ?>"
                                         aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: <?php echo e($activity->completion_percent); ?>%;">
                                                    <span class="sr-only"><?php echo e($activity->completion_percent); ?>

                                                        Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="completion_percent_text<?php echo e($activity->id); ?>">
                                        <span class="badge badge-secondary">
                                            <?php echo e($activity->completion_percent); ?> %
                                        </span>
                            </div>
                        </div>
                    <?php else: ?>

                        <a href="<?php echo e(route('activity.completion_percent',$activity->id)); ?>" rel="tooltip"
                           class=" "
                           data-toggle="modal" data-target="#modalCompletionPercent"
                           rel="tooltip" data-original-title=""
                           title="<?php echo e($labels['completion_percent'] ?? 'completion_percent'); ?>"
                           data-placement="top"
                           completion-percent="completion_percent<?php echo e($activity->id); ?>"
                           id="AddCompletionPercent">

                            <div class="row completion">
                                <div class="col-md-8" style="padding-top: 8px;">
                                    <div class="progress progress-line-primary">
                                        <div id="completion_percent<?php echo e($activity->id); ?>"
                                             class="progress-bar progress-bar-primary"
                                             role="progressbar"
                                             aria-valuenow="<?php echo e($activity->completion_percent); ?>"
                                             aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width: <?php echo e($activity->completion_percent); ?>%;">
                                                    <span class="sr-only"><?php echo e($activity->completion_percent); ?>

                                                        Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="completion_percent_text<?php echo e($activity->id); ?>">
                                        <span class="badge badge-secondary">
                                            <?php echo e($activity->completion_percent); ?> %
                                        </span>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                </td>
                <td>
                    
                    
                    
                    
                    
                    

                    <a href="<?php echo e(route('activity.activity.create',['main',$activity->id])); ?>"
                       class="btn btn-sm   btn-round btn-success btn-fab"
                       rel="tooltip" title="<?php echo e($labels['edit'] ?? 'edit'); ?>" data-placement="top"
                       id="EditActivity">

                        <i class="material-icons">edit</i>
                    </a>


                    <a href="<?php echo e(route('activity.activity.create',['sub',$activity->id,'create'])); ?>"
                       rel="tooltip" class="btn btn-sm   btn-round btn-rose btn-fab"
                       title="<?php echo e($labels['add_sub_activity'] ?? 'add_sub_activity'); ?>"
                       data-placement="top"
                       id="EditActivity">
                        <i class="material-icons">add</i>
                    </a>
                    <a href="<?php echo e(route('activity.main.destroy',$activity->id)); ?>"
                       class="btn btn-sm btn-round btn-danger btn-fab"
                       rel="tooltip" title="<?php echo e($labels['deletactivity'] ?? 'deletactivity'); ?>"
                       data-placement="top"
                       id="btnDeleteActivity">
                        <i class="material-icons">delete</i>
                    </a>

                    
                    
                    
                    
                    
                    
                    
                    
                    

                    <?php if($activity->subActivity->count() > 0): ?>

                        <a href="<?php echo e(route('activity.subActivity.index',$activity->id)); ?>"
                           class="showSubActivity btn btn-sm   btn-round btn-info btn-fab"
                           rel="tooltip" title="<?php echo e($labels['sub_activity'] ?? 'sub_activity'); ?>"
                           data-placement="left"
                           id="<?php echo e($activity->id); ?>">
                            <i class="material-icons">list_alt</i>
                        </a>
                    <?php endif; ?>

                    <?php if($activity->act_start_date == null || empty($activity->act_start_date)): ?>
                        <button href="<?php echo e(route('activity.activity.start_actually',$activity->id)); ?>"
                                class="start-activity-actually btn btn-sm  btn-round btn-tumblr btn-fab"
                                rel="tooltip" title="<?php echo e($labels['startactivity'] ?? 'startactivity'); ?>"
                                data-placement="top" data-id="<?php echo e($activity->id); ?>">
                            <i class="material-icons">done</i>
                        </button>
                    <?php endif; ?>


                </td>

            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>

    </tbody>

</table>
