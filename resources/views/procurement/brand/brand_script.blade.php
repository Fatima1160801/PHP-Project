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
                    appendTable(data.city,data.count,1,"","");
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
                    var table = $('#table').dataTable();
                    var count=table.fnSettings().fnRecordsTotal();
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



</script>