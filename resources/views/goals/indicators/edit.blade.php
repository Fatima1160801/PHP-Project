@extends('layouts._layout')

@section('content')


    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$screenNameadd}}<br>
                {{$screenName}}</h4>
        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'goals.indicators.update' ,'novalidate'=>'novalidate','action'=>'put' ,'id'=>'formIndicatorEdit']) !!}
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
                        <a href="{{route('goals.main.index.table')}}" class="btn btn-default  btn-sm">
                            {{$labels['back']??'back'}}

                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right  btn-sm">
                            {{$labels['edit']??'edit'}}
                        </button>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <td>#</td>
                        <td>
                            {{$labels['indicator']??'indicator'}}
                        </td>
                        <td>
                            {{$labels['action']??'action'}}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($indicatorsByGoal as $index=>$indicator)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$indicator->indic_name_na}}</td>
                            <td>
                                <a href="{{route('goals.indicators.edit',$indicator->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab btn-sm"
                                   rel="tooltip" data-original-title="" title="{{$labels['edit']??'edit'}}"
                                   data-placement="top" id="EditIndicator">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('script')

    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();

            funValidateForm();
            active_nev_link('indicators_type');
            $('#is_measurable').change();
        });

        $(document).on('submit', '#formIndicatorEdit', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })

       $(document).on('change','#is_measurable',function (e) {
           e.preventDefault();
           is_measurable();
       })

        function is_measurable() {
            $is_measurable = $('#is_measurable').val();
            if($is_measurable == 1){
                // $('#indic_unit').removeAttr('disabled');
                // $('#is_collect').removeAttr('disabled');
                 $('#indic_unit').prop('disabled', false);
                $('#indic_unit').selectpicker('refresh');
                 $('#is_collect').prop('disabled', false);
                $('#is_collect').selectpicker('refresh');


            }else if($is_measurable == 2){
                // $('#indic_unit').attr('disabled','disabled');
                // $('#is_collect').attr('disabled','disabled');
                $('#indic_unit').val('');
                $('#indic_unit').prop('disabled', true);
                $('#indic_unit').selectpicker('refresh');
                $('#is_collect').val('');
                $('#is_collect').prop('disabled', true);
                $('#is_collect').selectpicker('refresh');
            }
        }
    </script>
@stop



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@stop


