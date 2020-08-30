<div class="card-header card-header-rose  card-header-icon" id="createmodal" style="margin-top: -9%;">
    {{--            <div class="card-icon">--}}
    {{--                <i class="material-icons">desktop_windows</i>--}}
    {{--            </div>--}}
{{--    <h4 class="card-title">--}}

{{--        {{$labels['add_achievement_type' ]??'add_achievement_type'}}--}}
{{--    </h4>--}}
</div>
<div class="card-body ">

    <div id="result-msg"></div>

@if($id==1)
    {!! Form::open(['route' => ['settings.achievement.type.store',1] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formATCreate']) !!}
    @else
        {!! Form::open(['route' => ['settings.achievement.type.store',2] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formATCreate']) !!}

    @endif
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
        <a class="btn btn-primary btn-sm" href="#" id="AddRowMetric">
            <i class="fa fa-plus"></i>
        </a>

        <table class="table table-hover table-bordered" id="achievementTypeMetric">
            <thead>
            <tr>
                <th>{{$labels['metric_no' ]??'metric_no'}} </th>
                <th>{{$labels['metric_fo' ]??'metric_fo'}} </th>
                <th>{{$labels['unit' ]??'unit'}} </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text"
                                                name="metric_no[0]"></td>
                <td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text"
                                                name="metric_fo[0]"></td>
                <td style="padding: 1px">

                    <select class='form-control  selectpicker  ' name='unit[0]' required  data-style='btn btn-link'>
                        @if(sizeof($measureUnit))
                            <option style='height: 37px;' value></option>
                            @foreach($measureUnit as $index=>$unit)
                                <option style='height: 37px;' value="{{$index}}">{{$unit }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm" href="#" id="deleteRow"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">

        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
                @if($id==1)
                <a href="{{route('settings.achievement.type')}}" class="btn btn-sm btn-default">
                    {{$labels['back'] ?? 'back'}}
                </a>
                @else
                    <button type="button" onclick="index()" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </button>
                @endif
                <button type="submit" id="btnAdd" class="btn btn-next btn-sm  btn-rose pull-right">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>