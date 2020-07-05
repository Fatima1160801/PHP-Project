<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_AddProgressReport']??'screen_AddProgressReport'); ?>

            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>

            <form action="<?php echo e(route('task_progress_report.store')); ?>" method="post" novalidate='novalidate' id="formAddTaskProgressReport">

                <?php echo csrf_field(); ?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_name">

                                <?php echo e($labels['Task']??'Task'); ?>


                            </label>
                            <div class=" col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select class="form-control selectpicker" name="task_id" id="task_id" readonly>
                                        <option></option>
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($task->id); ?>"><?php echo e($task->task_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.getElementById('task_id').value = '<?php echo e($task_id); ?>';
                    </script>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_name">
                                <?php echo e($labels['Progress_Report_Title']??'Progress_Report_Title'); ?>

                            </label>
                            <div class=" col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <input alt="Report Name" autocomplete="off" class="form-control" id="report_name" maxlength="200" name="report_name" required="" type="text" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_desc">
                                Report Description
                            </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    

                                    

                                    <textarea name="rep_desc" id="rep_desc" class="form-control" rows="3">

                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <label class="col-md-3 col-form-label" for="task_desc">
                                <?php echo e($labels['Attachment']??'Attachment'); ?>

                            </label>
                            <div class="col-md-8">
                                <div class="form-group has-default bmd-form-group">
                                   <input type="file" name="files_">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <label class="col-md-3 col-form-label" for="task_desc"></label>
                            <div class="col-md-8">
                                <button type="submit" id="btnSaveTaskProgressReport" class="btn btn-sm   btn-rose">
                                    <?php echo e($labels['save'] ?? 'save'); ?>

                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>
                                <a href="<?php echo e(route('tasks.edit',$task_id)); ?>" class="btn btn-sm btn-default ">
                                    <?php echo e($labels['back'] ?? 'back'); ?>

                                    </a>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function () {

        funValidateForm();
        $('.selectpicker').selectpicker();

        $('input[name="files_"]').fileuploader({});

        $('#formAddTaskProgressReport').submit(function(e){
            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var formData = new FormData($(this)[0]);
            var url = $(this).attr('action');

            $('#btnSaveTaskProgressReport').attr("disabled", true);
            $('.loader').show();
          //  var rep_desc = $('.summernote-code').summernote('code');
         //   formData.append('rep_desc', rep_desc);

            $.ajax({
                url : url,
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success : function(data) {
                    $('#btnSaveTaskProgressReport').attr("disabled", false);
                    $('.loader').hide();
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                }
            });

        });

    });


</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('summernote/summernote.js')); ?>"></script>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>