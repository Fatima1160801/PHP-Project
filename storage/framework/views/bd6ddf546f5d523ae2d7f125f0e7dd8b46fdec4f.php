<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>

        body {
            font-family: Arial, Helvetica, sans-serif, sans-serif;
        }
/*/*/

        body {
            font-family: 'Roboto','Cairo', sans-serif;
            font-size: 13px;
        }
        table {
            border-collapse: collapse;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
        }

        @page  {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>
<body dir="<?php echo e($dir); ?>">

    
        
    
    
        
    

<htmlpageheader name="page-header">
    <?php if($reportMasterUser->rep_orientation == 0 ): ?>
        <img src="<?php echo e(asset('images/user/photo/').'/'. \App\Models\Setting\Setting::headerPortrait()); ?>">
    <?php elseif($reportMasterUser->rep_orientation == 1): ?>
        <img src="<?php echo e(asset('images/user/photo/').'/'. \App\Models\Setting\Setting::headerLandscape()); ?>">
    <?php endif; ?>

</htmlpageheader>

<htmlpagefooter name="page-footer">
    <div class=""align="right">
        {PAGENO}
    </div>

</htmlpagefooter>


<table >
    <thead>
    <tr>
        <th>#</th>
        <?php $__currentLoopData = $reportDetailColumnsLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($label); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



        <?php if($data->plan_start_date): ?>
         <?php $data->plan_start_date = dateFormatSite($data->plan_start_date);

         ?>
        <?php endif; ?>
        <?php if( $data->plan_end_date): ?>
        <?php $data->plan_end_date = dateFormatSite($data->plan_end_date);
          ?>
        <?php endif; ?>
        <tr >
            <td width="30" align="center"><?php echo e($index+1); ?></td>
            <?php $__currentLoopData = $reportDetailColumnsNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columnsNames): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php if($columnsNames == 'planed_start_date' or $columnsNames == 'planed_end_date'
                or $columnsNames =='plan_end_date'  or $columnsNames =='act_start_date' or $columnsNames =='act_end_date' ): ?>
                     <td align="<?php echo e($reportDetailColumnsAlign[$columnsNames]); ?>" width="<?php echo e($reportDetailColumnsWidth[$columnsNames]); ?>" ><?php echo e(dateFormatSite($data->$columnsNames)); ?></td>
                <?php elseif($columnsNames =='planed_budget' or $columnsNames =='act_budget'): ?>
                    <td align="<?php echo e($reportDetailColumnsAlign[$columnsNames]); ?>" width="<?php echo e($reportDetailColumnsWidth[$columnsNames]); ?>"><?php echo e(round($data->$columnsNames,2)); ?></td>
                <?php else: ?>
                    <td  align="<?php echo e($reportDetailColumnsAlign[$columnsNames]); ?>" width="<?php echo e($reportDetailColumnsWidth[$columnsNames]); ?>"><?php echo e($data->$columnsNames); ?></td>
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
    </tbody>
</table>