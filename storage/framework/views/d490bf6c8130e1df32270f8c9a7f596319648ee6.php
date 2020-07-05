<?php if(!empty($opp_data_list)): ?>
    <?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header card-header-info  card-header-icon mt-3">



                    <?php if(strlen($item->{'project_name_'.lang_character()} ?? "") > 130): ?>
                        <a class="card-category extend-btn"  role="tooltip" data-placement="top" title="<?php echo e($item->{'project_name_'.lang_character()} ?? ""); ?>"  style="text-align: center;"><?php echo e(substr($item->{'project_name_'.lang_character()} ,0,130).'...'  ?? ""); ?></a>
                    <?php else: ?>
                        <p class="card-category"  style="text-align: center;"><?php echo e($item->{'project_name_'.lang_character()}  ?? ""); ?></p>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <a  href="<?php echo e(route('project.project.edit',$item->id)); ?>" class="btn btn-sm btn-rose btn-round  btn-fab">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a  href="<?php echo e(route('project.dashboard.index',$item->id)); ?>" class="btn btn-sm btn-primary btn-round  btn-fab">
                        <i class="fa fa-list"></i>
                    </a>



                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>