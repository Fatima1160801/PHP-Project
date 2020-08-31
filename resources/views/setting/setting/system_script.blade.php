<script>
        $(document).on('submit', '#formGeneralSettings', function (e) {
        e.preventDefault();
        if (!is_valid_form($(this))) {
            return false;
        }
        var form = new FormData($(this)[0]);;
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#btnGeneralSettings').attr("disabled", true);
                $('#btnGeneralSettings div.loader').show();
            },
            success: function (data) {
                $('#btnGeneralSettings').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
            },
            error: function (data) {
            }
        });

    });
</script>