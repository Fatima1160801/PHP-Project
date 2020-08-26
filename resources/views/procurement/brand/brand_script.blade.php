<script>
    $(document).on('click', '.btnTypeDelete', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete brand?',
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
    $(document).on('submit', '#formBrandCreate', function (e) {
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
                $('#btnAddbrand').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {

                //  $('#btnAddbrand').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("brands.update")}}"
                    $("#formBrandCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAddbrand').attr("disabled", false);
                    $('.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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
    $(document).on('submit', '#formBrandUpdate', function (e) {

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
                $('#btnEditbrand').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditbrand').attr("disabled", false);
                editRow(data.city,1,"","");
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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
    $(document).on('submit', '#formUnitCreate', function (e) {
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
                $('#btnAddunit').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {

                // $('#btnAddunit').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    // var table = document.getElementById("table");
                    // var count = table.rows.length;
                    // var table = $('#tabl').DataTable();
                    // var count = table.data().count();
                  // var count=  $('#table').rowCount();
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,2,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("units.update")}}"
                    $("#formUnitCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAddunit').attr("disabled", false);
                    $('.loader').hide();

                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                //$("#formUnitCreate").trigger("reset");
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('units.index')}}";--}}
                {{--}, 1000);--}}

            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formUnitUpdate', function (e) {

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
                $('#btnEditunit').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditunit').attr("disabled", false);
                editRow(data.city,2,"","");
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('units.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDeleteUnit', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete unit?',
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
    $(document).on('submit', '#formSectorCreate', function (e) {
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
                $('#btnAddsector').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {

                //   $('#btnAddsector').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,3,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("sectors.update")}}"
                    $("#formSectorCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAddsector').attr("disabled", false);
                    $('.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                {{--$("#formSectorCreate").trigger("reset");--}}
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('sectors.index')}}";--}}
                {{--}, 1000);--}}

            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formSectorUpdate', function (e) {

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
                $('#btnEditsector').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditsector').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,3,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('sectors.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDeleteSector', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete sector?',
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

    $(document).on('submit', '#formServiceCreate', function (e) {
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
                $('#btnAddservice').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {


                // $('#btnAddservice').attr("disabled", true);
                $('.loader').hide();
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,4,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("services.update")}}"
                    $("#formServiceCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAddservice').attr("disabled", false);
                    // $('.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                // $("#formServiceCreate").trigger("reset");
                {{-- setTimeout(() => {--}}
                {{--     window.location.href = "{{route('services.index')}}";--}}
                {{-- }, 1000);--}}

            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formServiceUpdate', function (e) {

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
                $('#btnEditservice').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditservice').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,4,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('services.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDeleteService', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete service?',
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

    $(document).on('submit', '#formMethodCreate', function (e) {
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
                $('#btnAddmethod').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {

                // $('#btnAddmethod').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,5,"","");
                    var update_url="{{route("purchasemethods.update")}}"
                    $("#formMethodCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAddmethod').attr("disabled", false);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    $('.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                {{--$("#formMethodCreate").trigger("reset");--}}
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('purchasemethods.index')}}";--}}
                {{--}, 1000);--}}

            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formMethodUpdate', function (e) {

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
                $('#btnEditmethod').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditmethod').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,5,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('purchasemethods.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDeleteMethod', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete purchase method?',
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
    $(document).on('submit', '#formItemCreate', function (e) {
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
                $('#btnAdditem').attr("disabled", true);
                $('#btnAdditem div.loader').show();
            },
            success: function (data) {

                //  $('#btnAdditem').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("items.update")}}"
                    $("#formItemCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAdditem').attr("disabled", false);
                    $('.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                // $("#formSectorCreate").trigger("reset");
                {{-- setTimeout(() => {--}}
                {{--     window.location.href = "{{route('items.index')}}";--}}
                {{-- }, 1000);--}}

            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formItemUpdate', function (e) {

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
                $('#btnEdititem').attr("disabled", true);
                $('#btnEdititem div.loader').show();
            },
            success: function (data) {
                $('#btnEdititem').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('items.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDeleteItem', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete item?',
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

    $(document).on('click', '.btnTypeDeleteItemGroup', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are tyou sure to delete item group?',
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


    $(document).on('submit', '#formItemGroupCreate', function (e) {
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
                $('#btnAdditemGroup').attr("disabled", true);
                $('#btnAdditemGroup div.loader').show();
            },
            success: function (data) {

                //  $('#btnAdditem').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    var update_url="{{route("item.groups.update")}}"
                    $("#formItemGroupCreate").attr("action",update_url);
                    $("#id").val(data.id);
                    $('#btnAdditemGroup').attr("disabled", false);
                    $('#btnAdditemGroup div.loader').hide();
                } else if (data.status == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                //$("#formItemCreate").trigger("reset");
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('items.groups.index')}}";--}}
                {{--}, 1000);--}}

            },
            error: function (data) {

            }
        });
    });



    $(document).on('submit', '#formItemGroupUpdate', function (e) {

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
                $('#btnEdititemGroup').attr("disabled", true);
                $('#btnEdititemGroup div .loader').show();
            },
            success: function (data) {
                $('#btnEdititemGroup').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
                {{--setTimeout(() => {--}}
                {{--    window.location.href = "{{route('items.groups.index')}}";--}}
                {{--}, 1000);--}}


            },
            error: function (data) {

            }
        });

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