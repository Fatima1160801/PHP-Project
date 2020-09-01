{{--<div class="card ">--}}
    <div class="card-header card-header-rose card-header-text">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">business_center--}}
        {{--                </i>--}}
        {{--            </div>--}}


    </div>



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

        {!! Form::hidden('id',$data->id ,['class'=>'hidden','id'=>'id']) !!}

        {!! $html !!}

        {!! Form::close() !!}

        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
                @if($id1==1)
                <a href="{{route('project.staff.index')}}"class="btn btn-sm btn-default pull-left">
                    {{$labels['back'] ?? 'back'}}
                </a>
                @else
                    <button type="button" class="btn btn-default btn-sm" onclick="staffVal()" data-dismiss="modal">Back</button>

                @endif
            </div>
        </div>
    </div>
