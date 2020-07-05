<div class="card sort-itm2" data-fileid="10" style="cursor: move;">
    <div class="card-header card-header-success  card-header-icon">
        <div class="row">
            <div class="col-md-8">
                <div class="card-icon p-1">
                    <h4 class="p-1 m-0 text-white"><?php echo e($labels_task['screen_tasks'] ?? 'task_name'); ?>

                        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary btn-sm btn-fab btn-round"
                           data-toggle="tooltip" data-placement="top"
                           title="<?php echo e($labels['add'] ?? 'add'); ?>">
                            <i class="material-icons">add</i>
                        </a>
                    </h4>
                </div>

            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn btn-sm btn-rose btn-round  btn-fab" id="task-min-page" style="display: none;">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-md-10" id="drawTaskMoreParent">
                            <div class="row" id="drawTaskMore">
                                <?php if(!empty($tasks)): ?>
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="card" style="border: 1px solid #43a047"><!--  card-stats-->
                                                <div class="card-header card-header-danger  card-header-icon mt-3">



                                                    <?php if(strlen($item->task_name ?? "") > 130): ?>
                                                        <a class="card-category extend-btn"  role="tooltip" data-placement="top"
                                                                title="<?php echo e($item->task_name ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->task_name ,0,130).'...'  ?? ""); ?></a>
                                                    <?php else: ?>
                                                        <p class="card-category"  style="text-align: center;"><?php echo e($item->task_name  ?? ""); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="text-center bolder" style="color: <?php echo e($item->status_color ?? "#eee"); ?>"><?php echo agendaStatus($item->task_status_id); ?></span>

                                                <div class="card-footer">
                                                    <a  href="<?php echo e(route('tasks.edit',$item->id)); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                                                        <i class="fa fa-cog"></i>
                                                    </a>






                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" value="1" id="task_paginate_val" />
                        </div>
                        <div class="col-md-1">
                            <button <?php if(sizeof($tasks) < 3): ?> style="display: none;" <?php endif; ?> class="btn btn-sm btn-rose btn-round  btn-fab " id="task-plus-page">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>































































































