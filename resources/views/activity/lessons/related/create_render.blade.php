<div class="card "style="width: 106%;
    margin-top: 2px;
    /* margin-top: 0 !important; */
    /* margin-bottom: -16px; */
    margin-left: -23px;
    margin-bottom: -15px;">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['activity_lessons_related_name_na']??'activity_lessons_related_name_na'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

@if($save==1)
        {!! Form::open(['route' => 'activity.lessons.related.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLessonsRelatedCreate']) !!}
        @else
            {!! Form::open(['route' => 'activity.lessons.related.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLessonsRelatedUpdate']) !!}

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
                    <a href="{{route('activity.lessons.related')}}" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    @endif
                    @if($save==1)
                    <button type="submit" id="btnActTypeCreate" class="btn  btn-sm btn-next btn-rose pull-right">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button type="submit" id="btnActTypeUpdate" class="btn  btn-sm btn-next btn-rose pull-right">
                                <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                        @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>