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

                        {{$labels['team_role'] ?? 'Team Role'}}
        </h4>

    </div>

    @if($save==1)

            {!! Form::open(['route' => 'project.teamrole.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAddRole']) !!}

    @else

            {!! Form::open(['route' => 'project.teamrole.update'  ,'novalidate'=>'novalidate','method'=>'post' ,'id'=>'formUpdateRole']) !!}

    @endif

    <div class="card-body ">
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

        {!! $html !!}

        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">

                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                @if($save==1)
                    <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveRole">
                        {{$labels['save'] ?? 'save'}}


                        <div class="loader pull-left" style="display: none;">  </div>
                    </button> @else
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