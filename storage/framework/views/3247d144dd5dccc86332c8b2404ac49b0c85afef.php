<div class="card sort-itm2" data-fileid="7" style="cursor: move;">
<div class="card-header card-header-primary  card-header-icon">
        <div class="row">
            <div class="col-md-8">
                <div class="card-icon p-1">

                    <h4 class="p-1 m-0 text-white"><?php echo e($labels['projects']??'projects'); ?>

                        <a href="<?php echo e(route('project.project.create')); ?>" class="btn btn-secondary btn-sm btn-fab btn-round"
                           data-toggle="tooltip" data-placement="top"
                           title="<?php echo e($labels['add'] ?? 'add'); ?>">
                            <i class="material-icons">add</i>
                        </a>
                    </h4>
                </div>

            </div>
            <div class="col-md-4">
                <button class="btn dash btn-primary btn-sm float-direction" data-toggle="modal"
                 data-target="#modalDashboardProjectsFilter" role="tooltip" data-placement="top"
                 title="Filter Projects"><i class="fa fa-filter"></i></button>

                <button class="btn dash btn-primary btn-sm float-direction" id="clear-project-filter"
                         role="tooltip" data-placement="top"
                        title="clear Filter Projects"> <i class="fa fa-close"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">

                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn btn-sm btn-rose btn-round  btn-fab" data-filteron="0" id="project-min-page" style="display: none;">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-md-10" id="drawProjectMoreParent">
                            <div class="row" id="drawProjectMore">
                                <?php if(!empty($projects)): ?>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="card" style="border: 1px solid #9c27b0 !important;">
                                                <div class="card-header card-header-info  card-header-icon mt-3">



                                                    <?php if(strlen($item->{'project_name_'.lang_character()} ?? "") > 130): ?>
                                                    <a class="card-category extend-btn"  role="tooltip" data-placement="top"
                                                            title="<?php echo e($item->{'project_name_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'project_name_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
                                                    <?php else: ?>
                                                        <p class="card-category"  style="text-align: center;"><?php echo e($item->{'project_name_'.lang_character()}  ?? ""); ?></p>
                                                    <?php endif; ?>
                                                </div>

                                                <span class="text-center bolder status-card" style="border: 1px solid  <?php if($item->is_hidden == 0): ?> #4caf50 <?php else: ?> #F44336 <?php endif; ?>;color:  <?php if($item->is_hidden == 0): ?> #4caf50 <?php else: ?> #F44336 <?php endif; ?>"> <?php if($item->is_hidden == 0): ?> ongoing <?php else: ?> closed <?php endif; ?></span>
                                                <div class="row mt-2">
                                                    <div class="col-md-12 text-center" style="color:<?php if($item->is_hidden == 0): ?> #4caf50 <?php else: ?> #F44336 <?php endif; ?>">
                                                        <span><?php echo e(dateFormatSite($item->plan_start_date) ?? ""); ?> </span> - <span><?php echo e(dateFormatSite($item->plan_end_date) ?? ""); ?> </span>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a  href="<?php echo e(route('project.project.edit',$item->id)); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <a  href="<?php echo e(route('project.dashboard.index',$item->id)); ?>" class="btn btn-sm btn-primary btn-round  btn-fab">
                                                        <i class="fa fa-list"></i>
                                                    </a>
                                                    <table class="table">

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" value="1" id="project_paginate_val" />
                        </div>
                        <div class="col-md-1">
                            <?php if(!empty($projects)): ?>
                            <button <?php if(sizeof($projects) < 3): ?> style="display: none;" <?php endif; ?> data-filteron="0" class="btn btn-sm btn-rose btn-round  btn-fab " id="project-plus-page">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




























































