<?php $__env->startSection('content'); ?>

     <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                 <?php echo e($labels['activity_lessons_related']??'activity_lessons_related'); ?>


            </h4>


        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('activity.lessons.related.create')); ?>"
               class="btn btn-primary btn-round btn-fab btn-sm"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add_activity_lessons_related']??'add_activity_lessons_related'); ?>" >

                <i class="material-icons">add</i>
            </a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>

                        <?php echo e($labels['activity_lessons_related_name_na']??'activity_lessons_related_name_na'); ?>

                    </th>
                    <th>

                        <?php echo e($labels['activity_lessons_related_name_fo']??'activity_lessons_related_name_fo'); ?>


                    </th>

                    <th>
                        <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lessons_related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($related->activity_lessons_related_name_na); ?></td>
                        <td><?php echo e($related->activity_lessons_related_name_fo); ?></td>

                        <td>
                            <a href="<?php echo e(route('activity.lessons.related.edit',$related->id)); ?>"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="<?php echo e($labels['edit'] ?? 'edit'); ?> ">
                                <i class="material-icons">edit</i>
                            </a>
                            <button type="button" href="<?php echo e(route('activity.lessons.related.delete',$related->id )); ?>"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnDistrictDelete"
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

            active_nev_link('activity_lessons_related');

            DataTableCall('#table', 4);

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnDistrictDelete', function (e) {
                 e.preventDefault();
                $this = $(this);

                swal({
                    text: '<?php echo e($messageDeleteLessonsRelateds['text']); ?>',
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