<div class="card " style="width: 106%;
    margin-left: -24px;
    margin-top: -3px;

    /* margin-top: 0; */
    margin-top: -15px;
    margin-bottom: -16px;">
    <div class="card-header card-header-rose card-header-text" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">work--}}
        {{--                </i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            Job Title
{{--            {{$labels['job_title'] ?? 'job_title'}}--}}
        </h4>

    </div>

@if($save==1)
    @if($id1==1)
    {!! Form::open(['route' => ['project.jobtitle.store',1] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAdd']) !!}
    @else
            {!! Form::open(['route' =>[ 'project.jobtitle.store',2] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAdd']) !!}
        @endif
    @else
    @if($id1==1)
            {!! Form::open(['route' => ['project.jobtitle.update',1]  ,'novalidate'=>'novalidate','method'=>'post' ,'id'=>'formUpdate']) !!}
        @else
            {!! Form::open(['route' => ['project.jobtitle.update',2]  ,'novalidate'=>'novalidate','method'=>'post' ,'id'=>'formUpdate']) !!}
        @endif
        @endif

        <div class="card-body ">
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

        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
                @if($id1==1)
                <a href="{{route('project.jobtitle.index')}}"class="btn btn-sm btn-default pull-left">
                    {{$labels['back'] ?? 'back'}}</a>
                @else
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                @endif
                @if($save==1)
                    <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveJobtitle">
                    {{$labels['save'] ?? 'save'}}


                    <div class="loader pull-left" style="display: none;">  </div>
                </button> @else
                        <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="updateJobtitle">
                            {{$labels['save'] ?? 'save'}}
                            <div class="loader pull-left" style="display: none;">  </div>
                        </button>
                    @endif
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>