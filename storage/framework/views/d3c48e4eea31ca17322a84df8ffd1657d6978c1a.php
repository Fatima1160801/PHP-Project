
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title bolder-large">Add New File</h5>
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
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default btn-sm">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" id="file_upload_btn" class="btn btn-next btn-rose pull-right btn-sm">
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

<div class="modal fade" id="fixedFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title bolder-large">Add New File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php echo Form::open(['route' => 'attachments.fixed.store' ,'action'=>'post' ,'id'=>'formFileStore']); ?>

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
                            <div class="card-footer ml-auto mr-auto" style="display: none">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default btn-sm">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" id="file_upload_btn" class="btn btn-next btn-rose pull-right  btn-sm">
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

<div class="modal fade" id="notFixedFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title bolder-large">Add New File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php echo Form::open(['route' => 'attachments.not.fixed.store' ,'action'=>'post' ,'id'=>'notFixedFormFileStore']); ?>

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
                            <div class="card-footer ml-auto mr-auto" style="display: none">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default btn-sm">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" id="file_upload_btn" class="btn btn-next btn-rose pull-right btn-sm">
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
            var attach_type = $("#attachment_type_id").val();
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
                    console.log(data);
                    if (data.success == true) {
                        $('body #file_upload_btn').attr('disabled', false);
                        $('body #file_upload_btn .loader').hide();
                        $('body #fileModal').modal('hide');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        var get_attachments_url = '<?php echo e(route('attachments.get_by_activity')); ?>' + '/' + '<?php echo e(isset($activity_type) ? $activity_type : 0); ?>' + '/' + pid;
                        $('body #files-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                        $.get(get_attachments_url, function (response) {
                            $('body #files-content').html(response);

                            DataTableCall('#attachments-table', 5);
                            $('[data-toggle="tooltip"]').tooltip();
                        });

                        $("#doc_title_" + data.save_opp_id).text($("#formFileUpload #title").val());
                        $("#doc_descpt_" + data.save_opp_id).text($("#formFileUpload #desc").val());
                        $("#doc_file_path_" + data.save_opp_id).attr("href", data.file_path);
                        var seltext = $("#formFileUpload #attachment_type_id option:selected").text();
                        $("#categ_type_name_" + data.save_opp_id).text(seltext);

                        if (attach_type == 13) {
                            $("#concept_doc_title").text($("#formFileUpload #title").val());
                            $("#concept_doc_descpt").text($("#formFileUpload #desc").val());
                            $("#concept_doc_file_path").attr("href", data.file_path);
                            var seltext = $("#formFileUpload #attachment_type_id option:selected").text();
                            var base_u = '<?php echo e(url('attachments/')); ?>';
                            $("#btnConceptFileModal").attr("data-href", base_u + '/' + data.save_opp_id + '/edit')
                            $("#concept_categ_type_name").text(seltext);
                            $("#proposal_file_val").val(data.save_opp_id);
                        }
                        loadDocuments();
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
            var dis_option = $(this).attr('data-tid');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
                // var dis_option=$(this).attr('data-id');
                if (dis_option != undefined && dis_option == 1) {
                    $('.list-of-types').hide();
                    $('.list-of-types').css('background', "#eee");
                } else {
                    $('.list-of-types').show();
                    $('.list-of-types').css('background', "none");
                }
            });
        });

        $('body').on('click', '#btnFileModalNew', function () {
            var document_type_id = $("#document_type_id option:selected").val();
            var object_primary_id = $("#object_primary_id").val();
            if (document_type_id == null || document_type_id == "") {
               // $(".doc_parent").css("border", "1px solid red");
                $(".doc_parent_required").text("You must select document type before");
                return false;
            } else {
                $(".doc_parent_required").text("");
            }
            var url = '<?php echo e(url('attachments/create/with/')); ?>' + '/' + object_primary_id.trim() + '/' + document_type_id.trim();
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            });
        });


        $('body').on('click', '#btnConceptFileModal', function () {
            var url = $(this).attr('data-href');
            if (url != "" && url != null && url != undefined) {
                var dis_option = $(this).attr('data-tid');
                $.get(url, function (response) {
                    $('#fileModal').modal('show');
                    $('#fileModalForm').html(response);
                    $('.selectpicker').selectpicker();
                    $('input[name="files"]').fileuploader({});
                    // var dis_option=$(this).attr('data-id');
                    if (dis_option != undefined && dis_option == 1) {
                        $('.list-of-types').hide();
                        $('.list-of-types').css('background', "#eee");
                    } else {
                        $('.list-of-types').show();
                        $('.list-of-types').css('background', "none");
                    }
                });
            } else {
                var object_primary_id = $("#object_primary_id").val();
                var nurl = '<?php echo e(url('attachments/create/concept/with/')); ?>' + '/12/13/' + object_primary_id.trim();
                $.get(nurl, function (response) {
                    $('#fileModal').modal('show');
                    $('#fileModalForm').html(response);
                    $('.selectpicker').selectpicker();
                    $('input[name="files"]').fileuploader({});
                });
            }


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

    $(document).on('click', '.btnAttachFixedDelete', function (e) {
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
                            $($this).closest('div.col-md-3').css('background', 'red').delay(1000).hide(1000);
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


    $(function () {

        $('.card-footer a').click(function () {
            $('#fixedFileModal').modal('hide');
        });

    });

    $('body').on('click', '#btnFixedFileModal', function (e) {
        var int_type=$("#interface_type_val").val();
        var allow_go=true;
        if(int_type==10){
            allow_go=$("#fixed_status_val").val() ==1;//!=3;
        }else{
            allow_go =$("#fixed_status_val").val() ==1;//!=4;
        }
        if(allow_go){
        e.preventDefault();
        var object_primary_id = $("#object_primary_id").val();
        $('#fixedFileModal #formFileStore #primary_id').val(object_primary_id);

        var url = $(this).attr('data-href');
        $.ajax({
            url: url,
            type: 'get',
            beforeSend: function () {
                $('#fixedFileModal .card-footer').hide();
                $('#fixedFileModal').modal('show');
                $('#fixedFileModal #fileModalForm').html('<div style="margin: auto" class="loader-div"></div>');
            },
            success: function (response) {
                $('#fixedFileModal .card-footer').show();
                $('#fixedFileModal #fileModalForm').html('');
                $('#fixedFileModal #fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            }
        });
        }else{
            <?php if(!empty($abortEditFile)): ?>
            myNotify('<?php echo e($abortEditFile["icon"]); ?>', '<?php echo e($abortEditFile["title"]); ?>', '<?php echo e($abortEditFile["type"]); ?>', '5000','<?php echo e($abortEditFile["text"]); ?>');
            <?php endif; ?>
        }
    });

    $('body').on('submit', '#fixedFileModal #formFileStore', function (e) {
        e.preventDefault();
        var action_url = $(this).attr('action');

        $('#file_upload_btn').attr('disabled', true);
        $('#file_upload_btn .loader').show();

        var primary_id = $('#fixedFileModal #formFileStore input[name="primary_id"]').val();
        if (primary_id == 0) {
            $('#fixedFileModal #formFileStore input[name="primary_id"]').val($('#object_primary_id').val());
        }
        var formData = new FormData($('#formFileStore')[0]);

        $.ajax({
            url: action_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#file_upload_btn .loader').hide();

                if (data.success == true) {

                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);


                    // concept_tab
                    // attachments_fixed_div
                    //
                    // loader - div
                    //
                    // if (data.attachment_type_not_show == 0) {
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #doc_title_').text(data.attachment_fixed.file_title);
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #doc_descpt_').text(data.attachment_fixed.file_desc);


                        var url_edit = '<?php echo e(route("attachments.fixed.edit")); ?>' + '/' + data.attachment_fixed.id;
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #btnFixedFileModal').remove();
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #btnEditFixedFileModal').show();
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #btnEditFixedFileModal').attr('data-href', url_edit);

                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' .download_link').show();
                        var url_link = '<?php echo e(p_url("/")); ?>' + data.attachment_fixed.file_path;

                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' .download_link').attr('href', url_link);
                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' .download_link').attr('id', 'doc_file_path_' + data.attachment_fixed.id);

                        $('#fixed_type_' + data.attachment_fixed.attachment_type_id + ' #doc_img_').attr('src', '<?php echo e(asset('images/filetype/')); ?>' + '/' + data.attachment_fixed.file_type + '.png');

                    // } else {
                    //
                    // }


                    $('#fixedFileModal').modal('hide');

                } else if (data.success == false) {
                    displayResponseMessage(data.message);
                    //myNotify('warning', 'Error', 2, '5000', data.error);
                } else if (data.status == false) {
                    displayResponseMessage(data.message);
                   // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('#file_upload_btn .loader').hide();

            }
        });
    });

    $('body').on('click', '#btnEditFixedFileModal', function (e) {

        var int_type=$("#interface_type_val").val();
        var allow_go=true;
        if(int_type==10){
            allow_go=$("#fixed_status_val").val() ==1;//!=3;
        }else{
            allow_go =$("#fixed_status_val").val() ==1;//!=4;
        }
        if(allow_go){
        e.preventDefault();
        var url = $(this).attr('data-href');
        $.ajax({
            url: url,
            type: 'get',
            beforeSend: function () {
                $('#fixedFileModal .card-footer').hide();
                $('#fixedFileModal #fileModalForm').html('');
                $('#fixedFileModal #fileModalForm').html('<div style="margin: auto" class="loader-div"></div>');
                $('#fixedFileModal').modal('show');
            },
            success: function (response) {
                $('#fixedFileModal .card-footer').show();
                $('#fixedFileModal #fileModalForm').html('');
                $('#fixedFileModal #fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            }
        });
        }else{
            <?php if(!empty($abortEditFile)): ?>
            myNotify('<?php echo e($abortEditFile["icon"]); ?>', '<?php echo e($abortEditFile["title"]); ?>', '<?php echo e($abortEditFile["type"]); ?>', '5000','<?php echo e($abortEditFile["text"]); ?>');
            <?php endif; ?>
        }
    });


    //attachment_type_not_show عدم عرض الملف المثبت صاحب هذا النوع وتكون القيمة الافتراضية 0 اي يعرض كل الملفات
    //attachment_type_show   عرض فقط الملف المثبت صاحب هذا النوع وتكون القيمة الافتراضية 0 اي يعرض كل الملفات


    function get_fiexd_attachments(primary_id, interface_id, attachment_type_not_show, attachment_type_show,concept_full_display) {
        var url = '<?php echo e(route("attachments.fixed.index")); ?>' + '/' + primary_id + '/' + interface_id;
        $.ajax({
            url: url,
            type: 'get',
            data: {'attachment_type_not_show': attachment_type_not_show, 'attachment_type_show': attachment_type_show,'display_full_desc':concept_full_display},
            beforeSend: function () {
                $('.loader-div').show();
                $('#attachments_fixed_div').html('');
            },
            success: function (response) {
                if (response.status == true) {
                    if(attachment_type_show == 0){
                        $('#attachments_fixed_div').html(response.html);
                    }else{
                        $('.loader-div').hide();
                    $('#attachments_fixed_div_main').html(response.html);
                    }
                    $('[data-toggle="tooltip"]').tooltip();
                }

            }
        });
    }


    $(function () {
        $('.card-footer a').click(function () {
            $('#notFixedFileModal').modal('hide');
        });
    });


    $('body').on('click', '#btnAddNotFixedFileModal', function (e) {

        var int_type=$("#interface_type_val").val();
        var allow_go=true;
        if(int_type==10){
            allow_go=$("#fixed_status_val").val() ==1;//!=3;
        }else{
            allow_go =$("#fixed_status_val").val() ==1;//!=4;
        }
        if(allow_go){
        e.preventDefault();
        var attachment_type_id = $("#document_type_id option:selected").val();
        console.log(attachment_type_id);
        if (attachment_type_id == null || attachment_type_id == "") {
            //$(".doc_parent").css("border", "1px solid red");
            $(".doc_parent_required").text("You must select document type before");
            return false;
        } else {
            $(".doc_parent_required").text("");
        }
        var url_ = '<?php echo e(route("attachments.not.fixed.create")); ?>' + '/' + attachment_type_id;

        $.ajax({
            url: url_,
            type: 'get',
            beforeSend: function () {
                //$('#notFixedFileModal .card-footer').hide();
                $('#notFixedFileModal').modal('show');
                $('#notFixedFileModal #fileModalForm').html('<div style="margin: auto" class="loader-div"></div>');
            },
            success: function (response) {
                $('#notFixedFileModal .card-footer').show();
                $('#notFixedFileModal #fileModalForm').html('');
                $('#notFixedFileModal #fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            }
        });
        }else{
            <?php if(!empty($abortEditFile)): ?>
            myNotify('<?php echo e($abortEditFile["icon"]); ?>', '<?php echo e($abortEditFile["title"]); ?>', '<?php echo e($abortEditFile["type"]); ?>', '5000','<?php echo e($abortEditFile["text"]); ?>');
            <?php endif; ?>
        }
    });


    $('body').on('submit', '#notFixedFileModal #notFixedFormFileStore', function (e) {
        e.preventDefault();
        var action_url = $(this).attr('action');

        $('#file_upload_btn').attr('disabled', true);
        $('#file_upload_btn .loader').show();

        var primary_id = $('#notFixedFileModal #notFixedFormFileStore input[name="primary_id"]').val();
        if (primary_id == 0) {
            primary_id = $('#object_primary_id').val();
            $('#notFixedFileModal #notFixedFormFileStore input[name="primary_id"]').val(primary_id);

        }
        var formData = new FormData($('#notFixedFormFileStore')[0]);

        $.ajax({
            url: action_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#file_upload_btn .loader').hide();

                if (data.success == true) {
                    var interface_ = $(' #notFixedFileModal #notFixedFormFileStore input[name="activity_type"]').val();
                    get_not_fixed_attachments($('#object_primary_id').val(), interface_);

                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    $('#notFixedFileModal').modal('hide');

                } else if (data.success == false) {
                   // myNotify('warning', 'Error', 2, '5000', data.error);
                    displayResponseMessage(data.message);
                } else if (data.status == false) {
                    displayResponseMessage(data.message);
                    //myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('#file_upload_btn .loader').hide();

            }
        });
    });


    $('body').on('click', '.btnNotEditFixedFileModal', function (e) {
        var int_type=$("#interface_type_val").val();
        var allow_go=true;
        if(int_type==10){
            allow_go=$("#fixed_status_val").val() ==1;//!=3;
        }else{
            allow_go =$("#fixed_status_val").val() ==1;//!=4;
        }
        if(allow_go){
        e.preventDefault();
        var url = $(this).attr('data-href');
        $.ajax({
            url: url,
            type: 'get',
            beforeSend: function () {
                $('#notFixedFileModal .card-footer').hide();
                $('#notFixedFileModal #fileModalForm').html('');
                $('#notFixedFileModal #fileModalForm').html('<div style="margin: auto" class="loader-div"></div>');
                $('#notFixedFileModal').modal('show');
            },
            success: function (response) {
                $('#notFixedFileModal .card-footer').show();
                $('#notFixedFileModal #fileModalForm').html('');
                $('#notFixedFileModal #fileModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('input[name="files"]').fileuploader({});
            }
        });
        }else{
            <?php if(!empty($abortEditFile)): ?>
            myNotify('<?php echo e($abortEditFile["icon"]); ?>', '<?php echo e($abortEditFile["title"]); ?>', '<?php echo e($abortEditFile["type"]); ?>', '5000','<?php echo e($abortEditFile["text"]); ?>');
            <?php endif; ?>
        }
    });

    function get_not_fixed_attachments(primary_id, interface_id) {

        var url = '<?php echo e(route("attachments.not.fixed.index")); ?>' + '/' + primary_id + '/' + interface_id;
        $.ajax({
            url: url,
            type: 'get',
            beforeSend: function () {
                $('.loader-div').show();
                $('#attachments_not_fixed_div').html('');
            },
            success: function (response) {
                if (response.status == true) {
                    $('#attachments_not_fixed_div').html(response.html);
                    $('.loader-div').hide();
                    $('[data-toggle="tooltip"]').tooltip();
                    $('#attachments_not_fixed_div .selectpicker').selectpicker('refresh');
                }
            }
        });
    }
</script>
