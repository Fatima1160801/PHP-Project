<script>
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
                $('#saveProjectCategory').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                //  $('#btnAddbrand').attr("disabled", false);
                if (data.status == true) {

                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,data.statusObj,count,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formEdit', function (e) {
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
                $('.loader').show();
            },
            success: function (data) {
                $('#updateRole').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,data.statusObj,1,"","");
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
                var url = '{{ route("project.projectcategories.destroy", [":id",":id1"]) }}';
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
        $(document).on('submit', '#formVisitTypeCreate', function (e) {
        e.preventDefault();
        if (!is_valid_form($(this))) {
            return false;
        }
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnVisitTypeCreate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnVisitTypeCreate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,data.statusObj,count,2,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#btnVisitTypeCreate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }

            },
            error: function (data) {

            }
        });

    });

        $(document).on('submit', '#formVisitTypeUpdate', function (e) {
        e.preventDefault();

        if (!is_valid_form($(this))) {
            return false;
        }

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnVisitTypeUpdate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnVisitTypeUpdate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,data.statusObj,2,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formVisitTypeUpdate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });


    $(document).on('click', '.btnVisitTypeDelete', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete visit type?',
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
    $(document).on('click', '.deleteAcType', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete  Measure Unit?',
            confirmButtonClass: 'btn btn-success  btn-sm',
            cancelButtonClass: 'btn btn-danger  btn-sm',
            buttonsStyling: false,
            showCancelButton: true
        }).then(result => {
            if (result == true) {
                // var project_id = $('#formProjectMain #id').val();
                url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'delete',
                    data: {"_token": "{{csrf_token()}}"},
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data.status == 'true') {
                            $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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
    $(document).on('submit', '#formIndicatorUnitCreate', function (e) {
        if (!is_valid_form($(this))) {
            return false
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
                $('#btnSave').attr("disabled", true);
                // $('.loader').show();
            },
            success: function (data) {
                //  $('#btnAddbrand').attr("disabled", false);
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,4,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });

    })
    $(document).on('submit', '#formIndicatorEdit', function (e) {
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
                $('#btnEdit').attr("disabled", true);
                // $('.loader').show();
            },
            success: function (data) {
                $('#btnEdit').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,"",4,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });


    })
        $(document).on('submit', '#formUpdate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnUpdate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnUpdate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,"",5,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formUpdate').reset();
                    resetFormUpdate();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
    function resetFormCreate() {
        $('#formCreate #income_name_na').val('');
        $('#formCreate #income_name_fo').val('');
    }
    function resetFormUpdate() {
        $('#formUpdate #income_name_na').val('');
        $('#formUpdate #income_name_fo').val('');
    }


    $(document).on('submit', '#formCreate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnSave').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnSave').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,5,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formCreate').reset();
                    resetFormCreate();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
            },
            error: function (data) {

            }
        });

    });
        $(document).on('submit', '#formCurrencyCreate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnAddCurrency').attr("disabled", true);

                $('.loader').show();
            },
            success: function (data) {

                if (data.status == 'true') {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,6,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#formCurrencyCreate')[0].reset();
                    $('#btnAddCurrency').attr("disabled", false);
                    $('.loader').hide();

                } else if (data.status == 'false') {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
        $(document).on('submit', '#formCurrencyUpdate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnUpdateCurrency').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnUpdateCurrency').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,"",6,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formBeneficiaryCreate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }

            },
            error: function (data) {

            }
        });

    });

    $(document).on('click', '.btnCDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete currency?',
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
        $(document).on('submit', '#formLessonsTypeCreate', function (e) {
        e.preventDefault();
        if (!is_valid_form($(this))) {
            return false;
        }
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnActTypeCreate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnActTypeCreate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,7,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formActTypeCreate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
        $(document).on('submit', '#formLessonsTypeUpdate', function (e) {
        e.preventDefault();

        if (!is_valid_form($(this))) {
            return false;
        }

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnActTypeUpdate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnActTypeUpdate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,"",7,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formActTypeUpdate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnIssueDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete issue type?',
            confirmButtonClass: 'btn btn-success  btn-sm',
            cancelButtonClass: 'btn btn-danger  btn-sm',
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

        $(document).on('submit', '#formLessonsRelatedCreate', function (e) {
        e.preventDefault();
        if (!is_valid_form($(this))) {
            return false;
        }
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnActTypeCreate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnActTypeCreate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,8,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formActTypeCreate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
        $(document).on('submit', '#formLessonsRelatedUpdate', function (e) {
        e.preventDefault();

        if (!is_valid_form($(this))) {
            return false;
        }

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnActTypeUpdate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnActTypeUpdate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,"",8,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formActTypeUpdate').reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnRelatedtDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete related issue type?',
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
    $(document).on('click', '.btnAchievementDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete achievement type?',
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
    // $('#formCreate').submit(function (e) {
    $(document).on('submit', '#formATCreate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnAdd').attr("disabled", true);
                // $('#btnAdd div. loader').show();
            },
            success: function (data) {
                $('#btnAdd').attr("disabled", false);
                // $('#btnAdd div.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // clearForm('#formCreate');
                    $('.loader').hide();
                    var url = '{{ route("settings.achievement.type.update",[":id",":id1"]) }}';
                    url = url.replace(':id', data.id);
                    url = url.replace(':id1',2);

                    $("#formATCreate").attr("action",url);
                                    $("#id").val(data.id);
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);

            },
            error: function (data) {

            }
        });

    });
    var row_id = $('#achievementTypeMetric >tbody >tr').length;
    var measureUnit =@json($measureUnit); //measureVal();

    function addRow() {
        row_id += 1;
        var html = ' <tr>';
        html += '<td style="padding: 1px"> <input required style="width: 100%;" class="form-control " type="text" name="metric_no[' + row_id + ']"></td>';
        html += '<td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text" name="metric_fo[' + row_id + ']"></td>';
        html += '<td style="padding: 1px"><select required class="form-control  selectpicker "  name="unit[' + row_id + ']"  data-style="btn btn-link" >';
        html += '<option style="height: 37px;" value=""></option>';
        $.each(measureUnit, function (index, value) {
            html += '<option style="height: 37px;" value="' + index + '">' + value + '</option>';
        });
        html += '</select></td>';
        html += ' <td style="padding: 1px" >';
        html += '    <a class="btn btn-danger btn-sm" href="#" id="deleteRow"><i class="fa fa-remove"></i></a>';
        html += ' </td> </tr>';
        $('#achievementTypeMetric tbody').append(html);
        $('.selectpicker').selectpicker('refresh');
    }

    $(document).on('click', '#AddRowMetric', function (e) {
        e.preventDefault();
        addRow();
    })
    $(document).on('click', '#deleteRow', function (e) {
        e.preventDefault();
        $this = $(this);
        var href = $(this).attr('href');
        if (href == '#') {
            $(this).closest('tr').remove();
        } else {

            swal({
                text: 'Are you sure to delete?	',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $this.closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        },
                        error: function () {
                        }
                    });
                }
            })
        }


    })
    $(document).on('submit', '#formATUpdate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnAdd').attr("disabled", true);
                $('#btnAdd div.loader').show();
            },
            success: function (data) {
                $('#btnAdd').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                     $('.loader').hide();
                } else if (data.status == 'false') {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }

            },
            error: function (data) {

            }
        });

    });
    //for funders
    function setFormValidation(id) {
        $(id).validate({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement: function (error, element) {
                $(element).append(error);
            },
        });
    }
    $(document).on('submit', '#formAddFType', function (e) {
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
                $('#saveDonor').attr("disabled", true);
                $('#saveDonor div.loader').show();
            },
            success: function (data) {

                //  $('#btnAddbrand').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,"",count,10,data.statusObj,"");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("project.donors.types.update")}}"
                    $("#formAddFType").attr("action",update_url);
                    $("#id").val(data.city.id);
                    $('#saveDonor').attr("disabled", false);
                    $('.loader').hide();
                } else if (data.status == false) {

                }
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
    $(document).on('submit', '#formEditSType', function (e) {

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
                $('#editDonor').attr("disabled", true);
                $('#editDonor div .loader').show();
            },
            success: function (data) {
                $('#editDonor').attr("disabled", false);

                $('.loader').hide();
                if (data.status == true) {
                    alert("before");
                    editRow(data.city,"",10,data.statusObj,"");
                    alert(data.statusObj);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    alert("after");
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('brands.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '#DeleteDonorType', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete donors type?',
            confirmButtonClass: 'btn btn-success  btn-sm',
            cancelButtonClass: 'btn btn-danger  btn-sm',
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
    $(document).on('click', '#deleteDonor', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete donors ?',
            confirmButtonClass: 'btn btn-success  btn-sm',
            cancelButtonClass: 'btn btn-danger  btn-sm',
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

</script>
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>
@endsection