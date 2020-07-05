<div class="col-md-12">

    <?php if(in_array(1,$userDashboardBlocksSetting)): ?>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <p class="card-category"><?php echo e($labels_project['project']??'project'); ?></p>
                        <h3 class="card-title"><?php echo e($projects ? $projects->count() : 0); ?></h3>

                    </div>
                    <div class="card-footer">
                        <table class="table">
                            <tr>
                                <td><?php echo e($labels['ongoing']??'ongoing'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($projects ?  $projects->where('is_hidden',0)->count() : 0); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['closed']??'closed'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($projects ? $projects->where('is_hidden',1)->count() : 0); ?></b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <p class="card-category"><?php echo e($labels_activity['activities']??'activities'); ?></p>
                        <h3 class="card-title"><?php echo e($activities ? $activities->count() : 0); ?></h3>
                    </div>
                    <div class="card-footer">
                        <table class="table">
                            <tr>
                                <td><?php echo e($labels['Not_started']??'Not_started'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',1)->count() : 0); ?>

                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['Pending']??'Pending'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',2)->count() : 0); ?>

                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['ongoing']??'ongoing'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',3)->count() : 0); ?>

                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['Finished']??'Finished'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',4)->count() : 0); ?></b>
                                </td>
                            </tr>

                        </table>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">view_list</i>
                        </div>
                        <p class="card-category"><?php echo e($labels_task['screen_tasks'] ?? 'task_name'); ?></p>
                        <h3 class="card-title"><?php echo e($tasks ? $tasks->count() : 0); ?></h3>
                    </div>
                    <div class="card-footer">
                        <table class="table">
                            <tr>
                                <td style="font-size: 14px;"><?php echo e($labels['to_do']??'to_do'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',1)->count(): 0); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['In_Progress']??'In_Progress'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',2)->count(): 0); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e($labels['Done']??'Done'); ?></td>
                                <td>
                                    <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',3)->count(): 0); ?></b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(in_array(2,$userDashboardBlocksSetting)): ?>
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <h4 class="card-title text-direction  margin-right-100"><?php echo e($labels['projects']??'projects'); ?></h4>
                    </div>
                    <div class="col-md-4">
                        <button class="btn dash btn-primary btn-sm pull-right" data-toggle="modal"
                                data-target="#modalDashboardProjectsFilter" role="tooltip" data-placement="top"
                                title="Filter Projects"><i class="fa fa-filter"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 40%"><?php echo e($labels_project['project_name']??'project_name'); ?></th>
                                    <th style="width: 10%"><?php echo e($labels_project['Manager']??'Manager'); ?></th>
                                    <th style="width: 10%"><?php echo e($labels_project['deadline']??'deadline'); ?></th>
                                    <th style="width: 10%"><?php echo e($labels_project['status']??'status'); ?></th>
                                </tr>
                                </thead>
                                <tbody id="projects-list">
                                <?php if($projects): ?>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('project.project.show',$project->id)); ?>"><?php echo e($project->{'project_name_'.lang_character()}); ?></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('project.staff.edit',$project->manager_id)); ?>">
                                                    <img src="<?php echo e(!empty($project->manager->avatar_) ? asset('images/user/photo/').'/'.$project->manager->avatar_ : asset('assets/img/placeholder.png')); ?>"
                                                         style="width:40px;height:40px" class="team-staff"
                                                         data-toggle="tooltip" data-placement="top"
                                                         title="<?php echo e($project->manager ? $project->manager->{'staff_name_'.lang_character()} :" "); ?>"
                                                         data-original-title="Avatar">
                                                </a>
                                            </td>

                                            <td><?php echo e(date('d M, Y',strtotime($project->plan_end_date))); ?></td>
                                            <td><?php if($project->is_hidden ==0 ): ?><?php echo e($labels['ongoing']??'ongoing'); ?> <?php elseif($project->is_hidden ==1): ?> <?php echo e($labels['closed']??'closed'); ?><?php endif; ?></td>
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
    <?php endif; ?>

    <?php if(in_array(3,$userDashboardBlocksSetting)): ?>
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-icon">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <h4 class="card-title  text-direction  margin-right-100 "><?php echo e($labels['activity']??'activity'); ?></h4>
                    </div>
                    <div class="col-md-4">
                        <button id="btn-show-activities-filter-modal" class="btn dash btn-rose btn-sm pull-right"
                                data-toggle="tooltip" data-placement="top" title="Filter Activities"><i
                                    class="fa fa-filter"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 30%"> <?php echo e($labels_activity['activity_name']??'activity_name'); ?></th>
                                    <th style="width: 25%"><?php echo e($labels_activity['project_name']??'project_name'); ?></th>
                                    <th style="width: 15%"><?php echo e($labels_activity['completion_percent']??'completion_percent'); ?> %
                                    </th>
                                    <th style="width: 10%"><?php echo e($labels_activity['Deadline']??'Deadline'); ?> </th>
                                    <th style="width: 10%"><?php echo e($labels_activity['status']??'status'); ?></th>
                                    <th style="width: 5%"><?php echo e($labels_activity['sub_activity']??'sub_activity'); ?></th>
                                </tr>
                                </thead>
                                <tbody id="activities-list">
                                <?php if($activities): ?>
                                    <?php $__currentLoopData = $activities->where('parent_id', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('activity.activity.create',['main',$activity->id])); ?>"><?php echo e($activity->{'activity_name_'.lang_character()}); ?></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('project.project.edit',$activity->project->id)); ?>"><?php echo e($activity->project ?   $activity->project->{'project_name_'.lang_character()} :''); ?></a>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar l-slategray progress-<?php echo e(progressBarColor($activity->completion_percent)); ?>"
                                                         role="progressbar" aria-valuenow="29" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: <?php echo e($activity->completion_percent); ?>%;"></div>
                                                </div>
                                                <small>Completion with: <?php echo e($activity->completion_percent); ?>%</small>
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
                                            <td>
                                                <?php if($activity->subActivity->count() > 0): ?>
                                                    <a href="<?php echo e(route('activity.subActivity.index',['main_id' => $activity->id,'is_dash' => 1])); ?>"
                                                       rel="tooltip"
                                                       class="showSubActivity btn btn-sm   btn-round btn-info btn-fab"
                                                       rel="tooltip" data-original-title="" title="show sub activity"
                                                       data-placement="top" id="<?php echo e($activity->id); ?>">
                                                        <i class="material-icons">list_alt</i>
                                                    </a>
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
    <?php endif; ?>

    <?php if(in_array(3,$userDashboardBlocksSetting)): ?>
        <div class="card">
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
    <?php endif; ?>

    <?php if(in_array(4,$userDashboardBlocksSetting)): ?>
        <div class="card">
            <div class="card-header card-header-success card-header-icon">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-icon">
                            <i class="material-icons">view_list</i>
                        </div>
                        <h4 class="card-title"><?php echo e($labels_task['screen_tasks'] ?? 'task_name'); ?></h4>
                    </div>
                    <div class="col-md-4">
                        <!--<button class="btn dash btn-success btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Filter Tasks"><i class="fa fa-filter"></i></button> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>
                                        <?php echo e($labels_task['task_name'] ?? 'task_name'); ?>

                                    </th>
                                    <th>
                                        <?php echo e($labels_task['Deadline'] ?? 'Deadline'); ?>

                                    </th>
                                    <th>
                                        <?php echo e($labels_task['task_status'] ?? 'task_status'); ?>

                                    </th>
                                    <th>
                                        <?php echo e($labels_task['priority'] ?? 'priority'); ?>

                                    </th>
                                    <th>
                                        <?php echo e($labels_task['staff'] ?? 'staff'); ?>

                                    </th>
                                    <th>
                                        <?php echo e($labels_task['progress_percent'] ?? 'progress_percent'); ?>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($tasks): ?>
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <p class="p_task">
                                                    <a href="<?php echo e(route('tasks.edit',$task->id)); ?>"><?php echo e($task->task_name); ?></a>
                                                    <?php if($task->temp == 1): ?>
                                                        <span class="badge badge-danger"> Temp </span>
                                                    <?php endif; ?>
                                                </p>
                                                <small><?php echo e((Auth::user()->lang_id == 1) ? 'Starts at' : 'تبدأ في'); ?> <?php echo e(date('d M, Y',strtotime($task->start_date))); ?></small>
                                            </td>
                                            <td><?php echo e(date('d M, Y',strtotime($task->end_date))); ?></td>
                                            <td><?php echo agendaStatus($task->task_status_id); ?></td>
                                            <td><?php echo agendaPriority($task->task_priority_id); ?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <?php if($task->assigned_staffs): ?>
                                                        <?php $__currentLoopData = $task->assigned_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assigned_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li style="display: inline-block;">
                                                                <a href="<?php echo e(route('project.staff.edit',$assigned_staff['id'])); ?>">
                                                                    <img src="<?php echo e(!empty($assigned_staff['avatar_']) ? asset('images/user/photo/').'/'.$assigned_staff['avatar_'] : asset('assets/img/placeholder.png')); ?>"
                                                                         style="width:40px;height:40px"
                                                                         data-toggle="tooltip"
                                                                         data-placement="top"
                                                                         title="<?php echo e($assigned_staff['staff_name_'.lang_character()]  ? $assigned_staff['staff_name_'.lang_character()] : ''); ?>"
                                                                         data-original-title="Avatar">
                                                                </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar l-slategray progress-<?php echo e(progressBarColor($task->progress_percent)); ?>"
                                                         role="progressbar" aria-valuenow="29" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: <?php echo e($task->progress_percent); ?>%;"></div>
                                                </div>
                                                <small>Completion with: <?php echo e($task->progress_percent); ?>%</small>
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
    <?php endif; ?>

</div>

<?php if(in_array(6,$userDashboardBlocksSetting)): ?>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons"></i>
                </div>
                <h4 class="card-title">My Agenda</h4>
            </div>
            <div class="card-body">

                <a href="<?php echo e(route('agenda.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
                   data-toggle="tooltip" data-placement="top" title="Add New Agenda">
                    <i class="material-icons">add</i>
                </a>

                <div class="row">
                    <div class="col-md-12">
                        <div id="agendaCalendar"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(in_array(5,$userDashboardBlocksSetting)): ?>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons"></i>
                </div>
                <h4 class="card-title">System Logs</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <?php echo Form::open(['route' => 'dashboard.trans_logs.filter' ,'action'=>'post' ,'id'=>'formDashboardLogsFilter']); ?>


                            <div class="row">
                                <label for="staff_id" class="col-md-1 col-form-label">User</label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <select class='form-control selectpicker' data-live-search="true" name='user_id'
                                                data-style='btn btn-link' id='user_id'>
                                            <option style='height: 37px;' value></option>
                                            <?php if($users): ?>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user_->id); ?>"><?php echo e($user_->user_full_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <label for="staff_id" class="col-md-1 col-form-label">Trans Type</label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <select class='form-control selectpicker' name='trans_type[]'
                                                data-style='btn btn-link' multiple id="trans_type">
                                            <option style='height: 37px;' value=""></option>
                                            <option style='height: 37px;' value="1">Add</option>
                                            <option style='height: 37px;' value="2">Update</option>
                                            <option style='height: 37px;' value="3">Delete</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="staff_id" class="col-md-1 col-form-label">From Date</label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <input type='text' class='form-control datetimepicker' name='logs_from_date'
                                               id='logs_from_date' autocomplete="off" alt=''>
                                    </div>
                                </div>
                                <label for="staff_id" class="col-md-1 col-form-label">To Date</label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <input type='text' class='form-control datetimepicker' name='logs_to_date'
                                               id='logs_to_date' autocomplete="off" alt=''>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-logs-filter"
                                            class="btn btn-rose pull-center">
                                        Search
                                        <div class="loader pull-left" style="display: none;"></div>
                                    </button>
                                </div>
                            </div>

                            <?php echo Form::close(); ?>

                            <br><br>
                            <div align="center" style="display: none" id="loader-icon-a-logs" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>

                            <div id="table_logs"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>