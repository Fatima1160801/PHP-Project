
<div class="modal fade" id="modalDashboardSettings" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Dashboard Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Choose the blocks that you want to be shown in your dashboard.</p>
                    <?php echo Form::open(['route' => 'dashboard_settings.save' ,'action'=>'post' ,'id'=>'formDashboardSettings']); ?>

                    <?php $__currentLoopData = $dashboardBlocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="togglebutton switch-sidebar-mini">
                                <label class="text-dark">
                                    <input name="block_<?php echo e($block->id); ?>" block-id="<?php echo e($block->id); ?>" type="checkbox" <?php echo e(in_array($block->id,$userDashboardBlocksSetting) ? 'checked' : ''); ?> class="groupId default">
                                    <span class="toggle te"></span>
                                    <?php echo e($block->block_name); ?>

                                </label>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <button type="submit" id="btn-dashboard-settings-save" class="btn btn-rose pull-right">
                            <?php echo e($labels['save'] ?? 'save'); ?>

                            <div class="loader pull-left" style="display: none;"></div>
                        </button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalDashboardProjectsFilter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Filter Projects</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['route' => 'dashboard.projects.filter.new' ,'action'=>'post' ,'id'=>'formDashboardProjectsFilter']); ?>


                    <div class="row">
                        <label class="col-md-3 col-form-label" for="is_hidden">Project Status</label>
                        <div class="col-md-4">
                            <div class="form-group has-default bmd-form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_open" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Open
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_closed" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Closed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">Program</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' data-live-search="true" name='program_id' data-style='btn btn-link'
                                        id='program_id'>
                                    <option style='height: 37px;' value></option>
                                    <?php if($programs): ?>
                                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($program->id); ?>"><?php echo e(Auth::user()->lang_id == 1 ? $program->program_name_na : $program->program_name_fo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">By Date</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' name='by_date' data-style='btn btn-link' id="by_date">
                                    <option style='height: 37px;' value=""></option>
                                    <option style='height: 37px;' value="l3m">Last 3 Months</option>
                                    <option style='height: 37px;' value="l6m">Last 6 Months</option>
                                    <option style='height: 37px;' value="ly">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-4">
                            <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-projects-filter" class="btn btn-rose pull-center">
                                 Search
                                <div class="loader pull-left" style="display: none;"></div>
                            </button>
                        </div>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDashboardActivitiesFilter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Filter Projects</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['route' => 'dashboard.activities.filter.new' ,'action'=>'post' ,'id'=>'formDashboardActivitiesFilter']); ?>


                    <div class="row">
                        <label class="col-md-3 col-form-label" for="is_hidden">Activity Status</label>
                        <div class="col-md-4">
                            <div class="form-group has-default bmd-form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_open" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Open
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_closed" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Closed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">Project</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' data-live-search="true" name='project_id' data-style='btn btn-link' id='project_id'>
                                    <option style='height: 37px;' value></option>
                                    <?php if($projects_all): ?>
                                        <?php $__currentLoopData = $projects_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($project_->id); ?>"><?php echo e(Auth::user()->lang_id == 1 ? $project_->project_name_na : $project_->project_name_fo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">By Date</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' name='by_date' data-style='btn btn-link' id="by_date">
                                    <option style='height: 37px;' value=""></option>
                                    <option style='height: 37px;' value="l3m">Last 3 Months</option>
                                    <option style='height: 37px;' value="l6m">Last 6 Months</option>
                                    <option style='height: 37px;' value="ly">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-4">
                            <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-activities-filter" class="btn btn-rose pull-center">
                                Search
                                <div class="loader pull-left" style="display: none;"></div>
                            </button>
                        </div>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>