<div class="card " style="margin-top: -13px;
    margin-bottom: -13px;">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
        <h4 class="card-title">
            {{$labels['screen_index_Districts'] ?? 'screen_index_Districts'}}

            {{--            @if($save==1)--}}
{{--            {{$labels['screen_add_Districts'] ?? 'screen_add_locating'}}--}}
{{--            @else--}}
{{--                {{$labels['screen_edit_Districts'] ?? 'screen_edit_locating'}}--}}
{{--            @endif--}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

@if($save==1)
        {!! Form::open(['route' => 'settings.districts.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formDistrictCreate']) !!}
        @else
            {!! Form::open(['route' => 'settings.districts.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formDistrictUpdate']) !!}
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
                    <a href="{{route('settings.districts')}}" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>@endif
                    @if($save==1)
                    <button type="submit" btn="btnToggleDisabled" id="btnDistrictCity" class="btn btn-next  btn-sm  btn-rose pull-right">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                    @else
                        <button btn="btnToggleDisabled" type="submit" id="btnDistrictUpdate" class="btn btn-next btn-sm btn-rose pull-right">
                                                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                                                </button>
                    @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>