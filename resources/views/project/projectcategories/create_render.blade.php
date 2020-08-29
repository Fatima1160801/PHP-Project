<div class="card " style="    margin-left: -21px;
    margin-bottom: -14px;
    /* width: 107%; */
    width: 106%;
    margin-top: 0;">
    <div class="card-header card-header-rose card-header-text" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">work--}}
        {{--                </i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['screen_project_categories'] ?? 'Project Categories'}}


        </h4>
    </div>
@if($save==1)
    @if($id==1)
    {!! Form::open(['route' => ['project.projectcategories.store',1] ,'novalidate'=>'novalidate' ,'action'=>'post' ,'id'=>'formAdd']) !!}
        @else
            {!! Form::open(['route' => ['project.projectcategories.store',2] ,'novalidate'=>'novalidate' ,'action'=>'post' ,'id'=>'formAdd']) !!}
        @endif
        @else
        @if($id==1)
        {!! Form::open(['route' => ['project.projectcategories.update',1] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formEdit']) !!}
        @else
            {!! Form::open(['route' => ['project.projectcategories.update',2] ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formEdit']) !!}
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
                @if($id==1)
                <a href="{{route('project.projectcategories.index')}}"class="btn btn-sm btn-default pull-left">
                    {{$labels['back'] ?? 'back'}}</a>
                @else
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                @endif
                @if($save==1)
                    <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveProjectCategory">
                    {{$labels['save'] ?? 'save'}}
                    <div class="loader pull-left" style="display: none;">  </div>
                </button>
                    @else
                        <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="updateRole">
                            {{$labels['save'] ?? 'save'}}
                            <div class="loader pull-left" style="display: none;">  </div>
                        </button>
                    @endif
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>