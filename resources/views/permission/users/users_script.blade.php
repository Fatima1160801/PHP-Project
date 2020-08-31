<script>
    var User_row_change_group = 0;
    $('#modalUserGroup').on('hidden.bs.modal', function () {
        var user_id = User_row_change_group;
        url = '{{route("permission.group.groupForUser")}}' + '/' + user_id;
        $.ajax({
            url: url,
            type: 'get',
            dataTypes: 'html',
            beforeSend: function () {
            },
            success: function (data) {
                var htmlRow = data.html.html;
                var $editedRow = $('tr[data-id="' + User_row_change_group + '"]');
                var index = $('#table tbody tr').index($editedRow);
                // console.log(index)
                htmlRow = htmlRow.replace('{index}', index + 1);
                $editedRow.replaceWith(htmlRow);
                User_row_change_group = 0;
            },
            error: function () {
            }
        });
    });
    $(document).on('click', '#formAddSubmit', function (e) {
        e.preventDefault();
        var dataForm = $('#formAdd').serialize();

        console.log(dataForm);
        var url = $('#formAdd').attr('action');
        $.ajax({
            url: url,
            data: dataForm,
            type: 'post',
            dataTypes: 'json',
            beforeSend: function () {

            },
            success: function (data) {
                var htmlRow = data.data.html;
                var $massage='';
                if (data.status == 'save') {
                    var length = $('#table tbody tr').length;
                    htmlRow = htmlRow.replace('{index}', length + 1);
                    $(htmlRow).appendTo('#table tbody');
                    $massage="Saved Successfully";
                } else if (data.status == 'edit') {
                    var id = $('[name="id"]').val();
                    var $editedRow = $('tr[data-id="' + id + '"]');
                    var index = $('#table tbody tr').index($editedRow);
                    htmlRow = htmlRow.replace('{index}', index + 1);
                    $editedRow.replaceWith(htmlRow);
                    $massage="edited Successfully";
                }
                clearForm();

                myNotify(icon = 'done', title = 'SUCCESS',type = 'success',delay = '5000',$massage);

            },
            error: function () {

            }
        });


    });

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log(url);
        $.ajax({
            url: url,
            type: 'get',
            dataTypes: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data.data);
                distributionData(data.data);
            },
            error: function () {
            }
        });

    });

    function distributionData(data) {
        $('[name="id"]').val(data.id);
        $('[name="group_name"]').val(data.group_name);
    }

    function clearForm() {
        distributionData({});
    }
    $(".open-button").on("click", function () {
        alert("ff");
        $(this).closest('.collapse-group').find('.collapse').collapse('show');
    });

    $(".close-button").on("click", function () {
        $(this).closest('.collapse-group').find('.collapse').collapse('hide');
    });



    $(document).on('change', '.permissionCheckBoxUser', function (e) {
        e.preventDefault();
        var command_id = $(this).attr('command-id');
        var screen_id = $(this).attr('screen-id');
        var command_type_id = $(this).attr('command-type-id');
        var user_id = $(this).attr('user_id');
        var checkType = "";
        if ($(this).is(':checked')) {
            checkType = 'check';
        } else {
            checkType = 'uncheck';
        }
        data = {
            'screen_id': screen_id,
            'command_id': command_id,
            'command_type_id': command_type_id,
            'user_id': user_id,
            'checkType': checkType
        };
        var url = '{{route("permission.permission.grantUser")}}';
        $.ajax({
            url: url,
            dataTypes: 'json',
            data: data,
            type: 'post',
            beforeSend: function () {

            },
            success: function (data) {
                //console.log(data);
            },
            error: function () {

            }
        })
    })

    /****************  not edit permission grant by group to user  ******************/
    $(document).on('change', '.screenChecked', function (e) {
        e.preventDefault();

        checkClass = '.' + $(this).attr('screenNo');

        if ($(this).is(':checked')) {

            $(checkClass).each(function () {
                var attr = $(this).attr('disabled');
                //  console.log($(this).attr('disabled') != 'disabled');
                if($(this).attr('disabled') != 'disabled'){
                    $(this).prop('checked', true);
                    $(this).change();
                }
            });
        } else {
            $(checkClass).each(function () {
                if($(this).attr('disabled') != 'disabled'){
                    $(this).prop('checked', false);
                    $(this).change();
                }
            });

        }
    });
    /*group*/

    $(document).on('change', '.permissionCheckboxGroup', function (e) {
        e.preventDefault();
        var command_id = $(this).attr('command-id');
        var screen_id = $(this).attr('screen-id');
        var command_type_id = $(this).attr('command-type-id');
        var group_id = $(this).attr('group_id');

        var checkType = "";
        if ($(this).is(':checked')) {
            checkType = 'check';
        } else {
            checkType = 'uncheck';
        }
        data = {
            'screen_id': screen_id,
            'command_id': command_id,
            'command_type_id': command_type_id,
            'group_id': group_id,
            'checkType': checkType
        };
        var url = '{{route("permission.permission.grantGroup")}}';

        $.ajax({
            url: url,
            dataTypes: 'json',
            data: data,
            type: 'post',
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data);
            },
            error: function () {
            }
        })
    })
    /*checked*/
    $(document).ready(function (e) {

        $('.screenChecked').each(function () {
            $this = $(this);
            $this.prop('checked', true);
            $this.prop('disabled', false);
            checkClass = '.' + $(this).attr('screenNo');
            $index = 0;
            $disabled = 0;
            $(checkClass).each(function () {
                $index = $index + 1;
                if ($(this).is(':checked') == false) {
                    $this.prop('checked', false);
                }
                if ($(this).is(':disabled') == true) {
                    $disabled = $disabled + 1;
                }
            });
            if ($index == $disabled) {
                $this.prop('disabled', true);

            }
        });

    })
    $(document).on('submit', '#formAdd', function (e) {
        e.preventDefault();
        var form = new FormData($(this)[0]);
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#saveJobtitle').attr("disabled", true);
                $('saveJobtitle div  .loader').show();
            },
            success: function (data) {
                //  $('#btnAddbrand').attr("disabled", false);
                if (data.status == true) {

                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,data.statusObj,count,1,"","",usedStatus);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formUpdate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = new FormData($(this)[0]);
        var url = $(this).attr('action');
        // alert($(this).attr('action'));s
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#updateJobtitle').attr("disabled", true);
                $('#updateJobtitle div.loader').show();
            },
            success: function (data) {
                $('#updateJobtitle').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,data.statusObj,count,1,"","",usedStatus);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });

    });
    $(document).on("click", ".yes", function (e) {
        e.preventDefault();
        $this = $(this);
        // var project_id = $('#formProjectMain #id').val();
        var data1=$(this).attr('data-id');
        var url = '{{ route("project.jobtitle.destroy", [":id",":id1"]) }}';
        url = url.replace(':id', data1);
        url = url.replace(':id1', 2);

        var modal1="#delete"+data1;

        $.ajax({
            url: url,
            type: 'delete',
            beforeSend: function () {
            },
            success: function (data) {
                if (data.status == true) {
                    $(modal1).modal('hide');
                    $('tr[data-id='+data1+']').css('background','red').delay(1000).hide(1000)
                    // $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#contentModal .close').click();
                }else {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
            },
            error: function () {
            }


        })
    });


</script>