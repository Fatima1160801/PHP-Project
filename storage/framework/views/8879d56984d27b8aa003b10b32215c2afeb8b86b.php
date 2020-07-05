<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                Add Progress Report
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>

            <form action="<?php echo e(route('task_progress_report.update')); ?>" novalidate='novalidate' method="post"  id="formUpdateTaskProgressReport11">

                <?php echo csrf_field(); ?>


                <input type="hidden" name="id" value="<?php echo e($taskProgressReport->id); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_name">Task</label>
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
                        document.getElementById('task_id').value = '<?php echo e($taskProgressReport->task_id); ?>';
                    </script>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_name">Progress Report Title</label>
                            <div class=" col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <input alt="Report Name" autocomplete="off" class="form-control" id="report_name"
                                           maxlength="200" name="report_name" required="" type="text"
                                           value="<?php echo e($taskProgressReport->rep_name); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-2 col-form-label" for="task_desc">Report Description</label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    

                                    

                                    <textarea name="rep_desc" id="rep_desc" class="form-control" rows="3"><?php echo e($taskProgressReport->rep_desc); ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        function is_url_exist($url){

                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_NOBODY, true);
                            curl_exec($ch);
                            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                            if($code == 200){
                               $status = true;
                            }else{
                              $status = false;
                            }
                            curl_close($ch);
                           return $status;
                        }
                          $att_path1 = str_replace('server.php','',$_SERVER['PHP_SELF']);
                          $str = '';
                          if(isset($taskProgressReport->attachment) && $taskProgressReport->attachment != null){
                              $status= is_url_exist('public/attach/' . $taskProgressReport->attachment);
                               $appendedFile=[];
                               if( $status === true){
                                $appendedFile = [
                                    "name" => $taskProgressReport->attachment,
                                    "type" => '',
                                    "size" => filesize('public/attach/' . $taskProgressReport->attachment),
                                    "file" => $att_path1.'public/attach/'.$taskProgressReport->attachment,
                                    "data" => [
                                        "url" => $att_path1.'attach/'.$taskProgressReport->attachment
                                    ]
                                ];
                                }
                             $str = 'data-fileuploader-files='.json_encode($appendedFile).'';
                          }else{
                             $str = '';
                          }


                    ?>
                    <div class="col-md-8">
                        <div class="row">
                            <label class="col-md-3 col-form-label" for="task_desc">Attachment</label>
                            <div class="col-md-8">
                                <div class="form-group has-default bmd-form-group">
                                    <input type="file" name="_files_" <?php echo e($str); ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <label class="col-md-3 col-form-label" for="task_desc"></label>
                            <div class="col-md-8">
                                <button type="submit" id="btnUpdateTaskProgressReport" class="btn btn-primary  btn-sm">
                                    <?php echo e($labels['save'] ?? 'save'); ?>

                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>

                                <a href="<?php echo e(route('tasks.edit',$taskProgressReport->task_id)); ?>"
                                   class="btn btn-sm btn-default ">back</a>

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
            $('input[name="_files_"]').fileuploader({});
            

        });
        $(document).on('submit', '#formUpdateTaskProgressReport11', function (e) {

            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
                var formData = new FormData($(this)[0]);
                var url = $(this).attr('action');
                console.log(url)
                // $('#btnUpdateTaskProgressReport').attr("disabled", true);
                $('.loader').show();
                // var rep_desc = $('.summernote-code').summernote('code');
                // formData.append('rep_desc', rep_desc);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        //$('#btnUpdateTaskProgressReport').attr("disabled", false);
                        $('.loader').hide();
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                    }
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