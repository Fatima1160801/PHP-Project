@extends('layouts._layout')
@section('content')
    <h4 class="card-title">

        {{$labels['procurementsetting'] ?? 'Procurement Settings'}}
    </h4>
    <div class="col-md-12" style="row-gap: 0em;padding:1 1 1 1">
        <div class="col-sm-4 col-sm-4 col-sm-4 text-left pull-left" style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("brands.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;"  >
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['brands'] ?? 'Brand'}}</span></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4    text-left pull-left"style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("items.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['item'] ?? 'Item'}}</span></span>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4  text-left pull-left" style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("units.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['units'] ?? 'Unit'}}</span></span>

                    </div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4 text-left pull-left"style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("items.groups.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['itemgroups'] ?? 'Item Groups'}}</span></span>

                    </div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4 text-left pull-left" style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("sectors.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['sectors'] ?? 'Sector'}}</span></span>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4 text-left pull-left" style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("services.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon" style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['services'] ?? 'Service'}}</span></span>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
{{--        <div class="w-100"></div>--}}
        <div class="col-sm-4 col-sm-4 col-sm-4  text-left pull-left"style="padding:6em;padding-bottom: 0.5em;padding-top:0.5em;" >
            <a href="{{route("purchasemethods.index")}}"><div class="card"style="background-color: #5d76a8;margin:0 0 0 0">
                    <div class="card-icon"style="padding:0.8em;">
                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">{{$labels['purchasemethods'] ?? 'Purchase Method'}}</span></span>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>


@endsection