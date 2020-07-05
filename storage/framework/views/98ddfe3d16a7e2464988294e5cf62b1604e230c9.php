<?php $__env->startSection('css'); ?>
    <style>
        .sortable3,.sortable4,.sortable5 {
            /*background: #f8f9fa;*/
            /*padding: 10px;*/
            min-height: 400px;
            height: 200px;
            /*overflow-y: scroll;*/
            /*overflow-x: hidden;*/
            /*z-index: 99999;*/
        }
        .capital{
            text-transform: capitalize;

        }
        .main-activity{
            border-radius: 5px;
            padding: 5px;
            margin: 0px;
        }
        .c-black{
            color: #000;
            text-transform: capitalize;
        }
        .activity-title{
            color:#fff;
            line-height: 30px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(!empty($activities)): ?>
    <div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-tabs card-header-rose">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title"><?php echo e($pro->{'project_name_'.lang_character()} ?? ""); ?></span>

                </div>
            </div>
        </div>
        <input type="hidden" value="18" id="project_val_dash">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="profile">

                    <?php if(!empty($activities)): ?>
                        <?php $__currentLoopData = $activities->where("parent_id",0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-header-primary mt-1" style="background: none !important;">
                                <div class="row main-activity" style="background: <?php echo e($item->color ?? "#eee"); ?> !important;">
                                    <div class="col-md-10">
                                        <a class="activity-task-trigger activity-title"  href="#" data-acttype="0" data-actid="<?php echo e($item->id); ?>"><span style="font-size: 16px;"><?php echo e($item->{'activity_name_'.lang_character()} ?? ""); ?></span></a><br>
                                        <a class="activity-task-trigger" style="color:#fff;" href="#" data-acttype="0" data-actid="<?php echo e($item->id); ?>"><span><b class="c-black">planned started at :</b> <?php echo e(dateFormatSite($item->planed_start_date)); ?> <b class="c-black ml-5">planned end at :</b><?php echo e(dateFormatSite($item->planed_end_date)); ?>

                                          <span class="ml-5"> <strong class="c-black">Status :</strong>  <?php if($item->status_id == 1): ?>
                                                <?php echo e($labels['Not_started']??'Not_started'); ?>

                                            <?php elseif($item->status_id == 2): ?>
                                                <?php echo e($labels['Pending']??'Pending'); ?>

                                            <?php elseif($item->status_id == 3): ?>
                                                <?php echo e($labels['ongoing']??'ongoing'); ?>

                                            <?php elseif($item->status_id == 4): ?>
                                                <?php echo e($labels['Finished']??'Finished'); ?>

                                            <?php endif; ?></span>
                                           </span>
                                        </a>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <span><b class="c-black">Governorate :</b>
                                                    <?php if(sizeof($lists->where("activity_id",$item->id)) > 0): ?>
                                                        <?php $count=1; ?>
                                                        <?php $__currentLoopData = $lists->where("activity_id",$item->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php echo e($itm->{'city_name_'.lang_character()} ?? ""); ?>

                                                                <?php if($count != sizeof($lists->where("activity_id",$item->id))): ?>
                                                                ,
                                                                <?php endif; ?>

                                                            <?php $count++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span><b class="c-black" >Location :</b>
                                                     <?php if(sizeof($lists->where("activity_id",$item->id)) > 0): ?>
                                                        <?php $count2=1; ?>
                                                        <?php $__currentLoopData = $lists->where("activity_id",$item->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php echo e($itm->{'district_name_'.lang_character()} ?? ""); ?>

                                                            <?php if($count2 != sizeof($lists->where("activity_id",$item->id))): ?>
                                                                ,
                                                            <?php endif; ?>
                                                            <?php $count2++; ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="<?php echo e(route('activity.activity.create', ['main', $item->id])); ?>"
                                           class="btn btn-sm btn-rose btn-round btn-fab"
                                           data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                            <i class="material-icons">edit</i>
                                        </a>






                                        <a href="<?php echo e(route('activity.activity.create',['sub',$item->id,'create'])); ?>"
                                           class="btn btn-sm btn-rose btn-round btn-fab"
                                           data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['add'] ?? 'add'); ?>">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <ul>
                                            <?php if(!empty($activities->where("parent_id",$item->id))): ?>
                                                <?php $__currentLoopData = $activities->where("parent_id",$item->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="col-md-12 border p-3 mt-1 rounded" style="background: <?php echo e($sub->color ?? "#eee"); ?> !important;">
                                                        <div class="col-md-10 pull-left">
                                                            <a class="activity-task-trigger activity-title"  href="#" data-acttype="1" data-actid="<?php echo e($sub->id); ?>" ></a>
                                                            <a class="activity-task-trigger" style="color:#fff;" href="#" data-acttype="1" data-actid="<?php echo e($sub->id); ?>"><span><span><?php echo e($sub->{'activity_name_'.lang_character()} ?? ""); ?></span> <b class="c-black ml-2">planned started at :</b> <?php echo e(dateFormatSite($sub->planed_start_date)); ?> <b class="c-black ml-5">planned end at :</b><?php echo e(dateFormatSite($sub->planed_end_date)); ?>

                                          <span class="ml-5"> <strong class="c-black">Status :</strong>
                                              <?php if($sub->status_id == 1): ?>
                                                  <?php echo e($labels['Not_started']??'Not_started'); ?>

                                              <?php elseif($sub->status_id == 2): ?>
                                                  <?php echo e($labels['Pending']??'Pending'); ?>

                                              <?php elseif($sub->status_id == 3): ?>
                                                  <?php echo e($labels['ongoing']??'ongoing'); ?>

                                              <?php elseif($sub->status_id == 4): ?>
                                                  <?php echo e($labels['Finished']??'Finished'); ?>

                                              <?php endif; ?></span>
                                           </span></a>
                                                        </div>

                                                        <div class="col-md-2 pull-right">
                                                            <a href="<?php echo e(route('activity.activity.create', ['sub', $sub->id,'edit'])); ?>"
                                                               class="btn btn-sm btn-rose btn-round btn-fab"
                                                               data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                                                <i class="material-icons">edit</i>
                                                            </a>






                                                            <a href="<?php echo e(route('tasks.create',['activitySub',$sub->id])); ?>"
                                                               class="btn btn-sm btn-rose btn-round btn-fab"
                                                               data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['add'] ?? 'add'); ?>">
                                                                <i class="material-icons">add</i>
                                                            </a>

                                                        </div>
                                                        <br> <br>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>



            </div>
        </div>
    </div>

        <div class="card">
            <div class="card-header card-header-tabs card-header-rose">
                <span class="nav-tabs-title">Assignments</span>
                <a href="#" id="clear-task-zoho" class="btn btn-rose btn-sm btn-fab btn-round pull-right"
                   data-toggle="tooltip" data-placement="top"
                   title="<?php echo e($labels['refresh'] ?? 'refresh'); ?>">
                    <i class="fa fa-refresh"></i>
                </a>


            </div>
            <div class="card-body" style="overflow-y: scroll;overflow-x: unset;">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="col-md-4 pull-left text-center">
                            <div class="btn btn-rose btn-lg capital">To Do</div>
                        </div>
                        <div class="col-md-4 pull-left text-center">
                            <div class="btn btn-primary btn-lg capital">In Progress</div>
                        </div>
                        <div class="col-md-4 pull-left text-center">
                            <div class="btn btn-success btn-lg capital">Done</div>
                        </div>
                    </div>
                   <div class="col-md-8 m-auto" style="border-bottom: 2px solid #eee;"></div>
                    <div class="col-md-12 mt-3 all-task-sort">




























































































                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>