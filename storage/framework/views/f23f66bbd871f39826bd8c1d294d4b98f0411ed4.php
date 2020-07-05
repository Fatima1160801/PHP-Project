<?php $__env->startSection('css'); ?>
    <style>


    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_indicator_measure_unit']?? 'screen_indicator_measure_unit'); ?>

            </h4>
        </div>
        <div class="card-body ">

            <a href="<?php echo e(route('goals.indicators.measure.unit.create')); ?>" rel="tooltip"
               class="btn btn-sm btn-primary btn-round btn-fab"
              data-original-title="" title="
                <?php echo e($labels['add']?? 'add'); ?>

"
               data-placement="top" id="">

                <i class="material-icons">add</i>

            </a>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="2">#</th>

                    <th>
                        <?php echo e($labels['unit_name']?? 'unit_name'); ?>


                    </th>
                    <th>                        <?php echo e($labels['actions']?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>

                <?php if($imus != null): ?>

                    <?php $__currentLoopData = $imus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$imu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td colspan="2"><?php echo e($index+1); ?></td>
                            <td><?php echo e($imu->unit_name_no); ?></td>
                            <td>
                                <a href="<?php echo e(route('goals.indicators.measure.unit.edit',$imu->id)); ?>" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab"
                                   rel="tooltip" data-original-title="" title="<?php echo e($labels['edit']?? 'edit'); ?>"
                                   data-placement="top" id="">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="<?php echo e(route('goals.indicators.measure.unit.delete',$imu->id)); ?>"
                                   class="btn btn-sm   btn-round btn-danger btn-fab"
                                   rel="tooltip" data-original-title="" title="<?php echo e($labels['delete']?? 'delete'); ?>"
                                   data-placement="top" id="deleteUnit">
                                    <i class="material-icons">delete</i>
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

                </tbody>

            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function () {
            active_nev_link('indicators_measure_unit');
            DataTableCall('#table', 3)
        })
        $(document).on('click', '#deleteUnit', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteMeasureUnit['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        data: {"_token": "<?php echo e(csrf_token()); ?>"},
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });

    </script>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('js'); ?>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>