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
    $(document).on('click', '#formAddSubmitGroup', function (e) {
        e.preventDefault();
        var dataForm = $('#formAddGroup').serialize();

        // console.log(dataForm);
        var url = $('#formAddGroup').attr('action');
        $.ajax({
            url: url,
            data: dataForm,
            type: 'post',
            dataTypes: 'json',
            beforeSend: function () {
                $('#formAddSubmitGroup').attr("disabled", true);
            },
            success: function (data) {
                var htmlRow = data.data.html;
                var $massage='';
                if (data.status == 'save') {
                    $("#group").click();
                    // alert("before");
                    var length = $('#table tbody tr').length;
                    // alert("after");
                    htmlRow = htmlRow.replace('{index}', length + 1);
                    // alert(htmlRow);
                    // $(htmlRow).appendTo('#table tbody');
                    // $("#table tbody").append(htmlRow);
                    $(htmlRow).insertAfter("#table tr:first");
                    // alert("after");
                }
                    // $massage="Saved Successfully";
                 else if (data.status == 'edit') {
                    var id = $('[name="id"]').val();
                    var $editedRow = $('tr[data-id="' + id + '"]');
                    var index = $('#table tbody tr').index($editedRow);
                    htmlRow = htmlRow.replace('{index}', index + 1);
                    $editedRow.replaceWith(htmlRow);
                    $massage="edited Successfully";
                }
                 clearForm();
                $('#formAddSubmitGroup').attr("disabled", false);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                // myNotify(icon = 'done', title = 'SUCCESS',type = 'success',delay = '5000',$massage);
                },

            error: function () {

            }
        });
    });
    $(document).on('click', '.user-status-id', function (e) {
        e.preventDefault();
        $this = $(this);
        var user_id = $this.attr('user-id');
        data = {
            'user_id': user_id,
        };
        var $messageConf ="";
        if($(this).attr('status')== '1'){
            $messageConf ='{{getMessage('2.18')['text']}}',
            $this.attr('status','3');
            $this.attr('data-original-title','Un lock');
        }else if($(this).attr('status')== '3'){
            $messageConf ='{{getMessage('2.19')['text']}}',
            $this.attr('status','1');
            $this.attr('data-original-title',' lock');
        }

        swal(
            {
                text: $messageConf,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
            }).then(result => {
            if (result) {


                var url = '{{route("permission.user.userstatus")}}';
                $.ajax({
                    url: url,
                    dataTypes: 'json',
                    data: data,
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        console.log(data)
                        if (data == 'lock') {
                            $($this).children('i').removeClass(" material-icons").text("lock ");
                            $($this).children('i').addClass("material-icons");
                        } else if (data == 'lock_open') {
                            $($this).children('i').removeClass("material-icons ").text("lock_open ");
                            $($this).children('i').addClass(" material-icons ");
                        }

                    },
                    error: function () {
                    }
                })
            }
        }).catch(swal.noop);
    })



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
        $(document).on("click", '.open-button', function () {

        $(this).closest('.collapse-group').find('.collapse').collapse('show');
    });


        $(document).on("click", '.close-button', function () {
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
                $('#saveJobtitle div  .loader').show();
            },
            success: function (data) {

                if (data.status == true) {
                    $('#btnAddbrand').attr("disabled", false);
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    // appendTable(data.city,data.statusObj,count,1,"","",data.usedStatus);
                    $("#teamrole").click();
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
                $('.loader').hide();
                if (data.status == true) {
                    $('#updateJobtitle').attr("disabled", false);
                    editRow(data.city,data.statusObj,1,"","",data.usedStatus);
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

                    $('tr[data-id='+data1+']').css('background','red').delay(1000).hide(1000)
                    // $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#contentModal .close').click();
                }else {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }$(modal1).modal('hide');
            },
            error: function () {
            }


        })
    });
    $(document).on('click', '#addGroupToUser', function (e) {
        e.preventDefault();
        var user_id = $(this).attr('user_id');
        User_row_change_group = user_id;
        url = '{{route("permission.group.userGroup")}}' + '/' + user_id;
        $.ajax({
            url: url,
            type: 'get',
            dataTypes: 'html',
            beforeSend: function () {
            },
            success: function (data) {
                $('#contentModal').empty();
                $('#contentModal').html(data.html.html);

            },
            error: function () {
            }
        });
    });

    $(document).on('submit', '#formEditStaff', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }
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
                $('#updateStaff').attr("disabled", true);
                $('#updateStaff div .loader').show();
            },
            success: function (data) {

                //  $('#btnAddbrand').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('#updateStaff').attr("disabled", false);
                //$('#addBenf').prop("disabled", false);
                {{--$("#formBrandCreate").trigger("reset");--}}
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('brands.index')}}";--}}
                {{--}, 1000);--}}

            },
            error: function (data) {

            }
        });
    });

    $(document).on('submit', '#formAddStaff', function (e) {
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
                $('#saveStaff').attr("disabled", true);
                $('#saveStaff div  .loader').show();
            },
            success: function (data) {
                 $('#saveStaff').attr("disabled", false);
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    {{--var update_url="{{route("project.staff.update",1)}}"--}}
                    {{--        $("#formAddStaff").attr("action",update_url);--}}
                    {{--                $("#id").val(data.city.id);--}}
                    $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });
    });
    $(document).on('change','#staff_id',function (e) {
        console.log(123);
        e.preventDefault();
        var staff_id = $(this).val();
        $url = '{{route('permission.user.staff_ajax')}}' + '/' + staff_id;
        $.ajax({
            url: $url,
            dataTypes: 'json',
            type: 'get',
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data.job_title_name_na);
                if(data){
                    $('#user_full_name').val(data.staff_name_na)
                    $('#email').val(data.email)
                    $('[name="job_title"]').val(data.job_title_name_na)
                }

            },
            error: function () {

            }
        });
    })
        $(document).on("click", ".yes1", function (e) {
        e.preventDefault();
        $this = $(this);
        // var project_id = $('#formProjectMain #id').val();
        var data1=$(this).attr('data-id');
        var url = '{{ route("project.staff.destroy", [":id",":id1"]) }}';
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

                    $('tr[data-id='+data1+']').css('background','red').delay(1000).hide(1000)
                    // $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#contentModal .close').click();
                }else {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }$(modal1).modal('hide');
            },
            error: function () {
            }


        })
    });
    $(function () {

        $('input[name="projects_perms_type"]').change(function(){
            var value = $(this).val();

            if(value == 'all' || value == 'inc')
            {
                $('.project').hide();
            }
            else if(value == 'some')
            {
                $('.project').show();
            }
        });

        $('input[name="activities_perms_type"]').change(function(){
            var value = $(this).val();
            if(value == 'all' || value == 'inc')
            {
                $('.activity').hide();
            }
            else if(value == 'some')
            {
                $('.activity').show();
            }
        });

            $(document).on("submit", "#formUserDataPermission", function (e) {

            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('#formAddSubmit_').attr("disabled", true);
                    // $('.loader').show();
                },
                success: function (data) {
                    $('.loader').hide();
                    $('#formAddSubmit_').attr("disabled", false);
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                },
                error: function (data) {
                }
            });
        });

    });

    $(document).on("submit", "#formEditUser", function (e) {

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
                $('#formAddSubmit44444').attr("disabled", true);
                // $('.loader').show();
            },
            success: function (data) {
                $('.loader').hide();
                $('#formAddSubmit44444').attr("disabled", false);
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
            },
            error: function (data) {
            }
        });
    });
    $(document).on('submit', '#formAddRole', function (e) {
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
                $('#saveRole').attr("disabled", true);
                $('#saveRole div  .loader').show();
            },
            success: function (data) {
                //  $('#btnAddbrand').attr("disabled", false);
                if (data.status == true) {

                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    // appendTable(data.city,data.statusObj,count,5,"","","");
                    $("#teamrole1").click();
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formUpdateRole', function (e) {
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
                $('#updateRole').attr("disabled", true);
                $('#updateRole div.loader').show();
            },
            success: function (data) {
                $('#updateRole').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,data.statusObj,5,"","","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });

    });

    $(document).on('click', '.deleteTeamRole', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: '{{getMessage('2.1004')['text']}}',
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
                        if (data.status == true) {
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
    $(document).on('submit', '#formUpdateRole', function (e) {
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
                $('#updateRole').attr("disabled", true);
                $('#updateRole div.loader').show();
            },
            success: function (data) {
                $('#updateRole').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,data.statusObj,5,"","","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });

    });


    $(document).on('submit', '#formAddUser', function (e) {
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
                $('#formAddSubmitUser').attr("disabled", true);
                $('#formAddSubmitUser div.loader').show();
            },
            success: function (data) {
                $('#formAddSubmitUser').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });

    });
    $(document).on('change','#screen_id',function (e) {
        $('#loader').show();
        e.preventDefault();
        var screen = $('#screen_id').find(":selected").val();
        var val = $("#btnGroupPrm").attr("data-id");
        $.get('{{url('permission')}}' + '/' + 'group' + '/' + val+ '/' + screen, function (data) {
            if (data.status == true) {
                $("#grant_result").html(data.html);
                $('.loader').hide();
            }
        });
    });
    $(document).on('change','#screen_iduser',function (e) {
        $("#loader").show();
        e.preventDefault();
        var screen = $('#screen_iduser').find(":selected").val();
        var val = $("#btnGroupPrm").attr("data-id");
        $.get('{{url('permission')}}' + '/' + 'user' + '/' + val+ '/' + screen, function (data) {
            if (data.status == true) {
                $("#grant_result").html(data.html);
                $('.loader').hide();
            }
        });
    });
</script>