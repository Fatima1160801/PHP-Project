<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['doc_settings'] ?? 'doc_settings'); ?>

            </h4>


        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('settings.documents.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['addDocSettings'] ?? 'Add Document Settings'); ?>" >
                <i class="material-icons">add</i></a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['interface_type_id'] ?? 'interface'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['attachment_type_id'] ?? 'interface'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['is_hidden'] ?? 'status'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                   <?php
                         if (Auth::user()->lang_id == 1)
                            {
                                $interface_name = 'interface_type_na';
                                $attach_name = 'attachment_type_na';
                                $activeStatus = 'Active';
                                $inactiveStatus = 'InActive';
                            
                            }
                            else
                            {
                                $interface_name = 'interface_type_fo';
                                $attach_name = 'attachment_type_fo';
                                $activeStatus = 'فعال';
                                $inactiveStatus = 'غير فعال';
                            }
                   ?>
                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($document->intface->$interface_name ?? ""); ?></td>
                        <td><?php echo e($document->attachment->$attach_name ?? ""); ?></td>
                        <td><?php if($document->is_hidden == 0): ?> <?php echo e($activeStatus); ?> <?php else: ?> <?php echo e($inactiveStatus); ?>  <?php endif; ?></td>
                        <td>
                          <a href="<?php echo e(route('settings.documents.edit',[$document->interface_type_id,$document->attachment_type_id])); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab btn_edit"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> ">
                                <i class="material-icons">edit</i>
                            </a>
                            <button type="button" href="<?php echo e(route('settings.documents.delete',[$document->interface_type_id,$document->attachment_type_id])); ?>"
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
            DataTableCall('#table',5);
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
                        // alert(url);
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
                                    url_edit = $('.btn_edit').attr('href');
                                    // alert(url_edit);
                                    setTimeout(() => {  window.location.href = url_edit; }, 1000);
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