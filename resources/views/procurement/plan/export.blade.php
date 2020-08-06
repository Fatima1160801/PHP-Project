@if($export=="excel")
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
@endif
@if($export=="pdf")
<?php
header("Content-Type: application/pdf");
header("Cache-Control: max-age=0");
header("Accept-Ranges: none");
header("Content-Disposition: attachment; filename=\"google_com.pdf\"");
header("Content-Description: PHP Generated Data");
header("Content-Transfer-Encoding: binary");
?>
@endif

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <tr><td>{{$labels['project'] ?? 'Project:'}}</td>
            <td>{{$project}}</td>
        </tr>
        <tr><td>{{$labels['activity'] ?? 'Activity:'}}</td>
            <td>{{$activity}}</td>
        </tr>
        <tr><td>{{$labels['location'] ?? 'Location:'}}</td><td>@if(!empty($city))
                    @foreach($city  as $index => $item )
                        {{$item->district_name_na ?? ""}},
                    @endforeach
                @endif
            </td></tr>
        <tr><td>{{$labels['governorate'] ?? 'governorate:'}}</td><td>@if(!empty($city))
                    @foreach($city  as $index => $item )
                        {{$item->city_name_na ?? ""}},
                    @endforeach
                @endif
            </td></tr>
        <tr><td>{{$labels['currency'] ?? 'Currency'}}</td>
            <td>{{$currency}}</td>
        </tr>

    </table>
    <br>
    <table id="plan" class="table table-bordered"  >
        <thead>
        <tr>
            <th>{{$labels['serial'] ?? 'Serials'}}</th>
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
                    <td>{{$item->item ?? ""}}</td>
                    <td>{{$item->sector->sector_name_na ?? ""}}</td>
                    <td>{{$item->service->service_name_na ?? ""}}</td>
                    <td>{{$item->itemgroup->item_group_name_na ?? ""}}</td>
                    <td>{{$item->budget ?? ""}}</td>
                    <td>{{$item->start_date ?? ""}}</td>
                    <td>{{$item->delivery_date ?? ""}}</td>
                    <td>{{$item->purchase->method_name_na ?? ""}}</td>

                </tr>
            @endforeach
        @endif
        <tbody>
        </tbody>
    </table>
    <button id="cmd">generate PDF</button>
    <input type='button' id='btn' value='Print' onclick='printDiv();'>
    <input id="pdf-button" type="button" value="Download PDF" onclick="downloadPDF()" />


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="https://docraptor.com/docraptor-1.0.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script>
    var doc = new jsPDF({
        orientation:'landscape'
    });
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        var doc = new jsPDF('p','pt', 'a1', true);
        // doc.table($('#content').html(),15,15, {
        //     //'width': 50,
        //    'elementHandlers': specialElementHandlers
        // });
        // doc.save('sample-file.pdf');
        var table2 = tableToJson($('#info').get(0));
        doc.cellInitialize();
        $.each(table2, function (i, row){
            console.debug(row);
            $.each(row, function (j, cell){
                doc.cell(15, 100,100, 100, cell, i);  // 2nd parameter=top margin,1st=left margin 3rd=row cell width 4th=Row height
            })
        })
        doc.addPage();
        var table = tableToJson($('#plan').get(0));
        doc.cellInitialize();
        $.each(table, function (i, row){
            console.debug(row);
            $.each(row, function (j, cell){
                doc.cell(15, 100,150, 100, cell, i);  // 2nd parameter=top margin,1st=left margin 3rd=row cell width 4th=Row height
            })
        })


        doc.save('sample-file.pdf');
    });
    function tableToJson(table) {
        var data = [];

        // first row needs to be headers
        var headers = [];
        for (var i=0; i<table.rows[0].cells.length; i++) {
            headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace();
        }


        // go through cells
        for (var i=0; i<table.rows.length; i++) {

            var tableRow = table.rows[i];
            var rowData = {};

            for (var j=0; j<tableRow.cells.length; j++) {

                rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

            }

            data.push(rowData);
        }

        return data;
    }


    function printDiv()
    {

        var divToPrint=document.getElementById('content');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }

    var downloadPDF = function() {
        DocRaptor.createAndDownloadDoc("YOUR_API_KEY_HERE", {
            test: true, // test documents are free, but watermarked
            type: "pdf",
            document_content: document.querySelector('html').innerHTML, // use this page's HTML
            // document_content: "<h1>Hello world!</h1>",               // or supply HTML directly
            // document_url: "http://example.com/your-page",            // or use a URL
            // javascript: true,                                        // enable JavaScript processing
            // prince_options: {
            //   media: "screen",                                       // use screen styles instead of print styles
            // }
        })
    }

</script>
</body>
</html>






