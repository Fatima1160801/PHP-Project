<div class="card sort-itm2" data-fileid="8" style="cursor: move;">
    <div class="card-header card-header-rose  card-header-icon">
        <div class="row">
            <div class="col-md-8">
                <div class="card-icon p-1">
                    <h4 class="p-1 m-0 text-white"><?php echo e($labels['activity']??'activity'); ?>

                        <a href="<?php echo e(route('activity.mainActivity.index')); ?>" class="btn btn-secondary  btn-sm btn-fab btn-round"
                           data-toggle="tooltip" data-placement="top"
                           title="<?php echo e($labels['add'] ?? 'add'); ?>">
                            <i class="material-icons">add</i>
                        </a>
                    </h4>
                </div>







            </div>
            <div class="col-md-4">
                <button id="btn-show-activities-filter-modal" class="float-direction btn dash btn-rose btn-sm "
                        data-toggle="tooltip" data-placement="top" title="Filter Activities"><i
                            class="fa fa-filter"></i></button>

                <button class="btn dash btn-rose btn-sm float-direction" id="clear-activity-filter"
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
                            <button class="btn btn-sm btn-rose btn-round  btn-fab" id="activity-min-page" style="display: none;">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-md-10" id="drawActivityMoreParent">
                            <div class="row" id="drawActivityMore">
                                <?php if(!empty($activities)): ?>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="card" style="border: 1px solid #e91e63 !important;" >
                                                <div class="card-header card-header-secondary card-header-icon  mt-3">




                                                    <?php if(strlen($item->{'activity_name_'.lang_character()} ?? "") > 130): ?>
                                                        <a class="card-category extend-btn"  role="tooltip" data-placement="top"
                                                                title="<?php echo e($item->{'activity_name_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'activity_name_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
                                                    <?php else: ?>
                                                        <p class="card-category"  style="text-align: center;"><?php echo e($item->{'activity_name_'.lang_character()}  ?? ""); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <span style="color:  <?php if($item->status_id == 1): ?> #FF9800 <?php elseif($item->status_id == 2): ?> #999 <?php elseif($item->status_id == 3): ?> #009688 <?php elseif($item->status_id == 4): ?> #F44336 <?php endif; ?>;
                                                        border: 1px solid   <?php if($item->status_id == 1): ?> #FF9800 <?php elseif($item->status_id == 2): ?> #999 <?php elseif($item->status_id == 3): ?> #009688 <?php elseif($item->status_id == 4): ?> #F44336 <?php endif; ?>;"
                                                      class="text-center bolder status-card">
                                                    <?php if($item->status_id == 1): ?>
                                                        <?php echo e($labels['Not_started']??'Not_started'); ?>

                                                    <?php elseif($item->status_id == 2): ?>
                                                        <?php echo e($labels['Pending']??'Pending'); ?>

                                                    <?php elseif($item->status_id == 3): ?>
                                                        <?php echo e($labels['ongoing']??'ongoing'); ?>

                                                    <?php elseif($item->status_id == 4): ?>
                                                        <?php echo e($labels['Finished']??'Finished'); ?>

                                                    <?php endif; ?>
                                                    </span>

                                                <div class="row mt-2">
                                                    <div class="col-md-12 text-center" style="color:  <?php if($item->status_id == 1): ?> #FF9800 <?php elseif($item->status_id == 2): ?> #999 <?php elseif($item->status_id == 3): ?> #009688 <?php elseif($item->status_id == 4): ?> #F44336 <?php endif; ?>;">
                                                        <span><?php echo e(dateFormatSite($item->planed_start_date) ?? ""); ?> </span> - <span><?php echo e(dateFormatSite($item->planed_end_date) ?? ""); ?> </span>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <a  href="<?php echo e(route('activity.activity.create', ['main', $item->id])); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                                                        <i class="fa fa-cog"></i>
                                                    </a>






                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" value="1" id="activity_paginate_val" />
                        </div>
                        <div class="col-md-1">
                            <?php if(!empty($activities)): ?>
                            <button <?php if(sizeof($activities) < 3): ?> style="display: none;" <?php endif; ?> class="btn btn-sm btn-rose btn-round  btn-fab " id="activity-plus-page">
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






















































































