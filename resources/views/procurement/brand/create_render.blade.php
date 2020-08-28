<div class="card " style="margin-bottom: -12px;
    margin-top: 0;
    margin-right: 3px !important;
    width: 110%;
    /* margin-right: -14px; */
    margin-left: -20px;">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
        {{$labels['brand'] ?? ' Brand'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

        @if($save==1)
        {!! Form::open(['route' => 'brands.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBrandCreate']) !!}
        @else
            {!! Form::open(['route' => 'brands.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBrandUpdate']) !!}
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
                    <a href="{{route('brands.index')}}" class="btn  btn-sm btn-default backButtons">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    @endif
                    @if($save==1)
                    <button btn="btnToggleDisabled" type="submit" id="btnAddbrand"
                            class="btn btn-next pull-right btn-sm btn-rose saveButtons">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                    @else
                        <button btn="btnToggleDisabled" type="submit" id="btnEditbrand"
                                class="btn-sm btn btn-next  pull-right btn-rose
">
                            <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    @endif

                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>