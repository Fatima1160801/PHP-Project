

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach($modules as $module)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1"
                       href="#module{{$module->module_id}}">
                        {{$module->module_name_na}}
                    </a>
                </h4>
            </div>
            <div id="module{{$module->module_id}}" class="panel-collapse collapse">
                <div class="panel-body">

                    @foreach($module->screens()->get() as $screen )


                        <div class="panel-group" id="accordionscreen{{$screen->screen_id}}">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse"
                                           data-parent="#accordionscreen{{$screen->screen_id}}"
                                           href="#collapsescreen{{$screen->screen_id}}">
                                            {{$screen->screen_name_na}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsescreen{{$screen->screen_id}}"
                                     class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <table class="table-hover table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Command Name</th>
                                                <th>Command Type</th>
                                                <th>Controller</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($screen->screen_commands()->get() as $command)
                                                <tr>
                                                    <td>{{$command->command_name}} </td>
                                                    <td> {{$command->type->command_na}} </td>
                                                    <td>{{$command->controller}} </td>
                                                    <td>{{$command->action}}</td>
                                                    <td>
                                                        <label class="switch ">
                                                            <input command-id="{{$command->command_id}}"
                                                                   screen-id="{{$command->screen_id}}"
                                                                   command-type-id="{{$command->command_type_id}}"
                                                                   group_id="{{$group_id}}"

                                                                   type="checkbox"
                                                                   @if(\App\Models\Permission\GroupPermission::checkPermissionInGroup($id  ,$screen->screen_id,$command->command_id,$command->command_type_id) == true)
                                                                   checked
                                                                   @endif

                                                                   class="permissioncheckbox default">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endforeach
</div>