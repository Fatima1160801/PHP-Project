@extends('layouts._layout')

@section('content')



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['edit_main_goals']??'edit_main_goals'}}
            </h4>
        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'goals.main.update' ,'action'=>'put' ,'novalidate'=>'novalidate','id'=>'formGoalsEdit']) !!}
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
                        <a href="{{route('goals.main.index.table')}}" class="btn btn-default btn-sm">
                            {{$labels['back']??'back'}}
                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">
                            {{$labels['save']??'save'}}
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


            funValidateForm();
        });

        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })

    </script>
@stop



@section('js')

    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@stop

