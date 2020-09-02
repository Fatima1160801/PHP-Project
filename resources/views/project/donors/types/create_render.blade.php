<div class="card " style="margin-left: -22px;
    margin-top: 0;
    margin-bottom: -15px;
    width: 105%;">
    <div class="card-header card-header-rose card-header-text" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">business_center--}}
        {{--                </i>--}}
        {{--            </div>--}}
        <h4 class="card-title" >
            {{$labels['screen_donor_types']??'screen_donor_types'}}
        </h4>

    </div>

@if($save==1)
    {!! Form::open(['route' => 'project.donors.types.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAddFType']) !!}
    @else
        {!! Form::open(['route' => 'project.donors.types.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formEditSType']) !!}

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
                <a href="{{route('project.donors.types.index')}}"
                   class="btn btn-sm btn-default pull-left">
                    {{$labels['back'] ?? 'back'}}</a>
                @else
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                @endif
                @if($save==1)
                <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveDonor">
                    {{$labels['save'] ?? 'save'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>
                    @else
                        <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="editDonor">
                            {{$labels['edit'] ?? 'edit'}}
                            <div class="loader pull-left" style="display: none;"></div>
                        </button>
                    @endif
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>