<div class="card-body ">

    <div id="result-msg"></div>

    @if($save==1)
    {!! Form::open(['route' => 'item.groups.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formItemGroupCreate']) !!}
    @else
        {!! Form::open(['route' => 'item.groups.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formItemGroupUpdate']) !!}
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
                <a href="{{route('items.groups.index')}}" class="btn btn-default btn-sm">
                    {{$labels['back'] ?? 'back'}}
                </a>
                @else
                    <button type="button" id="index" class="btn btn-default btn-sm" onclick="showIndex(2)" data-dismiss="modal"><div class="loader pull-left " style="display: none;"></div>Back</button>
                @endif
                @if($save==1)
                <button btn="btnToggleDisabled" type="submit" id="btnAdditemGroup"
                        class="btn btn-next btn-rose pull-right btn-sm">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                </button>
                    @else
                        <button btn="btnToggleDisabled" type="submit" id="btnEdititemGroup"
                                class="btn-sm btn btn-next btn-rose pull-right">
                            <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    @endif
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>
