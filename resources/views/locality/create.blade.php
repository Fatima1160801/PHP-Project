{{--@extends('layouts._layout')--}}
{{--@section('content')--}}
{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose  card-header-icon">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_add_locality'] ?? 'screen_add_locality'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div class="card-body ">--}}

{{--            <div id="result-msg"></div>--}}


{{--            {!! Form::open(['route' => 'locality.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLocalityCreate']) !!}--}}
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
{{--                        <a href="{{route('locality')}}" class="btn btn-default btn-sm">--}}
{{--                            {{$labels['back'] ?? 'back'}}--}}
{{--                        </a>--}}
{{--                        <button  btn="btnToggleDisabled"  type="submit" id="btnLocalityCreate" class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            {!! Form::close() !!}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            active_nev_link('Localities-link');--}}
{{--            $('.selectpicker').selectpicker();--}}
{{--            funValidateForm();--}}
{{--        });--}}

{{--        $('#formLocalityCreate').submit(function(e){--}}

{{--            e.preventDefault();--}}
{{--            if (!is_valid_form($(this))) {--}}
{{--                return false;--}}
{{--            }--}}
{{--            var form = $(this).serialize();--}}
{{--            var url = $(this).attr('action');--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                data: form,--}}
{{--                type: 'post',--}}
{{--                beforeSend: function () {--}}
{{--                    $('#btnLocalityCreate').attr("disabled", true);--}}
{{--                    $('.loader').show();--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    $('#btnLocalityCreate').attr("disabled", false);--}}
{{--                    $('.loader').hide();--}}
{{--                    if (data.success == true) {--}}
{{--                         $('[id="formLocalityCreate"]')[0].reset();--}}
{{--                    }--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                },--}}
{{--                error: function (data) {--}}

{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--        /*******************when project change in form sub activity  */--}}

{{--        $(document).on('change', '#formLocalityCreate #city_id', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var city_id = $(this).val();--}}
{{--            $url = '{{route("activity.location.getDistanceByCityId")}}' + '/' + city_id;--}}

{{--            $.ajax({--}}
{{--                url: $url,--}}
{{--                dataTypes: 'json',--}}
{{--                type: 'get',--}}
{{--                beforeSend: function () {--}}
{{--                    $("#district_id option").remove();--}}
{{--                    $("#district_id ").append("<option  style='height: 37px;' value></option>");--}}
{{--                    $('#district_id').selectpicker('refresh');--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    if (data != null) {--}}
{{--                        selectDestrice(data);--}}
{{--                    }--}}

{{--                    $('#district_id').selectpicker('refresh');--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        function selectDestrice(data) {--}}

{{--            $.each(data, function (index, value) {--}}
{{--                $("#district_id").append('<option value=' + index + '>' + value + '</option>');--}}
{{--            });--}}
{{--        }--}}


{{--    </script>--}}
{{--@endsection--}}



{{--@section('js')--}}
{{--    <!-- Forms Validations Plugin -->--}}
{{--    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>--}}
{{--    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->--}}
{{--    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>--}}
{{--    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>--}}

{{--    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->--}}
{{--    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>--}}


{{--@endsection--}}

@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['screen_add_locality'] ?? 'screen_add_locality'}}
            </h4>
        </div>
        @include('locality.create_form_render')

    </div>

@endsection
@section('script')
    @include('locality.script_render')
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

