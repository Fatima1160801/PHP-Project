<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">


                <?php echo e($labels['screen_locality'] ?? 'screen_locality'); ?>


            </h4>
        </div>
        <div class="card-body">
            <a href="<?php echo e(route('locality.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="Add New Locality" >
                <i class="material-icons">add</i></a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['localit_name_english'] ?? 'localit_name_english'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['localit_name_arabic'] ?? 'localit_name_arabic'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['district'] ?? 'district'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['city'] ?? 'city'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $locality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($l->locality_name_na); ?></td>
                        <td><?php echo e($l->locality_name_fo); ?></td>
                        <td><?php echo e((Auth::user()->lang_id == 1) ? $l->district->district_name_no : $l->district->district_name_fo); ?></td>
                        <td><?php echo e((Auth::user()->lang_id == 1) ? $l->city->city_name_no : $l->city->city_name_fo); ?></td>
                        <td>
                            <a href="<?php echo e(route('locality.edit',$l->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> ">
                                <i class="material-icons">edit</i>
                            </a>

                            <button type="button" data-href="<?php echo e(route('locality.delete',$l->id)); ?>"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnLocalityDelete"
                                    data-placement="top" title=" <?php echo e($labels['delete'] ?? 'delete'); ?> ">
                                <i class="material-icons">delete</i>
                            </button>

                            <a href="<?php echo e(route('activity.beneficiaries.beneficiaryForm',[$l->id ,'4'] )); ?>"
                               id="btnBeneficiaryFormPrint" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"
                               data-placement="top" title=" <?php echo e($labels['print'] ?? 'print'); ?> ">
                                <i class="material-icons">print</i>
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
            active_nev_link('Localities-link');
            DataTableCall('#table',6);


            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnLocalityDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '<?php echo e($messageDeleteLocality['text']); ?>',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).data('href');
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


        })

    </script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>