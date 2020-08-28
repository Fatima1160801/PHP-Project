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

</script>