@extends('layouts._layout')
@section('content')
    @include('setting.visitType.create_render')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
            <h4 class="card-title">
                {{$labels['edit_visit_type'] ?? 'edit_visit_type'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'settings.visit.type.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVisitTypeUpdate']) !!}
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

            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('settings.visit.type.index')}}" class="btn btn-sm btn-default">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" id="btnVisitTypeUpdate" class="btn  btn-sm btn-next btn-rose pull-right">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('script')
    @include('project.projectcategories.othersettings_script')
    <script>
        $(document).ready(function () {
            active_nev_link('visittypeSettings');
            funValidateForm();
            $('.selectpicker').selectpicker();
        });

        // $('#formVisitTypeUpdate').submit(function(e){
        //
        //     e.preventDefault();
        //
        //     if (!is_valid_form($(this))) {
        //         return false;
        //     }
        //
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('#btnVisitTypeUpdate').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {
        //             $('#btnVisitTypeUpdate').attr("disabled", false);
        //             $('.loader').hide();
        //             if (data.success == true) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                 $('#formVisitTypeUpdate').reset();
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
function editRow(city,statusObj,id,cityname,districtname) {
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

