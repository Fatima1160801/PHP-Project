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
            background: #F3F6F9 !important;

        }
        .mainli li:hover a,.mainli li:hover i, .mainli li:active a,.mainli li:active i,.mainli li:focus a,.mainli li:focus i,.mainli li:visited a,.mainli li:visited i{
            color:#3699FF !important;

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
            background: #F3F6F9 !important;
            color:#3699FF !important;

        }
        #containerc{
            margin-right: -88px;
        }
        #table{
            margin-left:15%;
            /*width:35em;*/
            text-align: center;
        }
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
        }
        .table {
            width: 60em !important;
        }

    </style>
@endsection
@section('content')
    <div class="container ml-2">
        <div class="row" id="containerc" style="height: 500px;">
            <div class="col-md-2 card p-3 mr-3">
                <ul class="navbar-nav mainli">
                    <li class="nav-item mb-3" id="governorate" data-nameeng="Governorates" data-namear="المدن" data-value="1">
                        <a href="#"
                           class="navi-link py-4 ">
                            <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                          >layers</i>@if($lang==1)Governorates @else المدن@endif</span>
                            </div>
                        </a>

                    </li>
                    <li class="nav-item mb-3 " id="location" data-nameeng="Locations" data-namear="المناطق" data-value="2">
                        <a href="#"
                           class="navi-link py-4">
                            <div class="card-icon">
                                <span>  <i class="material-icons default-color mr-2">location_on</i>@if($lang==1)locations @else المناطق@endif</span>
                            </div>
                        </a>

                    </li>
{{--                    <li class="nav-item" >--}}
{{--                        <a href="/metronic/demo13/custom/apps/profile/profile-1/change-password.html"--}}
{{--                           class="navi-link py-4">--}}
{{--                            <div class="card-icon">--}}
{{--                                <span>  <i class="material-icons"--}}
{{--                                           style="color:#afafaf;">games</i>Account Information</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                    <li class="nav-item mainli selectedmenu" >--}}
{{--                        <a href="/metronic/demo13/custom/apps/profile/profile-1/change-password.html"--}}
{{--                           class="navi-link py-4">--}}
{{--                            <div class="card-icon">--}}
{{--                                <span>  <i class="material-icons" style="color:#afafaf;">email</i>Email Settings</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                    <li class="nav-item mainli selectedmenu" >--}}
{{--                        <a href="/metronic/demo13/custom/apps/profile/profile-1/change-password.html"--}}
{{--                           class="navi-link py-4">--}}
{{--                            <div class="card-icon">--}}
{{--                                <span>  <i class="material-icons" style="color:#afafaf;">credit_card</i>Saved Credit Cards</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                    <li class="nav-item mainli selectedmenu" >--}}
{{--                        <a href="/metronic/demo13/custom/apps/profile/profile-1/change-password.html"--}}
{{--                           class="navi-link py-4">--}}
{{--                            <div class="card-icon">--}}
{{--                                <span>  <i class='far fa-file-alt' style='font-size:20px;color:#afafaf;'></i>Tax Information</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                    <li class="nav-item mainli selectedmenu" >--}}
{{--                        <a href="/metronic/demo13/custom/apps/profile/profile-1/change-password.html"--}}
{{--                           class="navi-link py-4">--}}
{{--                            <div class="card-icon">--}}
{{--                                <span>  <i class="material-icons" style="color:#afafaf;">subject</i>Statements</span>--}}
{{--                                <span class="label label-light-danger label-rounded font-weight-bold">5</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </li>--}}
                </ul>
            </div>
            <div class="col-md-9 p-3 card" ><div class="card-title" id="content">
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
            {{--   <script>--}}
            {{--   $(document).ready(function(){--}}
            {{--   $('.card-body').hover(function(){--}}

            {{--      $(this).css("background-color","#3699ff");}, function(){--}}
            {{--      $(this).css("background-color", "#234773");--}}
            {{--   // $('a').css("color", "chooseacolor");--}}
            {{--   });--}}
            {{--   });</script>--}}
            @include('setting.c.city.location_script')
            @include('setting.c.district.district_script')

            <script src='https://kit.fontawesome.com/a076d05399.js'></script>

            <script>
                $("#location").click(function (e) {
                    addSelected($("#location").attr("data-value"));
                    $("#add").html("");
                    $("#title").html("");
                    $("#render_result").html("");

                    $('#loadScreen div.loader').show();
                    e.preventDefault();
                    $.get('{{route('settings.districts')}}',function(data){
                        if(data.status==true){
                            $("#render_result").html(data.html);
                            $('#loadScreen div.loader').hide();
                            var lang=@json($lang);
                            if(lang==1)
                            $("#title").html($("#location").attr("data-nameeng"));
                            else
                                $("#title").html($("#location").attr("data-namear"))
                            $("#add").html("<button type=\"button\" onclick='addDistrict()' id='addDistrict' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                                "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                                "               title=\"Add New City\" >\n" +
                                "                <i class=\"material-icons\">add</i></a>\n" +
                                "            </span> </h4>");
                            // $('#table').DataTable().ajax.reload();
                            DataTableCall('#table',5);
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

                $("#governorate").click(function (e) {
                    addSelected($("#governorate").attr("data-value"));
                    $("#add").html("");
                    $("#title").html("");
                     $("#render_result").html("");
                    $('#loadScreen div.loader').show();
                    e.preventDefault();
                    $.get('{{route('settings.cities')}}',function(data){
                        if(data.status==true){
                            $("#render_result").html(data.html);
                            $('#loadScreen div.loader').hide();
                            var lang=@json($lang);
                            if(lang==1)
                            $("#title").html($("#governorate").attr("data-nameeng"));
                            else
                                $("#title").html($("#governorate").attr("data-namear"));
                            $("#add").html("<button type=\"button\" onclick='addCity()' id=\"addCity\"class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                                "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                                "               title=\"Add New City\" >\n" +
                                "                <i class=\"material-icons\">add</i></button>\n" +
                                "            </span> </h4>");
                            DataTableCall('#table',4);
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
                        $("#governorate").addClass("selected-item");
                    }
                    else{
                        $("#location").addClass("selected-item");

                }
                }
                function addCity() {
                        $.get('{{route('settings.cities.create')}}',function(data){
                            if(data.status==true) {
                                $("#locationModalBody").html(data.html);
                                $('#locationModal').modal({
                                    show: true
                                });
                            }
                    });
                }
                $(document).on("click", ".editCity", function (e) {
                    var val=$(this).attr("data-id");
                    $.get('{{url('settings/cities')}}'+'/'+val+'/edit',function(data){
                        if(data.status==true) {
                            $("#locationModalBody").html(data.html);
                            $('#locationModal').modal({
                                show: true
                            });
                        }
                    });
                })
function appendTable(data,count,id,cityname,citynamefo){
    var table = document.getElementById("table");
    var number = table.rows.length;
    // if($dd==1){
    Body = $("#table tbody");
    if(id==1){
    var url = '{{ route("settings.cities.delete", ":id") }}';
    url = url.replace(':id', data.id);
    markup='<tr data-id='+data.id+'><td>'+count+'</td><td>'+data.city_name_no+'</td><td>'+data.city_name_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
        '                     class="btn btn-sm btn-success btn-round btn-fab editCity"  data-toggle="tooltip" data-placement="top"\n' +
        '                       title="edit"\n' +
        '                    >\n' +
        '                        <i class="material-icons">edit</i>\n' +
        '                    </button> <button type="button" href='+url+'\n' +
        '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCityDelete"\n' +
        '                        data-placement="top"  title=" delete ">\n' +
        '                    <i class="material-icons">delete</i>\n' +
        '                </button>\n</td></tr>';}
    else{
        var lang=@json($lang);
        var url = '{{ route("settings.districts.delete", ":id") }}';
        url = url.replace(':id', data.id);
        if(lang==1)
        markup='<tr data-id='+data.id+'><td>'+count+'</td><td>'+data.district_name_no+'</td><td>'+data.district_name_fo+'</td><td>'+cityname+'</td><td> <button type="button" data-id='+data.id+'\n' +
            '                     class="btn btn-sm btn-success btn-round btn-fab editDistrict"  data-toggle="tooltip" data-placement="top"\n' +
            '                       title="edit"\n' +
            '                    >\n' +
            '                        <i class="material-icons">edit</i>\n' +
            '                    </button> <button type="button" href='+url+'\n' +
            '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCityDelete"\n' +
            '                        data-placement="top"  title=" delete ">\n' +
            '                    <i class="material-icons">delete</i>\n' +
            '                </button>\n</td></tr>';
        else
            markup='<tr data-id='+data.id+'><td>'+count+'</td><td>'+data.district_name_no+'</td><td>'+data.district_name_fo+'</td><td>'+citynamefo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                '                     class="btn btn-sm btn-success btn-round btn-fab editDistrict"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title="edit"\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i>\n' +
                '                    </button> <button type="button" href='+url+'\n' +
                '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCityDelete"\n' +
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
    $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.city_name_no);
    $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.city_name_fo);}
                    else{
                        $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.district_name_no);
                        $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.district_name_fo);
                        if(lang==1)
                        $('tr[data-id='+data.id+']').find("td:eq(3)").text(cityname);
                        else
                            $('tr[data-id='+data.id+']').find("td:eq(3)").text(citynamefo);


                    }

    $('#locationModal').modal('hide');
}
function addDistrict(){
    $.get('{{route('settings.districts.create')}}',function(data){
        if(data.status==true) {
            $("#locationModalBody").html(data.html);
            $('.selectpicker').selectpicker();
            $('#locationModal').modal({
                show: true
            });
        }
    });
}
                $(document).on("click", ".editDistrict", function (e) {
                    var val=$(this).attr("data-id");
                    $.get('{{url('settings/districts')}}'+'/'+val+'/edit',function(data){
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
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>
@endsection
{{--@section('script')--}}
{{--    @include('setting.c.city.location_script')--}}
{{--@endsection--}}