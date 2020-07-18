
@extends('layouts._layout')
@section('content')


            <h4 class="card-title">

                {{$labels['procurementsetting'] ?? 'Procurement Settings'}}
            </h4>
            <br>


    <div class="col-md-12">
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("brands.index")}}"><div class="card">
                    <div class="card-header card-header-warning card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['brands'] ?? 'Brand'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("items.index")}}"><div class="card">
                    <div class="card-header card-header-success card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">reorder</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['item'] ?? 'Item'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("units.index")}}"><div class="card">
                    <div class="card-header card-header-primary card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">storage</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['units'] ?? 'Unit'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("items.groups.index")}}"><div class="card">
                    <div class="card-header card-header-secondary card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">group_work</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['itemgroups'] ?? 'Item Groups'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("sectors.index")}}"><div class="card">
                    <div class="card-header card-header-rose card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">line_weight</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['sectors'] ?? 'Sector'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("services.index")}}"><div class="card">
                    <div class="card-header card-header-info card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">  {{$labels['services'] ?? 'Service'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("purchasemethods.index")}}"><div class="card">
                    <div class="card-header card-header-danger card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">payment</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['purchasemethods'] ?? 'Purchase Method'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection



@extends('layouts._layout')
@section('content')

    <div class="col-md-12">
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("brands.index")}}"><div class="card">
                    <div class="card-header card-header-warning card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['brands'] ?? 'Brand'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("items.index")}}"><div class="card">
                    <div class="card-header card-header-success card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">reorder</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['item'] ?? 'Item'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("units.index")}}"><div class="card">
                    <div class="card-header card-header-primary card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">storage</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['units'] ?? 'Unit'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("items.groups.index")}}"><div class="card">
                    <div class="card-header card-header-secondary card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">group_work</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold"> {{$labels['itemgroups'] ?? 'Item Groups'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("sectors.index")}}"><div class="card">
                    <div class="card-header card-header-rose card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">line_weight</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['sectors'] ?? 'Sector'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("services.index")}}"><div class="card">
                    <div class="card-header card-header-info card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">  {{$labels['services'] ?? 'Service'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
            <a href="{{route("purchasemethods.index")}}"><div class="card">
                    <div class="card-header card-header-danger card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">payment</i>
                        </div>
                        <p class="card-category" style="color:#000;font-weight: bold">{{$labels['purchasemethods'] ?? 'Purchase Method'}}

                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>


@endsection


