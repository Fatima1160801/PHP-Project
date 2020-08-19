<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        table{
        }
        table,th,td {
            border:1px solid #DDDDDD;
        }
    </style>
</head>
<body>


<table >
    <thead>
    <tr  style=" background-color: #efeef6;">

        <th rowspan="1"></th>
        @foreach($result_id as $id)
            <th style=" word-wrap: break-word !important;">
                {{$data->where('result_id',$id)->first()->{'result_name_'.lang_character()} }}
            </th>
        @endforeach

    </tr>
    <tr style=" background-color: #efeef6;">
        <th style="width: 100px;"></th>
        @foreach($result_id as $id)
            <th style="width: 100px;"> Value</th>
        @endforeach
    </tr>
    </thead>
    <tbody id="report-data-list">
    @foreach($id_types as $id_type)
        <tr>
            <td>
                {{$data->where('id_type',$id_type)->first()->{'ben_name_'.lang_character()} }}
            </td>
            @foreach($result_id as $res_id)

                @php
                    $value =$data->where('id_type',$id_type)
                     ->where('result_id',$res_id)
                     ->sum('act_value');
                @endphp
                <td style="width:100px">

                    @if(isset($value)) {{round($value,2)}} @endif
                </td >
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>


</body>
</html>