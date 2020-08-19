@extends('layouts._layout')
@section('content')

{{--    <div class="row p-4" style="row-gap: 0em;">--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("project.projectcategories.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Institution Roles</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4   text-left pull-left"style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.visit.type.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;">--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Visits Types</span></span>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.achievement.type")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Achievements Types</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("goals.indicators.measure.unit.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Achievements Units Types</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.incomeRange.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Income Ranges</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.currency")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Currencies</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("activity.lessons.type")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Issues Types</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-4  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("activity.lessons.related")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Issues Relations Settings</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--New--}}
{{--<div class="col-md-12 p-3" style="row-gap: 0em;">--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("project.projectcategories.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">local_offer</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Institution Roles</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4   text-left pull-left"style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.visit.type.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;">--}}
{{--                    <span>  <i class="material-icons">weekend</i>&nbsp; &nbsp;<span style="color:white;font-weight: bold">Visits Types</span></span>--}}
{{--                </div>--}}

{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.achievement.type")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">card_giftcard</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Achievements Types</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("goals.indicators.measure.unit.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">card_giftcard</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Achievements Units Types</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.incomeRange.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">payment</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Income Ranges</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.currency")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">money</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Currencies</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("activity.lessons.type")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">subject</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Issues Types</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("activity.lessons.related")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">settings</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Issues Relations Settings</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}

{{--New New--}}
{{--<div class="row p-3" style="row-gap: 0em;margin-left:200px">--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("project.projectcategories.index")}}">--}}
{{--                                <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                                    <i class="material-icons" style="color:white;font-size:27px;">local_offer</i>--}}
{{--                                </div>--}}

{{--                <span style="color:white;font-weight: bold;margin:12px">Institution Roles</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--       </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("settings.visit.type.index")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">weekend</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;margin:12px">Visits Types</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("settings.achievement.type")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">card_giftcard</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;">Achievements Types</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("goals.indicators.measure.unit.index")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">card_giftcard</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;">Achievements Units Types</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("settings.incomeRange.index")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">payment</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;margin:12px">Income Range</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("settings.currency")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">money</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;margin:12px">Currencies</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="w-100"></div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("activity.lessons.type")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">subject</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;margin:12px">Issues Types</span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}
{{--        <a href="{{route("activity.lessons.related")}}">--}}
{{--            <div class="card-icon" style="padding:3em;padding-bottom:3px"  >--}}
{{--                <i class="material-icons" style="color:white;font-size:27px;">settings</i>--}}
{{--            </div>--}}

{{--            <span style="color:white;font-weight: bold;">Issues Relations Settings </span></a>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--    <div class="col-md-2" style="width:10em;height: 10em;background-color:#348e99;margin:2px">--}}

{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}

{{--</div>--}}
{{--  New New  --}}
<div class="card-header border-0 bg-primary py-5">
    <h3 class="card-title font-weight-bolder text-white">Sales Stat</h3>
    <div class="card-toolbar">
        <div class="dropdown dropdown-inline">
            <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi navi-hover">
                    <li class="navi-header pb-1">
                        <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-shopping-cart-1"></i>
																		</span>
                            <span class="navi-text">Order</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-calendar-8"></i>
																		</span>
                            <span class="navi-text">Event</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-graph-1"></i>
																		</span>
                            <span class="navi-text">Report</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-rocket-1"></i>
																		</span>
                            <span class="navi-text">Post</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-writing"></i>
																		</span>
                            <span class="navi-text">File</span>
                        </a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
        </div>
    </div>
</div>
@endsection
