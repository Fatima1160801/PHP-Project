@extends('layouts._layout')
@section('css')
    @include('setting.settingsScreens.settings_style')
@endsection
@section('content')
{{--    <div class="row p-4" style="row-gap: 0em;">--}}
{{--        <div class="col-md-5  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.notifications")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Notifications</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-5   text-left pull-left"style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.email.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;">--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Emails</span></span>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-5  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("settings.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">General Settings</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="w-100"></div>--}}
{{--        <div class="col-md-5  text-left pull-left" style="padding:2em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--            <a href="{{route("labelsSettings.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                    <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                        <span>  <i class="material-icons">storage</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Labels Settings</span></span>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    New--}}
{{--<div class="col-md-12 p-8" style="row-gap: 0em;">--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.notifications")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class='far fa-bell' style='font-size:20px'></i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Notifications</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4   text-left pull-left"style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.email.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;">--}}
{{--                    <span>  <i class="material-icons">contact_mail</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Emails</span></span>--}}
{{--                </div>--}}

{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("settings.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">settings</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">General Settings</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="col-md-4  text-left pull-left" style="padding:1em;padding-bottom: 0.5em;padding-top:0.5em;" >--}}
{{--        <a href="{{route("labelsSettings.index")}}"><div class="card" style="background-color: #5d76a8;margin:0 0 0 0">--}}
{{--                <div class="card-icon" style="padding:0.8em;"  >--}}
{{--                    <span>  <i class="material-icons">label</i>&nbsp;&nbsp;<span style="color:white;font-weight: bold">Labels Settings</span></span>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}

{{--New New--}}
<div class="container ml-2">
    <div class="row" id="containerc" style="height: 500px;">
        <div class="col-md-3 card p-3 mr-3">
            <ul class="navbar-nav mailli33">
                <li class="nav-item mb-3" id="notification" data-nameeng="Notifications" data-namear="الإشعارات" data-value="1">
                    <a href="#"
                       class="navi-link py-4 ">
                        <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >notifications</i>@if($lang==1)Notifications @elseالإشعارات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="email" data-nameeng="Emails" data-namear="الإيميلات" data-value="2">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">contact_mail</i>&nbsp;@if($lang==1)Emails @elseالإيميلات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="label" data-nameeng="Labels Settings" data-namear="إعدادات العناوين" data-value="3">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">subtitles</i>@if($lang==1)Labels Settings @elseإعدادات العناوين@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="general" data-nameeng="General Settings" data-namear="إعدادات النظام" data-value="4">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class="material-icons default-color mr-2">settings</i>@if($lang==1)General Settings @elseإعدادات النظام@endif</span>
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
{{--    @include('setting.email.email_script_render')--}}
@include('setting.setting.system_script')
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script>
        $(document).ready(function () {
            active_nev_link('visitType-link');
            active_nev_link('settings');
            funValidateForm();
            $('input').prop('required',false);
            $('input[id^="label_"]').attr('disabled',true);
            $('input[id^="labelHint_"]').attr('disabled',true);
        });

      function  search(){
            $('#button_clicked').val('search');
            $.get('{{route('settings.email.index')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                }
            });

        }

        $('#btnSave').click(function(){
            $('#button_clicked').val('save');
        });
        $("#email").click(function (e) {
                addSelected($("#email").attr("data-value"));
                $("#add").html("");
                $("#title").html("");
                $("#render_result").html("");
                // $("#procurementModal").addClass("modalSize")
                e.preventDefault();
                $.get('{{route('settings.email.index')}}',function(data){
                    if(data.status==true) {
                        $("#render_result").html(data.html);
                        $('.selectpicker').selectpicker();
                    }
                });
            });

            function addSelected(value) {
                $(".mailli33 .nav-item").removeClass("selected-item");
                if (value == 1) {
                    $("#notification").addClass("selected-item");

                } else if (value == 2) {
                    $("#email").addClass("selected-item");


                } else if (value == 3) {
                    $("#label").addClass("selected-item");

                } else if (value == 4) {
                    $("#general").addClass("selected-item");

                }
            }
        $("#general").click(function (e) {
            // $('#loadScreen div.loader').show();
            addSelected($("#general").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")
            e.preventDefault();
            $.get('{{route('settings.index')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#loadScreen div.loader').hide();
                }
            });
        });

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


@endsection