<div class="card " style="width: 107%;
    margin-top: 0;
    margin-bottom: -15px;
    margin-left: -24px;">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        <h4 class="card-title" >
           Tasks Types
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

@if($save==1)
        {!! Form::open(['route' => 'settings.taskType.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formTaskTypeCreate']) !!}
        @else
            {!! Form::open(['route' => 'settings.taskType.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formtaskTypeUpdate']) !!}

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
                    @if($id1==1)
                    <a href="{{route('settings.taskType')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    @endif
                    @if($save==1)

                        <button btn="btnToggleDisabled" type="submit" id="btnAddTaskType" class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button btn="btnToggleDisabled" type="submit" id="btntaskTypeCity" class="btn-sm btn btn-next btn-rose pull-right">
                                <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                        @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>