@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['editmethod'] ?? 'edit Method'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'purchasemethods.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formMethodUpdate']) !!}
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
                        <a href="{{route('purchasemethods.index')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button btn="btnToggleDisabled" type="submit" id="btnEditmethod"
                                class="btn-sm btn btn-next btn-rose pull-right">
                            <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
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
            active_nev_link('visit-link');
            funValidateForm();
            $('.selectpicker').selectpicker();
            // $('.datetimepicker').datetimepicker({
            //     icons: {
            //         time: "fa fa-clock-o",
            //         date: "fa fa-calendar",
            //         up: "fa fa-chevron-up",
            //         down: "fa fa-chevron-down",
            //         previous: 'fa fa-chevron-left',
            //         next: 'fa fa-chevron-right',
            //         today: 'fa fa-screenshot',
            //         clear: 'fa fa-trash',
            //         close: 'fa fa-remove'
            //     },
            //     format: 'DD/MM/YYYY'
            // });
        });

        $(document).on('submit', '#formMethodUpdate', function (e) {

            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            // alert($(this).attr('action'));s
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnEditmethod').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnEditmethod').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('.loader').hide();
                    }
                    setTimeout(() => {
                        window.location.href = "{{route('purchasemethods.index')}}";
                    }, 1000);


                },
                error: function (data) {

                }
            });

        });



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

