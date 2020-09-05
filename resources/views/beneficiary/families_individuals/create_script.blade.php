<script>
    $(document).ready(function () {
        active_nev_link('families_individuals');
        $('.selectpicker').selectpicker({
            @if(Auth::user()->lang_id == 2 )

            noneSelectedText: 'لم يتم تحديد شيء',
            @endif
        });
        funValidateForm();
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            format: 'DD/MM/YYYY'
        });
    });

    var duplicateBenficiaryIDFlag=0;
    $(document).on('submit','#formBeneficiaryCreate',function(e){

        e.preventDefault();

        if(checkNumberIndividualFamily() == false){
            myNotify("warning","warning", "warning", '5000', 'The total "No. Males" and "No. Females" should equal the "Households Individuals Number"');
            return;
        }
        if (!is_valid_form($(this))) {
            return false;
        }
        var form = $(this).serialize();
        form=form+'&flagID='+duplicateBenficiaryIDFlag;
        $duplicateBenficiaryIDFlag=0;
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#addBenf').attr("disabled", true);
                $('.loader').show();

            },
            success: function (data) {
                $('#addBenf').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#formBeneficiaryCreate')[0].reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }else if(data.success == 'individual'){

                    $('#myModal10 .modal-body p').html(data.text);
                    $('#myModal10').modal('show');


                }
            },
            error: function (data) {
            }
        });
    });
    $(document).on('click','#btnModelSave',function () {
        duplicateBenficiaryIDFlag =1;
        $('#formBeneficiaryCreate').submit();
        $('#myModal10').modal('hide');

    })
    $(document).on('change', '#formBeneficiaryCreate #ben_city', function (e) {
        e.preventDefault();
        var city_id = $(this).val();
        $url = '{{route("beneficsettingsiary.getDistanceByCityId")}}' + '/' + city_id;

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
    function checkNumberIndividualFamily() {

        var no_of_family =   $('#no_of_family').val() || 0;
        var no_males =   $('#no_males').val()|| 0;
        var no_females =   $('#no_females').val()|| 0;
        var individualNo = parseFloat(no_males)+ parseFloat(no_females);

        if( parseFloat(no_of_family) ==  parseFloat(individualNo)){
            return true;
        }else{
            return false;
        }
    }
</script>