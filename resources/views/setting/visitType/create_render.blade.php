<div class="card " style="margin-left: -23px;
    margin-bottom: -14px;
    margin-top: 0;
    width: 106%;">
    <div class="card-header card-header-rose  card-header-icon "id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['visit_type']??'visit_type'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

@if($save==1)
        {!! Form::open(['route' => 'settings.visit.type.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVisitTypeCreate']) !!}
        @else
            {!! Form::open(['route' => 'settings.visit.type.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVisitTypeUpdate']) !!}

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
                    <a href="{{route('settings.visit.type.index')}}" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                    @endif
                    @if($save==1)
                    <button type="submit" id="btnVisitTypeCreate" class="btn  btn-sm btn-next btn-rose pull-right">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button type="submit" id="btnVisitTypeUpdate" class="btn  btn-sm btn-next btn-rose pull-right">
                                <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                        @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>
