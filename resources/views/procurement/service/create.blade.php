@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['addservice'] ?? 'Add Service'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'services.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formServiceCreate']) !!}
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
                        <a href="{{route('services.index')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button btn="btnToggleDisabled" type="submit" id="btnAddservice"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    <!-- <a href="#" id="cleanScreen" class="btn  btn-info pull-right btn-sm">
                            {{$labels['clean'] ?? 'clean'}}
                            </a> -->
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
            active_nev_link('visit-link');
            funValidateForm();
        });

        $(document).on('submit', '#formServiceCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false;
            }
            e.preventDefault();
            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnAddservice').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {

                    $('#btnAddservice').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        $('.loader').hide();
                    } else if (data.status == 'false') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //$('#addBenf').prop("disabled", false);
                   // $("#formServiceCreate").trigger("reset");
                    setTimeout(() => {
                        window.location.href = "{{route('services.index')}}";
                    }, 1000);

                },
                error: function (data) {

                }
            });
        });

        // $(document).on('click', '#cleanScreen', function (e) {
        //     e.preventDefault();
        //     $('#formOppStatusCreate')[0].reset();
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

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>


@endsection

