@extends('layouts._layout')
@section('css')
    @include('setting.settingsScreens.settings_style')

@endsection
@section('content')
{{--New--}}
{{--<div class="col-md-12 p-3" style="row-gap: 0em;">--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("permission.user.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">person</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Users</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4   text-left pull-left"style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("permission.group.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;">--}}
{{--                    <span>  <i class="material-icons">group_work</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Groups</span></span>--}}
{{--                </div>--}}

{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("project.staff.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">people</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Staff</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("project.jobtitle.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">work</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Team Role</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--New--}}
<div class="container ml-2">
    <div class="row" id="containerc" >
        <div class="col-md-3 card p-3 mr-3">
            <ul class="navbar-nav mailli33 ">
                <li class="nav-item mb-3 selected-item" id="user" data-nameeng="Users" data-namear="المستخدمين" data-value="1">
                    <a href="#"
                       class="navi-link py-4 ">
                        <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >person</i>@if($lang==1)Users @elseالمستخدمين@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="group" data-nameeng="Groups" data-namear="المجموعات" data-value="2">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">group_work</i>&nbsp;@if($lang==1)Groups @else الإيميلات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="staff" data-nameeng="Staff" data-namear="الطاقم" data-value="3">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">people</i>@if($lang==1)Staff @elseالطاقم@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="teamrole" data-nameeng="Team Role" data-namear="Team Role" data-value="4">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">work</i>@if($lang==1)Team Role @else Team Role @endif</span>
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
{{--Groups Modal--}}
<div class="modal fade" id="modalUserGroup" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div id="contentModal"></div>
    </div>
</div>


@endsection
@section('script')
    @include('permission.users.users_script')
    <script>
        $(document).ready(function() {
            active_nev_link('user');
            // $('[data-toggle="tooltip"]').tooltip();
          defaultVal() ;
        });
    $("#user").click(function (e) {
    addSelected($("#user").attr("data-value"));
    $("#add").html("");
    $("#title").html("");
    $("#render_result").html("");
    e.preventDefault();
    defaultVal();


    });
    function addSelected(value){
        $(".mailli33 .nav-item").removeClass("selected-item");
        if(value==1){
            $("#user").addClass("selected-item");
        }
       else if(value==2){
            $("#group").addClass("selected-item");
        }
        else if(value==3){
            $("#staff").addClass("selected-item");
        }
        else{
            $("#teamrole").addClass("selected-item");

        }
    }
    function  defaultVal() {
        $('#loadScreen div.loader').show();
        $.get('{{route('permission.user.index')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#user").attr("data-nameeng"));
                else
                    $("#title").html($("#user").attr("data-namear"));
                $("#add").html("<a href=\"#\" onclick='addUser()' id='addUser' class=\"add mytooltip btn-setting-nav\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">person_add</i><span class=\"mytooltiptext\"> Add User</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',7);
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
    }
        function addUser() {
            // $('#loadScreen div.loader').show();
            $.get('{{route('permission.user.create')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#loadScreen div.loader').hide();
                }
            });
        }
</script>
@endsection
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>



@endsection