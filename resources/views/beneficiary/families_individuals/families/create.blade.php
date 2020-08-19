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


            {!! Form::open(['route' => 'beneficiary.fam_indev.storefm' ,'action'=>'post' ,'id'=>'formBeneficiaryFamCreate']) !!}
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
                        <a href="{{route('beneficiary.fam_indev.geteditfm',$id)}}" class="btn btn-default">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right">
                            {{$labels['save'] ?? 'save'}}

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

            $('.selectpicker').selectpicker();

        });

        $('#formBeneficiaryFamCreate').submit(function(e){

            e.preventDefault();

            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    //$('#saveProjectMain').prop("disabled", true);
                    $('.loader').css('display', 'block')
                },
                success: function (data) {

                    if (data.success == true) {
                        $('body,html').animate({scrollTop:0},600);
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        setTimeout(function(){
                            location.href = data.redirect;
                        },3000);
                        $('.loader').attr("disabled", 'false');
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('body,html').animate({scrollTop:0},600);
                    }
                    $('.loader').css('display', 'none')


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


@endsection

