<?php if(!empty($opp_data_list)): ?>
    <?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon mt-3">




                    <?php if(strlen($item->{'subject_'.lang_character()} ?? "") > 130): ?>
                        <a class="card-category extend-btn"  role="tooltip" data-placement="top" title="<?php echo e($item->{'subject_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'subject_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
                    <?php else: ?>
                        <p class="card-category"  style="text-align: center;"><?php echo e($item->{'subject_'.lang_character()}  ?? ""); ?></p>
                    <?php endif; ?>
                </div>
                <span class="text-center bolder status-card" style=" border: 1px solid <?php echo e($item->status_color ?? "#eee"); ?>;color: <?php echo e($item->status_color ?? "#eee"); ?>"><?php echo e($item->statusInfo ? $item->statusInfo->{'concept_status_'.lang_character()} : ""); ?></span>

                <div class="card-footer">
                    <a  href="<?php echo e(route('concept.concept.edit',$item->id)); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                        <i class="fa fa-cog"></i>
                    </a>






                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>