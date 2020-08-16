@extends('layouts._layout')

@section('content')

    <div class="card  permission-class">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">lock</i>
            </div>
            <h4 class="card-title">System Notifications Settings</h4>
        </div>

        <div class="card-body">

            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" id="btn_collapse_loghour" href="#collapseExample"
                   role="button" aria-expanded="false" aria-controls="collapseExample">
                    {{$labels->where('db_field_name','details')->first()->label}}
                </a>
            </p>


            <div class="collapse" id="collapseExample" style="display: block">
                <div style="border-collapse:separate;border-spacing:6px;">
                    @foreach($modules as $module)
                        <br>
                        <div style="background-color: #339aff;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseModule{{$module->id}}" role="button" aria-expanded="false" aria-controls="collapseExample2">
                            <div style="padding:10px">
                                <span><b style="font-weight:600"></b>
                                   <i class="icon-action fa fa-chevron-down  text-white"></i> {{$module->module_name_na}}</span>
                            </div>
                        </div>
                        <br>
                        <div class="collapse" id="collapseModule{{$module->id}}" style="margin-{{Auth::user()->lang_id == 1 ? 'left' : 'right'}}: 40px;">
                            @foreach($module->screens() ->get() as $screen)
                                <div style="background-color: #1ac1b8;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseScreen{{$screen->id}}" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                    <div style="padding:10px">
                                      <span><b style="font-weight:600"></b>
                                    <i class="icon-action fa fa-chevron-down  text-white"></i> {{$screen->screen_name_na}}</span>
                                    </div>
                                </div>
                                <br>
                                <div class="collapse" id="collapseScreen{{$screen->id}}" style="margin-{{Auth::user()->lang_id == 1 ? 'left' : 'right'}}: 40px;">

                                        @foreach($screen->screen_commands()->get() as $command)
                                        <div style="background-color: #dc51d9;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseCommand{{$command->id}}" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                            <div style="padding:10px">
                                                <span><b style="font-weight:600"></b>
                                                    <i class="icon-action fa fa-chevron-down  text-white"></i> {{$command->command_name}}</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="collapse" id="collapseCommand{{$command->id}}" style="margin-{{Auth::user()->lang_id == 1 ? 'left' : 'right'}}: 40px;">

                                            <!--<div class="row">
                                                <label class="col-md-3 col-form-label" for="task_duration">Send to the main supervisor</label>
                                                <div class=" col-md-5">
                                                    <div class="form-group has-default bmd-form-group is-filled">
                                                        <div class="togglebutton switch-sidebar-mini">
                                                            <label class="text-dark">
                                                                <input class="permissionCheckBoxUser screen4"
                                                                       command-id="16"
                                                                       screen-id="4"
                                                                       command-type-id="2"
                                                                       user_id="1"
                                                                       type="checkbox">
                                                                <span class="toggle"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                                    <div class="togglebutton switch-sidebar-mini">
                                                        <label class="text-dark">
                                                            <input class="permissionCheckBoxUser screen4"
                                                                   command-id="16"
                                                                   screen-id="4"
                                                                   command-type-id="2"
                                                                   user_id="1"
                                                                   type="checkbox">
                                                            <span class="toggle"></span>
                                                            Send to the main supervisor
                                                        </label>
                                                    </div>

                                                    <div class="togglebutton switch-sidebar-mini">
                                                        <label class="text-dark">
                                                            <input class="permissionCheckBoxUser screen4"
                                                                   command-id="16"
                                                                   screen-id="4"
                                                                   command-type-id="2"
                                                                   user_id="1"
                                                                   type="checkbox">
                                                            <span class="toggle"></span>
                                                            Send to all supervisors
                                                        </label>
                                                    </div>

                                               <input type="text" class="form-control" style="width:300px">

                                                    <select class="form-control selectpicker">
                                                        <option value="0">No Appearance</option>
                                                        <option value="1">Before the text</option>
                                                        <option value="2">After the text</option>
                                                    </select>

                                            </tr>

                                        </div>
                                        <br>

                                        @endforeach
                                </div>
                                <br>
                            @endforeach
                        </div>
                    @endforeach
                    <br>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('.selectpicker').selectpicker({
                @if(Auth::user()->lang_id == 2 )
                noneSelectedText: 'لم يتم تحديد شيء',
                @endif
            });
        });
    </script>
@endsection

@section('js')

    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>


@endsection
