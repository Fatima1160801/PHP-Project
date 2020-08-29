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
            text: 'Are you sure to delete visit type',
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
            text: 'Are you sure to delete  Measure Unit',
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