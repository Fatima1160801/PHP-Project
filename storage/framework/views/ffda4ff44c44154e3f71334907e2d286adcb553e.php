<div class="col-lg-4 col-md-6 col-sm-6 sort-itm" data-fileid="3" style="cursor: move;">
    <div class="card card-stats">
        <div class="card-header card-header-success m-auto card-header-icon force-m-b force-m-t">
            <div class="card-icon">
                <span class="card-category parg-white"><?php echo e($labels_task['screen_tasks'] ?? 'task_name'); ?> ( <?php echo e($projects ? $projects->count() : 0); ?> )</span>


            </div>


        </div>
        <div class="card-footer">
            <table class="table">
                <tr>
                    <td style="font-size: 14px;"><?php echo e($labels['to_do']??'to_do'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',1)->count(): 0); ?></b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['In_Progress']??'In_Progress'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',2)->count(): 0); ?></b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['Done']??'Done'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($tasks ? $tasks->where('task_status_id',3)->count(): 0); ?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>