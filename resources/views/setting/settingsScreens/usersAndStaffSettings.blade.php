@extends('layouts._layout')
@section('content')

{{--    <div class="row p-4" style="row-gap: 0em;">--}}
{{--        <div class="col-md-6  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("permission.user.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Users</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-6   text-left pull-left"style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("permission.group.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;">--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Groups</span></span>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-6  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("project.staff.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Staff</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-6  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("project.jobtitle.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Team Role</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--New--}}
<div class="col-md-12 p-3" style="row-gap: 0em;">
    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("permission.user.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;"  >
                    <span>  <i class="material-icons">person</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Users</span></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="col-md-4   text-left pull-left"style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("permission.group.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;">
                    <span>  <i class="material-icons">group_work</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Groups</span></span>
                </div>

                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("project.staff.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;"  >
                    <span>  <i class="material-icons">people</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Staff</span></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >
        <a href="{{route("project.jobtitle.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                <div class="card-icon" style="padding:0.8em;"  >
                    <span>  <i class="material-icons">work</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Team Role</span></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>


@endsection
