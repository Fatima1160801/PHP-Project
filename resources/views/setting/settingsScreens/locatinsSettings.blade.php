@extends('layouts._layout')
@section('content')

{{--    <div class="row p-4" style="row-gap: 0em;">--}}
{{--        <div class="col-md-12  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.cities")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Governorate</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-12   text-left pull-left"style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.districts")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;">--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Location</span></span>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    New--}}
{{--<div class="col-md-12 p-4" style="row-gap: 0em;">--}}
{{--    <div class="col-md-3  text-left pull-left" style="padding:2px;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.cities")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Governorate</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-3   text-left pull-left"style="padding:2px;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.districts")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;">--}}
{{--                    <span>  <i class="material-icons">location_on</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Location</span></span>--}}
{{--                </div>--}}

{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--New--}}
<div class="row p-4">
    <div class="col-xl-12"style="padding-left:200px">
<div class="card card-custom bg-gray-100 card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 bg-primary py-5">
        <h3 class="card-title font-weight-bolder text-white">System Settings</h3>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
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
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body p-0 position-relative overflow-hidden">
        <!--begin::Chart-->
        <div id="kt_mixed_widget_2_chart" class="card-rounded-bottom bg-primary" style="height: 200px; min-height: 200px;"><div id="apexcharts79jfgb55" class="apexcharts-canvas apexcharts79jfgb55 apexcharts-theme-light" style="width: 347px; height: 200px;"><svg id="SvgjsSvg1006" width="347" height="200"  version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1008" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1007"><clipPath id="gridRectMask79jfgb55"><rect id="SvgjsRect1011" width="354" height="203" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask79jfgb55"><rect id="SvgjsRect1012" width="351" height="204" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter1018" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1019" flood-color="#287ed7" flood-opacity="0.5" result="SvgjsFeFlood1019Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1020" in="SvgjsFeFlood1019Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1020Out"></feComposite><feOffset id="SvgjsFeOffset1021" dx="0" dy="5" result="SvgjsFeOffset1021Out" in="SvgjsFeComposite1020Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1022" stdDeviation="3 " result="SvgjsFeGaussianBlur1022Out" in="SvgjsFeOffset1021Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1023" result="SvgjsFeMerge1023Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1024" in="SvgjsFeGaussianBlur1022Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1025" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1026" in="SourceGraphic" in2="SvgjsFeMerge1023Out" mode="normal" result="SvgjsFeBlend1026Out"></feBlend></filter><filter id="SvgjsFilter1028" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1029" flood-color="#287ed7" flood-opacity="0.5" result="SvgjsFeFlood1029Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1030" in="SvgjsFeFlood1029Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1030Out"></feComposite><feOffset id="SvgjsFeOffset1031" dx="0" dy="5" result="SvgjsFeOffset1031Out" in="SvgjsFeComposite1030Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1032" stdDeviation="3 " result="SvgjsFeGaussianBlur1032Out" in="SvgjsFeOffset1031Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1033" result="SvgjsFeMerge1033Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1034" in="SvgjsFeGaussianBlur1032Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1035" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1036" in="SourceGraphic" in2="SvgjsFeMerge1033Out" mode="normal" result="SvgjsFeBlend1036Out"></feBlend></filter></defs><g id="SvgjsG1037" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1038" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1040" class="apexcharts-grid"><g id="SvgjsG1041" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1043" x1="0" y1="0" x2="347" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1044" x1="0" y1="20" x2="347" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1045" x1="0" y1="40" x2="347" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1046" x1="0" y1="60" x2="347" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1047" x1="0" y1="80" x2="347" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1048" x1="0" y1="100" x2="347" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1049" x1="0" y1="120" x2="347" y2="120" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1050" x1="0" y1="140" x2="347" y2="140" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1051" x1="0" y1="160" x2="347" y2="160" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1052" x1="0" y1="180" x2="347" y2="180" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1053" x1="0" y1="200" x2="347" y2="200" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1042" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1055" x1="0" y1="200" x2="347" y2="200" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1054" x1="0" y1="1" x2="0" y2="200" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1013" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1014" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><g id="SvgjsG1015" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1061" r="0" cx="115.66666666666666" cy="120" class="apexcharts-marker wux4m0u6n no-pointer-events" stroke="#287ed7" fill="#eee5ff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1016" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1056" x1="0" y1="0" x2="347" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1057" x1="0" y1="0" x2="347" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1058" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1059" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1060" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1039" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1009" class="apexcharts-annotations"></g>
                </svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 126.667px; top: 123px;"><div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;">Apr</div><div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: transparent; display: none;"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;"><div class="apexcharts-tooltip-y-group"></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 93.8854px; top: 202px;"><div class="apexcharts-xaxistooltip-text" style="font-family: Poppins; font-size: 12px; min-width: 22.5625px;">Apr</div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
        <!--end::Chart-->
        <!--begin::Stats-->
        <div class="card-spacer mt-n25">
            <!--begin::Row-->
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                    <div class="card" style="padding:2px">
                            <div class="card-icon" style="padding:0.8em;padding-top:0.5em;"  >
                                <span>  <i class="material-icons">label</i>&nbsp;&nbsp;</span>
                            </div><a style="padding-left:10px;" href="{{route("labelsSettings.index")}}"class="text-info font-weight-bold font-size-h6 mt-2">
                            Labels Settings
                        </a>   <div class="clearfix"></div>
                        </div>



                </div>
                <div class="col bg-white px-6 py-8 rounded-xl mb-7">

                  <div class="card" style="padding:2px;" >
                            <div class="card-icon" style="padding:0.8em;padding-top:0.5em;"  >
                                <span>  <i class="material-icons">settings</i>&nbsp;&nbsp;</span>
                            </div>  <a style="padding-left:10px;" href="{{route("settings.index")}}" class="text-warning font-weight-bold font-size-h6 mt-2">
                          General Settings
                      </a>   <div class="clearfix"></div>
                        </div>
                </div>
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row m-0">
                <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                    <div class="card" style="padding:2px;">
                            <div class="card-icon" style="padding:0.8em;padding-top:0.5em;">
                                <span>  <i class="material-icons">contact_mail</i>&nbsp;&nbsp;</span>
                            </div>
                            <a style="padding-left:10px;" class="text-danger font-weight-bold font-size-h6 mt-2" href="{{route("settings.email.index")}}">
                         Emails   </a>
                            <div class="clearfix"></div>
                        </div>
            </div>


                <div class="col bg-white px-6 py-8 rounded-xl">

                    <div class="card"style="padding:2px;" >
                            <div class="card-icon" style="padding:0.8em;padding-top:0.5em;"  >
                                <span>  <i class='material-icons' >notifications</i>&nbsp;&nbsp;</span>
                            </div><a style="padding-left:10px;" href="{{route("settings.notifications")}}" class="text-success font-weight-bold font-size-h6 mt-2">
                       Notifications </a> <div class="clearfix"></div>
                        </div>

                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 350px; height: 50px;"></div></div><div class="contract-trigger"></div></div></div>
    <!--end::Body-->
</div>
</div>
    </div>
@endsection
