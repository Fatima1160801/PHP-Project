<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">business_center</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_donor'] ?? 'screen_donor'); ?>

            </h4>
        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('project.donors.donorWizard')); ?>" class="btn btn-primary btn-round btn-sm btn-fab"
               data-toggle="tooltip" data-placement="top" title=" <?php echo e($labels['add'] ?? 'add'); ?>">
                <i class="material-icons">add</i>
            </a>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e($labels['english_donor_name'] ?? 'english_donor_name'); ?> </th>
                    <th><?php echo e($labels['arabic_donor_name'] ?? 'arabic_donor_name'); ?></th>
                    <th><?php echo e($labels['type'] ?? 'type'); ?></th>
                    <th> <?php echo e($labels['donor_status'] ?? 'donor_status'); ?></th>
                    <th><?php echo e($labels['actions'] ?? 'actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $donors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($donor->donor_name_na); ?></td>
                        <td><?php echo e($donor->donor_name_fo); ?></td>
                        <td><?php if($donor->type==0): ?>
                               <span class="badge badge-info">Funder</span>
                                 <?php else: ?>
                            <span class="badge badge-warning">Partner</span>
                                 <?php endif; ?></td>
                        <td> <?php echo activeLabel($donor->ishidden); ?></td>
                        <td>

                            <a href="<?php echo e(route('project.donors.donorWizard',$donor->id)); ?>"
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="<?php echo e(route('project.donors.destroy',$donor->id)); ?>"
                               class="btn btn-danger btn-round btn-fab btn-sm" id="deleteDonor"
                               data-tooltip="tooltip" data-placement="right" title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
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

        $(document).ready(function () {
            active_nev_link('donors1');
            DataTableCall('#table',6);

            $('[data-toggle="tooltip"]').tooltip();


        })

        $(document).on('click', '#deleteDonor', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteDonor['text']); ?>',
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
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>