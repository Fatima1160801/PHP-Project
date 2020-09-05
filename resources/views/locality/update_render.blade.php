<div class="card-body">

    <div id="result-msg"></div>

    {!! Form::open(['route' => 'locality.update' ,'action'=>'post'  ,'novalidate'=>'novalidate'
,'id'=>'formLocalityUpdate']) !!}
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
                <a href="{{route('locality')}}" class="btn btn-default btn-sm">
                    {{$labels['back'] ?? 'back'}}
                </a>
                <button  btn="btnToggleDisabled"  type="submit" id="btnLocalityUpdate"   class="btn btn-next btn-rose pull-right btn-sm">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>