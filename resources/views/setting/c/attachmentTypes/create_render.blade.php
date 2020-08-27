<div class="card ">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
{{--                    <div class="card-icon">--}}
{{--                        <i class="material-icons">desktop_windows</i>--}}
{{--                    </div>--}}
        <h4 class="card-title">

            {!! $labels['attachment_types'] ??'attachment_types' !!}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

        @if($save==1)
        {!! Form::open(['route' => 'settings.attachment_types.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAttachmentTypesCreate']) !!}
        @else
            {!! Form::open(['route' => 'settings.attachment_types.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAttachmentTypesUpdate']) !!}

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
                    <a href="{{route('settings.attachment_types')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    @endif
                    @if($save==1)
                    <button type="submit" id="btnAddAttachmentTypes" class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                        @else
                            <button type="submit" id="btnUpdateAttachmentTypes" class="btn btn-next btn-rose pull-right btn-sm">
                                <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                            </button>
                        @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>