<div class="card " style="width: 106%;
    margin-top: 0;
    margin-bottom: -14px;
    margin-left: -23px;
">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
         {{$labels['purchasemethods'] ?? 'Purchase Methods'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

        @if($save==1)
        {!! Form::open(['route' => 'purchases.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formMethodCreate']) !!}
        @else
            {!! Form::open(['route' => 'purchasemethods.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formMethodUpdate']) !!}

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
                    <a href="{{route('purchasemethods.index')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    @endif
                    @if($save==1)
                    <button btn="btnToggleDisabled" type="submit" id="btnAddmethod"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                    @else
                            <button btn="btnToggleDisabled" type="submit" id="btnEditmethod"
                                    class="btn-sm btn btn-next btn-rose pull-right">
                                <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                    @endif
                <!-- <a href="#" id="cleanScreen" class="btn  btn-info pull-right btn-sm">
                            {{$labels['clean'] ?? 'clean'}}
                        </a> -->
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>
