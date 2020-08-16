@extends('layouts._layout')

@section('content')



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$screenName_add}}
                <br>
                {{$screenName}}</h4>
        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'goals.results.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formResultsCreate']) !!}
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
                            {{$labels['save']??'save'}}</button>
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
                            {{$labels['results']??'results'}}
                        </td>
                        <td>
                            {{$labels['actions']??'actions'}}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resultByIndicator as $index=>$result)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$result->result_name_na}}</td>
                            <td>
                                <a href="{{route('goals.results.edit',$result->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab btn-sm"
                                   rel="tooltip" data-original-title=""
                                   title="{{$labels['edit_result']??'edit_result'}}"
                                   data-placement="top" id="EditResult">
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

@endsection
@section('script')

    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();

            //is_measurable();
            funValidateForm();

        });

        $(document).on('submit', '#formResultsCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })

        $(document).on('change', '#is_measurable', function (e) {
            e.preventDefault();
            is_measurable();
        })

        function is_measurable() {
            $is_measurable = $('#is_measurable').val();
            if ($is_measurable == 1) {
                $('#result_unit').prop('disabled', false);
                $('#result_unit').selectpicker('refresh');
                $('#is_direct').prop('disabled', false);
                $('#is_direct').selectpicker('refresh');
            } else if ($is_measurable == 2) {
                $('#result_unit').val('');
                $('#result_unit').prop('disabled', true);
                $('#result_unit').selectpicker('refresh');
                $('#is_direct').val('');
                $('#is_direct').prop('disabled', true);
                $('#is_direct').selectpicker('refresh');
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
