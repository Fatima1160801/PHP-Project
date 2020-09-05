<script>
    $(document).on('submit', '#formDistrictCreate', function (e) {
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
                $('#btnDistrictCity').attr("disabled", true);
                $('#btnDistrictCity div .loader').show();
            },
            success: function (data) {
                $('#btnDistrictCity').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    // defaultVal2();
                    appendTable(data.district,count,2,data.cityname,data.citynamefo);
                    // $('#table').DataTable();

                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('#locationModal').modal('hide');
                //$('#addBenf').prop("disabled", false);


            },
            error: function (data) {

            }
        });

    });
    $(document).on('submit', '#formDistrictUpdate', function (e) {
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
                $('#btnDistrictUpdate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnDistrictUpdate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.district,2,data.cityname,data.citynamefo);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    //  $('#formDistrictUpdate').find('input:text,input, input:password, select, textarea').val('');                        $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnDistrictDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: '{{getMessage('2.66')['text']}}',
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



</script>