<?php if(!empty($opp_data_list)): ?>
    <?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header card-header-secondary  card-header-icon  mt-3">




                    <?php if(strlen($item->{'activity_name_'.lang_character()} ?? "") > 130): ?>
                        <a class="card-category extend-btn"  role="tooltip" data-placement="top" title="<?php echo e($item->{'activity_name_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'activity_name_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
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
                <div class="card-footer">
                    <a  href="<?php echo e(route('activity.activity.create', ['main', $item->id])); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                        <i class="fa fa-cog"></i>
                    </a>






                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>