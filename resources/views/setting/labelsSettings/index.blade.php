@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
            <h4 class="card-title">
                {{$labels['LabelsSettings'] ?? 'LabelsSettings'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route'=>'labelsSettings.index','novalidate'=>'novalidate','method'=>'post' ,'id'=>'formSearch']) !!}

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
            <input type="hidden" name="button_clicked" id="button_clicked" value="">
            <div class="col-md-12">
                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <button btn="btnToggleDisabled" type="submit" id="btnSearch"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['search'] ?? 'search'}}
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">

                    <div class=" col-md-3 bolder">
                        {{$labels['label'] ?? 'Label'}}
                    </div>
                    <div class=" col-md-3 bolder">
                        {{$labels['labelHint'] ?? 'Label  Hint'}}
                    </div>
                    <div class=" col-md-3 bolder">
                        {{$labels['labelNew'] ?? 'Label New'}}
                    </div>
                    <div class=" col-md-3 bolder">
                        {{$labels['labelHintNew'] ?? 'Label Hint New'}}
                    </div>
                </div>
            </div>
            <hr>
            @if(!empty($results) && sizeof($results) >0)
                @foreach($results as $result)
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <label for="interface_type_na" class="col-md-1 col-form-label">label</label> -->
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <label>{{$result->label ?? ""}}</label>
                                    {{--<input type="text" value="{{$result->label}}" class="form-control  " name="label_{{$result->id}}" id="label_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <label>{{$result->label_hint ?? ""}}</label>
                                    {{--<input type="text" value="{{$result->label_hint}}" class="form-control  " name="labelHint_{{$result->id}}" id="labelHint_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <input type="text" value="" class="form-control  " name="labelNew_{{$result->id}}" id="labelNew_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <input type="text" value="" class="form-control  " name="labelHintNew_{{$result->id}}" id="labelHintNew_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <button btn="btnToggleDisabled" type="submit" id="btnSave"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>
            @endif
            {!! Form::close() !!}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.system.screen')}}"'>Back</button>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            active_nev_link('visitType-link');
            funValidateForm();
            $('input').prop('required',false);
            $('input[id^="label_"]').attr('disabled',true);
            $('input[id^="labelHint_"]').attr('disabled',true);

        });

        $('#btnSearch').click(function(){
            $('#button_clicked').val('search');
        });

        $('#btnSave').click(function(){
            $('#button_clicked').val('save');
        });


        // $(document).on('submit', '#formSearch', function (e) {
        //     if (!is_valid_form($(this))) {
        //         return false;
        //     }
        //     e.preventDefault();
        //     var form = new FormData($(this)[0]);
        //     var url = $(this).attr('action');
        //     // alert(url);
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         processData: false,
        //         contentType: false,
        //         beforeSend: function () {
        //             $('#btnSearch').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {

        //            $('#btnSearch').attr("disabled", false);
        //             $('.loader').hide();

        //              $("#formSearch").trigger("reset");
        //              setTimeout(() => {  window.location.href = "/rhodes-pme-new/opportunities"; }, 1000);
        //         },
        //         error: function (data) {

        //         }
        //     });
        // });

        // $(document).on('click', '#cleanScreen', function (e) {
        //     e.preventDefault();
        //     $('#formSearch')[0].reset();
        //     // $('#beneficiary_id').selectpicker('refresh')
        // })



    </script>
@endsection



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>


@endsection

