<div class="card sort-itm2" data-fileid="11" style="cursor: move;">
    <div class="card-header card-header-secondary  card-header-icon">
        <div class="row">
            <div class="col-md-8">
                <div class="card-icon p-1">
                    <h4 class="p-1 m-0 text-white"><?php echo e($labels['opportunity_list']??'Opportunity'); ?>

                        <a href="<?php echo e(route('opportunity.opportunity.create')); ?>" class="btn btn-rose btn-sm btn-fab btn-round"
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
                            <button class="btn btn-sm btn-rose btn-round  btn-fab" id="opp-min-page" style="display: none;">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-md-10" id="drawOppMoreParent">
                            <div class="row" id="drawOppMore">
                                <?php if(!empty($opp_data_list)): ?>
                                    <?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header card-header-danger  card-header-icon mt-3">




                                                    <?php if(strlen($item->{'subject_'.lang_character()} ?? "") > 130): ?>
                                                        <a class="card-category extend-btn"  role="tooltip" data-placement="top"
                                                                title="<?php echo e($item->{'subject_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'subject_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
                                                    <?php else: ?>
                                                        <p class="card-category"  style="text-align: center;"><?php echo e($item->{'subject_'.lang_character()}  ?? ""); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="text-center bolder status-card" style="border: 1px solid <?php echo e($item->status_color ?? "#eee"); ?>;color: <?php echo e($item->status_color ?? "#eee"); ?>"><?php echo e($item->statusInfo ? $item->statusInfo->{'opportunity_status_'.lang_character()} : ""); ?></span>

                                                <div class="card-footer">
                                                    <a  href="<?php echo e(route('opportunity.opportunity.edit',$item->id)); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                                                        <i class="fa fa-cog"></i>
                                                    </a>






                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                            </div>
                            <input type="hidden" value="1" id="opp_paginate_val" />
                        </div>
                        <div class="col-md-1">
                            <button <?php if(sizeof($opp_data_list) < 3): ?> style="display: none;" <?php endif; ?> class="btn btn-sm btn-rose btn-round  btn-fab " id="opp-plus-page">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>