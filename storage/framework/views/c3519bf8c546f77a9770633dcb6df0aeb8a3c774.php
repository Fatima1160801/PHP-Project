<div class="card sort-itm2" data-fileid="9" style="cursor: move;">
    <div class="card-header card-header-rose card-header-icon">
        <div class="row">
            <div class="col-md-12">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title  text-direction  margin-right-100 "><?php echo e($labels['activities_delay']??'activities_delay'); ?></h4>
            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 30%"> <?php echo e($labels_activity['activity_name']??'activity_name'); ?></th>
                            <th style="width: 25%"><?php echo e($labels_activity['project_name']??'project_name'); ?></th>
                            <th style="width: 10%"><?php echo e($labels_activity['Deadline']??'Deadline'); ?> </th>
                            <th style="width: 10%"><?php echo e($labels_activity['status']??'status'); ?></th>
                        </tr>
                        </thead>
                        <tbody id="activities-list">
                        <?php if($acivities_delay): ?>
                            <?php $__currentLoopData = $acivities_delay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('activity.activity.create',['main',$activity->id])); ?>"><?php echo e($activity->{'activity_name_'.lang_character()}); ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('project.project.edit',$activity->project_id)); ?>"><?php echo e($activity->{'project_name_'.lang_character()}); ?></a>
                                    </td>
                                    <td><?php echo e(date('d M, Y',strtotime($activity->planed_end_date))); ?></td>
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
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>