@extends('layouts._layout')
@section('css')
    <style>
        a {
            color: black;
        }

        /*path,span{*/
        /*   fill: #afafaf;*/
        /*}*/
        span {
            font-weight: 500;
            font-size: 14px;
        }
        /*li:hover{*/
        /*       background-color: #d2d2d280;*/
        /*       background-clip: padding-box;*/
        /*       fill: #0d9afb;*/
        /*       color:#0d9afb;*/
        /*       border: 200px;*/
        /*       padding: 15px;*/
        /*    */
        /*}*/
        /*a:hover{*/
        /*    color:#0d9afb;*/
        /*}*/
        /*i:hover{*/
        /*    fill:#0d9afb;*/
        /*}*/
        .mainli li:hover,.mainli li:active,.mainli li:focus,.mainli li:visited{
            background: #F3F6F9 !important;

        }
        .mainli li:hover a,.mainli li:hover i, .mainli li:active a,.mainli li:active i,.mainli li:focus a,.mainli li:focus i,.mainli li:visited a,.mainli li:visited i{
            color:#3699FF !important;

        }

        .selected-href{

        }

        /*.active a,.active path {*/
        /*   background-color: #d2d2d280;*/
        /*   background-clip: padding-box;*/
        /*   fill: #0d9afb;*/
        /*   color:#0d9afb;*/
        /*   border: 200px;*/
        /*   padding: 15px;*/
        /*}*/

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


    </style>
@endsection
@section('content')
    <div class="container ml-5">
        <div class="row" style="height: 500px;overflow-y: scroll;">
            <div class="col-md-3 card p-3 mr-4">
                <ul class="navbar-nav mainli">
                    <li class="nav-item mb-3" id="governorate" data-name="Governorate" data-value="1">
                        <a href="#"
                           class="navi-link py-4 ">
                            <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                          >layers</i>Governorate</span>
                            </div>
                        </a>

                    </li>
                    <li class="nav-item mb-3 " id="location" data-name="Location" data-value="2">
                        <a href="#"
                           class="navi-link py-4">
                            <div class="card-icon">
                                <span>  <i class="material-icons default-color mr-2">location_on</i>Location</span>
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
            <div class="col-md-8 p-5 card">
                <div id="loadScreen" class="col-md-2" style="padding-left:250px;"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div>
                <div class="card-title" id="content">
                    <label id="title" style="font-weight: bold;"></label><span id="add"></span>
                </div>
                <div id="render_result">

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
                            $("#title").html($("#location").attr("data-name"))
                            $("#add").html("<a href=\"{{route('settings.districts.create')}}\" class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                                "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                                "               title=\"Add New City\" >\n" +
                                "                <i class=\"material-icons\">add</i></a>\n" +
                                "            </span> </h4>");
                            // $('#table').DataTable().ajax.reload();
                            DataTableCall('#table',5);
{{--                            @include('setting.c.city.location_script');--}}


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
                            $("#title").html($("#governorate").attr("data-name"));
                            $("#add").html("<a href=\"{{route('settings.cities.create')}}\" class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                                "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                                "               title=\"Add New City\" >\n" +
                                "                <i class=\"material-icons\">add</i></a>\n" +
                                "            </span> </h4>");
                            DataTableCall('#table',4);

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