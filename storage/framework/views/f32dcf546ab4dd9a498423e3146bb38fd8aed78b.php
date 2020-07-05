<div class="col-lg-4 col-md-6 col-sm-6 sort-itm" data-fileid="6" style="cursor: move;">
    <div class="card card-stats">
        <div class="card-header card-header-info m-auto card-header-icon force-m-t">
            <div class="card-icon">
                <span class="card-category parg-white"><?php echo e($labels_task['proposals_statistics'] ?? 'Proposals'); ?> ( <?php echo e($proposal_statistic ? $proposal_statistic : 0); ?> )</span>
            </div>


        </div>
        <div class="card-footer">
            <table class="table">
                <?php if(!empty($proposal_statistic_no)): ?>
                    <?php $__currentLoopData = $proposal_statistic_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $color="#0da528"; ?>
                        <?php if($item->id==1): ?>
                            <?php $color="#ff9800"?>
                        <?php elseif($item->id==2): ?>
                            <?php $color="#0da528" ?>
                        <?php elseif($item->id==3): ?>
                            <?php $color="#4e8250" ?>
                        <?php else: ?>
                            <?php $color="red" ?>
                        <?php endif; ?>
                        <tr>
                            <td style="font-size: 14px;color:<?php echo e($color??"green"); ?>"><?php echo e($item ? $item->{'proposal_status_'.lang_character()} : ""); ?></td>
                            <td>
                                <b style="font-size: 18px;font-weight: 500;"><?php echo e($item->count_status ? $item->count_status: 0); ?></b>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>