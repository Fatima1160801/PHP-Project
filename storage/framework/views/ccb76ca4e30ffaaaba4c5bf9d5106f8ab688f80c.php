<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                 <?php echo e($labels['strategic_index'] ?? 'strategic_index'); ?>

            </h4>


        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('strategic.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['screen_add_strategic'] ?? 'screen_add_strategic'); ?> " >
                <i class="material-icons">add</i></a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['strategic_name_english'] ?? 'strategic_name_english'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['strategic_name_arabic'] ?? 'strategic_name_arabic'); ?>


                    </th>
                    <th>
                        <?php echo e($labels['attachments'] ?? 'attachments'); ?>


                    </th>
                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $strategicPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $strategic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($strategic->strategic_name_na); ?></td>
                        <td><?php echo e($strategic->strategic_name_fo); ?></td>
                        <td>
                            <?php if($strategic->file): ?>
                                <a target="_blank" class="btn btn-info btn-sm" href="<?php echo e(asset('images/strategic/').'/'.$strategic->file); ?>">
                                    <?php echo e($strategic->file_name); ?>

                                </a>
                                <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('strategic.edit',$strategic->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> "
                            >
                                <i class="material-icons">edit</i>
                            </a>



                            <button type="button" href="<?php echo e(route('strategic.delete',$strategic->id )); ?>"
                              rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnStrategicDelete"
                               data-placement="top"  title=" <?php echo e($labels['delete'] ?? 'delete'); ?> ">
                                <i class="material-icons">delete</i>
                            </button>
                            <a href="<?php echo e(route('goals.main.index.table',[$strategic->id,0])); ?>"
                               class="btn btn-sm btn-primary "  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['main_goals_name'] ?? 'main_goals_name'); ?> "
                            >
                                <i class="material-icons">list</i>
                                <?php echo e($labels['main_goals_name'] ?? 'main_goals_name'); ?>

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
            active_nev_link('strategic_index');
            DataTableCall('#table',5);

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');


        });

        $(document).on('click', '.btnStrategicDelete', function (e) {
             e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDelete['text']); ?>',
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



    </script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>