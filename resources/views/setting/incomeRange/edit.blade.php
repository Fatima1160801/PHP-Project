@extends('layouts._layout')
@section('content')
    @include('setting.incomeRange.render_create')
{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose  card-header-icon">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_edit_IncomeRange'] ?? 'screen_edit_IncomeRange'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div class="card-body ">--}}

{{--            <div id="result-msg"></div>--}}


{{--            {!! Form::open(['route' => 'settings.incomeRange.update'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formUpdate']) !!}--}}
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            {!! $html !!}--}}


{{--            <div class="col-md-12">--}}

{{--                <div class="card-footer ml-auto mr-auto">--}}
{{--                    <div class="ml-auto mr-auto">--}}
{{--                        <a href="{{route('settings.incomeRange.index')}}" class="btn btn-default btn-sm">--}}
{{--                            {{$labels['back'] ?? 'back'}}--}}
{{--                        </a>--}}
{{--                        <button type="submit" id="btnUpdate" class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            {!! Form::close() !!}--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
@section('script')
    @include('project.projectcategories.othersettings_script')
    <script>
        $(document).ready(function () {
            active_nev_link('incomeRange-link');
            funValidateForm();
            $('.selectpicker').selectpicker();

        });

        // $('#formUpdate').submit(function(e){
        //     if (!is_valid_form($(this))) {
        //         return false;
        //     }
        //
        //     e.preventDefault();
        //
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('#btnUpdate').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {
        //             $('#btnUpdate').attr("disabled", false);
        //             $('.loader').hide();
        //             if (data.success == true) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                 // $('#formUpdate').reset();
        //                 resetForm();
        //                 $('.loader').hide();
        //             } else if (data.success == false) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //             }
        //             //$('#addBenf').prop("disabled", false);
        //
        //
        //
        //         },
        //         error: function (data) {
        //
        //         }
        //     });
        //
        // });
        // function resetForm() {
        //     $('#formCreate #income_name_na').val('');
        //     $('#formCreate #income_name_fo').val('');
        // }
        function editRow(data,status,id,cityname,districtname){
            return false;
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

