<?php $__env->startSection('content'); ?>



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">Screen</h4>
        </div>
        <div class="card-body ">


            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            <div class="material-datatables">
            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Screen Name Enghish</th>
                    <th>Screen Name Arabic</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $screens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$screen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($screen->screen_name_na); ?></td>
                        <td><?php echo e($screen->screen_name_fo); ?></td>
                        <td>
                            <a href="<?php echo e(route('setting.label.create',[$screen->id,1])); ?>" rel="tooltip" class="btn btn-sm btn-primary btn-round "
                               rel="tooltip" data-original-title=""
                               data-placement="top" id="">
                                English
                                <i class="material-icons">language</i>
                            </a>
                            <a href="<?php echo e(route('setting.label.create',[$screen->id,2])); ?>" rel="tooltip" class="btn btn-sm btn-label btn-round "
                               rel="tooltip" data-original-title=""
                               data-placement="top" id="">
                                Arabic
                                <i class="material-icons">language</i>
                            </a>

                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(function () {
        DataTableCall('#table');

        $('[data-toggle="tooltip"]').tooltip();
        //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
    })

</script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>