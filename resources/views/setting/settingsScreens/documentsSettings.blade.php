@extends('layouts._layout')
@section('content')

{{--    <div class="row p-4" style="row-gap: 0em;">--}}
{{--        <div class="col-md-9  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.attachment_types")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Documents Types</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-9   text-left pull-left"style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.documents.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;">--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Documents Settings</span></span>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--New--}}
<div class="col-md-12 p-4" style="row-gap: 0em;">
    <div class="col-md-3  text-left pull-left" style="padding:2px;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("settings.attachment_types")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;"  >
                    <span>  <i class="material-icons" >cloud_upload</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Documents Types</span></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="col-md-3   text-left pull-left"style="padding:2px;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("settings.documents.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;">
                    <span>  <i class="material-icons">settings</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Documents Settings</span></span>
                </div>

                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>


@endsection
