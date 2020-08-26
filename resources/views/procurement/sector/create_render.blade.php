<div class="card ">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
          <i class="material-icons">business</i>  {{$labels['sectors'] ?? 'sectors'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

        @if($save==1)
        {!! Form::open(['route' => 'sectors.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formSectorCreate']) !!}
        @else
            {!! Form::open(['route' => 'sectors.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formSectorUpdate']) !!}
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
                    <a href="{{route('sectors.index')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                    @endif
                        @if($save==1)
                    <button btn="btnToggleDisabled" type="submit" id="btnAddsector"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button btn="btnToggleDisabled" type="submit" id="btnEditsector"
                                                            class="btn-sm btn btn-next btn-rose pull-right">
                                                        <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                                                    </button>@endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>
