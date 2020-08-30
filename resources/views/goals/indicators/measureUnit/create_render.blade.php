<div class="card " style="margin-left: -22px;
    margin-bottom: -14px;
    margin-top: 0;
    width: 103%;">
    <div class="card-header card-header-rose  card-header-icon"id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['screen_indicator_measure_unit']?? 'screen_indicator_measure_unit'}}
        </h4>
    </div>
    <div class="card-body ">

@if($save==1)
    @if($id==1)
        {!! Form::open(['route' => ['goals.indicators.measure.unit.store',1]  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formIndicatorUnitCreate']) !!}
            @else
                {!! Form::open(['route' => ['goals.indicators.measure.unit.store',2]  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formIndicatorUnitCreate']) !!}

            @endif
        @else
    @if($id==1)
                {!! Form::open(['route' => ['goals.indicators.measure.unit.update',1]  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formIndicatorEdit']) !!}
            @else
                {!! Form::open(['route' => ['goals.indicators.measure.unit.update',2]  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formIndicatorEdit']) !!}
            @endif
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

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    @if($id==1)
                    <a href="{{route('goals.indicators.measure.unit.index')}}" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                    @endif
                    @if($save==1)
                    <button type="submit" class="btn btn-next btn-rose pull-right btn-sm" id="btnSave">
                        {{$labels['save'] ?? 'save'}}
                    </button>
                    @else
                        <button type="submit" class="btn btn-next btn-rose pull-right btn-sm" id="btnEdit">
                            {{$labels['edit'] ?? 'edit'}}
                        </button>
                    @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>
