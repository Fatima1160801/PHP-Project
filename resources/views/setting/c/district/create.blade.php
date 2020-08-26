@extends('layouts._layout')
@section('content')
    @include('setting.c.district.render_create')
{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose  card-header-icon">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_add_Districts'] ?? 'screen_add_locating'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div class="card-body ">--}}

{{--            <div id="result-msg"></div>--}}


{{--            {!! Form::open(['route' => 'settings.districts.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formDistrictCreate']) !!}--}}
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
{{--                        <a href="{{route('settings.districts')}}" class="btn btn-sm btn-default">--}}
{{--                            {{$labels['back'] ?? 'back'}}--}}
{{--                        </a>--}}
{{--                        <button type="submit" btn="btnToggleDisabled" id="btnDistrictCity" class="btn btn-next  btn-sm  btn-rose pull-right">--}}
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
    @include('setting.c.district.district_script')

    <script>
        $(document).ready(function () {
            active_nev_link('districts-link');
            funValidateForm();
            $('.selectpicker').selectpicker();

        });
        function appendTable(data,count,id,cityname,citynamefo){
            return false;
        }

        // $('#formDistrictCreate').submit(function(e){
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
        //             $('#btnDistrictCity').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {
        //             $('#btnDistrictCity').attr("disabled", false);
        //             $('.loader').hide();
        //             if (data.success == true) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                clearForm('#formDistrictCreate');
        //                 $('.loader').hide();
        //             } else if (data.success == false) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //             }
        //             //$('#addBenf').prop("disabled", false);
        //
        //
        //         },
        //         error: function (data) {
        //
        //         }
        //     });
        //
        // });

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

