@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['add_beneficiary'] ?? 'add_beneficiary'}}
            </h4>
        </div>
        <div class="card-body ">

        <div id="result-msg"></div>


            {!! Form::open(['route' => 'beneficiary.fam_indev.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBeneficiaryCreate']) !!}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! $html !!}

			<div class="row">
                @if($customFields->count() > 0)
                    <input type="hidden" name="custom_fields_count" value="{{$customFields->count()}}">
                    @foreach($customFields as $customField)
                        {!! customField($customField,json_decode($beneficiary->custom_fields,true)) !!}
                    @endforeach
                @endif
            </div>
            <hr>
					
            <div class="col-md-12">
                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('beneficiary.fam_indev.index')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" id="addBenf" class="btn btn-next btn-rose pull-right btn-sm" btn="btnToggleDisabled">
                            <div class="loader pull-left" style="display: none;"></div>
                            {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
    <div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تحذير</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <p style=" text-align: center; font-size: 14px; line-height: 24px; ">Are you sure you want to do this?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        لا
                        </button>
                    <button id="btnModelSave" type="button" class="btn btn-success btn-link">نعم

                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
@endsection



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>


@endsection

