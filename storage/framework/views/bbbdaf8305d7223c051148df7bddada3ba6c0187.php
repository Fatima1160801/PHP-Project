<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">business_center</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_donor_types']??'screen_donor_types'); ?>


            </h4>
        </div>
        <div class="card-body ">


            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="5">
                        <a href="<?php echo e(route('project.donors.types.create')); ?>"
                           class="btn btn-primary btn-sm btn-fab btn-round "
                           data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['add']??'add'); ?>">
                            <i class="material-icons">add
                            </i>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['donor_types_name_anglish']??'donor_types_name_anglish'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['donor_types_name_arabic']??'donor_types_name_arabic'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['status'] ?? 'status'); ?>

                    </th>

                    <th>
                        <?php echo e($labels['actions']??'actions'); ?>


                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $donorstypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$donorstype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                         <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($donorstype->type_name_na); ?></td>
                        <td><?php echo e($donorstype->type_name_fo); ?></td>
                        <td><?php echo activeLabel($donorstype->is_hidden); ?> </td>
                        <td>

                            <a href="<?php echo e(route('project.donors.types.edit',$donorstype->id)); ?>"
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="left" title=" <?php echo e($labels['edit']??'edit'); ?>">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="<?php echo e(route('project.donors.types.destroy',$donorstype->id)); ?>"
                               class="btn btn-danger btn-sm btn-round btn-fab"
                               data-tooltip="tooltip" data-placement="right" title="<?php echo e($labels['delete']??'delete'); ?>"
                               id="DeleteDonorType">
                                <i class="material-icons">delete</i>
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
            active_nev_link('donor_types');

            DataTableCall('#table', 5)
        });
        /*///////////*****delete staff****//////////*/
        $(document).on('click', '#DeleteDonorType', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteDonorTypet['text']); ?>',
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
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
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
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>