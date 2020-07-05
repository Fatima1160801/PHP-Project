<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">

                <?php echo e($labels['Visits'] ?? 'Visits'); ?>

            </h4>


        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('visits.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['addVisit'] ?? 'addVisit'); ?>" >
                <i class="material-icons">add</i></a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['visitName'] ?? 'visitName'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['visitDate'] ?? 'visitDate'); ?>

                    </th>

                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($visit->name); ?></td>
                        <td><?php echo e(dateFormatSite($visit->date_visits)); ?></td>
                         <td>
                            <a href="<?php echo e(route('visits.edit',$visit->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> "
                            >
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?php echo e(route('activity.beneficiary.value', ['visit',$visit->id] )); ?>"
                               class="btn btn-sm btn-info btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['beneficiaryValue'] ?? 'beneficiaryValue'); ?> "  >
                                <i class="material-icons">add</i>
                            </a>


                            <button type="button" href="<?php echo e(route('visits.delete',$visit->id )); ?>"
                              rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                               data-placement="top"  title=" <?php echo e($labels['delete'] ?? 'delete'); ?> ">
                                <i class="material-icons">delete</i>
                            </button>

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
            active_nev_link('visit-link');
            DataTableCall('#table',4);
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '.btnTypeDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '<?php echo e($messageDeleteType['text']); ?>',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                    $('#contentModal .close').click();
                                }else {
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                }
                            },
                            error: function () {
                            }
                        });
                    }
                })
            });


        })





    </script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>