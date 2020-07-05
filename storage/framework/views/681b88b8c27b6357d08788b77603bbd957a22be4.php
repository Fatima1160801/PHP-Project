<?php $__env->startSection('content'); ?>


    <?php
    $att_path = str_replace('server.php', '', $_SERVER['PHP_SELF']);
    ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['files_manager']??'files_manager'); ?>


            </h4>
        </div>
        <div class="card-body "  >
            <form action="<?php echo e(route('attachments.search')); ?>" method="post" id="formFilterAttachment" no-jquery-validate="no-jquery-validate">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <label for="attachmentType_id"
                                   class="col-md-2 col-form-label"><?php echo e($labels["document_type"]??"document_type"); ?> </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="attachmentType_id"
                                            data-style="btn btn-link" id="attachmentType_id">
                                        <option value=" "></option>

                                        <?php $__currentLoopData = $attachmentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="row">
                            <label for="project_id"
                                   class="col-md-2 col-form-label"><?php echo e($labels["project_id"]??"project_id"); ?> </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"   class="form-control  selectpicker" name="project_id"
                                            data-style="btn btn-link" id="project_id">
                                        <option value=" "></option>

                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-11">
                        <div class="row">
                            <label for="activity_main_id"
                                   class="col-md-2 col-form-label"><?php echo e($labels["activity_main_id"]??"activity_main_id"); ?> </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="activity_main_id"
                                            data-style="btn btn-link" id="activity_main_id">

                                        <option value=" "></option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-11">
                        <div class="row">
                            <label for="activity_sub_id" class="col-md-2 col-form-label">
                                <?php echo e($labels["activity_sub_id"]??"activity_sub_id"); ?>

                            </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="activity_sub_id"
                                            data-style="btn btn-link" id="activity_sub_id">
                                        <option value=" "></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                                id="search">
                            <?php echo e($labels['search']??'search'); ?>

                            <div class="loader pull-left" style="display: none;"></div>
                        </button>
                    </div>

                </div>

            </form>
        </div>
        <div class="card-body" id="table-content" >
        <!--<button data-href="<?php echo e(route("attachments.create")); ?>" id="btnFileModal" class="btn btn-primary "
               data-toggle="tooltip" data-placement="top" title=" Add New File" >
                <i class="material-icons">cloud_upload</i> Upload New File </button>-->


            <table class="table" id="table">
                <thead>
                <tr>
                     <th>
                        <?php echo e($labels['file']??'file'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['document_type']??'document_type'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['description']??'description'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['related_to']??'related_to'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['actions']??'actions'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>

                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                         <td><a href="<?php echo e(public_path()); ?>/attach/<?php echo e($attachment->file_path); ?>"
                               download><?php echo e($attachment->file_path); ?></a></td>
                        <td><?php echo e($attachment->attachmentType ? $attachment->attachmentType->{'attachment_type_'.lang_character()} :''); ?></td>
                        <td><?php echo e($attachment->file_desc); ?></td>
                        <td><?php echo e($act_list[$attachment->activity_type][Auth::user()->lang_id]); ?></td>
                        <td>
                            <a href="<?php echo e($att_path); ?>attach/<?php echo e($attachment->file_path); ?>" rel="tooltip" download
                               class="btn btn-sm btn-info btn-round btn-fab"
                               rel="tooltip" data-original-title=""
                               title="
                               <?php echo e($labels['download']??'download'); ?>"
                               data-placement="top" id="">
                                <i class="material-icons">cloud_download</i>
                            </a>
                            <button type="button" data-href="<?php echo e(route('attachments.edit',$attachment->id)); ?>"
                                    rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                                    rel="tooltip" data-original-title=""
                                    title=" <?php echo e($labels['edit']??'edit'); ?> "
                                    data-placement="top" id="">

                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" href="<?php echo e(route('attachments.delete',$attachment->id)); ?>"
                                    rel="tooltip"
                                    class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                                    rel="tooltip" data-original-title="" title=" <?php echo e($labels['delete']??'delete'); ?>"
                                    data-placement="top" id="">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>
            <?php echo e($attachments->links("pagination::bootstrap-4")); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('files_management');
            DataTableCall('#table', 5);
            $('[data-toggle="tooltip"]').tooltip();
        })

        /* project  change*/
        $(document).on('change', '#formFilterAttachment #project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();
            $("#activity_main_id option").remove();
            $('#activity_main_id').selectpicker('refresh');
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');
            var url_ = '<?php echo e(route('attachments.getMainActivitiesList')); ?>' + '/' + project_id;
            $.ajax({
                url: url_,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    console.log('beforeSend')
                },
                success: function (data) {

                    if (data.main_activities != null) {
                        select_activity_main(data.main_activities);
                    }
                    $('#activity_main_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_main_id').selectpicker('refresh');
                }
            });

        });

        function select_activity_main(data) {

            $("#activity_main_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_main_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        /* activity_main_id  change*/
        $(document).on('change', '#formFilterAttachment #activity_main_id', function (e) {
            e.preventDefault();
            var activity_main_id = $(this).val();
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');
            var url_ = '<?php echo e(route('attachments.getSubActivitiesList')); ?>' + '/' + activity_main_id;
            $.ajax({
                url: url_,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.sub_activities != null) {
                        select_activity_sub(data.sub_activities);
                    }
                    $('#activity_sub_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_sub_id').selectpicker('refresh');
                }
            });

        });

        function select_activity_sub(data) {
            $("#activity_sub_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_sub_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }





        $('#btnFileModal').click(function () {
            var url = $(this).attr('data-href');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();

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

        

        

        

        





        $(document).on('submit', '#formFilterAttachment', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'html',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('.loader').css('display', 'block');
                 },
                success: function (data) {
                    if (data.status == true) {
                        $('#table-content').html(data.html);
                        $('[rel="tooltip"]').tooltip();
                        $('.loader').css('display', 'none');
                    }
                },
                error: function (data) {
                    $('.loader').css('display', 'none');
                }
            })
        });

        $(document).on('click','#link-search .page-item',function (e) {
             var link = $(this).children('a').attr('href');
            e.preventDefault();

            var data = $('#formFilterAttachment').serialize();
            var url = link;
            $.ajax({
                url: url,
                dataTypes: 'html',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#table-content').html(data.html);
                        $('[rel="tooltip"]').tooltip();
                        $('.loader').css('display', 'none');
                    }
                },
                error: function (data) {
                    $('.loader').css('display', 'none');
                }
            })
        })



    </script>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>