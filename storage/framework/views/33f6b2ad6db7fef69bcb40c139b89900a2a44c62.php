<?php if(!empty($opp_data_list)): ?>
    <?php $__currentLoopData = $opp_data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-primary  card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">view_list</i>
                    </div>

                    <p class="card-category"  style="text-align: left;"><?php echo e($item->{'subject_'.lang_character()}  ?? ""); ?></p>
                </div>
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