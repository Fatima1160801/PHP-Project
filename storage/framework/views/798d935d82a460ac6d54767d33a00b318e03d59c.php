<?php if(!empty($opp_data_list)): ?>
<?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-3">
    <div class="card">
        <div class="card-header card-header-info  card-header-icon mt-3">



            <?php if(strlen($item->task_name ?? "") > 130): ?>
                <a class="card-category extend-btn"  role="tooltip" data-placement="top"
                   title="<?php echo e($item->task_name ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->task_name ,0,130).'...'  ?? ""); ?></a>
            <?php else: ?>
                <p class="card-category"  style="text-align: center;"><?php echo e($item->task_name  ?? ""); ?></p>
            <?php endif; ?>
        </div>
        <span class="text-center" style="color: <?php echo e($item->status_color ?? "#eee"); ?>"><?php echo agendaStatus($item->task_status_id); ?></span>

        <div class="card-footer">
            <a  href="" class="btn btn-sm btn-rose btn-round  btn-fab">
                <i class="fa fa-cog"></i>
            </a>
            <a  href="" class="btn btn-sm btn-primary btn-round  btn-fab">
                <i class="fa fa-list"></i>
            </a>
            <table class="table">

            </table>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>