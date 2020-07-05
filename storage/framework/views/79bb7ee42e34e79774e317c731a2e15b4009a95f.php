<style>
    <?php $__currentLoopData = $activities_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e('.gant_color_' . $actd->id . '{margin-top: 1px;opacity: 0.9;height: 13px; background: ' . $actd->gant_color.';}'.
        '.gant_color_' . $actd->id.'complete' . '{float: left;overflow: hidden;height: 5px;opacity: 0.4;margin-top: 4px; background: ' . $actd->gant_comp_color.';}'); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</style>
<div class="card-body">

    <div id="result-msg"></div>
    <link rel="stylesheet" href="<?php echo e(asset('css/jsgantt.css')); ?>">
    <script src="<?php echo e(asset('js/jsgantt.js')); ?>"></script>

    <div style="position:relative ;direction: ltr !important;" class="gantt" id="GanttChartDIV"></div>

    <script type="text/javascript">
        var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'), 'week');
        if (g.getDivId() != null) {
            g.setCaptionType('Complete');  // Set to Show Caption (None,Caption,Resource,Duration,Complete)
            g.setQuarterColWidth(36);
            g.setDateTaskDisplayFormat('day dd month yyyy'); // Shown in tool tip box
            g.setDayMajorDateDisplayFormat('mon yyyy - Week ww') // Set format to display dates in the "Major" header of the "Day" view
            g.setWeekMinorDateDisplayFormat('dd mon') // Set format to display dates in the "Minor" header of the "Week" view
            g.setShowTaskInfoLink(1); // Show link in tool tip (0/1)
            g.setShowEndWeekDate(0); // Show/Hide the date for the last day of the week in header for daily view (1/0)
            g.setUseSingleCell(10000); // Set the threshold at which we will only use one cell per table row (0 disables).  Helps with rendering performance for large charts.
            g.setFormatArr('Day', 'Week', 'Month', 'Quarter'); // Even with setUseSingleCell using Hour format on such a large chart can cause issues in some browsers
            // Parameters                     (pID, pName,                  pStart,       pEnd,        pStyle,         pLink (unused)  pMile, pRes,pComp, pGroup, pParent, pOpen, pDepend, pCaption, pNotes, pGantt)
            <?php foreach($activities_data as $activity){
                   if($by_date == 'a' && $activity->act_start_date != null && $activity->act_start_date != ''){ ?>
            g.AddTaskItem(new JSGantt.TaskItem('<?php echo e($activity->id); ?>',   '<?php echo e($activity->{'activity_name_'.lang_character()}); ?>','<?php echo e(date('Y-m-d',strtotime($by_date == 'a' ? $activity->act_start_date : $activity->planed_start_date))); ?>', '<?php echo e(date('Y-m-d',strtotime($by_date == 'a' ? $activity->act_end_date : $activity->planed_end_date))); ?>','<?php echo e('gant_color_'.$activity->id); ?>', '','<?php echo e($activity->is_start_milestone); ?>','<?php echo e($activity->{'staff_name_'.lang_character()}); ?>','<?php echo e($activity->completion_percent); ?>','<?php echo e($activity->parent_id == 0 ? 1 : 0); ?>','<?php echo e($activity->parent_id); ?>',1,'<?php echo e($activity->depend_activity_id); ?>','','<?php echo e($activity->notes); ?>', g ));
            <?php  } elseif($by_date == 'p'){ ?>
            g.AddTaskItem(new JSGantt.TaskItem('<?php echo e($activity->id); ?>',   '<?php echo e($activity->{'activity_name_'.lang_character()}); ?>','<?php echo e(date('Y-m-d',strtotime($by_date == 'a' ? $activity->act_start_date : $activity->planed_start_date))); ?>', '<?php echo e(date('Y-m-d',strtotime($by_date == 'a' ? $activity->act_end_date : $activity->planed_end_date))); ?>','<?php echo e('gant_color_'.$activity->id); ?>', '','<?php echo e($activity->is_start_milestone); ?>','<?php echo e($activity->{'staff_name_'.lang_character()}); ?>','<?php echo e($activity->completion_percent); ?>','<?php echo e($activity->parent_id == 0 ? 1 : 0); ?>','<?php echo e($activity->parent_id); ?>',1,'<?php echo e($activity->depend_activity_id); ?>','','<?php echo e($activity->notes); ?>', g ));
            <?php  }

            } ?>

            g.Draw();

        } else {
            alert("Error, unable to create Gantt Chart");
        }
    </script>

</div>