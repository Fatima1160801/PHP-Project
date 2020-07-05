

<div class="material-datatables">
    <div class="table-responsive">
        <table class="table  table-sm table-bordered table-responsive" id="table">
            <thead class="thead-light">
            <tr>
                <?php $__currentLoopData = $reportDetailUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <th   class="text-center " style="width:200px !important;"><?php echo e($rdu->column_label); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            </thead >
            <tbody id="report-data-list">
            <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr >
                    <?php $__currentLoopData = $reportDetailUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $name=$rdu->column_name ?>
                    <?php if($name == 'planed_start_date' or $name == 'planed_end_date'
                    or $name =='plan_end_date'  or $name =='act_start_date' or $name =='act_end_date'or $name =='date' ): ?>
                            <td class="text-center"><?php echo e(dateFormatSite($data->$name)); ?></td>
                        <?php elseif($name =='planed_budget' or $name =='act_budget'): ?>
                            <td class="text-center"><?php echo e(round($data->$name,2)); ?></td>
                        <?php else: ?>
                            <td class="text-center" ><?php echo e($data->$name); ?></td>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
