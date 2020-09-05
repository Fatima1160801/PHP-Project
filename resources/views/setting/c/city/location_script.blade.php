<script>
    $(document).on('submit', '#formCityCreate', function (e) {

        //$('#formCityCreate').submit(function(e){
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
                $('#btnAddCity').attr("disabled", true);
                $('#btnAddCity div.loader').show();
            },
            success: function (data) {
                $('#btnAddCity').attr("disabled", false);
                $('.loader').hide();
                if (data.status == 'true') {

                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    clearForm('#formCityCreate');
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;

                    appendTable(data.city,count,1,"","");
                    // $('#table').DataTable();

                    $('#locationModal').modal('hide');
                 {{--// }--}}
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

    $(document).on('submit', '#formCityUpdate', function (e) {
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
                $('#btnUpdateCity').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnUpdateCity').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,1,"","");
                    // $('tr[data-id='+data.city.id+']').find("td:eq(1)").text(data.city.city_name_no);
                    // $('tr[data-id='+data.city.id+']').find("td:eq(2)").text(data.city.city_name_fo);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    // $('#formBeneficiaryCreate').reset();
                    $('.loader').hide();
                    $('#locationModal').modal('hide');
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }

            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnCityDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure you want to delete city ?',
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