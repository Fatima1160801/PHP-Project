<script>
    $(function () {
        active_nev_link('Localities-link');
        DataTableCall('#table',6);


        $('[data-toggle="tooltip"]').tooltip();
        //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

        $(document).on('click', '.btnLocalityDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '{{getMessage('2.150')['text']}}',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true){
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).data('href');
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


    })

</script>