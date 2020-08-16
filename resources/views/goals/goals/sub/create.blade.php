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


            {!! Form::open(['route' => 'goals.sub.store' ,'action'=>'post'  ,'novalidate'=>'novalidate','id'=>'formGoalsSubCreate']) !!}
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
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <td>#</td>
                        <td>
                            {{$labels['sub_goals']??'sub_goals'}}
                        </td>
                        <td>
                            {{$labels['actions']??'actions'}}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goalsSubByMain as $index=>$goal)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$goal->goal_name_na}}</td>
                            <td>
                                <a href="{{route('goals.sub.edit',$goal->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab"
                                   rel="tooltip" data-original-title="" title="{{$labels['edit_sub_goals']??'edit_sub_goals'}}  "
                                   data-placement="top" id="EditGoals">
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
            funValidateForm();
        });
        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })
    </script>
@endsection
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
@endsection

