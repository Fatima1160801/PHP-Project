<html>
<head>

    <style type="text/css" media="print">
        @page {
            /*size: landscape;*/
        }

        @media print {
            #btn-print {
                display: none !important;
            }

            body {
                text-align: center !important;
            }

            .table  {
                border-collapse: collapse;
            }

            .table , .table th, .table td {
                border: 1px solid black;
            }

            table tr td {
                padding: 5px;
            }
            .table .value{
                border: 1px solid #ddd;
            }
            .title{
                                text-align: left !important;
                padding: 0;
                margin: 0;
                padding-top: 10px;
            }
        }
    </style>


    <style>
        table  {
           width: 100%;
        }
        .table  {
            border-collapse: collapse;
            font-size: 12px;
        }

        .table , .table th, .table td {
            border: 1px solid #b1b1b1;

        }
        td{
            padding: 0;
            padding-left: 3px;
            padding-right: 3px;
        }

    </style>
</head>
<body style="padding: 50px">

<hr>
<h4 class="title">Basic Information :</h4>

<table class="table">
    <tbody>
    <tr>
        <td width="15%">Beneficiary No :</td>
        <td width="30%">{{$beneficiary->id}}</td>

        <td width="15%" >Beneficiary Name "English" :</td>
        <td width="30%">{{$beneficiary->ben_name_na}}</td>
    </tr>

    <tr>
        <td>Beneficiary Type :</td>
        <td>{{$beneficiary->beneficieris_types_name_na}}</td>
        <td>Beneficiary Name "Arabic" :</td>
        <td>{{$beneficiary->ben_name_fo}}</td>

    </tr>
    @if($beneficiary->type != 4)
        @if($beneficiary->type != 3)

            <tr>
                <td>IdNo :</td>
                <td>{{$beneficiary->ben_idno}}</td>
                <td>Gender :</td>
                <td>{{$beneficiary->gender_name}}</td>
            </tr>
            <tr>
                <td>Marital :</td>
                <td>{{$beneficiary->marital_status_name}}</td>
                <td>City :</td>
                <td>{{$beneficiary->city_name_no}}</td>
            </tr>
        @endif

        <tr>
            <td>Address :</td>
            <td>{{$beneficiary->ben_address_na}}</td>
            <td>Mobile No :</td>
            <td>{{$beneficiary->ben_mobile_no}}</td>
        </tr>
        @if($beneficiary->type != 3)
            <tr >
                <td>Tel No :</td>
                <td colspan="3">{{$beneficiary->ben_tel_no}}</td>

            </tr>
            <tr>
                <td>No Of Family :</td>
                <td>{{$beneficiary->no_of_family}}</td>
                <td>Description :</td>
                <td>{{$beneficiary->desc_}}</td>
            </tr>
        @else

        @endif

        @if($beneficiary->type != 1 && $beneficiary->type != 2)

            <tr>
                <td>Tel No :</td>
                <td >{{$beneficiary->ben_tel_no}}</td>
                <td>Type :</td>
                <td>{{$beneficiary->org_type}}</td>

            </tr>
            <tr>
                <td> Fax No</td>
                <td>{{$beneficiary->ben_fax_no}}</td>
                <td>Email</td>
                <td>{{$beneficiary->ben_email}}</td>

            </tr>
            <tr>
                <td>URL</td>
                <td colspan="3">{{$beneficiary->ben_url}}</td>
            </tr>

        @endif
    @endif
    @if($beneficiary->type != 1 && $beneficiary->type != 2)
        <tr >
            <td colspan="4">Contact Person </td>
        </tr>
        <tr>
            <td> Name "English" :</td>
            <td>{{$beneficiary->contact_person_na}}</td>
            <td>Name "Arabic" :</td>
            <td>{{$beneficiary->contact_person_fo}}</td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>{{$beneficiary->contact_mobile}}</td>
            <td>Email</td>
            <td>{{$beneficiary->contact_email}}</td>
        </tr>
        <tr>
            <td>Job Title</td>
            <td colspan="3">{{$beneficiary->contact_job_title}}</td>
        </tr>
    @endif
    <tr>
        <td>Note</td>
        <td colspan="3">{{$beneficiary->note}}</td>
    </tr>

    </tbody>
</table>

<h4 class="title">History Of Benefit :</h4>
<table class="table">
    <thead>
    <tr style=" background-color: #e6ffd7;">
        <th>#</th>
        <th>Date</th>
        <th>Value</th>
        <th>Unit</th>
        <th>Result Name</th>
        <th>Activity Name</th>
        <th>Project Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($beneficiaryValue as $index=>$value)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{dateFormatSite($value->ben_date)}}</td>
            <td>{{round($value->bant_value,2)}}</td>
            <td>{{$value->unit_name_no}}</td>
            <td>{{$value->result_name_na}}</td>
            <td>{{$value->activity_name_na}}</td>
            <td>{{$value->project_name_na}}</td>
        </tr>
    @endforeach
    </tbody>
</table>


<a href="#" id="btn-print" onclick="myFunction()">Print this page</a>
<script>
    function myFunction() {
        window.print();
    }

</script>

</body>
</html>