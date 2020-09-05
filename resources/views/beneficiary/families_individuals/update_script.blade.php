<script>
    $(document).ready(function () {
        active_nev_link('families_individuals')
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

    // $('#formBeneficiaryUpdate').submit(function(e){
        $(document).on('submit','#formBeneficiaryUpdate',function(e){
        e.preventDefault();

        if(checkNumberIndividualFamily() == false){
            myNotify("warning","warning", "warning", '5000', 'The total "No. Males" and "No. Females" should equal the "Households Individuals Number"');
            return;
        }

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
                $('#editBenf').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#editBenf').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    $('body,html').animate({scrollTop:0},600);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    if(data.ben_type_befor != data.ben_type_after && data.ben_type_after == 2) {
                        $('#taps_').append(' <li id="ben_fam_tap" class="nav-item">\n' +
                            '                    <a class="nav-link" data-toggle="tab" href="#benFam" role="tablist">\n' +
                            '                        Family Members\n' +
                            '                    </a>\n' +
                            '                </li>');
                    } else if(data.ben_type_after == 1) {
                        $('#ben_fam_tap').hide();
                    }
                    $('.loader').attr("disabled", 'false');
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
            },
            error: function (data) {
            }
        });
    });


    $(function () {



        DataTableCall('#table',6);

        $('[data-toggle="tooltip"]').tooltip();
    })


    /*///////////*****delete staff****//////////*/
    $(document).on('click', '#btnFamIndevDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: '{{getMessage('2.41')['text']}}',
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


    // $('#btn-createfm-modal').click(function(){
        $(document).on('click', '#btn-createfm-modal', function (e) {
            e.preventDefault();
        var url = $(this).attr('href');
        $.get(url,function(data){
            if(data.status==true){
            $('#createfm-modal-form').html(data.html);
            $('.selectpicker').selectpicker({
                @if(Auth::user()->lang_id == 2 )
                noneSelectedText: 'لم يتم تحديد شيء',
                @endif
            });
            $('#createfmModal').modal({
                show: true
            });
        }  });


    });


    // $('#formBeneficiaryFamCreate').submit(function(e){
        $(document).on('submit','#formBeneficiaryFamCreate',function(e){
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
                //$('#saveProjectMain').prop("disabled", true);
                $('.loader').css('display', 'block');
                $("#saveInd div .loader").show();
            },
            success: function (data) {

                if (data.success == true) {
                    var url1 = '{{ route("beneficiary.fam_indev.deletefm", ":id") }}';
                    url1 = url1.replace(':id', data.beneficiaryFamily.id);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#createfmModal .close').click();
                    $('.loader').attr("disabled", 'false');
                    $('#enfamtable').append('<tr data-id='+data.beneficiaryFamily.id+'>'+
                        '<td></td>'+
                        '<td>'+data.beneficiaryFamily.ind_name_na+'</td>'+
                        '<td>'+data.beneficiaryFamily.ind_idno+'</td>'+
                        '<td>'+data.beneficiaryFamily.relation_type+'</td>' +
                        '<td>'+data.beneficiaryFamily.created_at+'</td>' +
                        '<td>' +
                        '<a href="#"\n' +
                        ' data-toggle="tooltip" data-placement="top" title="" data-id='+data.beneficiaryFamily.id+' class="mytooltip btn-setting-nav editBenFam">' +
                        '<i class="material-icons">edit</i><span class="mytooltiptext">edit</span>' +
                        ' </a>' +


                        '<a href='+url1+'\n' +
                        'id="btnFamIndevDelete" rel="tooltip" class="mytooltip btn-setting-nav" ' +

                        'data-placement="top"  title="Delete Individual">' +
                        '<i class="material-icons">delete</i><span class="mytooltiptext">delete</span>'+
                        '</a>'+

                        '</td>'+'</tr>'
                    );
                    $("#saveInd div .loader").hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('.loader').css('display', 'none')


            },
            error: function (data) {

            }
        });

    });



    // $('#formBeneficiaryFamUpdate').submit(function(e){
        $(document).on('submit','#formBeneficiaryFamUpdate',function(e){
        e.preventDefault();
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                //$('#saveProjectMain').prop("disabled", true);
                $('.loader').css('display', 'block')
$("#updatefmind div .loader").show();
            },
            success: function (data) {
                if (data.success == true) {
                    $('tr[data-id='+data.beneficiaryFamily.id+']').find("td:eq(1)").text(data.beneficiaryFamily.ind_name_na);
                    $('tr[data-id='+data.beneficiaryFamily.id+']').find("td:eq(2)").text(data.beneficiaryFamily.ind_idno);
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#editfmModal .close').click();
                    $('.loader').attr("disabled", 'false');
                } else if (data.success == false) {

                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                $('.loader').css('display', 'none');

            },
            error: function (data) {

            }
        });

    });

    // $('#modal-dismiss').click(function(){
        $(document).on('click', '#modal-dismiss', function (e) {
        $('#createfmModal .close').click();
    });

    // $('.editBenFam').click(function(){
        $(document).on('click', '.editBenFam', function (e) {
        // var url = $(this).attr('href');
            var val=$(this).attr("data-id");
            $.get('{{url('beneficiary/fam_indev')}}'+'/'+val+'/edit_fm',function(data){
            {{--$('#editfmModal-modal-form').html(response);--}}
            {{--$('.selectpicker').selectpicker({--}}
            {{--    @if(Auth::user()->lang_id == 2 )--}}
            {{--    noneSelectedText: 'لم يتم تحديد شيء',--}}
            {{--    @endif--}}
            {{--});--}}
            if(data.status==true){
                $('#editfmModal-modal-form').html(data.html);
                $('.selectpicker').selectpicker({
                    @if(Auth::user()->lang_id == 2 )
                    noneSelectedText: 'لم يتم تحديد شيء',
                    @endif
                });
                $('#editfmModal').modal({
                    show: true
                });
            }  });


    });
    $(document).on('change', '#formBeneficiaryUpdate #ben_city', function (e) {
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