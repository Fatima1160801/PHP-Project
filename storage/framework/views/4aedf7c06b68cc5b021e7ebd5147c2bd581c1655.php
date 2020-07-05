<div class="modal fade" id="fileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title">Add New File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php echo Form::open(['route' => 'attachments.store' ,'action'=>'post' ,'id'=>'formFileUpload']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($activity_type)): ?>
                            <input type="hidden" name="activity_type" value="<?php echo e($activity_type); ?>">
                        <?php endif; ?>
                        <?php if(isset($primary_id)): ?>
                            <input type="hidden" name="primary_id" value="<?php echo e($primary_id); ?>">
                        <?php endif; ?>

                        <div id="fileModalForm"></div>

                        <ul class="fileList"></ul>
                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" id="file_upload_btn" class="btn btn-next btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        $('#formFileUpload').submit(function (e) {
            e.preventDefault();
            var action_url = $(this).attr('action');

            $('#file_upload_btn').attr('disabled', true);
            $('#file_upload_btn .loader').show();
            var primary_id = $('#formFileUpload input[name="primary_id"]').val();
            if (primary_id == 0) {
                $('#formFileUpload input[name="primary_id"]').val($('#object_primary_id').val());
            }
            var formData = new FormData($('#formFileUpload')[0]);
            var pid = '<?php echo e($primary_id ?? null); ?>';
            if (pid == null || pid == 0) {
                pid = $('#formFileUpload input[name="primary_id"]').val();
            }

            $.ajax({
                url: action_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success == true) {
                        $('body #file_upload_btn').attr('disabled', false);
                        $('body #file_upload_btn .loader').hide();
                        $('body #fileModal').modal('hide');
                         myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        var get_attachments_url = '<?php echo e(route('attachments.get_by_activity')); ?>' + '/' + '<?php echo e(isset($activity_type) ? $activity_type : 0); ?>' + '/' + pid;
                        $('body #files-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                        $.get(get_attachments_url, function (response) {
                            $('body #files-content').html(response);

                            DataTableCall('#attachments-table',5);
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    } else if (data.success == false) {
                        $('body #file_upload_btn').attr('disabled', false);
                        $('body  #file_upload_btn .loader').hide();
                        myNotify('warning', 'Error', 2, '5000', data.error);
                    } else if (data.status == false) {
                        $('body #file_upload_btn').attr('disabled', false);
                        $('body  #file_upload_btn .loader').hide();
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                }
            });
        });


        $('#modal-dismiss-f').click(function () {

            $('#fileModal .close').click();

        });


        $('body').on('click', '#btnFileModal', function () {
            var url = $(this).attr('data-href');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            });
        });

        $('body').on('click', '.btnAttachEdit', function () {
            var url = $(this).attr('data-href');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            });
        });


        $(document).on('click', '.btnAttachDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e(getMessage('2.65')['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
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


    });

</script>
