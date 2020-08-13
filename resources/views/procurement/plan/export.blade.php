<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=plan.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        #plan   {
            border:solid;
        }

        .new_style{
            margin: auto;
            width: 90%;
            padding-top: 20px;
        }

    </style>
</head>
<body>
<div id="content" class="new_style">
    <table id="info" class="p-5">
        <tr>
            <th></th>
            <th></th>
        </tr>
        @if($id==1)
        <tr><td><strong style="font-weight: bold;">Project</strong></td>
            <td>{{$project ?? ""}}</td>
        </tr>
        @if($screentype==1 || $screentype==3)
        <tr><td><strong style="font-weight: bold;" >Activity</strong></td>
            <td>{{$activity ?? ""}}</td>
        </tr>
        <tr><td><strong style="font-weight: bold;" >Location</strong></td>
            <td>@if(!empty($city))
                    @foreach($city  as $index => $item )
                        {{$item->district_name_na ?? ""}},
                    @endforeach
                @endif
            </td></tr>
        <tr><td><strong style="font-weight: bold;" >Governorate</strong></td><td>@if(!empty($city))
                    @foreach($city  as $index => $item )
                        {{$item->city_name_na ?? ""}},
                    @endforeach
                @endif
            </td></tr>@endif
        <tr><td><strong style="font-weight: bold;" >Currency</strong></td>
            <td>{{$currency ?? ""}}</td>
        </tr>
        @else
            <tr><td><strong style="font-weight: bold;">المشروع</strong></td>
                <td>{{$projectfo ?? ""}}</td>
            </tr>
            @if($screentype==1 || $screentype==3)
                <tr><td><strong style="font-weight: bold;" >النشاط</strong></td>
                    <td>{{$activityfo ?? ""}}</td>
                </tr>
                <tr><td><strong style="font-weight: bold;" >الموقع</strong></td>
                    <td>@if(!empty($city))
                            @foreach($city  as $index => $item )
                                {{$item->district_name_fo ?? ""}},
                            @endforeach
                        @endif
                    </td></tr>
                <tr><td><strong style="font-weight: bold;" >المحافظة</strong></td><td>@if(!empty($city))
                            @foreach($city  as $index => $item )
                                {{$item->city_name_fo ?? ""}},
                            @endforeach
                        @endif
                    </td></tr>@endif
            <tr><td><strong style="font-weight: bold;" >العملة</strong></td>
                <td>{{$currencyfo ?? ""}}</td>
            </tr>
        @endif

    </table>
    <br>
    <table id="plan" class="table table-bordered"  >
        <thead>
        <tr>
            <th>{{$labels['serial'] ?? 'Serials'}}</th>
            @if($screentype==2)
                <th>{{$labels['activities'] ?? 'Activity'}}</th>
            @endif
            <th>{{$labels['item'] ?? 'Items'}}</th>
            <th>{{$labels['sector'] ?? 'Sectors'}}</th>
            <th>{{$labels['service'] ?? 'Services'}}</th>
            <th>{{$labels['itemgroup'] ?? 'Item Groups'}}</th>
            <th>{{$labels['budget'] ?? 'Budgets'}}</th>
            <th>{{$labels['start_date'] ?? 'Start Dates'}}</th>
            <th>{{$labels['delivery_date'] ?? 'Delivery Dates'}}</th>
            <th>{{$labels['purchaseway'] ?? 'Purchase Ways'}}</th>
        </thead>
        @if(!empty($arr))
            @foreach($arr  as $index => $item)
                <tr>
                    <td>{{$index+1}}</td>
                    @if($id==1)
                    @if($screentype==2)
                        <td>{{$item->activity_names->activity_name_na ?? ""}}</td>
                    @endif
                    <td>{{$item->item ?? ""}}</td>
                    <td>{{$item->sector->sector_name_na ?? ""}}</td>
                    <td>{{$item->service->service_name_na ?? ""}}</td>
                    <td>{{$item->itemgroup->item_group_name_na ?? ""}}</td>
                    <td>{{$item->budget ?? ""}}</td>
                    <td>{{$item->start_date ?? ""}}</td>
                    <td>{{$item->delivery_date ?? ""}}</td>
                    <td>{{$item->purchase->method_name_na ?? ""}}</td>
                    @else
                        @if($screentype==2)
                            <td>{{$item->activity_names->activity_name_fo ?? ""}}</td>
                        @endif
                        <td>{{$item->item ?? ""}}</td>
                        <td>{{$item->sector->sector_name_fo ?? ""}}</td>
                        <td>{{$item->service->service_name_fo ?? ""}}</td>
                        <td>{{$item->itemgroup->item_group_name_fo ?? ""}}</td>
                        <td>{{$item->budget ?? ""}}</td>
                        <td>{{$item->start_date ?? ""}}</td>
                        <td>{{$item->delivery_date ?? ""}}</td>
                        <td>{{$item->purchase->method_name_fo ?? ""}}</td>
                    @endif
                </tr>
            @endforeach
        @endif
        <tbody>
        </tbody>
    </table>
</div>
</body>
</html>
