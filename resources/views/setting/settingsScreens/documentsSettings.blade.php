@extends('layouts._layout')
@section('css')
    @include('setting.settingsScreens.settings_style')
  <style>
      #table{
          margin-left: 10% !important;
      }
      #attachment_type_na{
          margin-left: -82px;
      }
      #attachment_type_fo{
          margin-left: -37px
      }
      .card .card-body .col-form-label, .card .card-body .label-on-right {
          margin-right: -4px;
      }
      </style>
@endsection
@section('content')
{{--New New--}}
<div class="container ml-2">
    <div class="row" id="containerc" style="padding:30px;">
        <div class="col-md-3 card p-3 mr-3">
            <ul class="navbar-nav mailli33">
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
                    $("#add").html("<a href=\"#\" onclick='addType()' id='addType' style='border:white' class=\"mytooltip btn-setting-nav btn-round btn-fab add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\"> add type </span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addType()' id='addType' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\"> Add Document Type</span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addSetting()' id=\"addSetting\"class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Setting </span></a>\n" +
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
            $(".mailli33 .nav-item").removeClass("selected-item");
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
                markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.attachment_type_na+'</td><td>'+data.attachment_type_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                    '                     class="mytooltip btn-setting-nav editDocType"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title=""\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i><span class=\"mytooltiptext\"> edit </span>\n' +
                    '                    </a> <a  href='+url+'\n' +
                    '                        rel="tooltip" class="mytooltip btn-setting-nav btnCityDelete"\n' +
                    '                        data-placement="top"  title=" ">\n' +
                    '                    <i class="material-icons">delete</i><span class=\"mytooltiptext\"> delete </span>\n' +
                    '                </a>\n</td></tr>';



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
            url = url.replace(':attachmentid', data.attachment_type_id);
            if(lang==1) {
               if (data.is_hidden==0)
                   activeStatus = 'Active';
               else
                   activeStatus = 'Inactive';
                markup = '<tr data-interface=' + data.interface_type_id + ' data-attachment='+data.attachment_type_id+'><td>' + count1 + '</td><td>' + interface.interface_type_na + '</td><td>' + attachment.attachment_type_na + '</td><td>' + activeStatus + '</td><td> <a href="#" data-interface=' + data.interface_type_id + ' data-attachment='+data.attachment_type_id+ + '\n' +
                    '                     class="mytooltip btn-setting-nav editSetting"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title=""\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i><span class=\"mytooltiptext\"> edit </span>\n' +
                    '                    </a> <a  href=' + url + '\n' +
                    '                        class="mytooltip btn-setting-nav btnTypeDelete"\n' +
                    '                        data-placement="top"  title="">\n' +
                    '                    <i class="material-icons">delete</i><span class=\"mytooltiptext\"> delete </span>\n' +
                    '                </a>\n</td></tr>';
            } else {
                if (data.is_hidden==0)
                    activeStatus = 'فعال';
                else
                    activeStatus = 'غير فعال';
                markup = '<tr data-interface=' + data.interface_type_id + ' data-attachment='+data.attachment_type_id+'><td>' + count1 + '</td><td>' + interface.interface_type_fo + '</td><td>' + attachment.attachment_type_fo + '</td><td>' + activeStatus + '</td><td> <a href="#" data-interface=' + data.interface_type_id + ' data-attachment='+data.attachment_type_id+ '\n' +
                    '                     class="btn mytooltip btn-setting-nav editSetting"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title=""\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i><span class=\"mytooltiptext\"> edit </span>\n' +
                    '                    </a> <a href="#" href=' + url + '\n' +
                    '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete"\n' +
                    '                        data-placement="top"  title="">\n' +
                    '                    <i class="material-icons">delete</i><span class=\"mytooltiptext\"> delete </span>\n' +
                    '                </a>\n</td></tr>';

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
