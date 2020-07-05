

<h4>
    <?php echo e($labels['total_hours']??'total_hours'); ?>

    <b style="color:#e91e63"><?php echo e($total_lgh_); ?></b>
    <?php echo e($labels['hours']??'hours'); ?>

</h4>
<br>
<p>
    <a class="btn btn-primary btn-sm" data-toggle="collapse" id="btn_collapse_loghour" href="#collapseExample"
       role="button" aria-expanded="false" aria-controls="collapseExample">

        <?php echo e($labels['details']??'details'); ?>

    </a>

    <?php if(in_array(Auth::id(),$staffs_in_task)): ?>

        <button class="btn btn-success btn-sm" id="btnAddLogHour" data-href="<?php echo e(route('tasks_loghour.create',$task_id)); ?>">
            <i class="material-icons">add</i>
            <?php echo e($labels['add_log_hour']??'add_log_hour'); ?>

        </button>
    <?php endif; ?>
</p>


<div class="collapse" id="collapseExample">
    <div style="border-collapse:separate;border-spacing:6px;">
        <?php
        $log_hours = array_values((array)$log_hours);
        for($i = 0;$i < count($log_hours);$i++)
        {
        ?>
        <br>
        <div style="background-color: #d8d8d8;cursor: pointer;" data-toggle="collapse"
             href="#collapseExample<?php echo e($log_hours[$i]['staff'][0]->id); ?>" role="button" aria-expanded="false"
             aria-controls="collapseExample2">
            <div style="padding:10px"><?php echo e($log_hours[$i]['staff'][0]->staff_name_na); ?><span style="margin-left:70px"><b
                            style="font-weight:600"><?php echo e($log_hours[$i]['total_log_hour']); ?></b>
                    <?php echo e($labels['hours']??'hours'); ?>

                </span></div>
        </div>
        <br>
        <div class="collapse" id="collapseExample<?php echo e($log_hours[$i]['staff'][0]->id); ?>"
             style="margin-<?php echo e(Auth::user()->lang_id == 1 ? 'left' : 'right'); ?>: 40px;">
            <table class="table">
                <?php  $lgh = array_values((array)$log_hours[$i]['log_hours'])[0];
                if(is_array($lgh) && count($lgh) > 0)
                {
                ?>
                <thead>
                <tr>
                    <th width="15%" class="text-center">
                        <?php echo e($labels['hours_no']??'hours_no'); ?>

                    </th>
                    <th width="15%" class="text-center">
                        <?php echo e($labels['date']??'date'); ?>

                    </th>
                    <th width="50%">
                        <?php echo e($labels['note']??'note'); ?>

                    </th>
                    <?php if(Auth::id() == $log_hours[$i]['staff'][0]->id): ?>
                        <th width="20%">
                            <?php echo e($labels['actions']??'actions'); ?>

                        </th>
                    <?php endif; ?>
                </tr>
                </thead>
                <?php } ?>
                <tbody>
                <?php
                if(is_array($lgh) && count($lgh) > 0)
                {
                foreach($lgh as $l){
                ?>
                <tr>
                    <td width="10%" class="text-center"><?php echo e($l->format_log_hour); ?></td>
                    <td width="20%" class="text-center"><?php echo e(date('d/m/Y',strtotime($l->log_date))); ?></td>
                    <td width="50%"><?php echo e($l->log_desc); ?></td>
                    <?php if(Auth::id() == $log_hours[$i]['staff'][0]->id || Auth::id() == 1): ?>
                        <td width="20%">
                            <button type="button" data-href="<?php echo e(route('tasks_loghour.edit',$l->id)); ?>"
                                    class="btn btn-sm btn-success btn-round btn-fab btnEditTaskLogHour"
                                    data-toggle="tooltip" data-placement="top"
                                    title=" <?php echo e($labels['edit']??'edit'); ?> ">
                                <i class="material-icons">edit</i>
                            </button>


                            <button type="button" data-href="<?php echo e(route('tasks_loghour.delete',$l->id )); ?>"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnLoghourTaskDelete"
                                    data-toggle="tooltip"
                                    data-placement="top" title="
                                       <?php echo e($labels['delete']??'delete'); ?> ">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php }
                }else {
                    echo 'No log hours found !';
                } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
        <br>
    </div>
</div>