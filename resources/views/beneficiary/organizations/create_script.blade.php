<script>
    $(document).ready(function () {
        active_nev_link('organizations');

        $('.selectpicker').selectpicker();
        funValidateForm();
    });

    // $('#formBeneficiaryOrgCreate').submit(function(e){
        $(document).on('submit','#formBeneficiaryOrgCreate',function(e){
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
                $('#btnAddBenOrg').prop("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('.loader').hide();
                $('#btnAddBenOrg').prop("disabled", false);
                $('#btnAddBenOrg').removeAttr("disabled");

                if (data.success == true) {
                    $('#formBeneficiaryOrgCreate')[0].reset();                    }
                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
            },
            error: function (data) {

            }
        });

    });

    $(document).on('change','#org_type',function (e) {
        e.preventDefault();
        var id = $(this).val();
        if(id == 1){
            $('#members_number').val('');
            $('#members_number').prop("disabled", true);
        }else{
            $('#members_number').prop("disabled", false);

        }
    });

    $(document).on('change', '#formBeneficiaryOrgCreate #city_id', function (e) {
        e.preventDefault();
        var city_id = $(this).val();
        $url = '{{route("beneficiary.oraganizations.getDistanceByCityId")}}' + '/' + city_id;

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