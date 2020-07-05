<table>
    <thead>
    <tr>
        <th colspan="<?php echo e(count($reportDetailColumnsLabels)); ?>"><?php echo e($reportMasterUser->rep_label); ?></th>
    </tr>
    <tr>
        <?php $__currentLoopData = $reportDetailColumnsLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($label); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php $__currentLoopData = $reportDetailColumnsNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnsNames): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($columnsNames == 'planed_start_date' or $columnsNames == 'planed_end_date'
                or $columnsNames =='plan_end_date' or $columnsNames =='act_start_date' or $columnsNames =='act_end_date'or $columnsNames =='date' ): ?>
                    <td class="text-center"><?php echo e(dateFormatSite($data->$columnsNames)); ?></td>
                <?php elseif($columnsNames =='planed_budget' or $columnsNames =='act_budget'): ?>
                    <td class="text-center"><?php echo e(round($data->$columnsNames,2)); ?></td>
                <?php else: ?>
                    <td class="text-center"><?php echo e($data->$columnsNames); ?></td>
                <?php endif; ?>

                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <?php $__currentLoopData = $reportDetailColumnsNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnsNames): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($columnsNames ,$reportDetailColumnsAggregationSum)): ?>
                <td>
                    <?php echo e($report_data->sum($columnsNames)); ?>

                </td>
            <?php elseif(in_array($columnsNames ,$reportDetailColumnsAggregationCount)): ?>
                <td>
                    <?php echo e($report_data->count($columnsNames)); ?>

                </td>
            <?php else: ?>
                <td></td>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    //
    </tbody>
</table>