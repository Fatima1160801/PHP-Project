@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                General Settings
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'settings.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formGeneralSettings','enctype'=>'multipart/form-data']) !!}
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
                        <a href="{{route('home')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" id="btnGeneralSettings" class="btn btn-next btn-rose pull-right btn-sm">
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
    <script>
        $(document).ready(function () {
            active_nev_link('settings');
            $('.selectpicker').selectpicker();
            funValidateForm();
        });

        $('#formGeneralSettings').submit(function(e){

            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var form = new FormData($(this)[0]);;
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnGeneralSettings').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnGeneralSettings').attr("disabled", false);
                    $('.loader').hide();
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                },
                error: function (data) {
                }
            });

        });

    </script>
@endsection



@section('js')
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>


@endsection

