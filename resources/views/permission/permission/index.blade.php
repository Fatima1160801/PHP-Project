@extends('layouts._layout')

@section('content')
@include('permission.permission.render')
    <div class="card  permission-class">

{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">lock</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title"> {{$title}}</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}

{{--            <div class="collapse-group">--}}
{{--                <button class="btn btn-primary open-button" type="button">--}}
{{--                    Open all--}}
{{--                </button>--}}
{{--                <button class="btn btn-primary close-button" type="button">--}}
{{--                    Close all--}}
{{--                </button>--}}

{{--                @foreach($modules as $module)--}}

{{--                    <div class="card">--}}
{{--                        <header class="card-header bg-primary ">--}}
{{--                            <a href="#" data-toggle="collapse" data-target="#collapseModule{{$module->id}}"--}}
{{--                               aria-expanded="true" class="">--}}
{{--                                <i class="icon-action fa fa-chevron-down text-white"></i>--}}
{{--                                <span class="title "> {{$module->module_name_na}} </span>--}}
{{--                            </a>--}}
{{--                        </header>--}}
{{--                        <div class="collapse show" id="collapseModule{{$module->id}}" style="">--}}
{{--                            <article class="card-body">--}}

{{--                         <!------------------------------------------------------ screen.// -->--}}
{{--                                @foreach($module->screens()->orderBy('order_', 'asc')->get() as $screen )--}}
{{--                                    @if($screen->has_premission == 1)--}}
{{--                                    <div class="card">--}}
{{--                                        <header class="card-header bg-info">--}}

{{--                                            <span class=" togglebutton switch-sidebar-mini text-left">--}}
{{--                                                <label>--}}
{{--                                                    <input screenNo="screen{{$screen->id}}" class="screenChecked" type="checkbox">--}}
{{--                                                    <span class="toggle"></span>--}}
{{--                                                </label>--}}
{{--                                            </span>--}}

{{--                                            <a href="#" data-toggle="collapse" data-target="#collapseScreen{{$screen->id}}" aria-expanded="true" class="">--}}
{{--                                                <i class="icon-action fa fa-chevron-down text-white"></i>--}}
{{--                                                <span class="title ">{{$screen->screen_name_na}}</span>--}}
{{--                                            </a>--}}

{{--                                        </header>--}}
{{--                                        <div class="collapse show" id="collapseScreen{{$screen->id}}" style="">--}}
{{--                                            <article class="card-body">--}}
{{--                                                <!------------------------------------------------------ command.// -->--}}
{{--                                                <div class="row">--}}
{{--                                                    @if($type =='user')--}}
{{--                                                        @foreach($screen->screen_commands()->get() as $command)--}}
{{--                                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
{{--                                                                <div class="togglebutton switch-sidebar-mini">--}}
{{--                                                                    <label class="text-dark">--}}
{{--                                                                        <input class="permissionCheckBoxUser screen{{$screen->id}}"--}}
{{--                                                                               command-id="{{$command->id}}"--}}
{{--                                                                               screen-id="{{$screen->id}}"--}}
{{--                                                                               command-type-id="{{$command->screen_command_type_id}}"--}}
{{--                                                                               user_id="{{$user->id}}"--}}
{{--                                                                               type="checkbox"--}}
{{--                                                                                {{checkPermUserGroup($screen->id,$command->id,$command->screen_command_type_id,$user->id)}}--}}
{{--                                                                                {{checkPermUser($screen->id,$command->id,$command->screen_command_type_id,$user->id)}}>--}}
{{--                                                                        <span class="toggle"></span>--}}
{{--                                                                        {{$command->command_name}}--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endif--}}
{{--                                                    @if($type =='group')--}}
{{--                                                        @foreach($screen->screen_commands()->get() as $command)--}}
{{--                                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
{{--                                                                <div class="togglebutton switch-sidebar-mini">--}}
{{--                                                                    <label class="text-dark">--}}
{{--                                                                        <input class="permissionCheckboxGroup screen{{$screen->id}}"--}}
{{--                                                                               command-id="{{$command->id}}"--}}
{{--                                                                               screen-id="{{$command->screen_id}}"--}}
{{--                                                                               command-type-id="{{$command->screen_command_type_id}}"--}}
{{--                                                                               group_id="{{$group->id}}"--}}
{{--                                                                               type="checkbox"--}}
{{--                                                                                {{checkPermInGroup($group->id  ,$screen->id,$command->id,$command->screen_command_type_id)}}>--}}
{{--                                                                        <span class="toggle"></span>--}}
{{--                                                                        {{$command->command_name}}--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <!------------------------------------------------------ command.// -->--}}


{{--                                            </article> <!-- card-body.// -->--}}
{{--                                        </div> <!-- collapse .// -->--}}
{{--                                    </div> <!-- card.// -->--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                            <!------------------------------------------------------ endScreen.// -->--}}

{{--                            </article> <!-- card-body.// -->--}}
{{--                        </div> <!-- collapse .// -->--}}
{{--                    </div> <!-- card.// -->--}}

{{--                @endforeach--}}
{{--            </div>--}}


{{--        </div>--}}
    </div>

@endsection
@section('script')
    <script>

@include('permission.users.users_script')
        {{--$(".open-button").on("click", function () {--}}
        {{--    $(this).closest('.collapse-group').find('.collapse').collapse('show');--}}
        {{--});--}}

        {{--$(".close-button").on("click", function () {--}}
        {{--    $(this).closest('.collapse-group').find('.collapse').collapse('hide');--}}
        {{--});--}}


        {{--$(document).on('change', '.permissionCheckBoxUser', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var command_id = $(this).attr('command-id');--}}
        {{--    var screen_id = $(this).attr('screen-id');--}}
        {{--    var command_type_id = $(this).attr('command-type-id');--}}
        {{--    var user_id = $(this).attr('user_id');--}}
        {{--    var checkType = "";--}}
        {{--    if ($(this).is(':checked')) {--}}
        {{--        checkType = 'check';--}}
        {{--    } else {--}}
        {{--        checkType = 'uncheck';--}}
        {{--    }--}}
        {{--    data = {--}}
        {{--        'screen_id': screen_id,--}}
        {{--        'command_id': command_id,--}}
        {{--        'command_type_id': command_type_id,--}}
        {{--        'user_id': user_id,--}}
        {{--        'checkType': checkType--}}
        {{--    };--}}
        {{--    var url = '{{route("permission.permission.grantUser")}}';--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        dataTypes: 'json',--}}
        {{--        data: data,--}}
        {{--        type: 'post',--}}
        {{--        beforeSend: function () {--}}

        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            //console.log(data);--}}
        {{--        },--}}
        {{--        error: function () {--}}

        {{--        }--}}
        {{--    })--}}
        {{--})--}}

        {{--/****************  not edit permission grant by group to user  ******************/--}}
        {{--$(document).on('change', '.screenChecked', function (e) {--}}
        {{--    e.preventDefault();--}}

        {{--    checkClass = '.' + $(this).attr('screenNo');--}}

        {{--    if ($(this).is(':checked')) {--}}

        {{--        $(checkClass).each(function () {--}}
        {{--            var attr = $(this).attr('disabled');--}}
        {{--          //  console.log($(this).attr('disabled') != 'disabled');--}}
        {{--            if($(this).attr('disabled') != 'disabled'){--}}
        {{--                $(this).prop('checked', true);--}}
        {{--                $(this).change();--}}
        {{--            }--}}
        {{--        });--}}
        {{--    } else {--}}
        {{--        $(checkClass).each(function () {--}}
        {{--            if($(this).attr('disabled') != 'disabled'){--}}
        {{--                $(this).prop('checked', false);--}}
        {{--                $(this).change();--}}
        {{--            }--}}
        {{--        });--}}

        {{--    }--}}
        {{--});--}}
        {{--/*group*/--}}

        {{--$(document).on('change', '.permissionCheckboxGroup', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var command_id = $(this).attr('command-id');--}}
        {{--    var screen_id = $(this).attr('screen-id');--}}
        {{--    var command_type_id = $(this).attr('command-type-id');--}}
        {{--    var group_id = $(this).attr('group_id');--}}

        {{--    var checkType = "";--}}
        {{--    if ($(this).is(':checked')) {--}}
        {{--        checkType = 'check';--}}
        {{--    } else {--}}
        {{--        checkType = 'uncheck';--}}
        {{--    }--}}
        {{--    data = {--}}
        {{--        'screen_id': screen_id,--}}
        {{--        'command_id': command_id,--}}
        {{--        'command_type_id': command_type_id,--}}
        {{--        'group_id': group_id,--}}
        {{--        'checkType': checkType--}}
        {{--    };--}}
        {{--    var url = '{{route("permission.permission.grantGroup")}}';--}}

        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        dataTypes: 'json',--}}
        {{--        data: data,--}}
        {{--        type: 'post',--}}
        {{--        beforeSend: function () {--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            console.log(data);--}}
        {{--        },--}}
        {{--        error: function () {--}}
        {{--        }--}}
        {{--    })--}}
        {{--})--}}
        {{--/*checked*/--}}
        {{--$(document).ready(function (e) {--}}

        {{--    $('.screenChecked').each(function () {--}}
        {{--        $this = $(this);--}}
        {{--        $this.prop('checked', true);--}}
        {{--        $this.prop('disabled', false);--}}
        {{--        checkClass = '.' + $(this).attr('screenNo');--}}
        {{--        $index = 0;--}}
        {{--        $disabled = 0;--}}
        {{--        $(checkClass).each(function () {--}}
        {{--            $index = $index + 1;--}}
        {{--            if ($(this).is(':checked') == false) {--}}
        {{--                $this.prop('checked', false);--}}
        {{--            }--}}
        {{--            if ($(this).is(':disabled') == true) {--}}
        {{--                $disabled = $disabled + 1;--}}
        {{--            }--}}
        {{--        });--}}
        {{--        if ($index == $disabled) {--}}
        {{--            $this.prop('disabled', true);--}}

        {{--        }--}}
        {{--    });--}}

        {{--})--}}


        /**/
    </script>
@endsection


