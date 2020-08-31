<div class="card-header card-header-rose  card-header-icon" id="createmodal">
    {{--            <div class="card-icon">--}}
    {{--                <i class="material-icons">desktop_windows</i>--}}
    {{--            </div>--}}
    <h4 class="card-title">
        General Settings
    </h4>
</div>
<div class="card-body ">

    <div id="result-msg"></div>


    {!! Form::open(['route' => 'settings.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formGeneralSettings','enctype'=>'multipart/form-data']) !!}
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
                <a href="{{route('home')}}" class="btn btn-default btn-sm">
                    {{$labels['back'] ?? 'back'}}
                </a>
                <button type="submit" id="btnGeneralSettings" class="btn btn-next btn-rose pull-right btn-sm">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
    @if($id==1)
    <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.system.screen')}}"'>Back</button>
@endif
</div>