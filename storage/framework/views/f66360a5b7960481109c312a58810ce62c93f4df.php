<br>
 <h4>
     <?php echo e($labels['StaffsProgressReports']??'StaffsProgressReports'); ?>

 </h4>



<div class="summernote-code">

</div>

<div class="form-group row">
    <label class="col-md-2 label-control"></label>
    <div class="col-md-10">
        <div class="summernote-code">

        </div>
    </div>
</div>
<a class="btn btn-primary btn-round btn-fab btn-sm"
   href="<?php echo e(route('task_progress_report.create',$task_id)); ?>"
   data-toggle="tooltip" data-placement="top" title=""
   data-original-title="  <?php echo e($labels['AddReport']??'AddReport'); ?>">
    <i class="material-icons">add</i>
</a>
<br>
<table class="table">
    <thead>
    <tr>
        <th>
            <?php echo e($labels['ReportTitle']??'ReportTitle'); ?>

        </th>
        <th>
            <?php echo e($labels['Staff']??'Staff'); ?>


        </th>
        <th>
            <?php echo e($labels['Addedat']??'Addedat'); ?>

        </th>
        <th>
            <?php echo e($labels['actions']??'actions'); ?>

        </th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $progress_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progress_report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($progress_report->rep_name); ?></td>
        <td><a href="<?php echo e(route('project.staff.edit',$progress_report->staff_id)); ?>">
                <?php echo e(Auth::user()->lang_id == 1 ? $progress_report->staff->staff_name_na : $progress_report->staff->staff_name_fo); ?>

            </a></td>
        <td><?php echo e(date('d/m/Y H:i A',strtotime($progress_report->created_at))); ?></td>
        <?php if(Auth::id() == $progress_report->staff_id || Auth::id() == 1): ?>
            <td>
                <a href="<?php echo e(route('task_progress_report.edit',$progress_report->id)); ?>"
                        class="btn btn-sm btn-success btn-round btn-fab"
                        data-toggle="tooltip" data-placement="top"
                        title=" <?php echo e($labels['edit']??'edit'); ?> ">
                    <i class="material-icons">edit</i>
                </a>
                <button type="button" data-href="<?php echo e(route('task_progress_report.delete',$progress_report->id )); ?>"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTaskProgReportDelete"
                        data-toggle="tooltip"
                        data-placement="top" title="
                                       <?php echo e($labels['delete']??'delete'); ?> ">
                    <i class="material-icons">delete</i>
                </button>
            </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

