<div class="card-body ">
    <h4 class="createmodal" style="margin-left: 42%;
    font-weight: bold;">Localities</h4>
    <div id="result-msg"></div>


    {!! Form::open(['route' => 'locality.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLocalityCreate']) !!}
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
{{--                <a href="{{route('locality')}}" class="btn btn-default btn-sm">--}}
{{--                    {{$labels['back'] ?? 'back'}}--}}
{{--                </a>--}}
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

                <button  btn="btnToggleDisabled"  type="submit" id="btnLocalityCreate" class="btn btn-next btn-rose pull-right btn-sm">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>