
@extends('layouts._layout')
@section('content')

        <div class="col-md-12">
            <div class="col-lg-4 col-md-4 col-sm-4 text-left pull-left" >
                <a href="{{route("brands.index")}}"><div class="card">
                    <div class="card-header card-header-warning card-header-icon mb-4 mt-4">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
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
                            <i class="material-icons">weekend</i>
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
                                <i class="material-icons">weekend</i>
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
                                <i class="material-icons">weekend</i>
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
                                <i class="material-icons">weekend</i>
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
                                <i class="material-icons">weekend</i>
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



{{--                        <div class="col-sm-4"style="margin-top:+2em;margin-left:+5em;">--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3em;">--}}
{{--                                <a href="{{route('brands.index')}}" >--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span> &nbsp; Brands--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p>--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3em;">--}}
{{--                                <a href="{{route('sectors.index')}}">--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span> &nbsp; Sectors--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p>--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3cm;">--}}
{{--                                <a href="{{route('items.index')}}">--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span> &nbsp; Items--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4" style="margin-top:+3em;margin-left:+5em;" >--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3em;">--}}
{{--                                <a href="{{route('items.groups.index')}}">--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span> &nbsp; Item Groups--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p>--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3em;">--}}
{{--                                <a href="{{route('units.index')}}">--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span>&nbsp; Units--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p>--}}
{{--                            <p style="margin-top:+2cm;margin-bottom:+3em;">--}}
{{--                                <a href="{{route('purchasemethods.index')}}">--}}
{{--                                    <span class="glyphicon glyphicon-asterisk"></span>&nbsp; Purchases Methods--}}
{{--                                </a>--}}
{{--                                <br/>--}}
{{--                                &nbsp hgfddsfgfd--}}
{{--                            </p></div>--}}
{{--                        <p style="margin-top:+3cm;margin-left:+3em;">--}}
{{--                            <a href="{{route('services.index')}}">--}}
{{--                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp; Services--}}
{{--                            </a>--}}
{{--                            <br/>--}}
{{--                            &nbsp hgfddsfgfd--}}
{{--                        </p>--}}



{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose  card-header-icon">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['additemgroup'] ?? 'Add Item Groups '}}--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div class="card-body ">--}}
{{--           --}}
{{--        </div>--}}
{{--    </div>--}}
@endsection


