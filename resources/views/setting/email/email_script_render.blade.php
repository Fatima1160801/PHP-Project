<script>
    $('#btnSearch').click(function(){
        $('#button_clicked').val('search');
    });

    $('#btnSave').click(function(){
        $('#button_clicked').val('save');
    });
    $(document).on('submit', '#formSearch', function (e) {

        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = new FormData($(this)[0]);
        var url = $(this).attr('action');
        // alert($(this).attr('action'));s

        $.get('{{route('settings.email.index')}}',function(data){
            if(data.status==true) {
                $("#render_result").html(data.html);
                $('.selectpicker').selectpicker();
            }

    });
    });



</script>