<script>
    $(document).ready(function () {
        active_nev_link('Localities-link');
        $('.selectpicker').selectpicker();
        funValidateForm();
    });

    // $('#formLocalityCreate').submit(function(e){
        $(document).on('submit','#formLocalityCreate',function(e){

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
                $('#btnLocalityCreate').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnLocalityCreate').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    $('[id="formLocalityCreate"]')[0].reset();
                    $("#Localities").click();
                }
                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
            },
            error: function (data) {

            }
        });

    });
    /*******************when project change in form sub activity  */

    $(document).on('change', '#formLocalityCreate #city_id', function (e) {
        e.preventDefault();
        var city_id = $(this).val();
        $url = '{{route("activity.location.getDistanceByCityId")}}' + '/' + city_id;

        $.ajax({
            url: $url,
            dataTypes: 'json',
            type: 'get',
            beforeSend: function () {
                $("#district_id option").remove();
                $("#district_id ").append("<option  style='height: 37px;' value></option>");
                $('#district_id').selectpicker('refresh');
            },
            success: function (data) {
                if (data != null) {
                    selectDestrice(data);
                }

                $('#district_id').selectpicker('refresh');
            },
            error: function () {
            }
        });
    });

    function selectDestrice(data) {

        $.each(data, function (index, value) {
            $("#district_id").append('<option value=' + index + '>' + value + '</option>');
        });
    }


</script>