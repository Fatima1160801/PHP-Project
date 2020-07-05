<!DOCTYPE html>
<html>
<head>
    <title>Pert Char</title>

    <style>
        table {
            border-collapse: collapse;
        }

        .table-m, .table-m th, .table-m td {
            border:1px solid #0000002e;
            padding: 3px;
        }
        .table, .table th, .table td {
            border: 1px solid #7e7e7e;
            padding: 3px;
        }
    </style>
</head>
<body>


<table class="table-m" align="center" style="width: 100%">
    <thead>
    <tr>

        <th colspan="<?php echo e($Project_period_count+1); ?>"><?php echo e($project->{'project_name_'.lang_character()}); ?></th>

    </tr>
    <tr>
        <th style="width:20%"><?php echo e($level_type_name); ?></th>
        <?php $__currentLoopData = $Project_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th style="width: <?php echo e(80/$Project_period_count); ?>%"><?php echo e($period); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>

    </thead>
    <tbody>


    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php

            $activities_new_count =$activities->where('level_id', $level->id)->count();
           if( $activities_new_count ==0)
           {$activities_new_count =1;}
        ?>

        <tr>
            <?php if($x = 1): ?>
                <td align="center" rowspan="<?php echo e($activities_new_count); ?>"><?php if($level_type == 2): ?><?php echo e($level->{'specific_objective_name_'.lang_character()}); ?><?php else: ?> <?php echo e($level->{'results_objective_name_'.lang_character()}); ?><?php endif; ?></td>
            <?php endif; ?>

            <?php

                $activities_new= $activities->where('level_id', $level->id);
                     if($activities_new->count()>0){
                          foreach($activities_new as $activity){
                             foreach($Project_period as $period){
                                if($activity->activity_period_start == $period){
                                  $print =  '<td style="background-color: #f8f8f85e;" colspan="'.$activity->activity_period_count.'" >';
                                    $print .=  '<table align="center" class="table"><tbody>';
                                     $print .= '<tr align="center"><td colspan="2">';
                                     $print .=$activity-> activity_name_na;
                                     $print .= '</td></tr>';
                                     $print .= '<tr align="center"><td>';
                                     $print .= $activity->serial_public;
                                      $print .= '</td><td>';
                                      $print .=$activity-> activity_load .' Days';
                                      $print .= '</td></tr>';


                                      $print .= '<tr align="center"><td>';
                                      $print .= dateFormatSite($activity->act_start_date);
                                      $print .= '</td><td>';
                                      $print .= dateFormatSite($activity->act_end_date);
                                      $print .= '</td></tr>';

                                      $print .= '<tr align="center"><td colspan="2">';
                                      $ActivityStaffVW  = \App\Models\Activity\ActivityStaffVW::getStaffByActivity($activity->id);
  $staff = "";
foreach ($ActivityStaffVW as $Activity){
if(strlen($staff) > 0)
$staff .=',';
  $staff .= $Activity->{'staff_name_'.lang_character()};
}
                                     $print .=$staff;
                                     $print .= '</td></tr>';



                                     $print .= '</tbody></table>';
                                     $print .= '</td>';
                                   echo   $print;
                                  }
                                else{
                                    if(is_array($activity->activity_period)){
                                      if(!in_array($period,$activity->activity_period)){
                                           echo '<td>  </td>';

                                        }
                                     }

                             }
                           }
                            echo '</tr> <tr>';
                         }
                    } else{
                         foreach($Project_period as $period){
                             echo '<td> </td>';
                          }
                    }
            ?>
        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>