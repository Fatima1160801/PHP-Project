@extends('layouts._layout')
@section('css')
    <style>
        a {
            color: black;
        }
        span {
            font-weight: 500;
            font-size: 14px;
        }
        .mainli li:hover,.mainli li:active,.mainli li:focus,.mainli li:visited{
            background: #3699FF !important;

        }
        .mainli li:hover a,.mainli li:hover i, .mainli li:active a,.mainli li:active i,.mainli li:focus a,.mainli li:focus i,.mainli li:visited a,.mainli li:visited i{
            color:white !important;

        }
        .selected-href{

        }
        .mainli li {
            padding: 15px !important;
        }
        .mainli a,.mainli i {
            color:#3F4254 !important;
        }
        .mainli i {
            color: #B5B5C3 !important
        }
        .default-color{
            color:#afafaf;
        }
        .selected-item,.selected-item i,.selected-item span{
            background: #3699FF !important;
            color:white !important;

        }
        #containerc{
            margin-right: -88px;
        }
        /*#table{*/
        /*    margin-left:15%;*/
        /*    !*width:35em;*!*/
        /*    text-align: center;*/
        /*}*/
        #createmodal{
            margin-top:-15px;
            /*background-color: #5d76a8;*/
        }
        #createmodal .card-title,#createmodal .card-title i{
            text-align: center;
            font-size: 19px !important;
            font-weight: bold;
            color:#5d76a8;
        }
        #createmodal .card-body{
            margin-top: 20px;
        }
        /*#formCityCreate .row .row{*/
        /*    margin-right: -50px;*/
        /*}*/
        /*#formCityCreate  .row{*/
        /*    margin-right: 22px;*/
        /*}*/

        #table{
            margin-left: 0% !important;
            width: 45em !important;
        }
        .table {
            width: 60em !important;
        }

    </style>
@section('content')
{{--New New--}}
<div class="container ml-2">
    <div class="row" id="containerc" style="height: 500px;">
        <div class="col-md-3 card p-3 mr-3">
            <ul class="navbar-nav mainli">
                <li class="nav-item mb-3 selected-item" id="doctype" data-nameeng="Documents Types" data-namear="أنواع المستندات" data-value="1">
                    <a href="#"
                       class="navi-link py-4 ">
                        <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >cloud_upload</i>@if($lang==1)Documents Types @elseأنواع المستندات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="docsetting" data-nameeng="Documents Settings" data-namear="إعدادات المستند" data-value="2">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">settings</i>@if($lang==1)Documents Settings @elseإعدادات المستند@endif</span>
                        </div>
                    </a>

                </li>
            </ul>
        </div>
        <div class="col-md-8 p-3 card" ><div class="card-title" id="content">
                <label id="title" style="font-weight: bold;font-size: 19px !important;"></label>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span id="add"></span>
            </div>
            <div id="loadScreen" class="col-md-2" style="padding-left:300px;"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div>

            <div  class="col-md-12"id="render_result">

            </div>
        </div>
    </div>
</div>
{{--   Start Modal--}}
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div  class="modal-header mt-3">
                    <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </a>
                </div>
                <div class="modal-body" id="locationModalBody">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    @include('setting.c.attachmentTypes.documents_script')
    <script>
        $(document).ready(function() {
            $('#loadScreen div.loader').show();
            $.get('{{route('settings.attachment_types')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#doctype").attr("data-nameeng"));
                    else
                        $("#title").html($("#doctype").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addType()' id='addType' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add Document Type\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                    $('#loadScreen div.loader').hide();
                            {{--
                                                     @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();
                }else{

                }
            });

        } );
        $("#doctype").click(function (e) {
            addSelected($("#doctype").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('settings.attachment_types')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#doctype").attr("data-nameeng"));
                    else
                        $("#title").html($("#doctype").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addType()' id='addType' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add Document Type\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });

        $("#docsetting").click(function (e) {
            addSelected($("#docsetting").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('settings.documents.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#docsetting").attr("data-nameeng"));
                    else
                        $("#title").html($("#docsetting").attr("data-namear"));
                    $("#add").html("<button type=\"button\" onclick='addSetting()' id=\"addSetting\"class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add Setting\" >\n" +
                        "                <i class=\"material-icons\">add</i></button>\n" +
                        "            </span> </h4>");
                    DataTableCall('#table',5);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                    // $('#table').DataTable( {
                    //     "order": [[ 1, "desc" ]]
                    // } );
                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        function addSelected(value){
            $(".mainli .nav-item").removeClass("selected-item");
            if(value==1){
                $("#doctype").addClass("selected-item");
            }
            else{
                $("#docsetting").addClass("selected-item");

            }
        }
        function addType() {
            $.get('{{route('settings.attachment_types.create')}}',function(data){
                if(data.status==true) {
                    $("#locationModalBody").html(data.html);
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        }
        $(document).on("click", ".editDocType", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('settings/attachment_types')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#locationModalBody").html(data.html);
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        })
        function appendTable(data,count,id,cityname,citynamefo){
            var count1=count+1;
            var table = document.getElementById("table");
            var number = table.rows.length;
            // if($dd==1){
            Body = $("#table tbody");
                var url = '{{ route("settings.attachment_types.delete", ":id") }}';
                url = url.replace(':id', data.id);
                markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.attachment_type_na+'</td><td>'+data.attachment_type_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                    '                     class="btn btn-sm btn-success btn-round btn-fab editDocType"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title="edit"\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i>\n' +
                    '                    </button> <button type="button" href='+url+'\n' +
                    '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCityDelete"\n' +
                    '                        data-placement="top"  title=" delete ">\n' +
                    '                    <i class="material-icons">delete</i>\n' +
                    '                </button>\n</td></tr>';



            $(markup).insertAfter("#table tr:first");
            $('#locationModal').modal('hide');
            // }
        }
        function  appendTableSetting(data,count,interface,attachment) {
            var activeStatus=""
            var count1=count+1;
            var lang=@json($lang);
            {{--var url = '{{ route("settings.attachment_types.delete", ":id") }}';--}}
            {{--url = url.replace(':id', 2);--}}
            var url = '{{ route("settings.documents.delete", [":interfaceid",":attachmentid"]) }}';
            url = url.replace(':interfaceid', data.interface_type_id);
            url = url.replace(':attachmentid', attachment_type_id);
            if(lang==1) {
               if (data.is_hidden==0)
                   activeStatus = 'Active';
               else
                   activeStatus = 'Inactive';
                markup = '<tr data-interface=' + data.interface_type_id + ' data-attachment='+data.attachment_type_id+'><td>' + count1 + '</td><td>' + interface.interface_type_na + '</td><td>' + attachment.attachment_type_na + '</td><td>' + activeStatus + '</td><td> <button type="button" data-id=' + data.id + '\n' +
                    '                     class="btn btn-sm btn-success btn-round btn-fab editSetting"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title="edit"\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i>\n' +
                    '                    </button> <button type="button" href=' + url + '\n' +
                    '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"\n' +
                    '                        data-placement="top"  title=" delete ">\n' +
                    '                    <i class="material-icons">delete</i>\n' +
                    '                </button>\n</td></tr>';
            } else {
                if (data.is_hidden==0)
                    activeStatus = 'فعال';
                else
                    activeStatus = 'غير فعال';
                markup = '<tr data-id=' + data.id + '><td>' + count1 + '</td><td>' + interface.interface_type_fo + '</td><td>' + attachment.attachment_type_fo + '</td><td>' + activeStatus + '</td><td> <button type="button" data-id=' + data.id + '\n' +
                    '                     class="btn btn-sm btn-success btn-round btn-fab editSetting"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title="edit"\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i>\n' +
                    '                    </button> <button type="button" href=' + url + '\n' +
                    '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"\n' +
                    '                        data-placement="top"  title=" delete ">\n' +
                    '                    <i class="material-icons">delete</i>\n' +
                    '                </button>\n</td></tr>';

            }
        $(markup).insertAfter("#table tr:first");
        $('#locationModal').modal('hide');
        // }

        }
        function editRow(data,id,cityname,citynamefo){
            var lang=@json($lang);
            if(id==1){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.attachment_type_na);
                $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.attachment_type_fo);}
            else{

                if(lang==1){
                    if(data.is_hidden==0)
                    $('tr[data-id='+data.id+']').find("td:eq(3)").text("Active");
                    else
                        $('tr[data-id='+data.id+']').find("td:eq(3)").text("InActive");

                //     $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.interface.interface_type_na);
                // $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.attachment.attachment_type_na);
            }  else{
                    if(data.ishidden==0)
                        $('tr[data-id='+data.id+']').find("td:eq(3)").text("فعال");
                    else
                        $('tr[data-id='+data.id+']').find("td:eq(3)").text("غير فعال");

                    // $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.interface.interface_type_fo);
                    // $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.attachment.attachment_type_fo);


            }
            }

            $('#locationModal').modal('hide');
        }
        function addSetting(){
            $.get('{{route('settings.documents.create')}}',function(data){
                if(data.status==true) {
                    $("#locationModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        }
        $(document).on("click", ".editSetting", function (e) {
            var val=$(this).attr("data-interface");
            var val1=$(this).attr("data-attachment");
            $.get('{{url('/documents/settings')}}'+'/'+val+'/'+val1+'/edit',function(data){
                if(data.status==true) {
                    $("#locationModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        })



    </script>

@endsection