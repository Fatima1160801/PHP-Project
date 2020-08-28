{{--<div class="card ">--}}
{{--    <div class="card-header card-header-rose  card-header-icon" id="createmodal">--}}
{{--        --}}{{--            <div class="card-icon">--}}
{{--        --}}{{--                <i class="material-icons">desktop_windows</i>--}}
{{--        --}}{{--            </div>--}}
{{--        <h4 class="card-title">--}}
{{--          <i class="material-icons">games</i>  {{$labels['items'] ?? 'items'}}--}}
{{--        </h4>--}}
{{--    </div>--}}
    <div class="card-body ">

        <div id="result-msg"></div>

        @if($save==1)
        {!! Form::open(['route' => 'items.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formItemCreate']) !!}
        @else
            {!! Form::open(['route' => 'items.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formItemUpdate']) !!}
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
                    <a href="{{route('items.index')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" id="index" class="btn btn-default btn-sm" onclick="showIndex(1)" data-dismiss="modal"><div class="loader pull-left " style="display: none;"></div>Back</button>
                    @endif
                    @if($save==1)
                    <button btn="btnToggleDisabled" type="submit" id="btnAdditem"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button btn="btnToggleDisabled" type="submit" id="btnEdititem"
                                    class="btn-sm btn btn-next btn-rose pull-right">
                                <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                        @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
{{--</div>--}}
