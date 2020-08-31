<div class="card ">
    <div class="card-header card-header-rose card-header-text" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">person--}}
        {{--                </i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['staff'] ?? 'staff'}}        </h4>
    </div>
@if($save==1)
    {!! Form::open(['route' => 'project.staff.store'  ,'novalidate'=>'novalidate','enctype'=>'multipart/form-data','action'=>'post' ,'id'=>'formAdd']) !!}
    @else
        {!! Form::open(['route' => 'project.staff.update'   ,'novalidate'=>'novalidate','action'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formEdit']) !!}

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
@if($save==2)
                <input type="hidden" name="staff_id" id="staff_id" value="{{$data->id}}">
            @endif
        {!! $html !!}

        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
                @if($id==1)
                <a href="{{route('project.staff.index')}}" class="btn btn-sm btn-default pull-left">
                    {{$labels['back'] ?? 'back'}}</a>
                @endif
                @if($save==1)
                <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveStaff">
                    {{$labels['save'] ?? 'save'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>
                    @else
                        <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="updateStaff">
                            {{$labels['save'] ?? 'save'}}
                            <div class="loader pull-left" style="display: none;">  </div>
                        </button>
                    @endif
            </div>
        </div>

        {!! Form::close() !!}
    </div>

</div>