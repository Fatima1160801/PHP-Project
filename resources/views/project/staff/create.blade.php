@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">person--}}
{{--                </i>--}}
{{--            </div>--}}
            <h4 class="card-title">
                {{$labels['screen_add_staff_name'] ?? 'screen_add_staff_name'}}
            </h4>
        </div>

        {!! Form::open(['route' => 'project.staff.store'  ,'novalidate'=>'novalidate','enctype'=>'multipart/form-data','action'=>'post' ,'id'=>'formAdd']) !!}
        <div class="card-body ">
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

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="{{route('project.staff.index')}}" class="btn btn-sm btn-default pull-left">
                        {{$labels['back'] ?? 'back'}}</a>
                    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveStaff">
                        {{$labels['save'] ?? 'save'}}
                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            active_nev_link('staff-link');
            $('.selectpicker').selectpicker({
                   noneSelectedText: 'لم يتم تحديد شيء',
            });
            var newdate = new Date();
            $('#dob').data("DateTimePicker").maxDate(newdate);
            funValidateForm();
        })

        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        });

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
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        // var newdate = new Date();
        // console.log(newdate);
        // newdate.setDate(newdate.getDate() + 1);
        // var dd = newdate.getDate();
        // var mm = newdate.getMonth() + 1;
        // var y = newdate.getFullYear();
        // var someFormattedDate = dd + '/' + mm + '/' + y;
        // console.log(someFormattedDate);
        // $('#dob').data("DateTimePicker").maxDate(someFormattedDate);

        // $("

    </script>
@endsection

@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>


    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>

    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
@endsection

