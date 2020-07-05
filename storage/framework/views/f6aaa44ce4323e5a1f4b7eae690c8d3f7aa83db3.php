<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['beneficiary_families_individuals'] ?? 'beneficiary_families_individuals'); ?>

            </h4>


        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('beneficiary.fam_indev.create')); ?>"
               class="btn btn-primary btn-round btn-fab btn-sm"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add_beneficiary'] ?? 'add_beneficiary'); ?> ">
                <i class="material-icons">add</i>
            </a>

            <?php if( Auth::user()->id == 1 || in_array(175,$userPermissions)): ?>
                <a href="<?php echo e(route('beneficiary.famindv.report.form')); ?>"
                   class="btn btn-primary  btn-sm btn-round btn-fab"
                   rel="tooltip" data-placement="top"
                   title="<?php echo e($labels['search'] ?? 'search'); ?>">
                    <i class="material-icons">search</i>
                </a>
            <?php endif; ?>
            <a href="<?php echo e(route('beneficiary.fam_indev.settings')); ?>"
               class="btn btn-primary  btn-sm btn-round btn-fab"
               rel="tooltip" data-placement="top"
               title="<?php echo e(Auth::user()->lang_id == 1 ? 'Settings' : 'إعدادات'); ?>">
                <i class="material-icons">settings</i>
            </a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['beneficiary_name'] ?? 'beneficiary_name'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['beneficiary_type'] ?? 'beneficiary_type'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['identification_number'] ?? 'identification_number'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['added_at'] ?? 'added_at'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $beneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($beneficiary->{'ben_name_'.lang_character()}); ?></td>
                        <td>
                            <?php echo e($beneficiary->beneficiaryType->{'beneficieris_types_name_'.lang_character()}); ?>

                        </td>
                        <td><?php echo e($beneficiary->ben_idno); ?></td>
                        <td><?php echo e(dateFormatSite($beneficiary->created_at)); ?></td>
                        <td>
                            <a href="<?php echo e(route('beneficiary.fam_indev.getedit',$beneficiary->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab" data-toggle="tooltip"
                               data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> "
                            >
                                <i class="material-icons">edit</i>
                            </a>


                            <a href="<?php echo e(route('beneficiary.fam_indev.delete',$beneficiary->id )); ?>"
                               id="btnBeneficiaryDelete" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"
                               data-placement="top" title=" <?php echo e($labels['delete'] ?? 'delete'); ?> ">
                                <i class="material-icons">delete</i>
                            </a>

                            <a href="<?php echo e(route('activity.beneficiaries.beneficiaryForm',[$beneficiary->id ,$beneficiary->ben_type_id] )); ?>"
                               id="btnBeneficiaryFormPrint" rel="tooltip"
                               class="btn btn-sm btn-primary btn-round btn-fab"
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

            active_nev_link('families_individuals')
            DataTableCall('#table', 6);

            $('[data-toggle="tooltip"]').tooltip();
        })


        $(document).on('click', '#btnBeneficiaryDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteBeneficiary['text']); ?>',
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