{{--<div class="card card-wizard" data-color="rose" id="wizardNotification">--}}
{{--    <div class="card-header card-header-rose card-header-text">--}}
{{--        --}}{{--            <div class="card-icon">--}}
{{--        --}}{{--                <i class="material-icons">lock</i>--}}
{{--        --}}{{--            </div>--}}
{{--        <h4 class="card-title">System Notifications Settings</h4>--}}
{{--    </div>--}}
{{--    <br><br>--}}
{{--    <div class="wizard-navigation">--}}
{{--        <ul class="nav nav-pills">--}}
{{--            <li class="nav-item" id="task_link" data-task-id="">--}}
{{--                <a class="nav-link active" href="#select_users" data-toggle="tab" role="tab">--}}
{{--                    Select Users--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item" id="task_link" data-task-id="">--}}
{{--                <a class="nav-link" href="#configure_notifications" data-toggle="tab" role="tab">--}}
{{--                    Notifications Settings--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane active" id="select_users">--}}
{{--                <div class="row">--}}
{{--                    <div id="columns_data"></div>--}}
{{--                    <div class="col-md-5">--}}
{{--                        <div class="card" style="min-height: 400px;">--}}
{{--                            <div class="card-header card-header-text  btn-sm">--}}
{{--                                <!--<div class="card-text">--}}
{{--                                    <h5 class="card-title">All Report Columns</h5>--}}
{{--                                </div>-->--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <table class="table table-hover">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th style="background-color:#ea2c6d;color:#fff">--}}
{{--                                            All Users--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody id="unselected_users">--}}
{{--                                    @foreach($users as $user)--}}

{{--                                        <tr class="unselected_user" style="cursor: pointer;" data-user-id="{{$user->id}}" data-user-name="{{$user->user_full_name}}">--}}
{{--                                            <td><b>{{$user->user_full_name}}</b> <?= (in_array($user->id,$saved_settings_users)) ? '<span class="badge badge-success" style="float:right">Configured</span>' : '' ?></td>--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1" style="padding-top:160px">--}}
{{--                        <button type="button" id="btnMoveOneRight" class="btn btn-sm btn-rose "><i--}}
{{--                                    class="fa fa-angle-right"></i></button>--}}
{{--                        <button type="button" id="btnMoveAllRight" class="btn btn-sm btn-rose "--}}
{{--                                style="width: 46px;"><i class="fa fa-angle-double-right"></i></button>--}}
{{--                        <button type="button" id="btnMoveAllLeft" class="btn btn-sm btn-rose "--}}
{{--                                style="width: 46px;"><i class="fa fa-angle-double-left"></i></button>--}}
{{--                        <button type="button" id="btnMoveOneLeft" class="btn btn-sm btn-rose "><i--}}
{{--                                    class="fa fa-angle-left"></i></button>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5">--}}
{{--                        <div class="card" style="min-height: 400px;">--}}
{{--                            <div class="card-header card-header-text ">--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <table class="table table-hover">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th style="background-color:#9c27b0;color:#fff">--}}
{{--                                            Selected Users--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody id="selected_users">--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                                <input type="hidden" id="selected_users_input" value=''>--}}
{{--                                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <?php--}}
{{--            $staffs_options = '';--}}
{{--            foreach($staffs as $staff){--}}
{{--                $staffs_options .= '<option value="'.$staff->id.'">'.((Auth::user()->lang_id == 1) ? $staff->staff_name_na : $staff->staff_name_fo).'</option>';--}}
{{--            }--}}
{{--            ?>--}}
{{--            <div class="tab-pane" id="configure_notifications">--}}
{{--                <div class="collapse-group">--}}
{{--                    <div class="collapse" id="collapseExample" style="display: block">--}}
{{--                        <button class="btn btn-primary open-button" type="button">--}}
{{--                            Expand all--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-primary close-button" type="button">--}}
{{--                            Close all--}}
{{--                        </button>--}}
{{--                        <div style="border-collapse:separate;border-spacing:6px;">--}}
{{--                            @foreach($modules as $module)--}}
{{--                                <br>--}}
{{--                                <div style="background-color: #339aff;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseModule{{$module->id}}" role="button" aria-expanded="false" aria-controls="collapseExample2">--}}
{{--                                    <div style="padding:10px">--}}
{{--                                <span><b style="font-weight:600"></b>--}}
{{--                                   <i class="icon-action fa fa-chevron-down text-white"></i> {{$module->module_name_na}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <br>--}}
{{--                                <div class="collapse" id="collapseModule{{$module->id}}" style="margin-{{Auth::user()->lang_id == 1 ? 'left' : 'right'}}: 40px;">--}}
{{--                                    @foreach($module->screens()->get() as $screen)--}}
{{--                                        @if($screen->has_notifications == 1)--}}
{{--                                            <div style="background-color: #1ac1b8;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseScreen{{$screen->id}}" role="button" aria-expanded="false" aria-controls="collapseExample2">--}}
{{--                                                <div style="padding:10px">--}}
{{--                                      <span><b style="font-weight:600"></b>--}}
{{--                                    <i class="icon-action fa fa-chevron-down  text-white"></i> {{$screen->screen_name_na}}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <br>--}}
{{--                                            <div class="collapse" id="collapseScreen{{$screen->id}}" style="margin-{{Auth::user()->lang_id == 1 ? 'left' : 'right'}}: 40px;">--}}
{{--                                                <table class="table">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Command</th>--}}
{{--                                                        <th>To Supervisor</th>--}}
{{--                                                        <th>To All Supervisors</th>--}}
{{--                                                        <th>To Another Users</th>--}}
{{--                                                        <th>Notification Text</th>--}}
{{--                                                        <th>User name Appearance</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    @foreach($screen->screen_commands()->get() as $command)--}}
{{--                                                        @if($command->has_notifications == 1)--}}
{{--                                                            <?php--}}
{{--                                                            $command_settings = $saved_notifications_settings->where('controller_name',$command->controller)->where('action_name',$command->action)->first();--}}
{{--                                                            ?>--}}
{{--                                                            @php--}}
{{--                                                                if($command_settings != null){--}}

{{--                                                                 foreach ($command_settings->anotherUsers() as $u){--}}
{{--                                                                     var_dump($u->user_id);--}}
{{--                                                                 }--}}
{{--                                                             }--}}
{{--                                                            @endphp--}}
{{--                                                            <tr data-command-id="{{$command->id}}" data-screen-id="{{$command->screen_id}}" data-command-action="{{$command->action}}" data-command-controller="{{$command->controller}}">--}}
{{--                                                                <td>{{$command->command_name}}</td>--}}
{{--                                                                <td>--}}
{{--                                                                    <div class="togglebutton switch-sidebar-mini">--}}
{{--                                                                        <label class="text-dark">--}}
{{--                                                                            <input class="permissionCheckBoxUser notificationCommand" id="to_main_sup_{{$command->id}}" type="checkbox" {{$command_settings != null ? ($command_settings->to_supervisor == 1 ? 'checked' : '') : ''}}>--}}
{{--                                                                            <span class="toggle"></span>--}}
{{--                                                                        </label>--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <td>--}}
{{--                                                                    <div class="togglebutton switch-sidebar-mini">--}}
{{--                                                                        <label class="text-dark">--}}
{{--                                                                            <input class="permissionCheckBoxUser notificationCommand" id="to_all_sup_{{$command->id}}" type="checkbox" {{$command_settings != null ? ($command_settings->is_all_supervisors == 1 ? 'checked' : '') : ''}}>--}}
{{--                                                                            <span class="toggle"></span>--}}
{{--                                                                        </label>--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <td>--}}
{{--                                                                    <select class="form-control selectpicker notificationCommand" id="another_users_{{$command->id}}" name="another_users[]" data-style="select-with-transition" multiple data-live-search="true" title="Choose Staffs">--}}
{{--                                                                        {!! $staffs_options !!}--}}
{{--                                                                    </select>--}}
{{--                                                                </td>--}}
{{--                                                                <td>--}}
{{--                                                                    <input type="text" class="form-control notificationCommand" id="noti_text_{{$command->id}}" style="width:300px" value="{{$command_settings != null ? $command_settings->notification_text : ''}}">--}}
{{--                                                                </td>--}}
{{--                                                                <td>--}}
{{--                                                                    <select class="form-control selectpicker notificationCommand" id="un_location_{{$command->id}}">--}}
{{--                                                                        <option value="0">No Appearance</option>--}}
{{--                                                                        <option value="1">Before the text</option>--}}
{{--                                                                        <option value="2">After the text</option>--}}
{{--                                                                    </select>--}}
{{--                                                                    @if($command_settings != null)--}}
{{--                                                                        <script>--}}
{{--                                                                            document.getElementById('un_location_{{$command->id}}').value = '{{$command_settings->user_name_status}}';--}}
{{--                                                                        </script>--}}
{{--                                                                    @endif--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                    </tbody>--}}
{{--                                                    </thead>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                            <br>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                            <br>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}