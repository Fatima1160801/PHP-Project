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
                <li class="nav-item mb-3 " id="teamrole" data-nameeng="Job Title" data-namear="Job Title" data-value="4">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">work</i>@if($lang==1)Job Title @else Job Title @endif</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item mb-3 " id="teamrole1" data-nameeng="Team Role" data-namear="Team Role" data-value="5">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">stars</i>@if($lang==1)Team Role @else Team Role @endif</span>
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
            active_nev_link('group');
            active_nev_link('job_title');
            active_nev_link('staff-link');
            $('.selectpicker').selectpicker();

            var newdate = new Date();
            // $('#dob').data("DateTimePicker").maxDate(newdate);
            funValidateForm();


            // $('[data-toggle="tooltip"]').tooltip();
          defaultVal() ;
        });
        datetimepicker();
        function datetimepicker() {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                },
                format: 'DD/MM/YYYY',
                useCurrent: false
            });
        }
            $("#user").click(function (e) {
                addSelected($("#user").attr("data-value"));
                $("#add").html("");
                $("#title").html("");
                $("#render_result").html("");
                e.preventDefault();
                defaultVal();


            });
            $("#staff").click(function (e) {
                addSelected($("#staff").attr("data-value"));
                $("#add").html("");
                $("#title").html("");
                $("#render_result").html("");
                e.preventDefault();
                staffVal();


            });

     function staffVal(){
         $('#loadScreen div.loader').show();
         $.get('{{route('project.staff.index')}}', function (data) {
             if (data.status == true) {
                 $("#render_result").html(data.html);
                 $('#loadScreen div.loader').hide();
                 var lang =@json($lang);
                 if (lang == 1)
                     $("#title").html($("#staff").attr("data-nameeng"));
                 else
                     $("#title").html($("#staff").attr("data-namear"));
                 $("#add").html("<a href=\"#\" onclick='addStaff()' id='addStaff' class=\"add mytooltip btn-setting-nav\"\n" +
                     "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                     "               title=\"\" >\n" +
                     "                <i class=\"material-icons\">person_add</i><span class=\"mytooltiptext\"> Add </span></a>\n" +
                     "            </span> </h4>");
                 // $('#table').DataTable().ajax.reload();
                 DataTableCall('#table', 6);
                 $("#table_length").html("");
                 $("#table_filter").html("");
                         {{--                            @include('setting.c.city.location_script');--}}

                 var table = $('#table').DataTable();

                 // Sort by columns 1 and 2 and redraw
                 table
                     .order([0, 'desc'])
                     .draw();

             } else {

             }
         });

        }

            function addSelected(value) {
                $(".mailli33 .nav-item").removeClass("selected-item");
                if (value == 1) {
                    $("#user").addClass("selected-item");
                } else if (value == 2) {
                    $("#group").addClass("selected-item");
                } else if (value == 3) {
                    $("#staff").addClass("selected-item");
                } else if (value == 4){
                    $("#teamrole").addClass("selected-item");
                }
                else
                    $("#teamrole1").addClass("selected-item");

            }

            function defaultVal() {
                $('#loadScreen div.loader').show();
                $.get('{{route('permission.user.index')}}', function (data) {
                    if (data.status == true) {
                        $("#render_result").html(data.html);
                        $('#loadScreen div.loader').hide();
                        var lang =@json($lang);
                        if (lang == 1)
                            $("#title").html($("#user").attr("data-nameeng"));
                        else
                            $("#title").html($("#user").attr("data-namear"));
                        $("#add").html("<a href=\"#\" onclick='addUser()' id='addUser' class=\"add mytooltip btn-setting-nav\"\n" +
                            "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                            "               title=\"\" >\n" +
                            "                <i class=\"material-icons\">person_add</i><span class=\"mytooltiptext\"> Add User</span></a>\n" +
                            "            </span> </h4>");
                        // $('#table').DataTable().ajax.reload();
                        DataTableCall('#table', 6);
                        $("#table_length").html("");
                        $("#table_filter").html("");
                                {{--                            @include('setting.c.city.location_script');--}}

                        var table = $('#table').DataTable();

                        // Sort by columns 1 and 2 and redraw
                        table
                            .order([0, 'desc'])
                            .draw();

                    } else {

                    }
                });
            }

            function addUser() {
                // $('#loadScreen div.loader').show();
                $.get('{{route('permission.user.create')}}', function (data) {
                    if (data.status == true) {
                        $("#render_result").html("");
                        $("#render_result").html(data.html);
                        $('.selectpicker').selectpicker();
                        // $('#loadScreen div.loader').hide();
                    }
                });
            }
        function addStaff() {
            // $('#loadScreen div.loader').show();
            $.get('{{route('project.staff.create',1)}}', function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#loadScreen div.loader').hide();
                }
            });
        }
        $(document).on("click", ".editUser", function (e) {
            var val = $(this).attr("data-id");
            $.get('{{url('permission/user')}}' + '/' + val + '/edit', function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();

                }
            });
        })
        $(document).on("click", ".editStaff", function (e) {
            var val = $(this).attr("data-id");
            var val1=$(this).attr("data-type");
            $.get('{{url('staff')}}' + '/' + val + '/' + val1 + '/edit', function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();

                }
            });
        })
        $(document).on("click", ".userstaff", function (e) {
            var val = $(this).attr("data-id");
            var val1=$(this).attr("data-type");
            $.get('{{url('staff')}}' + '/' + val + '/' + val1 + '/edit', function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();

                }
            });
        })
        $(document).on("click", ".show", function (e) {
            var val = $(this).attr("data-id");
            $.get('{{url('staff')}}' + '/' + val , function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();

                }
            });
        })
        $(document).on("click", ".edituserstaff", function (e) {
            var val = $(this).attr("data-id");
            $.get('{{url('permission/user')}}' + '/' + val + '/edit', function (data) {
                if (data.status == true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();

                }
            });
        })

        $("#group").click(function (e) {
                addSelected($("#group").attr("data-value"));
                $("#add").html("");
                $("#title").html("");
                $("#render_result").html("");
                // $("#procurementModal").addClass("modalSize")

                $('#loadScreen div.loader').show();
                e.preventDefault();
                $.get('{{route('permission.group.index')}}', function (data) {
                    if (data.status == true) {
                        $("#render_result").html("");
                        $("#render_result").html(data.html);
                        $('.selectpicker').selectpicker();
                        $('#loadScreen div.loader').hide();

                    } else {

                    }
                });

            });
            $(document).on("click", ".grantPermission", function (e) {
                $('#loadScreen div.loader').show();
                var val = $(this).attr("data-id");
                $.get('{{url('permission')}}' + '/' + 'group' + '/' + val, function (data) {
                    if (data.status == true) {
                        $("#render_result").html(data.html);
                    }

                });
                $('#loadScreen div.loader').hide();
            })
            $("#teamrole").click(function (e) {
                addSelected($("#teamrole").attr("data-value"));
                $("#add").html("");
                $("#title").html("");
                $("#render_result").html("");
                e.preventDefault();
                $('#loadScreen div.loader').show();
                $.get('{{route('project.jobtitle.index')}}', function (data) {
                    if (data.status == true) {
                        $("#render_result").html(data.html);
                        $('#loadScreen div.loader').hide();
                        var lang =@json($lang);
                        if (lang == 1)
                            $("#title").html($("#teamrole").attr("data-nameeng"));
                        else
                            $("#title").html($("#teamrole").attr("data-namear"))
                        $("#add").html("<a href=\"#\" onclick='addRole()' id='addRole' class=\"mytooltip btn-setting-nav add\"\n" +
                            "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                            "               title=\"\" >\n" +
                            "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add </span></a>\n" +
                            "            </span> </h4>");
                        // $('#table').DataTable().ajax.reload();
                        DataTableCall('#table', 6);
                        $("#table_length").html("");
                        $("#table_filter").html("");
                                {{--                            @include('setting.c.city.location_script');--}}

                        var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                        table
                            .order([0, 'desc'])
                            .draw();

                    } else {

                    }
                });
            });
        $("#teamrole1").click(function (e) {
            addSelected($("#teamrole1").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            $('#loadScreen div.loader').show();
            $.get('{{route('project.teamrole.index')}}', function (data) {
                if (data.status == true) {
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang =@json($lang);
                    if (lang == 1)
                        $("#title").html($("#teamrole1").attr("data-nameeng"));
                    else
                        $("#title").html($("#teamrole1").attr("data-namear"))
                    $("#add").html("<a href=\"#\" onclick='addTeamRole()' id='addTeamRole' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add </span></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table', 5);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order([0, 'desc'])
                        .draw();

                } else {

                }
            });
        });

            function addRole() {
                $.get('{{route('project.jobtitle.create')}}', function (data) {
                    if (data.status == true) {
                        $("#locationModalBody").html(data.html);
                        $('.selectpicker').selectpicker();
                        $('#locationModal').modal({
                            show: true
                        });
                    }
                });
            }
        function addTeamRole() {
            $.get('{{route('project.teamrole.create')}}', function (data) {
                if (data.status == true) {
                    $("#locationModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        }

            $(document).on("click", ".editRole", function (e) {
                var val = $(this).attr("data-id");
                $.get('{{url('jobtitle')}}' + '/' + val + '/edit', function (data) {
                    if (data.status == true) {
                        $("#locationModalBody").html(data.html);
                        $('.selectpicker').selectpicker();
                        $('#locationModal').modal({
                            show: true
                        });
                    }
                });
            })
        $(document).on("click", ".editTeamRole", function (e) {
            var val = $(this).attr("data-id");
            $.get('{{url('teamrole')}}' + '/' + val + '/edit', function (data) {
                if (data.status == true) {
                    $("#locationModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#locationModal').modal({
                        show: true
                    });
                }
            });
        })


            function appendTable(data, status, count, id, cityname, citynamefo, usedStatus) {
                var table = document.getElementById("table");
                var count1 = count + 1;
                // var number = table.rows.length;
                // if($dd==1){
                Body = $("#table tbody");
                if (id == 1) {
                    {{--var url = '{{ route("project.projectcategories.destroy", ":id") }}';--}}
                    // url = url.replace(':id', data.id);
                    var modal = "#delete" + data.id;
                    var modalname = "delete" + data.id;
                    markup = '<tr data-id=' + data.id + '><td>' + count1 + '</td><td>' + data.job_title_name_na + '</td><td>' + data.job_title_name_fo + '</td><td>' + status + '</td><td>' + usedStatus + '</td><td> <a href="#" data-id=' + data.id + '\n' +
                        '                     class="mytooltip btn-setting-nav editRole"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title=""\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a href="#"\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete" data-toggle="modal"\n' +
                        '                        data-target=' + modal + '\n' +
                        '                        data-placement="top"  data-tooltip="tooltip" title=" ">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                        '                </a></td></tr>'
                    var mark = '<div class="modal" id=' + modalname + ' tabindex="-1" role="dialog"\n' +
                        '             aria-labelledby="myModalLabel">\n' +
                        '            <div class="modal-dialog" role="document">\n' +
                        '                <div class="modal-content">\n' +
                        '                    <div class="modal-header">\n' +
                        '                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span\n' +
                        '                                    aria-hidden="true">&times;</span></button>\n' +
                        '                        <h4 class="modal-title text-center" id="myModalLabel">Delete Project Category\n' +
                        '                            Confirmation</h4>\n' +
                        '                    </div><form>\n' +
                        '                    <div class="modal-body">\n' +
                        '                        <p class="text-center">\n' +
                        '                            Are you sure you want to delete this?\n' +
                        '                        </p>\n' +
                        '                    </div>\n' +
                        '                    <div class="modal-footer">\n' +
                        '                        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel\n' +
                        '                        </button>\n' +
                        '                        <button type="submit" class="btn btn-warning yes" data-id="' + data.id + '">Yes, Delete</button>\n' +
                        '                    </div>\n' +
                        '                    </form>\n' +
                        '\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div> <!-- End Modal -->\n';
                    $("#render_result").append(mark);
                }
               else if (id == 5) {
                    var url = '{{ route("project.teamrole.destroy", ":id") }}';
                    url = url.replace(':id', data.id);
                    markup = '<tr data-id=' + data.id + '><td>' + count1 + '</td><td>' + data.role_name_na + '</td><td>' + data.role_name_fo + '</td><td>' + status + '</td><td> <a href="#" data-id=' + data.id + '\n' +
                        '                     class="mytooltip btn-setting-nav editTeamRole"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title=""\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a href='+url+'\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav deleteTeamRole" \n' +
                        '                        \n' +
                        '                        data-placement="top"  data-tooltip="tooltip" title=" ">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                        '                </a></td></tr>'

                }
                $(markup).insertAfter("#table tr:first");
                $('#locationModal').modal('hide');
            }

            function editRow(data, status, id, cityname, citynamefo, usedStatus) {
                var lang =@json($lang);

                if (id == 1) {
                    $('tr[data-id=' + data.id + ']').find("td:eq(1)").text(data.job_title_name_na);
                    $('tr[data-id=' + data.id + ']').find("td:eq(2)").text(data.job_title_name_fo);
                    $('tr[data-id=' + data.id + ']').find("td:eq(3)").html(status);
                    $('tr[data-id=' + data.id + ']').find("td:eq(4)").html(usedStatus);

                }
                else  if (id == 5) {
                    $('tr[data-id=' + data.id + ']').find("td:eq(1)").text(data.role_name_na);
                    $('tr[data-id=' + data.id + ']').find("td:eq(2)").text(data.role_name_fo);
                    $('tr[data-id=' + data.id + ']').find("td:eq(3)").html(status);


                }
                $('#locationModal').modal('hide');

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